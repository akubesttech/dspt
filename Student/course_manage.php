
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php') ?>
    <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Student Course Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
			
					<?php 
                    //outstanding course registration
if (isset($_POST['outreg'])){
	 if(empty($_POST['selector'])){
				message("Select at least one Course to proceed !", "error");
		        redirect('course_manage.php?view=r_co');
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){$sql="select * from courses where C_id='".$id[$i]."' ";
			$result=mysqli_query($condb,$sql) or die(mysqli_error($condb));
			$count=mysqli_num_rows($result); $ntotal = 1;
		$row=mysqli_fetch_array($result);
	extract($row);
$sql2="select * from coursereg_tb where course_id ='".$id[$i]."' and sregno= '".$student_RegNo."' and dept = '".safee($condb,$student_dept)."'";
$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
if(mysqli_num_rows($result2)>0)
{mysqli_query($condb,"update coursereg_tb  set creg_status='1',session = '".safee($condb,$default_session)."',semester='".safee($condb,$semester)."',c_unit='".safee($condb,$C_unit)."',lect_approve ='0' and dept = '".safee($condb,$student_dept)."' where sregno='".$student_RegNo."' and course_id ='".$id[$i]."' ")or die(mysqli_error($condb));
$import = mysqli_query($condb,"REPLACE INTO results (student_id,course_code,course_id,dept,level,session,semester,c_unit,assessment,exam,total,grade,gpoint,qpoint) VALUES ('".$student_RegNo."','".$C_code."','".$C_id."','".$student_dept."','".$C_level."','".$default_session."','".$semester."', ".$C_unit.",'1','1','1','".grading($ntotal,$student_prog)."','".gradpoint($ntotal,$student_prog)."','0.00')") or die(mysqli_error($condb));
}else{
$query="insert into coursereg_tb(sregno,course_id,c_code,level,semester,c_unit,session,dept,creg_status,lect_approve)values('".$_SESSION['regno']."','".$C_id."','".$C_code."','".$C_level."','".$semester."','".$C_unit."','".$default_session."','".safee($condb,$student_dept)."','1','0')";
$result2=mysqli_query($condb,$query) or die(mysqli_error($condb));
$import = mysqli_query($condb,"REPLACE INTO results (student_id,course_code,course_id,dept,level,session,semester,c_unit,assessment,exam,total,grade,gpoint,qpoint) VALUES ('".$student_RegNo."','".$C_code."','".$C_id."','".$student_dept."','".$C_level."','".$default_session."','".$semester."', ".$C_unit.",'1','1','1','".grading($ntotal,$student_prog)."','".gradpoint($ntotal,$student_prog)."','0.00')") or die(mysqli_error($condb));
}}
message("Selected Outstanding Course (s) was successfully registered", "success");
redirect('course_manage.php?view=S_CO'); }}



    
if(empty($student_RegNo)){ $que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where app_no = '".safee($condb,$student_appNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."' ");}else{
$que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."'  ");}
	$warning_count2=mysqli_num_rows($que_checkpay);	      
	$warning_data=mysqli_fetch_array($que_checkpay);   $sumpay = $warning_data['samount'];
	//$pay_status = $warning_data['pay_status'];
    $view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
    if(!empty($epenable)){
	if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm){ 
						
					switch ($view) {
                	case 'S_CO' :
		            $content    = 'searchcourse.php';		
		            break;

	                case 'l_out' :
		            $content    = 'outstandingcourse.php';		
		            break;
                    
                     case 'r_co' :
		            $content    = 'Registered_course.php';		
		            break;
		             case 'l_c' :
		            $content    = 'loadedcourse.php';		
		            break;
		            
	                default :
		            $content    = 'loadedcourse.php';
				
                            }
                     require_once $content;
					  }else{
	message("Access Not Granted ,Payment Information not verified!", "error");
		redirect(host()."Student/"); 
					 } }else{
					   switch ($view) {
                	case 'S_CO' :
		            $content    = 'searchcourse.php';		
		            break;

	                case 'l_out' :
		            $content    = 'outstandingcourse.php';		
		            break;
                    
                     case 'r_co' :
		            $content    = 'Registered_course.php';		
		            break;
		             case 'l_c' :
		            $content    = 'loadedcourse.php';		
		            break;
		            
	                default :
		            $content    = 'loadedcourse.php';
				
                            }
                     require_once $content;
                       
					 }
						?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



          



            
            
          </div>
        </div>
        <!-- /page content -->
        
  



         <?php include('footer.php'); ?>