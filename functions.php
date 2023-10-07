//All in one file

<?php

function createDatabase() {
    $db = new SQLite3('registration.db');
    if (!$db) {
        die("Error creating database.");
    }
    return $db;
}

function createTable() {
    $db = createDatabase();
  
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL
    )";
    $db->exec($query);
}

function registerUser($username, $password) {
    $db = createDatabase();
  
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
    
    $result = $stmt->execute();
    
    if (!$result) {
        die("Error registering user.");
    }
}

function fetchUser($username) {
    $db = createDatabase();
    $stmt = $db->prepare("SELECT username FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
      
    if (!$result) {
        die("Error fetching user.");
    }
  
    return $result->fetchArray();
}

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

function sanitizeInput($input) {
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    $input = strip_tags($input);

    return $input;
}