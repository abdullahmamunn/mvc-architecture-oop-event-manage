<?php
namespace App\Services;

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

    public static function getUser()
    {
        if(self::isLoggedIn()) {
            return $_SESSION['user'];
        }
        return null;
    }
}


?>
