<?php

include('lib/dbcon.php'); 
dbcon(); 
include('session.php'); 
$resultroomsno2 = mysqli_query($condb,"SELECT * FROM payment_tb where ft_cat ='".safee($condb,$_GET['q'])."'");
$rsroomsno2 = mysqli_fetch_assoc($resultroomsno2); $fcat = $rsroomsno2['ft_cat'];
$date1=date("Y");
$nback   =	(int)substr($default_secadmin,5,10) + 1;
if($nback > $date1){ $nsec = $default_session; }else{ $nsec = $default_secadmin;}
if(($_GET['q']) == "3"){
  $resultQP1 = mysqli_query($condb,"select SUM(fpamount) AS total from fshop_tb where  session ='".safee($condb,$nsec)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid  >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and fpay_status ='1' order by fdate_paid DESC  ");
$resultQP2 = mysqli_query($condb,"select SUM(fpamount) AS total from fshop_tb where session ='".safee($condb,$nsec)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and fpay_status ='1' order by fdate_paid DESC  ");
$resultQP3 = mysqli_query($condb,"select SUM(fpamount) AS total from fshop_tb where session ='".safee($condb,$nsec)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and fpay_status ='1' order by fdate_paid DESC  ");
$resultQP4 = mysqli_query($condb,"select SUM(fpamount) AS total from fshop_tb where session ='".safee($condb,$nsec)."' and ftype = '".safee($condb,$class_ID)."' and fdate_paid >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and fpay_status ='1' order by fdate_paid DESC  ");
$result_amt1 = mysqli_fetch_assoc($resultQP1); $total1 = $result_amt1['total'];
$result_amt2 = mysqli_fetch_assoc($resultQP2); $total2 = $result_amt2['total'];
$result_amt3 = mysqli_fetch_assoc($resultQP3); $total3 = $result_amt3['total'];
$result_amt4 = mysqli_fetch_assoc($resultQP4); $total4 = $result_amt4['total'];  
}else{
$resultQP1 = mysqli_query($condb,"select SUM(paid_amount) AS total from payment_tb where  session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$_GET['q'])."' and prog = '".safee($condb,$class_ID)."' and pay_date  >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and pay_status ='1' order by pay_date DESC  ");
$resultQP2 = mysqli_query($condb,"select SUM(paid_amount) AS total from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$_GET['q'])."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and pay_status ='1' order by pay_date DESC  ");
$resultQP3 = mysqli_query($condb,"select SUM(paid_amount) AS total from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$_GET['q'])."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and pay_status ='1' order by pay_date DESC  ");
$resultQP4 = mysqli_query($condb,"select SUM(paid_amount) AS total from payment_tb where session ='".safee($condb,$default_session)."' and ft_cat ='".safee($condb,$_GET['q'])."' and prog = '".safee($condb,$class_ID)."' and pay_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and pay_status ='1' order by pay_date DESC  ");
$result_amt1 = mysqli_fetch_assoc($resultQP1); $total1 = $result_amt1['total'];
$result_amt2 = mysqli_fetch_assoc($resultQP2); $total2 = $result_amt2['total'];
$result_amt3 = mysqli_fetch_assoc($resultQP3); $total3 = $result_amt3['total'];
$result_amt4 = mysqli_fetch_assoc($resultQP4); $total4 = $result_amt4['total'];}
 if(($_GET['q']) == "3"){ ?>
<div style="text-align: center;"><strong> CURRENT SESSION : <?php echo $default_session."  &nbsp;&nbsp;&nbsp;&nbsp;"; ?> 
ADDMISSION SESSION : <?php echo $default_secadmin; ?></strong></div> <?php } ?>

<a class="btn btn-app" style="height: 85px;"  onclick="window.open('formSales.php?view=Report&q=wp1&fc=<?php echo $_GET['q']; ?>','_self')" >
<i class="fa fa-calendar"></i> Weekly Report <br> <font color="green" size="4" >&#8358;<strong><?php  if($total1 > 0){ echo " ".number_format($total1,2);}else{echo " 0.00";} ?></strong></font></a>
<a class="btn btn-app" style="height: 85px;" onclick="window.open('formSales.php?view=Report&q=mp2&fc=<?php echo $_GET['q']; ?>','_self')" >
<i class="fa fa-calendar"></i> Monthly Report <br> <font color="green" size="4" >&#8358;<strong><?php  if($total2 > 0){ echo " ".number_format($total2,2);}else{echo " 0.00";} ?></strong></font></a>
<a class="btn btn-app" style="height: 85px;" onclick="window.open('formSales.php?view=Report&q=qp3&fc=<?php echo $_GET['q']; ?>','_self')">
<i class="fa fa-calendar"></i> Quaterly Report <br><font color="green" size="4" >&#8358;<strong> <?php  if($total3 > 0){ echo " ".number_format($total3,2);}else{echo " 0.00";} ?></strong></font></a>
<a class="btn btn-app" style="height: 85px;" onclick="window.open('formSales.php?view=Report&q=ap4&fc=<?php echo $_GET['q']; ?>','_self')" >
<i class="fa fa-calendar"></i> Annually Report <br> <font color="green" size="4" >&#8358;<strong><?php  if($total4 > 0){ echo " ".number_format($total4,2);}else{echo " 0.00";} ?></strong></font></a>
<?php if(($_GET['q']) !== "3"){ ?> 
<a class="btn btn-app"  style="height: 85px;" onclick="window.open('formSales.php?view=Report&q=ap5&fc=<?php echo $_GET['q']; ?>','_self')" style="display: block;" >
                      <i class="fa fa-calendar"></i> Management Summary</a> <?php } ?>