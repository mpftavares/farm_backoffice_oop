<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

class InternalServerErrorException extends HttpException
{
    public function __construct(string $message = 'Internal Server Error')
    {
        parent::__construct($message, 404);
    }
}
