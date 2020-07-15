<?php

include('lib/dbcon.php'); dbcon();  //$q=$_GET['loadcos'];
	if($_REQUEST['loadcos']) {					
$user_query = mysqli_query($condb,"select * from courses  WHERE dept_c = '".safee($condb,$_REQUEST['loadcos'])."' and dept_c IS NOT NULL GROUP BY dept_c,C_title  ORDER BY dept_c ASC")or die(mysqli_error($condb)); $totalRecord = mysqli_num_rows($user_query);
													
/*include_once("db_connect.php");
if($_POST["query"] != '') {
$searchData = explode(",", $_POST["query"]);
$searchValues = "'" . implode("', '", $searchData) . "'";
$queryQuery = "
SELECT id, name, gender, address as location, designation, age
FROM developers
WHERE address IN (".$searchValues.")";
} else {
$queryQuery = "
SELECT id, name, gender, address as location, designation, age
FROM developers";
}
$resultset = mysqli_query($conn, $queryQuery) or die("database error:". mysqli_error($conn));
$totalRecord = mysqli_num_rows($resultset); */
$htmlRows = '';
if($totalRecord) {
/*while( $developer = mysqli_fetch_assoc($resultset) ) { */

while($row = mysqli_fetch_assoc($user_query)){
													$id = $row['C_id'];
$htmlRows .= '<tr>
                        	<td width="30">
<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value=' . $id . '></td>
						<td>'. getdeptc($row["dept_c"]).'</td>
                         <td>'. $row["C_title"] .'</td>
                          <td>'.$row["C_code"].'</td>
                          <td>'.$row["C_unit"].'</td>
                          <td>'.$row["semester"].'</td>
                          <td>'.getlevel($row["C_level"],$class_ID).'</td>
                          
                          	<td width="120">
                         
<a rel="tooltip"  title="Edit Course Details" id="deletec" href="add_Courses.php?view=editc&id='.$id.'  data-toggle="modal" class="btn btn-success" name=""><i class="fa fa-pencil icon-large"> Edit Record</i></a>
											
												</td> </tr>';
                      
}
} else {
$htmlRows .= '
<tr>
<td colspan="5" align="center">No record found.</td>
</tr>';
}
$data = array(
"html" => $htmlRows
);
echo json_encode($data);
}
/*if($_REQUEST['empid']) {
$sql = "SELECT id, employee_name, employee_salary, employee_age FROM employee WHERE id='".$_REQUEST['empid']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data = $rows;
}
echo json_encode($data);
} else {
echo 0;
} */
?>