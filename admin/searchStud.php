<?php
	$status = FALSE;
if ( authorize($_SESSION["access3"]["stMan"]["ves"]["create"]) || 
authorize($_SESSION["access3"]["stMan"]["ves"]["edit"]) || 
authorize($_SESSION["access3"]["stMan"]["ves"]["view"]) || 
authorize($_SESSION["access3"]["stMan"]["ves"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
<script type="text/javascript">

</script>





<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="get" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <?php	$current_url20 = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>
                       <input type="hidden" name="return_urlx" value="<?php echo $current_url20; ?>" />
                      <span class="section">Search  Record</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to search Student Records. 
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
        <!--        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       <label for="heard">Mode of Entry</label>
                      <select class="form-control"   name="moe2" id="moe">
  <option value="">Select Entry Mode</option>
   <option value="01">UTME</option>
    <option value="02">Pre_Science</option>
   <option value="03">Direct Entry</option>
   <option value="04">Undergraguate(Cep)</option>
  </select>
                      </div> --!>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="los" id="los" >
<option value="">Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}?></select> </div>
                     
                    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3"><?php   if (authorize($_SESSION["access3"]["stMan"]["ves"]["view"])){ ?> 
                         <button type="submit" name="Search"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Search Student Records " ><i class="fa fa-cloud"></i> Search Record</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script><?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  