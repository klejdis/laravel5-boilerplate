<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="fa fa-cog"></span>
        </button>

        <button id="sidebar-toggle" type="button" class="navbar-toggle"  data-target="#sidebar">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>

        <a class="navbar-brand" href="">
            <img src="{{ getAppLogo() }}" />
        </a>
    </div>

    <div id="navbar" class="navbar-collapse collapse">

        <ul class="nav navbar-nav navbar-left">
            <li class="hidden-xs pl15 pr15  b-l">
                <button class="hidden-xs" id="sidebar-toggle-md">
                    <span class="fa fa-dedent"></span>
                </button>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li class="">
                <?php echo js_anchor("<i class='fa fa-bell-o'></i>", array("id" => "web-notification-icon", "class" => "dropdown-toggle", "data-toggle" => "dropdown")); ?>

                <div class="dropdown-menu aside-xl m0 p0 font-100p" style="min-width: 400px;" >
                    <div class="dropdown-details panel bg-white m0">
                        <div class="list-group">
                            <span class="list-group-item inline-loader p10"></span>
                        </div>
                    </div>
                    <div class="panel-footer text-sm text-center">
                        see_all
                    </div>
                </div>
            </li>

            <li class="dropdown pr15 dropdown-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="avatar-xs avatar pull-left mt-5 mr10" >
                            <img alt="" src="{{getUserAvatar()}}">
                        </span> {{ auth()->user()->fullName  }} <span class="caret"></span></a>

                <ul class="dropdown-menu p0" role="menu">
                    <li class="divider"></li>

                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr10"></i> sign_out </a>
                        <form action="{{route('admin.auth.logout')}}" method="POST" id="logout-form">
                            {{csrf_field()}}
                        </form>
                    </li>

                </ul>
            </li>
        </ul>
    </div><!--/.nav-collapse -->
</nav>
