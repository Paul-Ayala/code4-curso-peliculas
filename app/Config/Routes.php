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


// $routes->presenter('pelicula');
// $routes->presenter('categoria');
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes){
    $routes->resource('pelicula');
    $routes->resource('categoria');
});

$routes->group('dashboard', function($routes){
    //Por defecto buscan en: App\Controllers\
    // $routes->presenter('pelicula');
    // $routes->presenter('categoria');
    //rutas por nombre
    $routes->get('test', 'Pelicula::test', [ 'as' => 'test'] );
    //puede recibir argumentos:
    // $routes->get('test/(:num)', 'Pelicula::test/$1', [ 'as' => 'test'] );
    // pero en la ruta hay que cambiarle en function se espera $parametro y en botones se podría hacer:
    // route_to('test', 5)
    //limitar rutas:
        //para mostrar solo 1:
        //$routes->presenter('categoria', ['only' => 'index']);
        // mostrar las que se quieren:
        // $routes->presenter('categoria', ['only' => ['index', 'new', 'create']]);
        //Mostrar todas, excepto las que se indiquen:
        //$routes->presenter('categoria', ['except' => 'index']);
        //$routes->presenter('categoria', ['except' => ['index', 'new', 'create']]);
        //rutas desde una carpeta en controllers:App\Controllers\Dashboard
        $routes->presenter('pelicula', ['controller' => 'Dashboard\pelicula']);
        $routes->presenter('categoria',  ['controller' => 'Dashboard\categoria']); 
        //$routes->get('/test', Dashboard\Test::index)

        //TEST USER
        // $routes->get('usuario/crear', '\App\Controllers\Web\Usuario::crear_usuario'); 
        // $routes->get('usuario/probar/contrasena', '\App\Controllers\Web\Usuario::probar_contrasena'); 
    });

    $routes->get('login', '\App\Controllers\Web\Usuario::login', ['as' => 'usuario.login']);
    $routes->post('login_post', '\App\Controllers\Web\Usuario::login_post', ['as' => 'usuario.login_post']);

    $routes->get('register', '\App\Controllers\Web\Usuario::register', ['as' => 'usuario.register']);
    $routes->post('register_post', '\App\Controllers\Web\Usuario::register_post', ['as' => 'usuario.register_post']);
    $routes->get('logout', '\App\Controllers\Web\Usuario::logout', ['as' => 'usuario.logout']);


