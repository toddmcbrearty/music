<?php
$user_validation = [
    'user_name' => 'required|max:255',
    'user_email' => 'required|email|max:255|unique:users',
    'user_password' => 'required|confirmed|min:6',
];
$band_validation = [
    'band_name' => 'required|max:255',
];

return [
    'types' => [
        'band' => [
            'validation' => [
                $user_validation,
                $band_validation,
            ],
        ]
    ],
];