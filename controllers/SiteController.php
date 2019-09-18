<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class SiteController{
    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProduct(6);

        $sliderProducts = Product::getRecommendetProducts($maxcount = 3);

        require_once(ROOT.'/views/site/index.php');
        
        return true;
    }
}