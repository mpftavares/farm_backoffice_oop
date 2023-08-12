<?php

namespace Mpftavares\FarmBackofficeOop\Model\Repository;

use PDOException;
use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Core\Exception\InternalServerErrorException;

class UsersRepository extends Database
{
    const TABLE = 'users';

    function getUserByUsername(string $username): ?object
    {
        $user = $this->select(self::TABLE, ['username' => $username]);
        return isset($user[0]) ? $user[0] : null; //porque o select retorna uma array
    }

    function createUser(string $name, string $username, string $password): void
    {
        try {
            $this->insert(self::TABLE, [
                'username' => $username,
                'name' => $name,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);
        } catch (PDOException $e) {
            // $this->logAccess('failed to create user');
            // throw new Exception('Error', 500);
            throw new InternalServerErrorException();
        }
    }
}
