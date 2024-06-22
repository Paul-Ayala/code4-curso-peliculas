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
    $routes->get('pelicula/paginado', 'Pelicula::paginado');
    $routes->get('pelicula/paginado_full', 'Pelicula::paginado_full');
    $routes->get('pelicula/index_por_categoria/(:num)', 'Pelicula::index_por_categoria/$1');
    $routes->get('pelicula/index_por_etiqueta/(:num)', 'Pelicula::index_por_etiqueta/$1');
    $routes->post('pelicula/etiqueta/(:num)', 'Pelicula::etiquetas_post/$1');
    $routes->delete('pelicula/(:num)/etiqueta/(:num)/delete', 'Pelicula::etiqueta_delete/$1/$2');
    $routes->post('pelicula/(:num)/imagen/upload', 'Pelicula::upload/$1');
    $routes->delete('pelicula/(:num)/imagen/delete/(:num)', 'Pelicula::borrar_imagen/$1/$2');
    $routes->resource('pelicula');
    $routes->resource('categoria');
    $routes->resource('etiqueta');

});

$routes->group('dashboard', function($routes){
    //Por defecto buscan en: App\Controllers\
    // $routes->presenter('pelicula');
    // $routes->presenter('categoria');
    //rutas por nombre
    $routes->get('test', 'Pelicula::test', [ 'as' => 'test'] );

    $routes->get('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1/$2', ['as' => 'pelicula.etiqueta_delete']);
    $routes->post('pelicula/imagen_delete/(:num)/(:num)', 'Dashboard\Pelicula::borrar_imagen/$1/$2', ['as' => 'pelicula.borrar_imagen']);
    $routes->post('pelicula/imagen_descargar/(:num)', 'Dashboard\Pelicula::descargar_imagen/$1', ['as' => 'pelicula.descargar_imagen']);
    
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
        $routes->presenter('etiqueta', ['controller' => 'Dashboard\etiqueta']);


        //$routes->get('/test', Dashboard\Test::index)

        //TEST USER
        // $routes->get('usuario/crear', '\App\Controllers\Web\Usuario::crear_usuario'); 
        // $routes->get('usuario/probar/contrasena', '\App\Controllers\Web\Usuario::probar_contrasena'); 

    });

    $routes->group('blog', function($routes){
        //se le puede poner "pelicula" en donde está: ''
        // $routes->presenter('', ['controller' => 'Blog\pelicula', 'only'=> ['index', 'show']]);
        $routes->get('', 'Blog\pelicula::index', ['as' => 'blog.pelicula.index']);
        $routes->get('categorias/(:num)', 'Blog\pelicula::index_por_categoria/$1', ['as' => 'blog.pelicula.index_por_categoria']);
        $routes->get('etiquetas/(:num)', 'Blog\pelicula::index_por_etiqueta/$1', ['as' => 'blog.pelicula.index_por_etiqueta']);
        $routes->get('(:num)', 'Blog\pelicula::show/$1', ['as' => 'blog.pelicula.show']);
        $routes->get('etiquetas_por_categoria/(:num)', 'Blog\pelicula::etiquetas_por_categoria/$1', ['as' => 'blog.pelicula.etiquetas_por_categoria']);        
    });

    $routes->get('login', '\App\Controllers\Web\Usuario::login', ['as' => 'usuario.login']);
    $routes->post('login_post', '\App\Controllers\Web\Usuario::login_post', ['as' => 'usuario.login_post']);

    $routes->get('register', '\App\Controllers\Web\Usuario::register', ['as' => 'usuario.register']);
    $routes->post('register_post', '\App\Controllers\Web\Usuario::register_post', ['as' => 'usuario.register_post']);
    $routes->get('logout', '\App\Controllers\Web\Usuario::logout', ['as' => 'usuario.logout']);
    $routes->get('/image/(:any)', 'Dashboard\Pelicula::image/$1', ['as' => 'get_image']);


