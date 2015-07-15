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
      <div class="panel-heading">IpAddress '.$data['Ip'].'</div>';
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
                <td>'.$key['UserId'].'</td>
                <td>'.$key['WebsiteId'].'</td>
                <td>'.$key['DateEntered'].'</td>
              </tr>
            </tbody>';
      }
      echo
        '</table>
      </div> <!-- panel panel-default -->';
  }
