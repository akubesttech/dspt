  <?php
include("header1.php");
//include("dbconnection.php");
$sql1 = "SELECT * FROM student_tb  WHERE md5(RegNo) ='".safee($condb,$_GET['stid'])."'";
$qsql1=mysqli_query($condb,$sql1);
 $existl = imgExists("admin/".$row['Logo']);
$dform_checkexist20 = mysqli_num_rows($qsql1);
if($dform_checkexist20 < 1){ message("The page you are trying to access is not Available.", "error");
//echo "<script>alert('The page you are trying to access is not Available!');</script>";
redirect(host()); }
$rsprint1 = mysqli_fetch_array($qsql1);

?>

<body style="background-color: rgb(59, 59, 59); padding: 4px; height: 800px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php if ($existl > 0 ){ echo "admin/".$row['Logo'];}else{ echo "css/images/logo.png";} 
//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "./admin/".$row['Logo'];} ?>  " class="muted pull-left" width="100" height="80"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; ">
								
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
     <center><font size="+2">STUDENT'S INFORMATION FORM</font></center>
      <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
      <p>Please print a copy of this form and return to Admin Block for Verification.</p>
      <p>You can Reprint this Form with your Matric Number.</p>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" width="200" height="130" src="<?php 
   $sql = "SELECT * FROM student_tb  WHERE md5(RegNo) ='".safee($condb,$_GET['stid'])."'";
   
if(!$qsql=mysqli_query($condb,$sql))
{
	echo mysqli_error($condb);
}
$rsprint = mysqli_fetch_array($qsql);
 $existn = imgExists("Student/".$rsprint['images']);
  if ($existn > 0 ){ echo "Student/".$rsprint['images'];
	}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
//if($rsprint['images']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $rsprint['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>" style=" border-radius: 50%;">
  </div></td>
     
          </tr>

<tr >
            <td height="30" colspan="2"> <div class="rounded" align="center"><br><br>
  Slip Number:<?php echo  $rsprint['appNo']; ?>
  </div></td>
     
          </tr>
<div class="rounded">
        <table style="margin:4px; font-size:14px; font-family: Verdana;  font-weight:bold; width:900px;">
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Entry Information:</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Matric Number:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['RegNo']); ?></td>
            <td width="26%">Programme of study:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst(getprog($rsprint['app_type'])); ?></td>
          </tr>
          <tr>
            <td height="43">Academic Session:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Asession']); ?></td>
          
             <td height="43">Mode of entry:</td>
           
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  getamoe($rsprint['Moe']);?>
             </td>
            
          </tr>
          <tr >
            <td width="27%" height="40">Year of Entry:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['yoe']); ?></td>
            <td width="26%">Level of study:</td>
<td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst(getlevel($rsprint['p_level'],$rsprint['app_type'])); ?></td>
          </tr>
          <tr >
            <td width="27%" height="40"><?php echo $SCategory; ?> :</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  getfacultyc($rsprint['Faculty']); ?></td>
            <td width="26%"><?php echo $SGdept1; ?> :</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst(getdeptc($rsprint['Department'])); ?></td>
          </tr>
          
          <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Bio Data:</strong></td>
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
      <hr>
      </div>

<br>
<tr><td colspan="2" align="left" height="40">
   <button data-placement="right" title="Click Here To Exit Form Slip" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='index.php';" type="reset"><i class="icon-signin icon-large"></i>Exit</button>

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
                      