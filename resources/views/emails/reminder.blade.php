@extends('emails.layouts.app')

@section('content')
<div class="content">
  
   <div class="fd-card">
        <div class="fd-header center">
                <div class="fd-email-image" ></div>
                <div class="fd-welcome-text" >
                    <p style="font-size:15px ; text-align:center; font-weight: 600; color:#FFFFFF">It's Time To Renew ..!  </p>
                    <p style="font-size:13px ; text-align:center; font-weight: lighter; color:#FFFFFF">text text text.</p>
                </div>       
        </div>

        <div class="fd-email-body">
            <p style="font-size:13px ;"> Dear, {{$subscriber->user->first_name}} {{$subscriber->user->last_name}}</p>
            <p class="fd-email-text">   This is a friendly remider to let you know that it's time to renew your subscription.
                You only have 2 days left, so make sure your payment informations is up to date. </p>
           
            <div class="fd-email-message">
                <p>TEXT TEXT TEXT </p>
            </div>
        </div>
   </div>
   <div class="fd-email-footer">
        <h6 style="font-size: 10px; float:left"><a href="www.shapelist.com" style="text-decoration:none;color: #484747bd;" >© Shapelist 2020 | Photography Services </a></h6>
        <h6 style="font-size: 10px; float:right"><a href="www.sparkle.sa" style="text-decoration:none;color: #484747bd;" >Powered by Sparkle Inc </a></h6>
   </div>
</div>
@endsection
               
