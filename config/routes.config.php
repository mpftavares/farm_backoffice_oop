<?php return [

'/login'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\AuthController', 'action' => 'login'],
'/register'   => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\AuthController', 'action' => 'register'],
'/logout'     => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\AuthController', 'action' => 'logout'],

'/dashboard'    => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\DashController', 'action' => 'dashboard'],

'/sales/list'        => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\SalesController', 'action' => 'list'],
'/sales/detail'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\SalesController', 'action' => 'detail'],
'/sales/create'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\SalesController', 'action' => 'create'],
'/sales/edit'        => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\SalesController', 'action' => 'edit'],
'/sales/delete'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\SalesController', 'action' => 'delete'],

'/services/list'        => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\ServicesController', 'action' => 'list'],
'/services/detail'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\ServicesController', 'action' => 'detail'],
'/services/create'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\ServicesController', 'action' => 'create'],
'/services/edit'        => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\ServicesController', 'action' => 'edit'],
'/services/delete'      => 
['controller' => 'Mpftavares\FarmBackofficeOop\Controller\ServicesController', 'action' => 'delete'],
];