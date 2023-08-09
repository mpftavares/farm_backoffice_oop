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

    public function createSale(string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        return $this->repository->createSale($name, $description, $starts, $ends, $imageFile);
    }

    public function getAllSales(string $filter = null): array
    {
        return $this->repository->getAllSales($filter);
    }

    public function getSaleById(string $id): ?object
    {
        return $this->repository->getSaleById($id);
    }

    public function updateSale(string $id, string $name, string $description, string $starts, string $ends, array $imageFile): ?object
    {
        return $this->repository->updateSale($id,$name, $description, $starts, $ends, $imageFile);
    }

    public function removeSale(string $id): bool
    {
        return $this->repository->removeSale($id);
    }

}
