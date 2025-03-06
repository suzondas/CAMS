@extends('voyager::auth.master')

@section('content')
    <style>
        .login-sidebar{
            overflow-y: scroll !important;
        }
        .login-container{
            top:30% !important;
            padding:5px;
        }
    </style>
    <div class="login-container">
        <h3 style="color:dodgerblue;">একাদশ শ্রেণী ভর্তি সিস্টেমে স্বাগতম</h3>
        <table class="table table-bordered">
            <tr>
                <td>নির্দেশিকা দেখতে
                </td>
                <td><a href="#"
                       style=""
                       class="">নির্দেশিকা
                        ডাউনলোড করুন</a></td>
            </tr>
            <tr>
                <td>নতুন ব্যবহারকারী হলে
                </td>
                <td>
                    <a href="{{ route('student.register') }}"
                       style=""
                       class="">Registration
                        করুন</a>
                </td>
            </tr>
        </table>
        @if(session('success'))
            <div class="card" style="color:green;font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif
        <h5 style="padding-top: 15px;margin-bottom: 0;padding-bottom: 0;">একাউন্ট থাকলে লগইন করুন</h5>

        <form action="{{ route('voyager.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group form-group-default" id="emailGroup">
                {{--                <label>{{ __('voyager::generic.email') }}</label>--}}
                <label>Registered Mobile Number</label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Mobile Number"
                           class="form-control" required>
                </div>
            </div>

            <div class="form-group form-group-default" id="passwordGroup">
                <label>{{ __('voyager::generic.password') }}</label>
                <div class="controls">
                    <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}"
                           class="form-control" required>
                </div>
            </div>

            {{--<div class="form-group" id="rememberMeGroup">
                <div class="controls">
                    <input type="checkbox" name="remember" id="remember" value="1"><label for="remember"
                                                                                          class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                </div>
            </div>--}}

            <button type="submit" class="btn btn-block login-button">
                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                <span class="signin">{{ __('voyager::generic.login') }}</span>
            </button>

        </form>

        <div style="clear:both"></div>


        @if(!$errors->isEmpty())
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> <!-- .login-container -->
@endsection

@section('post_js')

    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function (ev) {
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function (e) {
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function (e) {
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function (e) {
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function (e) {
            document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
@endsection
