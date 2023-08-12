<?php

namespace Mpftavares\FarmBackofficeOop\Core\Exception;

class NotFoundException extends HttpException
{
    public function __construct(string $message = 'Not Found')
    {
        parent::__construct($message, 404);
    }
}
