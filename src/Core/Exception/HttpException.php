<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

use Exception;
use Mpftavares\FarmBackofficeOop\Core\Response;

abstract class HttpException extends Exception
{
    public function __construct(string $message = 'Internal Server Error', int $code = 500)
    {
        Response::status($code, $message);
        parent::__construct($message, $code);
    }
}
