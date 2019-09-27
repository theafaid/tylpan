<!-- Footer -->
<footer class="footer footer-light-medium">
    <div class="container">
        <div class="columns">
            <!-- Column -->
            <div class="column is-4">
                <div class="pt-10 pb-10">
                    <img class="small-footer-logo" src="{{additional_settings('site_logo')}}">
                    <div class="footer-description pt-10 pb-10">
                        {{general_settings('site_description')}}
                    </div>
                </div>
                <div>
                    <span class="moto">Coded with <i class="fa fa-heart color-red"></i> by A||F.</span>
                </div>
            </div>
            <!-- Column -->
            <div class="column is-8">
                <div class="columns">
                    <!-- Column -->
                    <div class="column">
                        <ul class="footer-column">
                            <li class="column-header">
                                Get Started
                            </li>
                            <li class="column-item"><a href="{{route('orders.create')}}">Create an Order</a></li>
                            <li class="column-item"><a href="{{route('orders.index')}}">Follow an Order</a></li>
                        </ul>
                    </div>
                    <!-- Column -->
                    <div class="column">
                        <ul class="footer-column">
                            <li class="column-header">
                                Countries
                            </li>
                            <li class="column-item"><a href="{{route('countries.index')}}">Travel To</a></li>
                            <li class="column-item"><a href="{{route('countries.index', ['travel_from' => 1])}}">Travel From</a></li>
                        </ul>
                    </div>
                    <!-- Column -->
                    <div class="column">
                        <ul class="footer-column">
                            <li class="column-header">
                                Site
                            </li>
                            <li class="column-item"><a href="{{route('how_to_start')}}">How to start ?</a></li>
                            <li class="column-item"><a href="{{route('about')}}">About us</a></li>
                            <li class="column-item"><a href="{{route('terms')}}">Terms of Service</a></li>
                        </ul>
                    </div>
                    <!-- Column -->
                    <div class="column">
                        <ul class="footer-column">
                            <li class="column-header">
                                Follow Us
                            </li>
                            <div class="social-links pt-10 pb-10">
                                @if($url = additional_settings('site_facebook_url'))
                                    <a href="{{$url}}">
                                        <span class="icon"><i class="fa fa-facebook"></i></span>
                                    </a>
                                @endif
                                    @if($url = additional_settings('site_twitter_url'))
                                        <a href="{{$url}}">
                                            <span class="icon"><i class="fa fa-twitter"></i></span>
                                        </a>
                                    @endif
                                    @if($url = additional_settings('site_instagram_url'))
                                        <a href="{{$url}}">
                                            <span class="icon"><i class="fa fa-instagram"></i></span>
                                        </a>
                                    @endif
                                    @if($url = additional_settings('site_youtube_url'))
                                        <a href="{{$url}}">
                                            <span class="icon"><i class="fa fa-youtube"></i></span>
                                        </a>
                                    @endif
                            </div>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
