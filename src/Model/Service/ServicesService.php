<?php

namespace Mpftavares\FarmBackofficeOop\Model\Service;

use Mpftavares\FarmBackofficeOop\Core\Database;
use Mpftavares\FarmBackofficeOop\Model\Repository\ServicesRepository;

class ServicesService extends Database
{

    private ServicesRepository $repository;

    public function __construct() {
        $this->repository = new ServicesRepository();
    }

    public function createService(string $name, string $description, array $imageFile): ?object
    {
        return $this->repository->createService($name, $description, $imageFile);
    }

    public function getAllServices(string $filter = null): array
    {
        return $this->repository->getAllServices($filter);
    }

    public function getServiceById(string $id): ?object
    {
        return $this->repository->getServiceById($id);
    }

    public function updateService(string $id, string $name, string $description, array $imageFile): ?object
    {
        return $this->repository->updateService($id,$name, $description, $imageFile);
    }

    public function removeService(string $id): bool
    {
        return $this->repository->removeService($id);
    }

}
