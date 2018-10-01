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

