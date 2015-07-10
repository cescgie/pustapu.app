<div class="container">
	<?php echo Message::show(); ?>

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
                  <td>'.$key['WebsiteId'].'</td>
                  <td>'.$key['Hour'].'</td>
                  <td>'.$key['Summe'].'</td>
                </tr>
              </tbody>';
        }
        echo
          '</table>
        </div> <!-- panel panel-default -->';
}

 ?>
