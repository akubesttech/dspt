
<?php  include('header.php'); ?>
<?php include('session.php'); 

?>
	
		         
        <?php 
if(isset($_GET['addrooms'])){
?>

<script>
    $(document).ready(function(){
        $('#myModal6').fadeIn('fast');
    });
    
    $(document).ready(function(){
        $('#close').click(function(){
            $('#myModal6').fadeOut('fast');
            windows.location = "add_Hostel.php";
        })
    })

</script>

<?php }?>	

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php') ?>
  <?php $get_RegNo= $_GET['id']; $get_RegNo2= $_GET['idroom']; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>School Hostel Panel
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
			/*		$num=$get_RegNo;
				if ($num!==null){
			include('edit_Hostel.php');
			}else{
			
				include('addHostel.php'); }  */  ?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
             
                <?php 
						$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
					switch ($view) {
                	case 'addH' :
		            $content    = 'addHostel.php';		
		            break;
                    case 'ehostel' :
		            $content    = 'edit_Hostel.php';		
		            break;
		             case 'roomR' :
		            $content    = 'roomrequestlist.php';		
		            break;
                    case 'allotR' :
		            $content    = 'allocatedRoom.php';		
		            break;
		            case 'aedit' :
		            $content    = 'allocatedEdit.php';		
		            break;
	                default :
		            $content    = 'hlist.php';
                            }
                     require_once $content;
				?>

                
                
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
               <!-- /page content -->
        
   
        <!-- start  Staff details Pop up -->
<?php
//if($_SESSION['insidroom']==$_POST['insidroom'])
//{
if(isset($_POST['addroom2'])){
$h_code2 = $_POST['h_code2'];
$h_coder = $_POST['h_coder'];
$n_bed = $_POST['n_bed'];
$feetype = $_POST['ftype'];
$feeroom = $_POST['fee'];
$r_st = $_POST['r_st'];
$r_desc = $_POST['r_desc'];
$h_nameen = $_POST['hostel_name'];


$query_hoster = mysqli_query($condb,"select * from roomdb where room_no = '$h_coder'")or die(mysqli_error($condb));
//$row = mysqli_fetch_array($query);
$row_hoster = mysqli_num_rows($query_hoster);
//$query_hostec = mysqli_query($condb,"select * from roomdb where h_code = '$h_code'")or die(mysql_error());
//$row = mysqli_fetch_array($query);
//$row_hostec = mysql_num_rows($query_hostec);
if ($row_hoster>0){
	message("Please This Room Number Already Exist In our Database", "error");
		        redirect('add_Hostel.php?addrooms&idroom='.$get_RegNo2);
//$resroom="<font color='red'><strong>Please This Room Number Already Exist In our Database</strong></font><br>";
				//$resi=1;
				
		
}else{
	//$sqlquery ="INSERT INTO room (block_id,room_no,no_of_beds,description, status) VALUES ('$_POST[block]','$_POST[roomno]','$_POST[noofbeds]','$_POST[discription]','$_POST[status]')";
	
mysqli_query($condb,"insert into roomdb (h_coder,h_nameen,room_no,feetype,fee,no_of_bed,description,room_status) values('".safee($condb,$h_code2)."','".safee($condb,$h_nameen)."','$h_coder','".safee($condb,$feetype)."','".safee($condb,$feeroom)."','".safee($condb,$n_bed)."','".safee($condb,$r_desc)."'
,'".safee($condb,$r_st)."')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Room  $h_coder was Add')")or die(mysqli_error($condb)); 
 ob_start();
 message("New Room [$h_coder] was Successfully Added", "success");
		        redirect('add_Hostel.php');
//$resroom="<font color='green'><strong>New Room [$h_coder] was Successfully Added</strong></font><br>";
			//	$resi=1;



}
}//}$_SESSION['insidroom'] = rand();
?>
 
  

