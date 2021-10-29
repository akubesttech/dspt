<?php
ob_start();
/**
 * @author lolkittens
 * @copyright 2020
 */
include('lib/dbcon.php'); 
dbcon();
include('session.php'); 
$querysch= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
$rowsch = mysqli_fetch_array($querysch);$schoolName = $rowsch['SchoolName']." <br> ".getprog($class_ID);

//function for getting member status
$fcat =  isset($_REQUEST['fcat']) ? $_REQUEST['fcat'] : '';
 $cati =  isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
$depart = isset($_REQUEST['xdp']) ? $_REQUEST['xdp'] : '';
$session = isset($_REQUEST['xsec']) ? $_REQUEST['xsec'] : '';
$datestart =  isset($_REQUEST['xd1']) ? $_REQUEST['xd1'] : '';
$datestop= isset($_REQUEST['xd2']) ? $_REQUEST['xd2'] : '';
$plevel = isset($_REQUEST['xlev']) ? $_REQUEST['xlev'] : '';
$depget = getdeptc($depart);
$feename =  getftype($fcat);
$ncat =  getftcat($fcat);
$replacedept    = str_replace(" ","_",  $depget);
    header("Content-Type: application/xls"); 
	header("Content-Disposition: attachment; filename='$session'_'".$replacedept."'_Payment_Report.xls");  
    	//header("Content-Disposition: attachment; filename=download.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
$origDate = $datestart;
$origDate2 = $datestop;
 $date = str_replace('/', '-', $origDate );
$newDate = date("Y-m-d", strtotime($date));
$date2 = str_replace('/', '-', $origDate2 );
$newDate2 = date("Y-m-d", strtotime($date2));

if($cati== "1"){ $ntitle = " From ".($datestart)."  To ".$datestop." ";}
elseif($cati== "2"){ $ntitle = getdeptc($depart)." ".$SGdept1;}elseif($cati== "4"){ $ntitle = getdeptc($depart)."<br>".getlevel($plevel,$class_ID)." ".$session." Academic Session  ";}else{ $ntitle =  $session."  Academic Session ";}

$noi = 1;
$total = 0; 
    	$output = "";
$output .="<center>
<table border='1'>";
$output .= "<tr ><td colspan='11' style='background-color: white;text-align: center;color:black;'><div style='font-size: 25px;'>".$schoolName."</div><div style='font-size: 20px;color:green;'>General Payment Report</div>
<div style='font-size: 20px;'>".$feename."<div><div style='font-size: 20px;'>".$ntitle."<div></td></tr>";
$output .= "<thead><tr><th>S/N</th><th>Reference No</th> ";
//$output .= "<th>".$SCategory."</th>";
if($ncat !== "3"){
$output .= "<th>Reg/Mat No</th><th>Name</th><th>".$SGdept1. "</th><th>Level</th>"; }else{
$output .= "<th>Applicant Name</th><th>Email</th><th>Phone</th><th>Other Type</th>"; }
$output .= " <th>Session</th><th>Date</th> <th>Schedule Fee</th> <th>Amount Paid</th><th>Bal</th></tr></thead><tbody>";

if($ncat == "3"){
 $vquery = "select * from fshop_tb  WHERE  ftype = '".safee($condb,$class_ID)."' AND fpay_status ='1'";
if($cati== "1"){$vquery .= " AND fdate_paid BETWEEN '".safee($condb,$newDate)."' AND '".safee($condb,$newDate2)."'";}
if($cati== "2"){$vquery .= " AND session ='".safee($condb,$session)."'";}
if($cati== "4"){$vquery .= " AND session ='".safee($condb,$session)."'";}
if($cati== "3"){$vquery .= " AND session ='".safee($condb,$session)."'";}
$vquery .= " ORDER BY fdate_paid DESC LIMIT 0,800";  
}else{
$vquery = "select * from feecomp_tb ft LEFT JOIN payment_tb pt ON ft.Batchno = pt.fee_type WHERE ft.feetype = '".safee($condb,$fcat)."' AND ft.prog = '".safee($condb,$class_ID)."'";
if($cati== "1"){$vquery .= " AND pt.pay_date BETWEEN '".safee($condb,$newDate)."' AND '".safee($condb,$newDate2)."' AND ft.pstatus ='1'";}
if($cati== "2"){$vquery .= " AND pt.department = '".safee($condb,$depart)."' AND ft.session ='".safee($condb,$session)."' AND ft.pstatus ='1'";}
if($cati== "4"){$vquery .= " AND pt.department = '".safee($condb,$depart)."' AND ft.session ='".safee($condb,$session)."' AND ft.level = '".safee($condb,$plevel)."' AND ft.pstatus ='1'";}
if($cati== "3"){$vquery .= " AND ft.session ='".safee($condb,$session)."' and ft.pstatus ='1'";}
$vquery .= " ORDER BY ft.id DESC LIMIT 0,800";}

