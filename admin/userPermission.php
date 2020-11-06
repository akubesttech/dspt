
<?php  include('header.php'); ?>
<?php include('session.php'); 
//if(($admin_accesscheck == "1") or ($admin_accesscheck == "2")) {
//	}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
	//	redirect("index.php");}
		$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["aup"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["aup"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["aup"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["aup"]["delete"]) ) {
 $status = TRUE;}
 ?>

	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} 

if(isset($_GET['delid']))
{$sql="DELETE FROM role_rights WHERE rr_modulecode = '".safee($condb,$_GET['delid'])."' AND rr_rolecode ='".safee($condb,$_GET['p2'])."' ";
$qsql = mysqli_query($condb,$sql);	
message("Selected Permission successfuly Removed", "success");
		        redirect('userPermission.php?view=Edit'); 
}
?>
  <?php $get_RegNo =  isset($_GET['id']) ? $_GET['id'] : ''; $get_RegNo2= isset($_GET['idroom']) ? $_GET['idroom'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Permission Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
			/*		$num=$get_RegNo;
				if ($num!==null){
			include('edit_Hostel.php');
			}else{
			
				include('addHostel.php'); }  */  ?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
             
                <?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'Add' :
		            $content    = 'addpermission.php';	
		            break;
                    case 'Edit' :
		            $content    = 'editpermission.php';		
		            break;
		             
	                default :
		            $content    = 'editpermission.php';
                            }
                     require_once $content;
				?>

                
                
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
               <!-- /page content -->
        
 
  
 
<!-- end  Modal -->
  
         <?php include('footer.php'); ?>