<?php
include('lib/dbcon.php'); 
dbcon();

if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 $f_typea = $_POST['ftypea_val'];
 $f_desca = $_POST['fdesca_val'];
  $fcate = $_POST['fcate_val'];
  $status = $_POST['status_val'];

 mysqli_query($condb,"update ftype_db set f_type='$f_typea',d_desc='$f_desca',f_category='$fcate',status='$status' where id='$row'");
 echo "success";
 //exit();
 mysqli_close($condb);
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 mysqli_query($condb,"delete from ftype_db where id='$row_no'");
 echo "success";
 //exit();
 mysqli_close($condb);
}

if(isset($_POST['insert_row']))
{
 $f_typea = $_POST['ftypea_val'];
 $f_desca = $_POST['fdesca_val'];
 $fcate = $_POST['fcate_val'];
  $status = $_POST['status_val'];
 mysqli_query($condb,"insert into ftype_db(f_type, d_desc, f_category, status) VALUES('$f_typea','$f_desca','$fcate','$status')");
 echo mysqli_insert_id($condb);
 //echo "success";
// exit();
mysqli_close($condb);
}

if(isset($_POST["f_typea"]))
{
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
 $nftype = filter_var($_POST["f_typea"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
   
    $statement = mysqli_query($condb,"SELECT f_type FROM ftype_db WHERE f_type='".$nftype."'")or die(mysqli_error($condb));
    
   if (mysqli_num_rows($statement) > 0){
        die('<img src="../assets/media/not-available.png" /> <font color="red">The fee type your entered already exist</font>');
        //die("<input type='button' value='Add Fee Type' class='btn btn-success'   onclick='insert_row();'>");
       }else{
        //die('<img src="../assets/media/available.png" />');
        die("<input type='button' value='Add Fee Type' class='btn btn-success'   onclick='insert_row();'>");  
    }
}
    

?>