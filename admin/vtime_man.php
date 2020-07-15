
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["vTime"]["vltin"]["create"]) || 
authorize($_SESSION["access3"]["vTime"]["vltin"]["edit"]) || 
authorize($_SESSION["access3"]["vTime"]["vltin"]["view"]) || 
authorize($_SESSION["access3"]["vTime"]["vltin"]["delete"]) ) {
 $status = TRUE;
} ?>
	
		    	
<?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {message("You don't have the permission to access this page", "error");
		        redirect('./'); } ?>
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
		            $content    = 'ltime.php';		
		            break;

	                case 'sa_time' :
		            $content    = 'searchttb.php';		
		            break;
                    
		            
	                default :
		            $content    = 'ltime.php';
				
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


        ?>
     
         <?php include('footer.php'); ?>