@extends('layouts.app')

@section('title')
    Order {{$order->code}} Tasks
@endsection

@section('content')
    <section class="section section-feature-grey">
        <div class="container is-fluid">
            <div class="section-title-wrapper has-text-centered">
                <div class="bg-number"></div>
                <h2 class="title section-title has-text-centered dark-text text-bold">
                    Order {{$order->formattedCode}} Tasks
                </h2>
            </div>
            <div class="columns is-vcentered pt-30">
                <div class="column is-8 is-offset-2">
                    <tasks></tasks>
                </div>
            </div>
        </div>
    </section>
@endsection
