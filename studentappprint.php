  <?php
include("header1.php");
//include("dbconnection.php");
//$sql1 = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($condb,$_GET['applicationid'])."'";
$existl = imgExists("admin/".$row['Logo']);
$sql1 = mysqli_query($condb,"select * from new_apply1  where md5(appNo) ='".safee($condb,$_GET['applicationid'])."'")or die(mysqli_error($condb));
$rsprint1 = mysqli_fetch_array($sql1);
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$rsprint1['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 700px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php if ($existl > 0 ){ echo "admin/".$row['Logo']; }else{ echo "css/images/logo.png";}  
	//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "./admin/".$row['Logo'];} ?>  " class="muted pull-left" height="80" width="100"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: inline; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" border="0" class="tble">
    
	<tr style="background-color:#FFC">
            <td height="30" colspan="2"> <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
     <center><font size="+2">NEW STUDENT APPLICATION SLIP</font></center>
      <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
      <p>Please Come along with This Application Slip on the Day Of Screening Excesice .</p>
      <p>Your can Reprint this Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['appNo']);  ?></font> Application Number.</p>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php 
   $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($condb,$_GET['applicationid'])."'";
   
if(!$qsql=mysqli_query($condb,$sql))
{
	echo mysqli_error($condb);
}
$rsprint = mysqli_fetch_array($qsql);
$existn = imgExists("Student/".$rsprint['images']);
if ($existn > 0 ){ echo "Student/".$rsprint['images'];}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
//if ($rsprint['images']==NULL ){print "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $rsprint['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>" width="200" height="130" >
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center"><br><br>
  Application Number:<?php echo  $rsprint['appNo']; ?>
  </div></td>
     
          </tr>
<div class="rounded">
        <table style="margin:5px; font-size:15px; font-family: Verdana;  font-weight:bold; width:900px;" class="tble">
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Basic Details:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Jamb Registration No:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['JambNo']); ?></td>
            <td width="26%">Jamb Score:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['J_score']); ?></td>
          </tr>
          <tr>
            <td height="43">Academic Session:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Asession']); ?></td>
           <?php  
			 if(empty($row['e_date'])){
			 
			 
			  ?>
             <td height="43">Date For Screening:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      -----------------
             </td>
             <?php }else{ ?>
              <td height="43">Date For Screening:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  $row['e_date'].", ". $row['e_time']; ?>
             </td>
             
             <?php } ?>
            <td>
              
             </td>
          </tr>
          
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Personal Data:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Surname:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['FirstName']); ?></td>
            <td width="26%">Middle Name:</td>
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
         <table border="0" style="margin:5px; font-size:15px; font-family: Verdana; font-weight:bold; width:900px;" class="tble">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Choice of Course/Program:</strong></td>
        </tr>
        <tr style="border: 1px solid #98C1D1;">
          <td>First Choice:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo  getdeptc($rsprint['first_Choice']); ?></td>
         
        </tr>
        <tr style="height: 34px;border: 1px solid #98C1D1; ">
          <td></td> <td></td> 
          
        </tr>
        <tr style="border: 1px solid #98C1D1;">
          <td height="30">Second Choice:</td>
          <td style="font-color:gray;  font-weight:normal;"><p id="mobile  number">
            <?php echo  getdeptc($rsprint['Second_Choice']); ?>
          </p></td>
         
        </tr>
        </table>
        <table border="0" style="margin:5px; font-size:15px; font-family: Verdana; font-weight:bold; width:900px;" class="tble" >
       <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Post Primary School Qualification ('O' Level Record)</strong></td></tr>
           <?php  $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20); if($countnosub > 0){$subcont = $orow_1['oNo_re'];}else{ $subcont = $orow_01['oNo_re']; } if($count_olresult1 > 0 ){ ?>
        <tr style="height: 30px;"><td rowspan="2">First Certificate Used</td><td>Exam Type</td><td>Exam Number</td><td>Exam Year</td></tr>
        <tr style="height: 30px;" ><td style="font-color:gray;  font-weight:normal;"><?php echo getexamtype($orow_01['oExam_t1']);?></td><td style="font-color:gray;  font-weight:normal;"><?php echo $orow_01['oExam_no1'] ;?></td><td style="font-color:gray;  font-weight:normal;"><?php echo ($orow_01['oExam_y1']); ?></td></tr>
      <tr style="height: 30px;text-align:center;"><td colspan="4">First Certificate Subject Grades</td></tr>
      <?php $sn1=1; while($orow1 = mysqli_fetch_array($sql_oresult1)){ ?>
      <tr style="height: 30px;border: 1px solid #98C1D1;"><td colspan="1" style="font-color:gray;  font-weight:normal;text-align:center;"> <?php echo $sn1++; ?></td><td colspan="2" style="font-color:gray;  font-weight:normal;"><?php echo  getf_sub($orow1['oSub1']);?></td><td colspan="1" style="font-color:gray;  font-weight:normal;"><?php echo getfgrade($orow1['oGrade_1']); ?></td></tr> <?php } $sn2=1; if($count_olresult2 > 0){ ?>
      
      <tr style="height: 30px;"><td rowspan="2">Second Certificate Used</td><td>Exam Type</td><td>Exam Number</td><td>Exam Year</td></tr>
        <tr style="height: 30px;" ><td style="font-color:gray;  font-weight:normal;">WEAC</td><td style="font-color:gray;  font-weight:normal;">AB34567891</td><td style="font-color:gray;  font-weight:normal;">2018</td></tr> 
         <tr style="height: 30px;text-align:center;"><td colspan="4">Second Certificate Subject Grades</td></tr>
        <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ ?>
       <tr style="height: 30px;border: 1px solid #98C1D1;" id="rown"><td colspan="1" style="font-color:gray;  font-weight:normal;text-align:center;"><?php echo $sn2++; ?></td><td colspan="2" style="font-color:gray;  font-weight:normal;"><?php echo getf_sub($orow12['oSub1']);?> </td><td colspan="1" style="font-color:gray;  font-weight:normal;"><?php echo getfgrade($orow12['oGrade_1']);?></td></tr>
        <?php }}}else{ ?> <tr style="height: 30px;"><td colspan="4"> No Certificate information Added Yet For This Student.</td></tr><?php } ?>
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
                      