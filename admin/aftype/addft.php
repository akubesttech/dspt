<?php
	if(isset($_POST['f_pro']) && isset($_POST['fee']) && isset($_POST['amt_f'])&& isset($_POST['amt_c']) && isset($_POST['session'])&& isset($_POST['moe']) && isset($_POST['Sstart'])&& isset($_POST['Send']))
	{
		// include Database connection file 
include('../lib/dbcon.php'); 
dbcon(); 
//substr($warning_data2['session_name'],5,10);
		// get values 
		$f_pro = $_POST['f_pro'];$amt_c = $_POST['amt_c'];
		$fee = $_POST['fee'];$session = $_POST['session']; $years = substr($_POST['session'],0,4);
		$amt_f = $_POST['amt_f'];$moe = $_POST['moe'];
$Sstart = $_POST['Sstart'];$Send = $_POST['Send'];
		$query = "INSERT INTO form_db(prog, app_type, mode, amount, amount2, session, year, f_start, f_end) VALUES('$f_pro', '$fee', '$moe','$amt_f', '$amt_c', '$session','$years', '$Sstart','$Send')";
		if (!$result = mysql_query($query)) {
	        exit(mysql_error());
	    }
	    echo "1 Record Added!";
	}
?>