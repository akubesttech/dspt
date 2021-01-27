<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
 ob_start();
//session_start();
include('lib/dbcon.php'); 
dbcon(); 
include('session.php');
//function for getting member status
$session = $_GET['session'];
$depart = $_GET['dept1'];
$depart2 =  substr($depart,0,8);
$c_choice = $_GET['c_choice'];
$table = 'new_apply1';
$depget = getdeptc($depart2);
$replacedept    = str_replace(" ","_",$depget);
/*
if($c_choice=='1'){
$query = "select DISTINCT JambNo as 'Jamb Reg Number', FirstName as 'First Name', SecondName as 'Second Name',first_Choice as 'First Choice', J_score as 'Jamb Score', post_uscore as 'Post UTME Exam Score' from $table where first_Choice = '$depart' && Asession = '$session' && reg_status = '1' && verify_apply = 'TRUE' and app_type ='".safee($condb,$class_ID)."' ";
$header = '';
$data ='';}else{
$query = "select DISTINCT JambNo as 'Jamb Reg Number', FirstName as 'First Name', SecondName as 'Second Name',Second_Choice as 'Second Choice', J_score as 'Jamb Score', post_uscore as 'Post UTME Exam Score' from $table where Second_Choice = '$depart' && Asession = '$session' && reg_status = '1' && verify_apply = 'TRUE' and app_type ='".safee($condb,$class_ID)."' ";
$header = '';
$data ='';
}
 
$export = mysqli_query($condb,$query ) or die(mysqli_error($condb));
 
// extract the field names for header
 
while ($fieldinfo=mysqli_fetch_field($export))
{
$header .= $fieldinfo->name."\t";
}
 
// export data
while( $row = mysqli_fetch_row( $export ) )
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
            
		  //$value = getdept($value['first_Choice']);
	      //$value = getdept($value['Second_Choice']); 
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
	$res="<font color='green'><strong><?php echo $SGdept1; ?> Record For $depart was Successfully Exported..</strong></font><br>";
				$resi=1;

}
 
// allow exported file to download forcefully
header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment;Filename=document_name.xls");

//header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename='$session'_'".$replacedept."'_Postume_Exam_Template.xls");
header("Pragma: no-cache"); 
header("Expires: 0");
print "$header\n$data";
 */
?>


    <?php
    	header("Content-Type: application/xls");
   header("Content-Disposition: attachment; filename='$session'_'".$replacedept."'_Entrance_Exam_Template.xls");  
    	//header("Content-Disposition: attachment; filename=download.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
      header('Cache-Control: must-revalidate');
        header('Pragma: public');
    	//include('../admin/lib/dbcon.php'); 
//dbcon();
     
    	$output = "";
     
    	//if(ISSET($_POST['export'])){
    	
    		$output .="
    			<table border='1'>
    				<thead>
    					<tr>
    						<th>Application Number</th>
    						<th>First Name</th>
    						<th>Second Name</th> ";
    					$output .= "	<th> ";
						if($c_choice=='1'){
						 $output .= "First Choice";
						 }else{
						  $output .= "Second Choice";
						   } 
						$output .= "</th>";
    					$output .= "	<th>Jamb Score</th> <th>Post UTME Exam Score</th>
    					</tr>
    				<tbody>
    		";
     
     if($c_choice=='1'){
$query = mysqli_query($condb,"select appNo , FirstName, SecondName,first_Choice, J_score, post_uscore from $table where first_Choice = '$depart' and Asession = '$session' and reg_status = '1' and verify_apply = 'TRUE' and app_type ='".safee($condb,$class_ID)."' and adminstatus = '0' ")or die(mysqli_errno($condb)); }else{
$query = mysqli_query($condb,"select appNo , FirstName , SecondName ,Second_Choice , J_score , post_uscore from $table where Second_Choice = '$depart' && Asession = '$session' and reg_status = '1' and verify_apply = 'TRUE' and app_type ='".safee($condb,$class_ID)."' and adminstatus = '0' ")or die(mysqli_errno($condb));
}

    		$countt = mysqli_num_rows($query);
			while($fetch = mysqli_fetch_array($query)){
     
    		$output .= "
    					<tr>
    						<td>".$fetch['appNo']."</td>
    						<td>".$fetch['FirstName']."</td>
    						<td>".$fetch['SecondName']."</td>
    						<td>"; 
							if($c_choice=='1'){ 
							$output .= getdeptc($fetch['first_Choice']); 
							}else{
							 $output .= getdeptc($fetch['Second_Choice']);
							 }
							$output .= "</td>";
    						$output .= " <td>".$fetch['J_score']."</td>
    						<td>".$fetch['post_uscore']."</td>
    					</tr>
    		";
    		}
     
    		$output .= "";
    		if ($countt < 1)
{
    $output .= "<tr><td colspan='6'>No Record(s) Found!</td></tr>
    		"; }
    			$output .= "	</tbody>
     
    			</table>
    		";
     
    		echo $output;
    //	}
     ob_end_flush();
    ?>