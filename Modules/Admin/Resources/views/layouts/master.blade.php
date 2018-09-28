<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="klejdisjorgji">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" />
        <title>{{ env('APP_NAME') }}</title>

        <script type="text/javascript">
            AppHelper = {};
            AppHelper.baseUrl = "{{URL::to('/')}}";
            AppHelper.assetsDirectory = "{{URL::to('/public')}}";
            AppHelper.settings = {};
            AppHelper.settings.firstDayOfWeek = {{ Setting::get('app-first-day-of-week')  }} || 1;
            AppHelper.settings.currencySymbol = "$";
            AppHelper.settings.currencyPosition = "left";
            AppHelper.settings.decimalSeparator = '{{ Setting::get('app-decimal-separator')  }}' || '.';
            AppHelper.settings.thousandSeparator = '{{ Setting::get('app-thousands-separator')  }}' || ',';
            AppHelper.settings.displayLength = 25;
            AppHelper.settings.timeFormat = "small";
            AppHelper.settings.scrollbar = "jquery";
        </script>

        <script type="text/javascript">
            AppLanugage = {};
            AppLanugage.locale = "en";

            AppLanugage.days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
            AppLanugage.daysShort = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
            AppLanugage.daysMin = ["Su","Mo","Tu","We","Th","Fr","Sa"];

            AppLanugage.months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
            AppLanugage.monthsShort = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

            AppLanugage.today = "Today";
            AppLanugage.yesterday = "Yesterday";
            AppLanugage.tomorrow = "Tomorrow";

            AppLanugage.search = "Search";
            AppLanugage.noRecordFound = "No record found.";
            AppLanugage.print = "Print";
            AppLanugage.excel = "Excel";
            AppLanugage.printButtonTooltip = "Press escape when finished.";

            AppLanugage.fileUploadInstruction = "Drag-and-drop documents here <br /> (or click to browse...)";
            AppLanugage.fileNameTooLong = "Filename is too long.";

            AppLanugage.custom = "Custom";
            AppLanugage.clear = "Clear";
        </script>


        @php
        load_css(array(
            "js/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
            "admin/css/vendor.css",
            "admin/css/admin.css",
        ));
        load_js(array(
            "admin/js/vendor.js",
            "admin/js/admin.js",
        ));
        @endphp

        @stack('stylesheets')
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="fa fa-cog"></span>
                </button>
                <button id="sidebar-toggle" type="button" class="navbar-toggle"  data-target="#sidebar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href=""><img src="{{ $brand }}" /></a>
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
                            <img alt="..." src="">
                        </span> Test Test <span class="caret"></span></a>
                        <ul class="dropdown-menu p0" role="menu">
                            <li class="divider"></li>
                            <li><a href=""><i class="fa fa-power-off mr10"></i> sign_out </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </nav>

        <script type="text/javascript">
            $(document).ready(function () {
                //load message notifications
                var messageOptions = {},
                    notificationOptions = {},
                    $messageIcon = $("#message-notification-icon"),
                    $notificationIcon = $("#web-notification-icon");

                //check message notifications
                messageOptions.notificationUrl = "";
                messageOptions.notificationStatusUpdateUrl = "";
                messageOptions.checkNotificationAfterEvery = "";
                messageOptions.icon = "fa-envelope-o";
                messageOptions.notificationSelector = $messageIcon;
                checkNotifications(messageOptions);

                $messageIcon.click(function () {
                    checkNotifications(messageOptions, true);
                });


                //check web notifications
                notificationOptions.notificationUrl = "";
                notificationOptions.notificationStatusUpdateUrl = "";
                notificationOptions.checkNotificationAfterEvery = "";
                notificationOptions.icon = "fa-bell-o";
                notificationOptions.notificationSelector = $notificationIcon;

                checkNotifications(notificationOptions); //start checking notification after starting the message checking

                $notificationIcon.click(function () {
                    notificationOptions.notificationUrl = "";
                    checkNotifications(notificationOptions, true);
                });
            });
        </script>

        <div id="content" class="box">

            <div id="sidebar" class="box-content ani-width">
                <div id="sidebar-scroll">
                    <ul class="" id="sidebar-menu">
                        <li class="    main">
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="main">
                            <a href="{{route('admin.setting.index')}}">
                                <i class="fa fa-wrench"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- sidebar menu end -->

            <div id="page-container" class="box-content">

                <div id="pre-loader">
                    <div id="pre-loade" class="app-loader"><div class="loading"></div></div>
                </div>

                <div class="scrollable-page">
                    @yield('content')
                </div>
            </div>
        </div>

        <script type='text/javascript'>
            <?php
                $error_message = false;
                $success_message = false;

                if(Session::has('error_message')){ $error_message =   Session::get('error_message');}
                if(Session::has('success_message')){ $success_message =   Session::get('success_message');}

                if (isset($error)) {
                    echo 'appAlert.error("' . $error . '");';
                }
                if ($error_message) {
                    echo 'appAlert.error("' . $error_message . '");';
                }
                if ($success_message) {
                    echo 'appAlert.success("' . $success_message . '", {duration: 10000});';
                }
            ?>
        </script>
        @stack('jsScripts')
    </body>
</html>
