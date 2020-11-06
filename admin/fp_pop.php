
    <?php 
include('lib/dbcon.php'); 
dbcon();
include('session.php');
//if($_GET['nov'] > 10){ $ndown = "height:600px;";}else{$ndown = "";}
 ?> 
 <?php  $get_userid= isset($_GET['userId']) ? $_GET['userId'] : '';
$user_query = mysqli_query($condb,"select * from fshop_tb  where  form_id ='".safee($condb,$get_userid)."'")or die(mysqli_error($condb));
													$row_b = mysqli_fetch_array($user_query);
												   
$forderquery = mysqli_query($condb,"select fpay_status,fpamount from fshop_tb where fpay_status > 0 and fpamount > 0 and form_id ='$get_userid' ")or die(mysqli_error($condb));
$countpay = mysqli_num_rows($forderquery);
													?>              
 <div class="modal-header">
 <h4 class="modal-title" id="myModalLabel" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>Form Order Information </font>   </h4>
                        </div>

	<div class="modal-body" style="overflow:auto;height:350px;">
					<form method="post"  action="" enctype="multipart/form-data" >
						  
<div class="left col-xs-2" >
	
<table border="0" style="margin:2px; font-size:14px; font-family: Verdana;  width:600px;" class="tble"  >

<tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
            <td height="36" colspan="4" style="color: #000080; font-size:16px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong>Applicant Order Details:</strong></td>
          </tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Full Name:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
           <?php echo ucwords($row_b['fsname']." ".$row_b['foname']); ?></td>
         <td height="30" style="font-weight: bold;">Email Address  </td> <td style="font-color:gray;  font-weight:normal;"><?php echo ($row_b['femail']);?>
          </td></tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Mobile Number:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo ($row_b['fphone']) ;?> </td>
         <td height="30" style="font-weight: bold;">Programme: </td> <td style="font-color:gray;  font-weight:normal;"><?php echo getprog($row_b['ftype']) ;?>
          </td></tr>
          <tr style="border: 1px solid #98C1D1;"> <td style="font-weight: bold;">Order Type:</td><td  style="font-color:gray;  font-weight:normal; height: 34px;">
            <?php echo getftype($row_b['feen']);?></td>
         <td height="30" style="font-weight: bold;">Moble Number:</td> <td style="font-color:gray;  font-weight:normal;"><?php echo ($row_b['fphone']) ;?>
          </td></tr>
         
          
 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:16px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Payment Details:</strong></td></tr>
<tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;">Reference No:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo ucfirst($row_b['ftrans_id']) ;?></td>
         <td height="30" style="font-weight: bold;">Session:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo ($row_b['session']);?>
          </td>
        </tr>
<tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;">Payment Date:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo $row_b['fdate_paid'] ;?></td>
         <td height="30" style="font-weight: bold;">Payment Status:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php if($countpay > 0){ echo getpaystatus($row_b['fpay_status']);}else{echo getpaystatus("0");} ;?>
          </td>
        </tr>
        <tr style="border: 1px solid #98C1D1;">
          <td style="font-weight: bold;">Due Payment:</td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <?php echo number_format($row_b['famount'],2) ;?></td>
         <td height="30" style="font-weight: bold;">Amount Paid:</td>
          <td style="font-color:gray;  font-weight:normal;">
            <?php echo number_format($row_b['fpamount'],2) ;?>
          </td>
        </tr>
       <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
          <td height="36" colspan="4" style="color: #000080; font-size:16px;  font-family:  vandana;text-shadow: 1px 1px gray;"><strong> Pin Details:</strong></td></tr>

<?php if($countpay > 0){?>
       <tr style="border: 1px solid #98C1D1;">
          <td ><strong>Pin No: </strong> </td> <td style="font-color:gray;  font-weight:normal;">
           <?php echo $row_b['pin'] ;?>
          </td>
          <td  style="font-color:gray;  font-weight:normal; height: 34px;"> <strong>Serial No:</strong>  </td>
         
          <td style="font-color:gray;  font-weight:normal;"><?php echo $row_b['serial'] ;?></td></tr>
    <?php }else{ ?>
   <tr class="row2">
     <td width="20%" colspan="4" height="15" style="text-align:center;"><strong><font color="red"> Pin not available because of incomplete payment </font></strong></td>
</tr>  <?php } ?>

      
    </table>

</div>

		</div>

					
					</form>
				
                 

<!-- end  Modal -->