<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\FlashBag;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Core\SecuredController;
use Mpftavares\FarmBackofficeOop\Model\Service\ServicesService;

class ServicesController extends SecuredController {
private ServicesService $service;

    public function __construct()
    {
        // parent::__construct(); // é no parent que está implementada a autenticação
        $this->service = new ServicesService();
    }

    public function list()
    {
        $search = Request::get('search');

        $services = $this->service->getAllServices($search);

        $this->render('services/list', [
            'services' => $services
        ]);
    }

    public function create()
    {
        if ($this->isPost()) {
            // ['name' => $name, 'description' => $description, 'starts' => $starts, 'ends' => $ends] = $_POST;

            $name = Request::post('name');
            $description = Request::post('description');

            // ['image' => $image] = $_FILES;
            $image = Request::file('image');

            $service = $this->service->createService($name, $description, $image);

            FlashBag::add('Service created');

            $this->redirect('/services/detail?id=' . $service->id);
        }

        $this->render('services/form');
    }

    public function edit()
    {
        // $id = $_GET['id'];
        $id = Request::get('id');
        $service = $this->service->getServiceById($id);

        if (is_null($service)) {
            FlashBag::add('Service not found');
            $this->redirect('/services/list');
        }

        if ($this->isPost()) {
            $name = Request::post('name');
            $description = Request::post('description');

            $image = Request::file('image');

            $service = $this->service->updateService($id, $name, $description, $image);

            $this->redirect('/services/detail?id=' . $service->id);
        }

        FlashBag::add('Service updated');

        $this->render('services/form', [
            'service' => $service
        ]);
    }

    public function delete()
    {
        $id = Request::get('id');

        $this->service->removeService($id);

        FlashBag::add('Service removed');

        $this->redirect('/services/list');
    }

    public function detail()
    {
        $id = Request::get('id');
        $service = $this->service->getServiceById($id);

        if (is_null($service)) {
            FlashBag::add('Service not found');
            $this->redirect('/services/list');
        }

        $this->render('services/detail', [
            'service' => $service
        ]);
    }
}