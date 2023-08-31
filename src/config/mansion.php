<?php

return [
    /**
     * Config Mansion
     * 
     * You can change this to your mansion url, id or secret key
     */
    'url' => env('MANSION_URL', 'http://a.kabayanconsulting.co.id/mansion/public'),
    'auth_url' => '/oauth/authorize',
    'client_id' => env('MANSION_CLIENT_ID', null),
    'client_secret' => env('MANSION_CLIENT_SECRET', null)
];