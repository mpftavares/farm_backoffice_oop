<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\SecuredController;

class DashController extends SecuredController

{
    public function dashboard()
    {
        $this->render('dashboard');
    }
}
