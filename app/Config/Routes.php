<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->get('/index', 'Home::index');//listado
// $routes->get('/show/(:num)', 'Home::show/$1');//pintar el form
// $routes->get('/new', 'Home::index');//pintar el form
// $routes->get('/create', 'Home::create'); //procear el form
// $routes->get('/edit/(:num)', 'Home::edit'); // pintar el form
// $routes->get('/update/(:num)', 'Home::update/$1');//procesar el form edicion
// $routes->get('/delete/(:num)', 'Home::delete/$1');//eliminar

// $routes->presenter('home');
// $routes->resource('home');
//Utilizar presenter para no hacer una por una de las rutas del controller
// $routes->get('/pelicula', 'Pelicula::index');

// $routes->get('/pelicula/new', 'Pelicula::create');

$routes->presenter('pelicula');
$routes->presenter('categoria');


