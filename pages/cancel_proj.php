<?php
include '../includes/db.php';

$query= mysqli_query($conn,"DELETE from projects where project_id = '".$_GET['id']."'");
if($query){
	header("location:fggs.php?page=project_list&io=1");
}
?>