<?php  include('header.php'); ?>
<?php include('session.php'); ?>
	
		         
        <?php 
if(isset($_GET['addrooms'])){
?>

<script>
    $(document).ready(function(){
        $('#myModal6').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal6').fadeOut('fast');
            windows.location = "add_Hostel.php";
        })
    })

</script>

<?php }?>	
<?php include('student_slidebar.php'); ?>

    <?php include('navbar.php') ?>
  <?php $get_RegNo= $_GET['id']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>

</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					//$num=$get_RegNo;
				//if ($num!==null){
			//include('edit_Hostel.php');
			//}else{
			
				//include('addHostel.php'); }
				
													//}
					$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'SPRO' :
		            $content    = 'userprofile.php';		
		            break;

	                case 'SUP' :
		            $content    = 'changePass.php';		
		            break;
                    
                     case 'SIm' :
		            $content    = 'profile_image.php';		
		            break;
		            
		             case 'News' :
		            $content    = 'news.php';		
		            break;
		            
		              case 'Evt' :
		            $content    = 'Events.php';		
		            break;
		            case 'Nclearance' :
		            $content    = 'upload_c_files..php';		
		            break;
	                default :
		            $content    = 'userprofile.php';
				
                            }
                     require_once $content;
				
				?>
				                      	<?php
//function for getting member status
function getfac($get_RegNo)
{
//$query1 = mysql_query("select * from student where RegNo = '$get_RegNo' and validate = '3'")or die(mysql_error());
							//	$row2 = mysql_fetch_array($query1);
								//$nameclass=$row2['class'];
//$nameclass=$row['class'];
$query2_fac = @mysql_query("select fac_name from faculty where fac_id = '$get_RegNo' ")or die(mysql_error());
$count_fac = mysql_fetch_array($query2_fac);
 $nameclass2=$count_fac['fac_name'];
return $nameclass2;
}
  
?>
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>





            
            
          </div>
          
        </div>
        <!-- /page content -->
               <!-- /page content -->
        
   
        <!-- start  Staff details Pop up -->
 


   <?php include('footer.php'); ?>      