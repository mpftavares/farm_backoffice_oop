<?php

namespace Mpftavares\FarmBackofficeOop\Model\Service;

use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Core\Exception\UnauthorizedException;
use Mpftavares\FarmBackofficeOop\Core\Logger;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Model\Repository\UsersRepository;

class UsersService extends Database
{
    private UsersRepository $repository;

    function __construct()
    {
        $this->repository = new UsersRepository();
    }

    function login(string $username, string $password): void
    {
        $user = $this->repository->getUserByUsername($username);

        if (is_null($user) || !password_verify($password, $user->password)) {
            // throw new Exception('Bad credentials', 401);
            throw new UnauthorizedException('Bad credentials');
        }

        // $_SESSION['user'] = $user;
        Request::session('user', $user);
        Logger::info('users', "logged in");        
    }

    function createUser(string $name, string $username, string $password): void
    {
        $this->repository->createUser($name, $username, $password);
    }

    function logout(): void
    {
        Logger::info('users', 'logged out');

        session_start();
        unset($_SESSION['user']);
    }

}
