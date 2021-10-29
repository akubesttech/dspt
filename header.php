<?php 
session_start();
 include_once('./admin/lib/dbcon.php'); 
 
dbcon(); 

$query= mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
							  $row = mysqli_fetch_array($query);
						?>
						

<!DOCTYPE html>
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
   <link href="assets/css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="assets/css/base.css" type="text/css">
    <link rel="stylesheet" href="assets/css/ApplyAlberta.css">
    <link rel="stylesheet" href="assets/css/SearchMacro2.css">
    <script type="text/javascript" src="./admin/bootstrap/js/datepicker.js"></script>
       
        <link href="./admin/bootstrap/css/datepicker.css" rel="stylesheet" type="text/css" />
        
        
    <link href="spry/tabbedpanels/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="spry/tabbedpanels/SpryTabbedPanels.js" type="text/javascript"></script>
    <!-- notification  -->
				<link href="admin/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
					<!-- wysiwug  -->
				<link rel="stylesheet" type="text/css" href="admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"/>
		<script src="admin/vendors/jquery-1.9.1.min.js" charset="utf-8"></script>
	<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --!>
        <script src="admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
				<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.min2.js"></script>



    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="akubest">
    <style>
.alert {
  /*  padding: 10px;
    background-color: #f44336;
    color: white;
    text-align: center; 
    */
  position: fixed;
    padding: 10px;
    background-color: #f44336;
    color: white;
    text-align: center;
  top: 75px;
  left: 30px;
  right: 20px;
   width: 95%;
   border-radius: 5px;
    z-index: 10; 
  
}
.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}


.overlay30 {
  position: absolute; 
  bottom: 0; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  transition: .5s ease;
  opacity:0;
  color: white;
  font-size: 15px;
  padding: 2px;
  text-align: center;
  
}
.container2 {
  position: relative;
  width: 100%;
  max-width: 300px;
}
.container2:hover .overlay30 {
   opacity: 1; 
}
.image {
  display: block;
  width: 100%;
/* height: auto; */
height: 120px;
}
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    float: left;
    transform: translate(-50%, -50%);
    font-size: 15px;
}

.square {
  height: 120px;
  width: 120px;
  background-color: #555;
  text-align:center;
  float:left;margin: 5px;
   padding-top: 7px;
    background-image: url("assets/media/calbackground.png"), url("paper.gif");
    background-size: auto;
background-blend-mode: lighten;
}
</style>
    <title>Welcome ! .::<?php echo $row['SchoolName']; ?> - CMS::.</title>

 <link rel="shortcut icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
    <link rel="icon" href="https://edu.smartdelta.com.ng/favicon2.ico" type="image/x-icon">
    
    <!-- CDF: No CSS dependencies were declared //-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
            <script src="/government_theme/js/html5shiv.js"></script>
            <script src="/government_theme/js/respond.min.js"></script>
    <![endif]-->
  <script>  
    /*    (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-20099882-1', 'auto');
        ga('require', 'linkid');
        ga('send', 'pageview'); */
        
$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 5000);
 
});
 jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosugpin.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}
 
	function fill(thisValue) {
		$('#country').val(thisValue);
		$('#pin').val(thisValue.substring(6, 20));
		$('#serial').val(thisValue.substring(31, 46));
		setTimeout("$('#suggestions').fadeOut();", 600);
	}
	function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("country");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    country.style.display = "block";
  } else {
    country.style.display = "none";
  }
}

    </script>
    <style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
	width: 369px;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	top:55px;
	margin: 0;
	width: 369px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(./assets/media/loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:369px;
	border:1px #CCC solid;
}

</style>	
</head>
<!--<body class="alberta-theme" onLoad="document.getElementById('country').focus();"> --!>
<body class="alberta-theme" >
    <!--[if lt IE 9 ]>
        <div class="alerts">
            <h1>Important Messages</h1>
            <a href="http://browsehappy.com/">
                <h1><i class="fa fa-warning"></i>You are using an older browser</h1>
                <p>Please upgrade for an optimal experience</p>
            </a>
        </div>
    <![endif]-->
    <div class="loading-modal" style="display:none;">
        <div class="fa fa-cog fa-spin fa-2x progress-animation"></div>
    </div>
    
    
    <header class="site-header" id="header">
    <div class="container">
    
        <div id="branding" class="row nopadding nomargin">
            <div class="col-sm-12 show-for-print">
                <img src="About%20ApplyAlberta%20%20%20ApplyAlberta_files/apply-alberta-logo.png" alt="">
            </div>
