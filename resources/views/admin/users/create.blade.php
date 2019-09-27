@extends('layouts.app')

@section('title')
    Create User
@endsection

@section('content')
    <div class="columns is-vcentered pt-30">
        <!-- Demo section -->
        <div class="column is-10 is-offset-1">
            @if(count($errors))
                @include('layouts.partials._errors')
            @endif
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <h2 class="title is-4 text-bold mb-20">Create a user</h2>
                    <form method="POST" action="{{route('admin.users.store')}}">
                        @csrf
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>First Name</label>
                                    <input class="input is-medium mt-5" name="first_name" type="text" value="{{old('first_name')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Last Name</label>
                                    <input class="input is-medium mt-5" name="last_name" type="text" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Email</label>
                                    <input class="input is-medium mt-5" name="email" type="email" value="{{old('email')}}">
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
                            <div class="column">
                                <div class="control">
                                    <label>Password</label>
                                    <input class="input is-medium mt-5" name="password" type="password">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <label>Confirm password</label>
                                    <input class="input is-medium mt-5" name="password_confirmation" type="password">
                                </div>
                            </div>
                        </div>
                        <div class="columns mt-50">
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
                            @php
                                $roles = ['user' => 'User', 'delegate' => 'Delegate', 'admin' => 'Admin', 'super_admin' => 'Super Admin'];
                            @endphp
                            <div class="column">
                                <div class="control">
                                    <label>Role</label>
                                    <select class="input" name="role">
                                        @foreach($roles as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
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
