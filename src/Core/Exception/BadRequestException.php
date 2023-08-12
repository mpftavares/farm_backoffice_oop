<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

class BadRequestException extends HttpException
{
    public function __construct(string $message = 'BadRequest')
    {
        parent::__construct($message, 404);
    }
}
