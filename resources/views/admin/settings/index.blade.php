@extends('layouts.app')

@section('title')
    Site settings
@endsection

@push('scripts')
    @include('layouts.partials._uploadcare_script')
@endpush

@section('content')
    <div class="columns is-vcentered mt-50">
        <div class="column is-8 is-offset-2">
            @if($msg = session('success'))
                <article class="message icon-msg success-msg">
                    <i class="sl sl-icon-check"></i>
                    <div class="message-body">
                        <h4>{{$msg}}</h4>
                    </div>
                </article>
            @endif

            @if(count($errors))
                @include('layouts.partials._errors')
            @endif
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <h2 class="title is-4 text-bold mb-20">General Settings</h2>
                    <form method="POST" action="{{route('admin.general_settings')}}">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Site name</label>
                                    <input class="input is-medium mt-5" name="site_name" type="text" value="{{old('site_name') ?: general_settings('site_name')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Site keywords</label>
                                    <input class="input is-medium mt-5" name="site_keywords" type="text" value="{{old('site_keywords') ?: general_settings('site_keywords')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <label>Site Description</label>
                                    <div class="mt-5"></div>
                                    <textarea class="textarea" name="site_description">{{old('site_description') ?: general_settings('site_description')}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        @php
                            $checkingOptions = [
                                true => 'On',
                                false => 'Off'
                            ];
                        @endphp
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <label>Allow notifications</label>
                                    <select class="input select" name="allow_notifications">
                                        @foreach($checkingOptions as $key => $value)
                                            <option value="{{$key}}" @if(general_settings('allow_notifications') == $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Allow Viewing Friends</label>
                                    <select class="input select" name="allow_friends">
                                        @foreach($checkingOptions as $key => $value)
                                            <option value="{{$key}}" @if(general_settings('allow_friends') == (bool) $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Open ?</label>
                                    <select class="input select" name="site_open">
                                        <option value="0" @if(! general_settings('site_open')) selected @endif>Off</option>
                                        <option value="1" @if(general_settings('site_open')) selected @endif>On</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-30">
                            <button type="submit" class="button btn-align no-lh raised primary-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <h2 class="title is-4 text-bold mb-20">Additional Settings</h2>
                    <form method="POST" action="{{route('admin.additional_settings')}}">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="columns mt-50">
                            <div class="column">
                                @if(additional_settings('site_icon'))
                                    <a href="{{additional_settings('site_icon')}}" target="_blank">View</a>
                                @endif
                                <div class="control">
                                    <label>Site Icon</label>
                                    <input
                                        data-input-accept-types="image/*"
                                        type="hidden"
                                        name="site_icon"
                                        role="uploadcare-uploader">
                                </div>
                            </div>
                            <div class="column">
                                @if(additional_settings('site_logo'))
                                    <a href="{{additional_settings('site_logo')}}" target="_blank">View</a>
                                @endif
                                <div class="control">
                                    <label>Site Logo</label>
                                    <input
                                        data-input-accept-types="image/*"
                                        type="hidden"
                                        name="site_logo"
                                        role="uploadcare-uploader">
                                </div>
                            </div>
                            <div class="column">
                                @if(additional_settings('default_page_background'))
                                    <a href="{{additional_settings('default_page_background')}}" target="_blank">View</a>
                                @endif
                                <div class="control">
                                    <label>Default Background</label>
                                    <input
                                        data-input-accept-types="image/*"
                                        type="hidden"
                                        name="default_page_background"
                                        role="uploadcare-uploader">
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <label>Slogan</label>
                                    <input class="input is-medium" type="text" name="site_slogan" value="{{old('site_slogan') ?: additional_settings('site_slogan')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Video Url</label>
                                    <input class="input is-medium" type="text" name="site_video_url" value="{{old('site_video_url') ?: additional_settings('site_video_url')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Email</label>
                                    <input class="input is-medium" type="text" name="site_email" value="{{old('site_email') ?: additional_settings('site_email')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <label>Facebook Url</label>
                                    <input class="input is-medium" type="text" name="site_facebook_url" value="{{old('site_facebook_url') ?: additional_settings('site_facebook_url')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Twitter Url</label>
                                    <input class="input is-medium" type="text" name="site_twitter_url" value="{{old('site_twitter_url') ?: additional_settings('site_twitter_url')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Instagram Url</label>
                                    <input class="input is-medium" type="text" name="site_instagram_url" value="{{old('site_instagram_url') ?: additional_settings('site_instagram_url')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Youtube Url</label>
                                    <input class="input is-medium" type="text" name="site_youtube_url" value="{{old('site_youtube_url') ?: additional_settings('site_youtube_url')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control">
                                    <label>Phone number</label>
                                    <input class="input is-medium" type="text" name="site_phone_number" value="{{old('site_phone_number') ?: additional_settings('site_phone_number')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Address</label>
                                    <textarea class="textarea" type="text" name="site_address">{{old('site_address') ?: additional_settings('site_address')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-30">
                            <button type="submit" class="button btn-align no-lh raised primary-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
