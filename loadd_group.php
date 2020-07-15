<?php

include('./admin/lib/dbcon.php'); 
dbcon(); 

$resultroomsno2 = mysqli_query($condb,"SELECT d_group FROM dept where dept_id ='".safee($condb,$_GET['q'])."'");
$rsroomsno2 = mysqli_fetch_array($resultroomsno2);

//$resultroomsno1 = mysqli_query($condb,"SELECT room_no+1 FROM room where room_id='$rsroomsno[0]'");
//$rsroomsno1 = mysqli_fetch_array($resultroomsno1);
?>
<input type="text" name="d_group1" class="form-control input-sm" value="<?php if($rsroomsno2['d_group'] == ""){echo 'None';}else{ echo $rsroomsno2['d_group'];} ?>" readonly />