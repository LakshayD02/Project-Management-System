

			   <section class="content-header">
                    <h1>
						Backup and Restore
                        <small></small>
                    </h1>
					<a href="backup.php?action=backup" class="btn btn-info"><i class="fa fa-download"></i>Backup Database</a>
                </section>
				
  <section class="content">
	<div class="row">
	<div class="col-lg-8">
	    <hr class="hr">
				<div class="panel panel-default">
				
				<div class="panel-body">
						<table class="table table-bordered table-condensed" id="db">
							<thead>
								<tr>
									<th class="col-lg-3">Date</th>
									<th class="col-lg-3">Database</th>
									<th class="col-lg-2">Action</th>
									
								</tr>
							</thead>
							<tbody>
							 <?php

  foreach(glob('databases/*.*') as $file) {
     
   $f = explode(".", $file);
   $f = explode("_", $f[0]);
   $fi = explode("/", $file);


                                              


    ?>
      <tr>
      <input type="hidden" name="id" value="<?php echo $row['db_id'] ?>">
         
        <td><?php if(isset($f[2])==''){}else{echo date("M d, Y | g:m:s A",$f[2]);} ?></td>
        <td><?php echo $fi[1];?></td>
        <td><center><a href="backup.php?action=restore&name=<?php echo $fi[1] ?>" class="btn btn-info" ><i class="fa fa-database" aria-hidden="true"></i> Restore</a></center></td>
      </tr>
     <?php } ?>
							
							</tbody>
						</table>
						
							
				</div>
				</div>

	</div>
	</div>
  </section>	 	
  
  
     <script type="text/javascript">
        $(function() {
            $("#db").dataTable(
				{ "aaSorting": [[ 0, "asc" ]] }
			);
        });
    </script>