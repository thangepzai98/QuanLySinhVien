@extends('front.layout.base')

@section('content')
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper"><h1 class="page-width">Đăng nhập</h1></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
            <div class="mb-4">
                
               <form method="post" action="{{ route('login') }}" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="CustomerEmail">Email</label>
                            <input type="email" name="email" placeholder="" id="CustomerEmail" value="{{ old('email') }}" class="" autocorrect="off" autocapitalize="off" autofocus="" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            @if (session('message'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ session('message') }}</strong>
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
                  </div>
                  <div class="row">
                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="submit" class="btn mb-3" value="Đăng nhập">
                        <p class="mb-4">
                            <a href="#" id="RecoverPassword">Quên mật khẩu</a> &nbsp; | &nbsp;
                            <a href="register.html" id="customer_register_link">Tạo tài khoản</a>
                        </p>
                    </div>
                 </div>
             </form>
             <a href="/redirect" class=""><i class="icon icon-facebook"></i>Đăng nhập facebook</a>
            </div>
           </div>
    </div>
</div>
@endsection



