@extends('layouts.app')

@section('title')
Welcome
@endsection

@push('styles')
    <link rel="stylesheet"  href="{{asset('css/wallop.css')}}">
    <link rel="stylesheet"  href="{{asset('css/wallop--scale.css')}}">
@endpush

@push('scripts')
<!-- Plugins js -->
<script src="{{asset('js/embed.js')}}"></script>
<script src="{{asset('js/components-modals.js')}}"></script>
@endpush

@section('content')
    <!-- Video modal -->
    <div id="video-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="side-block is-title-reveal">
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
        </div>
        <button class="modal-close is-large is-hidden stop-video" aria-label="close"></button>
    </div>
    <!-- Basic modal -->

    <!-- Hero and nav -->
    <div class="hero is-cover is-relative is-fullheight is-default is-bold">
        <!-- Hero Wallop Slider -->
        <div class="Wallop Wallop--fade">
            <div class="Wallop-list">
                <!-- Slide -->
                <div class="Wallop-item Wallop-item--current has-background-image" data-background="{{additional_settings('default_page_background')}}">
                    <div class="Wallop-overlay"></div>
                    <div class="Wallop-caption-wrapper">
                        <div class="container">
                            <div class="columns is-gapless is-vcentered">
                                <div class="column is-5">
                                    <div class="caption-inner">
                                        <h1>{{general_settings('site_name')}}</h1>
                                        <div class="caption-divider"></div>
                                        <div class="caption-text">
                                            <span>{{general_settings('site_description')}}</span>
                                            <div class="action" style="min-width: 500px;">

                                                <a href="#services" class="button primary-btn rounded is-medium">
                                                     Get started now
                                                </a>
                                                <a href="#" class="button danger-btn rounded is-medium">
                                                    <span class="video-link modal-trigger" data-modal="video-modal">
                                                        <span>See how it works</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero Wallop Slider -->
    </div>
    <!-- /Hero and nav -->

    <!-- Services -->
    <section id="services" class="section is-medium">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <div class="bg-number"></div>
                <h2 class="title section-title has-text-centered dark-text">What we do</h2>
                <div class="subtitle has-text-centered is-tablet-padded">
                    We are a traveling agency.
                </div>
            </div>

            <div class="content-wrapper">
                <div class="columns is-vcentered is-multiline has-text-centered">
                    <!-- Icon block -->
                    <div class="column is-3">
                        <div class="startup-icon-box">
                            <div class="is-icon-reveal">
                                <i class="sl sl-icon-plane"></i>
                            </div>
                            <div class="box-title">Travel for Education</div>
                            <p class="box-content is-tablet-padded">
                                If you are studying now or graduated and you want to continue studying outside in Europe or what ever, So this is the best place for you.
                            </p>
                        </div>
                    </div>
                    <!-- Icon block -->
                    <div class="column is-3">
                        <div class="startup-icon-box">
                            <div class="is-icon-reveal">
                                <i class="sl sl-icon-home"></i>
                            </div>
                            <div class="box-title">Apply your Application</div>
                            <p class="box-content is-tablet-padded">
                                We will apply your application to your selected university.
                                For example you want to study in russia, so we are there and doing all the job for you after create you order.
                            </p>
                        </div>
                    </div>
                    <!-- Icon block -->
                    <div class="column is-3">
                        <div class="startup-icon-box">
                            <div class="is-icon-reveal">
                                <i class="sl sl-icon-check"></i>
                            </div>
                            <div class="box-title">Do all the job for you.</div>
                            <p class="box-content is-tablet-padded">
                                We will do all the job for you, from collecting your information and apply you application to your favourite
                                university to get the travel approval.
                            </p>
                        </div>
                    </div>
                    <!-- Icon block -->
                    <div class="column is-3">
                        <div class="startup-icon-box">
                            <div class="is-icon-reveal">
                                <i class="sl sl-icon-people"></i>
                            </div>
                            <div class="box-title">Take care of you</div>
                            <p class="box-content is-tablet-padded">
                                It not just about taking the approval to travel, but you will also joined to our community there. We will help you to contact with other registered friends there.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="has-text-centered is-title-reveal pt-20 pb-20">
                    <a href="{{route('about')}}" class="button button-cta secondary-btn rounded raised">See More</a>
                    <a href="{{route('orders.create')}}" class="button button-cta info-btn rounded raised">Create Order</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Services -->

    <!-- Feature highlight -->
    <div class="section section-feature-grey is-medium">
        <div class="container">
            <!-- Title -->
            <div class="section-title-wrapper">
                <h2 class="title section-title has-text-centered dark-text">What makes {{general_settings('site_name')}} Fascinating ?</h2>
            </div>
            <div class="content-wrapper">
                @foreach(features() as $index => $feature)
                    @if($index % 2 == 0)
                        <!-- Feature -->
                            <div class="columns is-vcentered">
                                <!-- Featured image -->
                                <div class="column is-7 has-text-centered is-hidden-desktop is-hidden-tablet">
                                    <img class="featured-svg" src="{{$feature['image']}}" alt="">
                                </div>

                                <!-- Content -->
                                <div class="column is-5 has-text-right">
                                    <h2 class="title feature-title bordered dark-text">{{$feature['title']}}</h2>
                                    <div class="title-divider is-right"></div>
                                    <span class="section-feature-description">{{$feature['description']}}</span>
                                </div>

                                <div class="column is-7 has-text-centered is-hidden-mobile">
                                    <!-- Featured image (this is a mobile only image to make feature alternate properly on small screens) -->
                                    <img class="featured-svg" src="{{$feature['image']}}" alt="">
                                </div>
                            </div>
                            <!-- /Feature -->
                    @else
                        <!-- Feature -->
                            <div class="columns is-vcentered">
                                <!-- Featured image -->
                                <div class="column is-7 has-text-centered">
                                    <img class="featured-svg" src="{{$feature['image']}}" alt="">
                                </div>

                                <!-- Content -->
                                <div class="column is-5">
                                    <h2 class="title feature-title bordered dark-text">{{$feature['title']}}</h2>
                                    <div class="title-divider"></div>
                                    <span class="section-feature-description">{{$feature['description']}}</span>
                                </div>
                            </div>
                            <!-- /Feature -->
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Feature highlight -->

    <!-- Mockup section -->
    <section class="section section-light-grey is-medium">
        <div class="container">
            <div class="section-title-wrapper">
                <h2 class="title section-title has-text-centered dark-text"> We build Trust.</h2>
                <div class="subtitle has-text-centered">Make sure that we will do all the best.</div>
            </div>
            <div class="content-wrapper">
                <!-- Mockup / Video switcher -->
                <div class="has-text-centered">
                    <a href="#" class="button primary-btn rounded is-large button-cta">
                        <span class="video-link has-text-centered modal-trigger" data-modal="video-modal">
                            <i class="fa fa-play"></i> <span>Learn how to start & use {{general_settings('site_name')}}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Mockup section -->

