@extends('admin::layouts.auth')

@section('content')
    <div class="signin-box">

        <div class="panel panel-default mb15">
            <div class="panel-heading text-center">
                <h2>{{ __('admin::admin.Reset Password') }}</h2>
            </div>

            <div class="panel-body p30">
                <form action="{{route('admin.auth.forgot_password.update')}}" method="post" class="general-form">

                    {{csrf_field()}}

                    <input type="hidden" name="token" value="{{$token}}">

                    <div class="form-group has-feedback ">
                        <input type="email" name="email" class="form-control" value="" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        {!! $errors->has('email') ? '<small class="text-danger"> '.$errors->first("email").'</small>' : '' !!}
                    </div>

                    <div class="form-group has-feedback ">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {!! $errors->has('password') ? '<small class="text-danger"> '.$errors->first("password").'</small>' : '' !!}
                    </div>

                    <div class="form-group has-feedback ">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('admin::admin.Reset Password')  }}</button>

                </form>
            </div>
        </div>

    </div>
@endsection
