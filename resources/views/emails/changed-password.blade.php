@extends('emails.layouts.app')

@section('content')
<div class="content">
  
    <div class="fd-card middle"  style="height:705px">
        <div class="fd_line"></div>
        <div class= "fd_content">
            <img src="http://shapelistapp.com/img/frontend/dashboard_images/ShapeList_Logo2_RGB.jpg" width=145  alt="facebook" title="facebook" style="display:inner">
                            <div class="fd-welcome-text">
                                    <p>   Welcome! <br>
                                    <b>  Your password has changed</b>.</p>
                            </div>
                            
                            <p class="fd-email-text"  style="width:450px ; text-transform: uppercase;">Your password has been changed successfully</p>
                            <div class="fd-email-message" >
                                <p>If you didn’t request this password change please contact the<a style="color:#23A67D"> customer support team</a></p>
                            </div>        
                            
                           <div class="fd-email-message" style="font-size:14px ; padding-top:25px;">
                                <p>  Also, if you need any help, do not hesitate to contact us anytime,</p>
                                <a style="text-decoration:none;color: #23A67D;"> info@shapelist.com </a>
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
    </div>
   
 </div>
@endsection
                        