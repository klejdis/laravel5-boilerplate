{!! Form::open(['route' => ['admin.roles.store' ], 'method' => 'post', 'class'=> 'general-form', 'id' => 'create-role-form']) !!}
<div class="modal-body">

    <div class="form-group row">
        {!! Form::label('name', 'Name' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('name' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('slug', 'Slug' , ['class' => 'col-sm-4' ]) !!}
        <div class="col-sm-8">
            {!! Form::text('slug' , '' , ['class' => 'form-control', 'data-rule-required' => 1 ])   !!}
        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-2">
            <b>Permissions</b>
        </div>
        <div class="col-sm-8">
        </div>
    </div>

    @foreach ($permissions as $module => $permission )
        <div class="form-group row">
            {!! Form::label($module , $module , ['class' => 'col-sm-4' ]) !!}
            <div class="col-sm-8">
                {!! Form::select('permissions['.$module.']'.'[]', $permission , null ,['class' => 'form-control select2' , 'multiple' => 'multiple'])  !!}
            </div>
        </div>
    @endforeach

</div>

<div class="modal-footer">
    <div class="row">
        <button class="btn btn-primary pull-right" type="submit"> <i class="fa fa-check-circle mr5"></i>Save</button>
    </div>
</div>

{!! Form::close() !!}

<script type="text/javascript">
    $(document).ready(function () {
        $('#create-role-form').appForm({
            onSuccess : function (result){
                if(result.success){
                    $('#users').appTable({
                        newData : result.newData
                    });
                }else{
                    console.log('error');
                }
            },
            onError : function (result){
                console.log('error');
                return true;
            }
        });

        setSelect2('.select2')

    });
</script>
