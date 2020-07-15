<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 1/16/2020
 * Time: 1:51 PM
 */
//include('header.php');?>
 
<div class="x_panel">
    <div class="x_content">
    <span class="section">Review Clearance files <span class="badge bg-yellow"><?php echo $clearno." Pending"; ?></span>  </span>
        <!--<h4 class="x_title">Review Clearance files</h4>--!>
        <form class="form-horizontal" id="appr_file_form">
            <div class="form-group row">
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
          Please Select the Approprate information and Click the file image to view the uploaded File before approval
                  </div>
                <div class="form-group col-sm-4">
                <label for="fac"><?php echo $SCategory; ?>:</label>
                        <select id="fac" name="fac" class="form-control" required>
                            <option value="">Select <?php echo $SCategory; ?></option>
                        </select>
                        <label for="dept"><?php echo $SGdept1; ?>:</label>
                        <select id="dept" name="dept" class="form-control" required>
                            <option value="">Select <?php echo $SGdept1; ?></option>
                        </select>
                    
                    <label for="st_mat">Student Mat No:</label>
                    <select id="st_mat" name="st_mat" class="form-control" required>
                        <option value="">Select Student</option>
                    </select><hr>
                     <label for="lg_id"><span class="badge bg-green">1</span> LG ID uploaded:</label><br>
                        <div id="lg_id"><img src=""    width="20px" height="20px" alt="Local ID Image here" /></div><br>
                        <input type="radio" name="id_status" required onclick="deactivate_textform('ld_rem')" value="1" > Good &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="id_status" required onclick="activate_textform('ld_rem')" value="2" > Not Accepted <br>
                        <div class="form-group">
                            <label for="ld_rem">Remark:</label>
                            <textarea id="ld_rem" name="ld_rem" disabled placeholder="Remark here.."></textarea>
                        </div><hr>
                        <label for="at_l"><span class="badge bg-green">2</span> Attestation letter uploaded:</label><br>
                       <div id="at_l"> <img src=""  width="50px" height="50px" alt="Attestation letter here" /></div><br>
                        <input type="radio" name="at_status" value="1" required onclick="deactivate_textform('at_rem')" > Good &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="at_status" required onclick="activate_textform('at_rem')" value="2" > Not Accepted <br>
                        <div class="form-group">
                            <label for="at_rem">Remark:</label>
                            <textarea id="at_rem" name="at_rem" disabled placeholder="Remark here.."></textarea>
                        </div><hr>
                         <label for="o_l"><span class="badge bg-green">3</span> O'Level Result uploaded:</label><br>
                        <div id="o_l"><img src=""  width="50px" height="50px" alt="O'level result here" /> </div><br>
                        <input type="radio" name="ol_status" value="1" required onclick="deactivate_textform('ol_rem')" > Good &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ol_status" value="2" required onclick="activate_textform('ol_rem')" > Not Accepted <br>
                        <div class="form-group">
                            <label for="ol_rem">Remark:</label>
                            <textarea id="ol_rem" name="ol_rem" disabled placeholder="Remark here.."></textarea>
                        </div><hr>
                        <label for="b_c"><span class="badge bg-green">4</span> Birth Certificate uploaded:</label><br>
                       <div id="b_c"> <img src=""  width="20px" height="20px" alt="Birth Certificate here" /></div><br>
                        <input type="radio" name="bc_status" required value="1" onclick="deactivate_textform('bc_rem')" > Good &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="bc_status" required value="2" onclick="activate_textform('bc_rem')" id="bc_status"> Not Accepted <br>
                        <div class="form-group">
                            <label for="bc_rem">Remark:</label>
                            <textarea id="bc_rem" name="bc_rem" disabled placeholder="Remark here.."></textarea>
                        </div><hr>
                        
                        <button class="btn btn-primary" type="submit" >Submit</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                </div>
              <!--  <div class="form-group ">
                      
                    </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                       
                    </div>
                    <div class="form-group">
                        
                    </div> --!>
                
                <div class="form-group col-sm-6">
                
                <div class="ImagePreviewBox">
                   <!-- <img id="enlarged_image" alt="Uploaded file Image" src="" width="400px" height="400px" />--!>
        <div id="imenl_div" style="display: none"><img id="enlarged_image" alt="Image" src="" width="650px" height="600px"  /></div>
                            <div id="enl_div" style="display: none"><object id="enl_obj" data="" width="650px" height = "800px" type="application/pdf"> <embed id="enl_em" src="" type="application/pdf" ></object></div>
                       
                </div></div>
                
               
                
            </div>
        </form>
    </div>
</div>
<?php
//include('footer.php');?>
<script>
 function popup() {
       var image = $(this).attr('src');
        w2popup.open({
            title: 'Image',
            body: '<div class="w2ui-centered"><img src="'+image+'"></img></div>'
        });
    }
    function activate_textform(id) {
        $('#'+id).prop('disabled',false);
    }
    function deactivate_textform(id) {
        id.value = '';
        $('#'+id).prop('disabled',true);
    }
    //function enlarge_image(img) {
       // $('#enlarged_image').attr('src','cuploads/'+img);
