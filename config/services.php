<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '700018170451991',  ///find id from facebook
        'client_secret' => '6adf51b0ee01c701b808e62b7dab66f7',   ///find secret from facebook
        // 'redirect' => 'http://localhost/laravelAuth/public/login/facebook/callback',
        'redirect' => 'http://localhost:8000/login/facebook/callback',

    ],
    // 'google' => [
    //     'client_id' => env('GOOGLE_ID'),
    //     'client_secret' => env('GOOGLE_SECRET'),
    //     'redirect' => env('GOOGLE_URL'),
    // ],
    'google' => [
        'client_id' => '553005497026-lqh4bd8cro2okf8ddgluf6lpdnkk453o.apps.googleusercontent.com',
        'client_secret' => 'cXgk9Sk4GioSD6rez7SF5Dmu',
        'redirect' => 'http://localhost/laravelAuth/public/login/google/callback',
    ],

    'twitter' => [
        'client_id' => 'xyRm2SJrIa7eTWBFEaIbOKuZs ',
        'client_secret' => 'yccYX3YvX1Nqyixow8quVR2oBVHQjK5atmXVoZQ2AfUsXwe2zv ',
        'redirect' => 'http://127.0.0.1/laravelAuth/public/login/twitter/callback',
    ],

];