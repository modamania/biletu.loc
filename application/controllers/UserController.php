<?php

class UserController
{
     private $userid;
     private $post;
     function __construct()
     {
         $this->userid = $_SESSION['userid'];

          $this->post = $_POST;
     }

     function actionShowInfo(){
          if(!empty($this->post['show'])){
               self::actionCleanList();
          }

          $seats = new SeansData();
          //получаем список мест которые юзер выбрал
         $result =  $seats->getUserSeats($this->userid);
          CategoryController::getCatList();
          if(!empty($result)){
          foreach ($result as $item) {
               //информация array(идпредставления=>ряд=>место=>цена)
                    //$wievres[][$item['show']][$item['row']][$item['seats']] = $item['cost'];
                    $wievres[$item['show']]['show'] = $item['show'];
                    $wievres[$item['show']]['row'][] = $item['row'];
                    $wievres[$item['show']]['seats'][] = $item['seats'];
                    $wievres[$item['show']]['cost'][] = $item['cost'];

               $show[] = $item['show'];
          }
          $show = array_unique($show);
          $showlist = implode(',',$show);
          $showselector = new ShowData();
          //информация о представлениях
          $showselres = $showselector->getShowById($showlist);

          if(!empty($showselres['id'])){
               $showsel[0]=$showselres;
               unset($showselres);
               $showselres = $showsel;
          }
     foreach ($showselres as $showitem) {
          //print_r($showitem);die;

               foreach ($wievres as $idw =>$wievreitem) {
                    if($showitem['id']==$idw){
                         $wievres[$idw] ['name'] = $showitem['name'];
                         $wievres[$idw]['picture'] = $showitem['picture'];
                         $wievres[$idw]['jname'] = $showitem['jname'];
                         $wievres[$idw]['theatre_id'] = $showitem['theatre_id'];
                         $wievres[$idw]['theatrename'] = $showitem['theatrename'];
                         $wievres[$idw]['time'] = date(' H:i d.m.Y',$showitem['time']);
                         $wievres[$idw]['janr'] = $showitem['janr'];
                    }
               }
          }

          }
          //print_r($wievres);

          include ROOT . '/application/views/User.php';
     }

     public function actionCleanList(){
          if(!empty($this->post['show'])){
        $clean = new SeansData();
               $cleanres = $clean->cleanUserSeans($this->post['show']);
              if($cleanres){
                   $_SESSION['redirect']= '/user';
              }
          }
     }
}