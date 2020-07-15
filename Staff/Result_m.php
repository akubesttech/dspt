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
<h3>Staff Result  Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'imp_re' :
		            $content    = 'impresult.php';		
		            break;

	                case 'v_re' :
		            $content    = 'viewaResult.php';		
		            break;
                   
                     case 'v_up' :
		            $content    = 'view_up.php';		
		            break;
		                
					case 'v_res' :
		            $content    = 'view_result.php';		
		            break;
		            
		            case 'e_res' :
		            $content    = 'edit_result.php';		
		            break;
		            
		              case 'v_so' :
		            $content    = 'MessageAlert.php';		
		            break;
		            
	                default :
		            $content    = 'impresult.php';
				
                            }
                     require_once $content;
                     statuscapp2();
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

function getgrade($recordData)
{//$grade = "";
if ($recordData >= 70 AND $recordData <=101) 
		{return "A";}
		elseif ($recordData >= 60 AND $recordData <=69) 
		{return "B";}
		elseif ($recordData >= 50 AND $recordData <=59) 
		{return "C";}
		elseif ($recordData >= 45 AND $recordData <=49) 
		{	return "D";}	
		elseif ($recordData >= 40 AND $recordData <=44) 
		{return "E";}	
		elseif ($recordData >= 0 AND $recordData <=39) 
		{return "F";}
		}
		
function getgp($recordData1)
{//$grade = "";
if ($recordData1 >= 70 AND $recordData1 <=101) 
		{return "5";}
		elseif ($recordData1 >= 60 AND $recordData1 <=69) 
		{return "4";}
		elseif ($recordData1 >= 50 AND $recordData1 <=59) 
		{return "3";}
		elseif ($recordData1 >= 45 AND $recordData1 <=49) 
		{	return "2";}	
		elseif ($recordData1 >= 40 AND $recordData1 <=44) 
		{return "1";}	
		elseif ($recordData1 >= 0 AND $recordData1 <=39) 
		{return "0";}
		}
		


function statuscapp2()
{
	$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
		//$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE sregno = '$userId'";

	mysqli_query(Database::$conn,$sql);
//	header('Location: new_apply.php');	

}
        ?>
        
        <script>  function changeUserStatus2(userId, status)
{
	var st = status == '0' ? 'Approve' : 'Not Approved'
	if (confirm('Your About to ' + st+' this Student Course Registration Make Sure All Information are Correct?')) {
	window.location.href = 'Course_m.php?userId=' + userId + '&nst=' + st;
	}
}</script>
         <?php include('../admin/footer.php'); ?>