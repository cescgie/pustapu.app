<div class="container">
	<?php echo Message::show(); ?>
	<ol class="breadcrumb">
			  <li><a href="<?= DIR ?>">Home</a></li>
	</ol>
<?php
if(!sizeof($data['info_Ip'])){
  echo
  '<div class="alert alert-info">No Data.</div>';
}else{
  echo
  '<div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">IpAddress : '.$data['Ip'].'</div>';
  echo
    '<table border="1" style="text-align:center;">
      <thead>
        <tr>
          <th width="5%"></th>
          <th width="20%"  style="text-align:center;">UserId</th>
          <th width="20%"  style="text-align:center;">WebsiteId</th>
          <th width="20%"  style="text-align:center;">Datum</th>

        </tr>
      </thead>';
      foreach ($data['info_Ip']  as $key){
            $i +=1;
           echo
           '<tbody>
              <tr>
                <td>'.$i.'</td>
								<td><a href="'. DIR .'file/select_UserId_2?UserId='.$key['UserId'].'&Date='.$key['DateEntered'].'&IpAddress='.$data['Ip'].'&WebsiteId='.$key['WebsiteId'].'">'.$key['UserId'].'</a></td>
                <td>'.$key['WebsiteId'].'</td>
                <td>'.$key['DateEntered'].'</td>
              </tr>
            </tbody>';
      }
      echo
        '</table>
      </div> <!-- panel panel-default -->';
echo
	'<div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Alle Userid von '.$data['Ip'].'</div>';
      foreach ($data['uid']  as $key){
				echo
				'<ul><li><p>'.$key['UserId'].'</p></li></ul>';
			}
	echo '</div> <!-- panel panel-default -->';
  }
