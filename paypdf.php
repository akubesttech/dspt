<?php

/**
 * @author 
 * @copyright 2017
 */

//include connection file 
 include('admin/lib/dbcon.php'); 
dbcon(); 
//require('../fpdf18/fpdf.php');
require_once "admin/tcpdf/tcpdf.php";

 $getschool = mysqli_query($condb,"select * from schoolsetuptd")or die(mysqli_error($condb));
	$gschool = mysqli_fetch_array($getschool); $nexttermstart = $gschool['ntstart'];
	//$logoback = "../admin/".$gschool['Logo'];
							  $exists = imgExists("./admin/".$gschool['Logo']);
	if($exists > 0 ){ $logob =  "./admin/".$gschool['Logo']; }else{ $logob = "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
	$existn = imgExists("Student/".$rsprint1['images']);
		  		  if ($existn > 0 ){ $simage = "Student/".$rsprint1['images']; }else{ $simage = "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
		  		  function hide_phone($phone) {//return substr($phone, 0, -4) . "**"; return substr($phone, 1, 2) . "**";
    return substr_replace($phone, str_repeat("*", 2), 1, 2);}
		  		  
$sql_tranid = "SELECT * FROM payment_tb WHERE md5(trans_id) ='".safee($condb,$_GET['tid'])."'";
$sql_tranid1=mysqli_query($condb,$sql_tranid);
$dform_checkexist20 = mysqli_num_rows($sql_tranid1);
$rsprint = mysqli_fetch_array($sql_tranid1);
$applcation_id = $rsprint['app_no'];
$student_reg = $rsprint['stud_reg']; $tranD = MD5($rsprint['trans_id']);
 if(empty($student_reg)){ $student_level = $rsprint['level']; $student_prog = $rsprint['prog']; $idtype = "Application Number :"; }else{ include('Student/session.php'); $idtype = "Matric Number :"; }
  //$existl = imgExists("admin/".$row['Logo']);
if($dform_checkexist20 < 1){ echo "<script>alert('The page you are trying to access is not Available!');</script>";
unset($_SESSION['student_id']);   redirect('Userlogin.php'); }

   if(empty($student_reg)){ 
$sql2 = "SELECT * FROM new_apply1 left join payment_tb ON payment_tb.app_no = new_apply1.appNo WHERE  appNo ='".safee($condb,$applcation_id)."' and md5(trans_id) ='".safee($condb,$_GET['tid'])."' ";
}else{ $sql2 = "SELECT * FROM student_tb left join payment_tb ON payment_tb.stud_reg = student_tb.RegNo WHERE  stud_reg ='".safee($condb,$student_reg)."' and md5(trans_id) ='".safee($condb,$_GET['tid'])."' ";}
//$qsql1=mysqli_query($condb,$sql2);$rsprint1 = mysqli_fetch_array($qsql1);
if(!$qsql1=mysqli_query($condb,$sql2)) { echo mysqli_error($condb); } $rsprint1 = mysqli_fetch_array($qsql1);$feecategory = $rsprint1['ft_cat'];

							 /* function getsimg($exist){
$imq1 = mysqli_query(Database::$conn,"select * from schoolsetuptd")or die(mysqli_error($condb));
$gd = mysqli_fetch_array($imq1); $exist = imgExists("../admin/".$gd['Logo']);  
if ($exist > 0 ){ return "./admin/".$gd['Logo'];}else{ return "uploads/NO-IMAGE-AVAILABLE.jpg";}}*/
 $existn = imgExists("Student/".$rsprint1['images']);
		  		  if ($existn > 0 ){ $simage = "Student/".$rsprint1['images']; }else{ $simage = "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}

$ptitle = "STUDENT ".getfeecat($feecategory)." RECEIPT"; $ptitle2 = "STUDENT ".getftype($rsprint1['fee_type'])." RECEIPT";		 


//$viewprintco=mysqli_query($condb,"select DISTINCT student_id from studenttotalscore where  session ='". safes($condb,$sessp) ."' and term='". safes($condb,$termp) ."' and class_name='". safes($condb,$classsnp) ."' and class_type='". safes($condb,$c_typep)."' and totalscore > 0 ")or die (mysqli_error($condb));
	//$countrv = mysqli_num_rows($viewprintco);


$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Akubest @ 08062475090');
$pdf->SetTitle('Student Payment Receipt');
$pdf->SetSubject('Student Payment Receipt');
$pdf->SetKeywords('Fee, PSITS, CMS, Payment Receipt');



//while($row2 = mysqli_fetch_array($viewprintco)){
//$sql = "SELECT * FROM student left join result ON result.student_id = student.RegNo WHERE  result.student_id ='$row2[student_id]'
   //and result.session='$_GET[sessp]' and result.class_name='$_GET[c_namep]' and result.class_type='$_GET[c_typep]' and result.term='$_GET[termp]'";
//if(!$qsql=mysqli_query($condb,$sql)){ echo mysqli_error($condb);} $rsprint = mysqli_fetch_array($qsql);
if($session_id > 0){ $regno = $rsprint1['stud_reg'];}else{ $regno = $rsprint1['app_no'];}
//$student_query3=mysqli_query($condb,"SELECT DISTINCT student_id FROM result where session ='". safes($condb,$sessp) ."' and term='". safes($condb,$termp) ."' and class_name='". safes($condb,$classsnp) ."' and class_type='". safes($condb,$c_typep)."' ")or die(mysqli_error($condb));
//	$num_rows12 =mysqli_num_rows($student_query3);
	
//$sql_gradeset = mysqli_query($condb,"select * from grade_tb where class ='".safes($condb,$classsnp)."' Order by gstart ASC ")or die(mysqli_error($condb)); getsimg($logoimg)
$pdf->SetHeaderData("",20, "                                    ".$gschool['SchoolName'], "                                      ".$gschool['Motto'], array(0,0,0), array(0,0,0));

//$querytsign = mysqli_query($condb,"SELECT * FROM suballottb left join staff ON suballottb.assigned = staff.staff_id WHERE session ='". safes($condb,$sessp) ."'  and class_name='". safes($condb,$classsnp) ."' and class_type='". safes($condb,$c_typep) ."' and sub_name ='".safes($condb,$row2['subject'])."' and term ='".safes($condb,$termp)."' and allotStatus = '1'")or die(mysqli_error($condb));
		//$signteacher =mysqli_fetch_array($querytsign);
		
		
		
$pdf->setFooterData(array(0,0,0), array(0,0,0));

$pdf->setHeaderFont(Array('helvetica', '', 12));
$pdf->setFooterFont(Array('helvetica', '', 8));

$pdf->SetDefaultMonospacedFont('courier');

$pdf->SetMargins(6, 27, 6);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

$pdf->SetAutoPageBreak(TRUE, 25);


$pdf->setImageScale(1.25);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);

$pdf->SetFont('dejavusans', '', 11, '', true);

$pdf->AddPage();
  // -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
	// set bacground image
        //$img_file = K_PATH_IMAGES.'../admin/uploads/84896975.png';
        // set alpha to semi-transparency
$pdf->SetAlpha(0.5);
        $img_file = $logob; //'../admin/uploads/84896975.jpg';
        $pdf->Image($img_file, 45, 120, 120, '', '', '', '', false, 300, '', false, false, 0); 
        $pdf->SetAlpha(1);
		// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$pdf->Ln(2);
    $pdf->SetFont('helvetica','B',10);
    $pdf->Cell(45);
    //$classsnp2 = strtoupper(substr($_GET['c_namep'],0,2)); if($classsnp2 == "JS"){ $classcat = "Junior Secondary";}elseif($classsnp2 == "SS"){$classcat = "Senior Secondary";}else{ $classcat = "";}
  if(substr($rsprint1['fee_type'],0,1) == "B"){$classcat = strtoupper($ptitle); }else{  $classcat = strtoupper($ptitle2); } 
     if($rsprint1['course_choice'] == '1'){ $facnew =  getfacultyc($rsprint1['fact_1']); $depnew = $rsprint1['first_Choice'];
}elseif($rsprint1['course_choice'] == '2'){ $facnew =  getfacultyc($rsprint1['fact_2']); $depnew = $rsprint1['Second_Choice'];}
if(empty($student_reg)){ $faculty = $facnew; }else{ $faculty = getfacultyc($rsprint1['Faculty']) ;}
   if(empty($student_reg)){ $department = getdeptc($depnew);  }else{ $department =  getdeptc($rsprint1['Department']);}
$pdf->Multicell(110 ,6, " ".  $classcat , 1,'C');
$pdf->Multicell(200 ,7, $rsprint['session']." Academic Session", 0,'C');
 $pdf->SetFont('helvetica','',11);
$pdf->Image($simage,170,40,30,30);
    $pdf->Cell(80,10,$idtype."  ".$regno,0,0,'l');
    $pdf->Ln(6);
    $pdf->Cell(80,10,$SCategory." : ".$faculty,0,0,'l');
    $pdf->Ln(6);
    $pdf->Cell(80,10,$SGdept1." : ".$department,0,0,'l');
    $pdf->Ln(6);
    $pdf->Cell(80,10,"Level : ".getlevel($student_level,$student_prog) ,0,0,'l');
    $pdf->Ln(6);
    
   $pdf->SetFont('helvetica','',8);
    if(empty($student_reg)){  $studname =  strtoupper($rsprint1['FirstName']." ".$rsprint1['SecondName']." ".$rsprint1['Othername']); }else{  $studname = strtoupper(getname($regno));} 
   $html .= '<table><tr style="border-width: 0; text-align:center;"><td height="32" style="font-size:14px;font-weight: bold; font-family:vandana;text-shadow: 1px 1px gray;"> Transaction Reference: '.$rsprint1['trans_id'].'
   <br><font color="blue">'.$studname;
 $html .= '</font></td></tr>
  <tr style="border-width: 0;">
          <td height="25" colspan="4" style="color: #000080; font-size:14px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Payment Details:</strong><hr style="border-top: 1px solid black; background: transparent;"></td></tr>
  </table>';
	$html .= '
				
	<table cellpadding="2" border="1" border-collapse="0" style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt">
					<thead>
						<tr style="background-color:lightblue;box-shadow: 2px 2px gray;color: #000080;text-align:center;">
	<td  style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-right:1px solid #000000;font-weight:bold;">S/N</td>
	<td style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-right:1px solid #000000;font-weight:bold;">ITEM</td>
	<td style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-right:1px solid #000000;font-weight:bold;">DESCRIPTION</td>
	<td style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-right:1px solid #000000;font-weight:bold;">AMOUNT PAID</td>

						</tr>
					</thead>
				';
				   //$pdf->SetFont('helvetica','',7);
					$html .= '<tbody>';
				/*	$sessp=$_GET['sessp'];
$classsnp=$_GET['c_namep'];
$c_typep =$_GET['c_typep'];
$termp =$_GET['termp'];

		$num_rows =mysqli_num_rows($student_query);*/
		      $serial=1; 
if(mysqli_num_rows($qsql1)==0){
		//$serial=1;
		//while($row = mysqli_fetch_array($student_query)){
		

		$html .= '<tr style=\"background-color:#CFF\">
<td height=\"30\" colspan="4"><h3>No payment Found For This Session</h3></td>
        </tr>'; }else{ $feetp = $rsprint1['fee_type']; $transession = $rsprint1['session']; $fcate = $rsprint1['ft_cat'];
	if(substr($feetp,0,1) == "B"){ $paycomponent=mysqli_query($condb,"SELECT * FROM feecomp_tb  WHERE Batchno ='".safee($condb,$feetp)."' and pstatus = '1' "); 	 while($row_utme = mysqli_fetch_array($paycomponent)){
				if ($i%2) {$classo1 = '.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }';} else {$classo1 = '.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }';}$i += 1;
$ftypecon = $row_utme['feetype']; $amount = $row_utme['f_amount'];
$paysession = $row_utme['session']; $feecategory = $row_utme['fcat']; $penalty = $row_utme['penalty']; if($penalty > 0){ $pens = " ( penalty inclusive).";}else{ $pens ="";}
$date20 = str_replace('/', '-', $rsprint1['pay_date'] );  $newDate20 = date("Y-m-d", strtotime($date20));
   $timestamp = strtotime($newDate20); $datetime	= date('l, jS F Y', $timestamp);	
				$html .= '<tr class="'.$classo1.'" style="text-align:center;">
					<td > '. $serial++ .'</td>
					<td >'.getftype($ftypecon).'</td> 
					<td >'."Payment Of " .getftype($ftypecon)." For ".$transession.'</td> 
					<td >'.number_format($amount,2).'</td>  </tr>';
				}}else{	
					$html .= '<tr class="row1" style="text-align:center;">
					<td style="width:30.95pt;"> '. $serial++ .'</td>
					<td >'.getftype($feetp).'</td> 
					<td style="width:73.95pt;">'."Payment Of " .getftype($feetp)." For ".$transession.'</td> 
					<td style="width:73.95pt;">'.number_format($rsprint1['paid_amount'],2).'</td>';
					$html .= '</tr>';
				 }}
				 
				$html .= '</tbody>';
$html .= '<tr style="text-align:left;" >';
	$html .= '<td colspan="3"><h3>Total Amount Paid:</h3></td><td style="text-align:center;"><strong><font color="green"><strike>N</strike> '.number_format($rsprint1['paid_amount'],2).'</font></strong></td></tr>';
							  $html .= '<tr style="text-align:center;" >';
							$html .= '<td colspan="4"><h3>';
	$html .=  numtowords($rsprint1['paid_amount'])." Naira Only. ";
   $html .='</h3></td></tr>';

 
 	$html .= '<tr style="text-align:left;" >';
							$html .= '<td colspan="4" style="text-align:center;">';
			$html .= '<strong>'."Payment Mode : ".'</strong>'. $rsprint1['pay_mode'] .'<strong>'."    Payment Date:  ".'</<strong>>'.$datetime.'<strong>'."     Payment Status:  ".'</strong>'.  getpaystatus($rsprint1['pay_status'])."".'';
		if($rsprint1['pay_mode'] == "Online"){ $mod1 = "----------"; }else{ $mod1 =   $rsprint1['bank_name']; }
		if($rsprint1['pay_mode'] == "Online"){  $mod2 = "----------"; }else{  $mod2 = $rsprint1['teller_no']; } 
								$html .='</td></tr>';
$html .= '</table>'; if($rsprint1['pay_mode'] == "Online"){  }else{
$html .= '<table border ="1" style="margin:5px; font-size:12px;  font-weight:bold; width:694.5px;">
<tr class="row2" height="30" >
 <td ><strong>Bank: </strong></td>
<td ><strong>'. $mod1  .'</strong></td>
     <td ><strong>Teller No:</strong></td>
<td ><strong>'.$mod2.'</strong></td>
      <td ><strong>PIN:</strong></td>
<td ><strong><font color="green">'.hide_phone($rsprint1['pin']);
$html .= '&nbsp;</font></strong></td>
    </tr> </table>'; }
$html .= '<p></p>';

$html .= '<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0"
 style="border-collapse:collapse;border:none;mso-yfti-tbllook:1000;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none"> <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:44.85pt">';

$html.='<td width="180" valign="top" style="width:200.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt"><div style="float:left;"> ';

  
  $html .='</div></td><td></td>';
  
  $html .='<td width="180" valign="top" style="width:200.8pt;">
<div style="float:right;">';

$html .= '</div></td></tr>';
$html .= '<tr><td colspan="4"><span class="style5">The student has satisfied the School   requirement, I recomend that the payment of fees of the above  session be approved</span></td></tr></table>';
$html .= '<p></p>';

$html .= '<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0"
 style="border-collapse:collapse;border:none;mso-yfti-tbllook:1200;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:44.85pt">';
 
 $html .= ' <td width="300" valign="top" style="width:200.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt">
  <p class="MsoNormal" align="center"  style="margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal"><span ><b style="mso-bidi-font-weight:normal">'."STUDENT SIGNATURE AND DATE".'</b></span></p></td>';
  
  $html .='<td width="100" valign="top" style="width:200.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt">
  <p class="MsoNormal" align="center"  style="margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal"><span>  </span></p>
  </td>';
  
  $html .='<td width="300" valign="top" style="width:200.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt">
  <p class="MsoNormal" align="center"  style="margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal"><span ><b style="mso-bidi-font-weight:normal">'."BUSARY SIGNATURE AND DATE ".'</b></span></p></td>';
 $html .=' </tr>';
 
  $html .='<tr style="mso-yfti-irow:1;height:17.85pt">';
  
  $html.='<td width="300" valign="top" style="width:200.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt">';
  $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><u><span
  style="font-size:8.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"">'.ucwords($loadcom['princom']). '</span></u></p>';
  $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;mso-bidi-font-size:11.0pt;font-family:"Verdana","serif";color:black;">';
  //if ($signprinc['sign_image']==NULL  ){ 
  //$html .='<img id="lblPrinceImg" src="uploads/signpic.png" style="height: 20px; width: 80px; border-width: 0px;">';
	//}else{
	//$html .='<img id="lblPrinceImg" src="'.	$signprinc['sign_image'].'" style="height: 20px; width: 80px; border-width: 0px;">';
//}

$html .='---------------------------<o:p></o:p></span></b></p>';
   $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;mso-bidi-font-size:12.0pt;font-family:"Tahoma","serif";color:black;text-shadow:0 2px 2px gray;">'. $signprinc['staff_fname']." ".$signprinc['staff_sname']. '<o:p></o:p></span></b></p>';
  $html .='</td>';
  
  $html .='<td width="100" valign="top" style="width:200.85pt;padding:0in 5.4pt 0in 5.4pt;height:17.85pt">
  <p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b style="mso-bidi-font-weight:normal"><u><span></span></u></b></p>
  </td>';
   $html .='<td width="300" valign="top" style="width:200.85pt;padding:0in 5.4pt 0in 5.4pt;height:17.85pt">';
  $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><u><span
  style="font-size:8.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"">'.ucwords($loadcom['formcom']).'</span></u></p>';
  $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","serif";color:black;">';
  
  //if ($num_rowsstaff['sign_image']==NULL  ){
  //$html .='<img id="lblPrinceImg" src="uploads/signpic.png" style="height: 20px; width: 80px; border-width: 0px;">';
//	}else{
	//$html .='<img id="lblPrinceImg" src="'.	$num_rowsstaff['sign_image'].'" style="height: 20px; width: 80px; border-width: 0px;">';
//}
  
  $html .='---------------------------<o:p></o:p></span></b></p>';
  
  $html .='<p class="MsoNormal" align="center" style="margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;mso-bidi-font-size:12.0pt;font-family:"Tahoma","serif";color:black;text-shadow:0 2px 2px gray;">'. $num_rowsstaff['staff_fname']." ".$num_rowsstaff['staff_sname']. '<o:p> </o:p></span></b></p>';
   $html .='</td>';
  
$html .='</tr><tr><td colspan="4"><strong><font color="red">Note:This payment Receipt is void if not signed and Stamped.</font></strong></td></tr>';
  $html .=' </table>';
	

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//}


//$pdf->Output("All_".$classsnp."".$c_typep."_Result_Sheet_For_"."".$sessp.'.pdf', 'I');
$pdf->Output($classcat."_".$rsprint['session']."_Academic_Session".'.pdf', 'I');


?>
