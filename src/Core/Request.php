<?php namespace Mpftavares\FarmBackofficeOop\Core;

class Request {

    public static function get(string $key, string $defaultValue = null): ?string {
        return $_GET[$key] ?? $defaultValue;

    }
    
    public static function post(string $key, string $defaultValue = null): ?string {
        return $_POST[$key] ?? $defaultValue;

    }
    
    public static function file(string $key): ?array {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    public static function session(string $key, mixed $value = null): mixed {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (is_null($value)) {
            return $_SESSION[$key] ?? null;
        }

        $_SESSION[$key] = $value;
        return $value;

        // substitui $_SESSION['user'] = $user;
    }

    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}