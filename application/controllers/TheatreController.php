<?php


class TheatreController
{
     function actionView($id,$page=1)
     {
          $teatre = new TheatreData();
          $countrow = $teatre->getCountRow(['theatre_id'=>$id, 'time'=>'>']);

          $teatre_info = $teatre->getAll(['id','name', 'description', 'image'],'theatre',['id'=>$id]);


          $seansu = array_chunk($teatre->getTheatreSwhow($id,$page),4);

          $pag = new Pagination($countrow,$page,16,'/theatre/'.$id.'/');
          $pagination=$pag->get();

          CategoryController::getCatList();

          include ROOT . '/application/views/Theatre.php';
     }
}