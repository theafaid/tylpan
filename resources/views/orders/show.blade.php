@extends('layouts.app')

@section('title')
  Order  {{$order->code}}
@endsection

@section('content')
    <!-- Hero and nav -->
    <div class="hero hero-wavy is-relative is-theme-secondary">
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered huge-pb huge-pt">
                <div class="columns is-vcentered">
                    <div class="column is-4 hero-caption is-offset-4">
                        <h1 class="title big-landing-title text-bold is-2">
                            Order {{$order->formattedCode}}
                        </h1>
                        <h2 class="subtitle is-5 light-text pt-10 pb-10">
                            {{$order->description_for_creator}}
                        </h2>
                    </div>
                </div>

                <div class="columns has-text-centered">
                   <div class="column">
                       <a class="button danger-btn is-large outline" href="{{route('tasks.index', $order->code)}}"><i class="fa fa-tasks"></i>Tasks</a>
                       @notificationAllowed
                       <chat-box
                           original-order-code="{{$order->code}}"
                           formatted-order-code="{{$order->formattedCode}}"
                           order-id="{{$order->id}}">
                       </chat-box>
                       @endnotificationAllowed
                   </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->
    </div>
    <!-- /Hero and nav -->

    <!-- Article section -->
    <div class="section help-section is-relative">
        <div class="container">
            <div class="columns">
                <div class="column is-8 help-container">
                    <!-- Article body -->
                    <div class="flex-card single-help-article raised padding-25">
                        <div class="article-inner">
                            <!-- Article meta -->
                            <h2 class="title is-3 dark-text text-bold article-meta">
                                <img src="{{$owner->profile->formattedAvatar}}"  class="is-inline rounded-avatar" width="40" height="50">
                                <strong>{{$owner->defaultName}} Order</strong>
                            </h2>
                            <div class="article-meta">
                                <div class="meta-in fo">
                                    <div class="author">Created from <span>{{$order->created_at->diffForHumans()}}</span></div>
                                    <div class="author">Last Update from <span>{{$order->created_at->diffForHumans()}}</span></div>
                                </div>
                            </div>
                            <!-- /Article meta -->

                            <hr>

                            <!-- Article content -->
                            <div class="content">
                                <h4 class="subtitle is-5 dark-text">
                                    <strong>Countries</strong>
                                </h4>

                                <a href="{{route('countries.show', $owner->country->alpha2_code)}}">
                                    <img src="{{$owner->country->flag}}" class="image squared is-inline country-flag" style="display: inline-block; width: 64px;">

                                </a>
                                <span class="tag is-large flags-separator">
                                   To <i class="sl sl-icon-arrow-right"></i>
                                </span>
                                @foreach($countries as $key => $country)
                                        <a href="{{route('countries.show', $country->alpha2_code)}}">
                                            <img src="{{$country->flag}}" class="image squared is-inline country-flag" style="display: inline-block; width: 64px;">
                                        </a>
                                        @if($key+1 < count($countries))
                                        <span class="tag is-large flags-separator">
                                            OR <i class="sl sl-icon-arrow-right"></i>
                                        </span>
                                    @endif
                                @endforeach

                                <hr>

                                <h4 class="subtitle is-5 dark-text mt-20">
                                    <strong>Universities In Order</strong>
                                </h4>

                                <ul>
                                    @forelse($universities as $university)
                                        <li>
                                            <a href="{{route('universities.show', [$country->alpha2_code, $university->slug])}}">{{$university->name}}</a>
                                            |
                                            <a href="{{route('countries.show', $country->alpha2_code)}}">{{$university->country->name}}</a>
                                        </li>
                                    @empty
                                        <li>We will choose one.</li>
                                    @endforelse
                                </ul>

                                <hr>

                                <h4 class="subtitle is-5 dark-text mt-20">
                                    <strong>Specializations In Order</strong>
                                </h4>
                                <ol>
                                    @foreach(json_decode($order->specializations) as $specialization)
                                        <li>{{$specialization}}</li>
                                    @endforeach
                                </ol>

                                <hr>

                                <h4 class="subtitle is-5 dark-text mt-20"><strong>Maximum Budget:</strong> {{$order->formattedBudget}}</h4>

                            </div>
                            <!-- /Article content -->
                        </div>
                    </div>
                    <!-- /Article body -->
                </div>
                <div class="column is-4 mt-40">
                    @if($delegate)
                        <div class="demo">
                                <div class="flex-card card-overflow raised mb-40" style="-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;">
                                    <div class="has-text-centered">
                                        <div class="testimonial-avatar">
                                            <img src="{{$delegate->profile->formattedAvatar}}" alt="">
                                        </div>
                                        <div class="testimonial-name mb-20">
                                            <div class="member-info">
                                                <h3><strong>{{$delegate->fullName}}</strong></h3>
                                                <span class="member-position">DELEGATE</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                    <ul class="list-block">
                                        <li>
                                            <a href="{{route('countries.show', $owner->country->alpha2_code)}}"><i class="sl sl-icon-location mr-20"></i>
                                                Country:
                                                {{$owner->country->name}}
                                                <img src="{{$owner->country->flag}}" width="25" height="30" style="position: relative; top:4px"/>
                                            </a>
                                        </li>
                                        <li><i class="sl sl-icon-star mr-20"></i>Age: {{$delegate->profile->age ?: 'Not provided'}}</li>
                                        <li><i class="sl sl-icon-call-in mr-20"></i>Phone Number: {{$delegate->profile->phoneNumber($owner->country) ?: 'Not Provided'}}</li>
                                        <li><i class="sl sl-icon-envelope-open mr-20"></i>Email Address: {{$delegate->email}}</li>
                                        <li>
                                            @if($delegate->profile->social_links)
                                                <i class="sl sl-icon-link mr-20"></i>
                                            @foreach($delegate->profile->social_links as  $key => $value)
                                                    <a class="button btn-square primary-btn rounded is-small social-link" href="{{$value}}"><i class="fa fa-{{$key}}"></i></a>
                                                @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <article class="message icon-msg primary-msg">
                            <i class="sl sl-icon-info"></i>
                            <div class="message-body">
                                <h4><strong>Your Delegate</strong></h4>
                                Your Order is not assigned to a delegate till now, Please be patient until we choose one in your country for you.
                            </div>
                        </article>
                    @endif

                    @admin
                    <assign-delegate-form
                        :order-code="{{$order->code}}"
                        :country="{{$owner->country}}"
                        :assigned-delegate-id="{{$delegate ? $delegate->id : 'null'}}">
                    </assign-delegate-form>
                    @endadmin
                </div>
            </div>
        </div>
    </div>
    <!-- Article section -->

@endsection

