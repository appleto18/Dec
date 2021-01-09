<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Edit-User/(:any)'] = 'Users/edit_user';
$route['Add-Category'] = 'Category/add';
$route['Edit-Category/(:any)'] = 'Category/edit_category';
$route['Categories'] = 'Category';

$route['Add-SubCategory'] = 'Subcategories/add';
$route['Edit-SubCategory/(:any)'] = 'Subcategories/edit_category';

$route['Recommanded-Video'] = 'RecommandedVideo';

$route['Add-Slider-Image'] = 'Slider/add_slider';

$route['Add-Notification'] = 'Notification/add';

$route['Add-Gifts'] = 'Gifts/add';

$route['Edit-Gift/(:any)'] = 'Gifts/edit_gift';


$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
