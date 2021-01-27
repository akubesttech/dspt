  <?php
include("../Student/header1.php");
//include("dbconnection.php")
include('session.php');
$instid = getinstitution($class_ID);
$institu_n = getincate($instid);
if($instid == "1"){$mastername = "Vice Chancelor"; $disp = "display:none;";$disp2 = ""; $messagen = "";
}elseif($instid == "2"){$mastername = "Rector"; $disp = "display:none;";$disp2 = ""; $messagen = "";
}else{$mastername = "Provost";$disp = "";$disp2 = "display:none;"; $messagen = "";} 
  $existl = imgExists($row['Logo']);
  $saddress = $row['Address']; $state = $row['State'];$city = $row['City']; $Motto = $row['Motto'];
  $Pcode = $row['Pcode']; $webs = $row['WebAddress']; $Phone_no = $row['OfficePhone']; $email = $row['SEmail'];
 
//if($SCategory =="Faculty")
  
  $student_query2 = mysqli_query($condb,"SELECT * FROM student_tb WHERE  RegNo='".safee($condb,$_GET['transid'])."' and Department ='".safee($condb,$_GET['depo'])."' and app_type ='".safee($condb,$class_ID)."'  ORDER BY p_level ASC")or die(mysqli_error());
		$num_rows2 =mysqli_num_rows($student_query2);
		if($num_rows2 < 1){ message("Student Record Not Found please Try Again", "error");
    redirect('Student_Record.php?view=s_tra'); }
    $row2 = mysqli_fetch_array($student_query2);
	$departmen = $row2['Department'];
    $student_prog = $row2['app_type'];
    $certinview = getcertinview($row2['Cert_inview']);
    $regen = $row2['RegNo']; $addy = $row2['yoe'] + 1;
    $sessionadmited = $row2['yoe']."/".$addy;
    $origDate = $row2['dog'];
    $date = str_replace('/', '-', $origDate );
$gragdate = date("Y-m-d", strtotime($date));
$transdate = date("Y-m-d");
$timestamp = strtotime($gragdate);
$printdate	= date('jS M, Y', $timestamp);
$sql_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_min ASC ")or die(mysqli_error($condb)); 
$sql_gradesetl = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error($condb)); 
    $getmg2 = mysqli_fetch_array($sql_gradesetl);    $getpassl = $getmg2['b_max'];
    $fincgpa = getcgpa($regen,$student_prog);
    //get school head information
    $sql_sheadq = mysqli_query($condb,"select * from staff_details sd  LEFT JOIN role ro ON  sd.access_level2 = ro.role_rolecode where roleorder ='3' AND  u_display = 'TRUE'  limit 1 ")or die(mysqli_error($condb)); 
    $getsheadq = mysqli_fetch_assoc($sql_sheadq); $Quali = $getsheadq['oder_quali']; $Headname = $getsheadq['title'].".".$getsheadq['sname']." ".$getsheadq['mname']." ".$getsheadq['oname'];

//get registrar info 
$sql_sregistrar = mysqli_query($condb,"select * from staff_details sd  LEFT JOIN role ro ON  sd.access_level2 = ro.role_rolecode where roleorder ='7' AND  u_display = 'TRUE'  limit 1 ")or die(mysqli_error($condb)); 
    $getregt = mysqli_fetch_assoc($sql_sregistrar); $Qualr = $getregt['oder_quali']; $registraname = $getregt['title'].".".$getregt['sname']." ".$getregt['mname']." ".$getregt['oname'];
$simgcheck = imgExists($getregt['sign_img']); $mstatus = $getregt['mstatus']; $sex = $getregt['Gender'];
if($mstatus == "Married" && $sex == "F" && $getregt['title'] !== "Mrs" ){ $htn = "(Mrs.)";}else{$htn = "";}
$registranamesign = $getregt['title'].". ".strtoupper(substr($getregt['mname'],0,1)).".".strtoupper(substr($getregt['oname'],0,1))." ".strtoupper($getregt['sname'])." ".$htn;

    //$regen = $row2['RegNo'];
$q_gradeset = mysqli_query($condb,"select * from grade_tb where prog ='".safee($condb,$student_prog)."' and grade_group ='01' Order by b_min desc ")or die(mysqli_error($condb));		

