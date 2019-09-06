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
$route['default_controller'] = 'welcome';
$route['config']='welcome/config';
$route['demo']='welcome/demo';
$route['schema-list']='welcome/schema_list';
$route['schema-list/(:any)']='welcome/schema_list/$1';
$route['schemas-update']='welcome/schemas_update';
$route['table-update']='welcome/table_update';
$route['schemas']='welcome/schemas';
$route['table-list/(:any)']='welcome/table_list/$1';
$route['table']='welcome/table';
$route['source_update/(:any)']='welcome/source_update/$1';
$route['create-job']='welcome/create_job';
$route['create-job/(:any)']='welcome/create_job/$1';
$route['preview']='welcome/preview';
$route['get_database_record/(:any)']='welcome/get_database_record/$1';
$route['update_connection']='welcome/config';
$route['insert_config']='welcome/config';
$route['config_delete_rec']='welcome/config';
$route['home']='welcome/home';
$route['new_crete_job']='welcome/new_crete_job';
$route['target']='welcome/target';
$route['target/(:any)']='welcome/target/$1';
$route['get_connection_data/(:any)']='welcome/get_connection_data/$1';
$route['migration']='welcome/migration';
$route['migration/(:any)']='welcome/migration/$1';

/*New code*/
$route['migration-process/(:any)']='welcome/migration_process/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
