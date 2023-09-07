
<div class="col-md-12">
	<h4>List of Project Divisions</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-8">
	<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong></strong></h3>
        </div> 
        <div class="panel-body"> 
			
       <table id="position" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-1 text-center"></th>
        <th class="col-md-2 text-center">Divisions</th>
        <th class="col-md-1 text-center">Project type</th>
        <th class="col-md-1 text-center"></th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';
   
      $query=  mysqli_query($conn, "SELECT * FROM project_division order by division");
         $i = 1;
         while($row = mysqli_fetch_assoc($query)) {   
         $id =$row['pd_id']; 
      

    ?>
      <tr>


        <td style="text-transform:capitalize" class="text-center"><?php echo $i++ ?></td>
        <td style="text-transform:capitalize" class="text-center"><?php echo $row['division'] ?><input type="hidden" id="div<?php echo $id ?>" value="<?php echo $row['division'] ?>"></td>
        <td style="text-transform:capitalize" class="text-center"><?php 
        if($row['project_type'] == '1'){
        	echo 'House/Building';
        } elseif($row['project_type'] == '3'){
        	echo 'Highways';
        }elseif($row['project_type'] == '0'){
        	echo 'All';
        }elseif($row['project_type'] == '4'){
        	echo 'Grand Stand';
        }elseif($row['project_type'] == '5'){
        	echo 'Covered Court';
        }
         ?><input type="hidden" id="typ<?php echo $id ?>" value="<?php echo $row['project_type'] ?>"></td>
        <td style="text-transform:capitalize" class="text-center"><center><a onclick="update_div(<?php echo $id ?>)"><i class="fa fa-pencil"></i> edit</a></center></td>
       </tr>
       
      <?php } ?>
    </tbody>
  </table>
		</div>
	</div>
</div>

<div class="col-md-4">
	
	<a class="col-sm-12 btn btn-md btn-info" id="add_div" onclick="add_form()"><center><i class="fa fa-plus"></i> Add</center></a>
	<br>
<div id="add_form">
	<h4 id="frm-title">New Division</h4>
	<hr style="border-bottom:1px solid grey"></hr>

	<form method="POST" id="pos_form">
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="pos">Division:</label></div>
				<div class="col-sm-7">
					<input type="text" class="form-control input-sm" style="text-transform:capitalize" autocomplete="off" name="division" id="pos" required/>
				</div>
			</div><div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="pos">Project Type:</label></div>
				<div class="col-sm-7">
					<select type="text" class="form-control input-sm" style="text-transform:capitalize" autocomplete="off" name="p_type" id="pos" required/>
					<option id="p_typ"></option>
					<option value="1">House/Building</option>
					<option value="3">Highways</option>
					<option value="4">Grand Stand</option>
					<option value="5">Covered Court</option>
					</select>
				</div>
			</div>
		</div>	
		<input type="hidden" name="id" id="id">
		<hr style="border-bottom:1px solid grey"></hr>

		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-12">
					<center>
					<button class="col-sm-4 btn btn-info btn-sm" id="save_pos">Save</button>
					<div class="col-sm-4"></div> 
					<a class="col-sm-4 btn btn-info btn-sm" onclick="can_pos()">Cancel</a> 
					</center>
				</div>
			</div>
		</div>
		<hr style="border-bottom:1px solid grey"></hr>

	</form>

</div>
</div>
<div id="retCode1"></div>
<script>
	jQuery(document).ready(function(){
						jQuery("#pos_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								var id = $('#id').val();
								if(id == ''){
									var action = '../forms/add_forms.php?action=division' ;
								}else{
									var action = '../forms/update_forms.php?action=division' ;
								}
								$.ajax({
									type: "POST",
									url: action,
									data: formData,
									success: function(html){
										$('#retCode1').html(html);
									var delay = 1500;
										setTimeout(function(){	window.location = 'index.php?page=division';   }, delay);  
									
									}
								});
									return false;
						});
						});
</script>
<script>
	$(document).ready(function(){
		$('#add_form').hide();
	})
	function add_form(){
		$('#add_div').hide();
		$('#add_form').show('SlideDown');
	}
	function can_pos(){
		$('#add_form').hide('slideUp');
		$('#add_div').show('SlideDown');
		$('#pos').val('');
		$('#id').val('');
		$('#p_typ').val('');
		$('#p_typ').html('');

	}
	function update_div(i){
		var div = $('#div'+i).val();
		var typ = $('#typ'+i).val();
		$('#pos').val(div);
		$('#p_typ').val(typ);
		if(typ == '1'){
			$('#p_typ').html('House/Building');
		}else if(typ == '2'){
			$('#p_typ').html('Highways');
		}else if(typ == '3'){
			$('#p_typ').html('All');
		}
		$('#id').val(i);
		$('#frm-title').html('Update Division.')
		$('#add_div').hide();
		$('#add_form').show('SlideDown');


	}
</script>


<script type="text/javascript">
        $(function() {
            $("#position").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
        });
    </script>