<?php

return array(
    
    'product/([0-9]+)/?$' => 'product/index/$1', // actionView в ProductController   
    'catalog' => 'catalog/index',

    'search/\?query=([a-zA-Z0-9-+а-яёА-ЯЁ ]*)?(&?[a-z]*=?[a-zA-Zа-яёА-ЯЁ0-9-+ ]*)*/?$' => 'search/index',
    'search/?$' => 'search/index',

    'cart/addtocart/([0-9]+)' => 'cart/addtocart/$1',
    'cart/removefromcart/([0-9]+)' => 'cart/removefromcart/$1',
    'cart/order' => 'cart/order',
    'cart/saveorder' => 'cart/saveorder',
    'cart' => 'cart/index',

    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/update' => 'user/update',
    'user/logout' => 'user/logout',
    'user' => 'user/index',

    'admin/category' => 'admin/category',
    'admin/addnewcat' => 'admin/addnewcat',
    'admin/deletecat' => 'admin/deletecat',
    'admin/updatecategory' => 'admin/updatecategory',
    'admin/addproduct' => 'admin/addproduct',
    'admin/updateproduct' => 'admin/updateproduct',
    'admin/upload' => 'admin/upload',
    'admin/products' => 'admin/products',
    'admin/orders' => 'admin/orders',
    'admin/setorderstatus' => 'admin/setorderstatus',
    'admin/setorderdatepayment' => 'admin/setorderdatepayment',
    'admin' => 'admin/index',

    'about/delivery' => 'about/delivery',
    'about/guarantees' => 'about/guarantees',
    'about/contacts' => 'about/contacts',
    'about/us' => 'about/us',

    'phones/price=([0-9]+-[0-9]+)/filter((/[a-z]+)(/[a-z]+)*(/p-([1-9][0-9]*))?)/?$' => 'category/filter/$1/1/$2',
    'phones/filter((/[a-z]+)(/[a-z]+)*(/p-([1-9][0-9]*))?)/?$' => 'category/filter//1/$1',
    'phones/price=([0-9]+-[0-9]+)/p-([1-9][0-9]*)/?$' => 'category/index/$1/1/$2',
    'phones/p-([1-9][0-9]*)/?$' => 'category/index//1/$1',
    'phones/price=([0-9]+-[0-9]+)/?$' => 'category/index/$1/1',
    'phones/?$' => 'category/index//1',
    
    'category' => 'category/index/0', 
    'price=([0-9]+-[0-9]+)/p-([1-9][0-9]*)/?$' => 'index/index/$1/$2',
    'p-([1-9][0-9]*)/?$' => 'index/index//$1',
    'price=([0-9]+-[0-9]+)/?$' => 'index/index/$1',
    
    '' => 'index/index'
);
