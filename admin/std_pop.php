
    <?php 
include('lib/dbcon.php'); 
dbcon();
include('session.php');
//if($_GET['nov'] > 10){ $ndown = "height:600px;";}else{$ndown = "";}
 ?> 
 <?php  
 $user_query = mysqli_query($condb,"select * from student_tb  where stud_id='".safee($condb,$_GET['userId'])."'")or die(mysqli_error($condb));
 		$row_b = mysqli_fetch_array($user_query);
 $is_active = $row_b['verify_Data'];   $exists = imgExists("../Student/".$row_b['images']);
 $new_a_id = $row_b['stud_id'];
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20);
$fac = isset($_GET['fac1']) ? $_GET['fac1'] : '';
$depart = isset($_GET['dept1_find']) ? $_GET['dept1_find'] : '';
$session = isset($_GET['session2']) ? $_GET['session2'] : '';
$pro_level =  isset($_GET['los']) ? $_GET['los'] : '';
/*$user_query = mysqli_query($condb,"select * from new_apply1  where stud_id='$_GET[userId]' ORDER BY stud_id ASC")or die(mysqli_error($condb));
													$row_b = mysqli_fetch_array($user_query);
												    $is_active2 = $row_b['verify_apply'];
$sql_oresult1=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1'");
$sql_oresult2=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2'");
$count_olresult1 = mysqli_num_rows($sql_oresult1);
$count_olresult2 = mysqli_num_rows($sql_oresult2);
$sql_oresult10=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '1' limit 1");
$sql_oresult20=mysqli_query($condb,"SELECT * FROM olevel_tb2 WHERE oapp_No='".safee($condb,$row_b['appNo'])."' AND oNo_re = '2' limit 1");
$countnosub = mysqli_num_rows($sql_oresult20); */
													?>              
 <div class="modal-header">
 <h4 class="modal-title" id="myModalLabel" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>
 <?php
	if(empty($row_b['RegNo'])){echo "Application No : " .ucfirst($row_b['appNo']);}else{
	 echo "Registration Number : " .ucfirst($row_b['RegNo']) ;}?>
  </font></h4>
                        </div>
                       
    <?php
$find_choicead = mysqli_fetch_array(mysqli_query($condb," SELECT * FROM new_apply1 where appNo='".safee($condb,$row_b['appNo'])."'"));
$num_fchoice =$find_choicead['course_choice'] ;$verif  =$find_choicead['verify_apply']; $modeentry2 = $find_choicead['moe']; $entrylev2 = getelevel($modeentry2);
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
div.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 105px;
  right: 600px;
  background-color: transparent;
  border: 0px solid #4CAF50;
  opacity:0.9;
     margin-left:auto;
   margin-right:auto;
   display:block;
    position:fixed;
z-index:100;
  }
</style>	<div class="modal-body" style="overflow:auto;height:350px;">
					<form method="post"  action="" enctype="multipart/form-data" >
						  
