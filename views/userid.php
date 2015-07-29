<div class="container">
	<?php echo Message::show(); ?>
	<ol class="breadcrumb">
		  <li><a href="<?= DIR ?>">Home</a></li>
		  <li class="active">UserId (<?= $data['datum']?>)</li>
		</ol>
<?php
if(!sizeof($data['datum_files'])){
  echo
  '<div class="alert alert-info">No Data.</div>';
  }else{
    echo
    '<div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Verdächtige UserId am '.$data['datum'].'</div>';
    echo
      '<table border="1" style="text-align:center;">
        <thead>
          <tr>
            <th width="5%"></th>
            <th width="20%"  style="text-align:center;">UserId</th>
            <th width="20%"  style="text-align:center;">Impressions</th>
						<!--<th width="10%" style="text-align:center;">Anzahl der Uhrzeit</th>-->
          </tr>
        </thead>';
				$i = 1;
        foreach ($data['datum_files'] as $key){
              //$i +=1;
             echo
             '<tbody>
                <tr>';
								if($key['UserId']!='0000000000000000' && $key['Uhrzeit']>20){
									echo
                  '<td>'.$i.'</td>
                  <td><a href="'. DIR .'file/select_UserId?UserId='.$key['UserId'].'&Date='.$data['datum'].'">'.$key['UserId'].'</a></td>
                  <td>'.$key['Summe'].'</td>';
								}
								echo
								'</tr>
              </tbody>';
							$i = $i+1;
        }
        echo
          '</table>
        </div> <!-- panel panel-default -->';
}

 ?>
