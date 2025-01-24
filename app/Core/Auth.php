<?php
namespace App\Core;

class Auth
{
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function requireLogin()
    {
        if (!self::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }

    public static function redirectIfLoggedIn()
    {
        if (self::isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
    }
}


?>
