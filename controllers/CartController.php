<?php   

class CartController{

    public function actionAdd($id){

        Cart::addProduct($id);

        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer"); 
    }

    public function actionAddAjax($id){

        echo Cart::addProduct($id);
        
        return true;
    }

    public function actionDelete($id)
    {
        
        Cart::deleteProduct($id);
        
        header("Location: /cart/");
    }


    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if ($productsInCart){

            $productsIds = array_keys($productsInCart);
            $products = Cart::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT.'/views/cart/index.php');

        return true;
    }

    public function actionCheckout()
    {
              
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart == false) {
            header("Location: /");
        }

        $categories = Category::getCategoriesList();
 
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();
   
        $userName = false;
        $userPhone = false;
        
        $result = false;
        
        if (!User::isGuest()) {
            
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];

        } else{ 
            $userId = false;
        }
        
        if (isset($_POST['submit'])) {
            
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];

            $errors = false;

            if (!User::checkName($userName)) {
                $errors[] = 'Некорретно введено имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Некорректно введен телефон';
            }
            if ($errors == false) {
                
                $result = Order::save($userName, $userPhone, $userId=NULL, $productsInCart);
                
                if ($result) {
                    Cart::clear();
                }
            }
        }
        
        require_once(ROOT . '/views/cart/checkout.php');
        return true;

    }
}