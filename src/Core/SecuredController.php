<?php

namespace Mpftavares\FarmBackofficeOop\Core;

use Mpftavares\FarmBackofficeOop\Model\Service\UsersService;

abstract class SecuredController extends Controller
{

    protected $loggedUser;

    public function __construct()
    {
        // if (!isset($_SESSION['user'])) {
        //     $this->redirect("/login?status=403");
        // }

        $this->loggedUser = Request::session('user');

        if (is_null($this->loggedUser)) {
            $this->redirect("/login?status=403");
        }
    }
}
