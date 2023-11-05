<?php
$routes['default_controller'] = 'home';

// Fake url => Real url

// Client
$routes['thu-nghiem'] = 'admin/test/get_user';
$routes['product/(.+)'] = 'product/productDetail/$1';
$routes['login'] = 'account/login';
$routes['signup'] = 'account/register';
$routes['logout'] = 'account/logout';
$routes['reset'] = 'account/forgotPassword';
$routes['reset-password'] = 'account/resetPassword';
$routes['signup-comfirm/(.+)'] = 'account/finalRegisterUser/$1';
$routes['strongPassword'] = 'account/checkStrongPasswordApi';
$routes['isIdenti'] = 'account/checkIdentificateExistedApi';

// Server
$routes['admin/dashBoard'] = 'admin/dashBoard/default';

$routes['admin/add-product'] = 'admin/product/addProduct';

$routes['admin/add-category'] = 'admin/category/addCategory';
$routes['admin/update-category/(.+)'] = 'admin/category/updateCategory/$1';

$routes['admin/add-user'] = 'admin/user/addUser';
$routes['admin/update-user/(.+)'] = 'admin/user/updateUser/$1';
