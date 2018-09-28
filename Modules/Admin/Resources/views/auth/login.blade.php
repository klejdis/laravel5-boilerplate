<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>


<div class="signin-box">
    <form action="{{route('admin.auth.login.post')}}" method="post">
        {{csrf_field()}}

        <div class="form-group has-feedback ">
            <input type="email" name="email" class="form-control" value="" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! $errors->has('email') ? '<small class="text-danger"> '.$errors->first("email").'</small>' : '' !!}
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! $errors->has('password') ? '<small class="text-danger"> '.$errors->first("password").'</small>' : '' !!}
        </div>
        <div class="row">
        {{--<div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember"> {{__('backend/login.remember-me')}}
                </label>
            </div>
        </div>--}}
        <!-- /.col -->
            <div class="col-xs-8">
                <div class="auth-links">
                    @if(Setting::get('forgot-password-avalilability'))
                        <a href="{{route('admin.auth.forgot_password')}}"
                           class="text-center"
                        >{{__('backend/login.i-forgot-my-password')}}</a>
                    @endif
                    <br>

                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{__('backend/login.sign-in')}}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

</div>
</body>
</html>


