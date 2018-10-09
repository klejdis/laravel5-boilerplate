<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="klejdisjorgji">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>

        @stack('head')

        @stack('stylesheets')
    </head>
    <body>
        @yield('content')

        @stack('scripts')
    </body>
</html>
