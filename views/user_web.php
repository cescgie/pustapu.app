<div class="container">
	<?php echo Message::show(); ?>
	<ol class="breadcrumb">
			  <li><a href="<?= DIR ?>">Home</a></li>
			  <li class="#"><a href="<?= DIR .'/file/select_datum/'.$data['datum']?>">UserId (<?= $data['datum']?>)</a></li>
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
        <div class="panel-heading">Impressions von UserId ( '.$data['UserId']. ' ) am ' .$data['datum'].' pro Stunde</div>';
    echo
      '<table border="1" style="text-align:center;">
        <thead>
          <tr>
            <th width="5%"></th>
            <th width="20%"  style="text-align:center;">WebsiteId</th>
						<th width="20%"  style="text-align:center;">IpAddress</th>
            <th width="20%"  style="text-align:center;">Hour</th>
            <th width="20%"  style="text-align:center;">Impressions</th>

          </tr>
        </thead>';
        foreach ($data['info_user_web']  as $key){
              $i +=1;
             echo
             '<tbody>
                <tr>
                  <td>'.$i.'</td>
                  <td><a href="'. DIR .'file/select_WebsiteId?UserId='.$key['UserId'].'&Date='.$data['datum'].'&WebsiteId='.$key['WebsiteId'].'">'.$key['WebsiteId'].'</a></td>
                  <td>'.$key['IpAddress'].'</td>
									<td>'.$key['Hour'].'</td>
                  <td>'.$key['Summe'].'</td>
                </tr>
              </tbody>';
        }
        echo
          '</table>
        </div> <!-- panel panel-default -->';
        echo
        "

        ";
}

 ?>
 <!-- graph code begins here-->
<!-- Line Graph script-By Balamurugan S http://www.sbmkpm.com/ //-->
<!-- Script featured/ available at Dynamic Drive code: http://www.dynamicdrive.com //-->
<div id='lineCanvas' style='overflow: auto; position:relative;height:300px;width:800px;'></div>

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
g.render('lineCanvas', 'Uhr');

</script>
