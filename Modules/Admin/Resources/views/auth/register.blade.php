@extends('backend.layouts.auth')
@section('bodyClass')
    hold-transition login-page
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>BAG</b>US</a>
        </div>
        <!-- /.login-logo -->
        <div class="register-box-body">
            <p class="login-box-msg">{{__('backend/login.register-a-new-membership')}}</p>

            @include('backend.partials.errors')

            <form action="{{route('admin.auth.register.store')}}" method="post">
                {{csrf_field()}}

                <div class="form-group has-feedback ">
                    <input type="text" name="name" class="form-control" value="" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="email" name="email" class="form-control" value="" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{__('backend/login.register')}}</button>
            </form>
            <div class="auth-links">
                <a href="{{route('admin.auth.login')}}"
                   class="text-center">{{__('backend/login.already-have-membership')}}</a>
            </div>
        </div>
    </div><!-- /.login-box -->
@endsection
