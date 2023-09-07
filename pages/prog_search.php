<?php 

include '../includes/db.php';

$pname= $_GET['name'];
if($pname == ''){
	$sql = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname, ' ',midname) as name from projects left join project_team on projects.tid = project_team.tid left join employee on project_team.eid = employee.eid order by deadline ASC");;
}else{
	$sql =mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname, ' ',midname) as name from projects left join project_team on projects.tid = project_team.tid left join employee on project_team.eid = employee.eid where  project like '%".$pname."%' order by deadline ASC");

	
}
 if(mysqli_num_rows($sql) > 0){ 
 while($proj = mysqli_fetch_assoc($sql)){
 	$id= $proj['project_id'];
?>
	<div class="panel panel-deafault">
		<div class="panel panel-body">
			<div class="col-sm-4">
				<center><img src="../images/<?php echo $proj['site_pic'] ?>" width="width="200px" height="230px"" alt=""></center><br>
				<center><h4><b><?php echo $proj['project'] ?></b></h4></center>
			</div>
			<div class="col-sm-8"> <?php include 'progress_chart.php'; ?> </div><br>
			<div class="col-sm-12 col-sm-offset-11"><a href="index.php?page=update_progress&id=<?php echo $id ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Update</a></div>

		</div>
	</div>

<?php }}else{?>
	<div class="panel panel-deafault">
		<div class="panel panel-body">
			<div class="col-sm-12">
			
				<center><h4><b>No result ..</b></h4></center>
			</div>
			
		</div>
	</div>
	<?php }  ?>