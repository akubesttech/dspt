
<script type="text/javascript">   
$(document).ready(function() {   
$('#pduration').change(function(){   
if($('#pduration').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>

<?php
$status = FALSE;
if ( authorize($_SESSION["access3"]["hMan"]["avh"]["create"]) || 
authorize($_SESSION["access3"]["hMan"]["avh"]["edit"]) || 
authorize($_SESSION["access3"]["hMan"]["avh"]["view"]) || 
authorize($_SESSION["access3"]["hMan"]["avh"]["delete"]) ) {
 $status = TRUE;
}
 if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
if(isset($_POST['addhostel'])){
$h_name = ucfirst(trim($_POST['h_name']));
$h_code = $_POST['h_code'];
$h_cat = $_POST['h_cat'];
$h_status = $_POST['h_status'];
$h_desc = $_POST['h_desc'];
$query_hoste = mysqli_query($condb,"select * from hostedb where h_name = '".safee($condb,$h_name)."'")or die(mysqli_error($condb));
//$row = mysqli_fetch_array($query);
$row_hoste = mysqli_num_rows($query_hoste);
$query_hostec = mysqli_query($condb,"select * from hostedb where h_code = '".safee($condb,$h_code)."'")or die(mysqli_error($condb));
//$row = mysqli_fetch_array($query);
$row_hostec = mysqli_num_rows($query_hostec);
if ($row_hoste>0){
	message("Please This Hostel Name Already Exist In our Database", "error");
		        redirect('add_Hostel.php?view=addH');

				}elseif($row_hostec>0){
					message("Please This Hostel code  Already Exist In our Database", "error");
		        redirect('add_Hostel.php?view=addH');
}else{

mysqli_query($condb,"insert into hostedb (h_name,h_code,h_cat,h_status,h_desc) values('".safee($condb,$h_name)."','".safee($condb,$h_code)."','".safee($condb,$h_cat)."','".safee($condb,$h_status)."','".safee($condb,$h_desc)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Hostel Titled $h_name was Add')")or die(mysqli_error($condb)); 
 ob_start();
 		message("New Hostel [$h_name] was Successfully Added", "success");
		        redirect('add_Hostel.php?view=addH');

}
}
?>
<?php //$s=3; while($s>0){ $AppNo .= rand(0,9); $s-=1;} ?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Hostel Block</span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Hostel Name</label>
                      <input type="text" class="form-control "  name='h_name' id="h_name"  value=""  required="required"> </div>
                          <?php  $tran=mysqli_query($condb,"select max(h_code) from hostedb");
while($tid = mysqli_fetch_array($tran, MYSQLI_BOTH)){
if($tid[0] == null){ $tmax="100";}else{$tmax=$tid[0]+1;}}
echo " <div class=\"col-md-6 col-sm-6 col-xs-12 form-group has-feedback\"> <label for=\"heard\">Hostel Code </label>
<input type=\"text\" class=\"form-control \" name=\"h_code\" id=\"h_code\" maxlength=\"3\"  value=\"$tmax\" onkeypress=\"return isNumber(event);\"   required=\"required\"> </div>
"; ?>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Category</label>
                            	  <select name='h_cat' id="h_cat"  class="form-control" required>
                            <option value="">Select Category</option>
    
                            <option value="M">Male</option>
                             <option value="F">Female</option>
                          
                          </select>
                      </div>
                    
                     
                    
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Status </label>
                            	  <select name='h_status' id="h_status" class="form-control" >
                            <option value="">Select Status</option>
                             <option value="1">Availiable</option>
                              <option value="0">Not Availiable</option>
                            
                             </select>
                      </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Description </label>
                            	     <textarea name="h_desc" id="h_desc" class="form-control " style="width:498px;"required="required"></textarea></td>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                             <?php   if (authorize($_SESSION["access3"]["hMan"]["avh"]["create"])){ ?> 
                        <button  name="addhostel"  id="addhostel"  class="btn btn-primary col-md-4" title="Click Here to Save Hostel Details" ><i class="fa fa-sign-in"></i> Add Hostel</button> <?php } ?>
                            <?php   if (authorize($_SESSION["access3"]["hMan"]["avh"]["view"])){ ?> 
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Hostel.php';" class="btn btn-primary col-md-4" title="Click Here to view Added Hostel details" ><i class="fa fa-eye"></i> View Hostel</button><?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addhostel').tooltip('show');
	                                            $('#addhostel').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 