<div class="tab-content">
    {!! Form::model($user , ['route' => ['admin.users.show.permissions.post', $user->id ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'permissions-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> Permissions </h4>
        </div>

        <div class="panel-body">

            <div class="form-group row">
                {!! Form::label('select_all_permissions', 'Select All' , ['class' => 'col-sm-2' ]) !!}

                <div class="col-sm-4 icheck">
                    {!! Form::checkbox('select_all_permissions', 'select_all_permissions' )  !!}

                </div>
            </div>
            @foreach ($permissions as $module => $permission )
                <div class="form-group row">
                    {!! Form::label($module , $module , ['class' => 'col-sm-2' ]) !!}
                    <div class="col-sm-10">
                        {!! Form::select('permissions['.$module.']'.'[]', $permission , $selected_permissions ,['class' => 'form-control select2' , 'multiple' => 'multiple'])  !!}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-check-circle mr5"></span>Save</button>
        </div>
    </div>

    {!! Form::close() !!}

</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('.select2').select2({
            width: '100%'
        });

        $('#select_all_permissions').on('change', function(event){
            if ($(this).is(':checked')){
                $('select[name ^= permissions]').each(function(value){
                    $(this).find('option').prop('selected','selected');
                    $(this).trigger("change");
                });
            }else{
                $('select[name ^= permissions]').each(function(value){
                    $(this).val(null);
                    $(this).trigger("change");
                });
            }
        });

        $('#permissions-form').appForm({
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
    });
</script>