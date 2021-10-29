<?php  include('header.php'); ?>
<?php include('session.php'); 
include_once('C_attend.php');
?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
      
  <?php  $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : ''; 
  if($Rorder == "10"){ $link2 = "Course_m.php?view=clist&userId=".$get_RegNo;}else{ $link2 = "allot_Courses.php?view=clist&userId=".$get_RegNo;}
  	if (isset($_POST['Courseapprove'])){
	if(empty($_POST['selector3'])){
				message("Select at least one Course Registration to proceed !", "error");
		        redirect($link2);
				}else{ $id=$_POST['selector3'];  $N = count($id);$deptcp = $_POST['dept'];
          $sessions = $_POST['sec'];$usr = $_POST['lecid'];
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
<h3>Staff Course Management <?php //echo $get_RegNo; ?>
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'e_co' :
		            $content    = 'exportC.php';		
		            break;

	                case 'clist' :
		            $content    = 'courselist.php';		
		            break;
                   
                     case 'v_allot' :
		            $content    = 'view_callot.php';		
		            break;
		            
	                default :
		            $content    = 'view_callot.php';
				
                            }
                     require_once $content;
                     //statuscapp2();
					//$num=$get_RegNo;
				//if ($num!==null){
			//include('editStaff.php');
			//}else{
			
			//	include('addStaff.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



           



            
            
          </div>
        </div>
        <!-- /page content -->
        
        



   <?php 

/*
function statuscapp2()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
		//$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE sregno = '$userId'";
mysqli_query(Database::$conn,$sql);
//	header('Location: new_apply.php');	
}*/
        ?>
       
         <?php include('../admin/footer.php'); ?>