<?php
$routes['default_controller'] = 'home';

// Fake url => Real url

// Client
$routes['thu-nghiem'] = 'admin/test/get_user';
$routes['product/(.+)'] = 'product/productDetail/$1';
$routes['product/getProductVariant/(.+)'] = 'product/getVariantProdApi/$1';
$routes['login'] = 'account/login';
$routes['signup'] = 'account/register';
$routes['logout'] = 'account/logout';
$routes['reset'] = 'account/forgotPassword';
$routes['reset-password'] = 'account/resetPassword';
$routes['signup-comfirm/(.+)'] = 'account/finalRegisterUser/$1';
$routes['strongPassword'] = 'account/checkStrongPasswordApi';
$routes['isIdenti'] = 'account/checkIdentificateExistedApi';
$routes['coming-soon'] = 'Other/comingSoon';


// Server
$routes['admin/dashBoard'] = 'admin/dashBoard/default';

//Product
$routes['admin/add-product'] = 'admin/product/addProduct';
$routes['admin/update-product/(.+)'] = 'admin/product/updateProduct/$1';
$routes['admin/delete-product'] = 'admin/product/deleteProduct';
$routes['admin/toggle-product'] = 'admin/product/toggleStatusApi';
$routes['admin/delete-product-thumb/(.+)'] = 'admin/product/deleteThumbProduct/$1';
$routes['admin/delete-product-image/(.+)/(.+)'] = 'admin/product/deleteImageProduct/$1/$2';

//Product ratings
$routes['admin/rating-product'] = 'admin/product/rating';
$routes['admin/delete-rating-product'] = 'admin/product/deleteRating';

// Product variants
$routes['admin/product-variants/(.+)'] = 'admin/product/productVariants/$1';
$routes['admin/add-product-variants/(.+)'] = 'admin/product/addProductVariants/$1';
$routes['admin/delete-product-variant'] = 'admin/product/deleteProductVariant';

//Category
$routes['admin/add-category'] = 'admin/category/addCategory';
$routes['admin/update-category/(.+)'] = 'admin/category/updateCategory/$1';

//User
$routes['admin/add-user'] = 'admin/user/addUser';
$routes['admin/update-user/(.+)'] = 'admin/user/updateUser/$1';

//Attribute
$routes['admin/add-attribute'] = 'admin/attributes/addAttribute';
$routes['admin/update-attribute/(.+)'] = 'admin/attributes/updateAttribute/$1';
$routes['admin/attribute-value/(.+)'] = 'admin/attributes/attributeValue/$1';


//Order
$routes['admin/order-detail'] = 'admin/order/orderDetail';

// Custom store
$routes['admin/store-custom'] = 'admin/dashboard/storeCustom';
