<?php

include('lib/dbcon.php'); 
dbcon(); 
include('session.php'); 
$resultroomsno2 = mysqli_query($condb,"SELECT * FROM ftype_db where id = '".safee($condb,$_GET['q'])."'");
$rsroomsno2 = mysqli_fetch_array($resultroomsno2); 
$fcato = $rsroomsno2['f_category']; 
?>

<?php  if($rsroomsno2['f_category'] == "8"){ ?>
 <label for="chkPenalty"> </label><br><br>
    <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv(this)" required="required"  name="chkPenalty" value="1"   /> Add penalty Period </label>
 <?php }else{ ?>
  <label for="chkPenalty"> </label><br><br>
    <label class="chkPenalty"><input type="checkbox" id="chkPenalty"  onclick="ShowHideDiv(this)"  name="chkPenalty" value="1" /> Add penalty by Amount Per (%) </label>
 <?php } ?> 
             					   