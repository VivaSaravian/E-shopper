<?php

class Cart{
    
    public static function addProduct($id){

        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])){
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)){
            $productsInCart[$id]++;
        }else{
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    public static function getProductsByIds($idsArray){
        
        $products = array();

        $db = Db::getConnection();

        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;

    }

    public static function countItems(){

        if (isset($_SESSION['products'])){
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity){
                $count = $count + $quantity;
            }
            return $count;
        }else{
            return 0;
        }
    }

    public static function getProducts(){

        if (isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products){

        $productsInCart = self::getProducts();

        $total = 0;

        if ($productsInCart){
            foreach ($products as $item){
                $total += $item['price'] * $productsInCart[$item['id']];
            }

        }

        return $total;
    }

    public static function clear(){

        if (isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }

    public static function deleteProduct($id){

        $productsInCart = self::getProducts();
        
        unset($productsInCart[$id]);
        
        $_SESSION['products'] = $productsInCart;

        header("Loacation: /cart/");
    }

}