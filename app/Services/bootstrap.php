<?php

use Dotenv\Dotenv;

// Start the session globally if it's not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
