<div class="container">
	<?php echo Message::show(); ?>
	<?php

  //GA Information
  if (!sizeof($data['available_date'])) {
      echo
      '<div class="alert alert-info">No Data.</div>';
  }else{
      echo
      '<div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Verfügbare Datum</div>';
          echo
          '<table border="1" style="text-align:center;">
            <thead>
              <tr>
                <th width="30px"></th>
                <th width="300px" style="text-align:center;">Datum</th>
              </tr>
            </thead>';
          foreach ($data['available_date'] as $key){
            $i +=1;
           echo
           '<tbody>
              <tr>
                <td>'.$i.'</td>
                <td><a href="'. DIR .'file/select_datum/'.$key['Available_Date'].'">'.$key['Available_Date'].'</a></td>
              </tr>
            </tbody>';
          }
      echo
        '</table>
      </div> <!-- panel panel-default -->';
  }
  ?>
