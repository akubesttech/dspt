

   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        
<?php 

$paykey = $_GET['p_id'];
$enableinst = setinstallment;
$user_queryst = mysqli_query($condb,"select * from new_apply1 where MD5(appNo) = '".safee($condb,$paykey)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);$dfalpp_checkexist2 = mysqli_num_rows($user_queryst);
if($dfalpp_checkexist2 < 1){ message("The page you are trying to access is not Available.", "error"); redirect('apply_b.php?view=M_P'); }
$states = $user_rowstate['state'];$sprog = $user_rowstate['app_type'];$entrymodel = getelevel($user_rowstate['moe']);
$student_s = "Delta";  $apno1 = $user_rowstate['appNo']; $admitsec = $user_rowstate['Asession'];
if($states == $student_s){ $scan = "1";}else{ $scan = "0";} 
$qfcompn=mysqli_query($condb,"select * from feecomp_tb where  prog = '".safee($condb,$sprog)."' and fcat = '1' and level ='".safee($condb,$entrymodel)."' and regno = '".safee($condb,$apno1)."'") or die(mysqli_error($condb));  
$countcmp = mysqli_num_rows($qfcompn);

//$querycomp = mysqli_query($condb,"select * from fee_db where ft_cat ='1' and level= '".safee($condb,$entrymodel)."' and program='".safee($condb,$sprog)."' 
//and cat_fee ='".safee($condb,$scan)."' ") or die(mysqli_error($condb));




// check if paid acceptance
 $sql_cstudent = mysqli_query($condb,"SELECT * FROM student_tb WHERE appNo = '".safee($condb,$apno1)."'");
$contstate = mysqli_num_rows($sql_cstudent); $res = mysqli_fetch_array($sql_cstudent); $matx = $res['RegNo'];
if(empty($matx)){$pn = $apno1; $ft = "8";}else{$pn = $matx; $ft = "1";} 
 $laspdate = getlpdate($pn,$ft,$sprog,$entrymodel,$admitsec,$scan);
  $sumpay1 = getpayamt($pn,$ft,$sprog,$entrymodel,$admitsec); //$warning_data['samount']; 
 $duep1 = getDueamt($ft,$sprog,$entrymodel,$scan);
  
$que_paid = "select SUM(paid_amount) as samount,ft_cat from payment_tb where session ='".safee($condb,$admitsec)."' and pay_status='1' and  level = '".safee($condb,$entrymodel)."' and prog = '".safee($condb,$sprog)."' ";
  if(empty($matx)){$que_paid .= " and app_no = '".safee($condb,$apno1)."' and ft_cat = '4'";}else{ $que_paid .= " and stud_reg ='".safee($condb,$matx)."' and ft_cat = '1'"; }
  $que_checkpay = mysqli_query($condb,$que_paid)or die(mysqli_error($condb));
  $warning_count2=mysqli_num_rows($que_checkpay);$warning_data=mysqli_fetch_array($que_checkpay);  $fc = $warning_data['ft_cat'];  
 $sumpay = getpayamt($pn,$fc,$sprog,$entrymodel,$admitsec); //$warning_data['samount']; 
  $duep = getDueamt($fc,$sprog,$entrymodel,$scan);
$Bno = 0;$s=8;while($s>0){ $Bno .= rand(0,9);$s-=1; } $batchno = "B".$Bno;
  
