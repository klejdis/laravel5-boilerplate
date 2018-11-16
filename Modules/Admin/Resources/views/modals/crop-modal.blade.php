<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="crop-box">
                    <div class="thumb-box"></div>
                    <div class="spinner" style="display: none">Loading...</div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button  id="image-zoomout-button" type="button" class="btn btn-default pull-left mr10"><i class="fa fa-minus"></i></button>
                <button id="image-zoomin-button" type="button" class="btn btn-default pull-left"><i class="fa fa-plus"></i></button>

                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times mr5"></i> close</button>
                <button id="image-crop-button" type="button" class="btn btn-primary" data-dismiss="modal"> <i class="fa fa-check-circle mr5"></i> crop</button>
            </div>
        </div>
    </div>
</div>

@push('stylesheets')
    <style>
        .crop-box {
            position: relative;
            height: 400px;
            width: 100%;
            background: #fff;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: center;
            cursor: move;
        }

        .crop-box .thumb-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 200px;
            margin-top: -100px;
            margin-left: -100px;
            box-sizing: border-box;
            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
            background: none repeat scroll 0% 0% transparent;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{asset('js/cropbox/cropbox-min.js')}}"></script>
    <script type="text/javascript">
        var options =
            {
                thumbBox: '.thumb-box',
                spinner: '.spinner',
                imgSrc: ''
            };
        var cropper = $('.crop-box').cropbox(options);

        var $modal;
        var is_modal;

        function showCropBox(element, modal) {
            var $selector = $(element),
                file = element.files ? element.files[0] : "";

            $modal = modal;
            is_modal = (modal) ? true :  false ;

            if (file) {
                //check if crop is opened from modal
                if(is_modal){
                    $modal.hide();
                }

                var height = $selector.attr("data-height") || 200,
                    width = $selector.attr("data-width") || 200,
                    previewCntainer = $selector.attr('data-preview-container'),
                    inputField = $selector.attr('data-input-field');

                $('#image-crop-button').attr('data-preview-container', previewCntainer);
                $('#image-crop-button').attr('data-input-field', inputField);

                var fileTypes = ["image/jpeg", "image/png", "image/gif"];
                if (fileTypes.indexOf(file.type) === -1) {
                    toastr.error('invalid_file_type');
                    return false;
                } else if (file.size / 1024 > 3072) {
                    toastr.error('max_file_size_3mb_message');
                    return false;
                }

                if (typeof FileReader == 'function') {
                    $(options.thumbBox).css({"width": width + "px", "height": height + "px", "margin-top": (height / 2) * -1 + "px", "margin-left": (width / 2) * -1 + "px"});
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        options.imgSrc = e.target.result;
                        cropper = $('.crop-box').cropbox(options);
                    };
                    reader.readAsDataURL(file);
                    setTimeout(function() {
                        $("#cropModal").modal('toggle');
                        setTimeout(function() {
                            cropper.zoomIn();
                            cropper.zoomOut();
                        }, 500);
                    }, 500);
                    $selector.val("");
                } else {
                    //FileReader is not supported....
                }
            }
        }

        $(document).ready(function() {
            $('#image-crop-button').on('click', function() {
                var img = cropper.getDataURL(),
                    previewCntainer = $(this).attr('data-preview-container'),
                    inputField = $(this).attr('data-input-field');

                $(previewCntainer).attr("src", img);

                $(inputField).val(img).trigger("change");

                if(is_modal){
                    $modal.show();
                }
            });
            $('#image-zoomin-button').on('click', function() {
                cropper.zoomIn();
            });
            $('#image-zoomout-button').on('click', function() {
                cropper.zoomOut();
            });

            $('#cropModal').on('hidden.bs.modal', function (e) {
                if(is_modal){
                    $modal.show();
                }
            });
        });
    </script>
@endpush

