<center><h5><b>-- Project Progress --</b></h5></center>
<?php 
		$pp = mysqli_query($conn,"SELECT * FROM project_progress natural join project_division where project_id ='$id' order by division");
		while($p_row = mysqli_fetch_assoc($pp) ){

		 ?>
		 <input type="hidden" name="id[]" value="<?php echo $p_row['pp_id'] ?>">
		 <div class="col-sm-4 text-right">
		 	<label for="<?php echo $p_row['pp_id'] ?>" style="text-transform:capitalize"><?php echo $p_row['division'] ?>:</label>
		 </div>
		 <div class="col-sm-4 ">
		 	<input type="number" style="text-align:center" class="form-control input-sm" name="prog[]" value="<?php echo $p_row['progress'] ?>" id="<?php echo $p_row['pp_id'] ?>">
		 </div>
		 <div class="col-sm-1">
		 	<p>%</p>
		 </div>
		 <br>
		 <br>
	<?php	}  ?>