<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 1/6/2020
 * Time: 9:37 AM
 */
include_once('../admin/lib/dbcon.php');
if(isset($_POST['mat_id'])){
    $stu_mat = $_POST['mat_id'];
    //$f_stat = mysqli_query($condb,"Select * from clearance_files WHERE matric_no = '$stu_mat'");
    $f_stat = mysqli_query($condb,"Select * from clearance_files WHERE student_id = '$stu_mat'");
    if($f_stat->num_rows > 0){
        echo json_encode(array('res'=>$f_stat->fetch_all(MYSQLI_ASSOC)));
    }else{
        echo json_encode(array('error'=>'You have not submitted any files!!!'));
    }
}
if(isset($_POST['data'])){
    $d = json_decode($_POST['data'],true);
    //echo json_encode($d);
    if($d['upload_type'] === 'clearance'){
        $mat = $d['mat_no']; $id_no = $d['mat_id'];  $dept = $d['dept'];$fac = $d['fac'];$prog = $d['prog'];
        $exist_query = mysqli_query($condb,"Select * from clearance_files WHERE student_id = '$id_no'");
        if($exist_query->num_rows > 0){
            echo json_encode(array('error'=>'Your files has already been approved or pending approval, Edit instead'));
            exit();
        }
        if(isset($_FILES['at_file']['tmp_name']) && isset($_FILES['lg_file']['tmp_name']) && isset($_FILES['bc_file']['tmp_name'])&& isset($_FILES['ol_file']['tmp_name'])){
            $inv = false;
            foreach ($_FILES as $fil){
                $ft = explode('/',$fil['type']);
                if($ft[0] !== 'image'){
                   if($ft[1] !== 'pdf'){
                        echo json_encode(array('error'=>'One or more files you uploaded is invalid, only image file and pdf allowed!!!'));
                        $inv = true;
                        break;
                    }
                }
                if ($fil['size'] > 200000){
                   echo json_encode(array('error'=>'File upload should not be more than 2MB !!!'));
                    $inv = true;
                    break;
                }
            }
            if($inv === true){
                exit();
            }
            $res = array();
            $temp = explode(".",$_FILES['at_file']['name']);
            $at_filename = $id_no.'_att.'.end($temp);
            if(move_uploaded_file($_FILES['at_file']['tmp_name'],'../admin/cuploads/'.$at_filename)){
                $res[] = array('filename'=>$at_filename,'filetype'=>'attest','status'=>'uploaded');
                $temp = explode(".",$_FILES['lg_file']['name']);
                $lg_filename = $id_no.'_lg.'.end($temp);
                if(move_uploaded_file($_FILES['lg_file']['tmp_name'],'../admin/cuploads/'.$lg_filename)){
                    $res[] = array('filename'=>$lg_filename,'filetype'=>'Local Government','status'=>'uploaded');
                    $temp = explode(".",$_FILES['bc_file']['name']);
                    $bc_filename = $id_no.'_bc.'.end($temp);
                    if(move_uploaded_file($_FILES['bc_file']['tmp_name'],'../admin/cuploads/'.$bc_filename)){
                        $res[] = array('filename'=>$bc_filename,'filetype'=>'Birth Certificate','status'=>'uploaded');
                        $temp = explode(".",$_FILES['ol_file']['name']);
                        $ol_filename = $id_no.'_res.'.end($temp);
                        if(move_uploaded_file($_FILES['ol_file']['tmp_name'],'../admin/cuploads/'.$ol_filename)){
                            $res[] = array('filename'=>$ol_filename,'filetype'=>'O level Result','status'=>'uploaded');
                       
                            foreach ($res as $re){
                                $fname = $re['filename'];
                                $ftype = $re['filetype'];
                                $stst = $re['status'];
                                $inser_q = mysqli_query($condb,"insert into clearance_files(student_id, matric_no, file_name, file_type,fac,dept,prog) VALUES ('$id_no','$mat',
                                                          '$fname','$ftype','$fac','$dept','$prog')") or die(mysqli_error($condb));
                            }
                            echo json_encode(array('message'=>'Files Uploaded Successfully'));
                        }else{
                            unlink('../admin/cuploads/'.$at_filename);
                            unlink('../admin/cuploads/'.$lg_filename);
                            unlink('../admin/cuploads/'.$bc_filename);
                            echo json_encode(array('error'=>'File upload could not completed!!!'));
                        }
                    }else{
                        unlink('../admin/cuploads/'.$at_filename);
                        unlink('../admin/cuploads/'.$lg_filename);
                        echo json_encode(array('error'=>'File upload could not completed!!!'));
                    }
                }else{
                    unlink('../admin/cuploads/'.$at_filename);
                    echo json_encode(array('error'=>'File upload could not completed!!!'));
                }
            }else{
                echo json_encode(array('error'=>'File upload could not completed!!!'));
            }
        }else{
            echo json_encode(array('error'=>'Files uploaded not complete!!!7'));
        }
    }elseif ($d['upload_type'] === 'editing'){
        $mat = $d['mat_no']; $id_no = $d['mat_id'];
        $dept = $d['dept'];$fac = $d['fac'];$prog = $d['prog'];
        $file_type = $d['filetype'];
        if(isset($_FILES['edited_file']['tmp_name'])){
            $temp = explode(".",$_FILES['edited_file']['name']);
            if(strtolower(end($temp)) ==='pdf' || strtolower(end($temp)) ==='jpg' || strtolower(end($temp)) ==='jpeg' || strtolower(end($temp)) === 'png'){
                
            }else{
                echo json_encode(array('error'=>'One or more files you uploaded is invalid, only image file and pdf allowed!!!'));
                exit();
            }
           //  $ft = explode('/',$_FILES['edited_file']['type']);
            $inv = false;
           // if($ft[0] !== 'image'){
           //     if($ft[1] !== 'pdf'){
           //         echo json_encode(array('error'=>'One or more files you uploaded is invalid, only image file and pdf allowed!!!'));
           //         $inv = true;
                   // break;
            //    }
            //}
            if ($_FILES['edited_file']['size'] > 200000){
                echo json_encode(array('error'=>'File upload should not be more than 2MB !!!'));
                $inv = true;
                //break;
            }
            if($inv === true){
                exit();
            }
            
            switch ($file_type){
                case 'Local Government':
                    $at_filename = $id_no.'_lg.'.end($temp);
                    break;
                case 'Birth Certificate':
                    $at_filename = $id_no.'_bc.'.end($temp);
                    break;
                case 'O level Result':
                    $at_filename = $id_no.'_ol.'.end($temp);
                    break;
                case 'attest':
                    $at_filename = $id_no.'_att.'.end($temp);
                    break;
                default:
                    $at_filename = null;
            }
            if(move_uploaded_file($_FILES['edited_file']['tmp_name'],'../admin/cuploads/'.$at_filename)){
                $update_query = mysqli_query($condb,"Update clearance_files set file_name='$at_filename',matric_no='$mat',prog='$prog',fac='$fac',dept='$dept' WHERE student_id='$id_no' AND file_type = '$file_type'");
                echo json_encode(array('message'=>'File updated!!!'));
            }else{
                echo json_encode(array('error'=>'File upload could not be completed!!!'));
            }
        }else{
            echo json_encode(array('error'=>'No file attached!!!'));
        }
        //echo json_encode($d);
    }
}
?>