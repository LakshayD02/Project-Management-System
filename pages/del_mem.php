<?php
include '../includes/db.php';

$query = mysqli_query($conn,"DELETE FROM team_member where tm_id = '".$_GET['id1']."' ");

if ($query){
	echo "<script> $('#m".$_GET['id2']."').remove(); </script>";
}else{
	echo "WHAT?";
}
?>