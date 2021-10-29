
<?php  include('header.php'); ?>
<?php include('session.php');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
///if(($admin_accesscheck == "1") or ($admin_accesscheck == "6")) {
	//}else{echo "<script>alert('Access Not Granted To This User Please Contact System Administrator!');</script>";
		//redirect("index.php");}
		$status = FALSE;
if ( authorize($_SESSION["access3"]["fIn"]["conp"]["create"]) || 
authorize($_SESSION["access3"]["fIn"]["conp"]["edit"]) || 
authorize($_SESSION["access3"]["fIn"]["conp"]["view"]) || 
authorize($_SESSION["access3"]["fIn"]["conp"]["delete"]) ) {
 $status = TRUE;
}
$dep1 = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$sec1 = isset($_GET['session2']) ? $_GET['session2'] : '';
$los =  isset($_GET['dop']) ? $_GET['dop'] : '';
$edate =  isset($_GET['dop2']) ? $_GET['dop2'] : '';
//$dep1 = $_GET['dept1_find']; $sec1 = $_GET['session2']; $los 	= $_GET['dop'];
if(empty($dep1)){ $links = "View_Payment.php";}else{ $links = "View_Payment.php?dept1_find=".$dep1."&session2=".$sec1."&dop=".$los;}
 ?>
	
		    	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
		if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
}
	 ?>
  <?php $get_RegNo = isset($_GET['userId']) ? $_GET['userId'] : '';
  $viewn =  isset($_GET['view']) ? $_GET['view'] : '';
  
   ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>Payment Management
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
				
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2><?php  if($viewn == "s_p"){ echo "Search Payment Records" ;}if($viewn == ""){
echo "List of Payment (s)";}if($viewn == "v_p"){echo "View Payment Records";} ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                    	<?php 
					 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                   case 'v_p' :
		            $content    = 'viewPaylist.php';		
		            break;
		            case 's_p' :
		            $content    = 'searchPay.php';		
		            break;
	                default :
		            $content    = 'paylist.php';
				//statusUser2();
                            }
                     require_once $content;
                    
					//$num=$get_RegNo;
				//if ($num!==null){
			//include('editStaff.php');
			//}else{
			
			//	include('addStaff.php'); }?>
                    
                    
                    
                    
                  </div>
                </div>
              </div>



            
            
          </div>
       
        <!-- /page content -->
        
        
        <?php 
if(isset($_GET['details'])){

?>

<script>
    $(document).ready(function(){
        $('#myModal5').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal5').fadeOut('fast');
            windows.location = "View_Payment.php";
        })
    })

</script>

<?php }?>
        <!-- start  Staff details Pop up -->
<?php //if(isset($_GET['choose_patient'])){ ?>
 
    <?php
$user_query = mysqli_query($condb,"select * from payment_tb  where trans_id ='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
$row_b = mysqli_fetch_array($user_query); $student_num = $row_b['stud_reg']; $app_number = $row_b['app_no'];
 $feetype = $row_b['fee_type']; $existt = imgExists($row_b['teller_img']); $encryptid = md5($get_RegNo);
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_b['ft_cat']);}else{ $feet = getftype($row_b['fee_type']);}

if(empty($student_num)){ 
$sql2 = "SELECT * FROM new_apply1 left join payment_tb ON payment_tb.app_no = new_apply1.appNo WHERE  appNo ='".safee($condb,$app_number)."' and md5(trans_id) ='".safee($condb,$encryptid)."' ";
}else{ $sql2 = "SELECT * FROM student_tb left join payment_tb ON payment_tb.stud_reg = student_tb.RegNo WHERE  stud_reg ='".safee($condb,$student_num)."' and md5(trans_id) ='".safee($condb,$encryptid)."' ";} 
if(!$qsql1=mysqli_query($condb,$sql2)) { echo mysqli_error($condb); } $rsprint1 = mysqli_fetch_array($qsql1);$feecategory = $rsprint1['ft_cat'];
$chot = $rsprint1['rsprint1'];	$facultyone = $rsprint1['Faculty']; 
if($chot > 1){   $adep = $rsprint1['fact_2'];   }else{ $adep = $rsprint1['fact_2'];}					
?>	

