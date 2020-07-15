<?php

//session_start();
include('../admin/lib/dbcon.php'); 
dbcon(); 
$session_id = $_GET['userid'];
$session = $_GET['session'];
$course_e = $_GET['course_e'];
//$depart2 =  substr($depart,0,8);
$c_choice = $_GET['c_choice'];
$level = $_GET['level'];
$table = 'coursereg_tb';
//$table2 = 'course_allottb';
//$query = "select DISTINCT sregno as 'Registration number', FirstName as 'First Name', SecondName as 'Second Name',Gender as 'Gender', 	assesment as 'Continous Accessment',exam as 'Exam Score' from $table,$table2 where c_code = '$course_e' && session = '$session' && level = '$level' && lect_approve='1'";
$query = "select DISTINCT sregno as 'Registration number',c_code as 'Course Code',c_unit as 'Credit Unit', assesment as 'Continous Accessment',exam as 'Exam Score' from $table where c_code = '$course_e' && session = '$session' && level = '$level'&& semester = '$c_choice' && creg_status='1'";
$header = '';
$data ='';
//}
 
$export = mysql_query($query ) or die(mysql_error());
 
// extract the field names for header
 
while ($fieldinfo=mysql_fetch_field($export))
{
$header .= $fieldinfo->name."\t";
}
 
// export data
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
 
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n"; 
	$res="<font color='red'><strong>No Record(s) Found!..</strong></font><br>";
				$resi=1;                       
}else{
	$res="<font color='green'><strong>Course List For $course_e was Successfully Exported..</strong></font><br>";
				$resi=1;

}
 
// allow exported file to download forcefully
header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment;Filename=document_name.xls");

//header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename='$session'_'".$course_e."'_Student_Exam_Template.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
 
?>