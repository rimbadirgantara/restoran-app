<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/lgt', 'Home::lgt');

// routing pembeli
$routes->get('/a', 'Pembeli::index');
$routes->add('/a/tmbh_order', 'Pembeli::tambah_order');
$routes->get('/a/(:segment)/proses', 'Pembeli::form_pesanan/$1');
$routes->add('/a/(:segment)/proses_pesanan', 'Pembeli::proses_pesanan/$1');
$routes->put('/a/(:num)/(:segment)/edit_pesanan', 'Pembeli::edit_pesanan/$1/$2'); // pertama
$routes->match(['get', 'post'], '/a/(:num)/(:segment)/sendeditpesanan', 'Pembeli::send_edit_pesanan/$1/$2'); //kedua
$routes->put('/a/(:segment)/proses_pesanan_v2', 'Pembeli::proses_pesanan_v2/$1');
$routes->delete('/a/(:segment)/delete_order', 'Pembeli::hapus_order/$1');
$routes->get('/at', 'Pembeli::tabel_transaksi');

// routing kasir
$routes->get('/k', 'Kasir::index');
$routes->delete('/k/(:segment)/hapus-kasir-order/(:segment)', 'Kasir::hapus_data_karsir_order/$1/$2');
$routes->get('/k/(:segment)/info-bill-pembeli', 'Kasir::info_bill_pembeli/$1');
$routes->match(['get', 'post'], '/k/sendbayar/(:segment)/', 'Kasir::pembayaran_bill/$1');
$routes->get('/ktbltransaksi', 'Kasir::tabeL_transaksi');

// routing admin
$routes->get('/owner', 'Admin::index');
$routes->get('/member', 'Admin::member');
$routes->post('/member', 'Admin::member');
$routes->delete('/member/(:segment)/delete', 'Admin::hapus_member/$1');
$routes->get('/member/(:segment)/edit', 'Admin::edit_member/$1');
$routes->match(['get', 'post'], '/member/(:segment)/sendedit', 'Admin::send_edit_member/$1');
$routes->get('/member/tmbhuser', 'Admin::tambah_user');
$routes->add('/member/tambah_user', 'Admin::send_data_tambah_user');
$routes->get('/order', 'Admin::order');
$routes->post('/order', 'Admin::order');
$routes->get('/profit', 'Admin::profit');
$routes->post('/profit', 'Admin::profit');
$routes->delete('/profit/del_all', 'Admin::hapus_semua_data_profit');

$routes->get('/lgt', 'Home::lgt');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
