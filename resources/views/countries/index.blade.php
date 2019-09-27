@extends('layouts.app')

@section('title')
    Countries
@endsection

@section('content')
    <section class="section section-light-grey">
        <div class="container">
            <div class="section-title-wrapper">
                <h2 class="title section-title has-text-centered dark-text">
                    {{count($countries)}} countries you can travel {{request('travel_from') ? 'from' : 'to'}} it
                </h2>

            </div>

            <div class="content-wrapper">
                <div class="columns integration-cards is-minimal is-vcentered is-gapless is-multiline">
                    @foreach($countries as $country)
                        <div class="column is-4">
                            <div class="card card-floating-boxed card-shadow" style="margin-bottom: 50px;">
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <a href="{{route('countries.show', $country->alpha2_code)}}">
                                            <img src="{{$country->flag}}" alt="{{$country->name}}" width="400" height="300">
                                        </a>
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content">
                                            <strong>{{$country->name}}</strong>
                                        </div>
                                    </div>

                                    <div class="has-text-left">
                                        <a href="{{route('countries.show', $country->alpha2_code)}}" class="button btn-align info-btn raised">See &nbsp;<strong>{{$country->name}}</strong> &nbsp;Universities</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="has-text-centered pt-40 pb-40">
                    @if(! request('travel_from'))
                        <a
                            href="{{route('countries.index', ['travel_from' => 1])}}"
                            class="button button-cta btn-align primary-btn rounded">
                            See allowed countries to travel from it
                        </a>
                    @else
                        <a
                            href="{{route('countries.index')}}"
                            class="button button-cta btn-align primary-btn rounded">
                            See allowed countries to travel to it
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
