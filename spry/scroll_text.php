<?php   
 $connect = mysqli_connect("localhost", "root", "", "test_db");  
 $sql = "SELECT * FROM tbl_video ORDER BY video_id LIMIT 5";  
 $result = mysqli_query($connect, $sql);  
 ?>  
 <html>  
      <head>  
           <meta name="viewport" content="initial-scale=1.0, user-scalable=no">  
           <meta charset="utf-8">  
           <title>Webslesson Tutorial</title>  
           <script src="jquery.js"></script>  
           <script src="js/bootstrap.js"></script>  
           <link href="css/bootstrap.css" rel="stylesheet" />  
      </head>  
      <body>  
           <div class="container" style="width:500px; border:1px solid #ccc;">  
                <br />  
                <marquee behavior="scroll" direction="up" onmouseover="this.stop();" onmouseout="this.start();">  
                <?php  
                     if(mysqli_num_rows($result) > 0)  
                     {  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '<label><a href="'.$row['video_link'].'" target="_blank">'.$row['video_title'].'</a></label>';  
                          }  
                     }  
                ?>  
                </marquee>  
                <br />                 
           </div>  
      </body>  
 </html>  