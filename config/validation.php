<?php

return [
    'registration' => [
        'user' => [
            'identifier' => 'required|unique:users,identifier',
            'first_name' => 'required|max:75',
            'last_name' => 'required|max:75',
            'email' => 'required|email|max:175|unique:users,email',
            'password' => 'required'
        ],
        'band' => [
            'band_name' => 'required|max:255',
        ]
    ]
];