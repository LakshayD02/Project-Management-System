<!-- New Employee Modal -->
<div id="new_employee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> New Employee
                     </h4> 
                 
                  </div> 
                       <form method="POST" id='emp_form'  > 
 <div class="modal-body">

   
    <div class="form-horizontal">
        
        <div class="form-group" id="form-login">
            <div class="col-sm-12">
             <div id="retCode2">
               <div class="alert alert-success" id="suc_msg">
               <h4><i class="fa fa-check"></i> Data successfully added.</h4>
             </div>
             <div class="alert alert-danger" id="err_msg">
               <h4><i class="fa fa-times"></i> Data failed to add.</h4>
             </div>
             </div>
             </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Last Name:</label>
          <div class="col-sm-8">
            <input class="form-control" style="text-transform:capitalize" id="" name="lname" type="text"  required>
          </div>
        </div>
   
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">First Name:</label>
          <div class="col-sm-8">
            <input class="form-control" style="text-transform:capitalize" id="" name="fname" type="text"  required>
          </div>
        </div> 

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Middle Name:</label>
          <div class="col-sm-8">
            <input class="form-control" style="text-transform:capitalize" id="" name="mname" type="text" >
          </div>
        </div>

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Birthday:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="bday" type="date"  required>
          </div>
        </div>

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Gender:</label>
          <div class="col-sm-4">
            <select class="form-control"  name="gender" type="text"  required>
            <option></option>
            <option>Female</option>
            <option>Male</option>
            </select>
          </div>
        </div>

        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Address:</label>
          <div class="col-sm-8">
            <textarea class="form-control" rows="2"  id="" name="address" type="text"  required></textarea> 
          </div>
        </div>
        
        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Contact no.:</label>
          <div class="col-sm-5">
            <input class="form-control text-right"  id="" name="cn" type="text" maxlength="11"  required>
          </div>
        </div>

        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Status:</label>
          <div class="col-sm-8">
            <select class="form-control"  id="" name="status" type="text"  required>
            <option></option>
            <option>Single</option>
            <option>Married</option>
            <option>Widow</option>
            </select>
          </div>
        </div>

        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Position:</label>
          <div class="col-sm-8">
            <select class="form-control"  id="" name="position" type="text"  required>
            <option></option>
            <?php
            include '../includes/db.php';
              $pos_query = mysqli_query($conn,"SELECT * FROM position order by position ASC");
              while($pos_row = mysqli_fetch_assoc($pos_query)){
             ?>
            <option style="text-transform:capitalize" value="<?php echo $pos_row['pid'] ?>"><?php echo $pos_row['position'] ?></option>
            <?php } ?>
            </select>
          </div>
        </div>

       
    
    </div>
   </div>
          <div class="modal-footer">
               <button type="submit" class="btn btn-info btn-sm" id="btn_sub">Save</button>
                <button data-dismiss="modal" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-close"></i>Close</button>
            </form>
                     </div>
                     </div> 
            </div>
          </div>

<!-- New Project Modal -->
<div id="new_project" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> New Project
                     </h4> 
                 
                  </div> 
                       <form method="POST" id='proj_form'  > 
 <div class="modal-body">

   
    <div class="form-horizontal">
        
        <div class="form-group" id="form-login">
            <div class="col-sm-12">
             <div id="retCode2">
               <div class="alert alert-success" id="suc_msg2">
               <h4><i class="fa fa-check"></i> Data successfully added.</h4>
             </div>
             <div class="alert alert-danger" id="err_msg2">
               <h4><i class="fa fa-times"></i> Data failed to add.</h4>
             </div>
             </div>
             </div>
        </div>
         <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Proposed Project:</label>
          <div class="col-sm-8">
           <select type="text" class="form-control input-sm" style="text-transform:capitalize" autocomplete="off" name="p_type" id="p_type" onchange="div_field()" required/>
          <option id="p_typ"></option>
          <option value="1">Building</option>
          <option value="2">House</option>
          <option value="3">Highways</option>
          <option value="4">Grand Stand</option>
          <option value="5">Covered Court</option>
          </select>
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Project Name:</label>
          <div class="col-sm-8">
            <input class="form-control" style="text-transform:capitalize" id="" name="pname" type="text"  required>
          </div>
        </div>
   
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Location:</label>
          <div class="col-sm-8">
            <textarea class="form-control" style="text-transform:capitalize" id="" name="location" type="text"  required></textarea>
          </div>
        </div> 

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Cost:</label>
          <div class="col-sm-6">
            <input class="form-control" style="text-align:right" id="cc" name="cost" type="text" placeholder="Php.">
          </div>
        </div>

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Starting Date:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="sdate" type="date"  required>
          </div>
        </div>

         <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Deadline:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="deadline" type="date"  required>
          </div>
        </div>

        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Foreman:</label>
          <div class="col-sm-8">
            <select class="form-control"  id="tid" name="tid" type="text" onchange="mem_list()"  required>
            <option></option>
            <?php
            include '../includes/db.php';
              $pos_query = mysqli_query($conn,"SELECT *,Concat(lastname,', ',firstname,' ',midname) as name FROM project_team left join employee on project_team.eid = employee.eid where pio='1' order by name ASC");
              while($pos_row = mysqli_fetch_assoc($pos_query)){
             ?>
            <option style="text-transform:capitalize" value="<?php echo $pos_row['tid'] ?>"><?php echo $pos_row['name'] ?></option>
            <?php } ?>
            </select>
          </div>
        </div>

        
            
            <div id="mem-field"></div>
            <div id="div-field"></div>

       
    
    </div>
   </div>
          <div class="modal-footer">
               <button type="submit" class="btn btn-info btn-sm" id="btn_sub"><i class="fa fa-save"></i> Save</button>
                <button data-dismiss="modal" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-close"></i>Close</button>
            </form>
                     </div>
                     </div> 
            </div>
          </div>

<script>
  jQuery(document).ready(function(){
      $('#suc_msg2').hide();
      $('#err_msg2').hide();



});

  function div_field(){
    var id = $('#p_type').val();
    $.ajax({
                  url: "div_field.php?id="+id,
                  success: function(html){
                    $('#div-field').html(html);
                   
                  }
                });

  }
  function mem_list(){
    var id = $('#tid').val();
    $.ajax({
                  url: "mem_list.php?id="+id,
                  success: function(html){
                    $('#mem-field').html(html);
                   
                  }
                });

  }
  
</script>