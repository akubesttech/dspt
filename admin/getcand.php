<?php
include('lib/dbcon.php'); 
dbcon();

$request = $_POST['request'];   // request

// Get username list
if($request == 1){
    $search = $_POST['search'];
//$query = "SELECT * FROM student_tb WHERE RegNo like'%".$search."%' AND reg_status = '1' AND verify_Data = 'TRUE'";
$query = "SELECT * FROM student_tb WHERE RegNo = '".safee($condb,$search)."' AND reg_status = '1' AND verify_Data = 'TRUE'";
    $result = mysqli_query($condb,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['stud_id'],"label"=>$row['RegNo']);
    }

    // encoding array to json format
    echo json_encode($response);
    mysqli_close($condb);
}

// Get details
if($request == 2){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM student_tb WHERE stud_id=".$userid;

    $result = mysqli_query($condb,$sql);

    $users_arr = array();

    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['stud_id'];
        $firstname = $row['FirstName'];
        $lastname = $row['SecondName'];
        $faculty = $row['Faculty'];
        $dept1 = $row['Department'];
        $faculty2 = getfacultyc($row['Faculty']);
        $dept2 = getdeptc($row['Department']);
        $gender = $row['Gender'];
    $users_arr[] = array("id" => $userid, "fname" => $firstname,"lname" => $lastname, "fac" =>$faculty, "dept1" =>$dept1,"fac2" =>$faculty2, "dept2" =>$dept2, "sex" =>$gender);
    }

    // encoding array to json format
    echo json_encode($users_arr);
   mysqli_close($condb);
}
