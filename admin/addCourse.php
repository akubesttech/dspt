
<script type="text/javascript">
/*
var xmlhttp

function loadDept3(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
if(a=='Select Faculty'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_load").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

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
*/
</script>
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
$amax  = 0; $amax2 = 0; $exmax = 0;
if(isset($_POST['Addcourse'])){
$Ctitle= ucfirst($_POST['Ctitle']);
$Ccode = ucfirst(trim($_POST['Ccode']));
$Cunit = $_POST['Cunit'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$other2 =  isset($_POST['otherl']) ? $_POST['otherl'] : '';
$dept_c = $_POST['dept1'];
$facadd = $_POST['fac1'];
$coursecat = $_POST['ccat'];
$amax = $_POST['assmax']; $amax2 = $_POST['assmax2']; $exmax = $_POST['exammax'];
if(empty($amax2)){ $sump = $amax + $exmax;}else{$sump = $amax + $amax2 + $exmax;}
$query = mysqli_query($condb,"select * from courses where C_code = '".safee($condb,$Ccode)."' and dept_c = '".safee($condb,$dept_c)."'")or die(mysqli_error($condb));
$row_course = mysqli_num_rows($query);
//$query_CO = mysqli_query($condb,"select * from courses where  C_title = '".safee($condb,$Ctitle)."'")or die(mysqli_error($condb));
//$row_course_CO = mysqli_num_rows($query_CO);
if ($row_course>0){
message("The Course Code <strong> $Ccode </strong>  Entered  Already Exist in" .getdeptc($dept_c) ."Dept Try Again.", "error");
		        redirect('add_Courses.php?view=addc');
}elseif($sump!= 100){
message("The sum of the Score inputs must be equal to 100", "error");
		        redirect('add_Courses.php?view=addc');
				}elseif(!ctype_digit($Cunit)){
				message("Incorrect Input it should be a Digit.", "error");
		        redirect('add_Courses.php?view=addc');
			}else{
if($level=="Others"){
mysqli_query($condb,"insert into courses (dept_c,C_title,C_code,C_unit,semester,C_level,fac_id,c_cat,assmax,assmax2,exammax) values('$dept_c','$Ctitle','$Ccode','$Cunit','$semester','$other2','".safee($condb,$facadd)."','".$coursecat."','".safee($condb,$amax)."','".safee($condb,$amax2)."','".safee($condb,$exmax)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Add')")or die(mysqli_error($condb)); 
 ob_start();
 message("New Course was Successfully Added", "success");
		        redirect('add_Courses.php?view=addc');

				}else{

mysqli_query($condb,"insert into courses (dept_c,C_title,C_code,C_unit,semester,C_level,fac_id,c_cat,assmax,assmax2,exammax) values('$dept_c','$Ctitle','$Ccode','$Cunit','$semester','$level','".safee($condb,$facadd)."','".$coursecat."','".safee($condb,$amax)."','".safee($condb,$amax2)."','".safee($condb,$exmax)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Course Titled $Ctitle was Add')")or die(mysqli_error($condb));
 message("New Course was Successfully Added", "success");
		        redirect('add_Courses.php?view=addc');

}

}
}
?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="register" method="post" enctype="multipart/form-data" id="register">
<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
                      
                      <span class="section">Add Courses    <?php
//if($resi == 1){ echo " <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center> ";}?> </span>

  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" required="required"  >
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
                            	  <select name='dept1' id="dept1" class="form-control" required="required" >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
 
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Title </label>
                            	  <input type="text" class="form-control " name='Ctitle' id="Ctitle"  required="required">
                      </div>
                      
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Code </label>
                            	  <input type="text" class="form-control " name='Ccode' id="Ccode"  required="required">
                      </div>
                      
                     <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Credit Unit </label>
                            	  <input type="text" class="form-control " name='Cunit' id="Cunit"  required="required">
                      </div>
 
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Semester </label>
                      
                          <select name='semester' id="semester" class="form-control" required>
                            <option value="">Select Semester</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                          
                          </select> </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Level </label>
                      <?php include("loadlevel.php"); ?>
                           </div>
                    
						  
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max CA Score </label>
                      <input type="text" class="form-control " name='assmax' id="assmax" maxlength="2"   placeholder="eg.CA (20%)" onkeypress="return isNumber(event);" required="required"> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Pratical Score (Optional) </label>
                      <input type="text" class="form-control " name='assmax2' id="assmax2" maxlength="2"   placeholder="eg.Pratical (10%)" onkeypress="return isNumber(event);" > </div>
                        
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Max Exam Score  </label><input type="text" class="form-control " name='exammax' id="exammax" maxlength="2"  placeholder="eg.Exam (70%)" onkeypress="return isNumber(event);" required="required"> </div>
                     
                     <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
<label for="heard" >Course Category</label><br>
<label class="radio-inline"><input type="radio" name="ccat" value="1"  /> Compulsory </label><label class="radio-inline"><input type="radio" name="ccat" value="0"  /> Elective </label></div></div>
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                    
                                     
                                       
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["create"])){ ?> 
                        <button  name="Addcourse"  id="Addcourse"  class="btn btn-primary" title="Click Here to Save Course Details" ><i class="fa fa-sign-in"></i> Add Course</button><?php } ?>   <?php   if (authorize($_SESSION["access3"]["sConfig"]["avc"]["view"])){ ?> 
                        <button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=ViewCourses';" class="btn btn-primary " title="Click Here View Courses" ><i class="fa fa-eye"></i> View Courses </button>
						<button  name="goback"  id="goback" type='button' onClick="window.location.href='add_Courses.php?view=impc';" class="btn btn-primary " title="Click Here to import Courses from Excel Format" ><i class="fa fa-download"></i> Import Courses </button><?php } ?> 
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Addcourse').tooltip('show');
	                                            $('#Addcourse').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	</div>
									
                        </form>
                       </div> 
                 