<?php


class CategoryController
{
     function actionView($id,$page = 1){

          $teatre = new CategoryData();
          $countrow = $teatre->getCountRow(['janr'=>$id,'time'=>'>']);

          $seansu = array_chunk($teatre->getAllSeans($page,true,$id),4);

          $pag = new Pagination($countrow,$page,16,'/cat/'.$id.'/');
          $pagination=$pag->get();

          CategoryController::getCatList();
          include ROOT . '/application/views/Home.php';
     }

     public static function getCatList(){
          $cat = new Data();
          $category= $cat->getAll(['id', 'name'],'janru');
          include ROOT . '/application/views/Category.php';
     }
}