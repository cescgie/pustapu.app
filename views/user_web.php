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
        echo
        "

        ";
}

 ?>
 <!-- graph code begins here-->
<!-- Line Graph script-By Balamurugan S http://www.sbmkpm.com/ //-->
<!-- Script featured/ available at Dynamic Drive code: http://www.dynamicdrive.com //-->
<div id='lineCanvas' style='overflow: auto; position:relative;height:300px;width:400px;'></div>

<script type='text/javascript'>

var g = new line_graph();
'<?php foreach ($data['info_user_web']  as $key){?>';
g.add('<?php echo $key['Hour'] ?>', '<?php echo $key['Summe'] ?>');
'<?php }?>';
g.render('lineCanvas', 'Line Graph');

</script>
