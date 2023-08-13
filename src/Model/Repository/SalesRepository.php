<?php

namespace Mpftavares\FarmBackofficeOop\Model\Repository;

use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Core\Logger;

class SalesRepository extends Database
{

    const TABLE = 'sales';

    public function create(string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        $image = $this->uploadImage($imageFile);

        $sale =
            $this->insert(self::TABLE, [
                'name' => $name,
                'description' => $description,
                'starts' => $starts,
                'ends' => $ends,
                'image' => $image
            ]);

        $id = $sale['lastInsertId'];

        Logger::info('sales', "created $name $id sale");

        return $this->get($id);
    }

    public function uploadImage(array $file): ?string
    {
        $id = uniqid();

        $filename = "images/sales/$id.png";

        if (move_uploaded_file($file['tmp_name'], $filename)) {
            return $filename;
        }
        return null;
    }

    public function all(string $filter = null): array
    {
        $sql = "SELECT * FROM sales";
        $data = [];

        if (!is_null($filter)) {
            $sql .= " WHERE (name LIKE :filter OR description LIKE :filter)";
            $data['filter'] = '%' . $filter . '%';
        }

        $stmt = $this->raw($sql);
        $stmt->execute($data);

        return $stmt->fetchAll();
    }

    public function get(string $id): ?object
    {
        $sale = $this->select(self::TABLE, [
            'id' => $id
        ]);

        return isset($sale[0]) ? $sale[0] : null; // porque select retorna uma array
    }

    public function edit(string $id, string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'starts' => $starts,
            'ends' => $ends,
        ];

        if ($imageFile['name'] != '') {
            $image = $this->uploadImage($imageFile);
            $data['image'] = $image;
        }

        $this->update(self::TABLE, $data, ['id' => $id]);

        Logger::info('sales', "updated $name $id sale");

        return $this->get($id);
    }

    public function remove(string $id): bool
    {
        $sale = $this->get($id);

        if (!empty($sale->image)) {
            unlink($sale->image);
        }

        $stmt = $this->delete(self::TABLE, [
            'id' => $id
        ]);

        Logger::info('sales', "removed $sale->name $sale->id sale");

        return $stmt->rowCount() > 0; // porque removeSale devolve uma PDOStatment
    }
}
