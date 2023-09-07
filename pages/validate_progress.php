<?php
include '../includes/db.php';
foreach ($_GET as $var => $value) 
	$$var = $value;

 $query = mysqli_query($conn,"SELECT sum(progress) as prog FROM project_progress where pp_id = '$id'");
 $row = mysqli_fetch_assoc($query);
 if(mysqli_num_rows($query) > 0 ){
 	$total = $row['prog'];
 }else{
 	$total = 0;
 }
 if($prog <= 100){
 $left = 100 - $total;
 	if($left < $prog ){
 		
 		echo "<div class='alert alert-danger'>".$left."% of progress left to consider this area as 100%.</div>";
 		echo "<script>$('#btn_save').hide();</script>";
 	
 }}else{
 		echo "<div class='alert alert-danger'>the value exceeds in 100%.</div>";
 		echo "<script>$('#btn_save').hide();</script>";
 }
?>