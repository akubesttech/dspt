  <?php
include("header1.php");
//include("dbconnection.php");
  $existl = imgExists("admin/".$row['Logo']);
$sql1 = "SELECT * FROM new_apply1 WHERE md5(appNo) ='".safee($condb,$_GET['applyid'])."' or md5(JambNo) ='".safee($condb,$_GET['applyid'])."'";
$qsql1=mysqli_query($condb,$sql1);
$dform_checkexist20 = mysqli_num_rows($qsql1);
if($dform_checkexist20 < 1){ message("The page you are trying to access is not Available.", "error");
redirect('apply_b.php?view=C_R'); }
$rsprint1 = mysqli_fetch_array($qsql1);
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 700px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php 
if ($existl > 0 ){ echo "admin/".$row['Logo'];}else{ echo "css/images/logo.png";}
//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "./admin/".$row['Logo'];}
 ?>  " class="muted pull-left" width="100px" height="100px"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
                                <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:750px;" border="0">
    
	<tr style="background-color:#FFC">
            <td height="30" colspan="2"> <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
     <center><font size="+2">STUDENT POST UTME EXAM RESULT</font></center>
     <p></p>
      <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
     <p>Your can Reprint this Result Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['appNo']);  ?></font> Application slip Number.</p>
      <p>The details of your result is stated Below.</p>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php 
  // $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo)='$_GET[applyid]' or md5(new_apply1.JambNo)='$_GET[applyid]'";
   
   $sql = "SELECT * FROM new_apply1 WHERE md5(appNo)='".safee($condb,$_GET['applyid'])."' or md5(JambNo)='".safee($condb,$_GET['applyid'])."'";
   
if(!$qsql=mysqli_query($condb,$sql))
{
	echo mysqli_error($condb);
}
$rsprint = mysqli_fetch_array($qsql);
				  $existn = imgExists("Student/".$rsprint['images']);
if ($existn > 0 ){ echo "Student/".$rsprint['images'];}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
	
//if ($rsprint['images']==NULL ){print "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $rsprint['images'];}
				  
				  
				 // echo $row['adminthumbnails']; ?>" width="200" height="130" style=" border-radius: 50%;">
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center"><br><br>
  Slip Number:<?php echo  $rsprint['appNo']; ?>
  </div></td>
     
          </tr>
<div class="rounded">
        <table style="margin:5px; font-size:15px; font-family: Verdana;  font-weight:bold; width:900px;">
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
          
            <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Post UTME Examination Result::</strong></td>
          </tr>
          <tr >
            <td width="27%" height="40">Jamb Registration No:</td>
            <td width="24%" id="firstname" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['JambNo']); ?></td>
             <td height="43">Academic Session:</td>
            <td style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['Asession']); ?></td>
            
          </tr>
          <tr>
           <?php  
			 if(empty($rsprint['J_score']) OR $rsprint['J_score']=='0'){
			 
			 
			  ?>
             <td height="43">Jamb Score:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      -----------------
             </td>
             <?php }else{ ?>
              <td height="43">Jamb Score:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  $rsprint['J_score']; ?>
             </td>
             
             <?php } ?>
              <td width="26%">Post UTME Score:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['post_uscore']); ?></td>
            <td>
              
             </td>
          </tr>
           <tr>
            <td width="26%">Average Score:</td>
            <td width="23%" style="font-color:gray;  font-weight:normal;">    <?php echo  ucfirst($rsprint['average_score']); ?></td>
           
              <td height="43">Admission Status:</td>
            <td style="font-color:gray;  font-weight:normal;">
                      <?php echo  getappstatus($rsprint['adminstatus']); ?>
             </td>
          
            <td>
              
             </td>
          </tr>
          
        </table>
         <table border="1" style="margin:5px; font-size:15px; font-family: Verdana; font-weight:bold; width:900px;">
       
        
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Admission Remark:</strong></td>
        </tr>
        
         <tr>
          <td height="36" colspan="3" style="font-color:gray;  font-weight:normal; text-align:justify;">
		  <?php
if($rsprint['adminstatus']=='1'){
		echo "Congratulations! <br><br>This is To Inform you that you have been giving admission into <strong>";?> <?php 
		if($rsprint['course_choice'] == '1'){
	echo getdeptc($rsprint['first_Choice']);
	}elseif($rsprint['course_choice'] == '2'){
echo getdeptc($rsprint['Second_Choice']);
}
 ?><?php echo "</strong> in <strong> $row[SchoolName] </strong> to Pursue Your Studies and you are required to report to School Adminstrative Block to continue with Other Admission Processes ,Come with a Copy of This Result slip and your Other Credentials.<br> Note That This Admission will be withdrawn if you Violate The Terms and Condition of your Admission. <br><br>
		Thank your Admin.";
		}elseif($rsprint['adminstatus']=='2'){
		echo "Admission Pending! <br>Your Admission Request into <strong> $row[SchoolName] </strong> is still pending and The result is not yet Verified, Please Check Back Later. <br>
		Thank your.";
		
	}elseif($rsprint['adminstatus']=='3'){
echo "Sorry Dear! <br>Your Admission Request into <strong> $row[SchoolName] </strong> was not Successful because your Peformance  in our Entrance Exam was poor and we was unable to Admit you into our school. <br>
		Thank your.";
}else{
	echo "Admission Pending! <br>Your Admission Request into <strong> $row[SchoolName] </strong> is still pending  and The result is not yet Verified, Please Check Back Later. <br>
		Thank your.";

}
		  
		   ?>
		  </td>
        </tr> 
        </table>
    
      </div>
<?php
//course_choice

//

?>
<br>
<tr><td colspan="2" align="left" height="40">
   <button data-placement="right" title="Click Here To Exit Application Slip" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='apply_b.php?view=C_R';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

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
                      