<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WAPILOT API Token
    |--------------------------------------------------------------------------
    |
    | Your WAPILOT API token. You can get this from your WAPILOT dashboard.
    |
    */
    'token' => env('WAPILOT_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | WAPILOT API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the WAPILOT API. You shouldn't need to change this
    | unless you're using a different API endpoint.
    |
    */
    'base_url' => env('WAPILOT_API_URL', 'https://app.wapilot.io'),
];