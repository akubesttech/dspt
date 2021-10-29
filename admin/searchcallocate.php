<?php
   if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');}
			   	$status = FALSE;
if ( authorize($_SESSION["access3"]["sMan"]["acos"]["create"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["edit"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["view"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
			    ?>

	                <form method="get" class="form-horizontal"  action="" enctype="multipart/form-data">
  
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to search for more course allocation Record(s). 
                  </div>
   
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
                            
                          
                          </select>
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1_find' id="dept1" required="required" class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Academic Session</label>
<select name="session2" id="session2"  required="required" class="form-control">
  <option value="">Select Session</option> <?php echo fill_sec(); ?>
</select></div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard">Level</label>
<select class="form-control" name="los" id="los"  >
<option value="">Select Level</option> <?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}?> </select> </div>
                    <!--   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Application Date</label>
                            	    <input  type="text" name="dop" size="18" style="height:32px;"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly"> </div> --!>
                      
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">	<?php   if (authorize($_SESSION["access3"]["adm"]["sar"]["create"])){ ?>
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Search Record " ><i class="fa fa-cloud"></i> Search Record</button><?php } ?>
                         <a href="#" onclick="window.open('allot_Courses.php','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
                        	
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                    
                    </form>
                
                  