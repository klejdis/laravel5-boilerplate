<div class="col-sm-3 col-lg-2">
    <h4><i class="fa fa-wrench"></i> App Settings </h4>

    <ul class="nav nav-tabs vertical" role="tablist">
        <li role="presentation" class="{{active(['admin/settings/general'])}}">
            <a href="{{route('admin.setting.index' , ['tab' => 'general'])}}">
                General
            </a>
        </li>

        <li role="presentation" class="{{active(['admin/settings/auth'])}}">
            <a href="{{route('admin.setting.index' , ['tab' => 'auth'])}}">
                Auth
            </a>
        </li>

    </ul>
</div>