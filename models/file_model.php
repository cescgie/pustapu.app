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
     $this->_db->insert('ga_2', $datas);
   }
   public function summe_ga(){
      return $this->_db->select("SELECT count(*) as 'Summe_ga' from ga");
   }
   public function all_user_ga(){
      return $this->_db->select("SELECT UserId,count(UserId) as Summe FROM ga GROUP BY UserId HAVING count(*) >500 ORDER BY count(*) DESC");
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
      return $this->_db->select("SELECT WebsiteId, COUNT(*) hits FROM ga WHERE UserId='".$uid."' GROUP BY WebsiteId HAVING hits > 1;");
   }
   public function all_info_user_ga(){
     return $this->_db->select("SELECT UserId,Date(DateEntered) as DateEntered,count(*) as Summe FROM ga GROUP BY UserId HAVING count(*) > 500 ORDER BY count(*) DESC");
   }
   public function check_available_date_infos(){
      return $this->_db->select("SELECT DateEntered as Available_Date FROM userid_ga group by DateEntered having count(*) >= 1");
   }
   public function select_date_contains($datum){
     return $this->_db->select("SELECT UserId,Summe,Uhrzeit FROM `userid_ga` WHERE DateEntered = '".$datum."' AND UserId!='0000000000000000' AND Uhrzeit>20 HAVING Summe > 2000 ORDER BY Summe DESC");
   }
   public function all_UserId_to_WebsiteId(){
     return $this->_db->select("SELECT UserId,WebsiteId,Hour(DateEntered) as Hour,date(DateEntered) as DateEntered,COUNT(*) as Summe FROM ga GROUP BY UserId,WebsiteId,Hour(DateEntered),date(DateEntered) HAVING COUNT(*) > 500 ORDER BY COUNT(*) DESC");
   }
   public function insert_uid_webid($data){
     return $this->_db->insert("uid_webid",$data);
   }
   public function update_uid_webid($data,$uid,$webid,$hour,$datum){
     return $this->_db->update("uid_webid",$data,"UserId='$uid' AND WebsiteId='$webid' AND Hour='$hour' AND DateEntered='$datum'");
   }
   public function check_if_uid_webid_exists($uid,$webid,$hour,$datum){
     return $this->_db->select("SELECT EXISTS(SELECT 1 FROM uid_webid WHERE UserId = '".$uid."' AND WebsiteId = '".$webid."' AND Hour = '".$hour."' AND DateEntered = '".$datum."' LIMIT 1) as mycheck");
   }
   public function select_UserId_to_WebsiteId($uid,$datum){
     return $this->_db->select("SELECT * FROM uid_webid WHERE UserId = '".$uid."' AND Date(DateEntered) = '".$datum."' ORDER BY Hour,IpAddress ASC");
   }
   public function select_UserId_to_WebsiteId_One($uid,$datum,$webid){
     return $this->_db->select("SELECT * FROM uid_webid WHERE UserId = '".$uid."' AND Date(DateEntered) = '".$datum."' AND WebsiteId = '".$webid."' ORDER BY Hour ASC");
   }
   public function select_UserId_to_WebsiteId_2($uid,$datum,$webid,$ip,$hour){
     return $this->_db->select("SELECT hour,Summe FROM uid_webid WHERE UserId = '".$uid."' AND Date(DateEntered) = '".$datum."' AND WebsiteId = '".$webid."' AND Hour = '".$hour."' AND IpAddress = '".$ip."' ORDER BY Hour ASC");
   }
   public function check_strange($uid,$datum){
     return $this->_db->select("SELECT Hour FROM uid_webid WHERE UserId = '".$uid."' AND Date(DateEntered) = '".$datum."' group by Hour");
   }
   public function select_IpAddress($ip){
     return $this->_db->select("SELECT IpAddress,UserId, WebsiteId, date(DateEntered) as DateEntered FROM uid_webid WHERE IpAddress='".$ip."' GROUP BY UserId,WebsiteId,date(DateEntered) ORDER BY DateEntered,WebsiteId ASC");
     //return $this->_db->select("SELECT IpAddress,UserId, WebsiteId, date(DateEntered) as DateEntered FROM uid_webid WHERE IpAddress='".$ip."' GROUP BY WebsiteId,date(DateEntered) ORDER BY DateEntered,WebsiteId ASC");
   }
   public function select_UserId_to_WebsiteId_Ip($uid,$webid,$datum,$ip){
     return $this->_db->select("SELECT * FROM uid_webid WHERE UserId = '".$uid."' AND Date(DateEntered) = '".$datum."' AND WebsiteId = '".$webid."' AND IpAddress = '".$ip."' ORDER BY Hour ASC");
   }
   public function select_uid_from_ip($ip){
     return $this->_db->select("SELECT UserId FROM `uid_webid` WHERE IpAddress = '".$ip."' GROUP BY UserId");
   }
}
