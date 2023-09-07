<?php include '../includes/db.php';

$query = mysqli_query($conn,"SELECT eid,concat(lastname,', ',firstname,' ',midname) as name FROM employee where eid = '".$_GET['id']."' ");
$row = mysqli_fetch_assoc($query);
$id = $row['eid'];
$name = $row['name'];

 ?>
 <tr id="m<?php echo $id ?>">
<td>
	<input type="hidden" name="mid[]" value="<?php echo $id ?>">
	<?php echo ucwords($name) ?>
</td>
<td><center><button onclick="rem_mem(<?php echo $id ?>)" type="button"> X </button></center></td></tr>