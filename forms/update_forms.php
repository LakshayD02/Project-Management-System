<?php
session_start();
include '../includes/db.php';

$action = $_GET['action'];


if($action == 'user'){

	$uid = $_POST['uid'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$u_type = $_POST['u_type'];
	$status = $_POST['status'];

	
	if($query = mysqli_query($conn,"UPDATE users SET username = '$user',
													password = '$pass',
													user_type = '$u_type',
													io = '$status' where uid = '$uid' ")){
		echo '<div class="alert alert-success" id="msg2"><i class="fa fa-check"></i> Data successfully updated. </div>
	<script>$("#msg2").show("SlideDown");
	</script>';
	}else{
		echo "<script>alert('updating data failed!.')</script>";
	}
}
if($action == 'user2'){
	$uid = $_POST['uid'];
	$query20= mysqli_query($conn,"SELECT * FROM users where uid ='$uid'");
	$row20 = mysqli_fetch_assoc($query20);
	$cpass = $_POST['current'];
	
	$user = $_POST['user'];
	$npass = $_POST['npass'];
	if($cpass == $row20['password']){
	
	if($query = mysqli_query($conn,"UPDATE users SET username = '$user',
													password = '$npass' where uid = '$uid' ")){
		echo '<script>$("#msg20").show("SlideDown");
		$("#msg21").hide();
	 var delay = 2000;
                    setTimeout(function(){  window.location.reload();   }, delay);
	</script>';
	}else{
		echo "<script>alert('updating data failed!.')</script>";
	}}else{
	echo '<script>$("#msg21").show("SlideDown");
	</script>';
	}
}

if($action == 'position'){
	$id= $_POST['id'];
	$pos= $_POST['pos'];
	$dr= $_POST['dr'];
	if(mysqli_query($conn,"UPDATE position SET daily_rate = '$dr' , position = '$pos' where pid = '$id'")){
		echo '<h4 class="alert alert-success"><i class="fa fa-fw fa-check"></i>  Data Succesfully Updated.</h4>';
	}else{
		echo "<script>alert('Updating data failed!.')</script>";
	}
}
if($action == 'division'){

	$id = $_POST['id'];
	$division = $_POST['division'];
	$p_type = $_POST['p_type'];

	
	if($query = mysqli_query($conn,"UPDATE project_division set division = '$division', project_type = '$p_type' where pd_id = '$id'")){
		include '../includes/msg_box.php';
		echo '<script>$("#msg").html("Data successfully updated.")</script>';
	}else{
		echo "<script>alert('Saving data failed!.')</script>";
	}
}
if($action == 'change_pic'){
	$id = $_GET['id'];
			$rd2 = mt_rand(1000, 9999);
			$filename = basename($_FILES['file']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$file = $rd2. "_" .$filename;
			(move_uploaded_file($_FILES['file']['tmp_name'],'../images/'.$file));

	$query = mysqli_query($conn,"UPDATE employee set e_pic = '$file' where eid = '$id'");
	if($query){
		echo '<script> location.replace(document.referrer);</script>';
	}

}if($action == 'change_pic2'){
	$id = $_GET['id'];
			$rd2 = mt_rand(1000, 9999);
			$filename = basename($_FILES['file']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$file = $rd2. "_" .$filename;
			(move_uploaded_file($_FILES['file']['tmp_name'],'../images/'.$file));

	$query = mysqli_query($conn,"UPDATE projects set site_pic = '$file' where project_id = '$id'");
	if($query){
		echo '<script> location.replace(document.referrer);</script>';
	}

}
if($action == 'employee'){
	$id =$_POST['id'];
	$fname =$_POST['fname'];
	$lname =$_POST['lname'];
	$mname =$_POST['mname'];
	$address =$_POST['address'];
	$gender =$_POST['gender'];
	$bday =$_POST['bday'];
	$cn =$_POST['cn'];
	$position =$_POST['position'];
	$status =$_POST['status'];
	$ps =$_POST['ps'];


	$query = mysqli_query($conn,"UPDATE employee SET lastname = '$lname',
													firstname = '$fname',
													midname = '$mname',
													bday = '$bday',
													contact_no = '$cn',
													address = '$address',
													pid = '$position',
													status = '$status',
													gender = '$gender',
													io = '$ps' where eid = '$id' ");
	if($query){
		echo '<script>$("#suc_msg1").show("slidedown");
		 var delay = 1500;
                    setTimeout(function(){  window.location = "index.php?page=employee_profile&id='. $id.'";   }, delay);
		</script>';

	}else{
		echo '<script>$("#err_msg1").show("slidedown");</script>';
		
}
}

if($action == 'project'){
	$id =$_POST['id'];
	$pname =$_POST['pname'];
	$location =$_POST['location'];
	$cost =$_POST['cost'];
	$deadline =$_POST['deadline'];
	$sdate =$_POST['sdate'];
	$tid =$_POST['tid'];
	$p_type =$_POST['p_type'];
	$stats =$_POST['stats'];
		
	$query = mysqli_query($conn,"UPDATE projects SET project = '$pname',
													location = '$location',
													overall_cost = '$cost',
													deadline = '$deadline',
													start_date = '$sdate',
													tid = '$tid',
													io = '$stats',
													proposed_project ='$p_type' where project_id = '$id' ");
	if($query ){
		echo '<script>$("#suc_msg2").show("slidedown");
		var delay = 1500;
                    setTimeout(function(){  window.location = "index.php?page=project_detail&id='. $id.'&stats='.$stats.' ";   }, delay);
		</script>';
	}else{
		echo $query;
		
	}
}
if($action == 'progress'){
	foreach($_POST as $var=>$value)
		$$var = $value;

	$query = mysqli_query($conn,"UPDATE project_progress set pp_id = '$div',progress = '$prog' where prog_id = '$id' ");
	if($query){
		echo '<script>location.replace(document.referrer);</script>';
	}
}
if($action == 'team'){
	$id = $_POST['id'];
	$fid = $_POST['fid'];

	$q1 = mysqli_query($conn,"UPDATE project_team SET eid = $fid where tid = '$id' ");
	if(isset($_POST['mid'])){
		$mid = $_POST['mid'];
		$mc=count($mid);
		for($i = 0 ; $i < $mc;$i++){
			$q2 = mysqli_query($conn,"INSERT INTO team_member (tid,eid) VALUES('$id','$mid[$i]')");
		}
	}
	if($q1){
		echo "true";
	}
}
if($action == 'team_stats'){
	$io = $_GET['io'];
	$id = $_GET['id'];
	$update=mysqli_query($conn,"UPDATE project_team set pio = '$io' where tid='$id' ");
	if($update){
		echo '<script>location.replace(document.referrer);</script>';
	}
}
if($action == 'attendance'){

	foreach($_GET as $var=>$value)
		$$var =$value;
	
	if($task == 'out'){
		$query2 = mysqli_query($conn,"UPDATE attendance set time_out = now() where eid ='$id' and date_today = '$d' ");
	}
	if($task == 'odel'){
		$query2 = mysqli_query($conn,"UPDATE attendance set time_out = '' where eid ='$id' and date_today = '$d' ");
	}

	
	
	if($query2){
		
		echo '<script>
		window.location.reload();
		</script>';
	}else{
		echo "<script>alert('Employee haven't time in yet.')</script>";
		echo '<script>
		window.location.reload();
		</script>';
	}
}
?>

