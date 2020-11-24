<?php

return [
    //Return the information for cookie
    'cookie' => [
        'name' =>env('CART_COOKIE_NAME','cart_cookie'),
        'expiration' => 7 * 24 * 60, //One week
    ]
];
