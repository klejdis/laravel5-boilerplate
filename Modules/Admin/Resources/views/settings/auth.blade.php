@extends('admin::layouts.admin')

@section('page')
        <div class="p20 row">
            @include('admin::settings.tabs')

            <div class="col-sm-9 col-lg-10">
                {!! Form::open(['route' => 'admin.setting.store' , 'class' => 'form-horizontal dashed-row']) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Auth</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="" class="col-sm-3">{{ __('backend/roles.activations') }}</label>

                            <div class="col-sm-5">
                                <select name="activation-availability" id="" class="form-control">
                                    @php $selected_activation_availability = Setting::get('activation-availability'); @endphp
                                    <option value="true" {!! ('true' == $selected_activation_availability ? 'selected':'') !!}>On</option>
                                    <option value="false" {!! ('false' == $selected_activation_availability ? 'selected':'') !!} >Off</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">{{ __('backend/roles.activation_type') }}</label>

                            <div class="col-sm-5">
                                <select name="activation-type" id="" class="form-control">
                                    @php $selected_activation_type = Setting::get('activation-type')['selected']; @endphp
                                    <option value="email" {!! ('email' == $selected_activation_type ? 'selected':'') !!}>Email</option>
                                    <option value="manual" {!! ( 'manual' == $selected_activation_type ? 'selected':'') !!}>Manual</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3">Automatic Activation on Register</label>

                            <div class="col-sm-5">
                                <select name="automatic-activation-after-register" id="" class="form-control">

                                    <option value="false" {!! (Setting::get('automatic-activation-after-register') == 'false') ? 'selected' : '' !!}>
                                        No
                                    </option>

                                    <option value="true" {!! (Setting::get('automatic-activation-after-register') == 'true') ? 'selected' : '' !!}>
                                        Yes Please!
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3">Forgot Password Availability</label>

                            <div class="col-sm-5">
                                <select name="forgot-password-avalilability" id="" class="form-control">

                                    <option value="false" {!! (Setting::get('forgot-password-avalilability') == 'false') ? 'selected' : '' !!}>
                                        No
                                    </option>

                                    <option value="true" {!! (Setting::get('forgot-password-avalilability') == 'true') ? 'selected' : '' !!}>
                                        Yes Please!
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3">Backend Entry Point</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="backend-entry-point" value="{!! Setting::get('backend-entry-point') !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-lat', 'Google Map Latitude' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('app-lat', Setting::get('app-lat') , ['class'=> 'form-control ']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-lng', 'Google Map Longitude' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('app-lng', Setting::get('app-lng') , ['class'=> 'form-control ']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary pull-right" type="submit"> <i class="fa fa-check-circle mr5"></i>Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection

