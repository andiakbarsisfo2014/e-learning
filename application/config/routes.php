<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['administrator/guru/(:any)'] = 'Guru/Guru/path';
$route['administrator/siswa/(:any)'] = 'Siswa/Siswa/path';
$route['administrator/mata-pelajaran/(:any)'] = 'Mapel/Mapel/path';
$route['administrator/materi/(:any)'] = 'Materi/Materi/path';

$route['belajar/(:any).html'] = 'Belajar/Belajar/path';
$route['get_belajar/(:any).html'] = 'Belajar/Belajar/path';
$route['materi/(:any)/(:any).html'] = 'Belajar/Belajar/path'; 
$route['soal/(:any)/(:any).html'] = 'Belajar/Belajar/path'; 
$route['get_soal/(:any)/(:any).html'] = 'Belajar/Belajar/path'; 
$route['siswa/login'] = 'Belajar/Login/path';
$route['siswa/validate'] = 'Belajar/Login/path';
$route['siswa/logout'] = 'Belajar/Login/path';
$route['kirim_jawaban/(:any).html'] = 'Belajar/Belajar/path';
$route['nilai/test'] = 'Belajar/Belajar/path';

$route['guru'] = 'Profile/Profile/index';
$route['administrator'] = 'Profile/Profile/index';

$route['administrator/soal/(:any)'] = 'Materi/Soal/path';


$route['administrator/profile/Guru/(:any)'] = 'Profile/Profile/path';
$route['administrator/profile/Admin/(:any)'] = 'Profile/Profile/path';
$route['administrator/management/user/guru/(:any)'] = 'Management/Guru/path';
$route['administrator/management/user/siswa/(:any)'] = 'Management/Siswa/path';
$route['administrator/management/user/admin/(:any)'] = 'Management/Admin/path';
$route['guru/login'] = 'Login/User/guru';
$route['administrator/login'] = 'Login/User/admin';
$route['user/logout'] = 'Login/User/logout';
$route['user/validate'] = 'Login/User/validate';

$route['default_controller'] = 'tampilan_siswa';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
