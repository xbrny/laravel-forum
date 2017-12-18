<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'facebook' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/facebook/redirect',
            'scope' => [],
        ],
        'google' => [
            'client_id' => '508d76c751cc615cfa35',
            'client_secret' => 'd9bbc1b2c6fe3451cc24bf668af04021432b655b',
            'redirect_uri' => 'http://localhost:8000/login/github/redirect',
            'scope' => [],
        ],
        'github' => [
            'client_id' => '508d76c751cc615cfa35',
            'client_secret' => 'd9bbc1b2c6fe3451cc24bf668af04021432b655b',
            'redirect_uri' => 'http://localhost:8000/login/github/callback',
            'scope' => [],
        ],
        'linkedin' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
            'scope' => [],
        ],
        'instagram' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/instagram/redirect',
            'scope' => [],
        ],
        'soundcloud' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
            'scope' => [],
        ],
    ],
];
