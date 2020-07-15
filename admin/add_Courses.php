
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["avc"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["avc"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["avc"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["avc"]["delete"]) ) {
 $status = TRUE;
}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Course Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				//if ($num!==null){ include('editCourse.php'); }else{ include('addCourse.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
             <?php 
					$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'addc' :
		            $content    = 'addCourse.php';		
		            break;
                    case 'editc' :
		            $content    = 'editCourse.php';		
		            break;
		             case 'ViewCourses' :
		            $content    = 'viewcourse.php';		
		            break;
		            case 'impc' :
		            $content    = 'simpcourse.php';		
		            break;
		            case 'vupload' :
		            $content    = 'viewcupload.php';		
		            break;
		            case 'addMode' :
		            $content    = 'entrymode.php';		
		            break;
                    default :
		            $content    = 'viewcourse.php';
                            }
                     require_once $content;
				?>
           
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        
  
         <?php include('footer.php'); ?>