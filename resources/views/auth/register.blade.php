@extends('layouts.auth')

@section('title')
    Registration
@endsection

@section('content')
    @component('components.auth')
        @slot('form')
            @if($message = session('invalidCountry'))
                <article class="message icon-msg accent-msg">
                    <i class="sl sl-icon-info"></i>
                    <div class="message-body">
                        <h4>{{$message}}</h4>
                    </div>
                </article>
            @endif
            <!-- Login Form -->
            <form method="POST" action="{{route('register')}}">
                @csrf
                <div id="signin-form" class="login-form animated preFadeInLeft fadeInLeft">
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                        </div>
                        @error('first_name')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="middle_name" placeholder="Middle Name" value="{{old('middle_name')}}">
                        </div>
                        @error('middle_name')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                        </div>
                        @error('last_name')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="text" name="email" placeholder="Email Address" value="{{old('email')}}">
                        </div>
                        @error('email')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="password" name="password" placeholder="Password">
                        </div>
                        @error('password')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Input -->
                    <div class="field pb-10">
                        <div class="control">
                            <input class="input is-large" type="password" name="password_confirmation" placeholder="Confirm your password">
                        </div>
                        @error('password_confirmation')
                        <span class="b-badge is-danger" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <!-- Submit -->
                    <p class="control login">
                        <button type="submit" class="button button-cta primary-btn btn-align-lg btn-outlined is-bold is-fullwidth rounded raised no-lh">Register to {{general_settings('site_name')}}</button>
                    </p>
                </div>
            </form>
            <!-- /Login Form -->
        @endslot

        @slot('pageDescription')
            <h1 class="title is-2 light-text">
                Join {{general_settings('site_name')}} community right now.
            </h1>
            <h3 class="subtitle is-5 light-text">
                {{general_settings('site_description')}}
            </h3>
        @endslot
        @slot('switcher')
            <span>Already Registered ?</span>
            <a href="{{route('login')}}" class="button btn-align btn-outlined is-bold light-btn rounded">Login to {{general_settings('site_name')}}</a>
        @endslot
    @endcomponent
@endsection
