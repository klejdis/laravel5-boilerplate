{!! Form::open(['route' => ['admin.users.store' ], 'method' => 'post', 'class'=> 'general-form', 'id' => 'create-user-form'])!!}

<div class="modal-body">

    <div class="form-group row">
        {!! Form::label('first_name', __('admin::admin.First Name') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('first_name' , '' , ['class' => 'form-control', 'placeholder' => __('admin::admin.First Name'), 'data-rule-required' => '1' ]) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('last_name', __('admin::admin.Last Name') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('last_name' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Last Name'), 'data-rule-required' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('email',  __('admin::admin.Email') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::email('email' , '' , ['class' => 'form-control', 'placeholder' => __('admin::admin.Email'), 'data-rule-required' => '1' ] ) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('password',  __('admin::admin.Password') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::email('password' , '' , ['class' => 'form-control', 'placeholder' => __('admin::admin.Password'), 'data-rule-required' => '1' ] ) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('roles',  __('admin::admin.Roles') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::select('roles' , $roles , null , ['class' => 'form-control', 'data-rule-required' => '1', "multiple"=>"multiple" ] ) !!}
        </div>
    </div>

</div>

<div class="modal-footer">
    <div class="row">
        <button class="btn btn-primary pull-right" type="submit"> <i class="fa fa-check-circle mr5"></i>Save</button>
    </div>
</div>

{!! Form::close() !!}


<script type="text/javascript">
    $(document).ready(function () {
        $('#create-user-form').appForm({
            onSuccess : function (result) {
                console.log(result);

                if(result.success){
                    $('#users').appTable({
                        newData : result.newData
                    });
                }

            },
            onError : function (result) {
                console.log(result);
            }
        });
    });
</script>