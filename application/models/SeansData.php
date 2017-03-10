<?php


class SeansData extends Data
{
     public $db;

     function getAllSeans($page=0, $time = false, $janr = false)
     {
          $page -= 1;
          if ($page != 0) {
               $page *= 16;
          }
          $sql = "SELECT seansu_new.`id`, seansu_new.`name`, seansu_new.`picture`, 
          seansu_new.`theatre_id` , theatre.`name`as theatrename , seans_time.time,seansu_new.janr
          FROM `seansu_new` 
          LEFT JOIN theatre 
          on theatre.id = seansu_new.theatre_id 
          JOIN seans_time 
          on `seans_time`.`seans_id` =  seansu_new.`id`";
          if ($janr) {
               $sq[]= 'janr = ' . $janr;
          }
          if($time){
               $sq[]= 'time >= ' . $this->time;
          }
          if($time || $janr){
               $sql .=' WHERE '. implode(' and ',$sq);
          }
          $sql .= " ORDER BY `seans_time`.`time` 
          ASC LIMIT $page,16 ";

          $res = $this->db->query($sql);
          $rezult = $res->fetchAll(PDO::FETCH_ASSOC);

          if (!empty($rezult)) {
               return $rezult;
          }
          return false;
     }

     function sellTicket($arr,$userid) {
          if(!empty($arr)){
               $sql = implode(',',$arr['clear']);
               $res =  $this->db->exec("UPDATE `seats` SET `status`= $userid WHERE id IN ($sql)");

          }
     }

     function getUserSeats($id){

          $res =  $this->db->query("SELECT `id`, `row`, `seats`, `type`, `cost`, `show`  FROM `seats` WHERE `status` = $id");
          $rezult = $res->fetchAll(PDO::FETCH_ASSOC);

          if (!empty($rezult)) {
               return $rezult;
          }
          return false;
     }

     function cleanUserSeans($arr){
          foreach ($arr as $show=>$item) {
               foreach ($item as $row=>$arrrow) {
                    foreach ($arrrow as $seat=>$item) {
                         $res = $this->db->exec("UPDATE `seats` SET `status`=0 WHERE `show` = $show and `row` = $row and `seats` = $seat");
                    }
               }
          }
          if($res){
               return true;
          }
          return false;
     }
}