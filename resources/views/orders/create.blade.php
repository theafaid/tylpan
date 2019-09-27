@extends('layouts.app')

@section('title')
    Create An Order
@endsection

@push('scripts')
    <script src="{{asset('')}}/js/pages/components-modals.js"></script>
@endpush

@section('content')
    <!-- Fullheight Parallax Hero -->
    <div class="hero parallax is-cover is-relative is-fullheight" data-background="{{additional_settings('default_page_background')}}" style="background-size: 100% 100% !important;" data-color="#333" data-color-opacity="0.9">
        <!-- Hero caption -->
        <div id="main-hero" class="hero-body ">
            <div class="container has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3 has-text-centered">
                        <h1 class="text-bold title light-text header-caption is-large title-block title-wrappers font-size-2x font-size-300 parallax-hero-title" style="text-align: center;">
                           <strong>Create a Traveling Order</strong>
                        </h1>
                        <hr>
                        <h2 class="subtitle is-5 light-text">
                            Hey {{auth()->user()->defaultName}}, Here you can submit a request to travel to any country you want from our <a class="b-badge is-small is-success" href="{{route('countries.index')}}">Allowed Countries</a>.
                            Just fill all information bellow and wait for response from one of your country delegates :)
                            </h2>
                        <br>
                        <p class="has-text-centered">
                            <a href="#createOrderForm" class="button button-cta btn-align primary-btn rounded z-index-2">
                                Get Started
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero caption -->
    </div>
    <!-- /Fullheight Parallax Hero -->

    <section id="createOrderForm" class="section is-medium section-feature-grey">
        <div class="container">
            <div class="section-title-wrapper">
                <h2 class="title section-title has-text-centered dark-text">
                    <i class="sl sl-icon-plane"></i> Traveling Form
                </h2>
            </div>

            <div class="content-wrapper">
                <create-order-form :countries="{{$countries}}"></create-order-form>
            </div>

        </div>
    </section>
@endsection