//get cgpa per subject college
function getscgpa($s_id,$prog,$sub=""){ $tp = 0; $cu = 0; $cgpa = "0.00";
$sqlGRD = mysqli_query(Database::$conn,"select * from grade_tb where prog ='".safee(Database::$conn,$prog)."' and grade_group ='01' Order by b_max ASC limit 1 ")or die(mysqli_error(Database::$conn)); 
    $getmg2 = mysqli_fetch_array($sqlGRD);    $getpassl = $getmg2['b_max'];
$queryf = "Select Distinct course_code,c_unit,session,semester,total from results WHERE student_id = '".trim($s_id)."' "; 
if($sub == "1"){$queryf .= " and course_code like '%EDU 311%' ";}
  if($sub == "2"){$queryf .= " and course_code like '%GSE%' ";}
  if($sub == "3"){$queryf .= " and course_code like '%EDU%' and  course_code<>'EDU 311'";}
  if($sub == "4"){$queryf .= " and course_code like '%PHE%' ";}
  if($sub == "5"){$queryf .= " and course_code like '%BIO%' ";}
  if($sub == "6"){$queryf .= " and course_code like '%ECO%' ";} 
 $queryf .= "and exam > 0 and total >= '".safee(Database::$conn,$getpassl)."'";
 $queryresult = mysqli_query(Database::$conn,$queryf) or die(mysqli_error(Database::$conn));
while($row_camt = mysqli_fetch_array($queryresult)){
    $gp1 = gradpoint($row_camt['total'],$prog) * $row_camt['c_unit']; $tp += $gp1 ; $cu += $row_camt['c_unit'];
  }
  //mysqli_close(Database::$conn);
 if($tp  > 0){ return $cgpa = round($tp/$cu,2,2); }else{ return $cgpa = "0.00"; }
}
if($certinview == "HND"){ $sview = "Higher National Diploma";}else{ $sview = "National Deploma"; }
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 800px;">
<style type="text/css" media="all"> @media print { a[href]:after {content: none !important;} }
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }  @page {size: auto;margin: 0;}
    #intemok{font-family:Verdana, Geneva, sans-serif; font-size:12px;font-weight:normal;font-style: normal;}
    
					  </style>
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1"  >
  <div id= "print_content">
 <div class="navbar navbar-inner block-header">

<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
<img src=" <?php if ($existl > 0 ){ echo $row['Logo'];}else{ echo "../Student/css/images/logo.png";} ?>  " class="muted pull-center" style=" width:90px; height:60;"> <span style="color: #3277bc; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; ">
<br><?php echo strtoupper($row['SchoolName']);  ?></span><br><span style="color: #e3132c; font-size:22px;  font-family:vandana;text-shadow: 1px 1px gray; "> 
<?php echo $Motto; ?></span></br>
<span style="color: #000000; font-size:18px;  font-family:vandana;text-shadow: 1px 1px gray; "><?php echo $Pcode; //$saddress." ,".$city." ".$state." State ."; ?></span></br>
<span style="color: #000000; font-size:18px;  font-family:vandana;text-shadow: 1px 1px gray; "><?php echo strtoupper($state)." STATE, NIGERIA"; ?></span>
 </i></div>
