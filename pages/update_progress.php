<div class="col-md-12"><br>
<hr style="border-bottom:1px solid grey"></hr>
</div>
<style>
	.control-label {
		text-transform:capitalize;
	}


</style>
<?php
include '../includes/db.php';
$id = $_GET['id'];
// $io = $_GET['stats'];
$emp_query = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname, ' ',midname) as name, projects.io as stats from projects left join project_team on projects.tid = project_team.tid left join employee on project_team.eid = employee.eid  where project_id= '$id'");
$row= mysqli_fetch_assoc($emp_query);
 ?>
</div>

<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
	<div class="col-md-4">
	<center><img src="../images/<?php echo $row['site_pic'] ?>" width="200px" height="230px"></center>
	<br>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label" style="font-size:15px !important">Project Name:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label" style="font-size:18px !important"><?php echo $row['project'] ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Start Date:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo date("F d, Y",strtotime($row['start_date'])) ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Deadline:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo date("F d, Y",strtotime($row['deadline'])) ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Location:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['location'] ?></label></div>
	</div>

	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Project Cost:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo  $row['overall_cost'] . ' Php.' ?></label></div>
	</div>
	
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Foreman:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php echo $row['name'] ?></label></div>
	</div>
	<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Project type:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label">
		<?php 
		if($row['proposed_project'] == '1'){
			echo 'Building';
		}if($row['proposed_project'] == '2'){
			echo 'House';
		}elseif($row['proposed_project'] == '3'){
			echo 'Highways';
		}
		elseif($row['proposed_project'] == '4'){
			echo 'Grandstand';
		}elseif($row['proposed_project'] == '5'){
			echo 'Covered Court';
		}	
		 ?></label></div>
		
	</div>
	
		<div class="row">
		<div class="col-sm-4 text-right"><label class="control-label">Project Status:</label></div>
		<div class="col-sm-8 text-left"><label class="control-label"><?php  if($row['stats'] == '1'){ echo 'On going';}elseif($row['stats'] == '2'){ echo 'Finished'; }elseif($row['stats'] == '3'){ echo 'Canceled'; } ?></label></div>
	</div>
	
<br>
<br>
<br>
<center>
	<h4><b>-- New Progress</b></h4>
</center>

	<form action="../forms/add_forms.php?action=progress" method="POST" enctype="multipart/form-data" >
	<div class="row">
		
			<div class="col-sm-4 text-right"><label for="" class="control-label">Division:</label></div>
			<div class="col-sm-8">
				<select name="div" id="div" class="form-control" required/>
					<option value="" selected="" disabled="">SELECT DIVISION</option>
					<?php 
					$div= mysqli_query($conn,"SELECT * FROM project_partition natural join project_division where project_id = '$id' order by division ");
					while($div_row = mysqli_fetch_assoc($div)){
					$test = mysqli_query($conn,"SELECT sum(progress) as prog FROM project_progress where pp_id = '".$div_row['pp_id']."' ");
					$test_row= mysqli_fetch_assoc($test);
					if(mysqli_num_rows($test) > 0){
						$prog = $test_row['prog'];
					}else{
						$prog = 0;
					}
					if($prog < 100 ){ ?>
						<option value="<?php echo $div_row['pp_id'] ?>"><?php echo ucwords($div_row['division']) ?></option>
					<?php }} ?>
				</select>
			</div>
		
	</div>
	<br>
	<div class="row">
		 <input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="col-sm-4 text-right"><label for="" class="control-label">Progress:</label></div>
		<div class="col-sm-7"><input type="text" class="form-control text-right"  max="100" onkeyup="validate_prog()" onkeydown="validate_prog()" name="prog" id="prog" required/></div>
		<div class="col-sm-1 text-left"><label for="" class="control-label">%</label></div>
	</div>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-8" id="validation"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-4 text-right"><label for="" class="control-label">Image:</label></div>
		<div class="col-sm-8"><input type="file" name="image" class="form-control" required/></div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-8 col-sm-offset-4">
			<button id="btn_save" class="btn btn-sm btn-info"><i class="fa fa-save"></i> Save</button>
			<button type="reset" class="btn btn-sm btn-info"><i class="fa fa-reset"></i> Cancel</button>
		</div>
	</div>
	</form>
	</div>
	<br>
	<br>
	<br>
	<div class="col-md-8">
		<div class="row">
		
		
		

		
		<div class="col-sm-12" id="progress2">
			<center><h5><b>-- Project Progress --</b></h5></center>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "construction_pms_db";
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	$prog = $conn->query("SELECT * FROM project_partition natural join project_division where project_id = '$id' ");
    while($progress = $prog ->fetch_assoc()){

    $name = $progress['division'];
    $pid = $progress['pp_id'];
    // $count = $progress[''];

$i= 1;
$prog3 = $conn->query("SELECT SUM(progress) as total_prog FROM project_progress  where pp_id = '$pid' ");
$row_prog = $prog3->fetch_assoc();
	if ($prog && $prog->num_rows > 0)
	{

        if($count <= 50){
            $color='rgba(251, 159, 118, 0.53)';
            }elseif ($count > 50  ) {
              $color='rgba(120, 151, 239, 0.53)';  
            }
			$array[$id][] ='{"progress":'.'"'.$row_prog['total_prog'].'"'.','.'"name":"'. ucfirst($name).'"'.','.'"color":"'. $color.'"}';
        
				
			
		
	}
	else
	{
		 $array[] ='{"progress":"0","name":"0"}';
		
	}}
    $prog2 = $conn->query("SELECT SUM(progress) as total FROM project_progress natural join project_partition where project_id = '$id' ");
    $progress2 = $prog2 ->fetch_assoc();
