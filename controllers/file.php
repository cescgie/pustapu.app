<?php

class File extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      /*
      *This will be used as page title.
      */
      $data['title'] = 'Adserverdaten';

      /*
      *As long as admin login, connect app to server file, download files, convert,
      *and parse them into to database.
      */
      //if (Session::get('username')){
      //$this->all_connection();
      //$this->convert("uploads/ga/20150710/");
      //$this->parse_ga("ga","uploads/ga/20150710/");

      //}
      $data['sum_ga'] = $this->_model->summe_ga();
      //$this->update_UserId_impression();
      $data['available_date'] = $this->_model->check_available_date_infos();
      //$data['all_info_user_ga'] = $this->_model->all_info_user_ga();


      //$data['all_user_ga'] = $this->_model->all_user_ga();
      //$data['all_info_user_ga'] = $this->_model->all_info_user_ga();
      //print_r($data['all_info_user_ga']);
      //$data['all_info_user_ga'] = $this->_model->all_info_user_ga();
      //$this->update_UserId($data['all_user_ga']);
      //$this->update_UserId_info();
      /*$data['sum_ga'] = $this->_model->summe_ga();

      $data['all_user_ga'] = $this->_model->all_user_ga();

      $this->update_UserId($data['all_user_ga']);*/
      /*
      *Set recent date & time.
      */
      $data['datum'] = date("Y-m-d H:i:s");

      /*
      *Call all views that will be show as index
      */
      $this->_view->render('header', $data);
      $this->_view->render('date', $data);
      $this->_view->render('footer');
   }
   public function select_datum($datum){
      //echo $uid;
      $data['datum_files'] = $this->_model->select_date_contains($datum);
      $data['datum'] =$datum;

      /*foreach ($data['datum_files'] as $key) {
        # code...
        $data['check'][] = $this->_model->check_strange($key['UserId'],$datum);
      }*/
      //print_r($data['check']);
      /*foreach ($data['check'] as $key) {
        # code...
        echo count($key)."_";
      }*/

      $this->_view->render('header', $data);
      $this->_view->render('userid', $data);
      $this->_view->render('footer');
   }
   public function update_UserId_impression(){
      $data['all_info_user_ga'] = $this->_model->all_info_user_ga();
      //print_r($data['0']);
      //print_r(count($data));
      //$data['check'] = $this->_model->check_strange($key['UserId'],$datum);
      foreach ($data['all_info_user_ga'] as $key) {
        $daten['UserId'] = $key['UserId'];
        $daten['DateEntered'] = $key['DateEntered'];
        $daten['Summe'] = $key['Summe'];
        $data['Uhrzeit'] = $this->_model->check_strange($key['UserId'],$key['DateEntered']);
        /*echo '<pre>';
        print_r($daten['UserId']."_".$daten['Summe']."_".count($daten['Uhrzeit']));
        echo '</pre>';*/
        //echo $daten['DateEntered'];
        //echo $daten['UserId'].'-'.$daten['IpAddress'].'-'.$daten['DateEntered'].'-'.$daten['Summe'];
        $daten['Uhrzeit'] = count($data['Uhrzeit']);
        /*echo '<pre>';
        print_r($daten['UserId']."_".$daten['Summe']."_".$daten['Uhrzeit']);
        echo '</pre>';*/
        $data_check = $this->_model->check_if_uid_exists($key['UserId'],$key['DateEntered']);
        foreach($data_check as $key2){
          //echo $key2['mycheck']."__";
          if($key2['mycheck']==1){
            $update = $this->_model->update_uid($daten,$daten['UserId'],$daten['DateEntered']);
          }else{
            //echo $daten['UserId']."__";
            $insert = $this->_model->insert_uid($daten);
          }
        }
      }
   }
   public function select_UserId(){
      //print_r('Test'.$_GET['UserId'].$_GET['Date']);
      $data['UserId'] = $_GET['UserId'];
      $data['datum'] = $_GET['Date'];
      $data['info_user_web'] = $this->_model->select_UserId_to_WebsiteId($data['UserId'],$data['datum']);
      /*foreach ($data['info_user_web'] as $key) {
        # code...
        echo '<pre>';
        echo $key['WebsiteId']."_".$key['Hour']."_".$key['Summe']."_".$key['DateEntered'];
        echo '</pre>';
      }*/
      $this->_view->render('header', $data);
      $this->_view->render('user_web',$data);
      $this->_view->render('footer');
   }
   public function select_UserId_2(){
    $data['UserId'] = $_GET['UserId'];
    $data['title'] = 'UserId : '.$data['UserId'];

    $data['datum'] = $_GET['Date'];
    $data['IpAddress'] = $_GET['IpAddress'];
    $data['WebsiteId'] = $_GET['WebsiteId'];
    $data['true'] = TRUE;
    //echo $data['IpAddress']."_".$data['WebsiteId'];
    $data['info_user_web'] = $this->_model->select_UserId_to_WebsiteId_Ip($data['UserId'],$data['WebsiteId'],$data['datum'],$data['IpAddress']);
    //print_r($data['info_user_web']);
    /*foreach ($data['info_user_web'] as $key) {
      # code...
      echo '<pre>';
      echo $key['WebsiteId']."_".$key['Hour']."_".$key['Summe']."_".$key['DateEntered']."_".$data['IpAddress'];
      echo '</pre>';
    }*/
    $this->_view->render('header', $data);
    $this->_view->render('user_web',$data);
    $this->_view->render('footer');
  }
   public function insert_UserId_WebsiteId(){
      //print_r('Test'.$_GET['UserId'].$_GET['Date']);
      $data['info_user_web'] = $this->_model->all_UserId_to_WebsiteId();
      foreach ($data['info_user_web'] as $key) {
        $daten['UserId'] = $key['UserId'];
        $daten['WebsiteId'] = $key['WebsiteId'];
        $daten['IpAddress'] = $key['IpAddress'];
        $daten['Hour'] = $key['Hour'];
        $daten['DateEntered'] = $key['DateEntered'];
        $daten['Summe'] = $key['Summe'];
        echo '<pre>';
        echo $key['UserId']."_".$key['WebsiteId']."_".$key['IpAddress']."_".$key['Hour']."_".$key['Summe']."_".$key['DateEntered'];
        echo '</pre>';
        //$insert = $this->_model->insert_uid_webid($daten);
        $data_check = $this->_model->check_if_uid_webid_exists($key['UserId'],$key['WebsiteId'],$key['Hour'],$key['DateEntered']);
        foreach($data_check as $key2){
          //echo $key2['mycheck']."__";
          if($key2['mycheck']==1){
            $update = $this->_model->update_uid_webid($daten,$daten['UserId'],$daten['WebsiteId'],$daten['Hour'],$daten['DateEntered']);;
          }else{
            //echo $daten['UserId']."__";
            $insert = $this->_model->insert_uid_webid($daten);
          }
        }
      }
   }
   /*
   public function select_WebsiteId(){
     //print_r('Test'.$_GET['UserId'].$_GET['Date'].$_GET['WebsiteId']);
     $data['UserId'] = $_GET['UserId'];
     $data['datum'] = $_GET['Date'];
     $data['WebsiteId'] = $_GET['WebsiteId'];
     $data['info_user_web'] = $this->_model->select_UserId_to_WebsiteId($data['UserId'],$data['datum']);
     $data['info_userid_webid'] = $this->_model->select_UserId_to_WebsiteId_One($data['UserId'],$data['datum'],$data['WebsiteId'] );
     //print_r($data['info_userid_webid'][0]);

     $datax=[
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],0 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],1 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],2 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],3 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],4 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],5 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],6 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],7 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],8 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],9 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],10 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],11 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],12 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],13 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],14 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],15 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],16 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],17 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],18 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],19 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],20 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],21 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],22 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],23 )

     ];
     $data['select_hour_summe'] = $datax;
     /*foreach ($data['info_userid_webid'] as $key) {
       $daten['UserId'] = $key['UserId'];
       $daten['WebsiteId'] = $key['WebsiteId'];
       $daten['Hour'] = $key['Hour'];
       $daten['DateEntered'] = $key['DateEntered'];
       $daten['Summe'] = $key['Summe'];
       echo '<pre>';
       echo $key['UserId']."_".$key['WebsiteId']."_".$key['Hour']."_".$key['Summe']."_".$key['DateEntered'];
       echo '</pre>';
     }
     $this->_view->render('header', $data);
     $this->_view->render('user_web',$data);
     if($_GET['Ip']){
       $data['Ip'] = $_GET['Ip'];
       //echo $data['Ip'];
       $data['info_Ip'] = $this->_model->select_IpAddress($data['Ip']);
       $this->_view->render('ipaddress',$data);
     }
     $this->_view->render('footer');
   }*/
   public function select_WebsiteId(){
     //print_r('Test'.$_GET['UserId'].$_GET['Date'].$_GET['WebsiteId']);
     $data['UserId'] = $_GET['UserId'];
     $data['datum'] = $_GET['Date'];
     $data['WebsiteId'] = $_GET['WebsiteId'];
     $data['title'] = 'WebsiteId : '.$data['WebsiteId'];

     $data['IpAddress'] = $_GET['IpAddress'];
     $data['info_user_web'] = $this->_model->select_UserId_to_WebsiteId($data['UserId'],$data['datum']);
     //$data['info_userid_webid'] = $this->_model->select_UserId_to_WebsiteId_One($data['UserId'],$data['datum'],$data['WebsiteId'] );
     $data['ip'] = $data['IpAddress'];
     $data['webid'] = $data['WebsiteId'];
     $datax=[
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],0 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],1 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],2 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],3 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],4 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],5 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],6 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],7 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],8 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],9 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],10 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],11 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],12 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],13 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],14 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],15 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],16 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],17 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],18 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],19 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],20 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],21 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],22 ),
         $saw=$this->_model->select_UserId_to_WebsiteId_2($data['UserId'],$data['datum'],$data['WebsiteId'],$data['IpAddress'],23 )

     ];
     $data['select_hour_summe'] = $datax;
     /*echo '<pre>';
     print_r($data['select_hour_summer']);
     echo '</pre>';*/
     /*for ($i=0; $i < count( $data['select_hour_summer']); $i++) {
       # code
       echo '<pre>';
       if ($data['select_hour_summer'][$i]) {
         # code...
         print_r($data['select_hour_summer'][$i]);
       }else{
         print_r(0);
       }
       echo '</pre>';
     }*/
     /*foreach ($data['select_hour_summer'] as $key) {
       echo '<pre>';
       if ($key) {
         # code...
         print_r($key[0]);
       }else{
         print_r(0);
       }
       echo '</pre>';
     }*/
     //print_r($data['info_userid_webid_2']);
     //foreach ($data['info_userid_webid_2'] as $key) {
       //$daten['UserId'] = $key['UserId'];
       /*for($i=0;$i<24;$i++){
         //echo $i."__";
         if($data['info_userid_webid_2'][$i]['Hour']==$i){
           echo '<pre>';
           echo $data['info_userid_webid_2'][$i]['Hour'].",".$data['info_userid_webid_2'][$i]['Summe']."__";
           echo '</pre>';
         }else{
           echo '<pre>';
           echo $i.",0"."--";
           echo '</pre>';
         }
       //}
       $daten['WebsiteId'] = $key['WebsiteId'];
       $daten['Hour'] = $key['Hour'];
       //$daten['DateEntered'] = $key['DateEntered'];
       $daten['Summe'] = $key['Summe'];
       /*echo '<pre>';
       //echo $key['UserId']."_".$key['WebsiteId']."_".$key['Hour']."_".$key['Summe'];
       echo $key['WebsiteId']."_".$key['Hour']."_".$key['Summe'];
       echo '</pre>';*/
     //}
     $this->_view->render('header', $data);
     $this->_view->render('user_web',$data);
     $this->_view->render('footer');
   }
   public function select_ip(){
    $data['Ip'] = $_GET['Ip'];
    $data['title'] = 'IpAddress : '.$data['Ip'];

    //echo $data['Ip'];

    $data['info_Ip'] = $this->_model->select_IpAddress($data['Ip']);

    $data['uid'] = $this->_model->select_uid_from_ip($data['Ip']);
    //print_r($data['uid']);
    //header("Location: ".$_SERVER['HTTP_REFERER']);
    $this->_view->render('header', $data);
    $this->_view->render('ipaddress',$data);
    $this->_view->render('footer');
   }
   public function all_connection(){
      $this->connect('ga');
   }

   public function get_web_page( $url )
   {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $username = ADS_USER;
        $password = ADS_PASS;
        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 0,      // timeout on connect
            CURLOPT_TIMEOUT        => 0,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
         		CURLOPT_HTTPAUTH	   => CURLAUTH_ANY,
  			    CURLOPT_USERPWD		   => "$username:$password",
		    );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
	}

  public function convert($file_in)
  {
    //echo $file_in;
    //This input should be from somewhere else, hard-coded in this example
    $folder = $file_in;
    $handlefolder = opendir ($folder);
    while ($file_hour = readdir ($handlefolder)) {
      $handlefolder2 = opendir ($folder.$file_hour);
      while ($file_name = readdir ($handlefolder2)){
        /*echo '<pre>';
        echo 'file_hour_'.$file_name;
        echo "</pre>";*/
        $files_to_convert = $folder.$file_hour."/".$file_name;
        if (substr($files_to_convert, -3) == '.gz') {
          // Raising this value may increase performance
          $buffer_size = 4096; // read 4kb at a time
          $out_file_name = str_replace('.gz', '', $files_to_convert);
          // Open our files (in binary mode)
          $file = gzopen($files_to_convert, 'rb');
          $out_file = fopen($out_file_name, 'wb');
          // Keep repeating until the end of the input file
          while(!gzeof($file)) {
            // Read buffer-size bytes
            // Both fwrite and gzread and binary-safe
            fwrite($out_file, gzread($file, $buffer_size));
          }
          // Files are done, close files
          fclose($out_file);
          gzclose($file);
          echo $out_file;
          //delete unconverted files
          unlink($folder.$file_hour."/".$file_name);
        }
      }
    }
  }

  public function download_remote_file_with_curl($files_url, $save_to)
  {
      $username = ADS_USER;
      $password = ADS_PASS;
      $che = curl_init();
      curl_setopt($che, CURLOPT_POST, 0);
      curl_setopt($che, CURLOPT_URL,$files_url);
      curl_setopt($che, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($che, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
      curl_setopt($che, CURLOPT_USERPWD, "$username:$password");

      $content = curl_exec($che);

      $download = fopen($save_to, 'w');
      fwrite($download, $content);
      fclose($download);
      curl_close( $che );
  }

  public function connect($table)
  {
      //Read a web page and check for errors:
      $url = "http://sgsdata.adtech.de/59.1/0/".$table."/";
      $result = $this->get_web_page( $url );

      if ( $result['errno'] != 0 )
          Message::set("error: bad url | timeout | redirect loop ...");

      if ( $result['http_code'] != 200 )
          Message::set("error: no page | no permissions | no service ");

      $page = $result['content'];

      if($result==TRUE){
          //explode
          $str = $page;
          $preg=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str, $parts);
          if($preg==TRUE){

              //get the highest available array key
              $maxIndex = array_search(max($parts[0]), $parts[0]);
              //rename value from $maxIndex. Before : "(1 space)value"
              $subValue = substr($parts[1][$maxIndex], 1);
              $newurl=$url.$subValue."";

              $result2 = $this->get_web_page( $newurl );

              if ( $result2['errno'] != 0 )
                  Message::set("error: bad url | timeout | redirect loop ...");

              if ( $result2['http_code'] != 200 )
                  Message::set("error: no page | no permissions | no service ");

              $page2 = $result2['content'];

              if($result2==TRUE){
                  $str2 = $page2;
                  $preg2=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str2, $parts2);
                  if($preg2==TRUE){

                      //get the highest available array key
                      $maxIndex2 = array_search(max($parts2[0]), $parts2[0]);
                      //rename value from $maxIndex. Before : "(1 space)value"
                      $subValue2 = substr($parts2[1][$maxIndex2], 1);
                      $newurl2=$newurl.$subValue2."";
                      $result3 = $this->get_web_page( $newurl2 );

                      if ( $result3['errno'] != 0 )
                          Message::set("error: bad url | timeout | redirect loop ...");

                      if ( $result3['http_code'] != 200 )
                          Message::set("error: no page | no permissions | no service ");

                      $page3 = $result3['content'];
                      if($result3==TRUE){
                          //create folder
                          /*if(!is_dir($dir .= "uploads/".$table."/".$subValue)){
                            mkdir($dir, 0777, true);
                            chmod($dir, 0777);
                          }*/
                          if(!is_dir($dir2 .= 'uploads/'.$table.'/'.$subValue.$subValue2)){
                              mkdir($dir2, 0777, true);
                              chmod($dir2, 0777);
                          }
                          //create index file
                          $myfile = fopen($dir2."index.txt", "w") or die("Unable to open file!");

                          $str3 = $page3;
                          $preg3=preg_match_all('#<li><a.*?>(.*?)<\/a></li>#', $str3, $parts3);
                          if($preg3==TRUE){
                              //count summe of all files with array key
                              $countArray = count($parts3[1]);
                              for ($i = 1; $i < $countArray; $i++) {
                                  //rename file. Before : "(1 space)filename"
                                  $subValue3 = substr($parts3[1][$i], 1);
                                  //upload files to storage
                                  //url to files
                                  $newurl3=$newurl2.$subValue3."";
                                  $subName = substr($subValue3,0,-3);
                                  //check if files already exist
                                  if(!is_file(getcwd()."/".$dir2.$subName)){
                                    //check if files had been already parsed
                                    if(!is_file(getcwd()."/".$dir2.$subName.".done")){
                                      //download remote files
                                      $this->download_remote_file_with_curl($newurl3, getcwd()."/".$dir2.$subValue3);
                                      //check if uploaded file extention is gz
                                      if (substr(getcwd()."/".$dir2.$subValue3, -3) !== '.gz') {
                                            //rename
                                            $filenames = $subValue3;
                                      }else{
                                            //Convert files(gz) to bin directly after put them in uploads directory
                                            //$this->convert(getcwd()."/".$dir2.$subValue3);
                                            //rename
                                            $filenames = substr($subValue3, 0, -3);
                                            //delete gz file
                                            //unlink(getcwd()."/".$dir2.$subValue3);
                                      }
                                  }else{
                                    $filenames = substr($subValue3, 0, -3);
                                  }
                                  //overwrite index.txt
                                  $txt = $filenames."\n";
                                  fwrite($myfile, $txt);
                                }
                              }
                              //Parse files into Database
                              //$parse='parse_'.$table;
                              //$this->$parse($dir2);
                          } // end of 'if($preg3==TRUE)'
                      } // enc of 'if($result3==TRUE)'
                  } // end of 'if($preg2==TRUE)'
              } // end of 'if($result2==TRUE)'
          } // end of 'if($preg==TRUE)'
      } // end of 'if($result==TRUE)'
  } // end of function

  public function parse_ga($table,$folder) {
      //$dir2 = 'uploads/ga/20150708/19/';
    //echo $table."__".$folder;
      ini_set('max_execution_time', 0);
      @set_time_limit(0);

      $debugTimeStart = microtime(true);

      $dataTypesSize = array(
                     'tinyint'=> array('code'=>'C', 'size'=>''),
                     'smallint'=> array( 'code'=>'n', 'size'=>''),
                     'int'=> array('code'=>'N', 'size'=>''),
                     'unsignedint'=> array('code'=>'N', 'size'=>''),
                     'char(16)'=> array('code'=>'a16', 'size'=>''),
                     'char(32)'=> array('code'=>'a32', 'size'=>''),
                     'char(50)'=> array('code'=>'a50', 'size'=>''),
                     'char(150)'=> array('code'=>'a150', 'size'=>''),
                     'char(200)'=> array('code'=>'a200', 'size'=>''),
                     'char(1000)'=> array('code'=>'a1000', 'size'=>''),
                     'varchar(1000)'=> array('code'=>'a999', 'size'=>''),
               );
      $codeGA = array(
              array('name'=>'VersionId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'0'),
              array('name'=>'SequenceId', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PlcNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PlcSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'WebsiteId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PlacementId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PageId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CmgnNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CmgnSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'MasterCampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'BannerId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'BannerNumber', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PaymentId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'StateId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'AreaCodeId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'IpAddress', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'UserId', 'type'=>'char(16)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'OsId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'TagType', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'BrowserId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'BrowserLanguage', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'TLDId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'MediaTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'PlcContentTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'Reserved2', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'DateEntered', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'Hour', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'Minute', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'Second', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'AdServerIp', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'AdServerFarmId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'DMAId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CountryId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'ZipCodeId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CityId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'IspId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'CountTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
              array('name'=>'ConnectionTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'')
         );

        $code = $codeGA;

              //sizes of datatypes
        foreach($dataTypesSize AS $k=>$v) {
              $dataTypesSize[$k]['size'] = strlen(pack($dataTypesSize[$k]['code'], ''));
        };
        $rowPointer = 0;
        foreach($code AS $k=>$v) {
              $code[$k]['size'] = $dataTypesSize[$code[$k]['type']]['size'];
              $code[$k]['code'] =  $dataTypesSize[$code[$k]['type']]['code'];
              $code[$k]['accumulatedPointer'] = $rowPointer;
              $rowPointer += $code[$k]['size'];
        };

        //   size/length row
        $rowLength = count($code);
        $rowSize = 0;
        foreach($code AS $k=>$v) {
             $rowSize += $code[$k]['size'];
        };

        // errorcode
        $errorcode = array('-2', '-3', '-4', '-6', '-7', '-10', '-23', '-26', '-98');
        $handlefolder = opendir ($folder);
        while ($file_hour = readdir ($handlefolder)) {
          $handlefolder2 = opendir ($folder.$file_hour);
          while ($file_name = readdir ($handlefolder2)){
            $files_to_parse = $folder.$file_hour."/".$file_name;
            if (substr($files_to_parse, -4) == '.bin') {
                echo "<pre>";
                echo "File_name_".$files_to_parse;
                echo "</pre>";
                $handle = fopen($files_to_parse, 'rb');
            while ($contents = fread($handle, $rowSize)) {
                $tmpObject = array();
                for ($i=0; $i<$rowLength; $i++) {
                           $data = unpack($code[$i]['code'], substr($contents, $code[$i]['accumulatedPointer'], $code[$i]['size']));
                           $data = $data[1];

                           if ($code[$i]['name'] == 'IpAddress') {
                              $data = (255 & ($data >> 24)).'.'.(255 & ($data >> 16)).'.'.(255 & $data>>8).'.'.(255 & $data);
                           } elseif ($code[$i]['name'] == 'UserId') {
                              $user = '';
                              for ($ii=0; $ii<strlen($data); $ii++) {
                                 $userTmp = ord($data[$ii]);
                                 $user = $user.dechex ((15 & ($userTmp >> 4))).dechex (15 & $userTmp);
                              };
                              $data = $user;

                           } elseif ($data < 0) {           // AND $code[$i]['type'] == 'unsignedint'
                              if (!in_array($data, $errorcode))
                                 $data = substr(bcsub($data*-1, 4294967296), 1);
                           };
                           $tmpObject[$i] = $data;

                  };
                        //$datas['VersionId'] = $tmpObject[0];
                        //$datas['SequenceId'] = $tmpObject[1];
                        //$datas['PlcNetworkId'] = $tmpObject[2];
                        $datas['WebsiteId'] =$tmpObject[4];
                        $datas['PlacementId'] =$tmpObject[5];
                        //$datas['CmgnNetworkId'] =$tmpObject[7];
                        $datas['CampaignId'] =$tmpObject[9];
                        //$datas['MasterCampaignId'] =$tmpObject[10];
                        $datas['BannerId'] =$tmpObject[11];
                        $datas['BannerNumber'] =$tmpObject[12];
                        $datas['PaymentId'] =$tmpObject[13];
                        $datas['StateId'] =$tmpObject[14];
                        $datas['AreaCodeId'] =$tmpObject[15];
                        $datas['IpAddress'] =$tmpObject[16];
                        $datas['UserId'] =$tmpObject[17];
                        $datas['OsId'] =$tmpObject[18];
                        //$datas['TagType'] =$tmpObject[19];
                        $datas['BrowserId'] =$tmpObject[20];
                        $datas['BrowserLanguage'] =$tmpObject[21];
                        $datas['TLDId'] =$tmpObject[22];
                        $datas['MediaTypeId'] =$tmpObject[23];
                          //Format DateTime
                          $key['DateEntered'] =$tmpObject[26];
                          $key['Hour'] =$tmpObject[27];
                          $key['Minute'] =$tmpObject[28];
                          $key['Second'] =$tmpObject[29];
                          $retrieved = $key['DateEntered'];
                          $date = DateTime::createFromFormat('Ymd', $retrieved);
                          $reformDate = $date->format('Y-m-d');
                          $DateTime = $reformDate .' '.$key['Hour'].':'.$key['Minute'].':'.$key['Second'];
                          $date = strtotime($DateTime);
                          $date_full_format = date('Y-m-d H:i:s', $date);
                          //End of Format DateTime
                        $datas['DateEntered'] = $date_full_format;
                        //$datas['AdServerIp'] =$tmpObject[30];
                        //$datas['AdServerFarmId'] =$tmpObject[31];
                        $datas['DMAId'] =$tmpObject[32];
                        $datas['CountryId'] =$tmpObject[33];
                        $datas['ZipCodeId'] =$tmpObject[34];
                        $datas['CityId'] =$tmpObject[35];
                        $datas['IspId'] =$tmpObject[36];
                        $datas['CountTypeId'] =$tmpObject[37];
                        $datas['ConnectionTypeId'] =$tmpObject[38];
                        $datas['in_bin'] =  $file_name;
                        $this->_model->_insert_ga($datas);

             };//end of while ($contents = fread($handle, $rowSize))
            //rename bin folder in path uploads/
            }
            //rename bin folder in path uploads/
            @fclose($handle);
            if (substr($files_to_parse, -4) == '.bin'){
              @chmod($files_to_parse, 0777);
              @rename($files_to_parse, $files_to_parse.'.done');
            }
        };
        $debugTimeEnd = microtime(true);
      }
    } // end of function
} // end of class
