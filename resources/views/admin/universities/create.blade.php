@extends('layouts.app')

@section('title')
    Create University
@endsection

@push('scripts')
    @include('layouts.partials._uploadcare_script')
@endpush

@section('content')
    <div class="columns is-vcentered pt-30">
        <!-- Demo section -->
        <div class="column is-10 is-offset-1">
            @if(count($errors))
                @include('layouts.partials._errors')
            @endif
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <h2 class="title is-4 text-bold mb-20">Create a University</h2>
                    <form method="POST" action="{{route('admin.universities.store')}}">
                        @csrf
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Name</label>
                                    <input class="input is-medium mt-5" name="name" type="text" value="{{old('name')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Description</label>
                                    <textarea class="textarea input" name="description">{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Image</label> <br>
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
                                    <input class="input is-medium mt-5" name="site_url" type="text" value="{{old('site_url')}}">
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
                                                @if(old('country_id') == $country->id) selected @endif>
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-30">
                            <button type="submit" class="button btn-align no-lh raised primary-btn">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
