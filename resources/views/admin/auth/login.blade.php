@extends('admin.layouts.auth')
@section('title')
Dashboard Login
@endsection
@section('content')
<div class="columns is-vcentered">
    <div class="column is-4 is-offset-4">

        <!-- Classic inputs -->
        <div id="classic" class="login-form-wrapper">
            <!-- Classic login form -->
            <div id="login-form" class="animated preFadeInLeft fadeInLeft">
                <form method="POST" action="{{route('admin.login')}}">
                    @csrf
                    <div class="flex-card auth-card is-light-raised light-bordered card-overflow">
                        <div class="auth-card-header header-primary">
                            <img src="http://www.newdesignfile.com/postpic/2014/02/website-icon_90635.png" alt="">
                        </div>
                        <div class="field pb-10">
                            <div class="control has-icons-right">
                                <input class="input is-large" name="email" type="text" placeholder="Email Address">
                                <span class="icon is-medium is-right">
                                <i class="sl sl-icon-user"></i>
                            </span>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field pb-10">
                            <div class="control has-icons-right">
                                <input class="input is-large" name="password" type="password" placeholder="Password">
                                <span class="icon is-medium is-right">
                                <i class="sl sl-icon-lock"></i>
                            </span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="pt-10 pb-10">
                            <button type="submit" class="button button-cta btn-align primary-btn is-fullwidth btn-outlined is-bold rounded raised no-lh">Login</button>
                        </div>
                    </div>
                    <p class="has-text-centered">
                        <a class="forgot" href="#">Forgot password?</a>
                    </p>
                </form>
            </div>
            <!-- /Classic login form -->

            <!-- Classic recover form -->
            <div id="recover-form" class="animated preFadeInLeft fadeInLeft is-hidden">
                <div class="flex-card auth-card is-light-raised light-bordered card-overflow">
                    <div class="auth-card-header header-primary">
                        <a href="index.html"><img src="http://www.newdesignfile.com/postpic/2014/02/website-icon_90635.png" alt=""></a>
                    </div>
                    <div class="field pb-10">
                        <div class="control has-icons-right">
                            <input class="input is-large" type="text" placeholder="Email address">
                            <span class="icon is-medium is-right">
                                                <i class="sl sl-icon-paper-plane"></i>
                                            </span>
                        </div>
                    </div>
                    <p class="has-text-left pt-10 pb-10">
                        <a class="no-account" href="#">Need Support?</a>
                    </p>
                    <div class="pt-10 pb-10">
                        <button class="button button-cta btn-align primary-btn is-fullwidth btn-outlined is-bold rounded raised no-lh">Reset password</button>
                    </div>
                </div>
                <p class="has-text-centered">
                    <a class="return" href="#">Back to login</a>
                </p>
            </div>
            <!-- /Classic recover form -->
        </div>
        <!-- /Classic inputs -->

        <!-- Material inputs -->
        <div id="material" class="login-form-wrapper is-hidden">

            <!-- Material login form -->
            <div id="material-login-form" class="animated preFadeInLeft fadeInLeft">
                <div class="flex-card auth-card is-light-raised light-bordered card-overflow">
                    <div class="auth-card-header header-secondary">
                        <a href="index.html"><img src="http://www.newdesignfile.com/postpic/2014/02/website-icon_90635.png" alt=""></a>
                    </div>
                    <div class="control-material is-secondary">
                        <input class="material-input" type="text" required>
                        <span class="material-highlight"></span>
                        <span class="bar"></span>
                        <label>Email Address</label>
                    </div>
                    <div class="control-material is-secondary">
                        <input class="material-input" type="text" required>
                        <span class="material-highlight"></span>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>
                    <p class="has-text-left mt-30">
                        <a class="no-account is-secondary" href="#">Dont have an account?</a>
                    </p>
                    <div class="mt-20">
                        <button class="button button-cta btn-align secondary-btn is-fullwidth btn-outlined is-bold rounded raised no-lh">Login</button>
                    </div>
                </div>
                <p class="has-text-centered">
                    <a class="forgot forgot-material is-secondary" href="#">Forgot password?</a>
                </p>
            </div>
            <!-- /Material login form -->

            <!-- Material recover form -->
            <div id="material-recover-form" class="animated preFadeInLeft fadeInLeft is-hidden">
                <div class="flex-card auth-card is-light-raised light-bordered card-overflow">
                    <div class="auth-card-header header-secondary">
                        <a href="index.html"><img src="http://www.newdesignfile.com/postpic/2014/02/website-icon_90635.png" alt=""></a>
                    </div>
                    <div class="control-material is-secondary">
                        <input class="material-input" type="text" required>
                        <span class="material-highlight"></span>
                        <span class="bar"></span>
                        <label>Email address</label>
                    </div>
                    <p class="has-text-left mt-30">
                        <a class="no-account is-secondary" href="#">Need Support?</a>
                    </p>
                    <div class="mt-20">
                        <button class="button button-cta btn-align secondary-btn is-fullwidth btn-outlined is-bold rounded raised no-lh">Reset Password</button>
                    </div>
                </div>
                <p class="has-text-centered">
                    <a class="return return-material is-secondary" href="#">Back to login</a>
                </p>
            </div>
            <!-- /Material recover form -->
        </div>
        <!-- /Material inputs -->
    </div>
</div>
@endsection
