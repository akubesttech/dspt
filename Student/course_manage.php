
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo= $_GET['userId']; ?>
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
	if(empty($student_RegNo)){ $que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where app_no = '".safee($condb,$student_appNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."' ");}else{
$que_checkpay=mysqli_query($condb,"select SUM(paid_amount) as samount from payment_tb where stud_reg ='".safee($condb,$student_RegNo)."' and session ='".safee($condb,$default_session)."' and pay_status='1' and ft_cat='1' and level = '".safee($condb,$student_level)."'  ");}
	$warning_count2=mysqli_num_rows($que_checkpay);	      
	$warning_data=mysqli_fetch_array($que_checkpay);   $sumpay = $warning_data['samount'];
	$pay_status = $warning_data['pay_status'];
	if($sumpay >= $com_amount and $sumpay > 0 and $nocomp >= $nocompm){ 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
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
					 } 
						?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



          



            
            
          </div>
        </div>
        <!-- /page content -->
        
  



   <?php 


/*
function getfaculty2($get_fac2)
{
$query2 = @mysqli_query($condb,"select fac_name from faculty where fac_id = '$get_fac2' ")or die(mysqli_error($condb));
$count = mysqli_fetch_array($query2);
 $nameclass2=$count['fac_name'];
return $nameclass2;
} */
function statusUser2()
{
	$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	
	$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE student_tb SET verify_Data = '$status' WHERE stud_id = '$userId' and verify_Data = 'FALSE'";

	mysqli_query(Database::$conn,$sql);
//	header('Location: new_apply.php');	

}
        ?>
        <script>  function changeUserStatus2(userId, status)
{
	var st = status == 'FALSE' ? 'Verified' : 'Not Verified'
	if (confirm('Your About to ' + st+' this Student Record Make Sure All Information are Correct?')) {
	window.location.href = 'Student_Record.php?details&userId=' + userId + '&nst=' + st;
	}
}</script>
         <?php include('footer.php'); ?>