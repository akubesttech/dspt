
<?php

include('./admin/lib/dbcon.php'); 
dbcon(); 

$resultroomsno = mysqli_query($condb,"SELECT f_amount FROM fee_db where program ='$_GET[q]' and feetype = 'School fee'");
$rsroomsno = mysqli_fetch_array($resultroomsno);

//$resultroomsno1 = mysqli_query($condb,"SELECT room_no+1 FROM room where room_id='$rsroomsno[0]'");
//$rsroomsno1 = mysqli_fetch_array($resultroomsno1);
?>
<input type="text" class="form-control input-sm" name="amt" value="<?php if($rsroomsno['f_amount'] == ""){echo '0.00';}else{ echo $rsroomsno['f_amount'];} ?>" readonly />