@extends('admin::layouts.auth')

@section('content')

    <div class="signin-box">
        <div class="panel panel-default mb15">

            <div class="panel-heading text-center">
                <h2>{{ __('admin::admin.Reset Password') }}</h2>
            </div>

            <div class="panel-body p30">

                @if(Session::has('status') && Session::get('status') == 'error')
                   <div class="alert alert-danger text-center">
                       {{Session::get('message')}}
                   </div>
                @endif

                @if(Session::has('status') && Session::get('status') == 'success')
                    <div class="alert alert-success text-center">
                        {{Session::get('message')}}
                    </div>
                @endif

                <form action="{{route('admin.auth.forgot_password.store')}}" method="post" class="general-form">
                    {{csrf_field()}}
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" value="" placeholder="Email">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{__('admin::admin.Reset Password')}}
                    </button>

                    <div class="mt5">
                        <a href="{{ route('admin.auth.login') }}">{{ __('admin::admin.Sign in') }}</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
