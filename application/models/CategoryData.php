<?php


class CategoryData extends Data
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
          LEFT JOIN seans_time 
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

     function getCountRow($where = NULL){
          if(!empty($where)){

               foreach ($where as $key=>$item) {
                    if($key === 'time'){
                         if($item != '='){
                              $sq[]=$key." $item= ".$this->time;
                         }else{
                              $sq[]=$key." = ".$this->time;
                         }
                    }else{
                         $sq[]="$key=$item ";
                    }

               }
               $sql = " WHERE ".implode(' and ',$sq);
          }
        $row = $this->db->query("
          SELECT COUNT(*) as count
          FROM `seansu_new` 
          JOIN seans_time 
          on `seans_time`.`seans_id` =  seansu_new.`id`
          ".$sql)->fetchColumn();

          return $row;
     }
}