<center><h4>Edit User</h4></center>
  <?php
    include '../includes/db.php';
   
      $query2=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name,users.io as status FROM users left join employee on users.eid = employee.eid where uid = '".$_GET['uid']."' ");
       $row2 = mysqli_fetch_assoc($query2);  
    ?>
  <hr style="border-bottom:1px solid grey"></hr>
  <div id="retCode1"></div>
    <form id="update_user_form" method="POST">
    <div class="form-group">
    <div class="col-sm-12 text-right"><center><label for="emp"><?php echo ucwords($row2['name']) ?></label></center></div>
       <input type="hidden"  value="<?php echo $row2['uid'] ?>" name="uid">

    </div>
    </div>
<br>
<br>
     <div class="form-group">
    <div class="col-sm-4 text-right"><label for="us">Username:</label></div>
    <div class="col-sm-8">
   <input type="text" class="form-control input-sm" id="us" value="<?php echo $row2['username'] ?>" name="user">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="pass">Password:</label></div>
    <div class="col-sm-8">
   <input type="password" class="form-control input-sm" id="pass" value="<?php echo $row2['password'] ?>" name="pass">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="u_type">User Type:</label></div>
    <div class="col-sm-8">
   <select type="text" class="form-control input-sm" id="u_type" name="u_type">
   <option value="<?php echo $row2['user_type'] ?>" >
   <?php  if($row2['user_type'] == '1'){
    echo 'Administrator';
   }else{
    echo 'Contractor';
   }

    ?>
   </option>
   <?php  if($row2['user_type'] == '2'){?><option value="1">Administrator</option> <?php } ?>
    <?php  if($row2['user_type'] == '1'){?><option value="2">Contractor</option><?php } ?>
   </select>
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="status">Status:</label></div>
    <div class="col-sm-8">
   <select type="text" class="form-control input-sm" id="status" name="status">
   <option value="<?php echo $row2['status'] ?>" >
   <?php  if($row2['status'] == '1'){
    echo 'Active';
   }else{
    echo 'Inactive';
   }

    ?>
   </option>
   <?php  if($row2['status'] == '2'){?><option value="1">Active</option> <?php } ?>
    <?php  if($row2['status'] == '1'){?><option value="2">Inactive</option><?php } ?>
   </select>
    </div>
    </div>
<br>
    <hr style="border-bottom:1px solid grey"></hr>

    <div class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-12">
          <center>
          <div class="col-sm-4"></div> 
          <button class="col-sm-2 btn btn-info btn-sm" id="save_pos">Save</button>
          <div class="col-sm-2"></div> 
          <a class="col-sm-2 btn btn-info btn-sm" onclick="window.location.reload()">Cancel</a> 
          </center>
        </div>
      </div>
    </div>
    <hr style="border-bottom:1px solid grey"></hr>
    </form>

  <script>
    $(document).ready(function(){
      $('#msg2').hide();
    });
     jQuery("#update_user_form").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=user",
                  data: formData,
                  success: function(html){
                    $('#retCode1').append(html);
                  var delay = 2000;
                    setTimeout(function(){  location.replace(document.referrer);   }, delay);  
                  
                  }
                });
                  return false;
            });
  </script>