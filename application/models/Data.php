<?php

class Data
{
     public $db;
     public $time;
     function __construct()
     {
          $this->db = Db::getConnection();
          $this->time = time();
     }

     function getAll($fields,$table,$where=null){
          if(!empty($where)){
               $sql = ' WHERE ';
               foreach ($where as $key=>$val) {
                    $sq[]= "$key= $val";
               }
               $sql .= implode(' and ',$sq);
          }
          $fields = implode(', ',$fields);

          $res = $this->db->query("SELECT ". $fields ." FROM ". $table." ".$sql);
          $res->setFetchMode(PDO::FETCH_ASSOC);
           while ($rez = $res->fetch()){
                $rezult[]=$rez;
           }
          if(!empty($rezult)){
               return $rezult;
          }
          return false;
     }


     function getCountRow($table, $where = NULL){
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
          $row = $this->db->query("SELECT COUNT(*) as count FROM ".$table." ".$sql)->fetchColumn();
          return $row;
     }

     function getAllJanr(){
          $res = $this->db->query("SELECT `id`, `name`, `transcription` FROM `janru`");
          $res->setFetchMode(PDO::FETCH_ASSOC);
          while ($rez = $res->fetch()){
               $rezult[]=$rez;
          }
          if(!empty($rezult)){
               return $rezult;
          }
          return false;
     }
}