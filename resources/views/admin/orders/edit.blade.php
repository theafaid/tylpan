@extends('layouts.app')

@section('title')
    Edit order {{$order->code}}
@endsection

@section('content')
    <section class="section section-feature-grey">
        <div class="container">
            <div class="content-wrapper">
                <h2 class="title section-title has-text-centered dark-text text-bold">
                    Edit Order {{$order->formattedCode}}
                </h2>

                @php
                    $statuses = ['progressing', 'failed', 'completed']
                @endphp
                <div class="flex-card light-bordered raised">
                    <div  class="card-body">
                        <div class="content">
                            <h2 class="no-margin text-bold">Main Details</h2>
                            <br>
                            <form method="POST" action="{{route('admin.orders.update', $order->code)}}">
                                <input type="hidden" name="basic" value="1">
                                @csrf
                                {{method_field('PATCH')}}
                                <div class="columns">
                                    <div class="column">
                                        <label>Order Status</label>
                                        <select name="status" class="select input">
                                            @foreach($statuses as $status)
                                                <option value="{{$status}}" @if($status == $order->status) selected @endif>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="column">
                                        <label>Description For Creator</label>
                                        <input type="text" class="input is-medium" name="description_for_creator" value="{{$order->description_for_creator}}">
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Delegate:
                                        @if($delegate = $order->delegate)
                                            <a href="{{route('profile.index', $delegate->id)}}" target="_blank">{{$delegate->fullName}}</a>
                                        @else
                                        Not Assigned
                                        @endif
                                        <assign-delegate-form
                                            :country="{{$order->owner->country}}"
                                            assigned-delegate-id="{{$order->delegate_id}}"
                                            order-code="{{$order->code}}"
                                        ></assign-delegate-form>
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
                <edit-order-form
                    :code="{{$order->code}}"
                    :countries="{{$countries}}"
                    :old-countries="{{$order->countries}}"
                    :old-universities="{{$order->universities}}"
                    :old-specializations="{{$order->specializations}}"
                    :old-budget="{{$order->budget}}"
                ></edit-order-form>
            </div>
        </div>
    </section>
@endsection
