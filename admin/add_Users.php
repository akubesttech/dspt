
<?php  include('header.php'); ?>
<?php include('session.php'); 
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sMan"]["asu"]["create"]) || 
authorize($_SESSION["access3"]["sMan"]["asu"]["edit"]) || 
authorize($_SESSION["access3"]["sMan"]["asu"]["view"]) || 
authorize($_SESSION["access3"]["sMan"]["asu"]["delete"]) ) {
 $status = TRUE;
}
?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	 ?>
  <?php $get_RegNo = isset($_GET['id']) ? $_GET['id'] : ''; 
  $get_staff = isset($_GET['d_id']) ? $_GET['d_id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Admin User Managment
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					//$num=$get_RegNo;
				//if (!empty($get_RegNo)){ include('editUser.php');}else{ include('addUser.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2> <?php  if($_GET['view'] == "addUser"){ echo "Add New User" ;}if($_GET['view'] == "editUser"){
echo "Edit User Records";}if($_GET['view'] == "Users"){echo "List Of System Users";}
  ?>
                     </h2>
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
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'addUser' :
		            $content    = 'addUser.php';
					break;
					case 'editUser' :
		            $content    = 'editUser.php';
					break;
                    case 'Users' :
		            $content    = 'user_records.php';
					break;
		            default :
		            $content    = 'user_records.php';
                            }
                     require_once $content;
					?>
                    
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
    
       
  
         <?php include('footer.php'); ?>