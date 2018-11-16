<div class="tab-content">
    {!! Form::model($user , ['route' => ['admin.users.show.change_password.post', $user->id ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'detail-change-password-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> Change Password</h4>
        </div>

        <div class="panel-body">

            <div class="form-group row">
                {!! Form::label('password',  __('admin::admin.Password') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::password('password' ,  ['class' => 'form-control', 'placeholder' => __('admin::admin.Password'), 'data-rule-required' => '1' ] ) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('password_confirmation',  __('admin::admin.Confirm Password') , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-10">
                    {!! Form::password('password_confirmation' , ['class' => 'form-control', 'placeholder' => __('admin::admin.Confirm Password'),
                     'data-rule-required' => '1' ] ) !!}
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
        $('#detail-change-password-form').appForm({
            isModal : false,
            onSuccess : function (result) {
                console.log(result);
                if(result.success){
                    appAlert.success("Saved Successfully", {duration:3000});
                }else{
                    appAlert.error("Something Went Wrong", {duration:3000});
                }

            },
            onError : function (result) {
                console.log(result);
            }
        });
    });
</script>