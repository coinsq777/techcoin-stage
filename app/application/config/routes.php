<?php
defined('BASEPATH') OR exit('No direct script access allowed');



//ADMIN ROUTES
$route['AssetsController/coin_list'] = 'admin/AssetsController/coin_list';

$route['develop']                 =  'users/developLogin';

//user routes
$route['mywallet'] = 'user/Wallet/mywallet';
$route['MyAdderss/(:any)'] = 'user/Wallet/GetAdderss/$1';

$route['users/register'] = 'users/register';
$route['users/dashboard'] = 'users/dashboard';

$route['comments/create/(:any)'] = 'comments/create/$1';
$route['categories'] = 'category/index';
$route['categories/create'] = 'category/create';
$route['categories/posts/(:any)'] = 'category/posts/$1';
$route['categories/delete/(:any)'] = 'category/delete/$1';
$route['posts/index'] = 'posts/index';
$route['posts/update'] = 'posts/update';
$route['posts/delete/(:any)'] = 'posts/delete/$1';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';
// $route['default_controller'] = 'pages/view';
$route['default_controller'] ='pages/index';

//user routes
$route['investment']             = 'Investment/deposit';
$route['investlist']             = 'Investment/investlist';
$route['myreferal']              = 'users/myreferal';
$route['myreferal/(:any)']       = 'users/myreferals/$1';
$route['mywithdrawal']           = 'Mywithdraw/withdraw';
$route['history/bonus']          = 'History/bonus';
$route['history/deposit']        = 'History/deposit';
$route['history/withdraw']       = 'History/withdraw';
$route['history/daily_history']  = 'History/daily_history';
$route['investment_validate']    = 'Investment/validate';

//************** INVESTMENT */
$route['users/mining']            = 'user/Investment/Mining';
$route['user/deposit_balance']    = 'user/Investment/Balance';
$route['users/profit']            = 'user/Investment/profit';
$route['users/wallet']            = 'user/Investment/wallet';


$route['users/site_withdraw']     = 'user/Investment/withdraw';

$route['ipn_process']              = 'user/Profit/ipn_verify';


$route['users/main_withdraw']     = 'user/Investment/main_wallet_withdraw';



$route['game']                    = 'users/game';
$route['website']                 = 'users/website';
$route['trading_cms']             = 'users/trading_cms';
$route['staking_cms']             = 'users/staking_cms';
$route['nft']                     = 'users/nft';
$route['lottery']                 = 'users/lottery';
$route['managment']               = 'users/managment';



$route['users/miningverify']       = 'user/Investment/miningverify';
$route['users/mining_verify']       = 'user/Investment/verifyed';
$route['users/Earnings']           = 'user/Profit/Earnings';

$route['users/trading']            = 'user/Investment/Trading';
$route['users/Trading']            = 'user/Investment/Trading';

$route['users/tradingverify']       = 'user/Investment/tradingverify';
$route['users/mining_verify']       = 'user/Investment/verifyed';

$route['site_currency/(:any)']       = 'user/Investment/site_currency/$1';


$route['Report/Mining'] = 'administrator/mining_report';
$route['Report/Staking'] = 'administrator/lending_report';
$route['Report/Withdraw'] = 'administrator/site_withdraw';

$route['Report/Staking_Earning'] = 'administrator/staking_earnings';
$route['Report/Lending_Earning'] = 'administrator/lending_earnings';
$route['Report/Mining_Earning'] = 'administrator/mining_earnings';
$route['Report/Level_Earning'] = 'administrator/level_earnings';

$route['Report/Royality_Earnings'] = 'administrator/Royality_Earnings';
$route['Report/Royality'] = 'administrator/royality_report';

//admin routs
$route['administrator'] = 'administrator/view';
$route['administrator/home'] = 'administrator/home';
$route['administrator/index'] = 'administrator/view';
$route['administrator/forget-password'] = 'administrator/forget_password';

$route['administrator/dashboard'] = 'administrator/dashboard';

$route['administrator/change-password'] = 'administrator/get_admin_data';
$route['administrator/update-profile'] = 'administrator/update_admin_profile';

$route['administrator/users/add-user'] = 'administrator/add_user';
$route['administrator/users'] = 'administrator/users';
$route['administrator/users/update-user/(:any)'] = 'administrator/update_user/$1';

$route['administrator/blogs/add-blog'] = 'administrator/add_blog';
$route['administrator/blogs/list-blog'] = 'administrator/list_blog';
$route['administrator/blogs/update-blog'] = 'administrator/update_blog';

$route['administrator/product-categories/create'] = 'administrator/create_product_category';
$route['administrator/product-categories/update/(:any)'] = 'administrator/update_product_category/$1';
$route['administrator/product-categories'] = 'administrator/product_categories';
//$route['administrator/product-categories/(:any)'] = 'administrator/update_product_category/$1';

$route['administrator/products/create'] = 'administrator/create_product';
$route['administrator/products'] = 'administrator/get_products';
$route['administrator/products/update/(:any)'] = 'administrator/update_products/$1';

$route['administrator/faq-categories/create'] = 'administrator/create_faq_category';
$route['administrator/faq-categories/update/(:any)'] = 'administrator/update_faq_category/$1';
$route['administrator/faq-categories'] = 'administrator/faq_categories';

$route['administrator/faq/create'] = 'administrator/create_faq';
$route['administrator/faqs'] = 'administrator/get_faqs';
$route['administrator/faqs/update/(:any)'] = 'administrator/update_faqs/$1';

$route['administrator/scopages'] = 'administrator/get_scopages';
$route['administrator/sco-pages/update/(:any)'] = 'administrator/update_scopages/$1';

$route['administrator/sociallinks'] = 'administrator/get_sociallinks';
$route['administrator/sociallinks/update/(:any)'] = 'administrator/update_sociallinks/$1';

$route['administrator/sliders/create'] = 'administrator/create_slider';
$route['administrator/sliders'] = 'administrator/get_sliders';
$route['administrator/sliders/update/(:any)'] = 'administrator/update_slider/$1';

$route['administrator/site-configuration'] = 'administrator/get_siteconfiguration';
$route['administrator/site-configuration/update/(:any)'] = 'administrator/update_siteconfiguration/$1';

$route['administrator/page-contents'] = 'administrator/get_pagecontents';
$route['administrator/page-contents/update/(:any)'] = 'administrator/update_pagecontents/$1';

$route['administrator/galleries/add'] = 'galleries/galleriesLoad';
$route['administrator/galleries'] = 'galleries/get_gallery_images';

$route['administrator/blogs/blog-comments'] = 'administrator/list_blog_comments';
$route['administrator/blogs/view-comment/(:any)'] = 'administrator/view_blog_comments/$1';

$route['administrator/team/add'] = 'administrator/add_team';
$route['administrator/team/list'] = 'administrator/list_team';
$route['administrator/team/update/(:any)'] = 'administrator/update_team/(:any)';

$route['administrator/testimonials/add'] = 'administrator/add_testimonial';
$route['administrator/testimonials/list'] = 'administrator/list_testimonial';
$route['administrator/testimonials/update/(:any)'] = 'administrator/update_testimonial/(:any)';

$route['user/add'] = 'History/user_login';
$route['user/remove'] = 'History/remove_login';
$route['admin/get/wallet'] = 'History/admin_wal';
$route['invite_id/(:any)'] = 'api/Api/invite_id/$1';

// $route['(:any)'] = 'pages/view/$1';
$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = 'my404';