$viewutme_query = mysqli_query($condb,$vquery)or die(mysqli_error($condb));
//$countt = mysqli_num_rows($viewutme_query);
if($ncat == "3"){ $countrow = mysqli_num_rows($viewutme_query);}else{ $countrow = mysqli_num_rows($viewutme_query); }
$bal = 0.00;
$tdue = 0.00;
$tbal = 0.00;
$tpaid = 0.00;$nbal = 0.00;
if($ncat !== "3"){
while($fetch = mysqli_fetch_array($viewutme_query)){
$transid = $fetch['trans_id']; 
   $id = $fetch['pay_id'];
$new_a_id = $fetch['trans_id']; 
$is_active = $fetch['pay_status'];$feetype = $fetch['fee_type']; $dept23 = $fetch['department']; 
$student_reg = $fetch['stud_reg'];$app_id = $fetch['app_no'];$stud_cat = $fetch['stud_cat'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($fetch['ft_cat']);}else{ $feet = getftype($fetch['fee_type']);}
if(empty($student_reg)){$matn = $fetch['app_no'];}else{ $matn = $fetch['stud_reg'];} 
    if(empty($student_reg)){$fullname = getappname($fetch['app_no']);}else{ $fullname = getname($student_reg);} 
 if($is_active == "1"){$amtn = $fetch['f_amount']; }else{ $amtn = "0.00"; }
$forderquery = mysqli_query($condb,"select pay_status,paid_amount from payment_tb where pay_status > 0 and paid_amount > 0 and pay_id ='".safee($condb,$id)."'")or die(mysqli_error($condb));
//get Sccheduled Fee
$namount = getDueamt($ncat,$class_ID,$fetch['level'],$stud_cat,$fcat);
$currentbal = getpayamt($matn,$ncat,$class_ID,$fetch['level'],$fetch['session'],$fcat);
//$nbal = $currentbal - $amtn;
$bal = $namount - $amtn;  
if($bal < 1){ $nbal= "0.00";}else{ $nbal= number_format($bal,2); }
//$countpay = mysqli_num_rows($forderquery);
$output .= "<tr><td>".$noi++."</td>	<td>".$transid."</td>
    						<td>".$matn."</td><td>".$fullname."</td><td>".getdeptc($fetch['department'])."</td>
                            <td>".getlevel($fetch['level'],$class_ID)."</td><td>".$fetch['session']."</td><td>".$fetch['pay_date']."</td><td>".number_format($namount,2)."</td>
                            <td>".number_format($amtn,2)."</td><td>".$nbal."</td></tr>"; $total += $amtn; $tbal += $bal; $tdue += $namount;} 
                            }else{
                        while($fetch = mysqli_fetch_array($viewutme_query)){
                             $i =0; $is_active = $fetch['fpay_status'];
 $email = $fetch['femail']; $phone = $fetch['fphone'];
$fulname = ucwords($fetch['fsname']." ".$fetch['foname']);
$namount = $fetch['famount'];
if($is_active == "1"){$amtn = $fetch['fpamount']; }else{ $amtn = "0.00"; }
$bal = $namount -  $amtn;
if($bal < 1){ $nbal= "0.00";}else{ $nbal= number_format($bal,2); }
if ($i%2) {$classo = 'row1';} else {$classo = 'row2';}$i += 1;
$transid = $fetch['ftrans_id']; 

 
//$countpay = mysqli_num_rows($forderquery);
$output .= "<tr><td>".$noi++."</td>	<td>".$transid."</td>
    						<td>".$fulname."</td><td>".$email."</td>
                            <td>".$phone."</td><td>".getftype($fetch['feen'])."</td><td>".$fetch['session']."</td><td>".$fetch['fdate_paid']."</td><td>".number_format($namount,2)."</td>
                            <td>".number_format($amtn,2)."</td><td>".$nbal."</td></tr>"; $total += $amtn; $tbal += $bal; $tdue += $namount;}   
                                
                                
                            }
                            if($total > 0){ $amt =  number_format($total,2); }else{ $amt = "0.00";}
                            if($tbal < 1){ $fbal= "0.00";}else{ $fbal= number_format($tbal,2); }
          $output .= "<tr>  <td colspan='8'><strong>Total :</strong></td> <td><strong>" .number_format($tdue,2) ."<strong></td><td><strong>" .$amt ."<strong></td><td><strong>" .$fbal ."<strong></td> </tr>";
     	$output .= "";
    	if($countrow < 1){
    $output .= "<tr><td colspan='11'>No Payment Record(s) Found!</td></tr>"; }
    			$output .= "	</tbody></table></center>";
     echo $output;
    //}
	
 ob_end_flush();
?>