<div id="myModal5" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                          
<a href="javascript:void(0);" onclick="window.open('<?php echo $links;?>','_self')" class="close"><span aria-hidden="true"></i>x</span> </a>
                        
                          <h4 class="modal-title" id="myModalLabel">Student Payment Information </h4>
                        </div>
                        
    
		<div >
<?php
//$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM student_tb where appNo='".safee($condb,$app_number)."' OR RegNo='".safee($condb,$student_num)."'"));  
$existp = imgExists("../Student/".$rsprint1['images']);
?>
<div class="col-sm-12" style="overflow:auto;height:450px;" >
<div class="left col-xs-10">
	<form method="post"  action="" enctype="multipart/form-data" >
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?>" />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<center><?php
//if($resi == 1){echo "<label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label>";
					//echo " $res";}
?>

</center>
	<h4 class="brief" style="text-shadow:-1px 1px 1px #000;"> <font color='darkblue'><?php
	if($row_b['stud_reg']==Null){echo "Application No : " .ucfirst($row_b['app_no']);}else{
	 echo "Matric No : " .ucfirst($row_b['stud_reg']) ;}?>  </font></h4>
	 
<h2 style="text-shadow:-1px 1px 1px #000; color:blue;">Student Name in Full: <b><?php if($row_b['stud_reg']==Null){echo ucwords(getname($row_b['app_no']));}else{ echo ucwords(getname($row_b['stud_reg']));} ?></b> </h2>

<p><strong><?php echo $SCategory; ?>: </strong><?php if($student_num > 0){ echo getfacultyc($facultyone);}else{ echo getfacultyc($adep); } ?>&nbsp;<strong><?php echo $SGdept1; ?>: </strong> <?php if($row_b['stud_reg']==Null){echo getdeptc(getDep($row_b['app_no']));}else{ echo getdeptc(getDep($row_b['stud_reg']));}?> <strong>&nbsp;&nbsp;&nbsp;Level: </strong> <?php echo getlevel($row_b['level'],$class_ID) ;?>  </p>


<h2 style="text-shadow:-1px 1px 1px #000;">Payment Details:  </h2>
<p><strong>Payment Type: </strong> <?php echo $feet ;?><strong>&nbsp;&nbsp;&nbsp;Payment Mode: </strong> <?php echo $row_b['pay_mode'] ;?><strong>&nbsp;&nbsp;&nbsp;Transaction ID: </strong> <?php echo $row_b['trans_id'] ;?></p>
<?php  if($row_b['pay_mode']=='Paycard'){?>
<p><strong>Bank Name: </strong> <?php echo $row_b['bank_name'] ;?><strong>&nbsp;&nbsp;&nbsp;Teller No: </strong> <?php echo $row_b['teller_no'] ;?><strong>&nbsp;&nbsp;&nbsp;Pin Used: </strong> <?php echo $row_b['pin'] ;?><strong>&nbsp;&nbsp;&nbsp;Amount: </strong> <?php echo $row_b['paid_amount'] ;?><strong>&nbsp;&nbsp;&nbsp;Date Of Payment: </strong> <?php echo $row_b['pay_date'] ;?></p><?php }else{ ?>
<p><strong> Amount: </strong><span class='badge bg-green'><?php echo number_format($row_b['paid_amount'],2) ;?></span><strong>&nbsp;&nbsp;&nbsp;Date Of Payment: </strong> <?php echo $row_b['pay_date'] ;?></p>
<?php } ?>
<div id="show"><a class="btn btn-info" ><i class="fa fa-list"></i>&nbsp;Click to Show/ Hide Fee Components </a></div>
 <div class="menu" style="display: none;"><table  border ="1" style="margin:5px; font-size:15px;  font-weight:bold; width:750px;">
 <thead><tr height="30" width="200" style="background-color:lightblue;box-shadow: 2px 2px gray;color: #000080;">
                         <th>S/N</th><th>Item</th>
                         <th> Description</th>
                          <th>Amount Paid</th></tr>
                      </thead><?php 
      $serial=1; $i = 0;
if(mysqli_num_rows($qsql1)==0){
        echo " <tr style=\"background-color:#CFF\">
          <td colspan=\"4\" height=\"30\">No payment Found For This Session</td> 
        </tr>"; }else{ //$rsprint1 = mysqli_fetch_array($qsql1);
		 $feetp = $rsprint1['fee_type']; $transession = $rsprint1['session']; $fcate = $rsprint1['ft_cat'];  ?>
     <?php if(substr($feetp,0,1) == "B"){ $paycomponent=mysqli_query($condb,"SELECT * FROM feecomp_tb  WHERE Batchno ='".safee($condb,$feetp)."' and pstatus = '1' ");
$serial=1;		 while($row_utme = mysqli_fetch_array($paycomponent)){
    if ($i%2) {$classo1 = 'row1';} else {$classo1 = 'row2';}$i += 1;
$ftypecon = $row_utme['feetype']; $amount = $row_utme['f_amount'];
$paysession = $row_utme['session']; $feecategory = $row_utme['fcat']; $penalty = $row_utme['penalty']; if($penalty > 0){ $pens = " ( penalty inclusive).";}else{ $pens ="";} ?>
  <tr  class="<?php echo $classo1; ?>" align="center" height="30" width="30" > <td><?php echo $serial++; ?></td>
<td><?php echo getftype($ftypecon) ;?></td> <td><?php echo "Payment Of " .getftype($ftypecon)." For ".$transession ;?></td>
<td><?php echo number_format($amount,2); ?></td>   </tr> <?php	}}else{  ?>
	<tr  align="center" height="30" width="30" class="row1" > <td><?php echo $serial++; ?></td>
                      <td><?php echo getftype($feetp) ;?></td>
                        <td><?php echo "Payment Of " .getftype($feetp)." For ".$transession ;?></td>
                          <td><?php echo number_format($rsprint1['paid_amount'],2); ?></td>   </tr> <?php }} ?>
                          <tfoot>
    <tr class="row2" height="30"> <td colspan="3"><strong>Total Amount Paid:</strong></td>
<td align='center' ><strong><font color="green">&#8358;<?php echo number_format($rsprint1['paid_amount'],2); ?></font></strong></td></tr>
<tr class="row1"><td colspan="4" height="30" align='center' style="font-color:gray; font-weight:normal;"><strong>
<?php echo numtowords($rsprint1['paid_amount'])." Naira Only. "; ?></strong></td></tr>
 </tfoot>
  </table>
 </div>
<?php if ($existt > 0){?>
<h2 style="text-shadow:-1px 1px 1px #000;">File Attachment:  </h2>
<p><div class="zoomin"><img src="<?php   if ($existt > 0 ){print $row_b['teller_img'];}else{ print "NO-IMAGE-AVAILABLE.jpg";}?>" alt="Teller image atteched" class="img-rectangle" height="190" width="190" ></div>
</p><?php }?>

<h2 style="text-shadow:-1px 1px 1px #000;">Other Remarks:  </h2>

<p> <strong>Payment Remark: </strong> <?php if($row_b['pay_status']=='1'){
echo "Approved";}else{echo "Not Approved";} ;?></p>
</div>
<div class="right col-xs-2 text-center" >
<img src="../Student/<?php   if ($existp > 0 ){print $rsprint1['images'];}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}?>" alt="" class="img-circle img-responsive" height="190" width="190" >
</div>
</div>
	<div class="modal-footer">
<a href="javascript:void(0);" onclick="window.open('<?php echo $links;?>','_self')" class="btn btn-info" ><i class="fa fa-remove"></i>&nbsp;Close</a>
				<!--	<a href="javascript:changeUserStatus2(<?php //echo $get_RegNo; ?>, '<?php //echo $is_active; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php //echo $is_active == 'FALSE'? 'Not Verified' : 'Verified'; ?></a> --!>
					
						  <script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div></form></div>
					 </div>
                 </div></div><?php //} ?>
<!-- end  Modal -->
<?php 




        ?>
      
         <?php include('footer.php'); ?>