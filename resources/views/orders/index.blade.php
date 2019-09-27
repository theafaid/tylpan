@extends('layouts.app')

@section('title')
    My orders
@endsection

@push('styles')
    <style>
        .order-status {
            position: absolute;
            right: 0px;
            top: 0px;
            width: 30%;
            padding: 20px;
            text-align: center;
            font-weight: 500;
            font-size: 16px;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    <!-- Hero and nav -->
    <div class="hero hero-wavy is-relative is-theme-secondary">
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered huge-pb huge-pt">
                <div class="columns is-vcentered">
                    <div class="column is-4 hero-caption is-offset-4">
                        <h1 class="title big-landing-title text-bold is-2">
                            My Traveling Orders
                        </h1>
                        <h2 class="subtitle is-5 light-text pt-10 pb-10">
                            You have created {{count($orders)}} {{\Str::plural('Order', count($orders))}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->
    </div>
    <!-- /Hero and nav -->

    <section class="section help-section">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column"></div>
                <div class="column is-9">
                    @forelse($orders as $order)
                        <!-- Category card -->
                            <div class="flex-card category-card light-bordered">
                                <div class="card-body">
                                    <a href="{{route('orders.show', $order->code)}}">
                                        <div class="tag squared order-status order-status {{$order->formattedStatus['class']}}">
                                            {{$order->formattedStatus['name']}} &nbsp; <i class="{{$order->formattedStatus['icon']}}"></i>
                                        </div>
                                        <!-- Content -->
                                        <div class="inner-content">
                                            <h2 class="title is-4"><strong>Order {{$order->formattedCode}}</strong></h2>
                                            <div class="subtitle">
                                                {{$order->description_for_creator}}<br>
                                                <small>Budget </small> {{$order->formattedBudget}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                    @empty
                            <article class="message icon-msg accent-msg">
                                <i class="material-icons">info</i>
                                <div class="message-body">
                                    <h4>You haven't created any orders yet!</h4>
                                    <p>Take a change to travel right now. All you have to do is Join us.</p>
                                    <hr>
                                    <strong>
                                        <a href="{{route('orders.create')}}" class="button info-btn">Create an order</a>
                                    </strong>
                                </div>
                            </article>
                    @endforelse
                </div>
                <div class="column"></div>
            </div>
        </div>
    </section>
@endsection
