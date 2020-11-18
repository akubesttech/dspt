

   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        
<?php 
$paykey = $_GET['p_id'];
$user_queryst = mysqli_query($condb,"select * from new_apply1 where MD5(appNo) = '".safee($condb,$paykey)."'")or die(mysqli_error($condb));
$user_rowstate = mysqli_fetch_array($user_queryst);$dfalpp_checkexist2 = mysqli_num_rows($user_queryst);
if($dfalpp_checkexist2 < 1){ message("The page you are trying to access is not Available.", "error"); redirect('apply_b.php?view=M_P'); }
$states = $user_rowstate['state'];$sprog = $user_rowstate['app_type'];$entrymodel = getelevel($user_rowstate['moe']);
$student_s = "Delta";  $apno1 = $user_rowstate['appNo']; $admitsec = $user_rowstate['Asession'];
if($states == $student_s){ $scan = "1";}else{ $scan = "0";} 
$qfcompn=mysqli_query($condb,"select * from feecomp_tb where  prog = '".safee($condb,$sprog)."' and fcat = '1' and level ='".safee($condb,$entrymodel)."' and regno = '".safee($condb,$apno1)."'") or die(mysqli_error($condb));  $countcmp = mysqli_num_rows($qfcompn);

$querycomp = mysqli_query($condb,"select * from fee_db where ft_cat ='1' and level= '".safee($condb,$entrymodel)."' and program='".safee($condb,$sprog)."' and cat_fee ='".safee($condb,$scan)."' and status = '1'") or die(mysqli_error($condb));
 $nocomp = mysqli_num_rows($querycomp); $Bno = 0;
$s=8;while($s>0){ $Bno .= rand(0,9);$s-=1; } $batchno = "B".$Bno;

