<?php
   //$db = new mysqli('localhost', 'root' ,'', 'liveedit2');
	//if(!$db) {
	
	//	echo 'Could not connect to the database.';
	//} else {
	 include_once('./admin/lib/dbcon.php'); 
 dbcon();
		if(isset($_POST['queryString'])) {
			$queryString = safee($condb,$_POST['queryString']);
			
			if(strlen($queryString) >0) {

			//	$query = $db->query("SELECT id, fname, lname FROM customer WHERE fname LIKE '$queryString%' OR lname LIKE '$queryString%' LIMIT 10");
			
$result = mysqli_query($condb,"SELECT ftrans_id, pin, serial, fsname, foname FROM fshop_tb WHERE ftrans_id = '$queryString' and fpay_status = '1' LIMIT 10");
				if($result) {
				echo '<ul>';
					//while ($result2 = mysql_fetch_object() $query ->fetch_object()) {
					while ($result2 = mysqli_fetch_array($result)) {
echo '<li onClick="fill(\''." Pin: ".addslashes($result2['pin'])."   Serial: ".addslashes($result2['serial']).'\');">'."Click Here >>".$result2['fsname'].' '.$result2['foname'].'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'The Payment Reference Not Verified!';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
//	}
?>