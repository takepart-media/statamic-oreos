<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Name
    |--------------------------------------------------------------------------
    |
    | If the user consents (even if not), the addon needs a way to store that
    | information. This is done in a cookie with the following name. No cookie
    | is set if the user does nothing.
    |
    */

    'enabled' => env('TP_OREOS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Name
    |--------------------------------------------------------------------------
    |
    | If the user consents (even if not), the addon needs a way to store that
    | information. This is done in a cookie with the following name. No cookie
    | is set if the user does nothing.
    |
    */

    'cookie_name' => env('TP_OREOS_NAME', 'TP_OREOS'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Groups
    |--------------------------------------------------------------------------
    |
    | Define the cookie groups you want your users to choose from whether they
    | like to consent to the group or not. Titles and description texts are
    | editable within the control panel section.
    */

    'groups' => [
        'essential' => [
            'required' => true,
            'default' => true
        ],
        'analytics' => [
            'required' => false,
            'default' => true,
        ],
        'embeds' => [
            'required' => false,
            'default' => false,
        ],
    ],

];
