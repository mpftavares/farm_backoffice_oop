<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\AdminController;
use Mpftavares\FarmBackofficeOop\Core\FlashBag;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Model\Service\UsersService;

class UsersController extends AdminController
{

    private UsersService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new UsersService();
    }

    public function list()
    {
        if ($this->isPost()) {

            if (Request::post('role') === 'on') {
                $role = 'admin';
            } else {
                $role = null;
            }

            $id = Request::post('id');

            // print_r("role: " . $role);
            // // print_r($id);


            FlashBag::add('User updated');

            $this->service->edit($id, $role);

            $this->redirect('/users/list');
        }

        $search = Request::get('search');

        $users = $this->service->all($search);

        $this->render('admin/users/list', [
            'users' => $users
        ]);
    }

    public function delete(int $id)
    {
        $this->service->remove($id);

        FlashBag::add('User removed');

        $this->redirect('admin/users/list');
    }
}
