<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Exception;
use Mpftavares\FarmBackofficeOop\Core\Controller;
use Mpftavares\FarmBackofficeOop\Core\FlashBag;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Model\Service\UsersService;

class AuthController extends Controller
{
    private UsersService $service;

    public function __construct()
    {
        $this->service = new UsersService();
    }

    public function login(): void
    {
        if ($this->isPost()) {

            // [
            //     'username' => $username,
            //     'password' => $password
            // ] = $_POST;

            $username = Request::post('username');
            $password = Request::post('password');

            try {
                $this->service->login($username, $password);
                $this->redirect("/dashboard");
            } catch (Exception $e) {
                FlashBag::add($e->getMessage(), 'danger');
            }
        }

        $this->render(
            'users/login',
            [],
            false
        );
    }

    public function register()
    {
        if ($this->isPost()) {

            // [
            //     'name' => $name,
            //     'username' => $username,
            //     'password' => $password
            // ] = $_POST;

            $username = Request::post('username');
            $password = Request::post('password');
            $name = Request::post('name');

            $this->service->createUser($name, $username, $password);

            FlashBag::add('Success');

            $this->redirect('/login');
        }

        $this->render(
            'users/form',
            [],
            false
        );
    }

    public function logout()
    {
        $this->service->logout();
        $this->redirect('/login');
    }
}
