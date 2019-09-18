<?php  

class Router{

    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    //Returns request string
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run(){
        $uri = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $path){
            //Comparison uriPattern and uri
            if (preg_match("~$uriPattern~", $uri)){
            

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //Determine which controller
                $segments = explode('/', $internalRoute);
                
                $controllerName = ucfirst(array_shift($segments).'Controller');
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                $parameters = $segments;

                //Connect file class-controller
                $controllerFile = ROOT.'/controllers/'.
                    $controllerName.'.php';
        
                    if (file_exists($controllerFile)){
                        include_once($controllerFile);
                    }
                
                //Create object and call method
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null){
                    break;
                }else{
                    require_once(ROOT.'/views/404/index.php');
                    
                }
           }
        }
    }
}