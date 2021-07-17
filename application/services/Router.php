<?php 


echo '</br>';
echo 'isRouter';
echo '</br>';



class Router 

{
    private $routes;

    public function __construct()
    {
        
        $routePath = DS.'config/routes.php';
        $this->routes = include($routePath);
       
    }

/*   
  Returns request string
 */

    private function getURI() {
        //  получить строку запроса
        if (!empty($_SERVER['REQUEST_URI'])) {
           return trim($_SERVER['REQUEST_URI'], '/');
        }
      

    }
   
    public function run(){

        $uri = $this->getURI();

        echo '</br><h3>String Request:</h3>';
        echo $uri;
        echo '</br>';

        //  Проверить наличие такого запроса в роутес.пхп
            foreach($this->routes as $uriPattern => $path){
                // сравнить $uriPattern and $uri
                // ~ - используется в качестве разделителей вместо слэшей , т.к. слэши попадются в uri
                if (preg_match("~$uriPattern~", $uri)) {
                    // echo '<pre>';
                    // echo $path;
                    // echo '</pre>';

                    $segments = explode('/', $path);  
                    $controller_name = array_shift($segments);
                    $controller_name = ucfirst($controller_name);
                    $controller_name =  'Controller_'.$controller_name;
                    $action_name = 'action_'.(array_shift($segments));
                    $action = $action_name;
                    var_dump($controller_name);
                    $controller = new $controller_name;
                    
                        if (!method_exists($controller,$action_name)) {
                            exit ("Method $action_name not found");
                        }
                        else {
                            $controller->$action();
                        }

                    echo '<br>Class: '. $controller_name;
                    echo '<br> Method: ' . $action_name;
                }   

            }
    
        // Если есть совпадение , определить какой контроллер и акшн обрабатывают зхапрос


        // подключить файл класса контроллера 


        // создать объект вызвать метод акшн


        // print_r($this->routes);
        // echo 'class router,method run';
    }
  
    
    
}


