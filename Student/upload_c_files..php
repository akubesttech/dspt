<?php
//include('header.php');
//include('session.php');
$mat_no = $student_RegNo;
$mat_id = $session_id;
?>
<style>
  .errorp {
    background: red;
  }
</style>
<div class="x_panel">
    <div class="x_content">
    
    <div class="row">
         <span class="section">Clearance files upload <?php //echo $at_filename = preg_replace('/[\W\s\/]+/','-','2018/01/201'); ?></span>
            <!--<h4 class="x_title">Clearance files upload</h4>--!>
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Note: Maximum File upload is 2MB. 
                  </div>
            <div class="col-sm-4">
                <form class="form-horizontal" id="f_upload" enctype="multipart/form-data">
                    <div class="form-group">
                    <input type="hidden" id="nt_id" minlength="14" maxlength="14" value="<?php echo $session_id; ?>"  name="mat_id" class="form-control" />
                      <input type="hidden" id="ust_dept" value="<?php echo $student_dept; ?>"  name="dept" class="form-control"/>
                    <input type="hidden" id="ust_fac" value="<?php echo $student_facut; ?>"  name="fac" class="form-control"/>
                   <input type="hidden" id="ust_prog" value="<?php echo $student_prog; ?>"  name="prog" class="form-control"/>
                        <label for="st_id">Matric Number:</label>
                        <input type="text" id="ust_id" minlength="14" maxlength="14" value="<?php echo $mat_no?>"  name="mat_no" class="form-control" readonly required/>
                    </div>
                    <div class="form-group">
                        <label for="st_at">Attestation Letter:</label>
                        <input type="file" id="st_at" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="st_lg">LG Letter:</label>
                        <input type="file" id="st_lg" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="st_or">O'level Result:</label>
                        <input type="file" id="st_or" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="st_bc">Birth Certificate:</label>
                        <input type="file" id="st_bc" class="form-control" required/>
                    </div>
                    <input type="hidden" name="upload_type" value="clearance"/>
                    <button type="submit" id="f_submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="col-sm-4">
                <div class="ImagePreviewBox">
                    <!-- <img id="enlarged_image" alt="Uploaded file Image" src="" width="400px" height="400px" />--!>
                    <div id="imenl_div" style="display: none"><img id="enlarged_image" alt="Image" src="" width="500px" height="500px" /></div>
                    <div id="enl_div" style="display: none"><object id="enl_obj" data="" width="650px" height = "500px" type="application/pdf"> <embed id="enl_em" src="" type="application/pdf" ></object></div>
                
                </div>
            </div>
        </div>
        
        <div class="row">
         <span class="section">Status Of Uploaded Files</span>
            <!--<h4 class="x_title">Files status (if Submitted)</h4>--!>
<!--            <div class="col-sm-4">-->
<!--                <form class="form-inline" id="chk_stt_form">-->
<!--                    <div class="form-group">-->
<!--                        <label for="st_id">Matric Number:</label>-->
<!--                        <input type="text" id="st_id" minlength="10" maxlength="10" name="mat_no" class="form-control"required/>-->
<!--                    </div>-->
<!--                    <button type="submit" class="btn btn-primary">Check Status</button>-->
<!--                </form>-->
<!--            </div>-->
            <div class="col-sm-8">
                <h4 class="x_title">File Uploaded</h4>
                <div class="table-responsive">
                    <table class="table" id="file_stat_table">
                        <thead>
                        <tr><th>S/N</th>
                            <th>File type</th>
                            <th>File name</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
            <div class="col-sm-4">
            <h4 class="x_title">Edit files uploaded</h4>
                <form class="form-horizontal" id="edit_upload" enctype="multipart/form-data">
                    <fieldset id="edit_div" disabled>
                    <input type="hidden" id="nt_id" minlength="14" maxlength="14" value="<?php echo $session_id; ?>"  name="mat_id" class="form-control" />
                      <input type="hidden" id="ust_dept" value="<?php echo $student_dept; ?>"  name="dept" class="form-control"/>
                    <input type="hidden" id="ust_fac" value="<?php echo $student_facut; ?>"  name="fac" class="form-control"/>
                   <input type="hidden" id="ust_prog" value="<?php echo $student_prog; ?>"  name="prog" class="form-control"/>  
                        <div class="form-group">
                            <label for="est_id">Matric Number:</label>
                            <input type="text" id="est_id" minlength="14" maxlength="14" value="<?php echo $mat_no?>" name="mat_no" class="form-control" readonly required/>
                        </div>
                        <div class="form-group">
                            <label for="ed_f_type">File Type:</label>
                            <input type="text" id="ed_f_type" class="form-control" name="filetype" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="st_at">File:</label>
                            <input type="file" id="ed_file"  class="form-control" required/>
                        </div>
                        <input type="hidden" name="upload_type" value="editing"/>
                        <button type="submit" id="ef_submit" class="btn btn-primary">Upload</button>
                    </fieldset>
                </form>
            </div>
            
            
        </div>
      
        
    </div>
</div>
<?php
//include('footer.php');?>
<script>
   
    function activate_edit(file_type) {
        $('#ed_f_type').val(file_type);
        $('#edit_div').prop('disabled',false);
    }
    function deactivate(id) {
        //id.value = '';
        $('#'+id).prop('disabled',true);
    }
   // function enlarge_image(img) {
        //$('#enlarged_image').attr('src','../admin/cuploads/'+img);
