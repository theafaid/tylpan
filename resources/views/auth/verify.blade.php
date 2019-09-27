@extends('layouts.app')

@section('title')
    Verification
@endsection

@section('content')
<div class="container">
    <div class="column mt-30 is-12">

        @if (session('resent'))
            <article class="message msg-success">
                <h4 class="message-header">
                    <span>{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </h4>
            </article>
        @endif

        <article class="message icon-msg accent-msg">
            <i class="sl sl-icon-info"></i>
            <div class="message-body">
                <h4>{{ __('Verify Your Email Address') }}</h4>
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <hr>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="button btn-align is-info">{{ __('click here to request another') }}</button>
                </form>
            </div>
        </article>
    </div>
</div>
@endsection
