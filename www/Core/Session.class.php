<?php

namespace App\Core;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function all($default = null)
    {
        Session::start();
        if (!empty($_SESSION)) {
            return $_SESSION;
        } else {
            return $default;
        }
    }

    public static function get(string $key, $default = null)
    {
        Session::start();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function set(string $key, $value = null): void
    {
        Session::start();
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key): void
    {
        Session::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
