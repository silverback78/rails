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

Flight::route('GET /setString/@key/@value', function($key, $value) {
    $_SESSION[$key] = $value;
    Flight::json($_SESSION[$key]);
});

Flight::route('POST /set', function() {
    $key = Utils::GetPostVar('key');
    $value = Utils::GetPostVar('value');

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