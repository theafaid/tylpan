@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Fullheight Parallax Hero -->
    <div class="hero parallax is-cover is-relative is-fullheight" data-background="{{additional_settings('default_page_background')}}" style="background-size: 100% 100% !important;" data-color="#333" data-color-opacity="0.9">
        <!-- Hero caption -->
        <div id="main-hero" class="hero-body ">
            <div class="container has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3 has-text-centered">
                        <h1 class="text-bold title light-text header-caption is-large title-block title-wrappers font-size-2x font-size-300 parallax-hero-title" style="text-align: center;">
                            <strong>Soon</strong>
                        </h1>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero caption -->
    </div>
    <!-- /Fullheight Parallax Hero -->
@endsection
