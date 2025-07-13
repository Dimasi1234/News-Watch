<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');

//role
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/penulis', 'penulis::index', ['filter' => 'role:penulis']);
$routes->get('/user', 'User::index', ['filter' => 'role:user']);

// login
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::do_login');

// Register
$routes->match(['GET', 'POST'], 'register', 'Auth::register');

// logout
$routes->get('/logout', 'Auth::logout');

//user router
$routes->get('/', 'User::index');
$routes->get('berita/(:segment)', 'User::detail/$1');
$routes->get('/profile', 'ProfileUser::index');
$routes->get('/profile/logout', 'ProfileUser::logout');
// tag
$routes->get('/user/tag/(:segment)', 'User::filterByTag/$1');

// search
$routes->get('/user/search', 'User::search');

// Admin Routes
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('user', 'Admin::user');
    $routes->get('penulis', 'Admin::penulis');
    $routes->get('profil', 'Admin::profil');
    $routes->post('tambah_penulis', 'Admin::tambah_penulis');
    $routes->get('hapus_akun/(:num)', 'Admin::hapus_akun/$1');
    $routes->get('lihat_penulis/(:num)', 'Admin::lihat_penulis/$1');

});
$routes->get('admin/kembali', 'Admin::kembali_ke_admin');

// Penulis Routes 
$routes->group('penulis', ['filter' => 'role:penulis, admin_as_penulis'], function($routes) {
    $routes->get('/', 'Penulis::index'); // halaman dashboard
    $routes->get('create', 'Penulis::create'); // form tambah berita
    $routes->post('store', 'Penulis::store');  // proses simpan berita baru
    $routes->get('edit/(:num)', 'Penulis::edit/$1'); // form edit berita
    $routes->post('update/(:num)', 'Penulis::update/$1'); // proses update berita
    $routes->get('delete/(:num)', 'Penulis::delete/$1'); // proses hapus berita
});

// komentar
$routes->post('/komentar/simpan', 'User::submitKomentar');
