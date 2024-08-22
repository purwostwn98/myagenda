<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/index-old', 'Umum::index');
$routes->post('/umum/dinamis/load_events', 'Umum::dinamis_load_events');
$routes->post('/umum/dinamis/dashboard_jenis_unit_change', 'Umum::dashboard_jenis_unit_change');



//authentication(get)
$routes->get('/', 'Authentication::index');
$routes->get('/cas-login', 'Authentication::login_cas');
$routes->get('/logout', 'Authentication::logout_app');
//authentication(post)
$routes->post('/manual-login', 'Authentication::manual_login');

// Kepala (POST)
$routes->post('/kepala/do-tambah-agenda', 'Kepala::do_tambah_agenda');
$routes->post('/kepala/do-edit-agenda', 'Kepala::do_edit_agenda');
// Kepala (Get)
$routes->get('/kepala/dashboard', 'Kepala::dashboard');
/// Kepala dinamis
$routes->post('/kepala/dinamis/modal_tambah_agenda', 'Kepala::modal_tambah_agenda');
$routes->post('/kepala/dinamis/modal_view_agenda', 'Kepala::modal_view_agenda');
$routes->post('/kepala/dinamis/modal_edit_agenda', 'Kepala::modal_edit_agenda');

//master data
$routes->get('/master/dosen/sync', 'Master\Dosen::sync');
$routes->get('/master/unit/sync', 'Master\Unit::sync');
$routes->get('/master/pejabat/sync', 'Master\Pejabat::sync');
