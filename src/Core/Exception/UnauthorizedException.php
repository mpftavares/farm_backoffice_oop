<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

class UnauthorizedException extends HttpException
{
    public function __construct(string $message = 'Unauthorized')
    {
        parent::__construct($message, 401);
    }
}