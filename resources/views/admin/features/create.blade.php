@extends('layouts.app')

@section('title')
    Create Feature
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
                    <h2 class="title is-4 text-bold mb-20">Add a site feature</h2>
                    <form method="POST" action="{{route('admin.features.store')}}">
                        @csrf
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Title</label>
                                    <input class="input is-medium mt-5" name="title" type="text" value="{{old('title') ?: general_settings('title')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Description</label>
                                    <textarea class="textarea" name="description">
                                        {{old('description') ?: general_settings('description')}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Image</label>
                                    <input
                                        data-input-accept-types="image/*"
                                        type="hidden"
                                        name="image"
                                        role="uploadcare-uploader">
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
