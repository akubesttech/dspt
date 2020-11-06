
<?php  include('header.php'); ?>
<?php include('session.php'); 
//if(($admin_accesscheck == "1") or ($admin_accesscheck == "2")) {
	//}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
	//	redirect("index.php");}
	$status = FALSE;
if ( authorize($_SESSION["access3"]["fIn"]["forms"]["create"]) || 
authorize($_SESSION["access3"]["fIn"]["forms"]["edit"]) || 
authorize($_SESSION["access3"]["fIn"]["forms"]["view"]) || 
authorize($_SESSION["access3"]["fIn"]["forms"]["delete"]) ) {
 $status = TRUE;
}
 $sprog2 =  isset($_GET['xpo']) ? $_GET['xpo'] : '';
  $sec1 =  isset($_GET['xsec']) ? $_GET['xsec'] : '';
   $daten =  isset($_GET['xdop']) ? $_GET['xdop'] : '';
//$sprog2 = $_GET['xpo']; $sec1 = $_GET['xsec']; $daten 	= $_GET['xdop'];
if(empty($sprog2)){ $links = "formSales.php?view=fDetails";}else{ $links = "formSales.php?view=fDetails&xpo=".$sprog2."&xsec=".$sec1."&xdop=".$daten;}
 ?>

	
<script type="text/javascript">

$(document).ready(function() {   
$('#categ2').change(function(){   
if($('#categ2').val() === '2'){  $('#enable3').hide(); $('#enable4').hide(); $('#enable1').show(); $('#enable2').show(); $('#enable5').show();$('#enable6').hide(); }else if ($('#categ2').val() === '1') {   
$('#enable1').hide(); $('#enable2').hide(); $('#enable3').show(); $('#enable4').show(); $('#enable6').hide(); $('#enable5').hide();}else if($('#categ2').val() === '3'){ $('#enable5').show(); $('#enable1').hide(); $('#enable2').hide();  $('#enable3').hide(); $('#enable4').hide();$('#enable6').hide(); }else if ($('#categ2').val() === '4') { 
$('#enable3').hide(); $('#enable4').hide(); $('#enable1').show(); $('#enable2').show(); $('#enable5').show();$('#enable6').show();  
}else {   $('#enable5').hide(); $('#enable1').hide(); $('#enable2').hide();  $('#enable3').hide(); $('#enable4').hide();$('#enable6').hide(); }      
});   
});   
</script>
 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	 ?>
  <?php $get_RegNo= isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3><?php  if($_GET['view'] == "formOrder"){ echo "Forms Panel" ;}if($_GET['view'] == "fDetails"){
echo "Forms Panel";}if($_GET['view'] == "sledger"){echo "Student Ledger";}if($_GET['view'] == "Reportmain"){echo "Payment Report (s)";} ?>
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
                	case 'formOrder' :
		            $content    = 'sforder.php';	
		            break;
                    case 'fDetails' :
		            $content    = 'formorderlist.php';		
		            break;
		             case 'sledger' :
		            $content    = 'sspayledger.php';		
		          		break;
		             case 'ledger' :
		            $content    = 'payledger.php';		
		          			break;
		             case 'Reportmain' :
		            $content    = 'reportmain.php';		
		          	break;
		          	case 'Greport' :
		            $content    = 'Greport.php';		
		          	break;
		          	case 'Report' :
		            $content    = 'reporttime.php';		
		          	break;
	                default :
		            $content    = 'formorderlist.php';
                            }
                     require_once $content;
				?>

                
                
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
               <!-- /page content -->
        
    <?php 
if(isset($_GET['details'])){

?>

<script>
    $(document).ready(function(){
        $('#myModala5').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModala5').fadeOut('fast');
            windows.location = "formSales.php?view=fDetails";
        })
    })

</script>

<?php }?>
  
 <?php
$get_userid= isset($_GET['userId']) ? $_GET['userId'] : '';
$user_query = mysqli_query($condb,"select * from fshop_tb  where  form_id ='".safee($condb,$get_userid)."'")or die(mysqli_error($condb));
													$row_b = mysqli_fetch_array($user_query);
												    $student_num = $row_b['stud_reg'];
												    $app_number = $row_b['app_no'];
$forderquery = mysqli_query($condb,"select fpay_status,fpamount from fshop_tb where fpay_status > 0 and fpamount > 0 and form_id ='$get_userid' ")or die(mysqli_error($condb));
$countpay = mysqli_num_rows($forderquery);
													?>	

<div id="myModala5" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
    <a href="javascript:void(0);" onclick="window.open('<?php echo $links;?>','_self')"class="close"><span aria-hidden="true"></i>x</span> </a>
<h4 class="modal-title" id="myModalLabel">Form Order Information </h4></div>
<div class="modal-body2">
<div class="col-sm-12">
<div class="left col-xs-10">
	<form method="post"  action="" enctype="multipart/form-data" >
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?>" />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<center></center>
	<h4 class="brief" style="text-shadow:-1px 1px 1px #000;"> <font color='darkblue'><?php
	echo "Reference No : " .ucfirst($row_b['ftrans_id']);?>  </font></h4>
	 <h2 style="text-shadow:-1px 1px 1px #000; color:blue;">Full Name: <b><?php echo ucwords($row_b['fsname']." ".$row_b['foname']); ?></b> </h2>
<p><strong>Email Address: </strong> <?php echo ($row_b['femail']);?> <strong>&nbsp;&nbsp;&nbsp;Mobile Number: </strong> <?php echo ($row_b['fphone']) ;?>  </p>
<p><strong>Programme: </strong>  <?php echo getprog($row_b['ftype']) ;?> <strong>&nbsp;&nbsp;&nbsp;Order Type: </strong> <?php echo getftype($row_b['feen']);?><strong>&nbsp;&nbsp;&nbsp;Session: </strong> <?php echo ($row_b['session']);?>  </p>
<h2 style="text-shadow:-1px 1px 1px #000;">Payment Details:  </h2>
<p><strong>Due Payment: </strong> <?php echo number_format($row_b['famount'],2) ;?><strong>&nbsp;&nbsp;&nbsp;Amount Paid: </strong> <?php echo number_format($row_b['fpamount'],2) ;?><strong>&nbsp;&nbsp;&nbsp;Transaction Date: </strong> <?php echo $row_b['fdate_paid'] ;?> <strong>&nbsp;&nbsp;&nbsp;Payment Status: </strong> <?php 
if($countpay > 0){ echo getpaystatus($row_b['fpay_status']);}else{echo getpaystatus("0");} ;?></p>
<h2 style="text-shadow:-1px 1px 1px #000;">Pin Details:  </h2>
<?php if($countpay > 0){?>
<p><strong>Pin No: </strong> <?php echo $row_b['pin'] ;?><strong>&nbsp;&nbsp;&nbsp;Serial No: </strong> <?php echo $row_b['serial'] ;?></p><?php }else{ ?>
<p><strong> <font color="red"> Pin not available because of incomplete payment </font> </strong></p>
<?php } ?>
</div>

</div>
	<div class="modal-footer">
<a href="javascript:void(0);" onclick="window.open('<?php echo $links;?>','_self')"  class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
				<!--	<a href="javascript:changeUserStatus2(<?php //echo $get_RegNo; ?>, '<?php //echo $is_active; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php //echo $is_active == 'FALSE'? 'Not Verified' : 'Verified'; ?></a> --!>
					
						  <script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div>
					
					</form>
				
					
		</div>
					 </div>
                 
				    </div>
</div><?php //} ?>
<!-- end  Modal -->
  
         <?php include('footer.php'); ?>