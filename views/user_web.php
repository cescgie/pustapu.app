<div class="container">
	<?php echo Message::show(); ?>
	<?php
	$originalDate = $data['datum'];
	$newDate = date("d.m.Y", strtotime($originalDate));
	?>
		<ol class="breadcrumb">
		  <li><a href="<?= DIR ?>">Home</a></li>
		  <li class="#"><a href="<?= DIR .'/file/select_datum/'.$data['datum']?>">UserId (<?= $newDate?>)</a></li>
			<li class="active">Info von UserId (<?= $data['UserId']?>)</li>
		</ol>
<?php
if(!sizeof($data['info_user_web'] )){
  echo
  '<div class="alert alert-info">No Data.</div>';
  }else{
    echo
    '<div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Information von UserId ( '.$data['UserId']. ' ) am ' .$newDate.'</div>';
    echo
      '<table border="1" style="text-align:center;">
        <thead>
          <tr>
            <th width="5%"></th>
            <th width="20%"  style="text-align:center;">WebsiteId</th>
						<th width="20%"  style="text-align:center;">IpAddress</th>
						<th width="20%"  style="text-align:center;">Uhrzeit</th>
            <th width="20%"  style="text-align:center;">Impressions</th>

          </tr>
        </thead>';
				$i = 1;
        foreach ($data['info_user_web']  as $key){
             echo
             '<tbody>
                <tr>
                  <td>'.$i.'</td>';
									if($data['true']){
										echo '<td><a href="'. DIR .'file/select_WebsiteId_2?UserId='.$key['UserId'].'&Date='.$data['datum'].'&WebsiteId='.$key['WebsiteId'].'&IpAddress='.$key['IpAddress'].'">'.$key['WebsiteId'].'</a></td>';
									}else{
                  	echo '<td><a href="'. DIR .'file/select_WebsiteId?UserId='.$key['UserId'].'&Date='.$data['datum'].'&WebsiteId='.$key['WebsiteId'].'&IpAddress='.$key['IpAddress'].'">'.$key['WebsiteId'].'</a></td>';
									}
									echo '<td><a href="'. DIR .'file/select_ip?Ip='.$key['IpAddress'].'">'.$key['IpAddress'].'</a></td>';
									if(strlen($key['Hour'])==1){
										echo
									'<td>0'.$key['Hour'].'</td>';
									}else{
										echo
									'<td>'.$key['Hour'].'</td>';
									}
									echo
									'<td>'.$key['Summe'].'</td>
                </tr>
              </tbody>';
							$i = $i+1;
        }
        echo
          '</table>
        </div> <!-- panel panel-default -->';
				/*print_r($data['info_userid_webid'][5]);
				if($data['info_userid_webid'][10]['Hour']==10){
					print_r("_test_".$data['info_userid_webid'][0]['Hour']);
				}else{
					print_r("_no_".$data['info_userid_webid'][10]);
				}*/
				//for ($i=0; $i < count( $data['select_hour_summer']); $i++) {

				//print_r($data['select_hour_summe']);

				//print_r($data['select_hour_summe'][1][0]['Summe']);

				//}
					/*foreach ($data['select_hour_summe'] as $key) {
	        echo '<pre>';
	        if ($key) {
	          # code...
	          print_r($key[0]);
	        }else{
	          print_r(0);
	        }
	        echo '</pre>';
	      }*/
}
/*
'<?php for($i=0;$i<24;$i++){?>';
g.add('<?php
if($data['info_userid_webid'][$i]['Hour']==$i){
	echo $data['info_userid_webid'][$i][$i];
}else{
	echo '0';
}
 ?>', '<?php echo "0";?>');
 '<?php}?>';


'<?php foreach ($data['info_userid_webid']  as $key){?>';
g.add('<?php
if(strlen($key['Hour'])==1){
	echo '0'.$key['Hour'];
}else{
	echo $key['Hour'];
}
 ?>', '<?php echo $key['Summe'] ?>');
'<?php
}?>';


OK
'<?php for ($i=0; $i < count( $data['select_hour_summe']); $i++){?>';
g.add('<?php echo $i ?>',
'<?php
if($data['select_hour_summe']){
	echo $data['select_hour_summe'][$i][0]['Summe'];
}else{
	echo "0";
}?>');
'<?php
}?>';
*/
 ?>
 <!-- graph code begins here-->
<!-- Line Graph script-By Balamurugan S http://www.sbmkpm.com/ //-->
<!-- Script featured/ available at Dynamic Drive code: http://www.dynamicdrive.com //-->
<table style="width:100%" border="0">
  <tr>
	<td>
		<div>
			<p>UserId : <?php echo $data['UserId']?></p>
			<p>WebsiteId : <?php
				if (isset($data['webid'])) {
		    		echo $data['webid'];
				}else{
				    echo "(Klik auf eine WebsiteId)";
				}
				?>
			</p>
			<p>IpAddress : <?php
			if (isset($data['ip'])) {
					echo $data['ip'];
			}else{
					echo "(Klik auf eine WebsiteId)";
			}
			?></p>
			<p>Datum : <?php echo $newDate?></p>
		</div>
	</td>
    <td><div id='lineCanvas' style='overflow: auto; position:relative;right:-50px; height:300px;width:800px;'></div>
</td>
  </tr>
</table>
<script type='text/javascript'>

var g = new line_graph();
'<?php for ($i=0; $i < count( $data['select_hour_summe']); $i++){?>';
g.add(
	'<?php
	if(strlen($i)==1){
		echo '0'.$i;
	}else{
		echo $i;
	}
	 ?>',
'<?php
if(!empty($data['select_hour_summe'][$i][0]['Summe'])){
	echo $data['select_hour_summe'][$i][0]['Summe'];
}else{
	echo 0;
}?>');
'<?php
}?>';
g.render('lineCanvas', "Uhrzeit");

</script>