<div id="myModal6" class="modal dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

 <div class="modal-header">
                        <!--  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button> --!>
                          <h4 class="modal-title" id="myModalLabel">Add New Rooms </h4>
                        </div>
                        
    
		<div class="modal-body">
		   
		<div class="well profile_view" style="1px solid green;">
					<form method="post"   enctype="multipart/form-data" >
					  <?php
					$user_home = mysqli_query($condb,"select * from hostedb where h_code='".safee($condb,$_GET['idroom'])."'")or die(mysqli_error($condb));
													$row_ho = mysqli_fetch_array($user_home);
													$idhostel = $row_ho['h_code'];
													$hname = $row_ho['h_name'];
													?>
					<input type="hidden" name="insidroom" value="<?php echo $_SESSION['insidroom'];?> " />
                      <input type="hidden" name="hostel_name" value="<?php echo $hname ;?> " />
                      <span class="section" style="text-shadow:-1px 1px 1px #000;"><font color='darkblue'>Hostel Name : <?php echo ucfirst($hname) ;?> </font> <?php
//if($resi == 1){echo "  <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$resroom</font></label></center>";}
?> </span>

<div class="col-sm-12">
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
<label for="heard">Hostel Code </label>
                      
                          <input type="text" class="form-control " readonly name='h_code2' id="h_code2"  value="<?php echo $idhostel ;?>"  required="required"> </div>
                          <?php   
$tran2=mysqli_query($condb,"select max(room_no) from roomdb");

while($tid2 = mysqli_fetch_array($tran2, MYSQLI_BOTH))
{
if($tid2[0] == null)
{
$tmax2="2000";
}
else
{
$tmax2=$tid2[0]+1;
}
}

echo "

<div class=\"col-md-4 col-sm-4 col-xs-12 form-group has-feedback\">
					  <label for=\"heard\">Room No </label>
                      
                          <input type=\"text\" class=\"form-control \" name=\"h_coder\" id=\"h_coder\" maxlength=\"4\"  value=\"$tmax2\" onkeypress=\"return isNumber(event);\"   required=\"required\"> </div>
";
 ?>


                          
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Number of Bed</label>
                            	  <select name='n_bed' id="n_bed"  class="form-control" required>
                            <option value="">Select</option>
    
                            <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                              <option value="5">5</option>
                          
                          </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Fee Type</label>
                             <select name='ftype' id="ftype" class="form-control" required>
                            <option value="">Select Fee Type</option>
                          <?php 
$resultfee = mysqli_query($condb,"SELECT * FROM ftype_db where status = '0' and f_category = '1'  ORDER BY f_type  ASC");
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[id]'>$rsfee[f_type]</option>";}?>
                        <!--    <option value="Others">Other Fees</option> -->
                          
                          </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Fee (Per Month)</label>
                      
                          <input type="text" class="form-control "  name='fee' id="fee"  value="" onkeypress="return isNumber(event);"  required="required"> </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Room Status</label>
                            	  <select name='r_st' id="r_st"  class="form-control" required>
                            <option value="">Select Status</option>
                             <option value="1">Availiable</option>
                             <option value="0">Not Availiable</option>
                          </select>
                      </div>
                     
                          
                      <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Room Description </label>
                            	     <textarea name="r_desc" id="r_desc" class="form-control " style="width:498px;"required="required"></textarea></td>
                      </div>
                      
<div class="col-xs-12 bottom text-center">

</div>
</div>

						
		</div>
			
					<div class="modal-footer">
					<a href="add_Hostel.php" class="btn btn-default"><i class="fa fa-remove"></i>&nbsp;Close</a>
                  
                         <button  name="addroom2" class="btn btn-primary"><i class="fa fa-plus icon-large"></i>Add Room</button>
                        </div>
					
					</form>
					 </div>
                 
				    </div>
</div></div><?php //} ?>
<!-- end  Modal -->
  
         <?php include('footer.php'); ?>