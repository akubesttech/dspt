<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 1/17/2020
 * Time: 4:17 PM
 */
//include_once('../admin/lib/dbcon.php');
include_once('lib/dbcon.php');

if(isset($_GET['students'])){
    $dept = $_GET['students'];
    echo json_encode(array('res'=>get_students($condb,$dept)));
    exit();
}
//if(isset($_GET['students'])){
    //echo json_encode(array('res'=>get_students($condb)));
    //exit();
//}
if(isset($_GET['facs'])){
    echo json_encode(array('res'=>get_faculties($condb)));
    exit();
}
if(isset($_GET['dept'])){
    $fac = $_GET['dept'];
    echo json_encode(array('res'=>get_department($condb,$fac)));
    exit();
}
if(isset($_GET['stu_mat'])){
    $files = fetch_submitted_files($_GET['stu_mat'],$condb);
    if(is_string($files)){
        echo json_encode(array('error'=>$files));
    }else{
        echo json_encode(array('st_files'=>$files));
    }
    exit();
}
if(isset($_POST['st_mat'])){
    //$f_data = $_POST['form_data'];
    $st_mat = $_POST['st_mat'];
    $up[]= update_status($condb,$_POST['id_status'],$st_mat,"Local Government",$_POST['ld_rem']);
    $up[]= update_status($condb,$_POST['at_status'],$st_mat,"attest",$_POST['at_rem']);
    $up[]= update_status($condb,$_POST['ol_status'],$st_mat,"O level Result",$_POST['ol_rem']);
    $up[]= update_status($condb,$_POST['bc_status'],$st_mat,"Birth Certificate",$_POST['bc_rem']);

    echo json_encode(array('res'=>$up));

}
function get_faculties($condb){
    $facs = mysqli_query($condb,"Select distinct fac_id,fac_name from faculty");
    if($facs->num_rows > 0){
        return $facs->fetch_all(MYSQLI_ASSOC);
    }else{
        return array();
    }
}
function get_department($condb,$fac){
    $depts = mysqli_query($condb,"Select distinct dept_id,d_name from dept WHERE fac_did='$fac'");
    if($depts->num_rows > 0){
        return $depts->fetch_all(MYSQLI_ASSOC);
    }else{
        return array();
    }
}
function update_status($condb,$stat,$mat,$filetype,$rem = null){
    $up_stat = mysqli_query($condb,"Update clearance_files set status='$stat',remark='$rem' WHERE matric_no='$mat' AND file_type = '$filetype'");
    if($up_stat){
     return true;
    }else{
        return false;
    }
}
function get_students($condb,$dept){
    $students = mysqli_query($condb,"Select DISTINCT matric_no from clearance_files WHERE status <> 1 AND dept = '$dept'");
    if($students->num_rows > 0){
        return $students->fetch_all(MYSQLI_ASSOC);
    }else{
        return array();
    }
}
/*function get_students($condb){ //status !=2
    $students = mysqli_query($condb,"Select DISTINCT matric_no from clearance_files WHERE status <> 1 ");
    if($students->num_rows > 0){
        return $students->fetch_all(MYSQLI_ASSOC);
    }else{
        return array();
    }
}*/
function fetch_submitted_files($stu_mat,$condb){
    $st_files = mysqli_query($condb,"Select * from clearance_files WHERE matric_no = '$stu_mat'");
    if($st_files->num_rows > 0){
        return $st_files->fetch_all(MYSQLI_ASSOC);
    }else{
        return "No files for the student selected";
    }
}