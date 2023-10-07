<?php

require_once 'sanitization.php';
require_once 'validation.php';
require_once 'user.php';

$username = '';
$password = '';
$errors = [
    'username' => '',
    'password' => ''
];
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $errors = validateForm($username, $password);

    if (empty(array_filter($errors))) {
        registerUser($username, $password);
        echo "User registered successfully! " . $username;
    }
}