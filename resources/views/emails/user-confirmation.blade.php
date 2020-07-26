@extends('emails.layouts.app')

@section('content')
<div class="content">
  
    <div class="fd-card middle">
        <div class="fd_line"></div>
        <div class= "fd_content">
            <div class="fd-email-image" ></div>
                    <div class="fd-welcome-text">
                        <p>  Welcome, {{ $user->first_name}} {{$user->last_name}}
                            Glad to have you on board.</p>
                    </div>
                        
                    <p class="fd-email-text"> Please confirm your account by clicking the button below: </p>
                        
                    <div class="fd-button">
                        <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;margin-top: 15px;">Confirm Email</a>
                    </div> 
                <div class="fd-email-message">
                    <p> Once confirmed, you’ll be able to log in to Shapelist with your new account.</p>
                </div>
                <div class="fd-best">
                    <p>Best Wishes,<br> Shapelist Support Team.</p>
                </div>
                    
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-tweeter"></a>
        
            <div class="fd-email-footer">
                <h6 style="font-size: 10px; float:left"><a href="www.shapelist.com" style="text-decoration:none;color: #484747bd;" >© Shapelist 2020 | Photography Services </a></h6>
                <h6 style="font-size: 10px; float:right"><a href="www.sparkle.sa" style="text-decoration:none;color: #484747bd;" >Powered by Sparkle Inc </a></h6>
            </div>
            
    </div>
                       
</div>
   
@endsection
               