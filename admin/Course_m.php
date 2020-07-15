<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
      
  <?php $get_RegNo= $_GET['userId']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Staff Course Management
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