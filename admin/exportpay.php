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
$depart = isset($_GET['Schd']) ? $_GET['Schd'] : '';
$session = isset($_GET['session2']) ? $_GET['session2'] : '';
$datestart =  isset($_GET['dop']) ? $_GET['dop'] : '';
$datestop =  isset($_GET['dop2']) ? $_GET['dop2'] : '';
$depget = getdeptc($depart);
$replacedept    = str_replace(" ","_",  $depget);
    header("Content-Type: application/xls"); 
	header("Content-Disposition: attachment; filename='$session'_'".$replacedept."'_Payment_Details.xls");  
    	//header("Content-Disposition: attachment; filename=download.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
        //if($depart < 1){ $valuecheck = "";}else{ $valuecheck = "in ";}
 if(empty($session)){$ntitle = " in ".getdeptc($depart)." ";}else{$ntitle = " in ".getdeptc($depart)." ".$session." ";}
if(!empty($datestart)){ $drange = "From ". $datestart. " To ". $datestop;}else{ $drange = "";}
$noi = 1;
$total = 0; 
    	$output = "";
$output .="<center>
<table border='1'>";
$output .= "<tr ><td colspan='12' style='background-color: white;font-size: 25px;text-align: center;color:black;'>".$schoolName."</td></tr>";
$output .= "<tr ><td colspan='12' style='background-color: #4CAF50;font-size: 22px;text-align: center;color:white;'> Student Payment(s) ".$ntitle." ".$drange."</td></tr>";
$output .= "<thead><tr><th>S/N</th><th>Transaction ID</th><th>Reg/Mat No</th><th>Name</th> <th>Fee Type</th>";
//$output .= "<th>".$SCategory."</th>";
$output .= "<th>".$SGdept1. "</th>";
$output .= " <th>Level</th><th>Session</th><th>Payment Mode</th><th>Date</th><th>Amount</th><th>Status</th></tr><tbody>";
$origDate = $datestart;
$origDate2 = $datestop;
 $date = str_replace('/', '-', $origDate );
$dateofpay = date("Y-m-d", strtotime($date));
$date2 = str_replace('/', '-', $origDate2 );
$dateofpay2 = date("Y-m-d", strtotime($date2));
$vquery = "select * from payment_tb WHERE  prog = '".safee($condb,$class_ID)."'";
if(!empty($depart)){$vquery .= " AND department = '".safee($condb,$depart)."'";}
if(!empty($session)){$vquery .= " AND session = '".safee($condb,$session)."'";}
if(!empty($origDate) || !empty($origDate2)){$vquery .= " AND pay_date BETWEEN '".safee($condb,$dateofpay)."' AND '".safee($condb,$dateofpay2)."'";}
if(empty($session)){$vquery .= " AND session = '".safee($condb,$default_session)."' AND DATE(pay_date) > (CURDATE() - INTERVAL 7 DAY)";}
$vquery .= " order by pay_id DESC LIMIT 0,800";
$viewutme_query = mysqli_query($condb,$vquery)or die(mysqli_error($condb));
$countt = mysqli_num_rows($viewutme_query);
			while($fetch = mysqli_fetch_array($viewutme_query)){
     $transid = $fetch['trans_id']; 
   $id = $fetch['pay_id'];
$new_a_id = $fetch['trans_id']; 
$is_active = $fetch['pay_status'];$feetype = $fetch['fee_type']; $dept23 = $fetch['department']; 
$student_reg = $fetch['stud_reg'];$app_id = $fetch['app_no'];
if(substr($feetype,0,1) == "B"){ $feet = getfeecat($fetch['ft_cat']);}else{ $feet = getftype($fetch['fee_type']);}
if(empty($student_reg)){$matn = $fetch['app_no'];}else{ $matn = $fetch['stud_reg'];} 
    if(empty($student_reg)){$fullname = getappname($fetch['app_no']);}else{ $fullname = getname($student_reg);}
    if($is_active == "1"){$amtn = $fetch['paid_amount']; }else{ $amtn = "0.00"; }
    		$output .= "<tr><td>".$noi++."</td>	<td>".$transid."</td>
    						<td>".$matn."</td><td>".$fullname."</td><td>".strtoupper($feet)."</td><td>".getdeptc($fetch['department'])."</td>
                            <td>".getlevel($fetch['level'],$class_ID)."</td><td>".$fetch['session']."</td><td>".$fetch['pay_mode']."</td><td>".$fetch['pay_date']."</td>
                            <td>".$amtn."</td><td>".getpaystatus($is_active)."</td></tr>"; $total += $amtn; }
                            if($total > 0){ $amt =  number_format($total,2); }else{ $amt = "0.00";}
          $output .= "<tr>  <td colspan='10'><strong>Total :</strong></td> <td><strong>" .$amt ."<strong></td><td colspan='1'></td> </tr>";
     	$output .= "";
    		if ($countt < 1){
    $output .= "<tr><td colspan='12'>No Payment Record(s) Found!</td></tr>"; }
    			$output .= "	</tbody></table></center>";
     echo $output;
    //}
	
 ob_end_flush();
?>
