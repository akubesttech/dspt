
<?php

include('../admin/lib/dbcon.php'); 
dbcon(); 

$resultroomsno = mysqli_query($condb,"SELECT fee FROM roomdb where room_id ='$_GET[q]' and room_status = '1'");
$rsroomsno = mysqli_fetch_array($resultroomsno);
?>

<input type="text" class="form-control" name="amt" value="<?php if($rsroomsno['fee'] == ""){echo '0.00';}else{ echo $rsroomsno['fee'];} ?>" readonly />