<?php return [

    // 'router' => 'endpoint'
    // 'route' => 'controller::action'

    '/login'      =>
    'Mpftavares\FarmBackofficeOop\Controller\AuthController::login',
    '/register'   =>
    'Mpftavares\FarmBackofficeOop\Controller\AuthController::register',
    '/logout'     =>
    'Mpftavares\FarmBackofficeOop\Controller\AuthController::logout',

    '/dashboard'    =>
    'Mpftavares\FarmBackofficeOop\Controller\DashController::dashboard',

    '/sales/list'        =>
    'Mpftavares\FarmBackofficeOop\Controller\SalesController::list',
    '/sales/:id'      =>
    'Mpftavares\FarmBackofficeOop\Controller\SalesController::detail',
    '/sales/create'      =>
    'Mpftavares\FarmBackofficeOop\Controller\SalesController::create',
    '/sales/:id/edit'        =>
    'Mpftavares\FarmBackofficeOop\Controller\SalesController::edit',
    '/sales/:id/delete'      =>
    'Mpftavares\FarmBackofficeOop\Controller\SalesController::delete',

    '/services/list'        =>
    'Mpftavares\FarmBackofficeOop\Controller\ServicesController::list',
    '/services/:id'      =>
    'Mpftavares\FarmBackofficeOop\Controller\ServicesController::detail',
    '/services/create'      =>
    'Mpftavares\FarmBackofficeOop\Controller\ServicesController::create',
    '/services/:id/edit'        =>
    'Mpftavares\FarmBackofficeOop\Controller\ServicesController::edit',
    '/services/:id/delete'      =>
    'Mpftavares\FarmBackofficeOop\Controller\ServicesController::delete',

    '/users/list' =>     'Mpftavares\FarmBackofficeOop\Controller\UsersController::list',
    '/users/:id/delete' =>     'Mpftavares\FarmBackofficeOop\Controller\UsersController::delete',
];
