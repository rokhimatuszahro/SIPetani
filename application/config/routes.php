<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'Landing_Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// autentifikasi
$route['login'] = 'Auth/login';
$route['registration'] = 'Auth/registration';
$route['forgotpassword'] = 'Auth/forgotPassword';
$route['changepassword'] = 'Auth/changePassword';
$route['logout'] = 'Auth/logout';


// admin
$route['dashboard'] = 'Admin/dashboard';
$route['pemesanan'] = 'Admin/pemesanan';
$route['harga'] = 'Admin/harga';
$route['pengunjung'] = 'Admin/pengunjung';
$route['konfirmasi'] = 'Admin/konfirmasi';

$route['tambahpengunjung'] = 'Admin/tambahPengunjung';
$route['tambahharga'] = 'Admin/tambahHarga';
$route['akunadmin'] = 'Admin/akunAdmin';
$route['profileadmin'] = 'Admin/profileAdmin';


// user
$route['detail_pembayaran'] = 'Landing_Home/detail_Pembayaran';
$route['detail_pemesanan'] = 'Landing_Home/detail_Pemesanan';
$route['tiket'] = 'Landing_Home/tiket';
$route['editprofile'] = 'Landing_Home/editProfile';


// Mobile
$route['apiregistrasi'] = 'ApiMobile/apiRegistrasi';
$route['apilogin'] = 'ApiMobile/apiLogin';
$route['apilogout'] = 'ApiMobile/apiLogout';
$route['apiresetakun'] = 'ApiMobile/apiResetAkun';
$route['apireset'] = 'ApiMobile/apiReset';
$route['apipemesanan'] = 'ApiMobile/apiPemesanan';
$route['apidetailpemesanan'] = 'ApiMobile/apiDetailPemesanan';
$route['apiuploadbukti'] = 'ApiMobile/apiUploadBukti';
$route['apiprofile'] = 'ApiMobile/apiProfile';
$route['apieditprofile'] = 'ApiMobile/apiEditProfile';
$route['apitiket'] = 'ApiMobile/apiTiket';
