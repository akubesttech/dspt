<?php //if($_GET['o_id'] != md5($_SESSION['emailp'])){
//echo "<script>window.location.assign('apply_b.php?view=ep_view');</script>";
//} 
if(empty($_GET['id'])){$nvalue = $_SESSION['transide'];  }else{ $nvalue = $_GET['id'];}
$paystatus1=mysqli_query($condb,"SELECT * FROM payment_tb LEFT JOIN new_apply1 ON appNo = app_no WHERE md5(trans_id) ='".safee($condb,$nvalue)."'");
$paystatus12=mysqli_num_rows($paystatus1);
//if($paystatus12 < 1){ message("The page you are trying to access is not Available.", "error");
//redirect('apply_b.php?view=opay'); }
$dform_get2 = mysqli_fetch_assoc($paystatus1); $ftranid = $dform_get2['trans_id']; $sname = $dform_get2['FirstName'];$fname = $dform_get2['SecondName']; $oname = $dform_get2['Othername']; $fullname = $sname." ".$fname." ".$oname; $appNo = $dform_get2['appNo']; $feename = $dform_get2['ft_cat'];
$femail = $dform_get2['email']; $fphone = $dform_get2['phone']; $fprog = $dform_get2['prog'];$fsession = $dform_get2['session']; $pamount = $dform_get2['paid_amount']; $matno = $dform_get2['stud_reg'];
$feetp = $dform_get2['fee_type']; $famount  = $dform_get2['dueamount'];  $Pmode  = $dform_get2['pay_mode'];
$date20 = str_replace('/', '-', $dform_get2['pay_date'] );  $newDate20 = date("Y-m-d", strtotime($date20));
   $timestamp = strtotime($newDate20); $datetime	= date('l, jS F Y', $timestamp);
$paycomponent=mysqli_query($condb,"SELECT * FROM feecomp_tb  WHERE Batchno ='".safee($condb,$feetp)."' "); $serial=1;
	
?>
   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo host(); ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>
	<?php $ptitle = "STUDENT ".getfeecat($feename)." RECEIPT"; $ptitle2 = "STUDENT ".getftype($dform_get2['fee_type'])." RECEIPT"; ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
        <div  id="print_content">
            <div class="row">
                <div class="col-xs-12">
            <h3><font size="4"><?php if(empty($_GET['id'])){ ?> Payment Information Preview <?php }else{ ?>
		<?php if(substr($dform_get2['fee_type'],0,1) == "B"){echo strtoupper($ptitle); }else{  echo strtoupper($ptitle2); } }
        $smato = $row['smat'];//$smartcharge = 4000 ;
		if(!empty($matno)){ 
        if(!empty($smato)){ $note = " Username : <strong>$femail</strong>   "; $payuse = $matno; $mt = "Username :"; $vatype = $femail; }else{
		$note = " Your Matric No : <strong>$matno</strong>  <br>also Note that your Matric No Has been Mailed to you. "; $payuse = $matno;
        $mt = "Matric Number:"; $vatype = $matno; }
        }else{ $note = ""; $payuse = $appNo; $mt = ""; $vatype = "";//$smartcharge = 500 ;
        }
		?>
			</font> </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph"><?php if(empty($_GET['id'])){ ?><font color="red" size="4">Please Note That a debit card will be required at this stage to complete your payment.<br></font> <?php }else{ ?>
<font color="green" size="4">Your <?php echo getfeecat($feename); ?> Payment was Successful,<br><?php echo $note; ?></font> <?php } ?>
</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		
			    		<h4 class="panel-title"><font size="4"><small>Payment Reference </small> ( <?php echo $ftranid; ?> )</font> </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<div id="center">

		<div class="inner_right_demo">
	<!--	<form name="register2" action="https://voguepay.com/pay/" method="post" enctype="multipart/form-data" id="register2"> --!>
	 <form name="register2" action="finitialize.php" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type='hidden' name='v_merchant_id' value='demo' /> <!-- 9919-0054594 --!>
			
			<input type='hidden' name='merchant_ref3' value='<?php echo $ftranid;?>' />
			<!--<input type='hidden' name='notify_url' value='http://www.ucnettechnologies.net/notification.php' />
            <input type='hidden' name='success_url' value='https://64.71.77.20/SOMA/studregprint.php' />
             <input type='hidden' name='fail_url' value='http://www.ucnettechnologies.net/failed.php' /> --!>
            <input type='hidden' name='emailx' value='<?php echo $femail;?>' /> 
			<input type='hidden' name='total' value='<?php echo $famount ;?>' />
            <input type='hidden' name='ft_cat' value='<?php echo $feename;?>' />
            <input type='hidden' name='matno' value='<?php echo $payuse;?>' />
            <input type='hidden' name='sec' value='<?php echo $fsession;?>' />
			<div class="form_box">
			 <div class="clear" style="overflow: auto;">
        <table  border="1"><?php if(!empty($matno)){ ?>
       <tr class="row1"><td width="20%" colspan="1" height="15"><strong> <?php echo $mt; ?> </strong></td>
    <td width="31%" colspan="4"><?php echo $vatype; ?></td></tr><?php }else{ ?>
    <tr class="row1"><td width="20%" colspan="1" height="15"><strong> Application Number:</strong></td>
    <td width="31%" colspan="4"><?php echo $appNo; ?></td></tr><?php } ?>
  <tr class="row2">
  <td width="20%" colspan="1" height="15"><strong> Full Name:</strong></td>
    <td width="31%" colspan="4"><?php echo ucwords($fullname); ?></td>
    
    </tr>
    <tr class="row1">
  <td width="20%" colspan="1" height="20"><strong> Email:</strong></td>
    <td width="20%" colspan="2"><?php echo $femail ;// $_SESSION['emailp']; ?></td>
      <td width="20%" colspan="1" height="20"><strong> Mobile No:</strong></td>
    <td width="20%" colspan="1"><?php $fphonen = substr($fphone, 1,12); echo "+234".$fphonen ; //$_SESSION['mobile']; ?></td>
   </tr>
   <tr class="row2">
   <td width="20%" colspan="1" height="20"><strong> Payment Type:</strong></td>
    <td width="20%" colspan="2"><?php echo getfeecat($feename) ;// $_SESSION['emailp']; ?></td>
   <td width="20%" colspan="1" height="20"><strong> Academic Session:</strong></td>
    <td width="20%" colspan="1"><?php echo $fsession; ?></td> </tr>
   <tr class="row1">
    <td width="20%" colspan="1" height="20"><strong> Programme:</strong></td>
    <td width="20%" colspan="2"><?php echo getprog($fprog); //$_SESSION['ftype2']." Form" ;?></td>
     <td width="20%" colspan="1" height="20"><strong> Payment Mode:</strong></td>
    <td width="20%" colspan="1"><?php echo $Pmode; ?></td>
   </tr>
