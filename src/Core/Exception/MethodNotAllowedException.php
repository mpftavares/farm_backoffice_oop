<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

class MethodNotAllowedException extends HttpException
{
    public function __construct(string $message = 'Method Not Allowed')
    {
        parent::__construct($message, 404);
    }
}
