<?php

function validateForm($username, $password) {
    $errors = [
        'username' => '',
        'password' => ''
    ];

    if (empty($username)) {
        $errors['username'] = 'Username is required.';
    } elseif (strlen($username) < 4) {
        $errors['username'] = 'Username must be 4 Characters long.';
    } elseif (fetchUser($username)) {
        $errors['username'] = 'Username already exists.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be 6 Characters long.';
    }

    return $errors;
}