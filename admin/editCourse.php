
<script type="text/javascript">   
$(document).ready(function() {   
$('#level').change(function(){   
if($('#level').val() === 'Others')   
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

if(isset($_POST['Addcourse'])){
$Ctitle= ucfirst($_POST['Ctitle']);
$Ccode = ucfirst(trim($_POST['Ccode']));
$Cunit = $_POST['Cunit'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$other2 = $_POST['otherl'];
$dept_c = $_POST['dept1'];
$facadd = $_POST['fac1'];
$coursecat = $_POST['ccat'];
$amax = $_POST['assmax']; $amax2 = $_POST['assmax2']; $exmax = $_POST['exammax'];
$sump = $amax + $amax2 + $exmax;
$query = mysqli_query($condb,"select * from courses where C_code = '".safee($condb,$Ccode)."' and dept_c = '".safee($condb,$dept_c)."'")or die(mysqli_error($condb));
$row_course = mysqli_num_rows($query);
//$query_CO = mysqli_query($condb,"select * from courses where  C_title = '$Ctitle'")or die(mysqli_error($condb));
//$row_course_CO = mysqli_num_rows($query_CO);
if ($row_course>1){
 message("The Course Code <strong>'$Ccode'</strong>  Entered  Already Exist in $dept_c Dept Try Again.", "error");
		        redirect('add_Courses.php?view=editc&id='.$get_RegNo);
}elseif($sump!= 100){
message("The sum of the Score inputs must be equal to 100", "error");
		         redirect('add_Courses.php?view=editc&id='.$get_RegNo);
				}elseif(!ctype_digit($Cunit)){
				 message("Incorrect Input it should be a Digit.", "error");
		        redirect('add_Courses.php?view=editc&id='.$get_RegNo);
}else{
if($level=="Others"){
mysqli_query($condb,"update courses set dept_c = '$dept_c' ,C_title ='$Ctitle' ,C_code = '$Ccode',C_unit ='$Cunit' ,semester ='$semester' ,C_level = '$other2',fac_id='$facadd',c_cat ='".safee($condb,$coursecat)."',assmax ='".safee($condb,$amax)."',assmax2 = '".safee($condb,$amax2)."',exammax = '".safee($condb,$exmax)."' where  C_id='$get_RegNo'") or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Updated')")or die(mysqli_error($condb)); 
 ob_start();
  message("$Ctitle has Updated successfully!", "success");
		        redirect('add_Courses.php?view=addc');
}else{
mysqli_query($condb,"update courses set dept_c = '$dept_c' ,C_title ='$Ctitle' ,C_code = '$Ccode',C_unit ='$Cunit' ,semester ='$semester' ,C_level = '$level',fac_id='$facadd',c_cat ='".safee($condb,$coursecat)."',assmax ='".safee($condb,$amax)."',assmax2 = '".safee($condb,$amax2)."',exammax = '".safee($condb,$exmax)."' where  C_id='$get_RegNo'") or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Updated')")or die(mysqli_error($condb));
 message("$Ctitle has Updated successfully!", "success");
		        redirect('add_Courses.php?view=addc');
}

}
}

/*function getfacultyc($get_fac)
{
$query2_hod = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac' ")or die(mysqli_error($condb));
$count_hod = mysqli_fetch_array($query2_hod);
 $nameclass22=$count_hod['fac_name'];
return $nameclass22;
} */
?>
<div class="x_panel">
<div class="x_content">
<?php
$query_e = mysqli_query($condb,"select * from courses where C_id='$get_RegNo'  ")or die(mysqli_error($condb));
								$row_e = mysqli_fetch_array($query_e);  $facultyid = getfacid($row_e['dept_c']);
								?>
                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
                      
                      <span class="section">Edit Course  </span>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
<label for="heard"><?php echo $SCategory; ?> </label>
<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" required="required"  >
                            <option value="<?php echo $facultyid; ?>"><?php echo getfacultyc($facultyid); ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks)){
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
}}
?>
</select>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" class="form-control" required="required" >
                          <option value="<?php echo $row_e['dept_c']; ?>"><?php echo getdeptc($row_e['dept_c']); ?></option>
                          </select>
                      </div>
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Title </label>
                            	  <input type="text" class="form-control " name='Ctitle' id="Ctitle" value="<?php echo $row_e['C_title']; ?>" required="required">
                      </div>
<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Code </label>
                            	  <input type="text" class="form-control " name='Ccode' id="Ccode" value="<?php echo $row_e['C_code']; ?>"   required="required">
                      </div>
                      
                     <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Credit Unit </label>
                            	  <input type="text" class="form-control " name='Cunit' id="Cunit" value="<?php echo $row_e['C_unit']; ?>"  required="required">
                      </div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Semester </label>
<select name='semester' id="semester" class="form-control" required>
                            <option value="<?php echo $row_e['semester']; ?>"><?php echo $row_e['semester']; ?></option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            </select> </div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Level </label>
 <select name='level' id="level" class="form-control" required>
                            <option value="<?php echo $row_e['C_level']; ?>"><?php echo getlevel($row_e['C_level'],$class_ID); ?></option>
 <?php $resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?>
                          
                          </select> </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max CA Score </label>
                      <input type="text" class="form-control " name='assmax' id="assmax" maxlength="2" value="<?php echo $row_e['assmax']; ?>"  placeholder="eg.CA (20%)" onkeypress="return isNumber(event);" required="required"> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Pratical Score (Optional) </label>
                      <input type="text" class="form-control " name='assmax2' id="assmax2" maxlength="2" value="<?php echo $row_e['assmax2']; ?>"  placeholder="eg.Pratical (10%)" onkeypress="return isNumber(event);" > </div>
                        
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Exam Score  </label><input type="text" class="form-control " name='exammax' id="exammax" maxlength="2" value="<?php echo $row_e['exammax']; ?>"  placeholder="eg.Exam (70%)" onkeypress="return isNumber(event);" required="required"> </div>

<div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="heard" >Course Category</label><br><?php $gender= $row_e['c_cat']; ?>
<label class="radio-inline"><input type="radio" name="ccat" value="1" <?php echo ($gender == '1')?"checked":"" ;		?> /> Compulsory
</label><label class="radio-inline"><input type="radio" name="ccat" value="0" <?php echo ($gender == '0')?"checked":"" ;		?> /> Elective
                            </label></div></div>
                  
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
<div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["edit"])){ ?> 
                        <button  name="Addcourse"  id="Addcourse"  class="btn btn-primary col-md-4" title="Click Here to Save Course Details" ><i class="fa fa-sign-in"></i> Save Course</button><?php } ?>
                       <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=ViewCourses';" class="btn btn-primary " title="Click Here View Courses" ><i class="fa fa-eye"></i> View Courses </button>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Addcourse').tooltip('show');
	                                            $('#Addcourse').tooltip('hide');
	                                            });
	                                            </script>
	                                             <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 