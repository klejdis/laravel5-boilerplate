<div class="tab-content">

    {!! Form::model($user , ['route' => ['admin.users.update', $user ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'detail-user-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> General Info </h4>
        </div>

        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('first_name', __('admin::admin.First Name') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::text('first_name' , null , ['class' => 'form-control', 'placeholder' => __('admin::admin.First Name'), 'data-rule-required' => '1' ]) !!}
                </div>
            </div>

            <div class="form-group ">
                {!! Form::label('last_name', __('admin::admin.Last Name') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::text('last_name' , null , ['class' => 'form-control','placeholder' => __('admin::admin.Last Name'), 'data-rule-required' => '1'])   !!}
                </div>
            </div>

            <div class="form-group ">
                {!! Form::label('email',  __('admin::admin.Email') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::email('email' , null , ['class' => 'form-control', 'placeholder' => __('admin::admin.Email'), 'data-rule-required' => '1' ] ) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('activate',  __('admin::admin.Activated') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-4 icheck">
                    {!! Form::checkbox('activate', 'activate' , $activate )  !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('roles',  __('admin::admin.Roles') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::select('roles[]' , $roles , null , ['class' => 'form-control select2-role', 'data-rule-required' => '1', "multiple"=>"multiple" ] ) !!}
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-check-circle mr5"></span>Save</button>
        </div>
    </div>

    {!! Form::close() !!}

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#detail-user-form').appForm({
            isModal : false,
            onSuccess : function (result) {
                if(result.success){
                    appAlert.success("Saved Successfully", {duration:3000});
                }else{
                    appAlert.error("Something Went Wrong", {duration:3000});
                }
            },
            onError : function (result) {
                appAlert.error("Something Went Wrong", {duration:3000});
            }
        });

        setSelect2('.select2-role',{
        });

    });
</script>