<!--<div class="col-xs-13 text-right header-mini-links">
                    <a href="Userlogin.php"> Portal Login 
                            <i class="fa fa-caret-square-o-right"></i> </a> --!>
            </div>
              <div class="text-right">
                    <a href="Userlogin.php">
                        Login
                    </a>
                                    <a href="Userlogin.php">
                            <i class="fa fa-caret-square-o-right"></i>
                        
                    </a>
            </div>
           <div class="col-xs-12 col-md-6 logo-container">
                <a href="#">
                    <div class="applyab-logo"><span class="access-offscreen">Apply</span></div>
                </a>
            </div>
            
            <div class="topics-buttons text-right"></div>
           <div class="topics-menu">
				 
				
				</div>
				
				
				
            <div class="col-sm-6 col-md-6 search-holder nopadding">
                <div class="search-input margin-md-bottom">
                    <a href="javascript:{}" class="search-submit" onclick="document.getElementById('top_search').submit();"><span class="fa fa-search"></span></a>
                    <form method="get" action="post.php" id="top_search" _lpchecked="1">
                        <input class="top-search form-control" name="search" autocomplete="on" placeholder="Search CMSystem" type="text">
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <div class="container-fluid nav-bar-top">
        <div class="row local-nav-top">
            <div class="col-xs-12 nopadding-md-down">
                <div class="container container-fluid-md-down">
                    <div class="row">
                        <div class="col-xs-12 page-navbox">
                            <div class="row">
                                <div class="col-xs-12">
                                    <nav class="nav-right" id="nav-local">
                                    
                                        <ul class="menu">
    <li class="hidden-sm hidden-xs home-icon active">
         <a href="<?php echo host(); ?>"><i class="fa fa-home"></i></a>
       <!-- <a onclick="doSomething()"><i class="fa fa-home"></i></a>  --!> 
    </li>
                <li>
                    <a href="prog.php?view=Program">School Program</a>
                        <ul class="menu hidden-md hidden-lg">
                                <li>
                                    <a href="#">Before You Start</a>
                                </li>
                                <li>
                                    <a href="apply_b.php?view=Application_Process">Application Process </a>
                                </li>
                                <li>
                                    <a href="https://edu.smartdelta.com.ng/?view=Our_institutions">Participating Institutions</a>
                                </li>
                        </ul>
                </li>
                <li>
                    <a href="apply_b.php?view=f_select">Admission</a>
                        <ul class="menu hidden-md hidden-lg">
                             <!--   <li>
                                    <a href="#">Undergraduate Students</a>
                                </li>
                                <li>
                                    <a href="#">Graduate Studies</a>
                                </li>
                                <li>
                                    <a href="#">International Students</a>
                                </li>
                                <li>
                                    <a href="#">Continuing Education</a>
                                </li>
                                <li>
                                    <a href="#">Apprenticeship Programs</a>
                                </li>--!>
                                
                        </ul>
                </li>
                <li>
                    <a href="apply_b.php?view=Help">Support/Help</a>
                        <ul class="menu hidden-md hidden-lg">
                                <li>
                                    <a href="https://edu.smartdelta.com.ng/?view=System_Availability">System Availability</a>
                                </li>
                                <li>
                                    <a href="apply_b.php?view=FAQ">Frequently-Asked Questions</a>
                                </li>
                        </ul>
                </li>
                	<li>
                    <a href="https://elearning.smartdelta.com.ng">e-learning</a>
                        
                </li>
                <li>
                    <a href="Userlogin.php">Login</a>
                        
                </li>

</ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php check_message(); ?>
    </div>
</header>
<?php 
//define(PW_SALT,'(+3%_');
function birthday($birthday){ 
    $age = strtotime($birthday);
    
    if($age === false){ 
        return false; 
    } 
    
    list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
    
    $now = strtotime("now"); 
    
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
    
    $age = $y2 - $y1; 
    
    if((int)($m2.$d2) < (int)($m1.$d1)) 
        $age -= 1; 
        
    return $age; 
}
/* 
function decryptStringArray ($stringArray, $key = "@?aku#70")
{
    $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
    return $s;
}

function encryptStringArray ($stringArray, $key = "@?aku#70") 
{
    $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
    return $s;
}

function prepareUrl($url, $key = "@?aku#70")
{
    $url = explode("?",$url,2);
    if(sizeof($url) <= 1)
        return $url;
    else
        return $url[0]."?params=".encryptStringArray($url[1],$key);
}

function setGET($params,$key = "@?aku#70") 
{
    $params = decryptStringArray($params,$key);
    $param_pairs = explode('&',$params);
    foreach($param_pairs as $pair)
    {
        $split_pair = explode('=',$pair);
        $_GET[$split_pair[0]] = $split_pair[1];
    }
}
*/
 include('./admin/pagination.php');
 function safed($ncon,$string){ $ncon = Database::$conn; //$string = $this->mysqli->real_escape_string($string);
$string = mysqli_real_escape_string($ncon,$string); return $string ;
    }

function createRandomPassword() {
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
return $pass;}


?>
<!-- <div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
</div> --!>