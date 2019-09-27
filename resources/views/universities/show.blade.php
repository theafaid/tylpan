@extends('layouts.app')

@section('title')
{{$university->name}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/core_flashy.css')}}">
@endpush

@push('scripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d8133fa1268df0b"></script>
@endpush

@section('content')

    <!-- Fullheight Parallax Hero -->
    <div class="hero parallax is-cover is-relative is-fullheight" data-background="{{$university->formattedImage}}" style="background-size: 100% 100% !important;" data-color="#333" data-color-opacity="0.9">
        <!-- Hero caption -->
        <div id="main-hero" class="hero-body ">
            <div class="container has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3 has-text-centered">
                        <h1 class="text-bold title light-text header-caption is-large title-block title-wrappers font-size-2x font-size-300 parallax-hero-title" style="text-align: center;">
                            <strong>{{$university->name}}</strong>
                        </h1>
                        <hr>
                        <h2 class="subtitle is-5 light-text">
                            Here you will find a statisics, details about {{$university->name}}
                        </h2>
                        <br>
                        <p class="has-text-centered">
                            <a href="#universityCard" class="button button-cta btn-align primary-btn rounded z-index-2">
                                View
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero caption -->
    </div>
    <!-- /Fullheight Parallax Hero -->

    <section id="universityCard" class="section blog-section section-light-grey">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <!-- Post -->
                    <div class="flex-card is-full-post has-sidebar light-bordered">
                        <!-- Post meta -->
                        <div class="post-meta content">
                            <!-- Author avatar -->
                            <img class="author-avatar is-hidden-mobile" src="{{$university->country->flag}}" title="{{$university->country->name}}">
                            <!-- Title -->
                            <div class="title-block">
                                <h2>{{$university->name}}</h2>
                            </div>
                        </div>

                        <!-- Post body -->
                        <div class="post-body content">
                             {{$university->description}}
                            <hr>

                            <!-- Share Post -->
                            <div class="share-post">
                                <div class="addthis_inline_share_toolbox"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="flex-card light-bordered">
                        <div class="card-header">Details</div>
                        <div class="card-panel">
                            <div class="archives">
                                <div class="archived-month">
                                    <span><a href="#">Country</a></span>
                                    <a href="{{route('countries.show', $university->country->alpha2_code)}}" class="">{{$university->country->name}}</a>
                                </div>
                                <div class="archived-month">
                                    <span><a href="#">Site</a></span>
                                    <a href="{{$university->site_url}}" target="_blank" class="">Visit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
