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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'facebook' => [
        'client_id' => '1301206500686671',
        'client_secret' => '477a560bf5646ce882137ca91ef607ab',
        'redirect' => 'https://eboro.it/login/facebook/callback',
    ],

    'apple' => [
        'client_id' => 'com.codiano.eboro.signin',
        'client_secret' => '',
        'team_id' => '97A3NA2QQ4',
        'key_id' => 'D4562248W5',
        'private_key' => 'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQglRD2YlfyyLr0vebm7g6sULVD8i1qaiZZjc7VcttP6wugCgYIKoZIzj0DAQehRANCAAQrtLnImezxqvjWxMlHO0qOSGfnIACkM582Fxwz65BpM7K35H5qYkKbxs9YfvMT7qcwYRPMeYHCMp7Y05yPPsf/',
        'redirect' => 'https://eboro.it/login/apple/callback',
    ],


    'google' => [
        'client_id' => '518450529483-f2jee8vctfn3kt4d9hg7oe9voc6mrhi6.apps.googleusercontent.com',
        'client_secret' => 'I0D5aw4T-57zYclODLtaw_Ox',
        'redirect' => 'https://eboro.it/login/google/callback',
    ],
];
