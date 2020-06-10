@extends('emails.layouts.app')

@section('content')
<div class="content">
  
   <div class="fd-card">
        <div class="fd-header center">
                <div class="fd-email-image" ></div>
                <div class="fd-welcome-text">
                    <p style="font-size:15px ; text-align:center; font-weight: 600;"> Welcome, {{ $user->first_name}} {{$user->last_name}}</p>
                    <p style="font-size:13px ; text-align:center; font-weight: lighter; color:#FFFFFF">Glad to have you on board.</p>
                </div>       
        </div>

        <div class="fd-email-body">
            <p class="fd-email-text"> Please confirm your account by clicking the button below: </p>
            <div class="fd-button center">
                <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;margin-top: 15px;">Confirm Email</a>
            </div> 
            <div class="fd-email-message">
                <p> Once confirmed, you’ll be able to log in to Shapelist with your new account.</p>
                <p>Best Wishes,<br> Shapelist Support Team.</p>
            </div>
        </div>
   </div>
   <div class="fd-email-footer">
        <h6 style="font-size: 10px; float:left"><a href="www.shapelist.com" style="text-decoration:none;color: #484747bd;" >© Shapelist 2020 | Photography Services </a></h6>
        <h6 style="font-size: 10px; float:right"><a href="www.sparkle.sa" style="text-decoration:none;color: #484747bd;" >Powered by Sparkle Inc </a></h6>
   </div>
</div>
@endsection
               