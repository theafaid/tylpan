@extends('layouts.app')

@section('title')
    About Us
@endsection

@section('description')

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/ggtooltip.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/wallop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/wallop--fade.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('js/slick.min.js')}}"></script>
    <script src="{{asset('js/ggtooltip.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/embed.js')}}"></script>
    <script src="{{asset('js/scrollreveal.min.js')}}"></script>@endpush

@section('content')
    <!-- Hero and nav -->
    <div class="hero hero-wavy is-relative is-theme-secondary">
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered huge-pb huge-pt">
                <div class="columns is-vcentered">
                    <div class="column is-4 hero-caption is-offset-4">
                        <h1 class="title big-landing-title text-bold is-2">
                            About {{general_settings('site_name')}}
                        </h1>
                        <h2 class="subtitle is-5 light-text pt-10 pb-10">
                            {{general_settings('site_description')}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->
    </div>
    <!-- /Hero and nav -->

    <!-- Founders section -->
    <section class="section is-medium no-padding-bottom">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <div class="bg-number">1</div>
                <h2 class="title section-title has-text-centered dark-text">First travel </h2>
                <div class="subtitle has-text-centered is-tablet-padded">Our company started with a brilliant but simple idea, give you insight on whatever you want. </div>
            </div>

            <div class="content-wrapper">
                <div class="columns">
                    <!-- Content -->
                    <div class="column is-4 is-offset-1 pt-80 pb-80 mobile-padding-20">
                        <div class="icon-subtitle"><i class="im im-icon-Speak"></i></div>
                        <h2 class="title section-subtitle dark-text text-bold is-2">
                            A word from John Morris and Anna Kowalsky
                        </h2>
                        <span class="section-feature-description">Lorem ipsum dolor sit amet, clita laoreet ne cum. His cu harum inermis iudicabit. Ex vidit fierent hendrerit eum, sed stet periculis ut. Vis in probo decore labitur. Unum simul an vis, tale patrioque eos ad, dicunt percipit ea nam. </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Founders section -->

    <!-- Card section -->
    <section class="section section-feature-grey is-medium">
        <div class="container">
            <div class="columns values-cards is-minimal is-vcentered is-gapless is-multiline">
                <!-- Card -->
                <div class="column">
                    <div class="feature-card card-md hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Headset"></i>
                        </div>
                        <div class="card-title">
                            <h4>24/7 Support</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">Lorem ipsum dolor sit amet, clita laoreet ne cum. His caelus elet cu harum inermis iudicabit.</span>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card card-md hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Big-Data"></i>
                        </div>
                        <div class="card-title">
                            <h4>99,9% Availability</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">Lorem ipsum dolor sit amet, clita laoreet ne cum. His caelus elet cu harum inermis iudicabit.</span>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card card-md hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Diploma-2"></i>
                        </div>
                        <div class="card-title">
                            <h4>Training sessions</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">Lorem ipsum dolor sit amet, clita laoreet ne cum. His caelus elet cu harum inermis iudicabit.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="has-text-centered pt-40 pb-40 is-title-reveal">
                <a class="button button-cta is-bold btn-align primary-btn btn-outlined rounded">Start your Free trial</a>
            </div>
        </div>
    </section>
    <!-- /Card section -->

    <!-- Team section -->
    <section class="section is-medium">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <div class="bg-number">2</div>
                <h2 class="title section-title has-text-centered dark-text"> Meet the Team</h2>
                <div class="subtitle has-text-centered is-tablet-padded">
                    Our team is made of IT professionnals and business specialists, the perfect recipe for success.
                </div>
            </div>
            <!-- Title -->

            <div class="content-wrapper">
                <div class="modern-team startup-team">
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask zoom-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-stack-overflow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Mike <strong>Connors</strong></h3>
                            <span class="member-position">CTO</span>
                        </div>
                    </article>
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask rotate-zoom-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-skype"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Janet <strong>Crowe</strong></h3>
                            <span class="member-position">Business Analyst</span>
                        </div>
                    </article>
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask zoom-slide-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-skype"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Joshua <strong>Stevens</strong></h3>
                            <span class="member-position">BI consultant</span>
                        </div>
                    </article>
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask zoom-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-skype"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Kendra <strong>Wallace</strong></h3>
                            <span class="member-position">Head of Sales</span>
                        </div>
                    </article>
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask zoom-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-stack-overflow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Adam <strong>Bennings</strong></h3>
                            <span class="member-position">Software Engineer</span>
                        </div>
                    </article>
                    <!-- Team member -->
                    <article class="modern-team-item circle-mask zoom-effect">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <img src="https://place-hold.it/529x643" class="member-avatar" alt="">
                            </div>
                            <div class="overlay-wrapper">
                                <div>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-twitter"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-linkedin"></i>
                                    </a>
                                    <a href="#0" class="social">
                                        <i class="social-icon fa fa-stack-overflow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Cassandra <strong>Heiss</strong></h3>
                            <span class="member-position">Support Engineer</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- /Team section -->

    <!-- Counters section -->
    <section class="section is-medium parallax is-cover is-relative" data-background="https://place-hold.it/1920x1077" data-color="#000" data-color-opacity="0.7">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <div class="bg-number">3</div>
                <h2 class="title section-title has-text-centered light-text">Some of Our Statistics</h2>
            </div>
            <!-- Title -->

            @php
            $countries = resolve(\App\Caching\Countries::class);
            @endphp
            <!-- Counters -->
            <div class="content-wrapper">
                <div class="columns is-vcentered has-text-centered">
                    <div class="column is-4">
                        <div class="parallax-counter is-primary">
                            <div class="counter-icon">
                                <i class="im im-icon-Globe"></i>
                            </div>
                            <div class="counter counter-number text-bold">{{count($countries->allowedTravelFrom())}}</div>
                            <div class="counter-text">Country you can travel from</div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="parallax-counter is-primary">
                            <div class="counter-icon">
                                <i class="im im-icon-Business-Man"></i>
                            </div>
                            <div class="counter counter-number text-bold">{{count($countries->allowedTravelTo())}}</div>
                            <div class="counter-text">Country you can travel to</div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="parallax-counter is-primary">
                            <div class="counter-icon">
                                <i class="im im-icon-Business-Mens"></i>
                            </div>
                            <div class="counter counter-number text-bold">923</div>
                            <div class="counter-text">Teams</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Counters -->
        </div>
    </section>
    <!-- /Counters section -->

    <!-- Vertical Testimonials section -->
    <section class="section is-medium">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <div class="bg-number">4</div>
                <h2 class="title section-title has-text-centered dark-text"> We are top rated</h2>
                <div class="subtitle has-text-centered is-tablet-padded">
                    Just take a look at what our clients say about us. We thank them a lot for top ranking us and for using our solutions.
                </div>
            </div>
            <!-- Title -->
            <div class="columns">
                <div class="column is-8 is-offset-2 is-12-mobile">
                    <!-- Vertical testimonials -->
                    <div class="vertical-testimonials">
                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <h6 class="vt-name">Marjory Cambell</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->

                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <h6 class="vt-name">Terry Daniels</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae vel no, ne sonet.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->

                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h6 class="vt-name">Helen Miller</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae vel no.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->

                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <h6 class="vt-name">Kareem Jabbar</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae vel no, ne sonet viderer vis.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->

                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <h6 class="vt-name">Jeffrey Sikes</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae vel no, ne sonet viderer vis. Iisque forensibus.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->

                        <!-- Testimonial item -->
                        <div class="flex-card vtestimonial-item light-bordered padding-20">
                            <div class="content content-flex">
                                <img class="vt-avatar is-hidden-mobile" src="https://place-hold.it/250x250" alt="">
                                <div class="vt-content">
                                    <div class="star-rating color-secondary is-hidden-mobile">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h6 class="vt-name">Sally Jenkins</h6>
                                    <div class="vt-text">
                                        Lorem ipsum dolor sit amet, ex vis laoreet perfecto insolens. Pericula repudiandae vel no, ne sonet viderer vis. Iisque forensibus.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Testimonial item -->
                    </div>
                    <!-- Vertical testimonials -->
                </div>
            </div>
        </div>
    </section>
    <!-- Vertical Testimonials section -->

    <!-- Clients -->
    <section id="trust" class="section section-feature-grey is-medium">
        <div class="container">
            <div class="section-title-wrapper">
                <div class="bg-number"><i class="material-icons is-gigantic">domain</i></div>
                <h2 class="title section-title has-text-centered dark-text"> We build Trust.</h2>
                <div class="subtitle has-text-centered">More than <b>900 Teams</b> use our product.</div>
            </div>

            <!-- Grid -->
            <div class="content-wrapper">
                <div class="grid-clients five-grid">
                    <div class="columns is-vcentered">
                        <div class="column"></div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/gutwork.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/phasekit.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/grubspot.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/taskbot.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/systek.svg" alt=""></a>
                        </div>
                        <div class="column"></div>
                    </div>
                    <div class="columns is-vcentered is-separator">
                        <div class="column"></div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/infinite.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/tribe.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/powerball.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/kromo.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/covenant.svg" alt=""></a>
                        </div>
                        <div class="column"></div>
                    </div>
                    <div class="columns is-vcentered is-separator">
                        <div class="column"></div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/bitbreaker.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/evently.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/proactive.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/transfuseio.svg" alt=""></a>
                        </div>
                        <!-- Client -->
                        <div class="column">
                            <a><img class="client" src="/images/logos/custom/livetalk.svg" alt=""></a>
                        </div>
                        <div class="column"></div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="has-text-centered pt-60 pb-60">
                    <a href="landing-v3-pricing.html" class="button button-cta btn-align primary-btn raised rounded is-title-reveal">Get started Now</a>
                </div>
                <!-- /CTA -->
            </div>
            <!-- /Grid -->
        </div>
    </section>
    <!-- Clients -->
@endsection
