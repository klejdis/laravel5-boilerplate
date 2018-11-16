@extends('admin::layouts.admin')

@section('page')
        <div class="p20 row">
            @include('admin::settings.tabs')

            <div class="col-sm-9 col-lg-10">
                {!! Form::open(['route' => 'admin.setting.store' , 'class' => 'form-horizontal general-form dashed-row']) !!}
                <div class="panel">
                    <div class="panel-default panel-heading">
                        <h3>General</h3>
                    </div>
                    <div class="panel-body post-dropzone">

                        <div class="form-group">
                            {!! Form::label('app-name', 'App Name' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('app-name', Setting::get('app-name') , ['class'=> 'form-control ']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-logo', 'App Logo' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                <div class="pull-left mr15">
                                    <img id="applogo-image-preview" src="{{ $logo_src }}" alt="app logo">
                                </div>

                                <div class="pull-left btn btn-default btn-xs">
                                    <input type="hidden" name="app-logo" value="" id="app-logo">
                                    {!! Form::file('' , ['id'=>'app-logo-input' , 'class'=> 'upload' , 'data-height' => '50' ,  'data-width'=> '120' , 'data-preview-container' => '#applogo-image-preview' , 'data-input-field'=> '#app-logo'] )  !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-lang', 'App Language' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-lang', $languages , Setting::get('app-name') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-timezone', 'Timezone' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-timezone',
                                    \Modules\Admin\Support\Helper::getTimezones()
                                    ,Setting::get('app-timezone') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-date-format', 'Date Format' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-date-format', [
                                    "d-m-Y" => "d-m-Y",
                                    "m-d-Y" => "m-d-Y",
                                    "Y-m-d" => "Y-m-d",
                                    "d/m/Y" => "d/m/Y",
                                    "m/d/Y" => "m/d/Y",
                                    "Y/m/d" => "Y/m/d",
                                    "d.m.Y" => "d.m.Y",
                                    "m.d.Y" => "m.d.Y",
                                    "Y.m.d" => "Y.m.d",]
                                    , Setting::get('app-date-format') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-time-format', 'Time Format' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-time-format', [
                                    "H:i A" => "12 AM",
                                    "H:i a" => "12 am",
                                    "H:i" => "24 hours"
                                   ]
                                    , Setting::get('app-time-format') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-first-day-of-week', 'First Day Of Week' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-first-day-of-week', [
                                        "0" => "Sunday",
                                        "1" => "Monday",
                                        "2" => "Tuesday",
                                        "3" => "Wednesday",
                                        "4" => "Thursday",
                                        "5" => "Friday",
                                        "6" => "Saturday"
                                   ]
                                    , Setting::get('app-first-day-of-week') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-accepted-file-format', 'Accepted file format' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('app-accepted-file-format',Setting::get('app-accepted-file-format') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-rows-per-page', 'Rows Per Page' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('app-rows-per-page', [
                                    "10" => "10",
                                    "25" => "25",
                                    "50" => "50",
                                    "100" => "100",
                                   ]
                                    , Setting::get('app-rows-per-page') , ['class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-decimal-separator', 'Decimal Separator' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!!
                                    Form::select('app-decimal-separator', [
                                         "." => ".",
                                         "," => ",",
                                       ],
                                       Setting::get('app-decimal-separator'),
                                       ['class'=> 'form-control']
                                    )
                                !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('app-thousands-separator', 'Thousands Separator' , ['class'=> 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!!
                                    Form::select('app-thousands-separator', [
                                         "." => ".",
                                         "," => ",",
                                       ],
                                       Setting::get('app-thousands-separator'),
                                       ['class'=> 'form-control']
                                    )
                                !!}
                            </div>
                        </div>


                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary pull-right" type="submit"> <i class="fa fa-check-circle mr5"></i>Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            @include('admin::modals.crop-modal')
        </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".upload").change(function () {
                if (typeof FileReader == 'function') {
                    showCropBox(this);
                }
            });

        });
    </script>
@endpush
