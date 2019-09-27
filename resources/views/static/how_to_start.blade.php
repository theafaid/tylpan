@extends('layouts.app')

@section('title')
    How to start {{general_settings('site_name')}}
@endsection

@push('scripts')
    <!-- Plugins js -->
    <script src="{{asset('js/embed.js')}}"></script>
@endpush

@php
$description = "Here you will learn how to start with using " . general_settings('site_name') . '.Feel Free to contact us any time.';
@endphp

@section('content')
    <!-- Hero and nav -->
    <div class="hero hero-wavy is-relative is-theme-secondary huge-pb huge-pt">
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered is-fullheight">
                <div class="columns is-vcentered">
                    <div class="column is-4 hero-caption is-offset-4">
                        <h1 class="title big-landing-title text-bold is-2">
                            How to start with {{general_settings('site_name')}} ?
                        </h1>
                        <h2 class="subtitle is-5 light-text pt-10 pb-10">
                            It's very easy, fast, interesting. Just read the description below.
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->
    </div>
    <!-- /Hero and nav -->

    <!-- Feature -->
    <section class="section is-medium section-feature-grey">
        <div class="container">
            <div class="columns is-vcentered">
                <!-- With the help of responsive modifiers, the text column is duplicated to ensure better readability both on desktop and mobile viewports -->
                <div class="column is-4 is-offset-1 is-hidden-desktop is-hidden-tablet">
                    <div class="icon-subtitle"><i class="sl sl-icon-user-follow"></i></div>
                    <h2 class="quick-feature">
                        <strong>First of all, You have to have an account.</strong>
                    </h2>
                    <div class="title-divider"></div>
                    <span class="section-feature-description">
                        You can create an account from <a href="{{route('register')}}">Here.</a>
                        By registering, you will be able to create order to travel for studying in any countries that we provide.
                        <small>
                            <a href="{{route('countries.index')}}">See: Allowed Countries</a>
                        </small>
                    </span>
                </div>

                <div class="column is-6 has-text-centered">
                    <!-- Featured illustration -->
                    <img class="featured-svg levitate" src="{{asset('images/registering-pic.png')}}">
                    <!-- /Featured illustration -->
                </div>

                <div class="column is-4 is-offset-1 is-hidden-mobile">
                    <div class="icon-subtitle"><i class="sl sl-icon-user-follow"></i></div>
                    <h2 class="quick-feature">
                        <strong>First of all, You have to have an account.</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                         You can create an account from <a href="{{route('register')}}">Here.</a>
                        By registering, you will be able to create order to travel for studying in any countries that we provide.
                        <small>
                            <a href="{{route('countries.index')}}">See: Allowed Countries</a>
                        </small>
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- /Feature -->

    <!-- Feature -->
    <section class="section is-medium">
        <div class="container">
            <div class="columns is-vcentered">

                <div class="column is-4 is-offset-2">
                    <div class="icon-subtitle"><i class="sl sl-icon-check"></i></div>
                    <h2 class="quick-feature">
                        <strong>Complete you profile</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                        It's time to enter details about you. You must provide some required personal and education details. Also you can provide more details
                        like your skills, speaking languages,..<br>
                        All of this information will help us to know who are you.
                    </span>

                </div>

                <div class="column is-6 has-text-centered">
                    <!-- Featured illustration -->
                    <img class="featured-svg levitate" src="{{asset('')}}/images/illustrations/mockups/landing2/customers.png" alt="">
                    <!-- /Featured illustration -->
                </div>
            </div>
        </div>
    </section>
    <!-- /Feature -->

    <!-- Feature -->
    <section class="section is-medium section-feature-grey">
        <div class="container">
            <div class="columns is-vcentered">

                <!-- With the help of responsive modifiers, the text column is duplicated to ensure better readability both on desktop and mobile viewports -->
                <div class="column is-4 is-offset-1 is-hidden-desktop is-hidden-tablet">
                    <div class="icon-subtitle"><i class="sl sl-icon-plane"></i></div>
                    <h2 class="quick-feature">
                        <strong>Not it's time to create your traveling order.</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                        You choose one of our provided countries, and the universities ordered according to your priority.
                        After selecting the country and university you will tell us what you want to learn/continue learning there according to your priority also.
                    </span>
                </div>

                <div class="column is-6 has-text-centered">
                    <!-- Featured illustration -->
                    <img class="featured-svg levitate" src="{{asset('images/create-order-pic.png')}}">
                    <!-- /Featured illustration -->
                </div>

                <div class="column is-4 is-offset-1 is-hidden-mobile">
                    <div class="icon-subtitle"><i class="sl sl-icon-globe"></i></div>
                    <h2 class="quick-feature">
                        <strong>Not it's time to create your traveling order.</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                        You choose one of our provided countries, and the universities ordered according to your priority.
                        After selecting the country and university you will tell us what you want to learn/continue learning there according to your priority also.
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- /Feature -->

    <!-- Feature -->
    <section class="section is-medium">
        <div class="container">
            <div class="columns is-vcentered">

                <!-- With the help of responsive modifiers, the text column is duplicated to ensure better readability both on desktop and mobile viewports -->
                <div class="column is-4 is-offset-1 is-hidden-desktop is-hidden-tablet">
                    <div class="icon-subtitle"><i class="sl sl-icon-call-in"></i></div>
                    <h2 class="quick-feature">
                        <strong>Wait until we read your entered information and assign a delegate for you.</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                        We will read your information and then we will choose a delegate in your country for helping until you traveled successfully and went to the chosen university.
                        The delegate will help you with anything that we want from you, He/She will tell you anything you miss.
                    </span>
                </div>

                <div class="column is-6 has-text-centered">
                    <!-- Featured illustration -->
                    <img class="featured-svg levitate" src="{{asset('images/chat-pic.png')}}">
                    <!-- /Featured illustration -->
                </div>

                <div class="column is-4 is-offset-1 is-hidden-mobile">
                    <div class="icon-subtitle"><i class="sl sl-icon-call-in"></i></div>
                    <h2 class="quick-feature">
                        <strong>Wait until we read your entered information and assign a delegate for you.</strong>
                    </h2>
                    <div class="title-divider is-small"></div>
                    <span class="section-feature-description">
                        We will read your information and then we will choose a delegate in your country for helping until you traveled successfully and went to the chosen university.
                        The delegate will help you with anything that we want from you, He/She will tell you anything you miss.<br>
                        You can meet the delegate in your country or contact him with phone or even chat with him right here.
                    </span>
                </div>
            </div>
            <div class="has-text-centered is-title-reveal pt-40 pb-40">
                <a class="button button-cta btn-align primary-btn rounded" href="{{route('orders.create')}}">Get Started</a>
            </div>
        </div>
    </section>
    <!-- /Feature -->

    @if(additional_settings('site_video_url'))
        <!-- Video CTA -->
        <section class="section is-cover section-secondary is-large is-relative">
            <div class="columns is-vcentered">
                <div class="column is-4 is-offset-2">
                    <!-- Video -->
                    <div class="side-block">
                        <div class="background-wrapper">
                            <div id="video-embed" class="video-wrapper" data-url="{{additional_settings('site_video_url')}}">
                                <div class="video-overlay"></div>
                                <div class="playbutton">
                                    <div class="icon-play">
                                        <i class="sl sl-icon-control-play"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CTA -->
                </div>

                <div class="column is-4">
                    <div class="content padding-20">
                        <div class="has-text-centered">
                            <span class="video-link has-text-centered button primary-btn rounded is-large button-cta">
                                <i class="fa fa-play"></i> <span>Learn how to start & use {{general_settings('site_name')}}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Video CTA -->
    @endif
@endsection
