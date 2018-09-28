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
            @include('backend.partials.errors')
            <p class="login-box-msg">{{__('backend/login.reset-password')}}</p>
            <form action="{{route('admin.auth.forgot_password.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" value="" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{__('backend/login.send-password-reset')}}</button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection
