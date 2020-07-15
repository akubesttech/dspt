<?php
/**
 * Created by PhpStorm.
 * User: Habib
 * Date: 7/12/2019
 * Time: 1:29 PM
 */
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<section id="content" role="document">
    <main style="min-height: 168px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div id="breadcrumbs-share">
                        <section id="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a href=".<?php host(); ?>">Home</a> </li>
                                <li><a href="javascript:void(0);" onclick="window.open('post.php?view=Program','_self')">Go Back</a> </li>

                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="page-title-box">
                        <h2 id="pageTitleStub">List Of Department(s) in  <?php echo getfacultyc($_GET['facid']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="posts_content" class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
                    <div class="row">
                        <div class="col-xs-12 primary-content link-icons">
                            <?php
                            //get number of rows
                            $limit = 21;
                            $keywords = isset($_GET['search'])? $_GET['search']: null;
                            if(!empty($keywords)){
                                $whereSQL = "WHERE d_name LIKE '%".$keywords."%' OR  d_faculty LIKE '%".$keywords."%' AND fac_did ='".($_GET['facid'])."' ORDER BY dept_id DESC";
                            }else{
                                $whereSQL = "WHERE  fac_did ='".($_GET['facid'])."' ORDER BY dept_id DESC";
                            }

                            $queryNum = mysqli_query($condb,"SELECT COUNT(*) as postNum FROM dept ".$whereSQL);
                            $resultNum = mysqli_fetch_assoc($queryNum);
                            $rowCount = $resultNum['postNum'];

                            //initialize pagination class
                            $pagConfig = array(
                                'totalRows' => $rowCount,
                                'perPage' => $limit,
                                // 'link_func' => 'searchFilter'
                            );
                            //$pagination =  new Pagination($pagConfig);

                            $sql ="SELECT * FROM dept  ";
                            if(isset($_GET['search'])){ $sql = $sql . " where (d_name LIKE '%$_GET[search]%' OR  d_faculty LIKE '%$_GET[search]%' ) AND fac_did ='".($_GET['facid'])."' ";
                            }else{ $sql = $sql . " where  fac_did ='".($_GET['facid'])."' ";}

                            $sql = $sql . " ORDER BY d_name DESC LIMIT $limit";
                            $qsql = mysqli_query($condb,$sql);
                            $count = mysqli_num_rows($qsql);
                            //if(empty($_GET['search'])){	redirect('post.php?view=q');}

                            if ($count < 1){ ?>
                                <div id="posts_content" class="col-xs-12 col-md-9 margin-lg-bottom link-icons">
                                    <h1 role="banner">Search Results</h1>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div id="searchResults">
                                                <div class="margin-md-bottom">
                                                    <a class="search-submit" onclick="document.getElementById('top_search').submit();"></a>
                                                    <form method="get" action="post.php?view=nMore" id="top_search">
                                                        <label for="q2" class="sr-only">Search</label>
                                                        <input class="search-page-control form-control" id="q2" name="search" autocomplete="on" placeholder="Enter search terms" type="text"> <p align='justify'><h4 id="pageTitleStub"><font color="red">Sorry, no results were found.</font></h4></p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{
                            while($rs = mysqli_fetch_array($qsql))
                            {//$newstype = $rs['news_type'];  $eventd = $rs['event_date'];
                            //                            $timestamp = strtotime($eventd); $datetime	= date('F', $timestamp);  $datetime2	= date('jS', $timestamp);
                            //                            // $datetime	= date('l, jS F Y', $timestamp);
                            //                            $npostdate	= $rs['publish_date'];
                            $newsicon = "<i class='fa fa-file'></i> ";

                            //display all departments in the faculty
                            ?>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3><?php echo $newsicon; ?><?php echo " ".ucwords($rs['d_name']); ?></h3>
                                        <p class="info first-paragraph"><span class="nomargin">&nbsp;</span><span class="nomargin"><strong>Courses Allocated to <?php echo ucwords($rs['d_name']); ?>&nbsp;</strong></span></p>
                                        <p align='justify'>
                                            <?php
                                            $sql_coursedisplay = mysqli_query($condb,"select C_level as level,dept_c as dept,semester as sem from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  ORDER BY C_level ASC ")or die (mysqli_error($condb));
                                            if(mysqli_num_rows($sql_coursedisplay) > 0){ ?>
                                        <div class="accordion" id="accordionExample">
                                            <?php
                                            $check_class = null;
                                            while($get_proc=mysqli_fetch_array($sql_coursedisplay)){ 
                                            //while loop for fecthing courses in one department

                                            if($check_class == $get_proc['level']) continue;
                                            $check_class = $get_proc['level']; $sem = $get_proc['sem'];
                                            ?>
                                            <div class="card" style="width:70%;">
                                                <div class="card-header" id="headingOne">
                                                    <button class="btn btn-primary" style="font-size: 1.5rem;" type="button" data-toggle="collapse" data-target="#sysgyih<?php echo $get_proc['dept'];echo $get_proc['level']; ?>" aria-expanded="false" aria-controls="sysgyih<?php echo $get_proc['dept'];echo $get_proc['level'];?>">
                                                        <strong><?php echo getmplevel($get_proc['level']); ?></strong>
                                                    </button>
                                                </div>
                                                
							<div id="sysgyih<?php echo $get_proc['dept'];echo $get_proc['level']; ?>" class="collapse ind" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <table class="table text-center" width="70%">
                                                            <thead style="background-color: #006e79;color:#fff;">
                                                            <tr>
                                                                <th scope="col">Sno</th>
                                                                <th scope="col">COURSE CODE</th>
                                                                <th scope="col">COURSE TITLE</th>
                                                                <th scope="col">SEMESTER</th>
                                                                <th scope="col">CREDIT</th>
                                                                <th scope="col">STATUS</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
//$sql_course = mysqli_query($condb,"select * from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."'  ")or die (mysqli_error($condb));
$sql_course = mysqli_query($condb,"select * from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='First' ORDER BY C_code,C_title  DESC  ")or die (mysqli_error($condb));
$sql_course2 = mysqli_query($condb,"select * from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='Second' ORDER BY C_code,C_title  DESC  ")or die (mysqli_error($condb)); $countsem2 = mysqli_num_rows($sql_course2) ;
//college of edu
//$sql_course = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='First' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title ")or die (mysqli_error($condb));
//$sql_course2 = mysqli_query($condb,"select SUBSTRING(C_code, 1,3) AS ccode, C_code,C_title,semester,C_level,C_unit,c_cat from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='Second' ORDER BY FIELD(ccode, 'GSE', 'EDU') DESC,C_code, C_title ")or die (mysqli_error($condb));  $countsem2 = mysqli_num_rows($sql_course2) ;

$sql_cunit = mysqli_query($condb,"select SUM(C_unit) as unt from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='First' GROUP BY semester")or die (mysqli_error($condb)); $sumsec = mysqli_fetch_array($sql_cunit);
$sql_cunit2 = mysqli_query($condb,"select SUM(C_unit) as unt from courses where dept_c ='".safee($condb,$rs['dept_id'])."'  AND C_level='".$get_proc['level']."' and semester ='Second' GROUP BY semester")or die (mysqli_error($condb)); $sumsec2 = mysqli_fetch_array($sql_cunit2);
$ncout = mysqli_num_rows($sql_cunit) ; $ncout2 = mysqli_num_rows($sql_cunit2) ;
                                                            if(mysqli_num_rows($sql_course) > 0){
                                                                $number = 1; $number2 = 1; ?>
                            <tr ><td colspan="7" style="text-align:justify; font-size: 15px;font-weight:bold"> First Semester</td></tr>
                                                              <?php  while($courses=mysqli_fetch_array($sql_course)){ ?>
                                                                    <tr class="<?php if($number%2); ?>">
                                                                        <td scope="row"><?php echo $number; ?></td>
                                                                        <td><?php echo $courses['C_code']?></td>
                                                                        <td><?php echo $courses['C_title']?></td>
                                                                        <td><?php echo strtoupper($courses['semester'])?></td>
                                                                        <td><?php echo $courses['C_unit']?></td>
                                                    <td><?php if($courses['c_cat']){echo "Compulsory";}else echo "Elective";?></td> </tr>
                                                                    <?php $number++;  } if($ncout > 0){ $sumcunit1 = $sumsec['unt'];}else{ $sumcunit1 = 0 ;} if($countsem2 > 0){ ?>
                        <tr ><td colspan="7" style="text-align:justify; font-size: 15px;font-weight:bold"> Second Semester</td></tr>  
                                                                <?php  while($courses=mysqli_fetch_array($sql_course2)){ ?>
                                                                    <tr class="<?php if($number2%2); ?>">
                                                                        <td scope="row"><?php echo $number2; ?></td>
                                                                        <td><?php echo $courses['C_code']?></td>
                                                                        <td><?php echo $courses['C_title']?></td>
                                                                        <td><?php echo strtoupper($courses['semester'])?></td>
                                                                        <td><?php echo $courses['C_unit']?></td>
                                                                <td><?php if($courses['c_cat']){echo "Compulsory";}else echo "Elective";?></td></tr>
                                                                    <?php $number2++;   } 
																	} if($ncout2 > 0){ $sumcunit2 = $sumsec2['unt'];}else{ $sumcunit2 = 0 ;} } ?>
                                                            </tbody>
    <tfoot><tr class="text-offset"> <td colspan="4"><strong>Total Credit Unit:</strong></td>
   <td align='center'><strong><?php echo $tunit = $sumcunit1 + $sumcunit2 ; //if($tunit > 0){ echo $tunit;}else{echo "0";} ?></strong></td>
    </tr>
   </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }
                                            //end while loop of course generation ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } //close the while loop that displays departments

                            } ?>
                            <div class="info first-paragraph" style="margin-top:50px;"><?php //echo $pagination->createLinks(); ?> </div>
                    </div>
                </div>
            </div>
                <div class="col-xs-12 col-md-3 margin-lg-bottom sidebar-right">
                    <?php include("sidenews.php"); ?>
                </div>
        </div>
    </main>
</section>
