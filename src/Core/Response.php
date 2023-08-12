<?php

namespace Mpftavares\FarmBackofficeOop\Core;

class Response
{
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit(301);
    }

    public static function contentType(string $type): void
    {
        header('Content-Type: ' . $type);
    }

    public static function status(int $code, string $message): void
    {
        header("HTTP/1.1 $code $message");
    }

    public static function json(mixed $data): void
    {
        static::contentType('application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public static function error(int $code): void
    {
        switch ($code) {
            case 201:
                static::status(201, 'Created');
                break;
            case 204:
                static::status(204, 'No Content');
                break;
            case 400:
                static::status(400, 'Bad Request');
                break;
            case 401:
                static::status(401, 'Unauthorized');
                break;
            case 403:
                static::status(403, 'Forbidden');
                break;
            case 404:
                static::status(404, 'Not Found');
                break;
            case 405:
                static::status(405, 'Method Not Allowed');
                break;
            case 500:
                static::status(500, 'Internal Server Error');
                break;
        }
    }
}
