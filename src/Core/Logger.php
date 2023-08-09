<?php

namespace Mpftavares\FarmBackofficeOop\Core;

use DateTime;

class Logger
{

    public static function info(string $fileName, string ...$messages): void
    {
        $now = new DateTime();

        $loggedUser = Request::session('user');

        $username = $loggedUser->name;
        $id = $loggedUser->id;

        foreach ($messages as $message) {
            file_put_contents("../logs/$fileName.log", sprintf("[%s] %s %s %s from %s\n", $now->format('Y-m-d H:i:s'), $username, $id, $message, $_SERVER['REMOTE_ADDR']), FILE_APPEND);
        }
    }
}