</div>
<div class="block-content2 collapse in"  >
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "../admin/".$row['Logo'];
	}else{ echo "../Student/css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block;!important; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
<table  align="center" style="margin:3px; font-size:15px;  font-weight:bold; width:900px;background-color: transparent;" class="tble"  border="0">
    
    


<tr style="<?php echo $disp2; ?>"><td style="font-size:13px;font-family:Verdana, Geneva, sans-serif;width: 380px;" colspan="1" height="33">
<?php echo  $mastername.": <span id='intemok'>".$Headname."<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$Quali; ?></span><br>Registrar : <span id="intemok"><?php echo $registraname."<br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$Qualr; ?>  </span>  
<br>Website:&nbsp;<span id="intemok"><?php echo $webs;?></span><br>
E-mail: <span id="intemok"><?php echo $email; ?></span><br>Tel: <span id="intemok"><?php echo $Phone_no; ?></span></td>
            <td height="33" colspan="1" style="text-align: center;">
   <img  src="<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";

		  $existn = imgExists($row2['images']);
		  		  if ($existn > 0 ){ echo $row2['images'];
	}else{ echo "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";} ?>" width="140" height="140" style=" border-radius: 50%;" >
  </td><td height="33"  colspan="1" style="text-align: center;font-family:Verdana, Geneva, sans-serif;width: 380px;">Date: <?php echo $printdate; ?>.</td>
     
          </tr>

<tr >
            <td height="15" colspan="3" style="font-size:21px;font-weight: bold;color: black; font-family:vandana;text-shadow: 1px 1px gray;" > 
            <div class="rounded2" align="center" id="intem"><br> NOTIFICATION OF RESULT 
  <?php //echo strtoupper(getname($regen)); ?>
  </div></td>
     
          </tr>
<div class="rounded">
       
      
 <!-- University and Polytechnic --!>               
<table border='0' style='margin:1px; font-size:12px;   width:900px;background-color: transparent;<?php echo $disp2; ?>' class="tble">
<tr style='text-align:left;' ><td colspan='10' style="text-align: center;"><h4> This is to certify that</h4></td></tr>
<tr style='text-align:left;' ><td colspan='10' style="text-align: center;font-family: Arial Black;"><h2><?php echo strtoupper(getname($regen)); ?></h2></td></tr>
<tr  ><td colspan='1' style="width: 300px;" ><h4> With Matriculation Number </h4></td>
                
<td colspan='9' style="font-family: Arial Black;" ><h4> <?php echo  $regen; ?> </h4></td></tr>
<tr style='text-align:justify;' ><td colspan='10' ><h4>
<?php if($instid == "1"){ ?>
 Satisfy the Examinars and the Senate of the <?php echo  $institu_n; ?> in all
requirments for the award of the degree of Bachelor of Science  
<?php }elseif($instid == "2"){ ?>
Have now fulfilled all the requirements for graduation and the Academic Board has approved that you be  awarded a 
<?php echo $sview; ?>
<?php }else{} ?> 
</h4></td></tr>
<tr style='text-align:left;' ><td colspan='1' style="width: 300px;" ><h4> In </h4></td>
<td colspan='9' style="font-family: Arial Black;" ><h4> <?php echo ucwords(getdeptc($row2['Department']));?> </h4></td></tr>
<tr style='text-align:left;' ><td colspan='1' style="width: 300px;" ><h4> With </h4></td>
<td colspan='9' style="font-family: Arial Black;" ><h4> <?php echo Resultremark($fincgpa,$student_prog); ?></h4></td></tr>
<tr style='text-align:left;' ><td colspan='10' ><h4> The <?php echo $certinview; ?> will be conferred on you at the next 
Convercation of the <?php echo  $institu_n; ?>.</br>Accept Our Congratulations.  </h4></td></tr>
</table>
   <!-- College of Education --!> 
   <table border='0' style='margin:1px; font-size:11px;   width:900px;background-color: transparent;<?php echo $disp; ?>' class="tble">
<tr style='text-align:left;' ><td colspan='4' style="text-align: left;"><h4> NAME :</h4></td> 
<td colspan='6' style="text-align: center;font-family:vandana;"><h4><?php echo strtoupper(getname($regen)); ?></h4></td></tr>
<tr style='text-align:left;' ><td colspan='4' style="text-align: left;"><h4> MATRICULATION NUMBER :</h4></td> 
<td colspan='6' style="text-align: center;font-family:vandana"><h4><?php echo  $regen; ?></h4></td></tr>
<tr style='text-align:left;' ><td colspan='4' style="text-align: left;"><h4>SUBJECT COMBINATION :</h4></td> 
<td colspan='6' style="text-align: center;font-family:vandana"><h4><?php echo ucwords(getdeptc($row2['Department']));?></h4></td></tr>
<tr style='text-align:left;' ><td colspan='4' style="text-align: left;"><h4> SESSION ADMITTED :</h4></td> 
<td colspan='6' style="text-align: center;font-family:vandana"><h4><?php echo $sessionadmited; ?></h4></td></tr>
<tr style='text-align:left;' ><td colspan='4' style="text-align: left;"><h4> DATE OF GRADUATION :</h4></td> 
<td colspan='6' style="text-align: center;font-family:vandana"><h4><?php echo $printdate; ?></h4></td></tr>
<tr style='text-align:justify;font-size: 21px;' ><td colspan='10' > I have the pleasure inform you that you have now fulfilled all 
the institution academic requirement for the Award of the  Nigeria certificate in Education.</br>
Conseqently, you have been awarded the Nigeria Certificate in Education with the following:- </br></br> </td></tr>

</table>

   <table border='1' style='margin:4px; font-size:13px;  font-family: Verdana; font-weight:bold; width:900px;background-color: transparent;<?php echo $disp; ?>' class="tble">
  <tr style="font-weight: bold;"><td colspan="2">SUBJECT </td><td colspan="2">GRADE </td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">PRACTICAL TEACHING</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,1),$student_prog); ?></td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">GENERAL STUDIES</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,2),$student_prog); ?></td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">EDUCATION</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,3),$student_prog); ?></td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">HEALTH EDUCATION</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,4),$student_prog); ?></td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">BIOLOGY</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,5),$student_prog); ?></td> </tr>
   <tr style="font-weight: bold;"><td colspan="2">ECONOMICS</td><td colspan="2"><?php echo Resultremark(getscgpa($regen,$student_prog,6),$student_prog); ?></td> </tr>
