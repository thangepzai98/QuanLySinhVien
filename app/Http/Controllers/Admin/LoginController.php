<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepository; 
use App\Repositories\Contracts\PasswordResetRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\CommonFunctions;

class LoginController extends Controller
{
    protected $user;
    protected $passwordReset;

    public function __construct(
        UserRepository $user,
        PasswordResetRepository $passwordReset
    ) {
    //    $this->middleware('guest')->except('logout');
        $this->user = $user;
        $this->passwordReset = $passwordReset;
    }

    public function index() {
        if(Auth::guard('admin')->check()) {
            return redirect()->intended('/admin/product');
        }
        return view('admin.login');
    }

    public function checkLogin(Request $request) {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:8'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $remember = ($request->has('remember')) ? true : false;
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $user = Auth::guard('admin')->user();
            if ($user->status == Config::get('constants.STATUS.INACTIVE') || $user->type == Config::get('constants.TYPE_USER.MEMBER')) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Tài khoản chưa được kích hoạt hoặc không có quyền');
            }
            $scripts = '<script>$(function () {iziToast.success({message: "Chào mừng Admin đăng nhập hệ thống!",position: "topRight"});});</script>';
            return redirect()->intended('/admin/product')->with('welcomeCode', $scripts);
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function forgot() {
        return view('admin.forgot');
    }

    public function sendForgot(Request $request) {
        $requestAll = $request->all();
        $validator = Validator::make($requestAll, [
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'email.exists' => 'Email không tồn tại trong hệ thống',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $token = str_random(60);
        $this->passwordReset->create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        if ($this->sendResetEmail($request->email, $token)) {
            return redirect()->back()->with('success', 'Liên kết đã được gửi đến địa chỉ của bạn');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    private function sendResetEmail($email, $token)
    {
        $user = $this->user->findByField('email', $email)->first();
        $link = url('/admin/resetPassword/') . '?email='.$email .'&token='. $token;
        try {
            Mail::send('email.password_reset_email', ['name' => $user->name, 'link' => $link], function ($message) use ($email) {
                $message->to($email)->subject('Mail xác nhận quên mật khẩu từ '.config('app.name'));
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetPassword()
    {
        return view('admin.reset_password');
    }

    public function sendResetPassword(Request $request)
    {
        $tokenData = $this->passwordReset->firstWhere(['email' => $request->email, 'token' => $request->token]);
        if(!$tokenData) {
            return redirect()->back()->with('error', 'Có gì đó sai sai =))');
        }
        if(!CommonFunctions::checkExpireTime($tokenData->created_at, 1)) {
            return redirect()->back()->with('error', 'Đường dẫn khôi phục mật khẩu đã hết hạn. Vui lòng gửi lại yêu cầu');
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password'
        ],[
            'password.required' => 'Mật khẩu mới không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'confirm_password.same' => 'Xác nhận mật khẩu chưa chính xác',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        
        try {
            DB::beginTransaction();
            $this->user->updateWhere(['email' => $request->email],[
                'password' => bcrypt($request->password)
            ]);
            $this->passwordReset->deleteWhere(['email' => $request->email]);
            DB::commit();
            return redirect()->intended('/admin')->with('success', 'Mật khẩu được khôi phục thành công! ');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
