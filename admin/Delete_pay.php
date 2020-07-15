<?php
include('lib/dbcon.php'); 
dbcon(); 
include('session.php'); 
if (isset($_POST['delete_payment'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	
	$row = mysqli_fetch_array(mysqli_query($condb,"select * from payment_tb where pay_id ='".safee($condb,$id[$i])."' "));
	extract($row);
		if($stud_reg ==Null){ $numberstude = $app_no ;}else{
	 $numberstude = $stud_reg;}
	mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Student with Reg No ".$numberstude." Payment for ".getftype($fee_type)." was Deleted , Amount paid : ".$paid_amount.", Date paid: ".$pay_date.", Session : ".$session." and  Payment Mode is ".$pay_mode." .')")or die(mysqli_error($condb));
	$result = mysqli_query($condb,"DELETE FROM payment_tb where pay_id='".safee($condb,$id[$i])."'");
	if($teller_img!=Null){
	unlink("$teller_img");}
}
header("location: View_Payment.php");
}
?>