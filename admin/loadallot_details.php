<?php

include('lib/dbcon.php'); 
dbcon(); 
$resultroomsno2 = mysqli_query($condb,"SELECT * FROM course_allottb where course ='".safee($condb,$_GET['q'])."'");
$rsroomsno2 = mysqli_fetch_array($resultroomsno2);
?>
<input type="hidden" name="session" id="session" value="<?php if($rsroomsno2['session'] == ""){echo '0';}else{ echo $rsroomsno2['session'];} ?>"  tabindex="1"  class="form-control input-sm" readonly> 
  <input type="hidden" name="semester" id="semester" value="<?php if($rsroomsno2['semester'] == ""){echo '0';}else{ echo $rsroomsno2['semester'];} ?>"  tabindex="1"  class="form-control input-sm" readonly> 
   <input type="hidden" name="level" id="level" value="<?php if($rsroomsno2['level'] == ""){echo '0';}else{ echo $rsroomsno2['level'];} ?>"  tabindex="1"  class="form-control input-sm" readonly>
   <input type="hidden" name="dept1" id="dept1" value="<?php if($rsroomsno2['dept'] == ""){echo '0';}else{ echo $rsroomsno2['dept'];} ?>"  tabindex="1"  class="form-control input-sm" readonly>