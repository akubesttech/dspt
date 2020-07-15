<?php
include('./admin/lib/dbcon.php'); 
dbcon(); 
//if(isset($_POST['id'])){
$del_olevel1=mysqli_query($condb,"DELETE FROM olevel_tb2 WHERE rec_id='".safee($condb,$_POST['id'])."'");
//}
?>