if (isset($_POST['addpayment'])){ $date_now =  date("Y-m-d"); $tp = $_POST['tp']; $tcp = $_POST['tcp'];
	 if(empty($_POST['selector'])){
				message("You have not selected any Payment Component !", "error");
		        redirect('apply_b.php?view=lpay&p_id='.$paykey);
		        //}elseif($countcmp < $nocomp){
		       }elseif(count($_POST['selector']) < $tcp){
		        	message("Selected Fee Components are required to Continue !", "error");
		        redirect('apply_b.php?view=lpay&p_id='.$paykey);
				}else{ $id=$_POST['selector'];  $N = count($id); $npay = 0; $crec = 0;$finalpay = 0;
for($i=0; $i < $N; $i++){ 
$sfcom = mysqli_query(Database::$conn,"select * from fee_db where fee_id ='".$id[$i]."' ")  or die(mysqli_error(Database::$conn)) ; 
$crec += mysqli_num_rows($sfcom);
$row = mysqli_fetch_array($sfcom); extract($row);$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d",strtotime($date20));
$setend2 = $edate;
$edate20 = str_replace('/', '-', $setend2 );
$nedate = date("d-m-Y", strtotime($edate20)); $timestamp2 = strtotime($nedate);
$date_now2 = new DateTime(); $enddate    = new DateTime($nedate); //$date_now >= $newDate20 
 if($pper > 0 and $date_now2 < $enddate){ $penaltysum = FeesCalc($f_amount,$pper,$newDate20); $pen1 = "1"; $npay += FeesCalc($f_amount,$pper,$newDate20); }else{ $penaltysum = $f_amount; $pen1 = "0"; $npay += $f_amount;}
$apay = getpayamt($apno1,$ft_cat,$program,$level,$admitsec,$feetype);
$dpay = getDueamt($ft_cat,$program,$level,$Cat_fee,$feetype);
if($apay < $dpay){ $finalpay = $dpay - $apay; }else{  $finalpay = $penaltysum;   }
$qfcomp=mysqli_query(Database::$conn,"select * from feecomp_tb where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$apno1)."'") or die(mysqli_error($condb));
 $inst = getinstalment($tp,$enableinst,$npay); //." ".$npay." ".$inst." ".$crec
//if(($inst > $npay )){ message("Your Payment installment should not be lessthan &#8358;".number_format($inst,2)." ".$npay." ".$inst." ".$crec, "success");
		       //redirect('apply_b.php?view=lpay&p_id='.$paykey); }else{
if(mysqli_num_rows($qfcomp)>0){if($ft_cat == "4"){
$queryin = mysqli_query($condb,"insert into feecomp_tb(regno,feetype,prog,level,f_amount,fcat,penalty,session,Batchno)values('".safee($condb,$apno1)."','".safee($condb,$feetype)."','".safee($condb,$program)."','".safee($condb,$level)."','".safee($condb,$finalpay)."','".$ft_cat."','".$pen1."','".safee($condb,$admitsec)."','".safee($condb,$batchno)."')")or die(mysqli_error($condb));
}else{ $resultapp = mysqli_query($condb,"UPDATE feecomp_tb SET f_amount ='".safee($condb,$finalpay)."',session = '".safee($condb,$admitsec)."',Batchno = '".safee($condb,$batchno)."'  where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and penalty = '".$pen1."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$apno1)."'")or die(mysqli_error($condb));
}}else{
$queryin = mysqli_query(Database::$conn,"insert into feecomp_tb(regno,feetype,prog,level,f_amount,fcat,penalty,session,Batchno)values('".safee($condb,$apno1)."','".safee($condb,$feetype)."','".safee($condb,$program)."','".safee($condb,$level)."','".safee($condb,$finalpay)."','".$ft_cat."','".$pen1."','".safee($condb,$admitsec)."','".safee($condb,$batchno)."')")or die(mysqli_error($condb));
}
	message("Select Other Payment Details  ", "success");
redirect('apply_b.php?view=opay&id='.$batchno);
//}

  }}}
 
//-----------------------------------------------load fees
 if($sumpay1 >= $duep1 ){ $catp = "1"; }else{  $catp = "8"; } 
 $fee_query = "select * from fee_db where level = '".safee($condb,$entrymodel)."' and program = '".safee($condb,$sprog)."' ";
  if($contstate < 1 OR $sumpay < $duep){$fee_query .= " and ft_cat = '4' and Cat_fee = '".safee($condb,$scan)."'";}else{ 
   if($laspdate < 1 ){ $fee_query .= " and Cat_fee = '".safee($condb,$scan)."' and ft_cat = '1'"; }else{
  $fee_query .=" and Cat_fee = '".safee($condb,$scan)."' and ft_cat = '".safee($condb,$catp)."'";}}
  $fee_query .= "order by f_amount ASC ";
  $viewfee_query = mysqli_query($condb,$fee_query)or die(mysqli_error($condb));
 //echo $nocomp2 = mysqli_num_rows($viewfee_query);

 $queryp = "select * from fee_db where level= '".safee($condb,$entrymodel)."' and program='".safee($condb,$sprog)."' ";
if($contstate < 1 OR $sumpay < $duep){$queryp .= " and ft_cat = '4' and Cat_fee = '".safee($condb,$scan)."'";}else{
    if($laspdate < 1 ){ $queryp .= " and Cat_fee = '".safee($condb,$scan)."' and ft_cat = '1'"; }else{
  $queryp .=" and Cat_fee = '".safee($condb,$scan)."' and ft_cat = '".safee($condb,$catp)."'";}}
  if(!empty($enableinst)){$queryp .= " and status = '1'  ";}
  $querycomp = mysqli_query($condb,$queryp)or die(mysqli_error($condb));
  
 $nocomp = mysqli_num_rows($querycomp); 

?>
<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="apply_b.php?view=M_P">Back</a> </li>
</ul></section></div></div> </div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Payment Panel For Newly Admitted Students  </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph"><?php  
$laspdate2 = getlpdate($pn,$ft,$sprog,$entrymodel,$admitsec,$scan,"1") ;
if($contstate > 0){?>
<?php if($laspdate < 1 ){  }else{ ?>
<font color="red">Penalty Charges is Active For Late Payment <?php  
$dtn2 = str_replace('/', '-', $laspdate2 );  $ldt = date("Y-m-d", strtotime($dtn2));  
$timestampo = strtotime($ldt); 
echo " Starting From : ". date('jS M Y',$timestampo); ?>.</font><br>
<?php } ?>
Please Select the Fee (s) you which to pay and Click <strong> Add Payment </strong> Button to continue.
 Note that Checked Payment(s) are required to proceed. <?php }else{ ?>
You'ar About to Pay acceptance Fee to Validated your Admission, Click <strong> Add Payment </strong> Button to continue.<?php } ?>
 <br> Note that Once Acceptance Fee is Successful you can pay other FEES</p>

                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
	<h4 class="panel-title">Listed Below are Your Due Payment(s)  </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    		<table id="customers">
  <tr>
  <th></th>
  <th>S/N</th>
  <th>Payment Description</th>
    <th>Amount ( &#8358; )</th>
    <th>Pay Status</th>
    

  </tr>
   <?php //$date_now =  date("Y-m-d");
//$user_query = mysqli_query($condb,"select * from form_db where f_end >='".$date_now."' Order by session ASC")or die(mysqli_error($condb)); 
$ccomp = mysqli_num_rows($viewfee_query);
if($ccomp > 0)
    {
$number = 1;$sumcredit = 0;
while($row_s = mysqli_fetch_array($viewfee_query)){ $enablestatus = $row_s['status'];
$Fee_type1 = $row_s['feetype'];  $Fee_cat = $row_s['ft_cat'];  $proga = $row_s['program'];$cat = $row_s['Cat_fee'];
$spay = getpayamt($pn,$Fee_cat,$proga,$entrymodel,$admitsec,$Fee_type1);
$dpay = getDueamt($Fee_cat,$proga,$entrymodel,$cat,$Fee_type1);
if(($Fee_cat == "1" OR $Fee_cat == "8")  AND $enablestatus > 0 OR $contstate < 1){ $check_c =" Checked";  }else{ $check_c ="";  }
$paysid = $row_s['fee_id']; $dperc = $row_s['pper']; 
$psdate = $row_s['psdate']; $famount =$row_s['f_amount']; $setend2 = $row_s['edate'];
$edate20 = str_replace('/', '-', $setend2 );
$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d", strtotime($date20));  $date_now =  date("Y-m-d");
$penaltysum = FeesCalc($famount,$dperc,$newDate20); $difp = $penaltysum - $famount ;

$nedate = date("d-m-Y", strtotime($edate20)); $timestamp2 = strtotime($nedate);
$date_now2 = new DateTime(); $enddate    = new DateTime($nedate);
if($dperc > 0 and $date_now2 < $enddate){ $noteo = ", Note:  (".$dperc."% penalty inclusive ) ".number_format($famount,2) ." + ". number_format($difp,2) ." = ".number_format($penaltysum,2); $namount = $penaltysum; }else{ $noteo = ""; $namount = $row_s['f_amount'];  } 

$qpaycomp = mysqli_query($condb,"SELECT pstatus FROM feecomp_tb  WHERE regno = '".safee($condb,$pn)."'  AND session = '".safee($condb,$admitsec)."' AND level = '".safee($condb,$entrymodel)."' AND feetype = '".safee($condb,$Fee_type1)."'");
$row_paycomp = mysqli_fetch_array($qpaycomp);  $statuspay = $row_paycomp['pstatus'];
								//$date_now = date("Y-m-d");
								//echo json_encode($row_paycomp['regno']);	?>
<!-- <tr onclick="window.location='www.google.com';"> --!>
<?php //$url2 = "http://localhost/DSC/DSCHT/apply_b.php?view=p_sh&main=".md5($id);  ?>
<tr>

                	<?php if($statuspay > 0 AND $spay >= $dpay){$t_namount = $namount;  }else{ $t_namount = $namount - $spay; }
                	if($statuspay > 0 AND $spay >= $dpay){ 
							$status = 'Paid';
							 ?>
							<td width="30" style="text-align:centre;"  >
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $t_namount; ?>"   value="<?php echo $row_s['fee_id']; ?>" disabled >  
                        
													</td> <?php }else{ if($Fee_cat =="1"){$status = 'Not Paid';}else{
$status ="Not Paid"; //'<a rel="tooltip"  title="Click to Conutinue Payment" id="delete1" href="Spay_manage.php?view=m_sp&id='.md5($paysid).'" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle icon-large" > Add Payment</i></a>';
}?>
<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox"  class="uniform_on1" name="selector[]" type="checkbox" payamt="<?php echo $t_namount; ?>"  value="<?php echo $row_s['fee_id']; ?>" <?php echo $check_c ;?> >
													</td><?php } ?>
<td><?php echo $number; ?></td>
    <td><?php if($statuspay > 0 AND $spay >= $dpay){ echo "<font color='green'>".getftype($row_s['feetype'])." ".$noteo." </font>   ";
	}else{echo "<font color='red'>".getftype($row_s['feetype'])." ".$noteo."</font> ";}
					 ?></td>
    <td style="text-align:center;"><?php echo number_format($t_namount,2); ?></td>
    <td><?php echo $status; ?></td>
    </tr> 
   <?php $number++;  $sumcredit += $t_namount; }  }else{ $sumcredit = 0; ?>
    <tr><td colspan="5">No School Payment (s) Found at this time Please Check back later! </td></tr>
   <?php  } ?>
  <tr><td colspan="3"><strong>Total Amount: </strong></td>
   <td style="text-align:center;"><strong> &#8358; <span id="tots"><?php if($sumcredit > 0){ echo number_format($sumcredit,2);}else{echo "0.00";} ?></span></strong></td>
   <td colspan="1"></td></tr>
   <input type="hidden" name="tp" value="<?php echo $sumcredit;?> " />
   <input type="hidden" name="tcp" value="<?php echo $nocomp; //echo  $ccomp;?> " />
   <?php $inst2 = getinstalment($sumcredit,$enableinst,$sumcredit); if($contstate > 0){ 
   if(empty($matx)){?>
  <tr><td colspan="5" style="color: red;"><?php if($ccomp > 1){ ?>
   Please Note that the Minimum Payment installment is <b><?php echo "&#8358; ".number_format($inst2,2)."</b> for $enableinst installments";} ?>
    </td></tr>
    <?php }else{ ?>
    <tr><td colspan="5" style="color: green;">Please Note that you can now pay with your student account using you New Matric No to Login  </td></tr>
   <?php } } ?>
</table><?php  if(empty($matx)){ ?>	
<button name="addpayment" class="btn btn-primary" data-placement="right" type="submit" title="Click to add Payment and Conutinue">Add Payment</button> <?php }else{ ?>

<?php } ?>
<?php if($contstate > 0){ ?><button name="pslip" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Reprint Payment Receipt " onClick="window.location.href='apply_b.php?view=pay&p_id=<?php echo $paykey ; ?>';">Pay Receipt</button>		
<button name="adminletter" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Reprint Admission Letter " onClick="window.location.href='studentaletter.php?p_id=<?php echo $paykey; ?>';">Admission Letter</button>		
<?php } ?>			    		
                        </form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
            <!-- right feature space -->
  
 <?php include("sidenews.php"); ?>
</div>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
  