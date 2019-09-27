<!-- Form section -->
<div class="column is-5">
    <div class="hero is-fullheight">
        <!-- Header -->
        <div class="hero-heading">
            <div class="section intro-section has-text-centered">
                <a href="{{route('welcome')}}"><img class="top-logo" src="{{additional_settings('site_logo')}}"></a>
            </div>
        </div>
        <!-- Body -->
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        {{$form}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Form section -->

<!-- Image section (hidden on mobile) -->
<div class="column login-column is-7 is-hidden-mobile hero-banner">
    <div class="hero signup-hero is-fullheight is-theme-primary is-relative" style="background-image: url({{additional_settings('default_page_background')}}); background-size: 100% 100%">
        <div class="columns has-text-centered">
            <div class="column">
                {{$pageDescription}}
                <!-- Link to login page -->
                <div class="already">
                    {{$switcher}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Image section -->
