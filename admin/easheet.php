
<?php $status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["ecl"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["ecl"]["delete"]) ) {
 $status = TRUE;
}
if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}

if(isset($_POST['genesheet'])){
 $sec = $_POST["session"];
$depm = $_POST["dept1"];
$coursed = $_POST["cos"];$clevel = $_POST["level"]; $sem =  $_POST["semester"];
$result_pinr=mysqli_query($condb,"SELECT * FROM coursereg_tb  WHERE  dept = '".safee($condb,$depm)."' AND c_code ='".safee($condb,$coursed)."' AND level ='".safee($condb,$clevel)."' AND semester ='".safee($condb,$sem)."' AND session = '".safee($condb,$sec)."'");
$num_pinr = mysqli_num_rows($result_pinr);
if ($num_pinr < 1){ 
message("ERROR: No information found for the selected Record .".getdeptc($depm), "error");
		       redirect('Result_am.php?view=asheet');
}else{
	redirect('examasheet.php?dep='.($depm).'&sec='.($sec).'&cos='.($coursed).'&lev='.$clevel.'&sem='.$sem);
			}}
  ?>
  
<div class="x_panel">
<div class="x_content">
                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
<!-- <form name='frmResult' method="post" onsubmit='return checkUpload(this);' class="form-horizontal"  action="Result_am.php?view=v_re" enctype="multipart/form-data"> --!>
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      <input type='hidden' name="userid" value="<?php echo $session_id ; ?>" >
                      <span class="section">Examination Attendance Sheet</span>

<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Select Appropriate information to Generate Exam Attendance Sheet . 
                  </div>
                  
                  	  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
<label for="heard"><?php echo $SCategory; ?> </label>
<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
	else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?></select></div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
<label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select></div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                      <label for="heard">Course Code</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Courses</option>
                          </select></div>
                          
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
<label for="heard">Academic Session</label>
                            <select name="session" id="session"  required="required" class="form-control">
  <option value="">Select Session</option>
<?php echo fill_sec(); ?></select></div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Semester</label>
                            	  	 <select class="form-control" name="semester" id="semester"  required="required">
<option>Select Semester</option>
<option value="First">First</option>
<option value="Second">Second</option></select>
                      </div>
                      
                      	   <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="level" id="level"  required="required">
<option>Select Level</option>
<?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	} ?>
 </select></div>
                    
 <div class="form-group"> <div class="col-md-6 col-md-offset-3"></div></div>
                      <div class="form-group"><div class="col-md-6 col-md-offset-3"></div>  </div>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                          <?php   if (authorize($_SESSION["access3"]["rMan"]["ecl"]["view"])){ ?> 
<button type="submit" name="genesheet"  id="save" data-placement="right" class="btn btn-primary" title="Click To Click to Generate Student Attendance Sheet" ><i class="fa fa-th icon-large"></i> Generate Exam Attendance Sheet</button>

                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');$('#save2').tooltip('show');
	                                            $('#save').tooltip('hide');$('#save2').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
	                                            
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  