<div class="left col-xs-2" >
	<?php if($row_b['verify_Data']=='TRUE'){
echo "<div class='sticky'><center><font size=25 color=green >Verified</font></center></div>";}else{echo "
<div class='sticky'><center><font size=25 color=red >Not Verified</font></center></div>";} ;?>
	<input type="hidden" name="insidmove" value="<?php echo $_SESSION['insidmove'];?> " />
	<input type='hidden' name='fee_str_id[]' value='$rs[id]' >
	<center><?php //$exists30 = imgExists("../Student/".$row_b['images']);?></center>
   

<table border="0" style="margin:2px; font-size:14px; font-family: Verdana;  width:900px;" class="tble"  >

<tr  style="display: none;">  <td  colspan="4" style="text-align: center;">
<div >
<img src="<?php  if ($exists > 0 ){ echo "../Student/".$row_b['images']; }else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
?>" alt="" style="float: center;border-radius: 50%;"  height="150" width="150" >
</div></td></tr>
<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Basic Details:</strong></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;font-size:22px;"colspan="5"><?php echo ucwords($row_b['FirstName']).'  '.ucwords($row_b['SecondName']).' '.ucwords($row_b['Othername']); ?></td></tr>
          
          <tr style="border: 1px solid #98C1D1;"> <td height="30" style="font-weight: bold;" >Gender :</td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['Gender'] ;?> 
          </td>
          <td style="font-weight: bold;width:150px;">Hobbies</td><td  style="font-color:gray;  font-weight:normal; height: 34px;width: 350p;">
           <?php echo ucwords($row_b['hobbies']); ?></td>
          <td rowspan="3"><div >
<img src="<?php if ($exists > 0 ){ echo "../Student/".$row_b['images']; }else{ echo "../Student/uploads/NO-IMAGE-AVAILABLE.jpg";}
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
          <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Programme Information :</strong></td></tr>
<tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;"><?php echo $SCategory; ?> :</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo getfacultyc($row_b['Faculty']) ;?></td>
         <td height="30" style="font-weight: bold;"><?php echo $SGdept1; ?> :</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo getdeptc($row_b['Department']) ;?>
          </td>
          <td style=""><strong>Prog Type: </strong><?php echo getprog($row_b['app_type']) ;?></td>
        </tr>
        <tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;"><strong>Mode of Entry: </strong></td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo getamoe($row_b['Moe']) ;?></td>
         <td height="30" style="font-weight: bold;">Year of Entry / Graduation</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo $row_b['yoe'] ;?> - <?php echo $row_b['yog'] ;?>
          </td>
          <td style=""><strong>Prog Duration: </strong><?php echo getys($row_b['prog_dura']) ;?></td>
        </tr>
       <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Post Primary School Qualification ('O' Level Record)</strong></td></tr>

<?php $orow_01 = mysqli_fetch_array($sql_oresult10); $orow_1 = mysqli_fetch_array($sql_oresult20);
if($countnosub > 0){$subcont = $orow_1['oNo_re']; $col =5;}else{ $subcont = $orow_01['oNo_re']; $col = 5; } 
 if($count_olresult1 > 0 ){ ?>
        <tr class="row2">
  <td width="50%" colspan="<?php echo $col; ?>" ><div class="pull-left">
  <table border="1" style="margin:4px;  font-family: Verdana;  max-width:390px; min-width:440px; " >
  <tr style="font-weight: bold;"><td colspan="2"> First Certificate Used</td> </tr>
  <tr><td>Exam Type</td><td><?php echo getexamtype($orow_01['oExam_t1']);?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_01['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_01['oExam_y1']); ?></td></tr>
   <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
   <?php while($orow1 = mysqli_fetch_array($sql_oresult1)){ ?> <tr><td><?php echo  getf_sub($orow1['oSub1']);?></td><td><?php echo  getfgrade($orow1['oGrade_1']);?></td></tr> <?php } ?>
   </table>
   </div><?php if($count_olresult2 > 0){ ?>
   <div class="pull-right"> 
   <table border="1" style="margin:3px;  font-family: Verdana;  max-width:390px; min-width:440px;">
    <tr style="font-weight: bold;"><td colspan="2"> Second Certificate Used</td> </tr>
     <tr><td>Exam Type</td><td><?php echo getexamtype($orow_1['oExam_t1']);?></td></tr>
  <tr><td>Exam Number</td><td><?php echo $orow_1['oExam_no1'] ;?></td></tr>
  <tr><td>Exam Year</td><td><?php echo ($orow_1['oExam_y1']); ?></td></tr>
  <tr style="font-weight: bold;"><td>Subject</td><td>Grade</td></tr>
  <?php while($orow12 = mysqli_fetch_array($sql_oresult2)){ ?>
   <tr><td><?php echo getf_sub($orow12['oSub1']);?></td><td><?php echo  getfgrade($orow12['oGrade_1']);?></td></tr> <?php } ?>
     </table></div> <?php } ?>
   </td>
  
     </tr>
    <?php }else{ ?>
   <tr class="row2">
     <td width="20%" colspan="5" height="15" style="text-align:center;"><strong> No Certificate information Added Yet For This Student.</strong></td>
</tr>  <?php } ?>
<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
<td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> OTHER INFORMATION: </strong></td></tr>

        <tr style="border: 1px solid #98C1D1;">
          <td ><strong>Application Remark:</strong></td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php if($row_b['verify_Data']=='TRUE'){
echo "Verified";}else{echo "Not Verified";} ;?> </td>
         <td height="30" ><strong>Date of Registration:</strong></td>
          <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['dateofreg'];  ?> </td>
          <td height="30" ><strong>Academic Status:&nbsp;&nbsp;</strong><?php echo getAcastatus($row_b['acads'],0);  ?></td>
          
          </tr>
      
    </table>

</div>

		</div>
<div class="modal-footer">
					<?php   if ($row_b['RegNo'] > '0'){ ?> 
<a href="javascript:changeUserStatus20(<?php echo $new_a_id; ?>, '<?php echo $is_active; ?>','<?php echo $depart; ?>','<?php echo $session; ?>','<?php echo $pro_level; ?>');" class="btn btn-info" ><i class=" <?php echo $is_active == 'FALSE'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $is_active == 'FALSE'? 'Verify' : 'Cancel'; ?></a> <?php } ?>
						  
                        	
                     
						  <script type="text/javascript">
		              $(document).ready(function(){
		              $('#com').tooltip('show');
		              $('#com').tooltip('hide');
		              });
		             </script>
					</div>
					
					</form>
				
                 

<!-- end  Modal -->