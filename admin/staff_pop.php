
    <?php 
include('lib/dbcon.php'); 
dbcon();
include('session.php');
//if($_GET['nov'] > 10){ $ndown = "height:600px;";}else{$ndown = "";}
 ?> 
 <?php $user_query = mysqli_query($condb,"select * from staff_details where Staff_id='$_GET[id2]'")or die(mysqli_error());
													$row_b = mysqli_fetch_array($user_query);
													$id3 = $row_b['staff_id'];
												$is_active = $row_b['u_display'];
												$picget = $row_b['image']; $signt = $row_b['sign_img'];
								 $exists = imgExists($picget); $exists_sigo = imgExists($signt); 	?>              
 <div class="modal-header">
 <h4 class="modal-title" id="myModalLabel" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>Employee Profile <?php //echo ucfirst($row_b['appNo']) ;?>  </font></h4>
                        </div>
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

<table border="0" style="margin:2px; font-size:12px; font-family: Verdana;  width:880px;" class="tble"  >

<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Username : <?php echo ucfirst($row_b['usern_id']) ;?></strong></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;font-size:22px;"colspan="5"><?php echo ucwords($row_b['title']).' '.ucwords($row_b['sname']).'  '.ucwords($row_b['mname']).' '.ucwords($row_b['oname']); ?></td></tr>
          <tr style="border: 1px solid #98C1D1;"> <td height="30" style="font-weight: bold;" >Date Of Birth :</td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['dob'] ;?> 
          </td>
          <td style="font-weight: bold;width:100px;">Gender</td><td  style="font-color:gray;  font-weight:normal; height: 34px;width: 350p;">
           <?php echo ucwords($row_b['Gender']); ?></td>
          <td rowspan="3"><div >
<img src="<?php if ($exists > 0 ){ print $row_b['image']; }else{ print "./uploads/NO-IMAGE-AVAILABLE.jpg";}
?>" alt="" style="float: right;"  height="150" width="150" >
</div></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Marital Status:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['mstatus'] ;?></td>
         <td height="30" style="font-weight: bold;">Hobbies: </td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['hobbies'] ;?>
          </td></tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Moble Number:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['phone'] ;?></td>
         <td height="30" style="font-weight: bold;">Email Address:</td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['email'] ;?>
          </td></tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Postal Address:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['paddress'] ;?></td>
         <td height="30" style="font-weight: bold;">Contact Address:</td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['caddress'] ;?>
          </td><td><img src="<?php if ($exists_sigo > 0 ){ print $signt; }else{ print "signimg/signpic.png";}
?>" alt="Employee Sign" style="float: right;"  height="35" width="160" ></td></tr>
           <tr style="border: 1px solid #98C1D1;"> <td><strong>Home Address: </strong><?php echo $row_b['town'] ;?></td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <strong>State:</strong> <?php echo $row_b['state'] ;?></td>
         <td height="30"><strong>Local Government:</strong></td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['lga'] ;?>
          </td><td style=""><strong>Nationality: </strong><?php echo $row_b['nation'] ;?></td></tr>
        
        <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;width: 250px;">Highest Education Qualification:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['heq'] ;?></td>
         <td height="30" style="font-weight: bold;">Course Studed: </td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['cos'] ;?>
          </td></tr>
          
             <tr style="border: 1px solid #98C1D1;">
         <td height="30" style="font-weight: bold;">Staff Department : </td> <td style="font-color:gray;  font-weight:normal;"><?php echo getdeptc($row_b['s_dept']) ;?>
          </td> <td style="font-weight: bold;width: 150px;">Mode of Employment:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo $row_b['e_mode'] ;?></td></tr> 
            
            <tr style="border: 1px solid #98C1D1;">
         <td height="30" style="font-weight: bold;">Date Of Employment : </td> <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['doe'] ;?>
          </td> <td style="font-weight: bold;">Employee Status:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php if ($row_b['r_status']='2'){ echo 'Verified';}else{echo 'Not Verified';}?></td>
            <td style=""><strong>Staff Access Level: </strong><?php echo getstatus($row_b['access_level2']) ;?></td>
            </tr>
            <?php if(!empty($row_b['b_acct_name']) && !empty($row_b['b_acct_num']) && !empty($row_b['b_name']) ){   ?>
             <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="5" style="color: #000080; font-size:20px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Employee [<?php echo $row_b['b_name'] ;?>] - Bank Account Details:</strong></td></tr>
              <tr style="border: 1px solid #98C1D1;">
         <td style="font-weight: bold;">Account Name:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;width: 250p;">
            <?php echo $row_b['b_acct_name']; ?></td> <td height="30" style="font-weight: bold;width: 250p;">Account Number: </td><td><?php echo $row_b['b_acct_num'] ;?></td>
            <td height="30" style=""><strong>Bank Sort Code:</strong> <?php echo $row_b['b_sort'] ;?></td> </tr> <?php } ?>
</table>

</div>

		</div>
<div class="modal-footer">
				
					</div>
					
					</form>
				
                 

<!-- end  Modal -->