<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\SecuredController;
use Mpftavares\FarmBackofficeOop\Model\Service\UsersService;

class DashController extends SecuredController
{
    public function dashboard()
    {
        $this->render('dashboard');
    }
}
