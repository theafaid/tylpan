@extends('layouts.auth')

@section('title')
    Password Reset
@endsection

@section('content')
    @component('components.auth')
        @slot('form')
            <!-- Reset Form -->
            @if (session('status'))
                <article class="message msg-success">
                    <h4 class="message-header">
                        <span>{{ session('status') }}</span>
                    </h4>
                </article>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div id="recover-form" class="login-form">
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="email" placeholder="Enter your Email address">
                        </div>
                        @error('email')
                        <span class="b-badge is-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Submit -->
                    <p class="control login">
                        <button type="submit" class="button button-cta secondary-btn btn-align-lg btn-outlined is-bold is-fullwidth rounded raised no-lh">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </p>
                </div>
            </form>
            <!-- /Reset Form -->
        @endslot

        @slot('pageDescription')
            <h1 class="title is-2 light-text">
                Reset my {{general_settings('site_name')}} Password
            </h1>
            <h3 class="subtitle is-5 light-text">
                {{additional_settings('site_slogan')}}
            </h3>
        @endslot
        @slot('switcher')
            <span>Don't have an account yet ?</span>
            <a href="{{route('register')}}" class="button btn-align btn-outlined is-bold light-btn rounded">Register Now</a>
        @endslot
    @endcomponent
@endsection
