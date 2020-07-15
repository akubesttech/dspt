



<?php
if(isset($_POST['viewPay'])){
$salot_dept = $_POST['dept1'];
$salot_cos = $_POST['cos'];
$salot_los = $_POST['los'];
$salot_session = $_POST['session'];
$sql_alldept="SELECT * FROM payment_tb WHERE session ='$salot_session' and department ='$salot_dept' and pay_status ='1'";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
if($num_alldept < 1){
	message("No Payment Record Found for ".getdeptc($salot_dept)." Department in $salot_session , Please Try Again", "error");
		        redirect('View_Payment.php?view=v_p');
}else{
	$_SESSION['vsession']=$salot_session;
	$_SESSION['los']=$salot_los;
echo "<script>window.location.assign('Print_payment.php?Schd=".md5($salot_dept)."');</script>";}
}
if(isset($_POST['epbook'])){
$salot_dept = $_POST['dept1'];
$salot_cos = $_POST['cos'];
$salot_los = $_POST['los'];
$salot_session = $_POST['session'];
$sql_alldept="SELECT * FROM payment_tb WHERE session ='$salot_session' and department ='$salot_dept' and pay_status ='1'";
$result_alldept = mysqli_query($condb,$sql_alldept);
$num_alldept = mysqli_num_rows($result_alldept);
if($num_alldept < 1){
	message("No Payment Record Found for ".getdeptc($salot_dept)." Department in $salot_session , Please Try Again", "error");
		        redirect('View_Payment.php?view=v_p');
}else{
	$_SESSION['vsession']=$salot_session;
	$_SESSION['los']=$salot_los;
echo "<script>window.location.assign('exam_photobook.php?Schd=".md5($salot_dept)."');</script>";}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                  <!--    <span class="section">View Payment Record<?php
//if($resi == 1){	echo " <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?> </span>--!>

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
                       
						  	  <label for="heard">Department</label>
                            	  <select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select Department</option>
                          </select>
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" style="display:none;">
                       
						  	  <label for="heard">Courses</label>
                            	  <select name='cos' id="cosload" class="form-control"  >
                           <option value=''>Select Courses</option>
                          </select>
                      </div>
                      
  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session</label>
							   <select class="form-control"   name="session" id="session"  required="required">
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
                 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level <font color="green">     (Optional)</font></label>
                            	  	 <select class="form-control" name="los" id="los" >
<option value="">Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>
 </select>
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
                          <?php   if (authorize($_SESSION["access3"]["fIn"]["conp"]["view"])){ ?> 
       <button  name="viewPay"  id="viewPay"  class="btn btn-primary col-md-4" title="Click Here to View Student Payment List" ><i class="fa fa-file"></i> View Pay List </button>
       <button  name="epbook"  id="epbook"  class="btn btn-primary" title="Click Here to Generate Exam Photo Book" ><i class="fa fa-file"></i> Generate Photo Book </button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#viewPay').tooltip('show'); $('#epbook').tooltip('show');
	                                            $('#viewPay').tooltip('hide');$('#epbook').tooltip('hide');
	                                            });
	                                            </script><?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  