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
$route['default_controller'] = 'front';
//----------------------admin routes --------------------------------------//
$route['admin-login'] = 'admin/auth';
$route['admin-logout'] = 'admin/auth/logout';
$route['admin-dashboard'] = 'admin/dashboard';
//----------------------user routes --------------------------------------//
$route['user-login'] = 'user/auth';
$route['user-logout'] = 'user/auth/logout';
$route['user-dashboard'] = 'user/dashboard';

//----------------------Staff routes --------------------------------------//
$route['staff-login'] = 'staff/auth';
$route['staff-logout'] = 'staff/auth/logout';
$route['staff-dashboard'] = 'staff/dashboard';

//----------------------web routes --------------------------------------//
$route['about-us'] = 'front/about_us';
$route['contact-us'] = 'front/contact_us';
$route['apply-form'] = 'user/user/usersapplication';
$route['login'] = 'user/auth';
$route['register'] = 'user/auth/register';
$route['forgot'] = 'user/auth/forgot';

$route['referral'] = 'user/auth/referral';

$route['payment-form'] = 'Razor';

$route['logout'] = 'front/logout';
$route['product/(:any)'] = 'front/product/$1';


//------------------------------mobile-----------------------------------//
$route['shop-response/(:any)'] = 'response/mobile_response/$1';
$route['shop-payonline'] = 'shop/payonline';
$route['shop/(:any)'] = 'shop/index/$1';
$route['shop/(:any)/(:any)'] = 'shop/index/$1/$2';
$route['shop/(:any)/(:any)/(:any)'] = 'shop/index/$1/$2/$3';
$route['user-checkout/(:any)'] = 'shop/checkout/$1';
$route['user-login/(:any)'] = 'shop/login/$1';
$route['user-registration/(:any)'] = 'shop/register/$1';
$route['user-profile/(:any)'] = 'shop/profile/$1';
$route['order-history/(:any)'] = 'shop/order_history/$1';
$route['order-list/(:any)/(:any)'] = 'shop/order_list/$1/$2';
$route['user-logout/(:any)'] = 'shop/logout/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
