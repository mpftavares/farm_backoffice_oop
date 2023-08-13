<?php

namespace Mpftavares\FarmBackofficeOop\Core;

use Mpftavares\FarmBackofficeOop\Core\Exception\UnauthorizedException;

abstract class AdminController extends SecuredController
{

    protected $loggedUser;

    public function __construct()
    {
        parent::__construct();

        if (!$this->isAdmin()) {
            throw new UnauthorizedException();
        }
    }

    static public function isAdmin(): bool
    {
        $loggedUser = Request::session('user');

        return $loggedUser->role === 'admin';
    }   

    
}
