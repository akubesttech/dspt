
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
<h3>Lecture Time Table 
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
			
					<?php 
	
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'l_t' :
		            $content    = 'lecturetime.php';		
		            break;

	                case 's_time' :
		            $content    = 'searchtimetable.php';		
		            break;
                    
		            
	                default :
		            $content    = 'lecturetime.php';
				
                            }
                     require_once $content;  
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


function getfaculty2($get_fac2)
{
//$query1 = mysql_query("select * from student where RegNo = '$get_RegNo' and validate = '3'")or die(mysql_error());
							//	$row2 = mysql_fetch_array($query1);
								//$nameclass=$row2['class'];
//$nameclass=$row['class'];
$query2 = @mysql_query("select fac_name from faculty where fac_id = '$get_fac2' ")or die(mysql_error());
$count = mysql_fetch_array($query2);
 $nameclass2=$count['fac_name'];
return $nameclass2;
}
function statusUser2()
{
	$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	
	$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE student_tb SET verify_Data = '$status' WHERE stud_id = '$userId' and verify_Data = 'FALSE'";

	mysql_query($sql);
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
         <?php include('../Admin/footer.php'); ?>