<tr style="font-weight: bold;"><td colspan="2">OVERALL CLASSIFICATION</td><td colspan="2"><?php echo Resultremark($fincgpa,$student_prog); ?></td> </tr>
  </table>
  
   <table border='0'style='margin:4px; font-size:13px;  font-weight:bold; width:900px;background-color: transparent;''>
       
        <tr >
         <td colspan="4">&nbsp;</td>
       </tr>
       
        <tr class="row24">
  <td width="50%" colspan="<?php echo $col; ?>" ><div class="pull-left">
  <table border="0" style="margin:4px;  font-family: Verdana;  max-width:390px; min-width:400px;background-color: transparent; " >
  <tr style="font-weight: bold;"><td colspan="2"> &nbsp;&nbsp;</td> </tr>
  <tr style="<?php echo $disp; ?>"><td colspan="2">Accept My Congratulation</td></tr>
  <tr style="<?php echo $disp; ?>"><td colspan="2">Yours Faithfully</td></tr>
  <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
  <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
  <tr> <?php if ($simgcheck > 0 ){ ?> <td colspan="2"><img id="lblPrinceImg" src=" <?php  echo $getregt['sign_img'];?> " style="height: 35px; width: 160px; border-width: 0px;"></td>
         <?php }else{ ?>
          <td colspan="2">_________________________________&nbsp;&nbsp;</td>
         <?php } ?></tr>
   <tr style="font-weight: bold;"><td colspan="2"><strong> <?php echo $registranamesign; ?> </strong></td></tr>
    <tr><td colspan="2"><b>REGISTRAR.</b></td></tr> 
   </table>
   </div></td>
   <td colspan="1">&nbsp;&nbsp;</td>
   <?php //if($count_olresult2 > 0){ ?> <td width="50%" colspan="<?php echo $col; ?>"><div class="pull-right"> 
   <table border="0" style="margin:3px;  font-family: Verdana;  max-width:400px; min-width:400px;background-color: transparent;<?php echo $disp; ?>">
    <tr style="font-weight: bold;"><td colspan="2"><u> GRADES OBTAINABLE GRADE POINT</u></td> </tr>
  
  <?php foreach( $q_gradeset as $get_proc ) {  $gstart = $get_proc['gpmin'];	$gend = $get_proc['gpmax']; $remark = $get_proc['gradename'];?>
   <tr><td><?php echo $remark;?></td><td><?php echo  $gstart." ". " - ".   $gend." ";?></td></tr> <?php } ?>
   <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
  
     </table></div></td> 
     </tr>
  
     
        <tr style="font-size:8;text-align: left;display: none;">
        <?php if ($simgcheck > 0 ){ ?> <td colspan="1"><img id="lblPrinceImg" src=" <?php  echo $getregt['sign_img'];?> " style="height: 35px; width: 160px; border-width: 0px;"></td>
         <?php }else{ ?>
          <td colspan="1">_________________________________&nbsp;&nbsp;</td>
         <?php } ?>
         <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp; </td>
         <td colspan="1">  </td>
       </tr>
       
       <tr style="font-size:16;text-align: left; display: none;">
         <td colspan="1" style="font-family: Arial Black;"><strong> <?php echo $registranamesign; ?> </strong>
         </br><b>REGISTRAR.</b></td>
         <td colspan="1"><strong></strong> </td>
          <td colspan="1"><strong></strong> </td>
       </tr>
      
       <tr>
         <td colspan="4">&nbsp;</td>
       </tr>
       <!--
       <tr>
         <td colspan="4">_______________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;             _________________________________________</td>
       </tr>
       <tr>
         <td colspan="2"><strong>FORM TEACHER SIGNATURE </strong></td>
         <td colspan="4"><strong>DATE</strong></td>
       </tr>--!>
       <tr>
         <td colspan="4"><strong><font color="red"></font> </strong></td>
       </tr>
     
      <?php //}?>
</table>
      </div>

<br>
<tr><td colspan="2" align="left" height="40"><div id="ccc2">	

 <button data-placement="right" title="Click Here To Exit Page" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='Student_Record.php?view=s_tra';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

  <button data-placement="right" title="Click to Print " id="reset2" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print </button></div>	

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');$('#reset2').tooltip('show');
	                                            $('#reset').tooltip('hide');$('#reset2').tooltip('hide');
	                                            });
	                                            </script>
	                                          

<script>
function myFunction() {document.all.ccc2.style.visibility = 'hidden';
window.print();
    document.all.ccc2.style.visibility = 'visible';
}
</script>
</td></tr>

</table>
                                
                                 </div>
                                 
                                 
                                  </div>
										
						
										<div class="control-group">
                                          <div class="controls">

                                          </div>
                                        </div>
                                </form>
								
								</div>
								
								
                            </div></div>
                        </div>
                        <!-- /block -->
                    </div>
                    </body>
                      </center>
                      <script>
					  
					  </script>