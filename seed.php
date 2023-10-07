<?php

require_once 'db.php';

function createTable() {
    $db = createDatabase();
  
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL
    )";
    $db->exec($query);
    echo "Table created successfully!";
}

createTable();