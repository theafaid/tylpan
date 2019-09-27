<!-- Side navigation -->
<div class="side-navigation-menu">
    <!-- Categories menu -->
    <div class="category-menu-wrapper">
        <!-- Menu -->
        <ul class="categories">

            <li class="square-logo">
                <a href="{{route('admin.dashboard.index')}}"><img src="{{additional_settings('site_icon')}}"></a>
            </li>
            <li class="category-link is-active" data-navigation-menu="orders"><i class="sl sl-icon-bag"></i></li>
            @superAdmin
            <li class="category-link" data-navigation-menu="users"><i class="sl sl-icon-people"></i></li>
            <li class="category-link" data-navigation-menu="countries"><i class="sl sl-icon-globe"></i></li>
            <li class="category-link" data-navigation-menu="universities"><i class="sl sl-icon-graduation"></i></li>
            <li class="category-link" data-navigation-menu="settings"><i class="sl sl-icon-wrench"></i></li>
            @endsuperAdmin
        </ul>
        <!-- Menu -->

        <ul class="author">
            <li>
                <!-- Theme author -->
                <a href="javascript:void(0);">
                    <img class="main-menu-author" src="{{asset('')}}/images/logos/cssninja.svg" alt="">
                </a>
            </li>
        </ul>
    </div>
    <!-- /Categories menu -->

    <!-- Navigation menu -->
    <div id="orders" class="navigation-menu-wrapper animated preFadeInRight fadeInRight is-hidden">
        <!-- Navigation Header -->
        <div class="navigation-menu-header">
            <span>Orders</span>
            <a class="ml-auto hamburger-btn navigation-close" href="javascript:void(0);">
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
        </div>
        <!-- Navigation body -->
        <ul class="navigation-menu">
            <li>
                <a class="is-submenu" href="{{route('admin.orders.index')}}">View All Orders</a>
            </li>
        </ul>
    </div>
    <!-- /Navigation menu -->

    <!-- Navigation menu -->
    <div id="users" class="navigation-menu-wrapper animated preFadeInRight fadeInRight is-hidden">
        <!-- Navigation Header -->
        <div class="navigation-menu-header">
            <span>Users</span>
            <a class="ml-auto hamburger-btn navigation-close" href="javascript:void(0);">
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
        </div>
        <!-- Navigation body -->
        <ul class="navigation-menu">
            <li>
                <a class="is-submenu" href="{{route('admin.users.index')}}">View All Users</a>
            </li>
            <li>
                <a class="is-submenu" href="{{route('admin.users.create')}}">Add User</a>
            </li>
        </ul>
    </div>
    <!-- /Navigation menu -->

    <!-- Navigation menu -->
    <div id="countries" class="navigation-menu-wrapper animated preFadeInRight fadeInRight is-hidden">
        <!-- Navigation Header -->
        <div class="navigation-menu-header">
            <span>Countries</span>
            <a class="ml-auto hamburger-btn navigation-close" href="javascript:void(0);">
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
        </div>
        <!-- Navigation body -->
        <ul class="navigation-menu">
            <li>
                <a class="is-submenu" href="{{route('admin.countries.index')}}">View All Countries</a>
            </li>
        </ul>
    </div>
    <!-- /Navigation menu -->

    <!-- Navigation menu -->
    <div id="universities" class="navigation-menu-wrapper animated preFadeInRight fadeInRight is-hidden">
        <!-- Navigation Header -->
        <div class="navigation-menu-header">
            <span>Universities</span>
            <a class="ml-auto hamburger-btn navigation-close" href="javascript:void(0);">
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
        </div>
        <!-- Navigation body -->
        <ul class="navigation-menu">
            <li>
                <a class="is-submenu" href="{{route('admin.universities.index')}}">View All Universities</a>
                <a class="is-submenu" href="{{route('admin.universities.create')}}">Add a University</a>
            </li>
        </ul>
    </div>
    <!-- /Navigation menu -->

    <!-- Navigation menu -->
    <div id="settings" class="navigation-menu-wrapper animated preFadeInRight fadeInRight is-hidden">
        <!-- Navigation Header -->
        <div class="navigation-menu-header">
            <span>Settings</span>
            <a class="ml-auto hamburger-btn navigation-close" href="javascript:void(0);">
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
        </div>
        <!-- Navigation body -->
        <ul class="navigation-menu">
            <li>
                <a class="is-submenu" href="{{route('admin.settings')}}">Site Settings</a>
            </li>
            <li>
                <a class="is-submenu" href="{{route('admin.features.index')}}">Features</a>
            </li>
            <li>
                <a class="is-submenu" href="{{route('admin.features.create')}}">Add Site Feature</a>
            </li>
        </ul>
    </div>
    <!-- /Navigation menu -->
</div>
<!-- /Side navigation -->
