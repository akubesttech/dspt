DROP TABLE IF EXISTS activity_log;

CREATE TABLE `activity_log` (
  `activity_log_id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `action` varchar(300) NOT NULL,
  PRIMARY KEY  (`activity_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=636 DEFAULT CHARSET=latin1;

INSERT INTO activity_log VALUES("619","administrator","2017-07-26 17:49:22","User Account of Okafor65 was Updated");
INSERT INTO activity_log VALUES("620","administrator","2017-07-26 19:06:18","Course Allocation to Okafor Samuel  Nwike  To Computer Science Department  to lecturer Csc401");
INSERT INTO activity_log VALUES("626","administrator","2017-08-09 07:26:09","Student with Reg No A6278647132 Payment for School fee was Deleted , Amount paid : 52000, Date paid: 22/08/2017, Session : 2015/2016 and  Payment Mode is Paycard .");
INSERT INTO activity_log VALUES("634","administrator","2017-08-15 11:58:07","Session Titled 2014/2015 was Add");
INSERT INTO activity_log VALUES("635","administrator","2017-08-15 12:15:16","Session Titled 2015/2016 was Add");


DROP TABLE IF EXISTS admin;

CREATE TABLE `admin` (
  `admin_id` int(128) NOT NULL auto_increment,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `adminthumbnails` varchar(300) NOT NULL,
  `validate` int(11) NOT NULL,
  `access_level` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `lasttime` bigint(10) NOT NULL default '0',
  `tsgone` bigint(20) NOT NULL default '0',
  `oldtime` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("6","Admin","Akuchukwu","administrator","198518","uploads/95438869.gif","1","1","akubesttech@gmail.com","07083853189","1502828600","1502828600","1502828395");
INSERT INTO admin VALUES("9","Chika","sandra","chika94","198518","uploads/56637946.gif","1","2","samuel223@yahoo.com","07088345671","1502340717","1502340577","1502340319");


DROP TABLE IF EXISTS attendance;

CREATE TABLE `attendance` (
  `AttID` int(20) NOT NULL auto_increment,
  `EmpID` int(10) NOT NULL,
  `Prensent` int(1) NOT NULL,
  `AttDate` date NOT NULL,
  `staff_id2` int(20) NOT NULL,
  `term` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY  (`AttID`),
  KEY `EmpID` (`EmpID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS b_pms;

CREATE TABLE `b_pms` (
  `pmID` bigint(20) NOT NULL auto_increment,
  `sender` varchar(20) NOT NULL default '0',
  `receiver` varchar(20) NOT NULL default '0',
  `therealtime` bigint(20) NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `message` mediumtext NOT NULL,
  `hasread` int(11) NOT NULL default '0',
  `vartime` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`pmID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO b_pms VALUES("6","3","2","1407836395","hello","buchjehccjebnnbe","1","Tue Aug 12, 2014 02:39:55");
INSERT INTO b_pms VALUES("2","3","2","1341056227","where","where are you","1","Sat Jun 30, 2012 04:37:07");
INSERT INTO b_pms VALUES("3","2","3","1341056307","RE:where","Am ok","1","Sat Jun 30, 2012 04:38:27");
INSERT INTO b_pms VALUES("4","4","6","1341397786","what is happening","whats up for your side","0","Wed Jul 04, 2012 03:29:46");
INSERT INTO b_pms VALUES("14","akubest","onyinye1","1409794355","pls am finding it difficult to view my profile","Some examples of such services are clearing of bushes, digging of pit toilet, well etc for the benefit of the community as a whole. Failure to render such services usually resulted in seizing of property which will be claimed only on payment of money. For example, the best house at Isenyin, which is inherited by Oyo State Government was said to have been built between 1916 and 1932 after the Isenyin riot of 1916, under the supervision of Captain W. Rose, the resident district officer and Mr. Yerokun, the case taker. ","0","Wed Sep 03, 2014 18:32:35");
INSERT INTO b_pms VALUES("18","akubest","Customer1","1453045994","RE:Stock Not Supplied","we are working on it ","0","Sun Jan 17, 2016 07:53:14");
INSERT INTO b_pms VALUES("21","23","6","1494982080","grfgrgrg","rfgrgrgrggrg","0","Tue May 16, 2017 17:48:00");


DROP TABLE IF EXISTS bank;

CREATE TABLE `bank` (
  `b_id` int(10) NOT NULL auto_increment,
  `b_name` varchar(100) NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  `acc_num` varchar(50) NOT NULL,
  `b_sort` varchar(10) NOT NULL,
  PRIMARY KEY  (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO bank VALUES("2","Diamond","School Fees","2008567891","2345");


DROP TABLE IF EXISTS course_allottb;

CREATE TABLE `course_allottb` (
  `a_lotid` int(10) NOT NULL auto_increment,
  `assigned` varchar(250) NOT NULL,
  `dept` varchar(200) NOT NULL,
  `course` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `a_lotstatus` int(10) default '0',
  `a_lotdate` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY  (`a_lotid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO course_allottb VALUES("5","11","Computer Science","Csc401","2015/2016","Second","1","Wednesday 26th July 201707:06:17 pm","100");


DROP TABLE IF EXISTS coursereg_tb;

CREATE TABLE `coursereg_tb` (
  `creg_id` int(10) NOT NULL auto_increment,
  `sregno` varchar(20) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `c_code` varchar(10) NOT NULL,
  `c_unit` int(10) default '0',
  `level` int(10) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `session` varchar(20) NOT NULL,
  `lect_approve` int(10) NOT NULL,
  `creg_status` int(10) default '0',
  `assesment` varchar(10) default '0',
  `exam` varchar(10) default '0',
  PRIMARY KEY  (`creg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO coursereg_tb VALUES("2","20173060002","1","Csc401","2","100","First","2015/2016","0","0","0","0");
INSERT INTO coursereg_tb VALUES("4","2008513715","2","Mat101","2","100","First","2015/2016","0","1","0","0");
INSERT INTO coursereg_tb VALUES("5","20173060003","1","Csc401","2","100","Second","2015/2016","1","1","0","0");
INSERT INTO coursereg_tb VALUES("6","20173060003","2","Mat101","2","100","First","2015/2016","1","1","0","0");


DROP TABLE IF EXISTS courses;

CREATE TABLE `courses` (
  `C_id` int(11) NOT NULL auto_increment,
  `dept_c` varchar(100) collate latin1_general_ci NOT NULL,
  `C_title` varchar(255) collate latin1_general_ci NOT NULL,
  `C_code` varchar(50) collate latin1_general_ci NOT NULL,
  `C_unit` varchar(15) collate latin1_general_ci NOT NULL,
  `semester` varchar(11) collate latin1_general_ci NOT NULL,
  `C_level` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`C_id`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO courses VALUES("1","Computer Science","Modeline and Simulation","Csc401","2","First","100");
INSERT INTO courses VALUES("2","Computer Science","Real analysis","Mat101","2","First","100");
INSERT INTO courses VALUES("3","","Intruduction To Botany","Bio101","3","First","100");


DROP TABLE IF EXISTS dept;

CREATE TABLE `dept` (
  `dept_id` int(20) NOT NULL auto_increment,
  `d_name` varchar(100) NOT NULL,
  `d_email` varchar(100) NOT NULL,
  `d_phone` varchar(20) NOT NULL,
  `d_code` varchar(20) NOT NULL,
  `d_faculty` varchar(100) NOT NULL,
  `d_hod` varchar(200) NOT NULL,
  `fac_did` int(10) NOT NULL default '0',
  PRIMARY KEY  (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO dept VALUES("2","Computer Science","csc@yahoo.com","07083853189","524","Physical Science","First","2");
INSERT INTO dept VALUES("3","Microbiology","micro@yahoo.com","0708889012","306","Physical Science","Second","2");
INSERT INTO dept VALUES("4","Industrial Physis","indo@yahoo.com","08034567789","925","","Second","2");


DROP TABLE IF EXISTS examdata;

CREATE TABLE `examdata` (
  `assesment` varchar(10) default '0',
  `exam` varchar(10) default '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS faculty;

CREATE TABLE `faculty` (
  `fac_id` int(10) NOT NULL auto_increment,
  `fac_name` varchar(100) NOT NULL,
  `fac_desc` varchar(150) NOT NULL,
  `fac_email` varchar(50) NOT NULL,
  `fac_phone` varchar(20) NOT NULL,
  `fac_dean` varchar(150) NOT NULL,
  PRIMARY KEY  (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO faculty VALUES("2","Physical Science","Study of Nature","best@gmail.com","07083856771","First");
INSERT INTO faculty VALUES("4","EVIROMENTAL SCIENCE","BUILDING TECHNOLOGY STUDIES","socialscience@gmail.com","08062475090","Second");


DROP TABLE IF EXISTS fee_db;

CREATE TABLE `fee_db` (
  `fee_id` int(10) NOT NULL auto_increment,
  `feetype` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `f_dept` varchar(100) NOT NULL,
  `f_fac` varchar(100) NOT NULL,
  `f_amount` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY  (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO fee_db VALUES("6","Hostel fee","Cep","Microbiology","Physical Science","45200","1");
INSERT INTO fee_db VALUES("7","Departmental fee","Regular","Computer Science","Physical Science","2300","1");
INSERT INTO fee_db VALUES("8","School fee","Regular","Microbiology","Physical Science","45000","1");


DROP TABLE IF EXISTS hostedb;

CREATE TABLE `hostedb` (
  `h_name` varchar(250) NOT NULL,
  `h_code` varchar(20) NOT NULL,
  `h_cat` varchar(50) NOT NULL,
  `h_status` varchar(50) NOT NULL,
  `h_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO hostedb VALUES("Grace Land","100","F","1","dfdgfg");
INSERT INTO hostedb VALUES("Michael","101","M","1","special class hostel");


DROP TABLE IF EXISTS lastserial;

CREATE TABLE `lastserial` (
  `id` int(11) NOT NULL auto_increment,
  `last` bigint(18) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO lastserial VALUES("1","10003");


DROP TABLE IF EXISTS lecttime_tb;

CREATE TABLE `lecttime_tb` (
  `time_id` int(10) NOT NULL auto_increment,
  `t_dept` varchar(100) NOT NULL,
  `t_level` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `session` varchar(20) NOT NULL,
  `day` varchar(10) NOT NULL,
  `time` varchar(100) NOT NULL,
  `course` varchar(10) NOT NULL,
  PRIMARY KEY  (`time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO lecttime_tb VALUES("3","Computer Science","100","First","2015/2016","Monday","8.00 AM - 9.00 AM","Csc401");
INSERT INTO lecttime_tb VALUES("4","Computer Science","100","First","2015/2016","Monday","9.00 AM - 10.00 AM","Mat101");


DROP TABLE IF EXISTS new_apply1;

CREATE TABLE `new_apply1` (
  `appNo` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `SecondName` varchar(150) NOT NULL,
  `Othername` varchar(150) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `hobbies` varchar(250) NOT NULL,
  `state` varchar(200) NOT NULL,
  `lga` varchar(150) NOT NULL,
  `nation` varchar(150) NOT NULL,
  `religion` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `e_address` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `any_fchalenge` varchar(20) NOT NULL,
  `State_chalenge` varchar(20) NOT NULL,
  `first_Choice` varchar(100) NOT NULL,
  `Second_Choice` varchar(100) NOT NULL,
  `fact_1` varchar(10) NOT NULL,
  `fact_2` varchar(10) NOT NULL,
  `Age` varchar(100) NOT NULL,
  `bloodgroup` varchar(100) NOT NULL,
  `gtype` varchar(10) NOT NULL,
  `Pin` varchar(150) NOT NULL,
  `SerialNo` varchar(100) NOT NULL,
  `JambNo` varchar(100) NOT NULL,
  `J_score` varchar(10) NOT NULL,
  `post_uscore` varchar(10) NOT NULL,
  `average_score` varchar(10) NOT NULL default '0',
  `app_type` varchar(50) NOT NULL,
  `Asession` varchar(20) NOT NULL,
  `stud_id` int(10) NOT NULL auto_increment,
  `images` varchar(100) NOT NULL,
  `reg_status` int(10) NOT NULL,
  `dateofreg` varchar(30) NOT NULL,
  `adminstatus` int(10) NOT NULL default '0',
  `application_r` int(10) NOT NULL default '0',
  `verify_apply` varchar(20) NOT NULL default 'FALSE',
  `course_choice` int(3) NOT NULL default '1',
  PRIMARY KEY  (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO new_apply1 VALUES("A0852524921","tochukwu","tochukwu","nwonyia","Male","1990-11-13","Dancing","Edo","Awka south","NIGERIA","Christian"," DFSFDSFD","johnken24@gmail.com","07083853181","A+","No"," DFSFDSFD","Computer Science","Microbiology","","","27","A positive","A+","200","200","JA34567891","240","40","200","01","2015/2016","2","uploads/774687.gif","1","2017-07-06 16:26:29","2","0","TRUE","1");
INSERT INTO new_apply1 VALUES("A8149026680","Nweke","ebuka","Solomon","Male","1990-02-7","Dancing","Anambra","Onitsha South","NIGERIA","Christian","dfdfdffdd","johnken24@gmail.com","08065709090","123","No"," ","Computer Science","Computer Science","","","27","A positive","A+","100","100","JR23456789","255","67","261.5","01","2015/2016","3","uploads/346479.gif","1","2017-07-12 15:10:54","1","0","TRUE","1");
INSERT INTO new_apply1 VALUES("A4617955475","ONYEDIKA","Ikenna","sandra","Male","1989-01-2","Dancing","Abia","DDFDF","NIGERIA","Christian","DVDFDF","johnkenCHUKS24@gmail.com","07083253189","123","No"," ","Microbiology","Computer Science","2","2","28","A negative","Ax","500","500","JR34567891","265","","0","Regular","2015/2016","4","uploads/466586.gif","1","2017-07-18 18:44:02","0","0","FALSE","1");
INSERT INTO new_apply1 VALUES("A5924978481","samuel","ebuka","Adichie","Male","2006-02-17","footbal","Ekiti","sdsds","sdsdsd","Muslim"," zDdsds","johnken24@gmail.com","07083853189","123","No"," ","Microbiology","Microbiology","2","2","11","B positive","A+","600","600","JR23456700","270","56","247","Regular","2015/2016","5","uploads/588578.gif","1","2017-07-20 12:30:53","1","0","TRUE","1");
INSERT INTO new_apply1 VALUES("A6278647132","okeke","STANLY","CHIMA","Male","1990-01-2","Reading","Gombe","DDF","NIGERIA","Christian","  DVDDF","CHIMAJANE@YAHOO.COM","07083853000","A+","No","  DVDDF","Microbiology","Computer Science","2","2","27","A positive","A+","700","700","okeke","250","50","225","Regular","2015/2016","6","uploads/385459.gif","1","2017-07-26 10:48:40","1","0","TRUE","1");


DROP TABLE IF EXISTS news;

CREATE TABLE `news` (
  `news_id` int(10) NOT NULL auto_increment,
  `publish_date` varchar(100) NOT NULL,
  `event_date` varchar(50) NOT NULL,
  `news_type` varchar(25) NOT NULL,
  `news_title` varchar(150) NOT NULL,
  `news_content` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL default 'FALSE',
  PRIMARY KEY  (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO news VALUES("7","13/07/2017","-------","News","our admision form is on sale","dcdxvxvxcxcxc","20983MC WTYE1.png","TRUE");
INSERT INTO news VALUES("9","13/07/2017","-------","News","admission for new student for 2017/2018 session","We wish to inform the general public that our Admission forms For Post Graguate Studies is Now on sale ,all intrested Applicants should purchase our Admission Forms @ the following Banks. We wish to inform the general public that our Admission forms For Post Graguate Studies is Now on sale ,all intrested Applicants should purchase our Admission Forms @ the following Banks.We wish to inform the general public that our Admission forms For Post Graguate Studies is Now on sale ,all intrested Applicants should purchase our Admission Forms @ the following Banks. We wish to inform the general public that our Admission forms For Post Graguate Studies is Now on sale ,all intrested Applicants should purchase our Admission Forms @ the following Banks.  ","4686MC WTYE1.png","TRUE");
INSERT INTO news VALUES("11","19/07/2017","Oct-13","Events","Our School Convercation","Our School Convocation for Graduate From 2015 to 2017 is coming up please come and be part of the celebration.","","TRUE");


DROP TABLE IF EXISTS olevel_tb;

CREATE TABLE `olevel_tb` (
  `olevel_id` int(10) NOT NULL auto_increment,
  `oPin` varchar(20) NOT NULL,
  `oJambNo` varchar(20) NOT NULL,
  `oapp_No` varchar(20) NOT NULL,
  `oNo_re` varchar(10) NOT NULL,
  `oExam_t1` varchar(20) NOT NULL,
  `oExam_t2` varchar(20) NOT NULL,
  `oExam_no1` varchar(20) NOT NULL,
  `oExam_no2` varchar(20) NOT NULL,
  `oExam_y1` varchar(20) NOT NULL,
  `oExam_y2` varchar(20) NOT NULL,
  `oSub1` varchar(100) NOT NULL,
  `oSub2` varchar(100) NOT NULL,
  `oSub3` varchar(100) NOT NULL,
  `oSub4` varchar(100) NOT NULL,
  `oSub5` varchar(100) NOT NULL,
  `oSub6` varchar(100) NOT NULL,
  `oSub7` varchar(100) NOT NULL,
  `oGrade_1` varchar(10) NOT NULL,
  `oGrade_2` varchar(10) NOT NULL,
  `oGrade_3` varchar(10) NOT NULL,
  `oGrade_4` varchar(10) NOT NULL,
  `oGrade_5` varchar(10) NOT NULL,
  `oGrade_6` varchar(10) NOT NULL,
  `oGrade_7` varchar(10) NOT NULL,
  PRIMARY KEY  (`olevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO olevel_tb VALUES("1","200","JA34567891","A0852524921","2","WAEC","NECO","896789001","56789018","2015","2015","English Language","Mathematics","Physics","Chemistry","Accounting","CRS","Computer Science","B3","B2","B2","B2","B2","E8","C5");
INSERT INTO olevel_tb VALUES("2","100","JR23456789","A8149026680","1","WAEC","","45678900","","2012","Year","English Language","Mathematics","Geography","Chemistry","Physics","Accounting","CRS","A1","B2","C6","C4","B2","C4","D7");
INSERT INTO olevel_tb VALUES("3","500","JR34567891","A4617955475","2","WAEC","GCE","833789881","205098011","2014","2016","English Language","Mathematics","Economics","Physics","Biology","Accounting","CRS","B2","B2","C5","A1","B3","C6","C5");
INSERT INTO olevel_tb VALUES("4","600","JR23456700","A5924978481","2","WAEC","NECO","833789881","20509805","2012","1995","Mathematics","Physics","Mathematics","Geography","Geography","Further Mathematics","CRS","B3","B3","B3","B3","C4","B3","D7");
INSERT INTO olevel_tb VALUES("5","700","okeke","A6278647132","1","WAEC","","896789001","","2000","","Geography","Geography","Geography","Geography","Further Mathematics","Computer Science","Biology","B2","C4","C5","C5","E8","D7","C6");


DROP TABLE IF EXISTS payment_tb;

CREATE TABLE `payment_tb` (
  `pay_id` int(10) NOT NULL auto_increment,
  `trans_id` varchar(10) NOT NULL,
  `stud_reg` varchar(20) NOT NULL,
  `app_no` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `pay_mode` varchar(50) NOT NULL,
  `fee_type` varchar(50) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `teller_no` varchar(10) NOT NULL,
  `teller_img` varchar(100) NOT NULL,
  `paid_amount` varchar(10) default '0',
  `pay_date` varchar(150) NOT NULL,
  `session` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `pay_status` varchar(10) default '0',
  PRIMARY KEY  (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO payment_tb VALUES("13","ikvy4qqw","20173060003","","Microbiology","Paycard","School fee","1000","Diamond","089781","payimg/784478.gif","45000","15/08/2017","2015/2016","100","0");


DROP TABLE IF EXISTS pin;

CREATE TABLE `pin` (
  `serial` varchar(50) NOT NULL,
  `pinnumber` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL default 'NOTUSED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO pin VALUES("100","100","USED");
INSERT INTO pin VALUES("200","200","USED");
INSERT INTO pin VALUES("500","500","USED");
INSERT INTO pin VALUES("600","600","USED");
INSERT INTO pin VALUES("700","700","USED");
INSERT INTO pin VALUES("800","800","NOTUSED");


DROP TABLE IF EXISTS pin_fee;

CREATE TABLE `pin_fee` (
  `serial` varchar(50) NOT NULL,
  `pinnumber` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL default 'NOTUSED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO pin_fee VALUES("1000","1000","USED");
INSERT INTO pin_fee VALUES("2000","2000","NOTUSED");


DROP TABLE IF EXISTS prog_tb;

CREATE TABLE `prog_tb` (
  `pro_id` int(10) NOT NULL auto_increment,
  `Pro_name` varchar(50) NOT NULL,
  `pro_desc` varchar(150) NOT NULL,
  `pro_dura` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY  (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO prog_tb VALUES("4","Cep","Continue Education Program","6","1");
INSERT INTO prog_tb VALUES("5","Regular","Undergraguate","4","1");


DROP TABLE IF EXISTS results;

CREATE TABLE `results` (
  `id` int(11) NOT NULL auto_increment,
  `student_id` varchar(20) NOT NULL,
  `course_code` varchar(12) NOT NULL,
  `assessment` int(3) NOT NULL,
  `c_unit` int(10) default '0',
  `exam` int(3) NOT NULL,
  `total` int(3) NOT NULL,
  `grade` char(1) NOT NULL,
  `gpoint` int(10) default '0',
  `qpoint` int(10) default '0',
  `level` int(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `semester` varchar(8) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO results VALUES("1","2008513715","Csc401","20","3","2","23","F","0","0","100","2016/2017","First");
INSERT INTO results VALUES("19","20173060003","Csc401","15","2","51","66","B","4","8","100","2015/2016","Second");


DROP TABLE IF EXISTS roomdb;

CREATE TABLE `roomdb` (
  `room_id` int(10) NOT NULL auto_increment,
  `h_nameen` varchar(100) NOT NULL,
  `h_coder` varchar(10) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `no_of_bed` int(20) NOT NULL,
  `description` text NOT NULL,
  `room_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO roomdb VALUES("9","Michael","101","2000","2","dfdfdfdfdfdf","1");
INSERT INTO roomdb VALUES("10","Grace Land","100","2001","3","dgdgdg","1");
INSERT INTO roomdb VALUES("11","Grace Land ","100","2002","3","fffgfgf","1");


DROP TABLE IF EXISTS schoolsetuptd;

CREATE TABLE `schoolsetuptd` (
  `id` int(11) NOT NULL auto_increment,
  `SchoolName` varchar(200) NOT NULL,
  `initial` varchar(20) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Motto` varchar(200) NOT NULL,
  `SEmail` varchar(100) NOT NULL,
  `OfficePhone` varchar(20) NOT NULL,
  `State` varchar(50) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Pro` varchar(100) NOT NULL,
  `Pcode` varchar(50) NOT NULL,
  `Remark` varchar(250) NOT NULL,
  `WebAddress` varchar(100) NOT NULL,
  `Logo` varchar(100) NOT NULL,
  `DateCreated` varchar(100) NOT NULL,
  `e_date` varchar(50) NOT NULL,
  `e_time` varchar(10) NOT NULL,
  `Createdby` varchar(100) NOT NULL,
  `captcha` varchar(3) NOT NULL,
  `emailver` varchar(3) NOT NULL,
  `Snoti` int(10) NOT NULL,
  `p_utme` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO schoolsetuptd VALUES("10","Collage of Health Technology","DSCHT","Nwafia","Education For Responsibility","Css@yahoo.com","2348062475090","Anambra","Awka","Njikoka","234","my school is the best","www.css.com","uploads/848969751.gif","2017-07-11 11:35:29","17/07/2017","12:45pm","administrator","1","0","0","0");


DROP TABLE IF EXISTS session_tb;

CREATE TABLE `session_tb` (
  `session_id` int(10) NOT NULL auto_increment,
  `session_name` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `start_end` varchar(50) NOT NULL,
  `term` varchar(10) NOT NULL,
  `action` varchar(10) NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO session_tb VALUES("3","2016/2017","","","","0");
INSERT INTO session_tb VALUES("5","2015/2016","2017/08/16","2017/12/02","Second","1");


DROP TABLE IF EXISTS staff_details;

CREATE TABLE `staff_details` (
  `staff_id` int(20) NOT NULL auto_increment,
  `title` varchar(10) NOT NULL,
  `position` varchar(100) NOT NULL,
  `oder_quali` varchar(250) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `mname` varchar(150) NOT NULL,
  `oname` varchar(150) NOT NULL,
  `mstatus` varchar(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `hobbies` varchar(20) NOT NULL,
  `height` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paddress` varchar(150) NOT NULL,
  `caddress` varchar(200) NOT NULL,
  `town` varchar(50) NOT NULL,
  `lga` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `nation` varchar(150) NOT NULL,
  `job_desc` varchar(150) NOT NULL,
  `heq` varchar(50) NOT NULL,
  `cos` varchar(150) NOT NULL,
  `s_fac` varchar(100) NOT NULL,
  `s_dept` varchar(100) NOT NULL,
  `doe` varchar(100) NOT NULL,
  `e_mode` varchar(100) NOT NULL,
  `b_name` varchar(150) NOT NULL,
  `b_acct_name` varchar(150) NOT NULL,
  `b_acct_num` varchar(20) NOT NULL,
  `b_sort` varchar(10) NOT NULL,
  `usern_id` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `r_status` varchar(10) NOT NULL,
  `access_level2` int(10) NOT NULL,
  `u_display` varchar(10) default 'FALSE',
  `lasttime` bigint(20) default '0',
  `tsgone` bigint(20) default '0',
  `oldtime` bigint(20) default '0',
  PRIMARY KEY  (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO staff_details VALUES("6","Prof","Vice Chancellor","Msc","Okeke","sandra","peters","Single","M","07/06/2017","Dancing","4","07083853189","samuel@yahoo.com","234 awka","Amawbia","awka","Awka south","Anambra","NIGERIA","Academic Staff","PHD","Computer Science","2","Computer Science","19/06/2017","FulL Time","Diamond","onyeka okudo","0891234567","2345","okeke103","okeke103","uploads/bec0170ef8efa347a9165bd5a551e0de.jpg","2","3","FALSE","1501210106","1501210084","0");
INSERT INTO staff_details VALUES("11","Dr","Dean of Studies","Msc,PGDE.Economics","Okafor","Samuel","Nwike","Single","M","07/06/2017","music","4","07083853000","onyema@yahoo.com","234 awka","umeze village","Awka","Awka south","Cross River","NIGERIA","Academic Staff","PHD","Geography","2","Microbiology","19/06/2017","FulL Time","Diamond","onyeka okudo","0891234567","2345","Okafor65","198518","uploads/75873443.gif","2","4","FALSE","1501327507","1501327472","1501327223");
INSERT INTO staff_details VALUES("12","","","","Chika","nwonyia","sandra","Married","M","05/07/2017","footbal","5","07088345671","samuel223@yahoo.com","234 awka","124 ziks Avenue Amawbia","Awka","Awka south","Cross River","NIGERIA","Academic Staff","MSC","Geography","2","Microbiology","25/07/2017","FulL Time","Diamond","onyeka okudo nweke","0891234500","3214","chika94","chika94","uploads/56637946.gif","2","0","FALSE","0","0","0");


DROP TABLE IF EXISTS student_tb;

CREATE TABLE `student_tb` (
  `appNo` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `SecondName` varchar(150) NOT NULL,
  `Othername` varchar(150) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `hobbies` varchar(250) NOT NULL,
  `state` varchar(200) NOT NULL,
  `lga` varchar(150) NOT NULL,
  `nation` varchar(150) NOT NULL,
  `religion` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `e_address` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `any_fchalenge` varchar(20) NOT NULL,
  `State_chalenge` varchar(20) NOT NULL,
  `Faculty` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Age` varchar(100) NOT NULL,
  `bloodgroup` varchar(100) NOT NULL,
  `gtype` varchar(10) NOT NULL,
  `JambNo` varchar(100) NOT NULL,
  `app_type` varchar(50) NOT NULL,
  `Asession` varchar(20) NOT NULL,
  `stud_id` int(10) NOT NULL auto_increment,
  `images` varchar(100) NOT NULL,
  `reg_status` int(10) NOT NULL,
  `dateofreg` varchar(30) NOT NULL,
  `verify_Data` varchar(50) NOT NULL default 'FALSE',
  `Moe` varchar(20) NOT NULL,
  `yoe` varchar(10) NOT NULL,
  `yog` varchar(10) NOT NULL,
  `p_level` varchar(10) default '0',
  `prog_dura` varchar(10) NOT NULL,
  `Cert_inview` varchar(50) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `lasttime` bigint(10) default '0',
  `tsgone` bigint(20) default '0',
  `oldtime` bigint(20) default '0',
  PRIMARY KEY  (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO student_tb VALUES("O9529210958","Nweke","Ikenna","Adichie","Male","1990-01-3","Dancing","Anambra","Awka south","NIGERIA","Christian","124 ziks Avenue Amawbia","johnken24@gmail.com","07083853181","P.O Box 224 Awka.","No"," ","2","Computer Science","27","A positive","A+","","Regular","2015/2016","1","uploads/64658337.gif","1","2017-07-16 05:02:58","TRUE","01","2015","2019","100","4","BSC","2008513715","2008513715","1502818625","1502818429","1502817849");
INSERT INTO student_tb VALUES("A8149026680","Nweke","ebuka","Solomon","Male","1990-02-7","Dancing","Anambra","Onitsha South","NIGERIA","Christian","dfdfdffdd","johnken24@gmail.com","08065709090","123","No"," ","2","Microbiology","27","A positive","A+","","01","2015/2016","2","uploads/346479.gif","1","2017-07-17 02:39:49","TRUE","01","2017","2021","100","4","BSC","20175240001","20175240001","1502299142","1502341595","1500582686");
INSERT INTO student_tb VALUES("A5924978481","Samuel","ebuka","Adichie","Male","2006-02-17","footbal","Ekiti","sdsds","Sdsdsd","Muslim"," zDdsds","johnken24@gmail.com","07083853189","123","No"," ","2","Microbiology","11","B positive","A+","","Regular","2015/2016","3","uploads/588578.gif","1","2017-07-20 14:12:22","TRUE","01","2016","2020","200","4","BSC","20173060002","20173060002","1502325957","1502325957","1502325702");
INSERT INTO student_tb VALUES("A6278647132","Okeke","STANLY","CHIMA","Male","1990-08-14","Reading","Gombe","DDF","NIGERIA","Christian","  DVDDF","CHIMAJANE@YAHOO.COM","07083853000","A+","No","  DVDDF","2","Microbiology","27","A positive","A+","","Regular","2015/2016","4","uploads/385459.gif","1","2017-07-26 10:53:32","TRUE","01","2016","2020","100","4","BSC","20173060003","20173060003","1502762989","1502762864","1502762498");


DROP TABLE IF EXISTS uploadrecord;

CREATE TABLE `uploadrecord` (
  `up_id` int(10) NOT NULL auto_increment,
  `staff_id` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `date_up` varchar(200) NOT NULL,
  PRIMARY KEY  (`up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO uploadrecord VALUES("3","11","Csc401","2015/2016","Second","100","2017-07-28 14:28:39");


DROP TABLE IF EXISTS user_log;

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL,
  `login_date` varchar(30) NOT NULL,
  `logout_date` varchar(128) NOT NULL,
  `admin_id` int(128) NOT NULL,
  `staff_id` int(128) NOT NULL,
  PRIMARY KEY  (`user_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO user_log VALUES("1","akubesttech@gmail.com","2017-08-07 05:59:53","2017-08-10","6","0");
INSERT INTO user_log VALUES("2","akubesttech@gmail.com","2017-08-08 07:47:13","2017-08-10","6","0");
INSERT INTO user_log VALUES("3","akubesttech@gmail.com","2017-08-08 22:44:27","2017-08-10","6","0");
INSERT INTO user_log VALUES("4","akubesttech@gmail.com","2017-08-09 06:27:37","2017-08-10","6","0");
INSERT INTO user_log VALUES("5","akubesttech@gmail.com","2017-08-09 06:36:46","2017-08-10","6","0");
INSERT INTO user_log VALUES("6","akubesttech@gmail.com","2017-08-09 06:52:32","2017-08-10","6","0");
INSERT INTO user_log VALUES("7","akubesttech@gmail.com","2017-08-09 07:02:20","2017-08-10","6","0");
INSERT INTO user_log VALUES("8","akubesttech@gmail.com","2017-08-09 07:25:32","2017-08-10","6","0");
INSERT INTO user_log VALUES("9","samuel223@yahoo.com","2017-08-09 21:01:53","2017-08-09","9","0");
INSERT INTO user_log VALUES("10","akubesttech@gmail.com","2017-08-09 21:58:30","2017-08-10","6","0");
INSERT INTO user_log VALUES("11","20175240001","2017-08-09 22:06:33","","0","2");
INSERT INTO user_log VALUES("12","20173060003","2017-08-09 11:07:32","2017-08-14","0","4");
INSERT INTO user_log VALUES("13","20173060002","2017-08-09 11:45:56","2017-08-09","0","3");
INSERT INTO user_log VALUES("14","akubesttech@gmail.com","2017-08-09 11:54:04","2017-08-10","6","0");
INSERT INTO user_log VALUES("15","20173060002","2017-08-09 11:58:50","2017-08-09","0","3");
INSERT INTO user_log VALUES("16","20173060002","2017-08-09 14:07:14","2017-08-09","0","3");
INSERT INTO user_log VALUES("17","20173060003","2017-08-09 15:23:53","2017-08-14","0","4");
INSERT INTO user_log VALUES("18","20173060003","2017-08-09 16:33:01","2017-08-14","0","4");
INSERT INTO user_log VALUES("19","20173060003","2017-08-09 17:31:34","2017-08-14","0","4");
INSERT INTO user_log VALUES("20","20173060002","2017-08-09 17:32:10","2017-08-09","0","3");
INSERT INTO user_log VALUES("21","20173060003","2017-08-09 17:47:22","2017-08-14","0","4");
INSERT INTO user_log VALUES("22","20173060003","2017-08-09 18:26:14","2017-08-14","0","4");
INSERT INTO user_log VALUES("23","akubesttech@gmail.com","2017-08-10 15:39:24","2017-08-10","6","0");
INSERT INTO user_log VALUES("24","20173060003","2017-08-10 15:42:03","2017-08-14","0","4");
INSERT INTO user_log VALUES("25","20173060003","2017-08-14 16:13:48","2017-08-14","0","4");
INSERT INTO user_log VALUES("26","2008513715","2017-08-14 19:11:21","2017-08-15","0","1");
INSERT INTO user_log VALUES("27","akubesttech@gmail.com","2017-08-15 10:37:38","","6","0");
INSERT INTO user_log VALUES("28","akubesttech@gmail.com","2017-08-15 13:19:54","","6","0");


