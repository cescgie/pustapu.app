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

        $i =0;
        foreach ($data['info_user_web']  as $key){
             echo
             '<tbody>
                <tr>
                  <td>'.$i.'</td>
                  <td><a href="'. DIR .'file/select_WebsiteId_2?UserId='.$key['UserId'].'&Date='.$data['datum'].'&WebsiteId='.$key['WebsiteId'].'&IpAddress='.$key['IpAddress'].'">'.$key['WebsiteId'].'</a></td>
									<td><a href="'. DIR .'file/select_ip?Ip='.$key['IpAddress'].'">'.$key['IpAddress'].'</a></td>';
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
}

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
