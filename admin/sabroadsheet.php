<?php
	$status = FALSE;
if ( authorize($_SESSION["access3"]["rMan"]["ras"]["create"]) || 
authorize($_SESSION["access3"]["rMan"]["ras"]["edit"]) || 
authorize($_SESSION["access3"]["rMan"]["ras"]["view"]) || 
authorize($_SESSION["access3"]["rMan"]["ras"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
   if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('Student_Record.php?view=opro');} 
			   
			   ?>
<?php
//if($_SESSION['insidtime']==$_POST['insidtime'])
//{
	$_SESSION['vsession']="";
	$_SESSION['los']="";
if(isset($_POST['viewras'])){
$salot_dept = $_POST['dept1'];
$semester = $_POST['semester'];
$salot_los = $_POST['los'];
$salot_session = $_POST['session'];
$sfacu = $_POST['fac1'];
//$result_alldept=mysqli_query($condb,"SELECT * FROM results WHERE session ='".safee($condb,$salot_session)."' and dept ='".safee($condb,$salot_dept)."' and level ='".safee($condb,$salot_los)."' and semester ='".safee($condb,$semester)."'");
$result_alldept=mysqli_query($condb,"SELECT * FROM results WHERE dept ='".safee($condb,$salot_dept)."' and session ='".safee($condb,$salot_session)."' and  level ='".safee($condb,$salot_los)."' ");
$num_alldept = mysqli_num_rows($result_alldept);
//	$_SESSION['vsession']=$salot_session;

if($num_alldept < 1){
message("ERROR: No Result Annual Broad Sheet Found for ".getdeptc($salot_dept)." Department for ".$salot_session." , Please Try Again .", "error");
 redirect('Result_am.php?view=ras');
}else{
	$_SESSION['vsession']=$salot_session;
	$_SESSION['bfac']=$sfacu;
//echo "<script>window.location.assign('resultsummary.php?Schd=".($salot_dept)."&sec=".($salot_session)."&lev=".($salot_los)."');</script>";
echo "<script>window.location.assign('resultsummary_p.php?Schd=".($salot_dept)."&sec=".($salot_session)."&lev=".($salot_los)."');</script>";
}

}//}$_SESSION['insidtime'] = rand();
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidtime" value="<?php echo $_SESSION['insidtime'];?> " />
                      
                      <span class="section">Result Annual Summary</span>

                      	    <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback" >
					    <label for="heard"><?php echo $SCategory; ?> </label>
						  	<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}
?></select></div>
                     
<div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
<label for="heard"><?php echo $SGdept1; ?></label><select name='dept1' id="dept1" onchange='loadCourse(this.name);return false;' class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option></select></div>
 <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback" style="display:none;">
<label for="heard">Courses</label><select name='cos' id="cosload" class="form-control"  ><option value=''>Select Courses</option>
                          </select></div>
                      
  <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback"><label for="heard">Academic Session</label>
<select class="form-control"   name="session" id="session"  required="required"><option value="">Select Session</option>
<?php  $resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");while($rssec = mysqli_fetch_array($resultsec))
{echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
?></select></div>
                 <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
	<label for="heard">Level </label><select class="form-control" name="los" id="los" required >
<option value="">Select Level</option><?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}?></select> </div>

                    
                      
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
                         <?php   if (authorize($_SESSION["access3"]["rMan"]["ras"]["view"])){ ?> 
                        <button  name="viewras"  id="viewras"  class="btn btn-primary col-md-4" title="Click Here to View Result Annual Broad Sheet" ><i class="fa fa-file"></i> View Broad Sheet </button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#setlectime').tooltip('show');
	                                            $('#setlectime').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                              <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  