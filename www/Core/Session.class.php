<?php

namespace App\Core;

class Session
{
    public static function sessionStart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get(string $key, $default = null)
    {
        Session::sessionStart();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function set(string $key, $value = null): void
    {
        Session::sessionStart();
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key): void
    {
        Session::sessionStart();
        unset($_SESSION[$key]);
    }

    public static function sessionDestroy(): void
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}