
    <?php 
include('lib/dbcon.php'); 
dbcon();
include('session.php');
//if($_GET['nov'] > 10){ $ndown = "height:600px;";}else{$ndown = "";}
 ?> 
 <?php  //and verify_apply='$_GET[nst]'
//$user_query = mysqli_query($condb,"select * from new_apply1 left join olevel_tb ON olevel_tb.oapp_No = new_apply1.appno where stud_id='$_GET[userId]' ORDER BY stud_id ASC")or die(mysql_error());
$user_query = mysqli_query($condb,"select * from new_apply1  where stud_id='$_GET[userId]' ORDER BY stud_id ASC")or die(mysqli_error($condb));
													$row_b = mysqli_fetch_array($user_query);
												    $is_active2 = $row_b['verify_apply'];
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);
													?>              
 <div class="modal-header">
 <h4 class="modal-title" id="myModalLabel" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>Student Application No : <?php echo ucfirst($row_b['appNo']) ;?>  </font></h4>
                        </div>
                       
    <?php
$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM new_apply1 where appNo='".safee($condb,$row_b['appNo'])."'"));
$num_fchoice =$find_choicead['course_choice'] ;$verif  =$find_choicead['verify_apply']; $modeentry2 = $find_choicead['moe']; $entrylev2 = getelevel($modeentry2);
if($num_fchoice == '1'){ $dep1 = $row_b['first_Choice']; $sec1 = $row_b['Asession']; $cho = $row_b['course_choice'];
}else{$dep1 = $row_b['Second_Choice'];$sec1 = $row_b['Asession']; $cho = $row_b['course_choice']; }
$appst  =$row_b['reg_status'];
?>
	<style>
#resize{
    border:1px solid black;
   alignment-adjust: central;
  width:190px;
  height:190px;
  display:inline-block;
   z-index: 10;
}
</style>	<div class="modal-body" style="overflow:auto;height:350px;">
					<form method="post"  action="" enctype="multipart/form-data" >
						  
<div class="left col-xs-2" >
	
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?> " />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<center><?php //if($resi == 1){ echo "<label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label>";//echo " $res";
                    //}
                    $exists30 = imgExists("../Student/".$row_b['images']);
                    ?>

</center>
   
<table border="1" style="margin:2px; font-size:14px; font-family: Verdana;  width:900px;" class="tble"  >
<tr  style="display: none;">  <td  colspan="4" style="text-align: center;">
<div >
<img src="<?php if ($exists30 > 0 ){ print "../Student/".$row_b['images']; }else{ print "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
?>" alt="" style="float: center;border-radius: 50%;"  height="150" width="150" >
</div></td></tr>
<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Basic Details:</strong></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;font-size:22px;"colspan="5"><?php echo ucwords($row_b['FirstName']).'  '.ucwords($row_b['SecondName']).' '.ucwords($row_b['Othername']); ?></td></tr>
          
          <tr style="border: 1px solid #98C1D1;"> <td height="30" style="font-weight: bold;" >Gender :</td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['Gender'] ;?> 
          </td>
          <td style="font-weight: bold;width:150px;">Hobbies</td><td  style="font-color:gray;  font-weight:normal; height: 34px;width: 350px;">
           <?php echo ucwords($row_b['hobbies']); ?></td>
          <td rowspan="3"><div >
<img src="<?php if ($exists30 > 0 ){ print "../Student/".$row_b['images']; }else{ print "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
?>" alt="" style="float: right;"  height="150" width="150" >
</div></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Date Of Birth:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['dob'] ;?></td>
         <td height="30" style="font-weight: bold;">Email Address: </td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['e_address'] ;?>
          </td></tr>
         <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Phone Number:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['phone'] ;?></td>
         <td height="30" style="font-weight: bold;width:180px;">Contact Address:</td> 
         <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['address'] ;?>
          </td></tr>
          
          <tr style="border: 1px solid #98C1D1;"> <td><strong>Postal Address: </strong></td>
          <td style="font-color:gray;  font-weight:normal;width:180px;"><?php echo $row_b['postal_address'] ;?>
          </td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <strong>State:</strong> <?php echo $row_b['state'] ;?></td>
         <td height="30"><strong>Local Government:</strong> <?php echo $row_b['lga'] ;?></td> 
        <td style=""><strong>Nationality: </strong><?php echo $row_b['nation'] ;?></td></tr>
        
         
          
          
 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Choice of Course/Programm:</strong></td></tr>
<tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;">First Choice:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo getdeptc($row_b['first_Choice']) ;?></td>
         <td height="30" style="font-weight: bold;">Second Choice:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo getdeptc($row_b['Second_Choice']) ;?>
          </td>
        </tr>
       <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Post Primary School Qualification ('O' Level Record)</strong></td></tr>

<?php $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20);
if($countnosub > 0){$subcont = $orow_1['oNo_re']; $col ="5";}else{ $subcont = $orow_01['oNo_re']; $col = "5"; } 
 if($count_olresult1 > 0 ){ ?>
        <tr class="row2">
  <td width="50%" colspan="<?php echo $col; ?>" ><div class="pull-left">
  <table border="1" style="margin:4px;  font-family: Verdana;  max-width:390px; min-width:435px; " >
  <tr style="font-weight: bold;"><td colspan="2"> First Certificate Used</td> </tr>
  <tr><td>Exam Type</td><td><?php echo getexamtype($orow_01['oExam_t1']);?><?php echo $col; ?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_01['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_01['oExam_y1']); ?></td></tr>
   <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
   <?php while($orow1 = mysqli_fetch_array($sql_oresult1)){ ?> <tr><td><?php echo  getf_sub($orow1['oSub1']);?></td><td><?php echo  getfgrade($orow1['oGrade_1']);?></td></tr> <?php } ?>
   </table>
   </div>
   <?php if($count_olresult2 > 0){ ?>
   <div class="pull-right"> 
   <table border="1" style="margin:3px;  font-family: Verdana;  max-width:390px; min-width:435px;">
    <tr style="font-weight: bold;"><td colspan="2"> Second Certificate Used</td> </tr>
     <tr><td>Exam Type</td><td><?php echo getexamtype($orow_1['oExam_t1']);?> <?php echo $col; ?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_1['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_1['oExam_y1']); ?></td></tr>
  <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
  <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ ?>
   <tr><td><?php echo getf_sub($orow12['oSub1']);?></td><td><?php echo  getfgrade($orow12['oGrade_1']);?></td></tr> <?php } ?>
     </table></div>  <?php } ?>
     
   </td>
   
     
     </tr>
    <?php }else{ ?>
   <tr class="row2">
     <td width="20%" colspan="5" height="15" style="text-align:center;"><strong> You have not add any Result Goto Step Two.</strong></td>
</tr>  <?php } ?>
<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
<td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> OTHER INFORMATION: </strong></td></tr>

<tr style="border: 1px solid #98C1D1;">
          <td ><strong>Jamb Reg No: </strong> </td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['JambNo'] ;?></td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <strong>Jamb Score:</strong> </td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['J_score'] ;?>  </td>
         <td height="30" ><strong>Post UME Score:</strong><?php echo $row_b['post_uscore'] ;?></td>
          </tr>
        
        <tr style="border: 1px solid #98C1D1;">
          <td ><strong>Application Remark:</strong></td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php if($row_b['verify_apply']=='TRUE'){
echo "Verified";}else{echo "Not Verified";} ;?> </td>
         <td height="30" ><strong>Admission Status:</strong></td>
          <td style="font-color:gray;  font-weight:normal;">
          <?php echo getappstatus($row_b['adminstatus']);  ?> </td></tr>
      
    </table>

</div>

		</div>
<div class="modal-footer">
					<?php   if (authorize($_SESSION["access3"]["adm"]["nsp"]["create"])){ ?>
					<a href="javascript:changeUserStatus(<?php echo $_GET["userId"]; ?>, '<?php echo $verif; ?>','<?php echo $dep1; ?>','<?php echo $sec1; ?>','<?php echo $cho; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $verif == 'FALSE'? 'Approve' : 'Cancel Approval'; //$is_active == 'FALSE'? 'Cancel Verification' : 'Verified'; ?></a>
					<a href="javascript:enableappedit(<?php echo $_GET["userId"]; ?>, '<?php echo $appst; ?>','<?php echo $dep1; ?>','<?php echo $sec1; ?>','<?php echo $cho; ?>');" class="btn btn-info" ><i class="fa fa-check"></i>&nbsp;<?php echo $appst == '0'? 'Disable Edit' : 'Enable Edit'; //$is_active == 'FALSE'? 'Cancel Verification' : 'Verified'; ?></a>
							
                        <?php } ?>
						  <script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div>
					
					</form>
				
                 

<!-- end  Modal -->