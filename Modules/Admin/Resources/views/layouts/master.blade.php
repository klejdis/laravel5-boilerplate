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
            AppHelper.settings.firstDayOfWeek = 0;
            AppHelper.settings.currencySymbol = "$";
            AppHelper.settings.currencyPosition = "left";
            AppHelper.settings.decimalSeparator = ".";
            AppHelper.settings.thousandSeparator = ",";
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

        <?php
        load_css(array(
            "bootstrap/css/bootstrap.min.css",
            "js/font-awesome/css/font-awesome.min.css",
            "js/datatable/css/jquery.dataTables.min.css",
            "js/datatable/TableTools/css/dataTables.tableTools.min.css",
            "js/select2/select2.css",
            "js/select2/select2-bootstrap.min.css",
            "js/bootstrap-datepicker/css/datepicker3.css",
            "js/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
            "js/x-editable/css/bootstrap-editable.css",
            "js/dropzone/dropzone.min.css",
            "js/magnific-popup/magnific-popup.css",
            "js/malihu-custom-scrollbar/jquery.mCustomScrollbar.min.css",
            "js/awesomplete/awesomplete.css",
            "css/font.css",
            "css/style.css",
            "css/custom-style.css",
        ));
        load_js(array(
            "js/jquery-1.11.3.min.js",
            "bootstrap/js/bootstrap.min.js",
            "js/jquery-validation/jquery.validate.min.js",
            "js/jquery-validation/jquery.form.js",
            "js/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js",
            "js/datatable/js/jquery.dataTables.min.js",
            "js/select2/select2.js",
            "js/datatable/TableTools/js/dataTables.tableTools.min.js",
            "js/bootstrap-datepicker/js/bootstrap-datepicker.js",
            "js/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
            "js/x-editable/js/bootstrap-editable.min.js",
            "js/fullcalendar/moment.min.js",
            "js/dropzone/dropzone.min.js",
            "js/magnific-popup/jquery.magnific-popup.min.js",
            "js/notificatoin_handler.js",
            "js/general_helper.js",
            "js/app.js"
        ));
        ?>

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
                <a class="navbar-brand" href=""><img src="" /></a>
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
                            <a href="#">
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
