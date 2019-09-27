<!DOCTYPE html>
<html lang="en" id="parent">
    @include('layouts.partials.head')
    <body>
        <!-- Pageloader -->
        <div class="pageloader"></div>
        <div class="infraloader is-active"></div>

        <div id="app">
            @include('layouts.partials.navigation')

            @yield('content')
        </div>

        @include('layouts.partials.footer')

        @canViewControlMenu
        @include('layouts.partials.menu')
        @endcanViewControlMenu

        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>

        @include('layouts.partials.scripts')
    </body>
</html>
