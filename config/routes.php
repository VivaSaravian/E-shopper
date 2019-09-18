<?php

return array(
    //products
    'product/([0-9]+)' => 'product/view/$1',
    //catalog
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',
    //category
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    //cart
    'cart/checkout' => 'cart/checkout',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart' => 'cart/index',
    //user
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    //cabinet
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    //main-site
    '' => 'site/index',
);