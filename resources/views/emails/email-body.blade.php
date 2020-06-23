@extends('emails.layouts.app')

@section('content')
<div class="content">
   <div class="fd-card">
        <div class="fd-header center">
                <div class="fd-email-image" ></div>
                <div class="fd-welcome-text">
                    <p style="font-size:15px ; text-align:center; font-weight: 600;"> Welcome, User</p>
                    <p style="font-size:13px ; text-align:center; font-weight: lighter; color:#FFFFFF">Your Order Has Been Placed Shapelist!</p>
                </div>       
        </div>

        <div class="fd-email-body">
            <p class="fd-email-text"> Your Order ID :  #91394  </p>
            <p class="fd-email-text"> We will be working to capture the beauty of your product. </p>
            <div class="fd-button center">
                <a href="" style="color: #ffffff; text-decoration: none;margin-top: 15px;">Track Order</a>
            </div> 
            <div class="fd-email-message">
                <p>if you need any help, do not hesitate to content us anytime, <bold>info@shapelist.com </bold> </p>
            </div>
            <div class="fd-email-message">
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
               