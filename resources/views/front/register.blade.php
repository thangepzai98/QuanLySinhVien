@extends('front.layout.base')

@section('content')
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper"><h1 class="page-width">Đăng ký tài khoản</h1></div>
      </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
            <div class="mb-4">
               <form method="post" action="{{ route('register') }}" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	
                  <div class="row">
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="FirstName">Tên người dùng</label>
                            <input type="text" name="name" placeholder="" id="FirstName" autofocus="" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                       </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="CustomerEmail">Email</label>
                            <input type="email" name="email" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="" value="{{ old('email') }}" required> 
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="CustomerPassword">Mật khẩu</label>
                            <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="" required>  
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif                      	
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="CustomerPassword">Xác nhận mật khẩu</label>
                            <input type="password" value="" name="password_confirmation" placeholder=""  class="" required>                        	
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="submit" class="btn mb-3" value="Create">
                    </div>
                 </div>
             </form>
            </div>
           </div>
    </div>
</div>
@endsection