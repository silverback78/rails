<?php
session_start();

require 'vendor/autoload.php';
require_once('Services/Utils.php');

Flight::route('GET /get/@key', function($key) {
    $sessionData = null;
    if (isset($_SESSION[$key])) {
        $sessionData = $_SESSION[$key];
    }
    Flight::json($sessionData);
});

Flight::route('PUT /set', function() {
    $key = Flight::request()->data->key;
    $value = Flight::request()->data->value;

    if (Utils::IsNullOrWhitespace($value) && isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
    else {
        $_SESSION[$key] = $value;
    }

    Flight::json($value);
});

Flight::start();
?>