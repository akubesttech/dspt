<?php
						include('lib/dbcon.php'); 
dbcon();
$find_dept=$_GET['loadfac'];
echo "<option value=''>Select $SGdept1 </option>";
//$resultrooms = mysql_query("SELECT DISTINCT d_name,dept_id FROM dept where d_faculty = '$find_dept' ORDER BY d_name  ASC");
$resultrooms = mysqli_query($condb,"SELECT DISTINCT d_name,dept_id FROM dept where fac_did = '$find_dept' ORDER BY d_name  ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
if($_GET['loadcos'] ==$rsdep['dept_id'] )
	{
	echo "<option value='$rsdep[dept_id]' selected>$rsdep[d_name]</option>";
	$counter=$counter+1;

	}
	else
	{
	echo "<option value='$rsdep[dept_id]'>$rsdep[d_name]</option>";
	$counter=$counter+1;
	}
                         
  //echo "<option value='$rsdep[d_name]'>$rsdep[d_name]</option>";
  //echo "<option value='$rsdep[dept_id]'>$rsdep[d_name]</option>";   	
}
  
                        
                         
?>

