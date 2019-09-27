<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{general_settings('site_name')}} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('')}}/images/favicon.png" />
    <!-- Core css -->
    <link rel="stylesheet" id="bulma" href="{{asset('')}}/css/bulma.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('')}}/css/core.css">
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}/css/icons.min.css">
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <!-- Google fonts -->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Lato:300,400,700'>
</head>

<body>
<!-- Pageloader -->
<div class="pageloader"></div>
<div class="infraloader is-active"></div>

<!-- Wrapper -->
<div class="login-wrapper columns is-gapless">
    @yield('content')
</div>
<!-- /Wrapper -->

<!-- Core js -->
<script src="{{asset('')}}/js/core/jquery.min.js"></script>
<!-- Bulkit js -->
<script src="{{asset('')}}/js/main.js"></script>
<!-- Page specific js -->
<script src="{{asset('')}}/js/auth.js"></script>
</body>
</html>
