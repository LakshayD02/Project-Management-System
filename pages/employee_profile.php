<div class="col-md-12">
<br><br>
<hr style="border-bottom:1px solid grey"></hr>
</div>
<style>
	.control-label {
		text-transform:capitalize;
	}
</style>
<?php
include '../includes/db.php';
$id = $_GET['id'];
$emp_query = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name from employee natural join position  where eid= '$id'");
$row= mysqli_fetch_assoc($emp_query);
$d1 = date("Y",strtotime($row['bday']));
$d2 = date("Y");

if(date("md",strtotime($row['bday'])) > date('md') ){
	$age = ($d2 - $d1)-1;
}else{
	$age = $d2 - $d1;
}

 ?>
</div>

<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
	<div class="col-md-2">
	<center><img src="../images/<?php echo $row['e_pic'] ?>" width="200px" height="230px"></center>
	<center><a  href="#change_pic" data-toggle="modal">Change Picture</a></center>
	</div>
	<br>
	<br>
	<br>
	<div class="col-md-6">
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Name:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['name'] ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Birthday:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo date("F d, Y",strtotime($row['bday'])) ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Age:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $age ?></label></div>
	</div>
	
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Address:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['address'] ?></label></div>
	</div>
	
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Status:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['status'] ?></label></div>
	</div>
	
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Position:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['position'] ?></label></div>
	</div>

	<?php if(!isset($_GET['dattyp'])){ ?>
		<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Profile Status:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php if($row['io'] == '1'){ echo 'Active';}else{ echo 'Inactive'; } ?></label></div>
	</div>
	<?php } ?>
	
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="col-md-5"></div>
<div class="col-md-6 col-md-offset-5">
<?php if(isset($_GET['dattyp'])){ ?>
	<a href="index.php?page=employee&io=1" class="btn btn-sm btn-info"> DONE </a>
	<a href="cancel_emp.php?id=<?php echo $id ?>" class="btn btn-sm btn-info"> Cancel </a>
	<?php }else{ ?>
	<a href="#update_emp" data-toggle="modal" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit </a>
	<a href="index.php?page=employee&io=1" class="btn btn-sm btn-info"><i class="fa fa-"></i> Back </a>
	<?php } ?>
</div>
</div>
</div>
<?php include '../includes/update_modals.php' ?>
     
 