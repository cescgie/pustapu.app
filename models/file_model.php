<?php

class File_Model extends Model {

   public function __construct(){
      parent::__construct();
   }
   //GA DB
   public function all_ga() {
      return $this->_db->select('SELECT * FROM ga ORDER BY id DESC LIMIT 0, 20');
   }
   public function select_one(){
     return $this->_db->select("SELECT Hour,Minute,Second,DateEntered FROM ga  WHERE UserId = '52ef308365641a23' ORDER BY id DESC LIMIT 1");
   }
   public function _insert_ga($datas) {
     $this->_db->insert('ga', $datas);
   }
   public function summe_ga(){
      return $this->_db->select("SELECT count(*) as 'Summe_ga' from ga");
   }
   public function all_user_ga(){
      return $this->_db->select("SELECT UserId,count(UserId) as Summe FROM ga GROUP BY UserId HAVING count(*) >1000 ORDER BY count(*) DESC");
   }
   public function update_uid($data,$where){
      return $this->_db->update("userid_ga",$data,"UserId='$where'");
   }
   public function insert_uid($datas) {
      return $this->_db->insert('userid_ga', $datas);
   }
   public function check_if_uid_exists($uid){
      return $this->_db->select("SELECT EXISTS(SELECT 1 FROM userid_ga WHERE UserId = '".$uid."' LIMIT 1) as mycheck");
   }
   public function select_uid($uid){
      return $this->_db->select("SELECT Hour, COUNT(*) hits FROM ga WHERE UserId='".$uid."' GROUP BY Hour HAVING hits > 1;");
   }
   public function all_info_user_ga(){
     return $this->_db->select("SELECT UserId,IpAddress,Hour,Minute,Second,DateEntered,OsId,count(UserId) as Summe FROM ga GROUP BY UserId,IpAddress,Hour,Minute,DateEntered,OsId ORDER BY count(*) DESC");
   }
}
