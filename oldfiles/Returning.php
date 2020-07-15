<?php
session_start();

//ini_set('display_errors', 1);
if($_SESSION['insido']==$_POST['insido'])
{
if(isset($_POST['old_Continue'])){
 
$reg_no = $_POST["reg_no"];
	$_SESSION['temppin']=$reg_no;

	$sql_pinn="SELECT * FROM student_tb WHERE RegNo ='$reg_no'";
$result_pinn = mysql_query($sql_pinn);
$num_pinn = mysql_num_rows($result_pinn);
$num_serial = mysql_fetch_array($result_pinn);
$studentpics8 = $num_serial['images'];
//$find_record = mysql_fetch_array($result_pin1);
//$studentpics = $find_record['images'];

$sql_pinn2="SELECT images FROM student_tb WHERE RegNo ='$reg_no' AND appNo ='$num_appNo' AND reg_status = '0'";
$result_pinn2 = mysql_query($sql_pinn2);
$num_pinn2 = mysql_num_rows($result_pinn2);

	if(strpos($reg_no," ")){
		$res="<font color='Red'><strong>Please! Registration Number can not Contain a Space..</strong></font><br>";
				$resi=1;
				
					}elseif($num_pinn > 0 and $studentpics8!=Null){
echo "<script>alert('Your Details have been Submited!');</script>";
		echo "<script>window.location.assign('studregprint.php?stid=".md5($_POST['reg_no'])."');</script>";
		
				}else{
				if($num_pinn > 0 and $studentpics8==Null){
				//header("location:apply_b.php?view=O_C");
				redirect("apply_b.php?view=O_C");
					//echo "<script>window.location.assign('apply_b.php?view=O_C');</script>";
			}else{
				//header("location:apply_b.php?view=O_C");
				//echo "<script>window.location.assign('apply_b.php?view=N_1 & applicationid=".$nappNo20."');</script>";
				redirect("apply_b.php?view=O_C");
			}

}}}$_SESSION['insido'] = rand();
?>

  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;">Old/Returning Student Registartion Form </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable Old Student from 200 level to Register Their Information.</h3><br>
       
       
       	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insido" value="<?php echo $_SESSION['insido'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<div class="form_box">
			 <div class="clear">
        <table width="700" height="100" >
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>
    </tr>
		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;width:996px;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Enter Access Detail</strong></td>
    
    </tr>

  <tr>
   
  <td width="19%">Matric/Registration Number:</td>
    <td width="31%"><input type="text" name="reg_no" id="reg_no" required="required"></td>
    
    
    
    
  </tr>
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="old_Continue" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Next Button To Continue Registration"><i class="icon-plus-sign icon-large"> Next</i></button>
      										<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           
            
											
          </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
    
      
      
      <div class="cl">&nbsp;</div>
    </div>
    
    </div>
    
    <br><br>
  </div>
</div>
