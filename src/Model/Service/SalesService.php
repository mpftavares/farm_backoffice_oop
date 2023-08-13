<?php

namespace Mpftavares\FarmBackofficeOop\Model\Service;

use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Model\Repository\SalesRepository;

class SalesService extends Database
{

    private SalesRepository $repository;

    public function __construct() {
        $this->repository = new SalesRepository();
    }

    public function create(string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        return $this->repository->create($name, $description, $starts, $ends, $imageFile);
    }

    public function all(string $filter = null): array
    {
        return $this->repository->all($filter);
    }

    public function get(string $id): ?object
    {
        return $this->repository->get($id);
    }

    public function edit(string $id, string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        return $this->repository->edit($id, $name, $description, $starts, $ends, $imageFile);
    }

    public function remove(string $id): bool
    {
        return $this->repository->remove($id);
    }

}
