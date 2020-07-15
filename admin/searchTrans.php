
<?php 
	$status = FALSE;
if ( authorize($_SESSION["access3"]["stMan"]["trans"]["create"]) || 
authorize($_SESSION["access3"]["stMan"]["trans"]["edit"]) || 
authorize($_SESSION["access3"]["stMan"]["trans"]["view"]) || 
authorize($_SESSION["access3"]["stMan"]["trans"]["delete"]) ) {
 $status = TRUE;
}
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
<?php
//session_start();
if($class_ID > 0){}else{
message("ERROR:  No Programme Select,Please Select a Programme and continue.", "error");
		       redirect('Student_Record.php?view=opro');} 
//ini_set('display_errors', 1);
//if($_SESSION['insid']==$_POST['insid'])
//{
if(isset($_POST['printtrans'])){
 $Session_checker = $_POST["session2"];
$department = $_POST["dept1_find"];
$matno = $_POST["matno"];$programType = $_POST["prog"]; $currenty = date("Y");
	//$_SESSION['temppin']=$Pin;
$result_pinr=mysqli_query($condb,"SELECT * FROM student_tb WHERE yoe ='".safee($condb,$Session_checker)."' AND RegNo ='".safee($condb,$matno)."' AND Department ='".safee($condb,$department)."' AND app_type='".safee($condb,$class_ID)."'");
$num_pinr = mysqli_num_rows($result_pinr);
$num_serialr = mysqli_fetch_array($result_pinr);
$yearofgraguation = $num_serialr['yog'];$programdb = $num_serialr['app_type'];


$sql_appNo_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE RegNo ='".safee($condb,$matno)."'  LIMIT 1");
$appNo_check = mysqli_num_rows($sql_appNo_check);
//$sql_JambNo_check = mysqli_query($condb,"SELECT * FROM new_apply1 WHERE JambNo='$nappNo21' LIMIT 1");
//$JambNo_check = mysqli_num_rows($sql_JambNo_check);
$sql_session_check = mysqli_query($condb,"SELECT Asession FROM student_tb WHERE  RegNo ='".safee($condb,$matno)."' and yoe ='".safee($condb,$Session_checker)."'");
$session_check = mysqli_num_rows($sql_session_check);
//$sub_user = $num_pinn2['reg_status'];
	//$_SESSION['tempserial']=$num_serialNo;
		if ($appNo_check < 1){ 
		message("ERROR: This $matno Number is Incorrect  please Comfirm and try Again.", "error");
		       redirect('Student_Record.php?view=s_tra');
}elseif(strpos($matno," ")){
				message("ERROR: Please! Student Mat / Reg No can not Contain a Space.", "error");
		       redirect('Student_Record.php?view=s_tra');
}elseif($session_check < 1){
				message("ERROR: Incorrect Year Of Entry please Comfirm and try Again.", "error");
		       redirect('Student_Record.php?view=s_tra');
//}elseif($programdb != $programType){
				//message("ERROR:  Incorrect Program Type please Comfirm and try Again.", "error");
		       //redirect('Student_Record.php?view=s_tra');
}elseif($currenty < $yearofgraguation){
	message("Transcript Not Available For $matno, Please Confirm Student Year Of Graguation.", "error");
		       redirect('Student_Record.php?view=s_tra');
       // $res="<font color='Red'><strong>Transcript Not Available For $matno, Please Confirm Student Year Of Graguation.</strong></font><br>"; $resi=1;
}else{
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
	echo "<script>window.location.assign('Transcript.php?transid=".($matno)."&sec=".($Session_checker)."&depo=".($department)."');</script>";
	//echo "<script>window.location.assign('Transcript.php?transid=".$matno."');</script>";
		//$_SESSION['deptrans']=$department; $_SESSION['esession']=$Session_checker;$_SESSION['progty']=$programType;
			}

}//}$_SESSION['insid'] = rand();
?>



<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
                      
                      <span class="section">Generate  Student Transcript</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to Generate Student Transcript. 
                  </div>
   <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Mat No./Reg No:</label>
                     
                          <input type="text" class="form-control " name='matno' id="matno"  value=""  required="required"> </div>
                          
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
                            	  <select name='dept1_find' id="dept1" required="required" class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard">Year of Entry</label>
                            <select name="session2" id="session2"  required="required" class="form-control">
  <option value="">Select Year</option>
<?php  
//$resultsec = mysqli_query($condb,"SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
//$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
for($x=2016;$x<2036;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	}
?>
</select>
                      </div>
                    <div class="col-md-12 col-sm-3 col-xs-12 form-group has-feedback">
                        <!-- 
						  	  <label for="heard">Program Type</label>
     <select class="form-control"   name="prog" id="prog"  required="required">
  <option value="">Select Program</option>
   
<?php  
//$resultcourse = mysqli_query($condb,"SELECT * FROM prog_tb where status = '1' ORDER BY Pro_name ASC");
//while($rscourse = mysqli_fetch_array($resultcourse))
//{
//echo "<option value='$rscourse[pro_id]'>$rscourse[Pro_name]</option>";	
//}
?>
</select> --!>
</div>    
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <?php   if (authorize($_SESSION["access3"]["stMan"]["trans"]["view"])){ ?>
                         <button type="submit" name="printtrans"  id="printtrans" data-placement="right" class="btn btn-primary" title="Click Proceed to Continue" ><i class="fa fa-file"></i> Proceed</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                       
                        
                      </div>
                    </form>
                  </div>
                  