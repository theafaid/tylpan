@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    @component('components.auth')
        @slot('form')
            <!-- Login Form -->
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div id="signin-form" class="login-form animated preFadeInLeft fadeInLeft">
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="email" placeholder="Email Address">
                            @error('email')
                            <span class="b-badge is-danger" role="alert">
                                {{$message}}
                            </span>
                            @enderror
                        </div>

                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="password" name="password" placeholder="Password">
                            @error('password')
                            <span class="b-badge is-danger" role="alert">
                               {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit -->
                    <p class="control login">
                        <button type="submit" class="button button-cta primary-btn btn-align-lg btn-outlined is-bold is-fullwidth rounded raised no-lh">Log in</button>
                    </p>
                </div>
            </form>
            <!-- /Login Form -->
            <!-- Reset Form -->
            @if (session('status'))
                <hr>
                <article class="message icon-msg success-msg">
                    <i class="sl sl-icon-check"></i>
                    <div class="message-body">
                        <h4>{{session('status')}}</h4>
                    </div>
                </article>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div id="recover-form" class="login-form animated preFadeInLeft fadeInLeft is-hidden">
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="email" placeholder="Enter your Email address">
                        </div>
                        @error('email')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
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
            <!-- Toggles -->
            <div id="recover" class="section forgot-password animated preFadeInLeft fadeInLeft">
                <p class="has-text-centered">
                    <a href="#">Forgot password ?</a>
                </p>
            </div>

            <div id="back-to-login" class="section forgot-password animated preFadeInLeft fadeInLeft is-hidden">
                <p class="has-text-centered">
                    <a href="#">Back to Sign in</a>
                </p>
            </div>
            <!-- /Toggles -->
        @endslot

        @slot('pageDescription')
            <h1 class="title is-2 light-text">
                Sign in to {{general_settings('site_name')}}
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
