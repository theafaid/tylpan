@extends('layouts.app')

@section('title')
    {{$user->defaultName}} Profile
@endsection

@section('content')
    @if(session('uncompletedProfile'))
        <div class="container mt-40">
            <article class="message icon-msg primary-msg">
                <i class="sl sl-icon-info"></i>
                <div class="message-body">
                    <h4>{{session('uncompletedProfile')}}</h4>
                </div>
            </article>
        </div>
    @endif

    @if(session('registered'))
        <div class="container mt-40">
            <article class="message icon-msg">
                <i class="sl sl-icon-check"></i>
                <div class="message-body">
                    <h4>{{session('registered')}}</h4>
                </div>
            </article>
        </div>
    @endif
    <profile-page :user="{{$user}}" :countries="{{$countries}}"></profile-page>

@endsection

@push('scripts')
    @include('layouts.partials._uploadcare_script')
@endpush

