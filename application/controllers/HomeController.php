<?php


class HomeController
{

     function actionHome($page=1){
          $teatre = new SeansData();
          $countrow = $teatre->getCountRow('seans_time',['time'=>'>']);
          $seansu = array_chunk($teatre->getAllSeans($page,true),4);

          $pag = new Pagination($countrow,$page,16,'/page/');
          $pagination = $pag->get();

          CategoryController::getCatList();
          include ROOT . '/application/views/Home.php';
     }
}