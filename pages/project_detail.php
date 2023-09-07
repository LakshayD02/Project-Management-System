<div class="col-md-12">
<br><br>
<hr style="border-bottom:1px solid grey"></hr>
</div>
<style>
	.control-label {
		text-transform:capitalize;
	}
	.panel .form-group{
		margin:unset
	}

</style>
<?php
include '../includes/db.php';
$id = $_GET['id'];
// $io = $_GET['stats'];
$emp_query = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname, ' ',midname) as name,projects.io as stats from projects left join project_team on projects.tid = project_team.tid left join employee on project_team.eid = employee.eid where project_id= '$id'");
$row= mysqli_fetch_assoc($emp_query);

 ?>
</div>

<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
	<div class="col-md-3">
	<center><img src="../images/<?php echo $row['site_pic'] ?>" width="200px" height="230px"></center>
	<center><a  href="#change_pic2" data-toggle="modal">Change Picture</a></center>
	</div>
	<div class="col-md-9">
	<div class="row form-group">
		<label class="control-label" style="font-size:20px !important">Project Name:</label>
		<label class="control-label" style="font-size:20px !important"><?php echo $row['project'] ?></label>
	</div>
	<hr>
	<div class="col-md-6">
	<div class="row form-group">
		<label class="control-label">Start Date:</label>
		<label class="control-label"><?php echo date("F d, Y",strtotime($row['start_date'])) ?></label>
	</div>
	<div class="row form-group">
		<label class="control-label">Deadline:</label>
		<label class="control-label"><?php echo date("F d, Y",strtotime($row['deadline'])) ?></label>
	</div>
	<div class="row form-group">
		<label class="control-label">Location:</label>
		<label class="control-label"><?php echo $row['location'] ?></label>
	</div>

	<div class="row form-group">
		<label class="control-label">Project Cost:</label>
		<label class="control-label"><?php echo  $row['overall_cost'] . ' Php.' ?></label>
	</div>
	
	<div class="row form-group">
		<label class="control-label">Foreman:</label>
		<label class="control-label"><?php echo $row['name'] ?></label>
	</div>
	</div>
	<div class="col-md-6">
	<div class="row form-group">
		<label class="control-label">Project type:</label>
		<label class="control-label">
		<?php 
		if($row['proposed_project'] == '1'){
			echo 'Building';
		}if($row['proposed_project'] == '2'){
			echo 'House';
		}elseif($row['proposed_project'] == '3'){
			echo 'Highways';
		}	
		 ?></label>
		
	</div>

	<?php if(!isset($_GET['dattyp'])){ ?>


		<div class="row form-group">
		<label class="control-label">Project Status:</label>
		<label class="control-label"><?php  if( $row['stats'] == '1'){ echo 'On going';}elseif( $row['stats'] == '2'){ echo 'Finished'; }elseif( $row['stats'] == '3'){ echo 'Canceled'; } ?></label>
	</div>
	<?php } ?>
		<div class="row form-group">
		<label class="control-label">Project Divsions:</label>
		
		<?php 
			$sql = mysqli_query($conn,"SELECT * from project_partition natural join project_division where project_id = '$id' order by division ");
			$i= 0;
			while($row2 = mysqli_fetch_assoc($sql)){
		 ?>
		<i style="text-transform:capitalize"><?php echo ($i > 0 ? ",":"").$row2['division']; ?></i>
		<?php $i++; } ?>
		
	</div>
</div>
		<div class="row form-group">
			<div class="col-sm-12 text-left">
			<?php include 'progress_chart.php' ?>
			</div>
			
		</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="col-md-8 col-md-offset-4">
<?php if(isset($_GET['dattyp'])){ ?>
	<a href="index.php?page=project_list&io=1" class="btn btn-sm btn-info"> DONE </a>
	<a href="cancel_proj.php?id=<?php echo $id ?>" class="btn btn-sm btn-info"> Cancel </a>
	<?php }else{ ?>
	<a href="#update_proj" data-toggle="modal" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit </a>
	<a href="index.php?page=project_list&io=1" class="btn btn-sm btn-info"><i class="fa fa-"></i> Back </a>
	<?php } ?>
	<a href="index.php?page=update_progress&id=<?php echo $_GET['id'] ?>" class="btn btn-sm btn-info"><i class="fa fa-chart"></i> Update Progress </a>

</div>
</div>
<?php include '../includes/update_modals.php' ?>
 <div id="retCode1">
 <script>
	jQuery(document).ready(function(){
						jQuery("#proj_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								
								$.ajax({
									type: "POST",
									url: "../forms/update_forms.php?action=project",
									data: formData,
									success: function(html){
										$('#retCode1').html(html);
									 
									}
								});
									return false;
						});
						});
</script>