if (isset($_POST['addpayment'])){ $date_now =  date("Y-m-d");
	 if(empty($_POST['selector'])){
				message("You have not selected any Payment Component !", "error");
		        redirect('apply_b.php?view=lpay&p_id='.$paykey);
		        //}elseif($countcmp < $nocomp){
		        //if(count($_POST['selector']) < $nocomp){
		        	///message("Compulsory Fees are required to Continue payment !", "error");
		        //redirect('apply_b.php?view=lpay&p_id='.$paykey);}
				}else{ $id=$_POST['selector'];  $N = count($id);
for($i=0; $i < $N; $i++){
$sfcom = mysqli_query($condb,"select * from fee_db where fee_id ='".$id[$i]."' ") or die(mysqli_error($condb));
$row = mysqli_fetch_array($sfcom); extract($row);$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d",strtotime($date20));
 if($pper > 0 and $date_now >= $newDate20){ $penaltysum = FeesCalc($f_amount,$pper,$newDate20); $pen1 = "1";}else{ $penaltysum = $f_amount; $pen1 = "0"; }
$qfcomp=mysqli_query($condb,"select * from feecomp_tb where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$apno1)."'") or die(mysqli_error($condb));
if(mysqli_num_rows($qfcomp)>0){
 $resultapp = mysqli_query($condb,"UPDATE feecomp_tb SET f_amount ='".safee($condb,$penaltysum)."',session = '".safee($condb,$admitsec)."',Batchno = '".safee($condb,$batchno)."'  where feetype ='".safee($condb,$feetype)."' and prog = '".safee($condb,$program)."' and fcat = '".safee($condb,$ft_cat)."' and penalty = '".$pen1."' and level ='".safee($condb,$level)."' and regno = '".safee($condb,$apno1)."'")or die(mysqli_error($condb));
}else{
$queryin = mysqli_query($condb,"insert into feecomp_tb(regno,feetype,prog,level,f_amount,fcat,penalty,session,Batchno)values('".safee($condb,$apno1)."','".safee($condb,$feetype)."','".safee($condb,$program)."','".safee($condb,$level)."','".safee($condb,$penaltysum)."','".$ft_cat."','".$pen1."','".safee($condb,$admitsec)."','".safee($condb,$batchno)."')")or die(mysqli_error($condb));
}

 redirect('apply_b.php?view=opay&id='.$batchno); }}}
 // check if paid acceptance
 $sql_cstudent = mysqli_query($condb,"SELECT * FROM student_tb WHERE appNo = '".safee($condb,$apno1)."'");
$contstate = mysqli_num_rows($sql_cstudent);
//-----------------------------------------------load fees
 $fee_query = "select * from fee_db where level = '".safee($condb,$entrymodel)."' and program = '".safee($condb,$sprog)."' and status = '1'  ";
  if($contstate < 1){$fee_query .= " and ft_cat = '4'";}else{ $fee_query .= " and Cat_fee = '".safee($condb,$scan)."' and ft_cat = '1'"; }
  $fee_query .= "order by feetype DESC ";
  $viewfee_query = mysqli_query($condb,$fee_query)or die(mysqli_error($condb));
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
<p class="first-paragraph"><?php  if($contstate > 0){ ?>
Please Select the Fee (s) you which to pay and Click <strong> Add Payment </strong> Button to continue.
<br> Note that Checked Payment(s) are required to proceed. <?php }else{ ?>
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
if(mysqli_num_rows($viewfee_query) > 0)
    {
$number = 1;$sumcredit = 0;
while($row_s = mysqli_fetch_array($viewfee_query)){ 
$Fee_type1 = $row_s['feetype'];  $Fee_cat = $row_s['ft_cat']; if($Fee_cat == "1" OR $contstate < 1 ){ $check_c =" Checked";  }else{ $check_c ="";  }
$paysid = $row_s['fee_id']; $dperc = $row_s['pper']; 
$psdate = $row_s['psdate']; $famount =$row_s['f_amount'];
$date20 = str_replace('/', '-', $psdate );  $newDate20 = date("Y-m-d", strtotime($date20));  $date_now =  date("Y-m-d");
$penaltysum = FeesCalc($famount,$dperc,$newDate20); $difp = $penaltysum - $famount ;
if($dperc > 0 and $date_now >= $newDate20){ $noteo = ", Note:  (".$dperc."% penalty inclusive ) ".number_format($famount,2) ." + ". number_format($difp,2) ." = ".number_format($penaltysum,2); $namount = $penaltysum; }else{ $noteo = ""; $namount = $row_s['f_amount'];  } 

$qpaycomp = mysqli_query($condb,"SELECT pstatus FROM feecomp_tb  WHERE regno = '".safee($condb,$apno1)."'  AND session = '".safee($condb,$admitsec)."' AND level = '".safee($condb,$entrymodel)."' AND feetype = '".safee($condb,$Fee_type1)."'");
$row_paycomp = mysqli_fetch_array($qpaycomp);  $statuspay = $row_paycomp['pstatus'];
								//$date_now = date("Y-m-d");
								//echo json_encode($row_paycomp['regno']);	?>
<!-- <tr onclick="window.location='www.google.com';"> --!>
<?php //$url2 = "http://localhost/DSC/DSCHT/apply_b.php?view=p_sh&main=".md5($id);  ?>
<tr>

                	<?php if($statuspay > 0){
							$status = 'Paid';
							 ?>
							<td width="30" style="text-align:centre;"  >
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" disabled  value="<?php echo $row_s['fee_id']; ?>">  
                        
													</td> <?php }else{ if($Fee_cat =="1"){$status = 'Not Paid';}else{
$status ="Not Paid"; //'<a rel="tooltip"  title="Click to Conutinue Payment" id="delete1" href="Spay_manage.php?view=m_sp&id='.md5($paysid).'" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle icon-large" > Add Payment</i></a>';
}?>
<td width="30" style="text-align:center;">
           	<input id="optionsCheckbox"  class="uniform_on1" name="selector[]" type="checkbox"   value="<?php echo $row_s['fee_id']; ?>" <?php echo $check_c ;?> >
													</td><?php } ?>
<td><?php echo $number; ?></td>
    <td><?php if($statuspay > 0){ echo "<font color='green'>".getftype($row_s['feetype'])." ".$noteo." </font>   ";
	}else{echo "<font color='red'>".getftype($row_s['feetype'])." ".$noteo."</font> ";}
					 ?></td>
    <td><?php echo number_format($namount,2); ?></td>
    <td><?php echo $status; ?></td>
    </tr> 
   <?php $number++;  $sumcredit += $namount; }  }else{ $sumcredit = 0; ?>
    <tr><td colspan="5">No School Payment (s) Found at this time Please Check back later! </td></tr>
   <?php  } ?>
   <tr><td colspan="3"><strong>Total Amount: </strong></td>
   <td style="text-align:center;"><strong> <?php if($sumcredit > 0){ echo "&#8358; ".number_format($sumcredit,2);}else{echo "0";} ?></strong></td>
   <td colspan="1"></td></tr>
</table>	<button name="addpayment" class="btn btn-primary" data-placement="right" type="submit" title="Click to add Payment and Conutinue">Add Payment</button>
		<button name="pslip" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Reprint Payment Receipt " onClick="window.location.href='apply_b.php?view=pay&p_id=<?php echo $paykey ; ?>';">Pay Receipt</button>		
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
    
  