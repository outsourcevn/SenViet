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

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['san-pham'] = 'products';
$route['san-pham/(.*).html$'] = 'products/detail/$1';

$route['gioi-thieu/(.*).html$'] = 'introduce/detail/$1';
$route['chi-nhanh/(.*).html'] = 'department/detail/$1';
$route['(.*).html$'] = 'news_detail/index/tin-tuc/$1';

$route['tin-tuc'] = 'news/index/tin-tuc';
$route['tin-tuc/(.*)$'] = 'news/index/tin-tuc/$1';

$route['dao-tao'] = 'training/index/dao-tao';
$route['dao-tao/(.*)$'] = 'training/index/$1';

$route['gioi-thieu'] = 'introduce';
$route['chi-nhanh'] = 'department';
$route['thong-tin-npp'] = 'npp';
$route['thong-tin-npp/(.*)$'] = 'npp';

$route['tro-giup/hoi-dap-thuong-gap'] = 'faq/index';
$route['tro-giup'] = 'faq/index';

$route['lien-he'] = 'contact/index';
$route['lien-he/(.*)$'] = 'contact/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */