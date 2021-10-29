  <?php
include("header1.php");
include("admin/qrcode.php");
$qr = new qrcode();
//include("dbconnection.php");
//$sql1 = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($condb,$_GET['applicationid'])."'";
$existl = imgExists("admin/".$row['Logo']);
$Motto = $row['Motto'];
$sql1 = mysqli_query($condb,"select * from new_apply1  where md5(appNo) ='".safee($condb,$_GET['applicationid'])."'")or die(mysqli_error($condb));
$rsprint1 = mysqli_fetch_array($sql1);
$instid = getinstitution($rsprint1['app_type']);
$linkno = host()."studentappprint.php?applicationid=".$_GET['applicationid'];
$qr->text($linkno);
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);
?>
<style type="text/css" media="print"> @media print { /*a[href]:after {content: none !important;} */
  a[href]:after {visibility: hidden !important;}
 }
.row1 {background-color: #EFEFEF;border: 1px solid #98C1D1;
		height: 30px;	font-family:Verdana, Geneva, sans-serif; font-size:12px; }
.row2 {background-color: #DEDEDE;border: 1px solid #98C1D1;height: 30px; font-family:Verdana, Geneva, sans-serif; 
	font-size:12px; }  @page {margin: 0;size: portrait;}
					  </style>
<body style=" padding: 5px; height: 700px; ">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php if ($existl > 0 ){ echo "admin/".$row['Logo']; }else{ echo "css/images/logo.png";}  
	//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "./admin/".$row['Logo'];} ?>  " class="muted pull-center" height="60" width="90"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> 
    <br /><span style="color: #e3132c; font-size:22px;  font-family:vandana;text-shadow: 1px 1px gray; "> 
<?php echo $Motto; ?></span>
    </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block;!important;  -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
 <?php  $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($condb,$_GET['applicationid'])."'";
   if(!$qsql=mysqli_query($condb,$sql)){ echo mysqli_error($condb);}
$rsprint = mysqli_fetch_array($qsql); $getpro = $rsprint['app_type'];  $nchoice = $rsprint['course_choice']; 
if($nchoice == "1"){$fac_cn = $rsprint['fact_1'];$dept_cn = $rsprint['first_Choice'];}else{
$fac_cn = $rsprint['fact_2'];$dept_cn = $rsprint['Second_Choice'];}
$existn = imgExists("Student/".$rsprint['images']); ?>
 <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;background-color: transparent;" border="0" class="tble">
    
    

	<tr style="background-color:#FFC;">
            <td height="30" colspan="4" style="font-weight: bold;color: black; font-family:vandana;text-shadow: 1px 1px gray;"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
      
      <center><font size="+2">NEW STUDENT APPLICATION SLIP</font></center>
    <!--
     <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
      <p>Please Come along with This Application Slip on the Day Of Screening Excesice .</p>
      <p>Your can Reprint this Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['appNo']);  ?></font> Application Number.</p> --!>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <!--<div class="clear"><hr></div> -->
    </td>
     
          </tr>

<tr ><td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;width: 355px;text-align: justify;" colspan="1" height="30">
<p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
<p style="color: red;">
Please Come along with This Application Slip on the Day Of Screening Excesice .</p>
<p style="color: red;">Your can Reprint this Slip with your  Application Number and Password<font color="red"> <?php //echo ucfirst($rsprint1['appNo']);  ?></font>.
</p>
</td>
            <td height="30" colspan="1" style="text-align: center;width: 190px;">
   <img  src="<?php if ($existn > 0 ){ echo "Student/".$rsprint['images'];}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
  ?>" width="150" height="120" style=" border-radius: 50%;" >
  </td><td height="30"  colspan="1" style="text-align: center;font-family:Verdana, Geneva, sans-serif;355px;">
  <?php echo strtoupper(getprog($getpro)); ?><p style="font-size:15px;font-weight: bold;color: black; font-family:Verdana;">Application Number:<font color="green"><?php echo  $rsprint['appNo']; ?></font></p>
  <p><img src="<?php echo $qr->get_link(); ?>" width="130" height="130" style="margin-bottom: 2px;" border='0'/> </p>
  </td>
     
          </tr>

<tr >
<td height="32" colspan="4" style="font-size:21px;font-weight: bold;color: black; font-family:vandana;width: 300px;display: none;"> 
            <div class="rounded" align="center">Application Number:<?php echo  $rsprint['appNo']; ?>
  </div></td>
     
          </tr>


<div class="rounded">
        <table border="0" style="margin:5px; font-size:14px; font-family: Verdana;  font-weight:bold; width:900px;background-color: transparent;" class="tble" >
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Basic Details:</strong></td>
          </tr>
          <tr >
            <td width="22%" height="40">Jamb Registration No:</td>
            <td width="25%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['JambNo']); ?></td>
            <td width="22%">Jamb Score:</td>
            <td width="31%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['J_score']); ?></td>
          </tr>
          <tr>
            <td width="22%" height="43">Academic Session:</td>
            <td width="25%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Asession']); ?></td>
           <?php //  if(empty($row['e_date'])){?>
            <!-- <td height="43">Date For Screening:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      -----------------  </td>
             <?php //}else{ ?> --!>
              <td height="43" width="22%">Date For Screening:</td>
            <td style="font-color:gray;  font-weight:normal;" width="31%">
                      <?php echo getpumet($getpro,$fac_cn,$dept_cn) ; ?>
             </td>
             
             <?php //} ?>
            <td>
              
             </td>
          </tr>
          
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;border-width: 1px;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Personal Data:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Surname:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['FirstName']); ?></td>
            <td width="26%">First Name:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['SecondName']); ?></td>
          </tr>
          <tr>
            <td height="43">Other Name:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Othername']); ?></td>
            <td>Blood group:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  $rsprint['bloodgroup']; ?></td>
          </tr>
          <tr>
            <td height="30"><strong>Student Gender:</strong></td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['Gender']; ?></td>
            <td>Date of Birth:</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['dob']; ?></td>
          </tr>
          <tr>
            <td height="30">Hobbies:</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['hobbies']; ?></td>
            <td>Genotype:</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['gtype']; ?></td>
          </tr> 
          <tr>
            <td height="39">Religion:</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['religion']; ?></td>
            <td>Any Physical Disability?:</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['any_fchalenge']; ?></td>
          </tr>
          <tr>
            <td height="43">Mobile Number:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['phone']; ?>
             </td>
            <td height="43">Email Address:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['e_address']; ?>
             </td>
          </tr>
           <tr>
            <td height="43">Contact Address:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['address']; ?>
             </td>
            <td height="43">Local Government:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['lga']; ?>
             </td>
          </tr>
          <tr>
            <td height="43">State:</td>
            <td style="font-color:gray;  font-weight:normal;">
               <?php echo  $rsprint['state']; ?>
             </td>
            <td height="43">Nationality:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  $rsprint['nation']; ?>
             </td>
          </tr>
          
        </table>
         <table border="0" style="margin:5px; font-size:14px; font-family: Verdana; font-weight:bold; width:900px;background-color: transparent;" class="tble">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Choice of Course/Program:</strong></td>
        </tr>
        
        <tr style="border: 1px solid #98C1D1;">
          <td>First Choice:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo  getdeptc($rsprint['first_Choice']); ?></td>
         <td height="30">Second Choice:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo  getdeptc($rsprint['Second_Choice']); ?>
          </td>
        </tr>
        
        <tr style="height: 34px;border: 1px solid #98C1D1;display: none; ">
          <td colspan="4"></td>  </tr>
      <!--  <tr style="border: 1px solid #98C1D1;"> <td height="30">Second Choice:</td> <td style="font-color:gray;  font-weight:normal;"><p id="mobile  number">
            <?php echo  getdeptc($rsprint['Second_Choice']); ?></p></td></tr>--!>
        
        </table>
        <table border="0" style="margin:5px; font-size:14px; font-family: Verdana;  width:900px;" class="tble" >
       <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Post Primary School Qualification ('O' Level Record)</strong></td></tr>

<?php $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20);
if($countnosub > 0){$subcont = $orow_1['oNo_re']; $col =2;}else{ $subcont = $orow_01['oNo_re']; $col = 4; } 
 if($count_olresult1 > 0 ){ ?>
        <tr class="row2">
  <td width="50%" colspan="<?php echo $col; ?>" ><div class="pull-left">
  <table border="1" style="margin:4px;  font-family: Verdana;  max-width:390px; min-width:440px;background-color: transparent; " >
  <tr style="font-weight: bold;"><td colspan="2"> First Certificate Used</td> </tr>
  <tr><td>Exam Type</td><td><?php echo getexamtype($orow_01['oExam_t1']);?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_01['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_01['oExam_y1']); ?></td></tr>
   <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
   <?php while($orow1 = mysqli_fetch_array($sql_oresult1)){ ?> <tr><td><?php echo  getf_sub($orow1['oSub1']);?></td><td><?php echo  getfgrade($orow1['oGrade_1']);?></td></tr> <?php } ?>
   </table>
   </div></td>
   <?php if($count_olresult2 > 0){ ?> <td width="50%" colspan="<?php echo $col; ?>"><div class="pull-right"> 
   <table border="1" style="margin:3px;  font-family: Verdana;  max-width:390px; min-width:440px;">
    <tr style="font-weight: bold;"><td colspan="2"> Second Certificate Used</td> </tr>
     <tr><td>Exam Type</td><td><?php echo getexamtype($orow_1['oExam_t1']);?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_1['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_1['oExam_y1']); ?></td></tr>
  <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
  <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ ?>
   <tr><td><?php echo getf_sub($orow12['oSub1']);?></td><td><?php echo  getfgrade($orow12['oGrade_1']);?></td></tr> <?php } ?>
     </table></div></td> <?php } ?>
     </tr>
    <?php }else{ ?>
   <tr class="row2">
     <td width="20%" colspan="4" height="15" style="text-align:center;"><strong> You have not add any Result Goto Step Two.</strong></td>
</tr>  <?php } ?>
    </table>
      </div>

<br>
<tr><td colspan="2" align="left" height="40">
   <button data-placement="right" title="Click Here To Exit Application Slip" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='apply_b.php';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

  <button data-placement="right" title="Click to Print Slip" id="reset" name="B2" class="btn btn-info" onClick="myFunction()" type="reset"><i class="icon-file icon-large"></i> Print Slip</button>

												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#reset').tooltip('show');
	                                            $('#reset').tooltip('hide');
	                                            });
	                                            </script>
	                                          

<script>
function myFunction() {
    window.print();
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
								
								
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    </body>
                      </center>
                      