$total = $progress2['total'] / $prog->num_rows ;
$tots= number_format($total,0);
              $colors='rgba(0, 241, 5, 0.39)';  
            
        $data2 = ',{"progress":'.'"'. $tots.'"'.','.'"name":"Total"'.','.'"color":"'. $colors.'"}';
  



  $data= implode(',',$array[$id]);

$conn->close();

?>
            <div class="chartdiv" id="chartdiv<?php echo $id ?>" style="width:100% ; height:40%;"></div>

<script>
 jQuery(document).ready(function(){
chart.exportConfig = {
    menuItems: [{
        icon: '../am_chart/images/export.png',
        format: 'png',
        onclick: function(a) {
            var output = a.output({
                format: 'png',
                output: 'datastring'
            }, function(data) {
                console.log(data)
            });
        }
    }]
}
}); 

var chart = AmCharts.makeChart("chartdiv<?php echo $id ?>", {
    "type": "serial",
    "theme": "none",
    "pathToImages":"http://localhost/new_admin/am_chart/images/export.png",
    "dataProvider": [<?php echo $data.$data2 ?>],
    "title":"Project Progress",
    "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Progress (%)",
    
    }],

    "startDuration": 1,
    "graphs": [{
        "balloonText": "<b style='text-transform:capitalize'>[[name]]: [[value]]%</b>",
        "colorField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "progress",
        "labelText":"[[progress]]%",
        "labelPosition":"inside",
    }],
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "name",
    "categoryAxis": {
    "text-transform":"capitalize",
        "gridPosition": "start",
        "labelRotation": 50,
        "title":"Divisions"
    },

});


</script>

		</div>
		
		
	</div>
	

<br>


	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-sm-2 text-center"></th>
				<th class="col-sm-2 text-center">Division</th>
				<th class="text-center" style="width:1% !important">Progress</th>
				<th class="col-sm-1 text-center">Date Updated</th>
				<th class="col-sm-1 text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include '../includes/db.php';
			 $query = mysqli_query($conn,"SELECT * FROM project_partition natural join project_progress left join project_division on project_partition.pd_id = project_division.pd_id where project_id = '$id' order by date_added DESC ");
			 if(mysqli_num_rows($query) > 0){
			while($row2 = mysqli_fetch_assoc($query)){
			 ?>
			 <tr>
			 	<td><center><img src="../images/<?php echo $row2['partition_img'] ?>" width="100px" height="100px" ></center></td>
			 	<td><?php echo ucwords($row2['division']) ?></td>
			 	<td><?php echo $row2['progress'].'%'; ?></td>
			 	<td><?php echo date("F d,Y",strtotime($row2['date_added'])) ?></td>
			 	<td><center><a href="#progess<?php echo $row2['prog_id'] ?>" data-toggle="modal"><i class="fa fa-pencil"> </i> Edit</a></center></td>
			 </tr>
			 <?php include '../includes/update_modals.php' ?>
			<?php }}else{ ?>
			
					<tr>
						<td colspan='5'><center>No Data yet.</center></td>
					</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>
</div>


 <script>
	
	
		function validate_prog(){
			var id = $('#div').val();
			var prog = $('#prog').val();

			$.ajax({
				url: "validate_progress.php?id="+id+"&prog="+prog,
				success:function(html){
					$('#validation').html(html);
				}
			});

		}
</script>