//        $(this).width('100%');
//        $(this).height('100%');
   // }
    function enlarge_image(img,ft) {
        alert("You clicked me");
        if(ft === 'img'){
            $('#enl_div').css('display','none');
            $('#imenl_div').css('display','block');
            $('#enlarged_image').attr('src','../admin/cuploads/'+img);
        }else {
            $('#imenl_div').css('display','none');
            $('#enl_div').css('display','block');
            $('#enl_obj').attr('data','../admin/cuploads/'+img);
            $('#enl_em').attr('src','../admin/cuploads/'+img);
        }}
    function check_stats() {
        $.ajax({
            url:'upload.php',
            dataType:'json',
            type:'post',
            //data:{'mat_no':'<?php echo $mat_no; ?>'},
            data:{'mat_id':'<?php echo $mat_id; ?>'},
            success:function (r) {
                if(r.error){
                    //alert(r.error)
                }else {
                    var res = r.res;
                    var table = $('#file_stat_table');
                    var i = 1;
                    if(res.length > 0){
                        $('#file_stat_table tbody').remove();
                        table.append('<tbody>');
                        $.each(res,function (i,v) {
                            var stat='Not yet attended to';
                            var edit = '';
                            //sicon = '';
                             var sicon = '';
                            
                             var str = v.file_name;
                            var filena = str.split('.');
                            //alert(JSON.stringify(filena));
                            var disp = '<img src="../admin/cuploads/'+v.file_name+'" onclick="enlarge_image(\''+v.file_name+'\',\'img\')"  height="30px" width="50px"/>';
                            if(filena[1] === 'pdf'){
                                disp = '<button onclick="enlarge_image(\''+v.file_name+'\',\'pdf\')"><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></button>';
                                //disp = '<div><object data="uploads/'+v.file_name+'" width=400px" height = "700px" type="application/pdf"> <embed src="uploads/'+v.file_name+'" type="application/pdf" ></object></div>';
                            }
                            if(v.status == 1){
                                stat = 'Approved';
                                sicon = '<font color="green"><i class="fa fa-check"></i></font>';
                            }else if(v.status == 2){
                                //$('#est_id').val($('#st_id').val());
                                stat= 'Not accepted';
                                sicon = '';
                                //var edit_id = 'edit_div';
                                edit = '<button onclick="activate_edit(\''+v.file_type+'\')" class="btn btn-danger">Edit</button>'
                            }else {
                                //$('#est_id').val($('#st_id').val());
                                edit = '<button onclick="activate_edit(\''+v.file_type+'\')" class="btn btn-primary">Edit</button>'
                            }
                            table.append(
                                '<tr>'+
                                '<td>'+ ++i +'</td>'+
                                '<td>'+v.file_type+'</td>'+
                                '<td>'+v.file_name+'</td>'+
                                '<td>'+disp+'</td>'+
                                //'<td><img src="../admin/cuploads/'+v.file_name+'" onclick="enlarge_image(\''+v.file_name+'\')"  height="30px" width="40px"/></td>'+
                                '<td>'+stat+'</td>'+
                                '<td>'+v.remark+'</td>'+
                                '<td>'+edit+ sicon +'</td>'+
                                '</tr>'
                            );
                        });
                        table.append('</tbody>');
                    }
                }
            }
        })
    }
    $(document).ready(function () {
        //$('form').parsley();
        check_stats();
        $('#edit_upload').on('submit',function (e) {
            e.preventDefault();
            var fil = $('#ed_file').get(0).files[0];
            if(fil.size > 200000){
                alert('File upload should not be more than 2MB');
                return false;
            }
            var f = new FormData();
            f.append('edited_file',fil);
            const s_data = {};
            $.each($(this).serializeArray(), function () {
                s_data[this.name] = this.value;
            });
            f.append('data',JSON.stringify(s_data));
            $.ajax({
                url:'upload.php',
                contentType:false,
                processData:false,
                dataType:'json',
                type:'post',
                data:f,
                success:function (r) {
                    if(r.error){
                        alert(r.error)
                    }else{
                        alert(r.message)
                        location.reload(true)
                    }
                },
                error:function (x,s,er) {
                    alert(er);
                }

            })
        });
        $('#chk_stt_form').on('submit',function (e) {
           e.preventDefault();
           var data = $(this).serializeArray();

        });
       $('#f_upload').on('submit',function (e) {
           e.preventDefault();
           var fil = $('#st_at').get(0).files[0];
           if(fil.size > 200000){
               alert('File upload should not be more than 2MB');
               return false;
           }
           var f = new FormData();
           f.append('at_file',fil);
           fil = $('#st_lg').get(0).files[0];
           if(fil.size > 200000){
              
               alert('File upload should not be more than 2MB');
               return false;
           }
           f.append('lg_file',fil);
           fil = $('#st_or').get(0).files[0];
           if(fil.size > 200000){
               alert('File upload should not be more than 2MB');
               return false;
           }
           f.append('ol_file',fil);
           fil = $('#st_bc').get(0).files[0];
           if(fil.size > 200000){
               alert('File upload should not be more than 2MB');
               return false;
           }
           f.append('bc_file',fil);
           const s_data = {};
           $.each($(this).serializeArray(), function () {
               s_data[this.name] = this.value;
           });
           f.append('data',JSON.stringify(s_data));
           $.ajax({
               url:'upload.php',
               contentType:false,
               processData:false,
               dataType:'json',
               type:'post',
               data:f,
               success:function (r) {
                   if(r.error){
                       alert(r.error);
                   }else{
                       alert(r.message)
                       location.reload(true)
                   }
               },
               error:function (x,s,er) {
                   alert(er);
               }
           })
       })
    });
</script>
