<?php

class ShowData extends Data
{
     public $db;


     function getShowById($id)
     {
          $res = $this->db->query("
               SELECT seansu_new.`id`, seansu_new.`name`, seansu_new.description,seansu_new.`picture`, 
               seansu_new.`theatre_id` , theatre.`name`as theatrename , 
               seans_time.time,seansu_new.janr, janru.name as jname
               FROM `seansu_new` 
               LEFT JOIN theatre 
               on theatre.id = seansu_new.theatre_id 
               LEFT JOIN seans_time
               on `seans_time`.`seans_id` =  seansu_new.`id`
               LEFT JOIN janru
               on    janru.id = seansu_new.janr
               WHERE seansu_new.id IN ($id)");

          $res->setFetchMode(PDO::FETCH_ASSOC);
          //$res->execute(array($id));
          while($rez = $res->fetch()){
               //print_r($rezult);
               $rezult[] = $rez;
          }
          //$rezult[] = $res->fetchAll(PDO::FETCH_ASSOC);
          //print_r($rezult);die;
          if (!empty($rezult)) {
               if(count($rezult) <= 1){
                    return $rezult[0];
               }else{
                    return $rezult;
               }

          }
          return false;
     }

     function getSeats($id){
         $res = $this->db->prepare("SELECT  `row`, `seats`, `type`, `cost`, `show`, `status` FROM `seats` WHERE `show` = :id");
          $res->execute(array('id' => $id));
          $rezult = $res->fetchAll(PDO::FETCH_ASSOC);
          if (!empty($rezult)) {
               return $rezult;
          }
          return false;
     }
     function getStatusSeat($idshow,$idseats){

//          $res = $this->db->prepare("SELECT `seats`, `cost`, `show`, `status` FROM `seats`
//                            WHERE `row` =:row and `seats` =:seat and `show` = :idshow ");

          foreach ($idseats as $row=>$idseat) {
               foreach ($idseat as $seat) {
                    $res = $this->db->query("SELECT `id`,row,`seats`, `cost`, `show`, `status` FROM `seats` 
                            WHERE `row` =$row and `seats` =$seat and `show` = $idshow ");
                    //$res->execute(array('row' => $row,'seat' => $seat,'show' => $idshow));
                         //$res->setFetchMode(PDO::FETCH_ASSOC);
                    while ($roz = $res->fetch(PDO::FETCH_ASSOC))
                    {
                         $rezult[] = $roz;
                    }
               }
          }
          return $rezult;
     }
}