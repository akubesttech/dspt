

<?php

if(isset($_POST['savetime'])){
$Day2 = $_POST['date'];
$Day= DateTime::createFromFormat('d/m/Y', $Day2)->format('Y-m-d');
$etimen = $_POST['time1']; 
$dept = $_POST['dept1'];
$faculty = $_POST['fac1'];
$venuet = $_POST['venue'];
$query_ltime = mysqli_query($condb,"select * from utmedate where fac ='".safee($condb,$faculty)."' AND dept = '".safee($condb,$dept)."' AND examdate = '".safee($condb,$Day)."' AND etime = '".safee($condb,$etimen)."' ")or die(mysqli_error($condb));
$row_ltime=mysqli_fetch_array($query_ltime); $count=mysqli_num_rows($query_ltime);
if($count>0){	

ob_start();
	message("Please This Exam Schedule has already been added.", "error");
		       redirect('lecture_time.php?view=etime');
}else{
$dbsettime = "INSERT INTO utmedate (prog,fac,dept,examdate,etime,venue) values ('".safee($condb,$class_ID)."', '".safee($condb,$faculty)."','".safee($condb,$dept)."', '".safee($condb,$Day)."','".safee($condb,$etimen)."','".safee($condb,$venuet)."')";
	$Querysettime = mysqli_query($condb,$dbsettime) or die ("Couldn't set Exam Schedule.");
		message("Entrance Exam Schedule was successfully Added", "success");
		       redirect('lecture_time.php?view=letime');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Set New Entrance Examination Schedule</span>

                      	    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";}
	else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}
}?></select></div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
<label for="heard"><?php echo $SGdept1; ?></label>
<select name='dept1' id="dept1"  class="form-control"  >
 <option value=''>Select <?php echo $SGdept1; ?></option>
 </select>
</div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date</label>
<input  type="text" name="date" size="25"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;" autocomplete="off" required >
</div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Exam Time</label>
<select class="form-control" name="time1" id="time1"  required="required">
    <option value="">Time</option>
   </select></div>
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
                         
                        <button  name="savetime"  id="savetime"  class="btn btn-primary col-md-4" title="Click Here to Save " ><i class="fa fa-save"></i> Save </button>
                      <a href='javascript:void(0);' onclick="window.open('lecture_time.php?view=letime','_self')" class="btn btn-primary"  id="delete02" data-placement="right" title="Click to View Details" ><i class="fa fa-file icon-large"></i> View Details</a>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#savetime').tooltip('show');
	                                            $('#savetime').tooltip('hide');
	                                            });
	                                            </script>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  