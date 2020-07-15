
<?php

include('lib/dbcon.php'); 
dbcon(); 
$resultroomsno = mysqli_query($condb,"SELECT f_amount FROM fee_db where status ='1' and feetype = '$_GET[q]'");
$rsroomsno = mysqli_fetch_array($resultroomsno);
?>
<input type="text" class="form-control" name="amt_f" id="amt_f" onkeypress="return isNumber(event);"  value="<?php if($rsroomsno['f_amount'] == ""){echo '0.00';}else{ echo $rsroomsno['f_amount'];} ?>"  />