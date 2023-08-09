<?php

namespace Mpftavares\FarmBackofficeOop\Model\Repository;

use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Core\Logger;

class ServicesRepository extends Database
{

    const TABLE = 'services';

    public function createService(string $name, string $description, array $imageFile): ?object
    {
        $image = $this->uploadImage($imageFile);

        $service =
            $this->insert(self::TABLE, [
                'name' => $name,
                'description' => $description,
                'image' => $image
            ]);

        $id = $service['lastInsertId'];

        Logger::info('services', "created $name $id service");

        return $this->getServiceById($id);
    }

    public function uploadImage(array $file): ?string
    {
        $id = uniqid();

        $filename = "images/services/$id.png";

        if (move_uploaded_file($file['tmp_name'], $filename)) {
            return $filename;
        }
        return null;
    }

    public function getAllServices(string $filter = null): array
    {
        $sql = "SELECT * FROM services";
        $data = [];

        if (!is_null($filter)) {
            $sql .= " WHERE (name LIKE :filter OR description LIKE :filter)";
            $data['filter'] = '%' . $filter . '%';
        }

        $stmt = $this->raw($sql);
        $stmt->execute($data);

        return $stmt->fetchAll();
    }

    public function getServiceById(string $id): ?object
    {
        $service = $this->select(self::TABLE, [
            'id' => $id
        ]);

        return isset($service[0]) ? $service[0] : null; // porque select retorna uma array
    }

    public function updateService(string $id, string $name, string $description, array $imageFile): ?object
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
        ];

        if ($imageFile['name'] != '') {
            $image = $this->uploadImage($imageFile);
            $data['image'] = $image;
        }

        $this->update(self::TABLE, $data, ['id' => $id]);

        Logger::info('services', "updated $name $id service");

        return $this->getServiceById($id);
    }

    public function removeService(string $id): bool
    {
        $service = $this->getServiceById($id);

        if (!empty($service->image)) {
            unlink($service->image);
        }

        $stmt = $this->delete(self::TABLE,[
            'id' => $id
        ]);

        Logger::info('services', "removed $service->name $service->id service");

        return $stmt->rowCount() > 0; // porque removeService devolve uma PDOStatment
    }

}
