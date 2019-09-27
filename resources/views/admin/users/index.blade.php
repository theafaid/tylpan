@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <section class="section section-feature-grey">
        <div class="container">
            @if($msg = session('success'))
                <article class="message icon-msg success-msg">
                    <i class="sl sl-icon-check"></i>
                    <div class="message-body">
                        <h4>{{$msg}}</h4>
                    </div>
                </article>
            @endif
            <div class="content-wrapper">
                <h2 class="title section-title has-text-centered dark-text text-bold">
                    Users
                </h2>
                <users></users>
            </div>
        </div>
    </section>
@endsection
