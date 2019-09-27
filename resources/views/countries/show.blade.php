@extends('layouts.app')

@section('title')
Countries - {{$country->name}}
@endsection

@section('content')

    <div class="hero product-hero parallax is-cover is-relative is-default is-bold" data-position-x="center"><div class="parallax-overlay" style="background-color: rgb(0, 0, 0); opacity: 0.3;"></div>
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-vcentered pt-80 pb-80">
                    <div class="column is-5 signup-column has-text-left">
                        <h1 class="title main-title text-bold is-2">
                            {{$country->name}}
                        </h1>
                        <h2 class="subtitle is-5 light-text no-margin-bottom">
                            Here is some of our statistics about {{$country->name}}.
                            You will find all biggest universities that you can study or complete you studying there.
                        </h2>
                        <br>
                    </div>
                    <div class="column is-offset-1">
                        <!-- Hero mockup -->
                        <figure class="image is-hidden-mobile">
                            <img src="{{$country->flag}}" alt="">
                        </figure>
                        <!-- /Hero mockup -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->
    </div>

    <section class="section section-feature-grey is-medium">
        <div class="container">
            <div class="content-wrapper">
                <!-- UI block -->
                @forelse($country->universities as $university)
                    <div class="columns is-vcentered mb-50">
                        <!-- Content -->
                        <div class="column is-4">
                            <h2 class="title section-subtitle dark-text text-bold is-2">
                                {{$university->name}}
                            </h2>
                            <span class="section-feature-description">{{\Str::limit($university->description, 250)}}</span>
                            <div class="pt-20 pb-20">
                                <a href="{{route('universities.show', [$country->alpha2_code, $university->slug])}}" class="button button-cta primary-btn rounded raised">
                                    See Details
                                    <i class="sl sl-icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Large UI -->
                        <div class="column is-8">
                            <img src="{{$university->formattedImage}}" title="{{$university->name}}">
                        </div>
                    </div>
                    <hr>
                @empty

                @endforelse
                <!-- /UI block -->
            </div>
        </div>
    </section>

@endsection
