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

$route['default_controller'] = "db";
$route['404_override'] = '';

$route['login'] = "auth/login";
$route['logout'] = "auth/logout";
$route['forgot_password'] = "auth/forgot_password";
$route['reset_password'] = 'auth/reset_password';

$route['table_datasource/(.+?)'] = 'table_datasource/index/$1';

$route['revisions'] = 'revisions/index';
$route['revisions/loadRecordRevisions/(.+?)/(.+?)/(.+?)'] = 'revisions/loadRecordRevisions/$1/$2/$3';
$route['revisions/removeRevision/(.+?)'] = 'revisions/removeRevision/$1';
$route['revisions/restoreRevision/(.+?)'] = 'revisions/restoreRevision/$1';
$route['revisions/restoreRecordRevision/(.+?)'] = 'revisions/restoreRecordRevision/$1';
$route['revisions/deleteRecordRevision/(.+?)/(.+?)/(.+?)/(.+?)'] = 'revisions/deleteRecordRevision/$1/$2/$3/$4';
$route['revisions/viewCell/(.+?)'] = 'revisions/viewCell/$1';
$route['revisions/viewRecord/(.+?)/(.+?)/(.+?)/(.+?)/(.+?)'] = 'revisions/viewRecord/$1/$2/$3/$4/$5';
$route['revisions/(.+?)/(.+?)/(.+?)/(.+?)'] = 'revisions/index/$1/$2/$3/$4';

$route['db/saveField/(.+?)/(.+?)'] = 'db/saveField/$1/$2';
$route['db/addField'] = 'db/addField';
$route['db/removeField'] = 'db/removeField';
$route['db/newRecord/(.+?)'] = 'db/newRecord/$1';
$route['db/getRecord/(.+?)/(.+?)/(.+?)'] = 'db/getRecord/$1/$2/$3';
$route['db/getCell/(.+?)/(.+?)/(.+?)'] = 'db/getCell/$1/$2/$3';
$route['db/deleteRecord/(.+?)/(.+?)'] = 'db/deleteRecord/$1/$2';
$route['db/updateRecord/(.+?)/(.+?)/(.+?)'] = 'db/updateRecord/$1/$2/$3';
$route['db/deleteTable/(.+?)'] = "db/deleteTable/$1";
$route['db/newTable'] = "db/newTable";
$route['db/updateTable/(.+?)/(.+?)'] = "db/updateTable/$1/$2";
$route['db/uploadCsv'] = "db/uploadCsv";
$route['db/importCsv'] = "db/importCsv";
$route['db/(.+?)/(.+?)'] = 'db/index/$1/$2';
$route['db/(.+?)'] = 'db/index/$1';

$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/updateLogin/(.+?)'] = 'users/updateLogin/$1';
$route['users/update/(.+?)'] = 'users/update/$1';
$route['users/delete/(.+?)'] = 'users/delete/$1';
$route['users/(.+?)'] = 'users/index/$1';

$route['roles'] = "roles/index";
$route['roles/create'] = 'roles/create';
$route['roles/update'] = 'roles/update';
$route['roles/delete/(.+?)'] = 'roles/delete/$1';
$route['roles/(.+?)'] = "roles/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */