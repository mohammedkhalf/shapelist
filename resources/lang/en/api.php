<?php

return [

    'messages' => [
        'registeration' => [
            'success' => 'You have registered successfully, Pleace check your email to activate your account..',
        ],
        'login' => [
            'success' => 'Login Successfull.',
            'failed'  => 'Wrong Username or Password',
        ],
        'logout' => [
            'success' => 'Successfully logged out.',
        ],
        'forgot_password' => [
            'success'    => 'We have sent email with reset password link. Please check your inbox!.',
            'validation' => [
                'email_not_found' => 'This email address is not registered.',
            ],
        ],
        'refresh' => [
            'token' => [
                'not_provided' => 'Token not provided.',
            ],
            'status' => 'Ok',
        ],
    ],

];
