<?php
   if($class_ID > 0){}else{
                  message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('new_apply.php?view=spro');
						}?>
<script type="text/javascript">


function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

</script>
<script language="javascript" type="text/javascript">
function checkUpload()
{var a=document.frmResult.fileName.value;
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
	}}	
	
</script>
<div class="x_panel">
                
             
                <div class="x_content">
	                <form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="new_apply.php?view=v_r" enctype="multipart/form-data">
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Import Entrance Exam Result (s)<?php 
//if($resi == 1){echo "<center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
Note: That you will use The downloaded Excel template for entry of student  Entrance Exam scores and The Excel file will be in .xls and not .csv Formate.
                  </div>
   
					    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
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
                     
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" required="required" class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php echo fill_sec(); ?>
</select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Course Choice Type</label>
                            	  <select name='c_choice' id="c_choice" required="required" class="form-control"  >
                           <option value=''>Select Choice</option>
                           <option value='1'>First Choice</option>
                           <option value='2'>Second Choice</option>
                          </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Select Excel File To Upload </label>
    <input name="fileName" class="input-file uniform_on" id="fileInput" type="file" readonly="readonly" accept="application/vnd.ms-excel" ></div>
                     <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click To Export Student Detail for Result Processing" ><i class="fa fa-download"></i> Import Result</button>
                        
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
                  