//        $(this).width('100%');
//        $(this).height('100%');
    //}
    function enlarge_image(img,ft) {
        //alert("You clicked me");
        if(ft === 'img'){
            $('#enl_div').css('display','none');
            $('#imenl_div').css('display','block');
            $('#enlarged_image').attr('src','cuploads/'+img);
        }else {
            $('#imenl_div').css('display','none');
            $('#enl_div').css('display','block');
            $('#enl_obj').attr('data','cuploads/'+img);
            $('#enl_em').attr('src','cuploads/'+img);
        }

//        $(this).width('100%');
//        $(this).height('100%');
    }
      function populate_submission() {
        $.getJSON('process_clr.php',{facs:''},function (data) {
            var studs = data.res;
            if(studs.length > 0){
                var ele = $('#fac');
                ele.empty().append(
                    '<option value="">Select <?php echo $SCategory; ?></option>'
                );
                $.each(studs,function (i,v) {
                    ele.append(
                        '<option value="'+v.fac_id+'">'+v.fac_name+'</option>'
                    );
                });
            }
        });
    }
    
  /*  function populate_submission() {
        $.getJSON('process_clr.php',{students:''},function (data) {
            var studs = data.res;
            if(studs.length > 0){
                var ele = $('#st_mat');
                ele.empty().append(
                    '<option value="">Select student</option>'
                );
                $.each(studs,function (i,v) {
                    ele.append(
                        '<option value="'+v.matric_no+'">'+v.matric_no+'</option>'
                    );
                });
            }
        });
    }
*/
    $(document).ready(function () {
        //$('form').parsley();
        populate_submission();
$('#fac').on('change',function () {
            if($(this).val() === ''){

            }else {
                $.getJSON('process_clr.php',{dept:$(this).val()},function (data) {
                    var studs = data.res;
                    if(studs.length > 0){
                        var ele = $('#dept');
                        ele.empty().append(
                            '<option value="">Select <?php echo $SGdept1; ?></option>'
                        );
                        $.each(studs,function (i,v) {
                            ele.append(
                                '<option value="'+v.dept_id+'">'+v.d_name+'</option>'
                            );
                        });
                    }
                });
            }
        });
  $('#dept').on('change',function () {
            if($(this).val() === ''){

            }else {
                $.getJSON('process_clr.php',{students:$(this).val()},function (data) {
                    var studs = data.res;
                    if(studs.length > 0){
                        var ele = $('#st_mat');
                        ele.empty().append(
                            '<option value="">Select student</option>'
                        );
                        $.each(studs,function (i,v) {
                            ele.append(
                                '<option value="'+v.matric_no+'">'+v.matric_no+'</option>'
                            );
                        });
                    }
                });
            }
        });
        $('#st_mat').on('change',function () {
            if($(this).val() === ''){

            }else {
                $.getJSON('process_clr.php',{stu_mat:$(this).val()},function (data) {
                    if(data.error){
                        alert(data.error);
                    }else {
                        var res = data.st_files;
                        $.each(res,function (i,v) {
                             var str = v.file_name;
                            var filena = str.split('.');
                            var disp = '<img src="cuploads/'+v.file_name+'" onclick="enlarge_image(\''+v.file_name+'\',\'img\')"  height="50px" width="50px"/>';
                            if(filena[1] === 'pdf'){
                                disp = '<button onclick="enlarge_image(\''+v.file_name+'\',\'pdf\')"><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></button>';
                            }
                             if(v.file_type === 'attest'){
                                $('#at_l').empty();
                                $('#at_l').append(disp);
                                $('#at_rem').val(v.remark);
                            }else if(v.file_type === 'Local Government'){
                                $('#lg_id').empty();
                                $('#lg_id').append(disp);
                                $('#ld_rem').val(v.remark);
                            }else if(v.file_type === 'Birth Certificate'){
                                $('#b_c').empty();
                                $('#b_c').append(disp);
                                $('#bc_rem').val(v.remark);
                            }else if(v.file_type === 'O level Result'){
                                $('#o_l').empty();
                                $('#o_l').append(disp);
                                $('#ol_rem').val(v.remark);
                                 
                                 
                            }
                            
                            //if(v.file_type === 'attest'){
                                //$('#at_l').attr('src','cuploads/'+v.file_name);
                                //$('#at_rem').val(v.remark);
                            //}else if(v.file_type === 'Local Government'){
                               // $('#lg_id').attr('src','cuploads/'+v.file_name);
                               // $('#ld_rem').val(v.remark);
                           // }else if(v.file_type === 'Birth Certificate'){
                               // $('#b_c').attr('src','cuploads/'+v.file_name);
                                //$('#bc_rem').val(v.remark);
                           // }else if(v.file_type === 'O level Result'){
                               // $('#o_l').attr('src','cuploads/'+v.file_name);
                               //  $('#ol_rem').val(v.remark);
                                
                            //}

                        })
                    }
                })
            }
        })
        $('#appr_file_form').on('submit',function (e) {
            e.preventDefault();
            var f_data = $(this).serializeArray();
            //alert(JSON.stringify(f_data));
            $.ajax({
                url:'process_clr.php',
                dataType:'json',
                type:'post',
                data:f_data,
                success:function (r) {
                    if(r.error){
                        alert(r.error);
                    }else {
                        alert("Review Submitted!");
                    }
                },
                error:function (x,s,er) {
                    alert(er);
                }
            });
        });
    })
</script>
