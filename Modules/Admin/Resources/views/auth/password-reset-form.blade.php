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
        <div class="login-box-body">
            <p class="login-box-msg">{{__('backend/login.reset-password')}}</p>

            @include('backend.partials.errors')

            <form action="{{route('admin.auth.forgot_password.update')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="token" value="{{$token}}">
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
                >{{__('backend/login.reset-password')}}</button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection
