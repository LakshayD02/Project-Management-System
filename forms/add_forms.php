<?php include '../includes/db.php' ?>

<?php 
$action = $_GET['action'];

if($action == 'user'){

	$eid = $_POST['eid'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$u_type = $_POST['u_type'];

	
	if($query = mysqli_query($conn,"INSERT INTO users (eid,username,password,user_type,io)VALUES('$eid','$user','$pass','$u_type','1')")){
		echo '<script>$("#msg").show("SlideDown");</script>';
	}else{
		echo "<script>alert('Saving data failed!.')</script>";
	}
}

if($action == 'position'){

	$pos = $_POST['position'];
	$dr = $_POST['dr'];

	
	if($query = mysqli_query($conn,"INSERT INTO position (position,daily_rate)VALUES('$pos','$dr')")){
		include '../includes/msg_box.php';
	}else{
		echo "<script>alert('Saving data failed!.')</script>";
	}
}

if($action == 'attendance'){

	foreach($_GET as $var=>$value)
		$$var =$value;
	if($task == 'in'){
		$query = mysqli_query($conn,"INSERT INTO attendance (eid,time_in,date_today) VALUES('$id',now(),'$d') ");
	}
	if($task == 'del'){
		$query = mysqli_query($conn,"DELETE from attendance where eid ='$id' and date_today = '$d' ");
	}
	if($task == 'out'){
		$query2 = mysqli_query($conn,"UPDATE attendance set time_out = now() where eid ='$id' and date_today = '$d' ");
	}
	if($task == 'out'){
		$query2 = mysqli_query($conn,"UPDATE attendance set time_out = '' where eid ='$id' and date_today = '$d' ");
	}

	
	if($query){
		
		echo '<script>
		window.location.reload();
		</script>';
	}else{
		echo "<script>alert('Saving data failed!.')</script>";
		echo '<script>
		window.location.reload();
		</script>';
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

if($action == 'division'){

	$division = $_POST['division'];
	$p_type =  $_POST['p_type'];

	
	if($query = mysqli_query($conn,"INSERT INTO project_division (division,project_type)VALUES('$division','$p_type')")){
		include '../includes/msg_box.php';
	}else{
		echo "<script>alert('Saving data failed!.')</script>";
	}
}

if($action == 'employee'){
	$fname =$_POST['fname'];
	$lname =$_POST['lname'];
	$mname =$_POST['mname'];
	$address =$_POST['address'];
	$gender =$_POST['gender'];
	$bday =$_POST['bday'];
	$cn =$_POST['cn'];
	$position =$_POST['position'];
	$status =$_POST['status'];

	
		$file = "no_image.jpg";
		$e_query = mysqli_query($conn,"SELECT * FROM employee order by eid DESC limit 1");
	$e_row = mysqli_fetch_assoc($e_query);
	if($e_row > 0 && $e_row['ecode'] != ''){
		$ecode = $e_row['ecode']+'1';
	}else { $ecode = '1001';}

	$query = mysqli_query($conn,"INSERT INTO employee (lastname,firstname,midname,bday,contact_no,address,pid,status,gender,ecode,e_pic,io,date_added)
		VALUES('$lname','$fname','$mname','$bday','$cn','$address','$position','$status','$gender','$ecode','$file','1',NOW())");
	$last_id = mysqli_insert_id($conn);
	if($query){
		echo '<script>$("#suc_msg").show("slidedown");
		 var delay = 1500;
                    setTimeout(function(){  window.location = "index.php?page=employee_profile&id='. $last_id.'&dattyp=new";   }, delay);
		</script>';
	}else{
		echo '<script>$("#err_msg").show("slidedown");</script>';
		
	}
}
if($action == 'project'){
	$pname =$_POST['pname'];
	$location =$_POST['location'];
	$cost =$_POST['cost'];
	$deadline =$_POST['deadline'];
	$sdate =$_POST['sdate'];
	$tid =$_POST['tid'];
	$p_type =$_POST['p_type'];
	$file = "no_image.jpg";
		
	$query = mysqli_query($conn,"INSERT INTO projects (project,location,overall_cost,start_date,deadline,site_pic,tid,date_added,io,proposed_project)
		VALUES('$pname','$location','$cost','$sdate','$deadline','$file','$tid',now(),'1','$p_type')");
	$last_id = mysqli_insert_id($conn);
	if(isset($_POST['divs'])){

	$divs= $_POST['divs'];
	$cd = count($divs);
	for($i=0; $i < $cd; $i++){
		$query2 = mysqli_query($conn,"INSERT INTO project_partition (project_id,pd_id)
		VALUES('$last_id','$divs[$i]')");
	}
	}
	if($query && $query2){
		echo '<script>$("#suc_msg2").show("slidedown");
		var delay = 1500;
                    setTimeout(function(){  window.location = "index.php?page=project_detail&id='. $last_id.'&dattyp=new";   }, delay);
		</script>';
	}else{
		echo $query;
		
	}
}
if($action == 'team'){
	$fid = $_POST['fid'];

	$q1 = mysqli_query($conn,"INSERT INTO project_team (eid,date_added,pio) VALUES('$fid',now(),'1')");
	$id = mysqli_insert_id($conn);
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
if($action =='progress'){
	foreach ($_POST as $var => $value)
		$$var = $value;
	$rd2 = mt_rand(1000, 9999);
			$filename = basename($_FILES['image']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$file = $rd2. "_" .$filename;
			(move_uploaded_file($_FILES['image']['tmp_name'],'../images/'.$file));
}
	$query= mysqli_query($conn,"INSERT INTO project_progress (pp_id,progress,date_added,partition_img)values('$div','$prog',now(),'$file') ");
	if($query){
		echo "<script>location.replace(document.referrer);</script>";
	}
 ?>


 