<?php
//echo $find_dept;
						include('lib/dbcon.php'); 
dbcon();
$find_dept= getecated($_GET['loadp']);
echo "<option value=''>Select Position</option>";
$resultrooms = mysqli_query($condb,"SELECT DISTINCT position,postid FROM post_tb where ecate1 = '$find_dept' ORDER BY position ASC");
while($rsdep = mysqli_fetch_array($resultrooms))
{
echo "<option value='$rsdep[postid]'>$rsdep[position]</option>";   	
}
                        
                         
?>
                   


