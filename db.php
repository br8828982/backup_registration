<?php

function createDatabase() {
    $db = new SQLite3('registration.db');
    if (!$db) {
        die("Error creating database.");
    }
    return $db;
}