<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['admin']="admin";
$route['admin/(:any)']="admin/$1";
$route['admin/(:any)/(:any)']="admin/$1/$2";
$route['admin/(:any)/(:any)/(:any)']="admin/$1/$2/$3";


$route['list']="imglist";
$route['list/(:num)']="imglist/index/$1";
$route['list/(:num)/(:num)']="imglist/index/$1/$2";
$route['pictures/(:num)'] = "post/view/$1";
$route['pictures/(:num)/(:num)'] = "post/view/$1/$2";
$route['thumb/(:any)'] = "post/thumb/$1";
$route['(:any)'] = "category/index/$1";
$route['comments_insert'] = "post/comments_insert";
$route['comments'] = "post/comments_ajax";
$route['upload'] = "upload/index";
$route['upload_add'] = "upload/upload_add";
$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
