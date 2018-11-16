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

                            <span class="avatar avatar-lg">
                                {!! $user->present()->profileImage  !!}
                            </span>
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

    <ul data-toggle="ajax-tab" class="nav nav-tabs" role="tablist">
        <li>
            <a  role="presentation" class="active" href="{{route('admin.users.show.general_info_tab', [ 'user' => $user->id ])}}" data-target="#tab-details"> General Details </a>
        </li>

        <li>
            <a  role="presentation" href="{{route('admin.users.show.permission', [ 'user' => $user->id ])}}" data-target="#tab-permissions"> Permissions </a>
        </li>

        <li>
            <a  role="presentation" href="{{route('admin.users.show.change_password', [ 'user' => $user->id ])}}" data-target="#tab-password"> Change Password </a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="tab-details"></div>
        <div role="tabpanel" class="tab-pane fade" id="tab-permissions"></div>
        <div role="tabpanel" class="tab-pane fade" id="tab-password"></div>
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