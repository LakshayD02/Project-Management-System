<form method="POST" id="att_form" >
		<table id="" class="table table-bordered table-stripped">
    <thead>
     <tr >
        <th class="col-md-2 text-center">Name</th>
        <th class="col-md-1 text-center"></th>
        <th class="col-md-1 text-center"></th>
      </tr>
       
     
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';
     $d = date('Y-m-d',strtotime('today'));
   if($_GET['tid'] == 'all'){ 
      $query=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM employee  where io = '1' order by name ");
        
       }else{
        $query=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM team_member natural join employee where tid = '".$_GET['tid']."' order by name ");
        $query4=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM project_team left join employee on project_team.eid=employee.eid where tid = '".$_GET['tid']."' ");
        $row4 = mysqli_fetch_assoc($query4);
         $id4 =$row4['eid']; ?>
         <tr>
        <th><?php echo ucwords($row4['name'])." (Foreman)" ?></th>
        <?php $query5 = mysqli_query($conn,"SELECT * FROM attendance where eid = '$id4' and date_today = '$d' ");
        
        if( mysqli_num_rows($query5) > 0){
        $row5 = mysqli_fetch_assoc($query5);
        if($row5['time_in'] == '00:00:00'){ $check1 = ''; }else{ $check1 = 'checked';}  
        if($row5['time_out'] == '00:00:00'){ $check2 = ''; }else{$check2 = 'checked'; } 
        } ?>
        <th><center><label><input type="checkbox"  id="in<?php echo $id4 ?>"  onclick="att_in(<?php echo $id4 ?>)" class="checkitems1" value="<?php echo $id4 ?>" <?php echo $check1 ?>> IN</label></center></th>
        <th><center><label><input type="checkbox"  id="out<?php echo $id4 ?>"  onclick="att_out(<?php echo $id4 ?>)" class="checkitems2" value="<?php echo $id4 ?>" <?php echo $check2 ?>> OUT</label></center></th>
      </tr>

         <?php
      }
         while($row = mysqli_fetch_assoc($query)) {   
         $id =$row['eid']; 
        
    ?>
      <tr>
        <td><?php echo ucwords($row['name']) ?></td>
        <?php $query2 = mysqli_query($conn,"SELECT * FROM attendance where eid = '$id' and date_today = '$d'  ");
         $row2 = mysqli_fetch_assoc($query2);
        if( mysqli_num_rows($query2) > 0){ ?>

        
         <td><center><label><input type="checkbox" id="in<?php echo $id ?>" onclick="att_in(<?php echo $id ?>)" class="checkitems1" value="<?php echo $id ?>" <?php   if($row2['time_in'] != '00:00:00'){ echo 'checked';} ?>> IN</label></center></td>
        <td><center><label><input type="checkbox" id="out<?php echo $id ?>" onclick="att_out(<?php echo $id ?>)" class="checkitems2" value="<?php echo $id ?>" <?php if($row2['time_out'] != '00:00:00'){ echo 'checked';} ?>> OUT</label></center></td>


       <?php } else{ ?>
        <td><center><label><input type="checkbox" id="in<?php echo $id ?>" onclick="att_in(<?php echo $id ?>)" class="checkitems1" value="<?php echo $id ?>" > IN</label></center></td>
        <td><center><label><input type="checkbox" id="out<?php echo $id ?>" onclick="att_out(<?php echo $id ?>)" class="checkitems2" value="<?php echo $id ?>" > OUT</label></center></td>
        <?php } ?>
      </tr>

      <?php
   
    } 
      ?>
    </tbody>
  </table>
  <div class="col-md-12" id="act">
   <center><a href="index.php?page=attendance&tid=all" class="btn btn-info btn-sm">Cancel</a>
  </div></center><br>
</form>
<script>
  jQuery(document).ready(function(){


             jQuery("#att_form").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/add_forms.php?action=attendance",
                  data: formData,
                  success: function(html){
                  $('#retCode1').html(html);
                   
                 
                  }
                });
                  return false;
            });


            });
</script>
<script>

  function att_in(i){
    var check = document.getElementById('in'+i);
    var id = $('#in'+i).val();
    if(check.checked == true){
      $.ajax({
        url:'../forms/add_forms.php?id='+id+'&action=attendance&task=in&d=<?php echo $d ?>',
        success:function(html){
           $('#retCode1').html(html);

        }
      });
    }else{
      $.ajax({
        url:'../forms/add_forms.php?id='+id+'&action=attendance&task=del&d=<?php echo $d ?>',
        success:function(html){
           $('#retCode1').html(html);

        }
      });
    }


  }

  function att_out(p){
    var check = document.getElementById('out'+p);
    var id = $('#out'+p).val();
    if(check.checked == true){
      $.ajax({
        url:'../forms/update_forms.php?id='+id+'&action=attendance&task=out&d=<?php echo $d ?>',
        success:function(html){
           $('#retCode1').html(html);

        }
      }); /*alert('checked');*/
    }else{
     $.ajax({
        url:'../forms/update_forms.php?id='+id+'&action=attendance&task=odel&d=<?php echo $d ?>',
        success:function(html){
           $('#retCode1').html(html);

        }
      });/*alert('unchecked');*/
    }


  }
 
</script>