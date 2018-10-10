@extends('admin::layouts.admin')

@section('page')

    <div class="bg-success clearfix">
            <div class="col-md-6">
                <div class="row p20">
                    <div class="box">
                        <div class="box-content w200 text-center profile-image">
                            <div class="file-upload btn mt0 p0" style="vertical-align: top;  margin-left: -50px; ">
                                <span><i class="btn fa fa-camera" ></i></span>
                                <input id="profile_image_file" class="upload" name="profile_image_file" type="file"
                                       data-height="200" data-width="200" data-preview-container="#profile-image-preview" data-input-field="#profile_image" />
                            </div>
                            <input type="hidden" id="profile_image" name="profile_image" value=""  />

                            <span class="avatar avatar-lg"><img id="profile-image-preview" src="" alt="..."></span>
                            <h4 class="">{{ $user->present()->fullName  }}</h4>
                        </div>
                        <div class="box-content pl15">
                            <p class="p10 m0">
                                {!!  $user->present()->firstRoleLabeled  !!}
                            </p>

                            <p class="p10 m0">
                                <i class="fa fa-envelope-o"></i>  {!!  $user->email !!} <span class="mr15"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-center cover-widget">
                <div class="row p20">

                </div>
            </div>
        </div>


    @include('admin::modals.crop-modal')
@endsection


@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $(".upload").change(function () {
            if (typeof FileReader == 'function') {
                showCropBox(this);
            } else {
                $("#profile-image-form").submit();
            }
        });

        $("#profile_image").change(function () {
            $("#profile-image-form").submit();
        });

    });
</script>
@endpush