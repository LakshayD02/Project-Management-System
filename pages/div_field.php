
<div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Divisions:</label>
          <div class="col-sm-8">

<?php
include '../includes/db.php';
$id = $_GET['id'];
if($id == '1' || $id == '2'){
	$typ = '1';
}else{
	$typ = '2';
}
$query = mysqli_query($conn,"SELECT * from project_division where project_type = '$typ' or project_type = '3' order by division ");
while($row = mysqli_fetch_assoc($query)){
?>
	<input type="checkbox" name="divs[]" value='<?php echo $row['pd_id'] ?>' id="div<?php echo $row['pd_id'] ?>" checked/>
	<label style="text-transform:capitalize" for="div<?php echo $row['pd_id'] ?>"><?php echo $row['division'] ?></label><br>
<?php
}
?>
 </div>
        </div>