<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{additional_settings('site_icon')}}"/>
    <title>{{general_settings('site_name')}} - @yield('title')</title>
    <meta name="description" content="{{isset($description) ? $description : general_settings('site_description')}}">
    <link rel="icon" type="image/png" href="{{general_settings('site_icon')}}"/>
    <!-- Core css -->
    <link rel="stylesheet" id="bulma" href="{{asset('css/bulma.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/core.css')}}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('css/icons.min.css')}}">
    <!-- Custom -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @stack('styles')
    <script>
        @auth
            window.User = {!! json_encode([
                'id' => auth()->user()->id,
                'name' => auth()->user()->fullName,
                'type' => auth()->user()->role,
                'avatar' => auth()->user()->profile->avatar,
            ]) !!}
        @endauth
    </script>
</head>