{{--    <!-- Static Testimonials -->--}}
{{--    <section id="card-testimonials" class="section parallax is-relative is-medium" data-background="" data-color="#000" data-color-opacity="0.0">--}}
{{--        <div class="container">--}}
{{--            <!-- Title -->--}}
{{--            <div class="section-title-wrapper">--}}
{{--                <div class="bg-number">7</div>--}}
{{--                <h2 class="title section-title has-text-centered dark-text"> Our clients love us</h2>--}}
{{--                <div class="subtitle has-text-centered is-tablet-padded">--}}
{{--                    Just take a look at what our clients say about us. We thank them a lot for top ranking us and for using our solutions.--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="content-wrapper">--}}
{{--                <div class="columns is-vcentered">--}}
{{--                    <div class="column"></div>--}}
{{--                    <div class="column is-10">--}}
{{--                        <!-- Testimonials -->--}}
{{--                        <div class="columns is-vcentered">--}}
{{--                            <div class="column is-6">--}}
{{--                                <!-- Testimonial item -->--}}
{{--                                <div class="flex-card testimonial-card light-bordered light-raised padding-20">--}}
{{--                                    <div class="testimonial-title">--}}
{{--                                        Amazed by the product--}}
{{--                                    </div>--}}
{{--                                    <div class="testimonial-text">--}}
{{--                                        Lorem ipsum dolor sit amet, vim quidam blandit voluptaria no, has eu lorem convenire incorrupte. Vis mutat altera percipit ad.--}}
{{--                                    </div>--}}
{{--                                    <div class="user-id">--}}
{{--                                        <img class="" src="https://place-hold.it/250x250" alt="">--}}
{{--                                        <div class="info">--}}
{{--                                            <div class="name">Dan Shwartz</div>--}}
{{--                                            <div class="position">Software engineer</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- Testimonial item -->--}}
{{--                                <div class="flex-card testimonial-card light-bordered light-raised padding-20">--}}
{{--                                    <div class="testimonial-title">--}}
{{--                                        My tasks are now painless--}}
{{--                                    </div>--}}
{{--                                    <div class="testimonial-text">--}}
{{--                                        Lorem ipsum dolor sit amet, vim quidam blandit voluptaria no, has eu lorem convenire incorrupte. Vis mutat altera percipit ad.--}}
{{--                                    </div>--}}
{{--                                    <div class="user-id">--}}
{{--                                        <img class="" src="https://place-hold.it/250x250" alt="">--}}
{{--                                        <div class="info">--}}
{{--                                            <div class="name">Jane Guzmann</div>--}}
{{--                                            <div class="position">CFO</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="column is-6">--}}
{{--                                <!-- Testimonial item -->--}}
{{--                                <div class="flex-card testimonial-card light-bordered light-raised padding-20">--}}
{{--                                    <div class="testimonial-title">--}}
{{--                                        Very nice support--}}
{{--                                    </div>--}}
{{--                                    <div class="testimonial-text">--}}
{{--                                        Lorem ipsum dolor sit amet, vim quidam blandit voluptaria no, has eu lorem convenire incorrupte. Vis mutat altera percipit ad.--}}
{{--                                    </div>--}}
{{--                                    <div class="user-id">--}}
{{--                                        <img class="" src="https://place-hold.it/250x250" alt="">--}}
{{--                                        <div class="info">--}}
{{--                                            <div class="name">Hellen Miller</div>--}}
{{--                                            <div class="position">Accountant</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- Testimonial item -->--}}
{{--                                <div class="flex-card testimonial-card light-bordered light-raised padding-20">--}}
{{--                                    <div class="testimonial-title">--}}
{{--                                        My income has doubled--}}
{{--                                    </div>--}}
{{--                                    <div class="testimonial-text">--}}
{{--                                        Lorem ipsum dolor sit amet, vim quidam blandit voluptaria no, has eu lorem convenire incorrupte. Vis mutat altera percipit ad.--}}
{{--                                    </div>--}}
{{--                                    <div class="user-id">--}}
{{--                                        <img class="" src="https://place-hold.it/250x250" alt="">--}}
{{--                                        <div class="info">--}}
{{--                                            <div class="name">Anthony Leblanc</div>--}}
{{--                                            <div class="position">Founder at Hereby</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /Testimonials -->--}}
{{--                    </div>--}}
{{--                    <div class="column"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <!-- /Static Testimonials -->--}}
@endsection
