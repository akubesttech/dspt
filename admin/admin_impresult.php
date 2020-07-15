<?php $status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["rup"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["rup"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["rup"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["rup"]["delete"]) ) {
 $status = TRUE;
}
if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
  ?>

<script language="javascript" type="text/javascript">
function checkUpload()
{
	var a=document.frmResult.fileName.value;
	
	//var validExts = new Array(".xlsx", ".xls");
	var validExts = new Array(".xls");
	//var fileExt = sender.value;
    fileExt = a.substring(a.lastIndexOf('.'));
	if(a.length<=0){ alert("You have not selected a valid file for upload. Use the browse button to browse for a valid file and then click 'Import Result'");
		return false;}
		else if(validExts.indexOf(fileExt) < 0){
	
      alert("Invalid file selected, valid files are of " +
               validExts.toString() + " types.");
               return false;
	}
	else{ return true;
	}
}	


</script>

<div class="x_panel">
                
             
                <div class="x_content">
<form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="Result_am.php?view=v_re" enctype="multipart/form-data">
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type='hidden' name="userid" value="<?php echo $session_id ; ?>" >
                      <span class="section">Import Student Result<?php
                                        //  if($resi == 1)
//{

echo $_COOKIE['showerror3'];
//}
?></span>

<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That you will use The downloaded Excel template for entry of student scores and The Excel file will be in .xls and not .csv Formate. 
                  </div>
                  
                  	  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
//$resultfac = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//while($rsfac = mysql_fetch_array($resultfac))
//{  
//if($rsfac['fac_id']==@$cat){echo "<option selected value='$rsfac[fac_id]'>$rsfac[fac_name]</option>"."<BR>";}
//else{echo "<option value='$rsfac[fac_id]'>$rsfac[fac_name]</option>";}
//}

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
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Course Code</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Courses</option>
                          </select>
                      </div>
                      
   
					   
                   
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Semester</label>
                            	  	 <select class="form-control" name="semester" id="semester"  required="required">
<option>Select Semester</option>
<option value="First">First</option>
<option value="Second">Second</option></select>
                      </div>
                      
                      	   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="level" id="level"  required="required">
<option>Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
 </select>
                      </div>
                    
                      
                     
                     
                     <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Select Excel File To Upload </label>
                            
                        <!--  <input name="fileName" class="input-file uniform_on" id="fileInput" type="file" readonly="readonly" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >--!>
        <input name="fileName" class="input-file uniform_on" id="fileInput" type="file" readonly="readonly" accept="application/vnd.ms-excel" >

                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">  <?php   if (authorize($_SESSION["access3"]["rMan"]["rup"]["edit"])){ ?> 
                         <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Import Student Details for Result Processing" ><i class="fa fa-download"></i> Import Result</button>
                        
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
                  