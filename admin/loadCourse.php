<?php
//echo $find_dept;
						include('lib/dbcon.php'); 
dbcon();
 /*                     
 function getdcode($get_dept)
{
$query2_hod = @mysql_query("select dept_id from dept where d_name = '$get_dept' ")or die(mysql_error());
$count_hod = mysql_fetch_array($query2_hod);
 $nameclass22=$count_hod['dept_id'];
return $nameclass22;
} */

$find_dept=$_GET['loadcos'];
echo "<option value=''>Select Course Code</option>";
$resultrooms = mysqli_query($condb,"SELECT DISTINCT C_code FROM courses where dept_c = '$find_dept' ORDER BY C_code  ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
echo "<option value='$rsdep[C_code]'>$rsdep[C_code]</option>";   	
}
                        
                         
?>

                       
?>

