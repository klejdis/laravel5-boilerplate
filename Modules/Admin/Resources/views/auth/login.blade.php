@extends('admin::layouts.auth')

@section('content')

    <div class="signin-box">

        <div class="panel panel-default mb15">

            <div class="panel-heading text-center">

                <h2>{{ __('admin::admin.Sign in') }}</h2>

            </div>

            <div class="panel-body p30">

                @if(Session::has('auth_failed'))
                    <div class="alert alert-danger text-center">
                      <b> {{ Session::get('auth_failed') }} </b>
                    </div>
                @endif

                <form action="{{route('admin.auth.login.post')}}" method="post" id="signin-form" class="general-form">

                    {{csrf_field()}}

                    <div class="form-group has-feedback ">

                        <input type="email" name="email" class="form-control p10" value="" placeholder="{{ __('admin::admin.Email') }}">

                        <span class="fa fa-envelope form-control-feedback"></span>

                        {!! $errors->has('email') ? '<small class="text-danger"> '.$errors->first("email").'</small>' : '' !!}

                    </div>

                    <div class="form-group has-feedback">

                        <input type="password" name="password" class="form-control p10" placeholder="{{ __('admin::admin.Password') }}">

                        <span class="fa fa-lock form-control-feedback"></span>

                        {!! $errors->has('password') ? '<small class="text-danger"> '.$errors->first("password").'</small>' : '' !!}

                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg mt15">
                        {{ __('admin::admin.Sign in') }}
                    </button>

                    <div class="row">

                        <div class="col-xs-12 mt5">

                            <div class="auth-links">

                                @if(Setting::get('forgot-password-avalilability') == 'true')

                                    <a href="{{route('admin.auth.forgot_password')}}" class="text-center">

                                        {{ __('admin::admin.i-forgot-my-password') }}

                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection