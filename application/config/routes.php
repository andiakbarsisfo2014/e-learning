<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['administrator'] = 'Dashboard/Dashboard/index';

$route['administrator/management/(:any)'] = 'Management/Management/path';
$route['administrator/layanan/(:any)'] = 'Layanan/Layanan/path';
$route['administrator/data-penduduk/(:any)'] = 'Penduduk/Penduduk/path';
$route['administrator/kartu-keluarga/(:any)'] = 'Kartu_keluarga/Kartu_keluarga/path';
$route['administrator/resi/(:any)'] = 'Resi/Resi/path';
$route['administrator/ambil-berkas/(:any)'] = 'Resi/Resi/path';

$route['front/(:any)'] = 'Home/Home/path';
$route['cetak/resi/(:any)'] = 'Resi/Resi/cetak/';

$route['user/login'] = 'Login/User/index';
$route['user/logout'] = 'Login/User/logout';

$route['user/validate'] = 'Login/User/validate';

$route['default_controller'] = 'Home/Home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
