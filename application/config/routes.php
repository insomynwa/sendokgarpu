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

//$route['default_controller'] = "welcome";
//$route['404_override'] = '';
$route['default_controller'] = 'site';
$route['home'] = 'site';
$route['cat'] = 'site/load_page';
$route['subcat'] = 'resep_c/load_content';
$route['comment'] = 'post_c/load_post';
$route['post-comment'] ='post_c/add_post';
$route['user-contact'] = 'user_c/get_user';
$route['contact'] = 'post_c/add_message';
$route['profil'] = 'user_c/get_profile';
$route['registrasi'] = 'registrasi_c/validation';
$route['login'] = 'login/validation';
$route['logout'] = 'logout';
$route['adminpage'] = 'adminpage_c/load_content';
$route['daftar-konten'] = 'adminpage_c/get_list_contents';
$route['create-resep'] = 'resep_c/create_resep';
$route['upload-img-resep'] = 'resep_c/upload_img';
/*$route['resep'] = 'site/resep';
$route['resep/(:any)'] = 'site/resep/$1';
$route['resep/(:any)/(:num)'] = 'site/resep/$1/$2';
$route['tentang'] = 'site/pages/tentang';
$route['kontak'] = 'site/pages/kontak';*/

/*$route['administrator'] = 'administrator';
$route['administrator/manage'] = 'administrator/manage';
$route['administrator/create'] = 'administrator/create';
$route['administrator/delete/(:num)'] = 'administrator/delete';
$route['administrator/update/(:num)'] = 'administrator/update/$1';*/


/*$route['crud/create'] = 'crud/create/$1';
$route['crud/del'] = 'crud/delete';
$route['crud/update'] = 'crud/update';
*/


/*$route['form_ajax'] = 'ajax_post';
$route['post_this'] = 'ajax_post/post_action';*/



/*$route['new_site'] = 'site_c';
$route['cat'] = 'site_c/load_page';*/
//$route['(:any)'] = 'site';
/*$route['(:any)/(:any)'] = 'site/page/$1/$2';
$route['(:any)/(:any)/(:any)'] = 'site/page/$1/$2/$3';*/
/*$route['administrator'] = 'administrator/page';
$route['administrator/(:any)'] = 'administrator/page/$1';*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */