
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		    	

 <?php include('student_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Student Hostel Management <?php //echo  $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));

  ?>
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
			
					<?php 
	
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'capply' :
		            $content    = 'cocapply.php';		
		            break;
		            
		           case 'c_info' :
		            $content    = 'cchangeinfo.php';		
		            break;
		            
		             case 'cslip' :
		            $content    = 'c_pay.php';		
		            break;
		            
		             case 'e_suc' :
		            $content    = 'e_payvsuc.php';		
		            break;
		            case 'e_fail' :
		            $content    = 'e_payvfail.php';		
		            break;
                    
		            
	                default :
		            $content    = 'cocapply.php';
				
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
        
  

         <?php include('footer.php'); ?>