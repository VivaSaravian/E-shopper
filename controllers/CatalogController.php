<?php


class CatalogController{
    
    public function actionIndex($page = 1){

        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getAllProductsList($page);

        #$latestProducts = array();
        #$latestProducts = Product::getLatestProduct(6);
        

        $total = Product::getAllProducts();
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');


        require_once(ROOT.'/views/catalog/index.php');

        
        return true;
    }

    public function actionCategory($categoryId, $page = 1){
        
        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductListByCategory($categoryId, $page);

        $total = Product::getProductsInCategory($categoryId);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once(ROOT.'/views/catalog/category.php');

        return true;
    }
}