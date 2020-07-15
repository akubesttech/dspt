  <?php
include("header1.php");
//include("dbconnection.php");
$sql1 = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($_GET['applicationid'])."'";
$qsql1=mysql_query($sql1);
$rsprint1 = mysql_fetch_array($qsql1);
?>

<body style="background-color: rgb(59, 59, 59); padding: 5px; height: 700px;">
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php  
				  if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){
	echo "css/images/logo.png";
	}else{
	echo "./admin/".$row['Logo'];
	
} ?>  " class="muted pull-left"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121">
								
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
     <center><font size="+2">NEW STUDENT APPLICATION SLIP</font></center>
      <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
      <p>Please Come along with This Application Slip on the Day Of Screening Excesice .</p>
      <p>Your can Reprint this Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['appNo']);  ?></font> Application slip Number.</p>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"><hr></div>
    </main>
  </div></td>
     
          </tr>

<tr >
            <td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="Student/<?php 
   $sql = "SELECT * FROM new_apply1 left join olevel_tb ON olevel_tb.oPin = new_apply1.Pin WHERE md5(new_apply1.appNo) ='".safee($_GET['applicationid'])."'";
   
if(!$qsql=mysql_query($sql))
{
	echo mysql_error();
}
$rsprint = mysql_fetch_array($qsql);
				  
				  if ($rsprint['images']==NULL ){
	print "Student/uploads/NO-IMAGE-AVAILABLE.jpg";
	}else{
	print $rsprint['images'];
	
}
				  
				  
				 // echo $row['adminthumbnails']; ?>">
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
         <table border="1" style="margin:5px; font-size:15px; font-family: Verdana; font-weight:bold; width:900px;">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Choice of Course/Program:</strong></td>
        </tr>
        <tr>
          <td>First Choice:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo  getdeptc($rsprint['first_Choice']); ?></td>
         
        </tr>
        <tr style="height: 34px;">
          <td></td> <td></td> 
          
        </tr>
        <tr>
          <td height="30">Second Choice:</td>
          <td style="font-color:gray;  font-weight:normal;"><p id="mobile  number">
            <?php echo  getdeptc($rsprint['Second_Choice']); ?>
          </p></td>
         
        </tr>
        </table>
        <table border="1" style="margin:5px; font-size:15px; font-family: Verdana; font-weight:bold; width:900px;">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Post Primary School Qualification (WAEC,NECO,GCE,NECO-GCE)</strong></td>
        </tr>
        
        <tr>
    <th height="42" colspan="9" style="text-align: middle;" scope="row"><table width="900" border="1">
      <tr>
        <td width="33" rowspan="4">I.</td>
        <td width="200" rowspan="4">Note That This Results / Certificate is Subjected To Evaluation</td>
        <td colspan="3">Number of Certificates used </td>
        <td colspan="2"><div align="center">First Certificate</div></td>
        <td width="89"><div align="center">Second Certificate</div></td>
        
      </tr>
      
      <tr>
        <td height="62" colspan="3" style="font-color:gray;  font-weight:normal;"> <?php echo  $rsprint['oNo_re']; ?></td>
        <td colspan="2"style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_t1']; ?></td>
        <td width="89" style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_t2']; ?></td>
        
      </tr>
      
        <tr>
        <td height="62" colspan="3"> First Cert Exam Reg No/Year</td>
        <td colspan="2"style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_no1']; ?></td>
        <td width="89" style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_y1']; ?></td>
        </tr>
        
         <tr>
        <td height="62" colspan="3"> Second Cert Exam Reg No/Year</td>
        <td colspan="2"style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_no2']; ?></td>
        <td width="89" style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oExam_y2']; ?></td>
        </tr>
      
	  <tr>
        <td rowspan="5">II.</td>
        <td rowspan="5">Subjects and Grade  </td>
        <td colspan="2"><div align="center">Subject</div></td>
        <td width="42">Grade</td>
        <td colspan="2"><div align="center">Subject Contd</div></td>
        <td><div align="center">Grade Contd</div></td>
      </tr>
      
      <tr>
        <td width="21"><div align="center">1</div></td>
        <td width="100" style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub1']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_1']; ?></td>
        <td width="27"><div align="center">5</div></td>
        <td width="131" style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub5']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_5']; ?></td>
        
      </tr>
      
      <tr>
        <td height="30"><div align="center">2</div></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub2']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_2']; ?></td>
        <td><div align="center">6</div></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub6']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_6']; ?></td>
      </tr>
      <tr>
        <td><div align="center">3</div></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub3']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_2']; ?></td>
        
        <td><div align="center">7</div></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub7']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_2']; ?></td>
        
      </tr>
      
      <tr>
        <td><div align="center">4</div></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oSub4']; ?></td>
        <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['oGrade_4']; ?></td>
        
        <td><div align="center">8</div></td>
        <td></td>
        <td></td>
        
      </tr>
      
    </table></th>
  </tr>
  
      
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
                      