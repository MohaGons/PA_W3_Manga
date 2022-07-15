<?php

namespace App\Core;

use App\Core\Session as Session;

class MessageFlash
{
    public static function setError($error)
    {
        Session::set('error', $error);
    }

    public static function getError()
    {
        $error = Session::get('error');

        $html = "";
        if (!empty($error)) {
            foreach ($error as $value) {
                $html .= "<div class='alert alert-primary' role='alert'>"
                            .$value.
                         "</div>";
            }
        }
        return $html;

    }

    public static function success($default = null)
    {
        Session::start();
        if (!empty($_SESSION)) {
            return $_SESSION;
        } else {
            return $default;
        }
    }

    public static function warning(string $key, $default = null)
    {
        Session::start();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function info(string $key, $value = null): void
    {
        Session::start();
        $_SESSION[$key] = $value;
    }

}
