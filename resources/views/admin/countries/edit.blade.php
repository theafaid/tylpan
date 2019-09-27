@extends('layouts.app')

@section('title')
    Edit {{$country->name}}
@endsection

@section('content')
    <section class="section section-feature-grey">
        <div class="container">
            <div class="content-wrapper">
                <h2 class="title section-title has-text-centered dark-text text-bold">
                    Edit {{$country->name}}
                </h2>

                @php
                    $options = [
                        false => 'False',
                        true => 'True',
                    ];
                @endphp

                <form method="POST" action="{{route('admin.countries.update', $country->alpha2_code)}}">
                    @csrf
                    {{method_field('PATCH')}}
                    <label>Travel From ?</label>
                    <select name="travel_from" class="select input">
                        @foreach($options as $key => $value)
                            <option value="{{$key}}" @if(!! $country->travel_from == !! $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label>Travel To ?</label>
                    <select name="travel_to" class="select input">
                        @foreach($options as $key => $value)
                            <option value="{{$key}}" @if(!! $country->travel_to == !! $key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>

                    <div class="mt-30">
                        <button type="submit" class="button btn-align no-lh raised primary-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
