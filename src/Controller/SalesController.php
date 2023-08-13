<?php

namespace Mpftavares\FarmBackofficeOop\Controller;

use Mpftavares\FarmBackofficeOop\Core\FlashBag;
use Mpftavares\FarmBackofficeOop\Core\Request;
use Mpftavares\FarmBackofficeOop\Core\SecuredController;
use Mpftavares\FarmBackofficeOop\Model\Service\SalesService;

class SalesController extends SecuredController
{
    private SalesService $service;

    public function __construct()
    {
        parent::__construct(); // é no parent que está implementada a autenticação
        $this->service = new SalesService();
    }

    public function list()
    {
        $search = Request::get('search');

        $sales = $this->service->all($search);

        $this->render('sales/list', [
            'sales' => $sales
        ]);
    }

    public function create()
    {
        if ($this->isPost()) {
            // ['name' => $name, 'description' => $description, 'starts' => $starts, 'ends' => $ends] = $_POST;

            $name = Request::post('name');
            $description = Request::post('description');
            $starts = Request::post('starts');
            $ends = Request::post('ends');

            // ['image' => $image] = $_FILES;
            $image = Request::file('image');

            $sale = $this->service->create($name, $description, $starts, $ends, $image);
            FlashBag::add('Sale created');

            $this->redirect('/sales/' . $sale->id);
        }

        $this->render('sales/form');
    }

    public function edit(int $id)
    {
        $sale = $this->service->get($id);

        if (is_null($sale)) {
            FlashBag::add('Sale not found');
            $this->redirect('/sales/list');
        }

        if ($this->isPost()) {
            $name = Request::post('name');
            $description = Request::post('description');
            $starts = Request::post('starts');
            $ends = Request::post('ends');

            $image = Request::file('image');

            $sale = $this->service->edit($id, $name, $description, $starts, $ends, $image);

            FlashBag::add('Sale updated');

            $this->redirect('/sales/' . $sale->id);
        }

        $this->render('sales/form', [
            'sale' => $sale
        ]);
    }

    public function delete(int $id)
    {

        $this->service->remove($id);

        FlashBag::add('Sale removed');

        $this->redirect('/sales/list');
    }

    public function detail(int $id)
    {
        $sale = $this->service->get($id);

        if (is_null($sale)) {
            FlashBag::add('Sale not found');
            $this->redirect('/sales/list');
        }

        $this->render('sales/detail', [
            'sale' => $sale
        ]);
    }
}
