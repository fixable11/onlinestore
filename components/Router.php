<?php


/**
 *  Класс для работы с маршрутами
 */
class Router
{
    /**
     * Массив маршрутов
     * 
     * @var array Ассоциативный массив маршрутов
     */
    private $routes;

    /**
     * Подключение массива маршрутов
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Декодирование и возврат текущего URI адреса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return urldecode(trim($_SERVER['REQUEST_URI'], '/'));
        }
    }

    /**
     * Вызов соответствующего контроллера и action'а с параметрами
     */
    public function run()
    {
        // Возврат строки запроса
        $uri = $this->getURI();
        
        // Проверка на существование записи в файле routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~u", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~u", $path, $uri);
                
                // Определение контроллера, action'a, параметров

                $segments = explode('/', $internalRoute);

                
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = array_shift($segments) . 'Action' ;

                $parameters = $segments;
                

                $controllerFile = ROOT . '/controllers/' .
                $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if($result == false){
                    echo loadTemplate('err404');
                }

                if ($result != null) {
                    break;
                }
            } 
        }
    }

}
