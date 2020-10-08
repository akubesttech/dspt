<?php
include('lib/dbcon.php'); 
dbcon();

$request = $_POST['request'];   // request

// Get username list
if($request == 1){
    $search = $_POST['search'];
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
        $userid = $row['stud_id']; $matno = $row['RegNo']; $lev = $row['p_level'];
        $fullname = $row['FirstName']." ".$row['SecondName']." ".$row['Othername'];
        //$secondname = $row['SecondName'];
        //$othername = $row['Othername'];
        $faculty = $row['Faculty'];
        $dept1 = $row['Department'];
        $faculty2 = getfacultyc($row['Faculty']);
        $dept2 = getdeptc($row['Department']);
        $prog = $row['app_type']; $progn = getprog($row['app_type']);$acads2 = $row['acads'];
        $sec = $row['Asession']; $scgpa = getcgpa($matno,$prog,$sec,$lev); $acads = getAcastatus($row['acads']);
        $dog = $row['dog']; $comm = $row['comment'];
    $users_arr[] = array("id" => $userid, "fname" => $fullname, "fac" =>$faculty, "dept1" =>$dept1,"fac2" =>$faculty2, "dept2" =>$dept2,
     "prog" =>$prog,"progn" =>$progn,"comm" =>$comm,"sec" =>$sec,"acs" =>$acads,"scgpa" =>$scgpa,"dog" =>$dog,"acs2" =>$acads2);
    }

    // encoding array to json format
    echo json_encode($users_arr);
   mysqli_close($condb);
}
