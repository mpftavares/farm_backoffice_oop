<?php

namespace Mpftavares\FarmBackofficeOop\Model\Repository;

use PDOException;
use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Core\Exception\InternalServerErrorException;
use Mpftavares\FarmBackofficeOop\Core\Logger;

class UsersRepository extends Database
{
    const TABLE = 'users';

    function get(string $id): ?object
    {
        $user = $this->select(self::TABLE, ['id' => $id]);
        return isset($user[0]) ? $user[0] : null; //porque o select retorna uma array
    }

    function username(string $username): ?object
    {
        $user = $this->select(self::TABLE, ['username' => $username]);
        return isset($user[0]) ? $user[0] : null; //porque o select retorna uma array
    }

    function create(string $name, string $username, string $password): void
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

    public function all(string $filter = null): array
    {
        $sql = "SELECT * FROM users";
        $data = [];

        if (!is_null($filter)) {
            $sql .= " WHERE (name LIKE :filter OR id LIKE :filter)";
            $data['filter'] = '%' . $filter . '%';
        }

        $stmt = $this->raw($sql);
        $stmt->execute($data);

        return $stmt->fetchAll();
    }

    public function remove(string $id): bool
    {
        $user = $this->get($id);

        $stmt = $this->delete(self::TABLE, [
            'id' => $id
        ]);

        Logger::info('users', "user $user->id $user->name removed");

        return $stmt->rowCount() > 0; // porque removeuser devolve uma PDOStatment
    }

    public function edit(string $id, ?string $role): void {

        $user = $this->get($id);

        $data = [
            'role' => $role
        ];

        $this->update(self::TABLE, $data, ['id' => $id]);

        Logger::info('users', "updated user $user->id $user->name role to $role");
    }
}
