<?php

if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('lecture_time.php?view=opro');}
if(isset($_POST['setlectime'])){
$Day2 = $_POST['date'];
$Day= DateTime::createFromFormat('d/m/Y', $Day2)->format('Y-m-d');
$tstart = $_POST['time1']; $tend = $_POST['time2']; //$Time = $tstart." - ".$tend;
$tstart2 = getStime($tstart); $stend = getStime($tend);
$duration2 = differenceInHours($tstart,$tend); $droundup = intval($duration2);
if(is_float($duration2)){ $duration = $droundup * 4 + 2;}else{ $duration = $droundup * 4 ; }
$salot_dept = $_POST['dept1'];
$salot_cos = $_POST['cos'];
$salot_session = $_POST['session'];
$salot_los = $_POST['los'];
$salot_sem = $_POST['sem'];
$venuet = $_POST['venue'];
//$date  = date('l jS F Y').date('h:i:s a');

$query_ltime = mysqli_query($condb,"select * from examtime_tb where t_level ='".safee($condb,$salot_los)."' AND course = '".safee($condb,$salot_cos)."' AND date = '".safee($condb,$Day)."' AND time = '".safee($condb,$tstart2)."' AND duration = '".safee($condb,$duration)."'")or die(mysqli_error($condb));
$query_ltime2 = mysqli_query($condb,"select * from examtime_tb where t_level ='".safee($condb,$salot_los)."' AND course = '".safee($condb,$salot_cos)."' AND date = '".safee($condb,$Day)."' AND time = '".safee($condb,$tstart2)."' ")or die(mysqli_error($condb));
$row_ltime=mysqli_fetch_array($query_ltime); $count=mysqli_num_rows($query_ltime); $count2=mysqli_num_rows($query_ltime2);
if($count>0){	

ob_start();
	message("Please This Exam Time Set Already Exist In our Database  Or The Exam Time / Course is Clashing.", "error");
		       redirect('lecture_time.php?view=examt');
		       }elseif($count2>0){	

	message("Lecture Period Already Occupy By another Course try Another", "error");
		       redirect('lecture_time.php?view=examt');
		       }elseif($tstart == $tend){
		       message("Incorrect Time Selection.", "error");
		       redirect('lecture_time.php?view=examt');
		       }elseif($stend < $tstart2){
		       message("Exam End Time should not be lessthan Start Time.", "error");
		       redirect('lecture_time.php?view=examt');
}else{
$dbsettime = "INSERT INTO examtime_tb (t_dept,t_level,semester,session,date,time,duration,course,venue,prog) values 
('".safee($condb,$salot_dept)."', '".safee($condb,$salot_los)."','".safee($condb,$salot_sem)."', '".safee($condb,$salot_session)."','".safee($condb,$Day)."','".safee($condb,$tstart2)."','".safee($condb,$duration)."','".safee($condb,$salot_cos)."','".safee($condb,$venuet)."','".safee($condb,$class_ID)."')";
	$Querysettime = mysqli_query($condb,$dbsettime) or die ("Couldn't set Lecture time For $salot_cos.");
		message("Exam Time For <b> $salot_cos </b> was successfully Added", "success");
		       redirect('lecture_time.php?view=load02');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Set New Examination Time</span>

                      	    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
//$resultfac = mysql_query("SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
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
                       
						  	  <label for="heard">Courses</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Courses</option>
                          </select>
                      </div>
                      
  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session</label>
							   <select class="form-control"   name="session" id="session"  required="required">
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
						  	  <label for="heard">Level</label>
                            	  	 <select class="form-control" name="los" id="los"  required="required">
<option>Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
 </select>
                      </div>
 <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Semester</label>
                            	  	 <select class="form-control" name="sem" id="sem"  required="required">
<option>Semester</option>
<option value="First">First</option>
<option value="Second">Second</option></select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date</label>
<input  type="text" name="date" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;" autocomplete="off" >
 <!--<select class="form-control" name="day" id="day" required="required">
    <option value="">Day</option>
    <?php
///	$arrdays = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"); foreach($arrdays as $val){echo "<option value='$val'>$val</option>";}?>
<?php  //echo fill_Day();?>
</select> --!>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Time Start</label>
<select class="form-control" name="time1" id="time1"  required="required">
    <option value="">Start</option>
    <?php

//$arrtime = array("6.00 AM","7.00 AM","8.00 AM","9.00 AM","10.00 AM","11.00 AM","12.00 PM","01.00 PM","02.00 PM","03.00 PM","04.00 PM","05.00 PM","06.00 PM","07.00 PM","08.00 PM");foreach($arrtime as $val){echo "<option value='$val'>$val</option>";}
	?></select></div>
	  <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">End Time </label>
<select class="form-control" name="time2" id="time2" required="required">
    <option value="">End</option>
    <?php
//$arrtime2 = array("6.00 AM","7.00 AM","8.00 AM","9.00 AM","10.00 AM","11.00 AM","12.00 PM","01.00 PM","02.00 PM","03.00 PM","04.00 PM","05.00 PM","06.00 PM","07.00 PM","08.00 PM");foreach($arrtime2 as $val2){echo "<option value='$val2'>$val2</option>";}?></select></div>
	   
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Venue</label>
                            	  <input type="text" class="form-control " name='venue' id="venue"  >
                      </div>
                      
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                    
                     
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button  name="setlectime"  id="setlectime"  class="btn btn-primary col-md-4" title="Click Here to Save Lecture Time set" ><i class="fa fa-save"></i> Save </button>
                      <a href='javascript:void(0);' onclick="window.open('lecture_time.php?view=load02','_self')" class="btn btn-primary"  id="delete02" data-placement="right" title="Click to View Details" ><i class="fa fa-file icon-large"></i> View Details</a>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#setlectime').tooltip('show');
	                                            $('#setlectime').tooltip('hide');
	                                            });
	                                            </script>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  