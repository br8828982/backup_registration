<?php

require_once 'db.php';

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
        die("Error executing query.");
    }
  
    return $result->fetchArray();
}