@push('styles')
    <style>
        .notifications-drop {
            width: 500px;
        }

        .notifications-drop li {
            width: 100%;
        }
    </style>
@endpush
<!-- Hero and nav -->
<div class="hero is-medium is-relative ">
    <div class="navbar-wrapper navbar-fade">
        <div class="hero-head">

            <!-- Nav -->
            <div class="container">
                <nav class="nav">
                    <div class="container big">
                        <div class="nav-left">
                            <a class="nav-item" href="{{route('welcome')}}">
                                <img src="{{additional_settings('site_logo')}}">
                            </a>

                            @canViewControlMenu
                            <!-- Sidebar trigger -->
                            <a id="navigation-trigger" class="nav-item hamburger-btn" href="javascript:void(0);">
                                    <span class="menu-toggle">
                                        <span class="icon-box-toggle">
                                            <span class="rotate">
                                                <i class="icon-line-top"></i>
                                                <i class="icon-line-center"></i>
                                                <i class="icon-line-bottom"></i>
                                            </span>
                                        </span>
                                    </span>
                            </a>
                            @endcanViewControlMenu
                            <a href="{{route('countries.index')}}" class="nav-item is-tab nav-inner is-not-mobile">
                                Countries
                            </a>
                            <a href="{{route('how_to_start')}}" class="nav-item is-tab nav-inner is-not-mobile">
                                How to start
                            </a>
                            <a href="{{route('about')}}" class="nav-item is-tab nav-inner is-not-mobile">
                                About
                            </a>
                        </div>
                        <!-- Responsive toggle -->
                        <span class="nav-toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="nav-right nav-menu">
                            <a href="landing-v3-help.html" class="nav-item is-tab nav-inner is-menu-mobile">
                                How to start
                            </a>
                            <a href="{{route('countries.index')}}" class="nav-item is-tab nav-inner is-menu-mobile">
                                Countries and Universities
                            </a>
                            <a href="landing-v3-pricing.html" class="nav-item is-tab nav-inner is-menu-mobile">
                                About us
                            </a>
                            <span class="nav-item">
                                @auth
                                    <a id="signup-btn" href="{{route('orders.create')}}" class="button btn-outlined info-btn">
                                        <i class="sl sl-icon-plane"></i> Create An Order
                                    </a>



                                    <notifications :data="{{$notifications}}"></notifications>

                                    <div class="button is-drop">
{{--                                        <img src="{{auth()->user()->profile->avatar}}" />--}}
                                        {{auth()->user()->defaultName}}
                                        <i class="sl sl-icon-arrow-down is-icon-xs"></i>
                                        <div class="dropContain">
                                            <div class="dropOut">
                                                <ul>
                                                    <li>
                                                        <a href="{{route('orders.index')}}">
                                                            <i class="drop-icon sl sl-icon-list"></i> My Orders
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('profile.index')}}">
                                                            <i class="drop-icon sl sl-icon-user"></i> My Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('logout')}}"><i class="drop-icon sl sl-icon-power"></i> Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a id="signup-btn" href="{{route('login')}}" class="button button-signup btn-outlined is-bold btn-align success-btn rounded">
                                            <i class="sl sl-icon-login"></i> Login
                                    </a>
                                    <a id="signup-btn" href="{{route('register')}}" class="button button-signup btn-outlined is-bold btn-align primary-btn rounded">
                                        <i class="sl sl-icon-user-follow"></i> Join to {{general_settings('site_name')}}
                                    </a>
                                @endauth

                        </span>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- /Nav -->

        </div>
    </div>
</div>
<!-- /Hero and nav -->


