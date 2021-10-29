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
//-----------------------------------------------load fees
$viewpay_query = mysqli_query($condb,"select * from payment_tb where app_no ='".safee($condb,$apno1)."' and level = '".safee($condb,$entrymodel)."'  and  pay_status = '1' order by pay_date  DESC")or die(mysqli_error($condb));
 ?>
<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="apply_b.php?view=lpay&p_id=<?php echo $paykey; ?>">Back</a> </li>
</ul></section></div></div> </div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Payment Record (s) </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">Please click on any of the payment Record to view <?php echo getlevel($entrymodel,$sprog); ?> Level payment Receipt.  </p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
	<h4 class="panel-title">Listed Below are your Payment (s)  </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    		<table id="customers">
  <tr>
  <th>S/N</th>
  <th>App No</th>
  <th>Payment Description</th>
  <th>Date</th>
    <th>Amount ( &#8358; )</th>
</tr>
   <?php //$date_now =  date("Y-m-d");
//$user_query = mysqli_query($condb,"select * from form_db where f_end >='".$date_now."' Order by session ASC")or die(mysqli_error($condb)); 
if(mysqli_num_rows($viewpay_query) > 0){  $number = 1;$sumcredit=0;
while($row_s = mysqli_fetch_array($viewpay_query)){
$feetype = $row_s['fee_type'];   $AppNon = $row_s['app_no'];  $transidn = md5($row_s['trans_id']);
$psdate = $row_s['pay_date']; $pamount =$row_s['paid_amount'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($row_s['ft_cat']);}else{ $feet = getftype($row_s['fee_type']);} ?>
<tr class='clickable-row' data-href='paymentslip.php?p_id=<?php echo $transidn; ?>'>
<td width="30" style="text-align:centre;"  ><?php echo $number; ?></td>
<td><?php echo $AppNon; ?></td>
    <td><?php echo $feet ; ?></td>
    <td><?php echo $psdate; ?></td>
    <td style="text-align:center;"><?php echo number_format($pamount,2); ?></td>
    </tr>  <?php $number++;  $sumcredit += $pamount; }  }else{ $sumcredit = 0; ?>
    <tr><td colspan="5">No Payment Record Found ! </td></tr>
   <?php  } ?>
   <tr><td colspan="4"><strong>Total Amount Paid: </strong></td>
   <td style="text-align:center;"><strong> <?php if($sumcredit > 0){ echo "&#8358; ".number_format($sumcredit,2);}else{echo "0";} ?></strong></td>
   </tr>
</table>				
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
    
  