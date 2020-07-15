<?php 
include('lib/dbcon.php'); 
dbcon();
$field = $_POST['field'];
$value = $_POST['value'];
$editid = $_POST['id'];

$query = "UPDATE mode_tb SET ".$field."='".$value."' WHERE id=".$editid;
mysqli_query($condb,$query);

echo 1;