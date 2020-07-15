<?php
						include('../admin/lib/dbcon.php'); 
dbcon();
$find_dept=$_GET['loadfac'];
echo "<option value=''>Select Department</option>";
$resultrooms = mysqli_query($condb,"SELECT DISTINCT d_name FROM dept where d_faculty = '$find_dept' ORDER BY d_name  ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
                       
  echo "<option value='$rsdep[d_name]'>$rsdep[d_name]</option>";   	
}
                        
                         
?>

