<?php

    tbl_genre            tbl_artist
    +-----------+        +----------------+
    |g_id|g_desc|        |a_id|a_name|g_id|
    +-----------+        +----------------+
    |  1 | Pop  |        | 1  |FloRida| 1 |
    |  2 | Rock |        | 2  |RMC    | 2 |
    +-----------+        +----------------+
    the items inside the table is just a exmple..
    
    
    $link = mysql_connect('localhost','root','');
    if (!$link) {
        die('Not connected : ' . mysql_error());
    }
    $db_selected = mysql_select_db('daniweb', $link);
    if (!$db_selected) {
        die ('Can\'t use database : ' . mysql_error());
    }
    //change LEFT to INNER if you only want genres with acts in them
    $r = mysql_query("SELECT g.genre_id, g.genre_name, a.act_id, a.act_name FROM genres AS g LEFT JOIN acts AS a ON g.genre_id = a.genre_id ORDER BY genre_name, act_name");
    if(mysql_num_rows($r)){
        $gid = -1;
        $genres = '';
        $acts = '';
        while($d = mysql_fetch_assoc($r)){
            if($d['genre_id'] != $gid){
                if($gid == -1){
                    $genres .= "<option value =\"{$d['genre_id']}\" selected=\"selected\">{$d['genre_name']}</option>";
                    $first = $d['genre_id']; 
                }else{
                    $genres .= "<option value =\"{$d['genre_id']}\">{$d['genre_name']}</option>";
                }
            }
            if($first == $d['genre_id']){
                $acts .= ($acts == "") ? "<option value =\"{$d['act_id']}\" selected=\"selected\">{$d['act_name']}</option>" : "<option value =\"{$d['act_id']}\">{$d['act_name']}</option>";
            }
            $json_pre[$d['genre_id']][$d['act_id']] = $d['act_name']; 
            $gid = $d['genre_id'];
        }
        $json = json_encode($json_pre);
    }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta charset="utf-8">
<title>$page_title</title>
</head>
<body>
<select id="cbo1">
    <?php echo $genres;?>
</select> 
<select id="cbo2">
    <?php echo $acts;?>
</select> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>
    var json = <?php echo $json;?>;
    var genre = <?php echo $first;?>;
    $('#cbo1').change(function(){
        genre = $(this).val();
        var content = '';
        $.each(json[genre], function(index, value) { 
            content += '<option value="' + index + '">' + value + '</option>'; 
        });
        $('#cbo2').html(content);
    });
</script>
</body>
</html>