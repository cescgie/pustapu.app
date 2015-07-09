<div class="container">
	<?php echo Message::show(); ?>
	<?php 

  //GA Information
  if (!sizeof($data['sum_ga'])) {
      echo 
      '<div class="alert alert-info">No Ga Data.</div>';
  }else{
      echo
      '<div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">GA</div>';
          foreach ($data['sum_ga'] as $sum_ga){
              echo 
              '<p>'.$sum_ga['Summe_ga']. ' Eintrage</p>';
          }
          if (!sizeof($data['all_user_ga'])) {
              echo 
              '<div class="alert alert-info">No Ga Data.</div>';
          }else{
            echo 
              '<table border="1" style="text-align:center;">
                <thead>
                  <tr>
                    <th width="5%"></th>
                    <th width="30%">UserId</th>
                    <th width="20%">Impressions > 1000</th>
                  </tr>
                </thead>';
                foreach ($data['all_user_ga'] as $key){
                      $i +=1;
                     echo 
                     '<tbody>
                        <tr>
                          <td>'.$i.'</td>
                          <td><a href="'. DIR .'file/select_UserId/'.$key['UserId'].'">'.$key['UserId'].'</a></td>
                          <td>'.$key['Summe'].'</td>
                        </tr>
                      </tbody>';
                }
                echo 
                    '</table>';              
          } 
      echo
      '</div> <!-- panel panel-default -->';               
  } 
  ?>