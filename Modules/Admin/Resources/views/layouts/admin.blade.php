@extends('admin::layouts.master')

@push('head')
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

@endpush


@section('content')

    @include('admin::navigations.top.top')

    <div id="content" class="box">

        <div id="sidebar" class="box-content ani-width">
            <div id="sidebar-scroll">
                <ul class="" id="sidebar-menu">
                    <li class="main">
                        <a href="{{route('admin.dashboard.index')}}">
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
                @yield('page')
            </div>
        </div>
    </div>

    @include('admin::modals.ajax-modal')
@endsection


@push('scripts')
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
@endpush

