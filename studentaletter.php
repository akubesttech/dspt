  <?php
  $class_ID = 0;
include("header1.php");
include("admin/qrcode.php");
$qr = new qrcode();
//include("dbconnection.php");
  $existl = imgExists("admin/".$row['Logo']);
$sql1 = "SELECT * FROM new_apply1 WHERE md5(appNo) ='".safee($condb,$_GET['p_id'])."'";
$qsql1=mysqli_query($condb,$sql1);
$dform_checkexist20 = mysqli_num_rows($qsql1);
if($dform_checkexist20 < 1){ message("The page you are trying to access is not Available.", "error");
redirect('apply_b.php?view=C_R'); }
$rsprint1 = mysqli_fetch_array($qsql1);
$applicantname = strtoupper($rsprint1['FirstName']." ".$rsprint1['SecondName']." ".$rsprint1['Othername']);
$instid = getinstitution($rsprint1['app_type']);
$linkno = host()."studentaletter.php?p_id=".$_GET['p_id'];
$qr->link($linkno);
?>

<body ><!-- style="background-color: rgb(59, 59, 59); padding: 5px; height: 700px;" --!>
  <div class="row-fluid">
                        <!-- block -->
 <div class="block1">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-center"><i class="icon-plus-sign2 icon-large" >	
                    <img src=" <?php 
if ($existl > 0 ){ echo "admin/".$row['Logo'];}else{ echo "css/images/logo.png";}
//if ($row['Logo']==NULL or $row['Logo']=='uploads/' ){echo "css/images/logo.png";}else{echo "./admin/".$row['Logo'];}
 ?>  " class="muted pull-left" width="100px" height="80px"> <span style="color: #000080; font-size:26px;  font-family:vandana;text-shadow: 1px 1px gray; "><br><?php echo strtoupper($row['SchoolName']);  ?></span> </i></div>
</div>
<div class="block-content2 collapse in">
                                <div class="span121" style="background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('<?php if ($existl > 0 ){ echo "admin/".$row['Logo'];
	}else{ echo "css/images/logo.png";} ?>'); background-repeat: no-repeat;background-position: center;  background-size: 550px 500px;display: block; -webkit-print-color-adjust: exact; ">
								
								 <!--------------------form------------------->
								<form method="post" enctype="multipart/form-data">
					<div class="control-group">
                             <div class="controls">
                             
 <table  align="center" style="margin:5px; font-size:15px;  font-weight:bold; width:900px;" border="0" class="tble22">
    
	<tr style="background-color:#FFC">
            <td height="30" colspan="4"> 
   <!-- <div class="rounded"> <main class="container clear"> --!>
      <!-- main body --> 
      <!-- ################################################################################################ -->
     <center><font size="+2"><?php echo "ADMISSION LETTER OF ".$applicantname; ?> </font></center>
   <!--  <p></p>
      <p>Date Of Registration: <?php echo $rsprint1['dateofreg']; ?></p>
     <p>Your can Reprint this Result Slip with This   <font color="red"> <?php echo ucfirst($rsprint1['appNo']);  ?></font> Application slip Number.</p>
      <p>The details of your result is stated Below.</p>--!>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <!--<div class="clear"><hr></div> --!>
  <!--  </main>
  </div> --!>
  </td></tr>
          
<?php  $sql = "SELECT * FROM new_apply1 WHERE md5(appNo)='".safee($condb,$_GET['p_id'])."'";
   if(!$qsql=mysqli_query($condb,$sql)){ echo mysqli_error($condb);}
$rsprint = mysqli_fetch_array($qsql); $existn = imgExists("Student/".$rsprint['images']); $getpro = $rsprint['app_type']; ?>

<!--<tr ><td height="32" colspan="2"> <div class="rounded" align="center">
   <img id="admin_avatar" class="img-circle" src="<?php 
//if ($existn > 0 ){ echo "Student/".$rsprint['images'];}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
 ?>" width="200" height="130" style=" border-radius: 50%;"></div></td></tr> --!>


<tr ><td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;width: 355px;text-align: justify;" colspan="3" height="30">
<p style="color:black;"></p>
<p style="color: black;">
This is to inform you that you have been provisionally admitted into <?php  echo ucfirst($row['SchoolName']);  ?> as follows: </p>
<p style="color:black;"></p><p style="color:black;"></p>
</td>
            
          </tr>
          
<tr style="display: none;" ><td height="32" colspan="2"> <div class="rounded" align="center"><br><br>
  Slip Number:<?php echo  $rsprint['appNo']; ?></div></td></tr>
  
<div class="rounded">
        <table style="margin:5px; font-size:15px; font-family: Verdana;  font-weight:bold; width:900px;height: 350px;" border="0">
        <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Base Data:</strong></td>
          </tr>
          <tr >
            <td width="20%" rowspan="8" style="text-align: center;"><img  src="<?php if ($existn > 0 ){ echo "Student/".$rsprint['images'];}else{ echo "Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
  ?>" width="150" height="150" style="margin-bottom: 145px;" ></td>
            <td width="30%" id="firstname" >Name</td>
            <td width="30%" style="font-color:gray;  font-weight:normal;" ><?php echo $applicantname;?></td>
            <td width="20%" style="font-color:gray;  font-weight:normal;text-align: center;padding-top:-125px;" rowspan="8"> 
            <img src="assets/media/qrcode.png" width="120" height="120" style="margin-bottom: 240px; display: none;" />
            <img src="<?php echo $qr->get_link(); ?>" width="130" height="130" style="margin-bottom: 190px;" border='0'/>
            </td>
          </tr>
          <tr><td >Application Number</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['appNo']; ?></td></tr>
         <?php if($instid == "3"){ ?> <tr><td >Study Course</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  getdeptc($rsprint['adept']); ?></td> </tr> <?php } ?>
            
          <tr><td>Department</td>
            <td style="font-color:gray;  font-weight:normal;"><?php if($instid == "3"){ echo  getdgroup($rsprint['adept']); }else{ echo  getdeptc($rsprint['adept']); }?></td></tr> 
            <tr><td ><?php echo $SCategory; ?></td>
            <td style="font-color:gray;  font-weight:normal;" ><?php echo  getfacultyc($rsprint['afac']); ?></td></tr>
          <tr><td >Study Mode</td><td  style="font-color:gray;  font-weight:normal;"><?php echo  getamoe($rsprint['moe']); ?></td></tr>
           <tr> <td >Entry Session</td>
            <td style="font-color:gray;  font-weight:normal;"><?php echo  $rsprint['Asession']; ?></td></tr>
          <tr><td  colspan="2">&nbsp;</td></tr><tr>
          <td  colspan="4" rowspan="2"style="font-color:gray;  font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Your CMS Student Record was created on <?php echo  date('d-m-Y h:i:s') ;?> </td></tr>
         </table>
         
    
      </div>
<?php
//course_choice

//

?>
<br>
<tr><td colspan="2" align="left" height="40">
   <button data-placement="right" title="Click Here To Exit Application Slip" id="reset" name="B2" class="btn btn-info" onClick="window.location.href='apply_b.php?view=lpay&p_id=<?php echo $_GET['p_id'] ;?>';" type="reset"><i class="icon-signin icon-large"></i> Go Back </button>

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
                      