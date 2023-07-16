<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Refresh Route Name
    |--------------------------------------------------------------------------
    |
    | This value controls the used refresh route name
    |
    */
      'refresh_route_name'      => 'token.refresh',

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued tokens will be
    | considered expired.
    |
    */
     'auth_token_expiration'    => 1000,
     'refresh_token_expiration' => 2000,
];
