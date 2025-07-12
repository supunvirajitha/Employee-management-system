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
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_page';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'home/login_page';
$route['logout'] = 'home/logout';

// department routes
$route['add-department'] = 'department';
$route['insert-department'] = 'department/insert';
$route['manage-department'] = 'department/manage_department';
$route['edit-department/(:num)'] = 'department/edit/$1';
$route['update-department'] = 'department/update';
$route['delete-department/(:num)'] = 'department/delete/$1';

//staff routes
$route['add-staff'] = 'staff';
$route['manage-staff'] = 'staff/manage';
$route['view-staff'] = 'staff/view';
$route['staff-Report/(:num)'] = 'staff/Report/$1';
//$route['print-staff/(:num)'] = 'staff/staff_print/$1';
$route['insert-staff'] = 'staff/insert';
$route['delete-staff/(:num)'] = 'staff/delete/$1';
$route['edit-staff/(:num)'] = 'staff/edit/$1';
$route['update-staff'] = 'staff/update';
$route['staff-print'] = 'staff/staff_print';

//salary routes
$route['add-salary'] = 'salary';
$route['manage-salary'] = 'salary/manage';
$route['view-salary'] = 'salary/view';
$route['salary-invoice/(:num)'] = 'salary/invoice/$1';
$route['print-invoice/(:num)'] = 'salary/invoice_print/$1';
$route['delete-salary/(:num)'] = 'salary/delete/$1';

$route['apply-leave'] = 'leave';
$route['approve-leave'] = 'leave/approve';
$route['leave-history'] = 'leave/manage';
$route['leave-approved/(:num)'] = 'leave/insert_approve/$1';
$route['leave-rejected/(:num)'] = 'leave/insert_reject/$1';
$route['view-leave'] = 'leave/view';
$route['salaryinvoice/(:num)'] = 'salary/invoicestaff/$1';




//Grade
$route['add-grade'] = 'grade';
$route['insert-grade'] = 'grade/insert';
$route['manage-grade'] = 'grade/manage_grade';
$route['edit-grade/(:num)'] = 'grade/edit/$1';
$route['update-grade'] = 'grade/update';
$route['delete-grade/(:num)'] = 'grade/delete/$1';
$route['grade-print'] = 'grade/grade_print';

//Promotion
$route['add-promotion'] = 'promotion';
$route['insert-promotion'] = 'promotion/insert';
$route['manage-promotion'] = 'promotion/manage_promotion';
$route['edit-promotion/(:num)'] = 'promotion/edit/$1';
$route['update-promotion'] = 'promotion/update';
$route['delete-promotion/(:num)'] = 'promotion/delete/$1';
$route['promotion-print'] = 'promotion/promotion_print';


//Transfer
$route['add-transfer'] = 'transfer';
$route['insert-transfer'] = 'transfer/insert';
$route['manage-transfer'] = 'transfer/manage_transfer';
$route['edit-transfer/(:num)'] = 'transfer/edit/$1';
$route['update-transfer'] = 'transfer/update';
$route['delete-transfer/(:num)'] = 'transfer/delete/$1';
$route['transfer-print'] = 'transfer/transfer_print';



//training
$route['add-training'] = 'training';
$route['insert-training'] = 'training/insert';
$route['manage-training'] = 'training/manage_training';
$route['edit-training/(:num)'] = 'training/edit/$1';
$route['update-training'] = 'training/update';
$route['delete-training/(:num)'] = 'training/delete/$1';
$route['training-print'] = 'training/training_print';


//Family
$route['add-family'] = 'family';
$route['insert-family'] = 'family/insert';
$route['manage-family'] = 'family/manage_family';
$route['edit-family/(:num)'] = 'family/edit/$1';
$route['update-family'] = 'family/update';
$route['delete-family/(:num)'] = 'family/delete/$1';
$route['family-print'] = 'family/family_print';

//inquirie
$route['add-inquirie'] = 'inquirie';
$route['insert-inquirie'] = 'inquirie/insert';
$route['manage-inquirie'] = 'inquirie/manage_inquirie';
$route['edit-inquirie/(:num)'] = 'inquirie/edit/$1';
$route['update-inquirie'] = 'inquirie/update';
$route['delete-inquirie/(:num)'] = 'inquirie/delete/$1';
$route['inquirie-print'] = 'inquirie/inquirie_print';

//appreciate
$route['add-appreciate'] = 'appreciate';
$route['insert-appreciate'] = 'appreciate/insert';
$route['manage-appreciate'] = 'appreciate/manage_appreciate';
$route['edit-appreciate/(:num)'] = 'appreciate/edit/$1';
$route['update-appreciate'] = 'appreciate/update';
$route['delete-appreciate/(:num)'] = 'appreciate/delete/$1';
$route['appreciate-print'] = 'appreciate/appreciate_print';

// . --------------------------------------------------------------------------------------------------