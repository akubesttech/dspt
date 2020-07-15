<?php
//include('session.php'); 
$sqltime_table = "SELECT * FROM lecttime_tb where t_dept ='$_GET[depart]' and session='$_GET[session]' and t_level='$_GET[level]' and semester ='$_GET[semester]' and Day='$day' and time='$time'";
$qsqltime_table = mysql_query($sqltime_table);
$rstime_table = mysql_fetch_array($qsqltime_table);
//$sub_find = substr($rstime_table['course '],0,4);
$sub_find = $rstime_table['course'];
//$sqltime_tablesubject = "SELECT * FROM subject WHERE subject_id='$rstime_table[subject]'";
$sqltime_tablesubject = "SELECT * FROM courses WHERE C_code = '$sub_find'";
$qsqltime_tablesubject = mysql_query($sqltime_tablesubject);
$rstime_tablesubject = mysql_fetch_array($qsqltime_tablesubject);
echo $subname = $rstime_tablesubject['C_code'] . " - ". $rstime_tablesubject['C_title'];
$subname= "";

if(isset($_SESSION["student1"]) && $rstime_table['subject'] != "")
{
//echo "<br /><a href='View_Time_Table.php?delid=$rstime_table[0]&class=$_GET[class]&save=Search+Time+Table&term=$_GET[term]'>Delete</a>";
}
?>
