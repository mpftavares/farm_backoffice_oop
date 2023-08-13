<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\FlashBag;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Core\SecuredController;
use Mpftavares\FarmBackofficeOop\Model\Service\ServicesService;

class ServicesController extends SecuredController
{

    private ServicesService $service;

    public function __construct()
    {
        parent::__construct(); // é no parent que está implementada a autenticação
        $this->service = new ServicesService();
    }

    public function list()
    {
        $search = Request::get('search');

        $services = $this->service->all($search);

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

            $service = $this->service->create($name, $description, $image);

            FlashBag::add('Service created');

            $this->redirect('/services/' . $service->id);
        }

        $this->render('services/form');
    }

    public function edit(int $id)
    {
        $service = $this->service->get($id);

        if (is_null($service)) {
            FlashBag::add('Service not found');
            $this->redirect('/services/list');
        }

        if ($this->isPost()) {
            $name = Request::post('name');
            $description = Request::post('description');

            $image = Request::file('image');

            $service = $this->service->edit($id, $name, $description, $image);

            $this->redirect('/services/' . $service->id);
        }

        FlashBag::add('Service updated');

        $this->render('services/form', [
            'service' => $service
        ]);
    }

    public function delete(int $id)
    {
        $this->service->remove($id);

        FlashBag::add('Service removed');

        $this->redirect('/services/list');
    }

    public function detail(int $id)
    {
        $service = $this->service->get($id);

        if (is_null($service)) {
            FlashBag::add('Service not found');
            $this->redirect('/services/list');
        }

        $this->render('services/detail', [
            'service' => $service
        ]);
    }
}
