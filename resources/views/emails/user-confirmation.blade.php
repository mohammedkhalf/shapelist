@extends('emails.layouts.app')

@section('content')
<div class="content">
  
   <div class="fd-card">
        <div class="fd-header center">
                <p class="fd-welcome-text" style="font-size:15px"> Welcome, Fahhad Alsubaie! </p>
                <p class="fd-welcome-text"  style="font-size:13px">Glad to have you on board.</p>

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

</div>
@endsection
                        