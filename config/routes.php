<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $routes->connect('/', ['controller' => 'Accounts', 'action' => 'login']);
    
    // Login and logout routes
    $routes->connect('/login', ['controller' => 'Accounts', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Accounts', 'action' => 'login']); 
    
    // Dashboard route
    $routes->connect('/dashboard', ['controller' => 'Products', 'action' => 'view']);
    
    // Product management routes with id parameter
    $routes->connect('/add-product', ['controller' => 'Products', 'action' => 'add']);
    $routes->connect('/edit-product/:id', ['controller' => 'Products', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect('/delete-product/:id', ['controller' => 'Products', 'action' => 'delete'], ['pass' => ['id']]);
    
    // Fallback for other routes
    $routes->fallbacks(DashedRoute::class);
});