@extends('emails.layouts.app')

@section('content')  
    <div class="fd-card middle"  style="text-align: left;">
        <div class="fd_line"></div>
        <div class= "fd_content">
            <img src="http://shapelistapp.com/img/frontend/dashboard_images/ShapeList_Logo2_RGB.jpg" width=145  alt="shapelist"  style="display:inner">

                    <div class="fd-welcome-text">
                        <p>  Welcome, {{ $user->first_name}} {{$user->last_name}}!<br>
                            Glad to have you on board.</p>
                    </div>
                        
                    <p class="fd-email-text"> Please confirm your account by clicking the button below: </p>
                        
                    <div class="fd-button" style=" top: 360px;left: 30px; width: 144px;height: 38px; background: #23A67D 0% 0% no-repeat padding-box;
                    border-radius: 4px; opacity: 1; padding-top:15px; padding-left:21px;">
                        <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;margin-top: 15px;">Confirm Email</a>
                    </div> 
                <div class="fd-email-message">
                    <p> Once confirmed, you’ll be able to log in to Shapelist with your new account.</p>
                </div>
                <div class="fd-best">
                    <p>Best Wishes,<br> Shapelist Support Team.</p>
                </div>
                    
                <a href="#" > <img src="https://i.ibb.co/ggVXqNB/facebook.png" width=14  alt="facebook" title="facebook" style="display:inner"></a>
                <a href="#" > <img src="https://i.ibb.co/NSY4skD/twitter.png" width=14 alt="twitter" title="twitter" style="display:inner"></a> 
            <div class="fd-email-footer">
                <h6 style="font-size: 10px; float:left"><a href="www.shapelist.com" style="text-decoration:none;color: #484747bd;" >© Shapelist 2020 | Photography Services </a></h6>
                <h6 style="font-size: 10px; float:right"><a href="www.sparkle.sa" style="text-decoration:none;color: #484747bd;" >Powered by Sparkle Inc </a></h6>
            </div>
            
    </div>
   
@endsection
               