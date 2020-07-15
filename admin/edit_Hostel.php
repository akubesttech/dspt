
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

if(isset($_POST['edithostel'])){
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
if ($row_hoste>1){
				message("Please This Hostel Name Already Exist In our Database", "error");
		        redirect('add_Hostel.php?view=ehostel&id='.$get_RegNo);
				}elseif($row_hostec>1){
					message("Please This Hostel code  Already Exist In our Database", "error");
		        redirect('add_Hostel.php?view=ehostel&id='.$get_RegNo);
				
		
}else{

mysqli_query($condb,"update hostedb set h_name='".safee($condb,$h_name)."',h_code='".safee($condb,$h_code)."',h_cat='".safee($condb,$h_cat)."',h_status='".safee($condb,$h_status)."',h_desc='".safee($condb,$h_desc)."' where h_code='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Hostel Titled $h_name was Updated')")or die(mysqli_error($condb)); 
 ob_start();
 	message("Hostel [$h_name] was Successfully Updated", "success");
		        redirect('add_Hostel.php');




}
}
?>
<?php

$s=3;
	while($s>0){
	$AppNo .= rand(0,9);

		$s-=1;
	}
	

?>
<div class="x_panel">
                
             
                <div class="x_content">
 <?php
													$hedit_query = mysqli_query($condb,"select * from hostedb where h_code='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
													$editrow_hosted = mysqli_fetch_array($hedit_query);
													$id = $editrow_hosted['h_code'];
													?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Edit Hostel Block  </span>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Hostel Name </label>
                      
                          <input type="text" class="form-control "  name='h_name' id="h_name"  value="<?php echo $editrow_hosted['h_name'] ;?>"  required="required"> </div>
                          
     

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback\">
					  <label for="heard">Hostel Code </label>
                      
                          <input type="text" class="form-control " name="h_code" id="h_code" maxlength="3"  value="<?php echo $editrow_hosted['h_code'] ;?>" onkeypress="return isNumber(event);"   readonly> </div>
                          
                          
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Category</label>
                            	  <select name='h_cat' id="h_cat"  class="form-control" required>
                            <option value="<?php echo $editrow_hosted['h_cat'] ;?>"><?php if($editrow_hosted['h_cat']=='M'){
						echo "Male";
						}else{
					echo "Female";
					} ?></option>
    
                            <option value="M">Male</option>
                             <option value="F">Female</option>
                          
                          </select>
                      </div>
                    
                     
                    
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Status </label>
                            	  <select name='h_status' id="h_status" class="form-control" >
                            <option value="<?php echo $editrow_hosted['h_status'] ;?>"> <?php if($editrow_hosted['h_status']=='1'){
						echo "Availiable";
						}else{
					echo "Not Availiable";
					} ?></option>
                             <option value="1">Availiable</option>
                              <option value="0">Not Availiable</option>
                            
                             </select>
                      </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hostel Description </label>
                            	     <textarea name="h_desc" id="h_desc" class="form-control " style="width:498px;"required="required"><?php echo $editrow_hosted['h_desc'] ;?></textarea></td>
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
                         <?php   if (authorize($_SESSION["access3"]["hMan"]["vroom"]["edit"])){ ?> 
                        <button  name="edithostel"  id="addhostel"  class="btn btn-primary col-md-4" title="Click Here to Edit Hostel Details" ><i class="fa fa-sign-in"></i> Edit Hostel</button>
                      <?php } ?>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addhostel').tooltip('show');
	                                            $('#addhostel').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 