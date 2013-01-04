<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['home'] = 'site';
$route['cat'] = 'site/load_page';

$route['comment'] = 'post_c/load_post';
$route['post-comment'] ='post_c/add_post';
$route['contact'] = 'post_c/add_message';
$route['delete-comment'] = 'post_c/delete_post';

$route['adminpage'] = 'adminpage_c/load_content';
$route['memberpage'] = 'user_c/load_content';
$route['daftar-konten'] = 'adminpage_c/get_list_contents';
$route['daftar-konten-member'] = 'user_c/get_list_contents';

$route['subcat'] = 'resep_c/load_content';
$route['create-resep'] = 'resep_c/create_or_update_resep';
$route['delete-resep'] = 'resep_c/delete_resep';
$route['update-resep'] = 'resep_c/create_or_update_resep';

$route['user-contact'] = 'user_c/get_user';
$route['profil'] = 'user_c/get_profile';
$route['update-profil'] = 'user_c/update_profile';
$route['delete-member'] = 'user_c/delete_user';

$route['registrasi'] = 'registrasi_c/validation';
$route['login'] = 'login/validation';
$route['logout'] = 'logout';

/* End of file routes.php */
/* Location: ./application/config/routes.php */