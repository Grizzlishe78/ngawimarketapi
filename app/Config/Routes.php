<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/registrasi', 'RegistrasiController::registrasi');
$routes->post('/login', 'LoginController::login');
$routes->group('inventaris', function($routes) {
    $routes->post('/', 'InventarisController::create');
    $routes->get('/', 'InventarisController::list');
    $routes->get('(:segment)', 'InventarisController::detail/$1');
    $routes->put('(:segment)', 'InventarisController::ubah/$1');
    $routes->delete('(:segment)', 'InventarisController::hapus/$1');
});