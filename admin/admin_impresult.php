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
                       <input type='hidden' name="courseno" id="courseno" value="1" >
                      <span class="section">Import Student Result<?php
                                    ?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
          Note: That you will use The downloaded Excel template for entry of student scores and The Excel file will be in .xls and not .csv Formate. 
                  </div>
                  <?php  if($Rorder !== "10"){    ?>
                  	  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{ if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{ echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}
}?>
 </select>
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name,"1");return false;' class="form-control"  >
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
<?php echo fill_sec(); ?>
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
                    <?php }else{ ?>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Allocated Courses</label>
                            	  	 <select class="form-control" name="cos" id="cos" onchange="showcallot(this.value)" required="required">
<option>Select Courses</option>
<?php $staffmainid = getsusern($admin_username);
$qeryalot = mysqli_query($condb,"SELECT * FROM  course_allottb where assigned ='". safee($condb,$staffmainid) ."'  ORDER BY session DESC");
while($restallot = mysqli_fetch_array($qeryalot))
{echo "<option value='$restallot[course]'>$restallot[course]</option>";	}
?>
 </select></div> 
 <div  id="txtroomno" >
 <input type="hidden" name="session" id="session"   tabindex="1"  class="form-control input-sm" readonly> 
  <input type="hidden" name="semester" id="semester"   tabindex="1"  class="form-control input-sm" readonly> 
   <input type="hidden" name="level" id="level"   tabindex="1"  class="form-control input-sm" readonly>
   <input type="hidden" name="dept1" id="dept1"   tabindex="1"  class="form-control input-sm" readonly> 
 </div >   
     <?php } ?>                
                     
                     <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Select Excel File To Upload</label>
                            
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
                  