<tr class="row1"style="text-align: center;color:blue"> <td width="20%" colspan="5" height="20"><strong> Payment Details</strong></td></tr>

<tr class="row2" style="text-align: center;"> <th>S/N</th> <th colspan="2">ITEM</th> <th>Description</th> <th >Amount</th> </tr>
<?php  while($row_utme = mysqli_fetch_array($paycomponent)){ $ftypecon = $row_utme['feetype']; $amount = $row_utme['f_amount'];
$paysession = $row_utme['session']; $feecategory = $row_utme['fcat']; $penalty = $row_utme['penalty']; if($penalty > 0){ $pens = " ( penalty inclusive).";}else{ $pens ="";} ?>
 <tr class="row1" style="text-align: center;"> <td><?php echo $serial++ ; ?></td> <td colspan="2"><?php echo getftype($ftypecon) ;?></td> <td><?php echo "Payment Of " .getftype($ftypecon).$pens ;?><?php //echo getfeecat($feecategory).$pens ;?> </td> <td><?php echo " ".number_format($amount,2); ?>  </td> </tr>
   <?php	}  ?>
<tr class="row2" style="text-align: center;">
  <td width="20%" colspan="3" height="20"><strong> </strong></td>
  <td width="20%" colspan="1" height="20"><strong> Total:</strong></td>
    <td width="20%" colspan="1" style="text-shadow: 1px 0px #0000FF; text-decoration-style: solid; font-weight: bold;">&#8358; <?php echo " ".number_format($famount,2); ?></td>
    </tr>
<?php if(empty($_GET['id'])){ }else{ ?>	<tr class="row1" style="text-align: center;color:green"> <td width="20%" colspan="5" height="20"><strong><?php echo numtowords($pamount)." Naira Only. "; ?> </strong></td></tr> <?php } ?>
	 <tr class="row2">
    <td width="20%" colspan="1" height="20"><strong> Payment Date:</strong></td>
    <td width="20%" colspan="2"><?php echo $datetime ; ?></td>
     <td width="20%" colspan="1" height="20"><strong> Payment Status:</strong></td>
    <td width="20%" colspan="1"><?php echo  getpaystatus($dform_get2['pay_status']); ?></td>
   </tr>	
		<tr style="border-width: 0px;text-align:left;padding-top: 20px;">
          <td height="10" colspan="1"><div id="cccv" ><button name="Login_Reprint" class="btn btn-success" data-placement="right" type="submit" title="Click to Download Payment Slip" style="display:none;">Download Payment Slip</button>&nbsp;&nbsp;&nbsp;
		  <button name="eprinte" class="btn btn-primary" data-placement="right" type="button" title="Click to Print" onClick="return Clickheretoprint();" >Print</button></div>
		  </td>
            <td height="10" colspan="1" id="ccc2"><?php if(empty($_GET['id'])){  ?>&nbsp;<button name="Login_Reprint" class="btn btn-primary" data-placement="right" type="submit" title="Click to Make Payment">Pay Now</button><?php }else{}?></td>
          <td  height="10" colspan="3" id="ccc3">
          <img src="css/images/epaylogo.png" width="224" height="50"></a>
        </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
    
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
             </div>
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
            
   <!-- <div class="apply-box">
        <a class="btn btn-default expand padding-md" href="https://applyalberta.ca/APAS.Web.Public/ApplicationServices/default.aspx?StartingAction=ApplyNow">APPLY NOW</a>
    </div> --!>

 <?php include("sidenews.php"); ?>
</div>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
  