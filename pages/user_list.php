
<div class="col-md-12">
	<h4>User List</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-7">
	<div class="panel panel-default">
        <div class="panel-heading">
        <?php if($_GET['io'] == '1'){ $btn_class1 = 'class="btn btn-md btn-success"';} else{ $btn_class1 = 'class="btn btn-md btn-default"';} ?>
        <?php if($_GET['io'] == '2'){ $btn_class = 'class="btn btn-md btn-success"';} else{ $btn_class = 'class="btn btn-md btn-default"';} ?>
          <a href="index.php?page=user_list&io=1" <?php echo $btn_class1 ?> > Active</a>
          <a href="index.php?page=user_list&io=2" <?php echo $btn_class ?> > Inactive</a>
          
        </div> 
        <div class="panel-body"> 
			
       <table id="emp" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-3 text-center">Name</th>
        <th class="col-md-2 text-center">User Type</th>
        <th class="col-md-1 text-center"></th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';
   
      $query=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM users left join employee on users.eid=employee.eid where users.io = '".$_GET['io']."' and users.eid != '".$_SESSION['ID']."' ");
         while($row = mysqli_fetch_assoc($query)) {   
         $id =$row['eid']; 
         $id2 =$row['uid']; 
         $eco= date("Y",strtotime($row['date_added'])).$row['ecode'];

    ?>
      <tr>

        <td style="text-transform:capitalize"><?php echo $row['name'] ?></td>
        <td style="text-transform:capitalize" class="text-center"><?php  if($row['user_type'] == '1'){ echo 'Administrator';}else{ echo 'Staff';} ?></td>
        <td style="text-transform:capitalize" class="text-center"><center><a onclick="edit_user('<?php echo $id2 ?>')" ><i class="fa fa-edit"></i> Edit</a></center></td>
       </tr>

      <?php
    } 
      ?>
    </tbody>
  </table>
		</div>
	</div>
</div>
<div class="col-md-5">
	
	<a class="col-sm-7 col-sm-offset-3 btn btn-md btn-info" onclick="new_user()" id="new_user"><center><i class="fa fa-plus"></i> New User</center></a>
  <div id="user">
 <center><h4>New User</h4></center>

  <hr style="border-bottom:1px solid grey"></hr>
  <div class="alert alert-success" id="msg"><i class="fa fa-check"></i> Data successfully added. </div>
    <form id="user_form" method="POST">
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="emp">Employee:</label></div>
    <div class="col-sm-8">
    <select name="eid" id="emp" class="form-control chosen-select" data-placeholder="Select Employee">
    <option value=""></option>
      <?php
    include '../includes/db.php';
   
      $query2=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM employee where io = '1' and eid != '".$_SESSION['ID']."' order by name ");
         while($row2 = mysqli_fetch_assoc($query2)) {  
    ?>
      <option value="<?php echo $row2['eid'] ?>"><?php echo date("Y",strtotime($row2['date_added'])).$row2['ecode']. ' | ' . ucwords($row2['name']) ?></option> 
      <?php } ?>
    </select>
    </div>
    </div>
<br>
<br>
     <div class="form-group">
    <div class="col-sm-4 text-right"><label for="us">Username:</label></div>
    <div class="col-sm-8">
   <input type="text" class="form-control input-sm" id="us" name="user">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="pass">Password:</label></div>
    <div class="col-sm-8">
   <input type="password" class="form-control input-sm" id="pass" name="pass">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="u_type">User Type:</label></div>
    <div class="col-sm-8">
   <select type="text" class="form-control input-sm" id="u_type" name="u_type">
   <option ></option>
   <option value="1">Administrator</option>
   <option value="2">Staff</option>
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
  </div>
</div>
<div id="retCode1">
</div>
 <?php   include '../includes/add_modal.php'; ?>

<script>
	jQuery(document).ready(function(){
    $('#user').hide();
		$('#msg').hide();
						jQuery("#user_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "../forms/add_forms.php?action=user",
									data: formData,
									success: function(html){
										$('#retCode1').append(html);
									var delay = 2000;
										setTimeout(function(){	location.replace(document.referrer);   }, delay);  
									
									}
								});
									return false;
						});
						});
  function new_user(){
    $('#new_user').hide('slideUp');
    $('#user').show('slideUp');
  }
  function edit_user(i){
   $.ajax({
    url:"edit_user.php?uid="+i,
    success: function(html){
      $('#user').html(html);
      $('#new_user').hide();
      $('#user').show('SlideDown');

    }
   });
  }
</script>

<script type="text/javascript">
        $(function() {
            $("#emp").dataTable(
        { "aaSorting": [[ 0, "asc" ]] }
      );
        });
    </script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

