@extends('layouts.app')

@section('title')
    Edit {{$university->name}}
@endsection

@push('scripts')
    @include('layouts.partials._uploadcare_script')
@endpush

@section('content')
    <section class="section section-feature-grey">
        <div class="container">
            <div class="content-wrapper">
                <h2 class="title section-title has-text-centered dark-text text-bold">
                    Edit {{$university->name}}
                </h2>
                @if(count($errors))
                    @include('layouts.partials._errors')
                @endif
                <div class="flex-card light-bordered light-raised">
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.universities.update', $university->slug)}}">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="columns mt-50">
                                <div class="column">
                                    <div class="control">
                                        <label>Name</label>
                                        <input class="input is-medium mt-5" name="name" type="text" value="{{old('name') ?: $university->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="columns mt-50">
                                <div class="column">
                                    <div class="control">
                                        <label>Description</label>
                                        <textarea class="textarea input" name="description">{{old('description') ?: $university->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="columns mt-50">
                                <div class="column">
                                    @if($university->image)
                                        <a href="{{$university->formattedImage}}" target="_blank">View Image</a>
                                    @endif
                                    <div class="control">
                                        <input
                                            data-input-accept-types="image/*"
                                            type="hidden"
                                            name="image"
                                            role="uploadcare-uploader">
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="control">
                                        <label>Site URL</label>
                                        <input class="input is-medium mt-5" name="site_url" type="text" value="{{old('site_url') ?: $university->site_url}}">
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="control">
                                        <label>Country</label>
                                        <select class="input select" name="country_id">
                                            <option>Select</option>
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country['id']}}"
                                                    @if(old('country_id') == $country->id || $university->country_id == $country->id) selected @endif>
                                                    {{$country->name}}
                                                </option>
                                            @endforeach
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
            </div>
        </div>
    </section>
@endsection
