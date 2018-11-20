@extends("admin::layouts.admin")

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <!-- box-header -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Create a Role</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(['route' => 'admin.roles.store' , 'method' => 'post'])!!}
                        <div class="box-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Name' , ['class' => 'col-sm-2' ]) !!}

                                <div class="col-sm-4 {!! $errors->has('first_name') ? 'has-error' : '' !!}">
                                    {!! Form::text('name' , 'Name' , ['class' => 'form-control' ])   !!}
                                    {!! $errors->has('name') ? '<small class="text-danger"> '.$errors->first("name").'</small>' : '' !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('slug', 'Slug' , ['class' => 'col-sm-2' ]) !!}

                                <div class="col-sm-4 {!! $errors->has('last_name') ? 'has-error' : '' !!}">
                                    {!! Form::text('slug' , 'Slug' , ['class' => 'form-control' ])   !!}
                                    {!! $errors->has('slug') ? '<small class="text-danger"> '.$errors->first("slug").'</small>' : '' !!}
                                </div>
                            </div>


                            <h3 class="box-title">Permissions</h3>
                            <hr>

                            <div class="form-group row">
                                {!! Form::label('select_all_permissions', 'Select All' , ['class' => 'col-sm-2' ]) !!}

                                <div class="col-sm-4 icheck">
                                    {!! Form::checkbox('select_all_permissions', 'select_all_permissions' )  !!}
                                    <br>{!! $errors->has('permissions') ? '<small class="text-danger"> '.$errors->first("permissions").'</small>' : '' !!}
                                </div>
                            </div>

                            @foreach ($permissions as $module => $permission )
                                <div class="form-group row">
                                    {!! Form::label($module , $module , ['class' => 'col-sm-2' ]) !!}
                                    <div class="col-sm-10">
                                        {!! Form::select('permissions['.$module.']'.'[]', $permission , null ,['class' => 'form-control select2' , 'multiple' => 'multiple'])  !!}
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                        <!-- /.box-footer -->
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('afterStylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
@endpush

@push('afterJsScripts')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('backend/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();

            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $('#select_all_permissions').on('ifChecked', function(event){
                $('select[name ^= permissions]').each(function(value){
                    $(this).find('option').prop('selected','selected');
                    $(this).trigger("change");
                });
            });

            $('#select_all_permissions').on('ifUnchecked', function(event){
                $('select[name ^= permissions]').each(function(value){
                    $(this).val('').trigger("change");
                });
            });

        });
    </script>
@endpush