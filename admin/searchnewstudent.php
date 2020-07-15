<?php
   if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');}
			   	$status = FALSE;
if ( authorize($_SESSION["access3"]["adm"]["sar"]["create"]) || 
authorize($_SESSION["access3"]["adm"]["sar"]["edit"]) || 
authorize($_SESSION["access3"]["adm"]["sar"]["view"]) || 
authorize($_SESSION["access3"]["adm"]["sar"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
			    ?>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="" enctype="multipart/form-data">
                    
                      
                      <span class="section">Search  Record
</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to search Admission Record(s). 
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
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       <label for="heard">Course Choice Type</label>
                            	  <select name='c_choice' id="c_choice" class="form-control"  >
                           <option value=''>Select Choice</option>
                           <option value='1'>First Choice</option>
                           <option value='2'>Second Choice</option>
                           <option value='3'>All</option>
                          </select>
                      </div>
                    <!--   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Application Date</label>
                            	    <input  type="text" name="dop" size="18" style="height:32px;"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly"> </div> --!>
                      
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">	<?php   if (authorize($_SESSION["access3"]["adm"]["sar"]["create"])){ ?>
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Search Record " ><i class="fa fa-cloud"></i> Search Record</button><?php } ?>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  