<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Pages/index';

$route['index'] = 'Pages/index';
$route['control'] = 'Pages/control';
$route['signctrl'] = 'Pages/signctrl'; //Sign Out Route
$route['landscape-chart'] = 'Pages/landscapechart';
$route['landscape-chart-v2'] = 'Pages/landscapechartv2';
$route['edit/(:any)'] = 'Pages/edit/$1';
$route['delete/(:any)'] = 'Pages/delete/$1';
$route['home'] = 'Pages/home';
$route['floorplan-pismu'] = 'Pages/floorplanpismu';
$route['floorplan-technical'] = 'Pages/floorplantechnical';
$route['floorplan-records'] = 'Pages/floorplanrecords';
$route['floorplan-fad'] = 'Pages/floorplanfad';
$route['floorplan-ord'] = 'Pages/floorplanord';
$route['floorplan-list'] = 'Pages/floorplanlist';
$route['floorplan-chief'] = 'Pages/floorplanchief';
$route['history'] = 'Pages/history';
$route['frlogs'] = 'Pages/frlogs';
$route['(:any)'] = 'Pages/landscapechart/$1';
$route['(:any)'] = 'Pages/landscapechart/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
