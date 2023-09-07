
<div class="col-md-12">
	<h4>List of Employee's</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-10">
	<div class="panel panel-default">
        <div class="panel-heading">
        <?php if($_GET['io'] == '1'){ $btn_class1 = 'class="btn btn-md btn-success"';} else{ $btn_class1 = 'class="btn btn-md btn-default"';} ?>
        <?php if($_GET['io'] == '2'){ $btn_class = 'class="btn btn-md btn-success"';} else{ $btn_class = 'class="btn btn-md btn-default"';} ?>
          <a href="index.php?page=employee&io=1" <?php echo $btn_class1 ?> > Active</a>
          <a href="index.php?page=employee&io=2" <?php echo $btn_class ?> > Inactive</a>
          
        </div> 
        <div class="panel-body"> 
			
       <table id="emp" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-1 text-center"></th>
        <th class="col-md-1 text-center">E-code</th>
        <th class="col-md-3 text-center">Name</th>
        <th class="col-md-2 text-center">Position</th>
        <th class="col-md-1 text-center"></th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';
   
      $query=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM employee natural join position where io = '".$_GET['io']."' and eid != 1 order by name ");
         while($row = mysqli_fetch_assoc($query)) {   
         $id =$row['eid']; 
         $eco= date("Y",strtotime($row['date_added'])).$row['ecode'];

    ?>
      <tr>


        <td style="text-transform:capitalize" class="text-center"><img src='../images/<?php echo $row["e_pic"]?>' width='50px' height='60px'></td>
        <td style="text-transform:capitalize" class="text-center"><?php echo $eco ?></td>
        <td style="text-transform:capitalize"><?php echo $row['name'] ?></td>
        <td style="text-transform:capitalize" class="text-center"><?php echo $row['position'] ?></td>
        <td style="text-transform:capitalize" class="text-center"><center><a href="index.php?page=employee_profile&id=<?php echo $id ?>" ><i class="fa fa-eye"></i> Profile</a></center></td>
       </tr>

      <?php
   
    } 
      ?>
    </tbody>
  </table>
		</div>
	</div>
</div>
<div class="col-md-2">
	
	<a class="col-sm-12 btn btn-md btn-info"  href="#new_employee" data-toggle="modal"><center><i class="fa fa-plus"></i>New Employee</center></a>
</div>
<div id="retCode1"></div>
 <?php   include '../includes/add_modal.php'; ?>
<script>
	jQuery(document).ready(function(){
		$('#suc_msg').hide();
    $('#err_msg').hide();
						jQuery("#pos_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "../forms/add_forms.php?action=position",
									data: formData,
									success: function(html){
										$('#retCode1').html(html);
									var delay = 2000;
										setTimeout(function(){	window.location = 'index.php?page=position';   }, delay);  
									
									}
								});
									return false;
						});
						});
</script>


<script type="text/javascript">
        $(function() {
            $("#emp").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
        });
    </script>
     <script>
  jQuery(document).ready(function(){


             jQuery("#emp_form").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/add_forms.php?action=employee",
                  data: formData,
                  success: function(html){
                  $('#retCode2').append(html);
                   
                 
                  }
                });
                  return false;
            });


            });
</script>
<!-- ,
             -->