<?php include '../includes/db.php';
$query = mysqli_query($conn,"SELECT *,concat(lastname,', ',firstname,' ',midname) as name FROM project_team left join employee on project_team.eid = employee.eid where tid = '".$_GET['id']."' ");
$row = mysqli_fetch_assoc($query);
$id = $row['eid'];

 ?>

<div class="panel panel-default">
	<div class="panel-body">
	<form method="POST" id="teams" class="form-horizontal">
	<input type="hidden" name="id" value="<?php echo $row['tid'] ?>">
	<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<div class="col-sm-2"><label for="">Foreman:</label></div>
			<div class="col-sm-10">
			<select name="fid" id="" class="form-control chosen-select" data-placeholder="Select Employee">
			<option value="<?php echo $row['eid'] ?>"><?php echo ucwords($row['name']) ?></option>
				<?php
				$fquery=mysqli_query($conn,"SELECT *,concat(lastname,', ',firstname,' ',midname) as name,employee.eid as id from employee where employee.eid NOT IN (SELECT  project_team.eid from project_team ) or eid not in (SELECT team_member.eid from team_member) ");
				while($frow = mysqli_fetch_assoc($fquery)){
					$ecod = date("Y",strtotime($frow['date_added'])). $frow['ecode'];
					if($id == $frow['id']){ echo '<option value="'.$frow['eid'].'" selected="">'.ucwords($frow['name']).'|'.$ecod.'</option>'; }else{
					echo '<option value="'.$frow['eid'].'">'.ucwords($frow['name']).'|'.$ecod.'</option>';
				}
				}
				?>
			</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2"><label for="">Member:</label></div>
			<div class="col-sm-10">
			<select name="mid" id="mid" class="form-control chosen-select" data-placeholder="Select Employee">
			<option></option>
				<?php
				$mquery=mysqli_query($conn,"SELECT *,concat(lastname,', ',firstname,' ',midname) as name from employee where employee.eid NOT IN (SELECT  project_team.eid from project_team ) or eid not in (SELECT team_member.eid from team_member) ");
				while($mrow = mysqli_fetch_assoc($mquery)){
					$ecodd = date("Y",strtotime($mrow['date_added'])). $mrow['ecode'];
					echo '<option value="'.$mrow['eid'].'">'.ucwords($mrow['name']).'|'.$ecodd.'</option>';
				}
				?>
			</select>
			</div>
		</div>
		<div class="col-sm-12"><a onclick="mem_list()" style="float:right" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></a></div>

	</div>
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-sm-2 text-center">Name</th>
					<th width="1% !important"></th>
				</tr>
			</thead>
			<tbody id="mem">
			<?php

			$query1 = mysqli_query($conn,"SELECT *,concat(lastname,', ',firstname,' ',midname) as name FROM team_member left join employee on team_member.eid = employee.eid where tid = '".$_GET['id']."' ");
			while($row1 = mysqli_fetch_assoc($query1)){
			$id1 = $row1['eid'];
			$id2 = $row1['tm_id'];
			$name = $row1['name'];

			 ?>
			 <tr id="m<?php echo $id1 ?>">
			<td>
				<input type="hidden" name="mid[]" value="<?php echo $id1 ?>">
				<?php echo ucwords($name) ?>
</td>
<td><center><button onclick="del_mem(<?php echo $id2 ?>,<?php echo $id1 ?>)" type="button"> X </button></center></td></tr>
<?php } ?>
			</tbody>
		</table>
	<center>
		<button class="btn-sm btn-info">Save</button>
		<button type="button" onclick="window.location.reload()" class="btn-sm btn-info">Cancel</button>
	</center>
	</div>
	</div>
	</form>
		
	</div>
</div>
<div id="rcode"></div>
<script>
	function mem_list(){
		var id = $('#mid').val();
		$.ajax({
			url:"member.php?id="+id,
			success:function (data){
				$('#mem').append(data);
			}
		});
	}
	function rem_mem(i){
		$('#m'+i).remove();
	}
	function del_mem(i,q){
		$.ajax({
			url:"del_mem.php?id1="+i+"&id2="+q,
			success:function (data){
				$('#rcode').append(data);
			}
		});
	}


	jQuery(document).ready(function(){
						jQuery("#teams").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								
								$.ajax({
									type: "POST",
									url: "../forms/update_forms.php?action=team",
									data: formData,
									success: function(html){
										$('#rcode').html('<center><div class="alert alert-success"><h4 id="msg"><i class="fa fa-fw fa-check"></i>  Data Succesfully Added.</h4><div></center>');
										var delay = 2000;
										setTimeout(function(){	window.location.reload();   }, delay);  
									 
									}
								});
									return false;
						});
						});
</script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
