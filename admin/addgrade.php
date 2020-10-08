
<?php

if(isset($_POST['addgrade'])){
$f_pro = $_POST['f_pro'];$min_grade = $_POST['min'];
		$max_grade = $_POST['max'];$grade_group = $_POST['ggroup'];
		$grade = $_POST['grade']; $gstatus = $_POST['gstatus']; 
		$gpmin = $_POST['gpmin'];$gpmax = $_POST['gpmax'];
 if($grade_group == "01"){  $graderemark = $_POST['gremark']; $gradepoint = $_POST['gpoint']; $ngrade = $grade;}elseif($grade_group == "03"){ $graderemark = $gstatus;$ngrade = ""; $gradepoint = 0; }else{$graderemark = getappstatus($gstatus);$ngrade = "";
$gradepoint= $_POST['gstatus']; }
$sql_grade = mysqli_query($condb,"SELECT * FROM grade_tb where prog= '".safee($condb,$f_pro)."' and grade= '".safee($condb,$ngrade)."' and grade_group='".safee($condb,$grade_group)."' and gradename = '".safee($condb,$graderemark)."'")or die(mysqli_error($condb)); $gradecount = mysqli_num_rows($sql_grade);
$query_check = mysqli_query($condb,"select * from session_tb where action = '1'")or die(mysqli_error($condb));
$action = mysqli_num_rows($query_check);
$count2 = mysqli_fetch_array($query_check);
if($gradecount >0){ 	message("ERROR: grade bound has been added for this Programme before, Try Again.", "error");
		        redirect('add_grade.php'); }elseif($min_grade > $max_grade){
			message("ERROR:  Minimum score bound cannot be More than Maximum score bound, Try Again", "error");
		        redirect('add_grade.php');
				}elseif($gpmin > $gpmax and $grade_group !== "02"){
			message("ERROR:  Minimum GPA bound cannot be More than Maximum GPA bound, Try Again", "error");
		        redirect('add_grade.php'); }else{
//if($grade_group == "01"){ 
	mysqli_query($condb,"insert into grade_tb(prog,grade_group,b_min,b_max,grade,gradename,gp,gpmin,gpmax)values('".safee($condb,$f_pro)."','".safee($condb,$grade_group)."','".safee($condb,$min_grade)."','".safee($condb,$max_grade)."','".safee($condb,$ngrade)."','".safee($condb,$graderemark)."','".safee($condb,$gradepoint)."','".safee($condb,$gpmin)."','".safee($condb,$gpmax)."')") or die(mysqli_error($condb));//}else{

//}
// ob_start();
message("Grade Bound  Successfully Added ", "success");
		        redirect('add_grade.php');
}

}
?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Add New Grade </span>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Program *</label>
                        <select name='f_pro' id="f_pro" class="form-control" required>
                            <option value="">Select Program</option>
                            <?php  
$resultproe = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe))
{
echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";}?>
                            
                             </select>
                      </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  >
						  	  <label for="heard"   id="enable3" >Grade Group *</label>
          <select name='ggroup' id="ggroup" class="form-control"  required>
                            <option value="">Select group</option>
                        <option value="01">General</option>
    <option value="02">Entrance Exam</option>
    <option value="03">Promotion Status</option>
 </select>
                      </div>
   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="smin"  >
						  	  <label for="heard"   id="enable3" >Min Score Bound * </label><div  id="txtroomno" >
<input type="text"  id="min" name="min" value="" placeholder="0"   onkeypress="return isNumber(event);"  class="form-control" ></div>
</div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="smax" >
						  	  <label for="heard"   id="enable3" >Max Score Bound *</label>
<input type="text"  id="max" name="max" value="" placeholder="0" onkeypress="return isNumber(event);"   class="form-control" >
                  </div>
                      
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="grade" style="display: none;" >
                    <label for="email">Grade</label>
                	<div class="form-group"><select   class="form-control" name="grade"  ><option selected="selected" value="" >Select Grade</option><?php  echo fill_Mgrade();?>
</select></div>
 
            </div>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="gpoint" style="display: none;">
                    <label for="email">Grade Point * </label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='gpoint' id="gpoint"  placeholder="0" onkeypress="return check(event,value);" >
			    					</div>
 
            </div>
            
             <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="gpmin" style="display: none;" >
						  	  <label for="heard"   id="enable3" >Min GPA Bound * </label>
<input type="text"  id="gpmin" name="gpmin" value="" placeholder="0.00"   onkeypress="return check(event,value);"  class="form-control" >
</div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="gpmax" style="display: none;" >
						  	  <label for="heard"   id="enable3" >Max GPA Bound *</label>
<input type="text"  id="gpmax" name="gpmax" value="" placeholder="0.00" onkeypress="return check(event,value);"   class="form-control" >
                  </div>
                  
             <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="gmark" style="display: none;" >
                    <label for="email">Grade Remark * </label>
                	<div class="form-group">
                	 <input type="text" class="form-control "   name='gremark' id="gremark"  placeholder="Grade Remark ie:A (Excellent)" >
			    					</div>
 
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display: none;" id="gstatus">
						  	  <label for="heard">Grade Status </label>
<select  name="gstatus" id="gstatus" class="form-control" ><option value="">Select Grade Status</option>
<option  value="1">Admitted</option><option value="2">Pending</option> <option value="3">Not Admitted</option></select></div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display: none;" id="gastatus">
						  	  <label for="heard">Academic Status </label>
<select  name="gstatus" id="gstatus" class="form-control" ><option value="">Select Academic Status</option>
<?php echo getAcastatus(0); ?>
</select></div>
            
			<div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         		<?php   if (authorize($_SESSION["access3"]["sConfig"]["agd"]["create"])){ ?>
                        <button  name="addgrade"  id="addgrade"  class="btn btn-primary col-md-4" title="Click Here to Save Grade" ><i class="fa fa-sign-in"></i> Save</button> <?php } ?>

                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addform').tooltip('show');
	                                            $('#addform').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 