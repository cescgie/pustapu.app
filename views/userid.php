<div class="container">
	<?php echo Message::show(); ?>

<?php
if(!sizeof($data['datum_files'])){
  echo
  '<div class="alert alert-info">No Data.</div>';
  }else{
    echo
    '<div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">UserId mit Impressions > 1000 in '.$data['datum'].'</div>';
    echo
      '<table border="1" style="text-align:center;">
        <thead>
          <tr>
            <th width="5%"></th>
            <th width="20%"  style="text-align:center;">UserId</th>
            <th width="20%"  style="text-align:center;">Impressions</th>
          </tr>
        </thead>';
        foreach ($data['datum_files'] as $key){
              $i +=1;
             echo
             '<tbody>
                <tr>
                  <td>'.$i.'</td>
                  <td><a href="'. DIR .'file/select_UserId?UserId='.$key['UserId'].'&Date='.$data['datum'].'">'.$key['UserId'].'</a></td>
                  <td>'.$key['Summe'].'</td>
                </tr>
              </tbody>';
        }
        echo
          '</table>
        </div> <!-- panel panel-default -->';
}

 ?>
