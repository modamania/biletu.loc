<?php

class Router
{
     private $routes; // массив путей с routes

    //подключение массива с путями для функции run
    public function __construct(){
        $routerPath = ROOT.'/config/routes.php';
        $this->routes = include($routerPath);

    }
// обрезаем слешы
    private function getURI(){
        if($_SERVER[REQUEST_URI]){
            return trim($_SERVER[REQUEST_URI],'/');
        }

    }
//массив с путями
    public function run(){
        $uri = $this->getURI();

        foreach($this->routes as $uriPattern => $path ){
                //проверка есть ли такой маршрут в массиве маршрутизатора

            if(preg_match("~$uriPattern~", $uri)){

                //с помощью рег. выр. ищет параметры
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
               $segments = explode('/', $internalRoute);
               //print_r($internalRoute);
                //первый элемент массива всегда контроллер мы его присваиваем переменной
                $controllerName = array_shift($segments).'Controller';
                //поднимаем регистр первой буквы
                $controllerName = ucfirst($controllerName);
                //повторяем процедуру с экшеном контроллера
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;

                 $controllerFile = ROOT.'/application/controllers/'.$controllerName.'.php';
                //проверяем существует ли контроллер и подключаем его к индексу
                if(file_exists($controllerFile)){
                     include($controllerFile);
                }
                $controllerObject = new $controllerName;
                if(!$parameters){
                     //если параметров нет то просто вызывается метод
                    $result = $controllerObject->$actionName();
                }
                else {
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                }

                 return $result;

            }
        }
    }
}