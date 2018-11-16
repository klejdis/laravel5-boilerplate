<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirmationModalTitle"> {{__('admin::admin.Delete')}}</h4>
            </div>
            <div id="confirmationModalContent" class="modal-body">
                {{__('admin::admin.Are You Sure')}}
            </div>
            <div class="modal-footer clearfix">
                <button id="confirmDeleteButton" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash mr5"></i> {{__('admin::admin.Delete')}} </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr5"></i>{{__('admin::admin.Cancel')}}  </button>
            </div>
        </div>
    </div>
</div>