<?php
						include('admin/lib/dbcon.php'); 
dbcon();
$find_dept=$_GET['proid'];
echo "<option value=''>Select Level</option>";
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog ='".safee($condb,$find_dept)."' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
                       
                          
                         
?>

