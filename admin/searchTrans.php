
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
    $crsl = isset($_POST['chkresult']) ? $_POST['chkresult'] : '';
    $sql_gradesetl = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$class_ID)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); 
    $getmg2 = mysqli_fetch_array($sql_gradesetl);    $getpassl = $getmg2['b_max'];
if(isset($_POST['printtrans'])){
 $Session_checker = $_POST["yoe"];
$department = $_POST["dept"];
$matno = $_POST["matno"];$programType = $class_ID; $currenty = date("Y");
$cresult = $crsl;
$result_pinr=mysqli_query($condb,"SELECT * FROM student_tb WHERE yoe ='".safee($condb,$Session_checker)."' AND RegNo ='".safee($condb,$matno)."' AND Department ='".safee($condb,$department)."' AND app_type='".safee($condb,$class_ID)."'");
$num_pinr = mysqli_num_rows($result_pinr);
$num_serialr = mysqli_fetch_array($result_pinr);
$yearofgraguation = $num_serialr['yog'];$programdb = $num_serialr['app_type'];


$sql_appNo_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE RegNo ='".safee($condb,$matno)."'  LIMIT 1");
$appNo_check = mysqli_num_rows($sql_appNo_check);
$sql_fail_check = mysqli_query($condb,"SELECT * FROM results WHERE student_id ='".safee($condb,$matno)."' AND exam > 0 AND total >= '".safee($condb,$getpassl)."' ");
$fail_check = mysqli_num_rows($sql_fail_check);
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
               }elseif($fail_check < 1){
				message("ERROR: Outstanding Course(s) Found and transcript cannot be generated.", "error");
		       redirect('Student_Record.php?view=s_tra');
//}elseif($programdb != $programType){
				//message("ERROR:  Incorrect Program Type please Comfirm and try Again.", "error");
		       //redirect('Student_Record.php?view=s_tra');
//}elseif($currenty < $yearofgraguation){
	//message("Transcript Not Available For $matno, Please Confirm Student Year Of Graguation.", "error");
		      // redirect('Student_Record.php?view=s_tra');
       // $res="<font color='Red'><strong>Transcript Not Available For $matno, Please Confirm Student Year Of Graguation.</strong></font><br>"; $resi=1;
}else{
if(empty($cresult)){ redirect('Transcript.php?transid='.($matno)."&sec=".($Session_checker)."&depo=".($department));
	//echo "<script>window.location.assign('Transcript.php?transid=".($matno)."&sec=".($Session_checker)."&depo=".($department)."');</script>";
    }else{ redirect('Finalresult.php?transid='.($matno)."&sec=".($Session_checker)."&depo=".($department));
    }}

}//}$_SESSION['insid'] = rand();
?>



<div class="x_panel">
                
             
                <div class="x_content">
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
  <input type="hidden" name="facn" id="facn" tabindex="2" />
    <input type="hidden" name="dept" id="dept" tabindex="3" />
    <input type="hidden" name="yoe" id="yoe" tabindex="4" />
    
   
<span class="section">Generate  Student Transcript / Final Result</span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: That this will enable Admin to Generate Student Transcript / Final Result. 
                  </div>
   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Mat No./Reg No:</label>
<input type="text" class="form-control " name="matno" id="matno"  value=""  onkeyup="getname2(this.value);" onblur="getname2(this.value);" tabindex="1"  required="required"> </div>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Student Full Name:</label>
                     <input type="text" class="form-control " name='fullname' id="fullname"  value=""   tabindex="6" readonly  > </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Academic Status:</label>
                     <input type="text" class="form-control " name='acad' id="acad"  value=""   tabindex="5" readonly > </div>
                      <?php   if (authorize($_SESSION["access3"]["stMan"]["trans"]["view"])){ ?>   <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
		<label for="chkPenalty"> </label><div class="form-group"><br>
    <label class="chkPenalty"><input type="checkbox" id="chkresult"   name="chkresult" value="1" /> Show Final Result </label></div></div> <?php } ?>
    
                                               
					    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" style="display: none;" > 
<label for="heard"><?php echo $SCategory; ?> </label>
<select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php $resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
while($rsblocks = mysqli_fetch_array($resultblocks))
{if($_GET['loadfac'] ==$rsblocks['fac_id'] ){echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
}else{echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";}}?>
</select></div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" style="display: none;">
<label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1_find' id="dept1"  class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback" style="display: none;">
<label for="heard">Year of Entry</label>
                            <select name="session2" id="session2"   class="form-control">
  <option value="">Select Year</option>
<?php while($rssec = mysqli_fetch_array($resultsec)){echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	}
for($x=2016;$x<2036;$x++){ echo '<option value="'.$x.'">'.$x.'</option>';}
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
                  