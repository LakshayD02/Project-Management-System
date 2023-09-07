<?php
	include '../includes/db.php';

	$id= $_GET['id'];

	$query=mysqli_query($conn,"SELECT *,concat(firstname,' ',lastname) as name FROM team_member natural join employee where tid = '$id' ");
	
	?>
	<div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Members:</label>
          <div class="col-sm-8">
          <?php
		while($row = mysqli_fetch_assoc($query)){
			echo '<p>- '.ucwords($row['name']).'</p><br>';
		}
           ?>
		  </div>
