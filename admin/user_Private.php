
<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		         
 	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo = isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>

</h3>
</div>
</div><div class="clearfix"></div>
          
 </div>
            
                
				 <!-- /Organization Setup Form -->
				
					<?php 
				
					$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'UPRO' :
		            $content    = 'userprofile.php';		
		            break;

	                case 'UP' :
		            $content    = 'changePass.php';		
		            break;
                    
                     case 'UIm' :
		            $content    = 'profile_image.php';		
		            break;
		             case 'Aftype' :
		            $content    = 'aftype.php';		
		            break;
		            case 'apt' :
		            $content    = 'afeetype.php';		
		            break;
		            case 'add_form' :
		            $content    = 'addform.php';		
		            break;
		            case 'user_guide' :
		            $content    = 'userguide.php';		
		            break;
	                default :
		            $content    = 'userprofile.php';
				
                            }
                     require_once $content;
				
				?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
              
            </div>





            
            
          </div>
          
        </div>
        <!-- /page content -->
               <!-- /page content -->
        
   
   
   
<!-- end  Modal -->
  </div>
   <?php include('footer.php'); ?>      