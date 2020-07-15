<?php
						include('../admin/lib/dbcon.php'); 
dbcon();

$find_dept=$_GET['loadroom'];
echo "<option value=''>Select Room No</option>";
$resultrooms = mysqli_query($condb,"SELECT DISTINCT room_no,no_of_bed,room_id FROM roomdb where h_coder = '".safee($condb,$find_dept)."' and room_status = '1' ORDER BY room_no  ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
                       
  echo "<option value='$rsdep[room_id]'>$rsdep[room_no] (No of Bed $rsdep[no_of_bed]) </option>";   	
}
                        
                         
?>

