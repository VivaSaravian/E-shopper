<?php

class Product{
    const SHOW_BY_DEFAULT = 9;
    const SHOW_DEFAULT_BY_MAIN = 6;

    public static function getLatestProduct($limit= self::SHOW_DEFAULT_BY_MAIN){

        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
        . 'WHERE status = "1"'
        . 'ORDER BY id DESC '
        . 'LIMIT '. $limit);

        $i = 0;
        while($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        
        return $productsList;
    }

    public static function getProductListByCategory($categoryId = false, $page = 1){
        
        if ($categoryId){

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products = array();
            /*$result = $db->query("SELECT id, name, price, image, is_new FROM product "
            . "WHERE status = '1' AND category_id = '$categoryId' "
            . "ORDER BY id DESC "
            . "LIMIT ". self::SHOW_BY_DEFAULT . "OFFSET " . $offset);*/

            $result = $db->query("SELECT id, name, price, image, is_new FROM product 
            WHERE status = '1' AND category_id = '$categoryId' 
            ORDER BY id ASC
            LIMIT 9 
            OFFSET " . $offset);

            $i = 0;
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }
    }

    public static function getAllProductsList($page = 1){
        
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $products = array();

        $result = $db->query("SELECT id, name, price, image, is_new FROM product 
        WHERE status = '1'
        ORDER BY id ASC
        LIMIT 9 
        OFFSET " . $offset);

        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $products;

    }

    public static function getRecommendetProducts($maxcount = 3){
        
        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, name, price, is_new, image FROM product '
                . 'WHERE is_recommendet = "1" '
                . 'ORDER BY id DESC '
                . 'LIMIT '. $maxcount);

        $productsList = array();

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $productsList[$i]['image'] = $row['image'];
            $i++;
        }

        return $productsList;

    }

    

    public static function getProductById($id){
        
        $id = intval($id);

        if ($id){
            
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM product WHERE id=". $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function getProductsInCategory($categoryId){
        
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
        . 'WHERE status = "1" AND category_id="'.$categoryId.'"');

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getAllProducts(){

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
        . 'WHERE status = "1"');

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];

    }

    public static function getProductsList()
    {
        
        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    public static function getProductsByIds($idsArray)
    {
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);
        
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    public static function deleteProductById($id){

        $db = Db::getConnection();

        $sql = 'DELETE FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }

    public static function createProduct($options){
        
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :status)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

}