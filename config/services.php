<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'google' => [
        'client_id' => '361120492376-7qgod4o5ttfqhvm8fbarq20ok1tdvtpe.apps.googleusercontent.com',
        'client_secret' => '85a5u9SwSS_zHc474el5EO1O',
        'redirect' => 'http://ec2-18-159-177-129.eu-central-1.compute.amazonaws.com:3000/auth/google/callback',
      ],

      'facebook' => [
        'client_id' => '686218765261547',
        'client_secret' => '84a5a356ab69dce9d7563eca460b1822',
        'redirect' => 'http://ec2-18-184-253-213.eu-central-1.compute.amazonaws.com:3000/auth/facebook/callback',
    ],  
];
    