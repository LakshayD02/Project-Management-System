<div class="col-md-12">
<h4>Project Progress</h4>
<div class="col-md-5 col-md-offset-3">
<div class="input-group">
<span class="input-group-addon"> <i class="fa fa-search " aria-hidden="true"></i></span>
  <input type="text" class="form-control input-md" id="search" onkeydown="search_query()" onkeyup="search_query()"   placeholder="Search.." />
 </div>
</div><br>
<hr style="border-bottom:1px solid grey"></hr>
</div>
<style>
	.control-label {
		text-transform:capitalize;
	}


</style>
<?php
include '../includes/db.php';
?>
</div>
<div class="col-md-12">
<div id="prog_body">
<?php 
 $sql = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname, ' ',midname) as name from projects left join project_team on projects.tid = project_team.tid left join employee on project_team.eid = employee.eid  order by deadline ASC");
 while($proj = mysqli_fetch_assoc($sql)){
 	$id= $proj['project_id'];
?>
	<div class="panel panel-deafault">
		<div class="panel panel-body">
			<div class="col-sm-4">
				<center><img src="../images/<?php echo $proj['site_pic'] ?>" width="width="200px" height="230px"" alt=""></center><br>
				<center><h4><b><?php echo $proj['project'] ?></b></h4></center>
			</div>
			<div class="col-sm-8"> <?php include 'progress_chart.php'; ?> </div><br>
			<div class="col-sm-12 col-sm-offset-11"><a href="index.php?page=update_progress&id=<?php echo $id ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Update</a></div>

		</div>
	</div>

<?php } ?>
</div>
</div>


<?php include '../includes/update_modals.php' ?>
 <div id="retCode1"></div>
 <script>
	jQuery(document).ready(function(){
						jQuery("#proj_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								
								$.ajax({
									type: "POST",
									url: "../forms/update_forms.php?action=project",
									data: formData,
									success: function(html){
										$('#retCode1').html(html);
									 
									}
								});
									return false;
						});
						});
	function search_query(){
		var name = $('#search').val();
		$.ajax({
			url:"prog_search.php?name="+name,
			before:function(){
				$('#prog_body').html("Please Wait......");
			},
			success:function (html){
				$('#prog_body').html(html);

			}
		});
	}
</script>