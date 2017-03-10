<?php
session_start();

if(!empty($_SESSION['redirect'])){
     header('Location: '.$_SESSION['redirect']);
     unset($_SESSION['redirect']);
     exit;
}

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/Db.php');

require_once(ROOT . '/components/Autoload.php');
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
    == 'xmlhttprequest'
) {
     // Если к нам идёт Ajax запрос, то ловим его
     $ajax = true;
}

if (!$ajax ) {

     include ROOT . '/application/views/Header.php';
}
$route = new Router();
$result = $route->run();
if (!$ajax) {
     include ROOT . '/application/views/Footer.php';
}

