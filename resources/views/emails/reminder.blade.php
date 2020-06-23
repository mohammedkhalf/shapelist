@extends('emails.layouts.app')

@section('content')
<div class="content">
  
   <div class="fd-card">
        <div class="fd-header center">
                <div class="fd-email-image" ></div>
                <div class="fd-welcome-text">
                <p style="font-size:15px ; text-align:center; font-weight: 600;"> Hello, {{$subscriber->user->first_name}} {{$subscriber->user->last_name}}</p>
                    <p style="font-size:13px ; text-align:center; font-weight: lighter; color:#FFFFFF"> Subscriptions Reminder </p>
                </div>       
        </div>

        <div class="fd-email-body"  style=" color: #000000e3">
            <p class="fd-email-text"> Your subscription is about to expire, Visit your dashboard and renew your subscription to keep your points! </p>
            <div class="fd-button center" style="margin-top: 30px !important;">
                <a href="#" style="color: #ffffff; text-decoration: none;margin-top: 15px;"> Visit your dashboard </a>
            </div> 
            <div class="fd-email-message" style=" color: #000000e3">
                <p style="font-weight: 500;"> Also, if you need any help, do not hesitate to contact us anytime,<b><a style="text-decoration:none;color: #000000;"> info@shapelist.com </a></b></p>
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
               
               
