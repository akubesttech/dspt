<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 14 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:13.0in 8.5in;
	margin:48.25pt .5in .5in .75in;}
div.WordSection1
	{page:WordSection1;}

-->
	@page {size: auto;margin: 10pt;}
</style>
<?php include('print_header.php'); ?>
<?php include('session.php'); ?>

													
</head>

<body lang=EN-US>
<div class="empty">
<?php //include('navbar.php'); ?>
<!--<div class="container">
  <div class="row-fluid">
      <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <i class="icon-check"></i><strong> Student Payment List</strong>
            </div>
       </div>
    </div>
  </div> --!>
 </div>
</div>

 <div class="container">
 <div class="row-fluid">
 <div class="block">
<div class="row-fluid">
<?php 
$sec = $_GET['sec'];$coursed = $_GET['cos'];
$sql_pinn2=mysqli_query($condb,"SELECT * FROM coursereg_tb  WHERE c_code ='".safee($condb,$coursed)."'  AND session = '".safee($condb,$sec)."'");
$dform_checkexist = mysqli_num_rows($sql_pinn2);
		if($dform_checkexist < 1){
	message("The page you are trying to access is not available.", "error");
		        redirect('Student_Record.php?view=p_book');
		        exit();
}
$existsl = imgExists($row1['Logo']);
$student_query = mysqli_query($condb,"SELECT pt.pay_status,ct.c_code,ct.sregno,ct.session FROM payment_tb pt LEFT JOIN coursereg_tb ct ON  ct.sregno = pt.stud_reg WHERE ct.session ='".safee($condb,$sec)."' and ct.c_code='".safee($condb,$coursed)."' and pt.pay_status ='1' and pt.prog ='".safee($condb,$class_ID)."' GROUP BY stud_reg ORDER BY RAND()") or die(mysqli_error($condb));
$num_rows =mysqli_num_rows($student_query);
?>
													
<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><br><img width="100" height="70" id="Picture 1"
src="   <?php  if ($existsl > 0 ){ print $row1['Logo'];
	}else{ print "uploads/NO-IMAGE-AVAILABLE.jpg";}
///if ($row1['Logo']==NULL or $row1['Logo']=='uploads/' ){
//	echo "upload/NO-IMAGE-AVAILABLE.jpg";	}else{echo $row1['Logo'];} ?>  "  ></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:18.0pt;
font-family:"Times New Roman","serif"'><?php echo $row1['SchoolName']; ?></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
font-family:"Times New Roman","serif"'><?php echo $row1['Motto']; ?></span></b></p>
<br> 
<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:15.0pt;
font-family:"Times New Roman","serif"'><?php echo getprog($class_ID); ?></span></b></p>
 
<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><u><span style='font-size:16.0pt;
font-family:"Times New Roman","serif";color:green;'> Exam Photo Book <?php echo $sec;?> Session for <br><?php echo getcourse($coursed)." (".$coursed.")"; ?> </span></u></b></p>
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:10.0pt;font-family:"Times New Roman","serif"'>&nbsp;</span></b></p>

<div class="container">
<div class="container-fluid">
<div class="row-fluid">
<div class="pull-left"> 
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:13.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>
<?php  echo "The Following Student(s) are qualified to Seat For  <b>".getcourse($coursed)." (".$coursed.") Examination </b> For ".$sec;
?><br>And There Seating Arrangement is as Follows. <o:p></o:p><br>
Total No of Student Seating for <b><?php if($num_rows > 0){echo $coursed.":  ".$num_rows;}else{echo $coursed.":  0";};?></b> </span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'>DATE: <?php
 $date = new DateTime();
 echo $date->format('l, F jS, Y');
 ?><o:p></o:p></span></p><br>  

<div class="pull-right">
   <div class="empty" id="ccc2" >
           <p class=MsoNormal style='margin-bottom:0in; margin-left:-110px; margin-top:-30px; margin-bottom:.0001pt;line-height:
           normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
           "Times New Roman","serif"'>
		   <a  onClick="myFunction()" class="btn btn-info" id="print2" data-placement="top" title="Click to Print"><i class="icon-print icon-large"></i> Print List</a></p>		      
		   <script type="text/javascript">
		     $(document).ready(function(){
		     $('#print').tooltip('show');
		     $('#print').tooltip('hide');
		     });
		   </script> 
            <p class=MsoNormal style='margin-bottom:0in; margin-top:-30px; margin-bottom:.0001pt;line-height:
            normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
           "Times New Roman","serif"'>
			<a id="return" data-placement="top" class="btn btn-success" title="Click to Return" href="Student_Record.php?view=p_book"><i class="icon-arrow-left"></i> Back</a></p>		
			<script type="text/javascript">
			$(document).ready(function(){
			$('#return').tooltip('show');
			$('#return').tooltip('hide');
			});
			</script>       	   
    </div>
</div>
    
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>
<table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
<strong> <hr></strong>
   <!-- MYSQL FETCH ARRAY-->
  
<?php
$serial=1;
if($num_rows >0){
        while($num_rows>0){
  ?>
<tr  >
 <?php   $i = 6;  $r=0; $countno = 1000;      if($i>$num_rows){
	$i=$num_rows;
}while($r <$i){  // while($row = mysqli_fetch_array($student_query)){
    $row = mysqli_fetch_array($student_query);
    $simage = getsimage($row['sregno']);
    $existn = imgExists("../Student/".$simage);
  $namecourse2 = strtoupper(getsname($row['sregno']));
    ?><td>
<table>
<tr>
<td style="padding: 8px;text-align: center;">
    <div style=" width: 160px;">
          <img src="<?php if ($existn > 0 ){ echo "../Student/".$simage;
	}else{ echo "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" alt="<?php echo $namecourse2; ?>" style="width: 160px;height: 150px;" />
    <div>Mat No:<?php echo $row['sregno']; ?></div><div><strong><?php echo $namecourse2; ?></strong></div><div>Seat No:<?php echo $countno+$serial++;?> </div></div>
</td></tr>
</table>

</td>
<?php //} 
$r+=1; } ?></tr>
<?php $num_rows-=6; }}else{ ?>
<tr>
<td style="padding: 8px;text-align: center; width: 1184;"> No Student(s) Record Found for <b><?php echo getcourse($coursed)." (".$coursed.")";?> 
   </b></td></tr><?php } ?>
</table>
<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
 <strong> <hr></strong>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:44.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'><!--Prepared by:--!><o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'><!--Received by:--!><o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center  style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Times New Roman","serif"'><!--Check by:--!><o:p></o:p></span></p>
  </td>
  
 </tr>
 
 <?php $query= mysqli_query($condb,"select * from admin where admin_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
  $row3 = mysqli_fetch_array($query);
?>
<!--
 <tr style='mso-yfti-irow:1;height:17.85pt'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'><?php echo $row3['firstname']." ".$row3['lastname'];  ?><o:p></o:p></span></u></b></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_____________________<o:p></o:p></span></u></b></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>_______________________<o:p></o:p></span></u></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=376 valign=top style='width:281.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>System Administrator<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>School Registrer<o:p></o:p></span></p>
  </td>
  <td width=376 valign=top style='width:281.85pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  mso-bidi-font-size:11.0pt;font-family:"Times New Roman","serif"'>School Bursar<o:p></o:p></span></p>
  </td>
 </tr>--!>
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;mso-bidi-font-size:11.0pt;font-family:
"Times New Roman","serif"'><o:p>&nbsp;</o:p></span></p>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
}
</script>
</div>	
<?php //include('footer.php'); ?>
</div>
<?php //include('../script.php'); ?>
 </body>
</html>