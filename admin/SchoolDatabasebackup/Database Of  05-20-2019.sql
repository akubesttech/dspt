DROP TABLE IF EXISTS activity_log;

CREATE TABLE `activity_log` (
  `activity_log_id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `action` varchar(300) NOT NULL,
  PRIMARY KEY  (`activity_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=989 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS attendance;

CREATE TABLE `attendance` (
  `AttID` int(20) NOT NULL auto_increment,
  `EmpID` varchar(30) NOT NULL,
  `Prensent` int(1) NOT NULL,
  `AttDate` date NOT NULL,
  `staff_id2` int(20) NOT NULL,
  `term` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `session` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  PRIMARY KEY  (`AttID`),
  KEY `EmpID` (`EmpID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;



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
  `image` varchar(200) NOT NULL,
  `s_status` int(10) NOT NULL,
  `r_status` varchar(4) default '0',
  PRIMARY KEY  (`pmID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS b_pms_tb;

CREATE TABLE `b_pms_tb` (
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



DROP TABLE IF EXISTS bank;

CREATE TABLE `bank` (
  `b_id` int(10) NOT NULL auto_increment,
  `b_name` varchar(100) NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  `acc_num` varchar(50) NOT NULL,
  `b_sort` varchar(10) NOT NULL,
  PRIMARY KEY  (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



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
  `prog` int(10) NOT NULL,
  PRIMARY KEY  (`a_lotid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS courses;

CREATE TABLE `courses` (
  `C_id` int(11) NOT NULL auto_increment,
  `dept_c` int(10) NOT NULL,
  `C_title` varchar(255) collate latin1_general_ci NOT NULL,
  `C_code` varchar(50) collate latin1_general_ci NOT NULL,
  `C_unit` varchar(15) collate latin1_general_ci NOT NULL,
  `semester` varchar(11) collate latin1_general_ci NOT NULL,
  `C_level` varchar(50) collate latin1_general_ci NOT NULL,
  `c_cat` int(10) NOT NULL default '1' COMMENT 'course category (elective (0) or compulsory(1)',
  `fac_id` int(10) NOT NULL,
  PRIMARY KEY  (`C_id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



DROP TABLE IF EXISTS dept;

CREATE TABLE `dept` (
  `dept_id` int(20) NOT NULL auto_increment,
  `d_name` varchar(100) NOT NULL,
  `d_group` varchar(100) NOT NULL,
  `d_email` varchar(100) NOT NULL,
  `d_phone` varchar(20) NOT NULL,
  `d_code` varchar(20) NOT NULL,
  `d_faculty` varchar(100) NOT NULL,
  `d_hod` varchar(200) NOT NULL,
  `fac_did` int(10) NOT NULL default '0',
  PRIMARY KEY  (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS fee_db;

CREATE TABLE `fee_db` (
  `fee_id` int(10) NOT NULL auto_increment,
  `feetype` varchar(100) NOT NULL,
  `ft_cat` int(10) NOT NULL,
  `level` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `f_dept` varchar(100) NOT NULL,
  `f_fac` varchar(100) NOT NULL,
  `f_amount` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `Cat_fee` int(5) NOT NULL,
  PRIMARY KEY  (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS form_db;

CREATE TABLE `form_db` (
  `id` int(10) NOT NULL auto_increment,
  `app_type` varchar(50) NOT NULL,
  `prog` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `amount2` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `f_start` date NOT NULL,
  `f_end` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS fshop_tb;

CREATE TABLE `fshop_tb` (
  `form_id` int(10) NOT NULL auto_increment,
  `ftrans_id` varchar(15) NOT NULL,
  `refid` varchar(20) NOT NULL,
  `fsname` varchar(100) NOT NULL,
  `foname` varchar(100) NOT NULL,
  `femail` varchar(150) NOT NULL,
  `fphone` varchar(20) NOT NULL,
  `feen` int(10) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `ftype` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `charge` varchar(10) NOT NULL default '0',
  `dategen` varchar(100) NOT NULL,
  `famount` varchar(10) NOT NULL default '0',
  `fpamount` varchar(10) NOT NULL default '0',
  `fcard_type` varchar(100) NOT NULL,
  `fpay_status` varchar(5) NOT NULL,
  `fdate_paid` date default NULL,
  PRIMARY KEY  (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS ftype_db;

CREATE TABLE `ftype_db` (
  `id` int(20) NOT NULL auto_increment,
  `f_type` varchar(20) NOT NULL,
  `f_category` int(10) NOT NULL,
  `d_desc` varchar(250) NOT NULL,
  `status` int(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS grade_tb;

CREATE TABLE `grade_tb` (
  `id` int(10) NOT NULL auto_increment,
  `prog` int(20) NOT NULL,
  `grade_group` varchar(100) NOT NULL,
  `b_min` int(10) NOT NULL,
  `b_max` int(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `gp` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS hostedb;

CREATE TABLE `hostedb` (
  `h_name` varchar(250) NOT NULL,
  `h_code` varchar(20) NOT NULL,
  `h_cat` varchar(50) NOT NULL,
  `h_status` varchar(50) NOT NULL,
  `h_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS hostelallot_tb;

CREATE TABLE `hostelallot_tb` (
  `allot_id` int(10) NOT NULL auto_increment,
  `trans_id` varchar(15) NOT NULL,
  `studentreg` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dept` int(10) NOT NULL,
  `prog` int(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `level` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `h_code` varchar(150) NOT NULL,
  `roomno` varchar(10) NOT NULL,
  `no_of_bed` int(10) NOT NULL,
  `ftype` int(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `paystatus` int(10) NOT NULL default '0',
  `rdate` varchar(50) NOT NULL,
  `allotdate` varchar(150) NOT NULL,
  `allotexpire` varchar(100) default NULL,
  `validity` int(10) NOT NULL default '0',
  `allotstatus` int(10) NOT NULL default '0',
  `rchange` int(10) NOT NULL default '1',
  `approve_by` int(10) default NULL,
  PRIMARY KEY  (`allot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS lastserial;

CREATE TABLE `lastserial` (
  `id` int(11) NOT NULL auto_increment,
  `last` bigint(18) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



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
  `venue` varchar(250) NOT NULL,
  `prog` int(20) NOT NULL,
  PRIMARY KEY  (`time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS level_db;

CREATE TABLE `level_db` (
  `id` int(10) NOT NULL auto_increment,
  `level_name` varchar(100) NOT NULL,
  `level_desc` varchar(100) NOT NULL,
  `level_order` int(10) NOT NULL,
  `prog` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS lga_tb;

CREATE TABLE `lga_tb` (
  `lga_id` int(10) NOT NULL,
  `state` varchar(100) NOT NULL,
  `lga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS mode_tb;

CREATE TABLE `mode_tb` (
  `id` int(10) NOT NULL auto_increment,
  `entrymode` varchar(100) NOT NULL,
  `mdesc` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS module;

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulegroupicon` varchar(120) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL,
  PRIMARY KEY  (`mod_modulegroupcode`,`mod_modulecode`),
  UNIQUE KEY `mod_modulecode` (`mod_modulecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS olevel_tb2;

CREATE TABLE `olevel_tb2` (
  `rec_id` int(10) NOT NULL auto_increment,
  `oapp_No` varchar(100) NOT NULL,
  `oNo_re` varchar(100) NOT NULL,
  `oExam_t1` varchar(100) NOT NULL,
  `oExam_no1` varchar(50) NOT NULL,
  `oExam_y1` varchar(10) NOT NULL,
  `oSub1` int(10) NOT NULL,
  `oGrade_1` int(10) NOT NULL,
  PRIMARY KEY  (`rec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS p_reset;

CREATE TABLE `p_reset` (
  `id` int(20) NOT NULL auto_increment,
  `userid` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `rest_id` varchar(100) NOT NULL,
  `expiredate` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS payment_tb;

CREATE TABLE `payment_tb` (
  `pay_id` int(10) NOT NULL auto_increment,
  `trans_id` varchar(10) NOT NULL,
  `stud_reg` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `app_no` varchar(20) default NULL,
  `prog` int(10) NOT NULL,
  `department` varchar(100) NOT NULL,
  `pay_mode` varchar(50) NOT NULL,
  `fee_type` varchar(50) NOT NULL,
  `ft_cat` int(10) default NULL,
  `pin` varchar(20) default NULL,
  `bank_name` varchar(50) default NULL,
  `teller_no` varchar(10) default NULL,
  `teller_img` varchar(100) default NULL,
  `paid_amount` varchar(10) default '0',
  `pay_date` varchar(150) NOT NULL,
  `session` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `stud_cat` varchar(10) default NULL,
  `p_status` varchar(20) default NULL,
  `pay_status` varchar(10) default '0',
  PRIMARY KEY  (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS pin;

CREATE TABLE `pin` (
  `trans_id` varchar(15) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `pinnumber` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL default 'NOTUSED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS pin_fee;

CREATE TABLE `pin_fee` (
  `serial` varchar(50) NOT NULL,
  `pinnumber` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL default 'NOTUSED'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS prog_tb;

CREATE TABLE `prog_tb` (
  `pro_id` int(10) NOT NULL auto_increment,
  `Pro_name` varchar(50) NOT NULL,
  `pro_desc` varchar(150) NOT NULL,
  `pro_dura` varchar(50) NOT NULL,
  `certinview` varchar(50) default NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY  (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;



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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `role_rolecode` int(11) NOT NULL auto_increment,
  `role_rolename` varchar(45) NOT NULL,
  `role_desc` varchar(100) NOT NULL,
  PRIMARY KEY  (`role_rolecode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS role_rights;

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(20) NOT NULL,
  `rr_modulecode` varchar(20) NOT NULL,
  `rr_create` int(10) NOT NULL default '0',
  `rr_edit` int(10) NOT NULL default '0',
  `rr_delete` int(10) NOT NULL default '0',
  `rr_view` int(10) NOT NULL default '0',
  PRIMARY KEY  (`rr_rolecode`,`rr_modulecode`),
  KEY `rr_modulecode` (`rr_modulecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS roomdb;

CREATE TABLE `roomdb` (
  `room_id` int(10) NOT NULL auto_increment,
  `h_nameen` varchar(100) NOT NULL,
  `h_coder` varchar(10) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `feetype` int(10) NOT NULL,
  `fee` bigint(100) NOT NULL,
  `no_of_bed` int(20) NOT NULL,
  `description` text NOT NULL,
  `room_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;



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



DROP TABLE IF EXISTS session_tb;

CREATE TABLE `session_tb` (
  `session_id` int(10) NOT NULL auto_increment,
  `session_name` varchar(50) NOT NULL,
  `start_date` varchar(50) default NULL,
  `start_end` varchar(50) default NULL,
  `term` varchar(10) default NULL,
  `action` varchar(10) NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;



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
  `JambNo` varchar(100) default NULL,
  `app_type` varchar(50) NOT NULL,
  `Asession` varchar(20) NOT NULL,
  `stud_id` int(10) NOT NULL auto_increment,
  `images` varchar(100) default NULL,
  `reg_status` int(10) NOT NULL,
  `dateofreg` varchar(100) NOT NULL,
  `verify_Data` varchar(50) NOT NULL default 'FALSE',
  `Moe` varchar(20) NOT NULL,
  `yoe` varchar(10) NOT NULL,
  `yog` varchar(10) NOT NULL,
  `p_level` varchar(10) default '0',
  `prog_dura` varchar(10) NOT NULL,
  `Cert_inview` varchar(50) default NULL,
  `RegNo` varchar(20) NOT NULL,
  `password` varchar(20) default NULL,
  `reg_count` varchar(10) default NULL,
  `lasttime` bigint(10) default '0',
  `tsgone` bigint(20) default '0',
  `oldtime` bigint(20) default '0',
  PRIMARY KEY  (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS subject;

CREATE TABLE `subject` (
  `sub_id` int(10) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS uploadrecord;

CREATE TABLE `uploadrecord` (
  `up_id` int(10) NOT NULL auto_increment,
  `staff_id` varchar(100) NOT NULL,
  `scat` int(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `date_up` varchar(200) NOT NULL,
  PRIMARY KEY  (`up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS user_log;

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL,
  `login_date` varchar(30) NOT NULL,
  `logout_date` varchar(128) NOT NULL,
  `admin_id` int(128) NOT NULL,
  `staff_id` int(128) NOT NULL,
  PRIMARY KEY  (`user_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=999 DEFAULT CHARSET=latin1;



