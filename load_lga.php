<?php
						include('admin/lib/dbcon.php'); 
dbcon();
$find_dept=$_GET['loadfac'];
echo "<option value=''>Select LGA</option>";
$resultrooms = mysqli_query($condb,"SELECT DISTINCT lga FROM lga_tb where state = '$find_dept' ORDER BY lga  ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
echo "<option value='$rsdep[lga]'>$rsdep[lga]</option>";
	
}
  
    

                            
                          
                         
?>

