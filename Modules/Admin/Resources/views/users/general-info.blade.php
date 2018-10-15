<div class="tab-content">

    {!! Form::model($user , ['route' => ['admin.users.store' ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'detail-user-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> General Info</h4>
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
            onSuccess : function (result) {
                console.log(result);
            },
            onError : function (result) {
                console.log(result);
            }
        });
    });
</script>