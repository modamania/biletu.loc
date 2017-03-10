<?php


class ShowController
{
     function actionView($id)
     {
          $sh = new ShowData();
          $show = $sh->getShowById($id);
          CategoryController::getCatList();
          include ROOT . '/application/views/Show.php';

     }

     function actionGetSeats($id)
     {
          $st = new ShowData();
          $seats = $st->getSeats($id);
          foreach ($seats as $name=>$seat) {
               $seatres[$seat['row']][]= $seat;
          }
          include ROOT . '/application/views/template/zal.php';
     }

     function actionSell(){
$chmail = $_POST['email'];
$chpass = $_POST['pass'];
          $idswhow = $_POST['show'];
          //массив с билетами
          $seats = self::arrfilter($_POST['ticket']);
          //array с проверенными местами в массиве "clear" свободные места в "sold" проданные
          $reschek = self::validateSeats($idswhow,$seats);

           $mail = self::chekValue($chmail,15,4,true);
          $password = self::chekValue($chpass,15,4,false);


          if($mail === true && $password === true){
               $reg = new RegistrationController();
               //проверяем есть ли такой пользователь
               $userid = $reg->checkUser($chmail,$chpass);
               //если польователя нет то тогда регистрируем
               if($userid == false){
                    //регистрируем
                    $reg->registrationUser($chmail,$chpass);
                    //получаем ид пользователя
                    $userid = $reg->checkUser($chmail,$chpass);
                    //указываем в ответе JS что это новый пользователь
                    $resslt['newuser'] = true;
               }
               if(!empty($reschek['sold'])){
                    //проверяем доступны ли те билеты которые выбрал пользователь для продажи
                    //если какой то билет не доступен то просим пользователя выбрать дргой билет
                    $resslt['ticket'] = true;
               }elseif(!empty($reschek['clear'])){
               //записываем в базу данные о продаже билета
                    $seller = new SeansData();
                    $seller->sellTicket($reschek,$userid,$idswhow);
               }
          }else{
               if($mail !== true){
                    //если есть ошибка то передаем ее
                    $resslt['email'] = $mail;
                    //echo 3;
               }
               if ($password !== true){
                    //если есть ошибка то передаем ее
                    $resslt['pass'] = $password;
               }


               //print_r($resslt);
          }

          echo json_encode($resslt);
         // print_r($_SESSION);
     }

     private function arrfilter($arr){
          $sea = explode('&',$arr);

          foreach ($sea as $seat) {
               $seats[] = explode('=',$seat);
          }

          foreach ($seats as $seat) {
               if(count($seat) == 2){
                    $final[$seat[0]][] = $seat[1];
               }
          }

          return $final;
     }

     private function chekValue($val,$max,$min,$mail=false){
          $len = mb_strlen($val);
          if(!empty($val)&& $len <=$max && $len >=$min){
               if($mail === true){
                    $et= explode('@',$val);
                    $dot = explode('.',$val);
                    if(count($et) !=2 && count($dot) !=2){
                         return 'Неправильные емаил';
                    }
               }
               return true;
          }else{
               return 'Недопустимое количество символов';
          }
     }
     private function validateSeats($idswhow,$seats){

          $st = new ShowData();
          $reschek = $st->getStatusSeat($idswhow,$seats);

          foreach ($reschek as $seat) {
               if($seat['status'] == 0){
                    $result['clear'][]=$seat['id'];
               }else{
                    $result['sold'][]=$seat['id'];
               }
          }
//возвращает ид места в базе
          return $result;
     }
}
