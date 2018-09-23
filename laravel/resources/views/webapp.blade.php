<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Loading……</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css/normalize.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css"> -->
        <link rel="stylesheet" href="{{ mix('/static/css/webapp.css') }}">
        <link rel="stylesheet" href="//at.alicdn.com/t/font_722028_ye18nxb2t7.css">
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ mix('/static/js/webapp.js') }}"></script>
    </body>
</html>