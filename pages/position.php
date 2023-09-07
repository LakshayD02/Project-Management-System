
<div class="col-md-12">
	<h4>List of Positions</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-8">
	<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Positions.</strong></h3>
        </div> 
        <div class="panel-body"> 
			
       <table id="position" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-2 text-center">Position</th>
        <th class="col-md-2 text-center">Daily Rate</th>
        <th class="col-md-1 text-center"></th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';
   
      $query=  mysqli_query($conn, "SELECT * FROM position order by position");
         while($row = mysqli_fetch_assoc($query)) {   
         $id =$row['pid']; 


    ?>
      <tr>


        <td style="text-transform:capitalize" class="text-center"><?php echo $row['position'] ?></td>
        <td style="text-transform:capitalize" class="text-center"><?php echo $row['daily_rate'].' Php.' ?></td>
        <td style="text-transform:capitalize" class="text-center"><center><a href="#pos<?php echo $id ?>" data-toggle="modal"><i class="fa fa-pencil"></i> edit</a></center></td>
       </tr>

      <?php
    include '../includes/update_modals.php';
    } ;
      ?>
    </tbody>
  </table>
		</div>
	</div>
</div>

<div class="col-md-4">
	
	<a class="col-sm-12 btn btn-md btn-info" id="add_pos" onclick="add_form()"><center><i class="fa fa-plus"></i> Add</center></a>
	<br>
<div id="add_form">
	<h4>New Position</h4>
	<hr style="border-bottom:1px solid grey"></hr>

	<form method="POST" id="pos_form">
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-2"><label class="control-label" for="pos">Position:</label></div>
				<div class="col-sm-7">
					<input type="text" class="form-control input-sm" style="text-transform:capitalize" autocomplete="off" name="position" id="pos" required/>
				</div>
			</div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="dr">Daily Rate:</label></div>
				<div class="col-sm-5">
					<input type="number" style="text-align:right" class="form-control input-sm" name="dr" id="dr" placeholder="Php." required/>
				</div>
			</div>
		</div>	
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
								$.ajax({
									type: "POST",
									url: "../forms/add_forms.php?action=position",
									data: formData,
									success: function(html){
										$('#retCode1').html(html);
									var delay = 2000;
										setTimeout(function(){	window.location = 'index.php?page=position';   }, delay);  
									
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
		$('#add_pos').hide();
		$('#add_form').show('SlideDown');
	}
	function can_pos(){
		$('#add_form').hide('slideUp');
		$('#add_pos').show('SlideDown');
		$('#pos').val('');
		$('#dr').val('');

	}
</script>


<script type="text/javascript">
        $(function() {
            $("#position").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
        });
    </script>