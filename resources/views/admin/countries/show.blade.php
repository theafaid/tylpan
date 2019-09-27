@extends('layouts.app')

@section('title')
    {{$country->name}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/core_flashy.css')}}">
@endpush

@section('content')
    <section class="section blog-section section-light-grey">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <!-- Post -->
                    <div class="flex-card is-full-post has-sidebar light-bordered">
                        <!-- Post meta -->
                        <div class="post-meta content">
                            <!-- Author avatar -->
                            <img class="author-avatar is-hidden-mobile" src="{{$country->flag}}" title="{{$country->name}}">
                            <!-- Title -->
                            <div class="title-block">
                                <h2>{{$country->name}}</h2>
                            </div>
                        </div>

                        <!-- Post body -->
                        <div class="post-body content">
                            <h4>Universities [ {{count($country->universities)}} ]</h4>
                            <hr>
                            @forelse($country->universities as $university)
                            <a href="{{route('universities.show', [$country->alpha2_code, $university->slug])}}">{{$university->name}}</a><br>
                            @empty
                                <article class="message icon-msg accent-msg">
                                    <i class="material-icons">info</i>
                                    <div class="message-body">
                                        <h4>There is no created universities in {{$country->name}}. <a href="{{route('admin.universities.create')}}">Create one</a></h4>
                                    </div>
                                </article>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Blog sidebar -->
                <div class="column">
                    <div class="flex-card light-bordered">
                        <div class="card-header">Details</div>
                        <div class="card-panel">
                            <div class="archives">
                                <div class="archived-month">
                                    <span><a href="#">All Users</a></span>
                                    <a href="" class="">{{$country->users->count()}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @if($university->colleges)--}}
{{--                        <div class="flex-card light-bordered">--}}
{{--                            <div class="card-header">Colleges</div>--}}
{{--                            <div class="card-panel">--}}
{{--                                @foreach(json_decode($university->colleges) as $college)--}}
{{--                                    <div class="post-categories">--}}
{{--                                        <div class="post-category">--}}
{{--                                            <span>{{$college}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>
                <!-- /Blog sidebar -->
            </div>
        </div>
    </section>
@endsection
