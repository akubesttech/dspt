
<?php  include('header.php'); ?>
<?php include('session.php');		
include_once('C_attend.php');
$status = FALSE;
if ( authorize($_SESSION["access3"]["sMan"]["acos"]["create"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["edit"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["view"]) || 
authorize($_SESSION["access3"]["sMan"]["acos"]["delete"]) ) {
 $status = TRUE;
} ?>
 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php //$get_RegNo = isset($_GET['id']) ? $_GET['id'] : '';
  $get_staff= isset($_GET['allot_id']) ? $_GET['allot_id'] : '';
  $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';
  $fac = isset($_GET['fac1']) ? $_GET['fac1'] : '';
$depart = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$session = isset($_GET['session2']) ? $_GET['session2'] : '';
$pro_level =  isset($_GET['los']) ? $_GET['los'] : '';
$return_url = isset($_GET['return_urlx']) ? $_GET['return_urlx'] : '';
 if(empty($depart)){ $links = "allot_Courses.php"; $return_url = "";}else{ $return_url 	= base64_decode($return_url);
    $links = "allot_Courses.php?dept1_find=".$depart."&session2=".$session."&los=".$pro_level."&fac1=".$fac;}
 if($Rorder == "10"){ $link2 = "Course_m.php?view=clist&userId=".$get_RegNo;}else{ $link2 = "allot_Courses.php?view=clist&userId=".$get_RegNo;}
  	?>
 <?php
 if (isset($_POST['Courseapprove'])){
	if(empty($_POST['selector3'])){
				message("Select at least one Course Registration to proceed !", "error");
		        redirect($link2);
				}else{ $id=$_POST['selector3'];  $N = count($id);$deptcp = $_POST['dept'];
          $sessions = $_POST['sec']; $usr = $_POST['lecid'];
             $cosd = $_POST['lev'];
for($i=0; $i < $N; $i++){
$sql2="select * from coursereg_tb where creg_id ='".$id[$i]."' and session = '".$sessions[$i]."' and dept = '".$deptcp[$i]."' and level = '".$cosd[$i]."'";
				$result2=mysqli_query($condb,$sql2) or die(mysqli_error($condb));
				$row=mysqli_fetch_array($result2);
	//extract($row); 
				//if(mysqli_num_rows($result2)>0){
mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '1', appby = '$usr' where creg_id ='".$id[$i]."' ")or die(mysqli_error($condb));
				//}else{
			//mysqli_query($condb,"UPDATE coursereg_tb  SET lect_approve = '0' where creg_id ='".$id[$i]."'  ")or die(mysqli_error($condb));
				}//}
	message(" Selected Student Course Registration Successfully Approved.", "success");
	redirect($link2); }} 
 ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff / Lecturer Course Allocation
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					//$num=$get_RegNo;
                    //if(!empty($get_RegNo)){ include('editUser.php');
                    //}else{ include('allotCourse.php');  }
			?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
<h2> <?php 	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
if($view == "allotCourse"){ echo "Allot New Course to Staff / Lecturer" ;}elseif($view == "Search_Record"){ echo "Search For More Allocation Records";
}elseif($view == "clist"){ echo  "List of Student (s) that Registered ";  }else{
echo "List Of Alloted Course (s) To Lecture (s)";} ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                 </p>
                   <?php 
				    switch ($view) {
                	case 'allotCourse' :
		            $content    = 'allotCourse.php';
				     break;
                     case 'Search_Record' :
		            $content    = 'searchcallocate.php';
                    break;
                    case 'clist' :
		            $content    = 'courselist.php';		
		            break;
				     break;
                     case 'allotlist' :
		            $content    = 'loadcallocation.php';
				     break;
		            default :
		            $content    = 'loadcallocation.php';
                            }
                     require_once $content;
					?>
                    
                    
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        <?php 

        ?>
  
         <?php include('footer.php'); ?>