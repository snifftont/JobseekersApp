<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker									= $clogin_jobseeker;
	$sql_query  								= "SELECT * FROM jobseeker WHERE jobseeker_id = '$jobseeker'";
	$result										= mysql_query($sql_query) or die(mysql_error());
	$row 										= mysql_fetch_array($result);

	$jobseeker_id								= $row[jobseeker_id];
	$jobseeker_resume_title						= $row[jobseeker_resume_title];
	$jobseeker_resume_fresh						= $row[jobseeker_resume_fresh];
	$jobseeker_resume_academic					= $row[jobseeker_resume_academic];
	$jobseeker_resume_workingyear				= $row[jobseeker_resume_workingyear];
	$jobseeker_resume_expectedsalary			= $row[jobseeker_resume_expectedsalary];
	$jobseeker_resume_availability				= $row[jobseeker_resume_availability];

	$jobseeker_resume_availabilitydate			= $row[jobseeker_resume_availabilitydate];
	$jobseeker_resume_availabilitydate_tmp		= explode("-", $jobseeker_resume_availabilitydate);
	$jobseeker_resume_availabilitydate_year		= $jobseeker_resume_availabilitydate_tmp[0] * 1;
	$jobseeker_resume_availabilitydate_month	= $jobseeker_resume_availabilitydate_tmp[1] * 1;
	$jobseeker_resume_availabilitydate_date		= $jobseeker_resume_availabilitydate_tmp[2] * 1;

	$jobseeker_resume_choice					= $row[jobseeker_resume_choice];
	$jobseeker_resume_file						= $row[jobseeker_resume_file];
	
	if ($jobseeker_resume_file && file_exists("$dir_resume/$jobseeker/$jobseeker_resume_file")) { 
		$jobseeker_resume_file_url				= "$url_resume/$jobseeker/$jobseeker_resume_file";
		$jobseeker_resume_file_available		= "Y";
	}



	
	$sql_query		= "SELECT * FROM jobseeker_photo WHERE photo_main = 'yes' AND photo_jobseeker = '$jobseeker'";
	$result			= mysql_query($sql_query) or die(mysql_error());
	$row 			= mysql_fetch_array($result);
	$photo_found	= mysql_num_rows($result);
	$photo_id		= $row[photo_id];


	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_academic ORDER BY academic_order ASC, academic_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$academic_id					= $row[academic_id];
		$academic_name					= $row[academic_name];
		
		$arr_resume_academic_id[$i]		= $academic_id;
		$arr_resume_academic_name[$i]	= $academic_name;
		$arr_resume_academic_status[$i]	= "no";
		
		if ($i == 0  &&  !$jobseeker_resume_academic	) { $jobseeker_resume_academic		= $academic_id; 	}
		if ($academic_id == $jobseeker_resume_academic	) { $arr_resume_academic_status[$i]	= "yes";			}
		$i++;

	} 
	


	
	if ($jobseeker_resume_fresh != "Y" && $jobseeker_resume_fresh != "N") { 
		$jobseeker_resume_fresh = "N"; 
	}



	
	if ($jobseeker_resume_availability != "immediate" && $jobseeker_resume_availability != "afterdate") { 
		$jobseeker_resume_availability = "immediate"; 
	}

	if (

			!$jobseeker_resume_availabilitydate_year 	|| 
			!$jobseeker_resume_availabilitydate_month	|| 
			!$jobseeker_resume_availabilitydate_date	||
			$jobseeker_resume_availabilitydate_year < $date_year

	) 
	{ 
	
	
		$today		= getdate(time() + 7 * 24 * 60 * 60);
		$tmp_date	= $today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds'];

		$jobseeker_resume_availabilitydate_date		= $today['mday'];
		$jobseeker_resume_availabilitydate_month	= $today['mon'];
		$jobseeker_resume_availabilitydate_year		= $today['year'];
		
	}	
	
	
	
	
	for ($i=1; $i<=31; $i++) { 
		
		$arr_resume_availabilitydate_date_id[$i - 1]		= $i;
		$arr_resume_availabilitydate_date_status[$i - 1]	= "no";
		if ($i == $jobseeker_resume_availabilitydate_date) { $arr_resume_availabilitydate_date_status[$i - 1]	= "yes";	}
		
	}



	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_monthname ORDER BY monthname_order ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$monthname_id					= $row[monthname_id];
		$monthname_name					= $row[monthname_name];

		$arr_resume_availabilitydate_month_id[$i]		= $monthname_id;
		$arr_resume_availabilitydate_month_name[$i]		= $monthname_name;
		$arr_resume_availabilitydate_month_status[$i]	= "no";
		
		if ($monthname_id == $jobseeker_resume_availabilitydate_month) { $arr_resume_availabilitydate_month_status[$i]	= "yes";	}
		$i++;

	} 



	
	$i	= 0;
	for ($year = $date_year; $year <= $date_year + 3; $year++) {

		$arr_resume_availabilitydate_year_id[$i]		= $year;
		$arr_resume_availabilitydate_year_status[$i]	= "no";

		if ($year == $jobseeker_resume_availabilitydate_year) { $arr_resume_availabilitydate_year_status[$i] = "yes";	}
		$i++;

	}
	
	

	
	
	
	
    if ($cjobseeker_resume_fresh_warn					)	{ $warning_jobseeker_resume_fresh			= "warning"; } else { $warning_jobseeker_resume_fresh			= "normal_12_black"; }
    if ($cjobseeker_resume_title_warn					)	{ $warning_jobseeker_resume_title			= "warning"; } else { $warning_jobseeker_resume_title			= "normal_12_black"; }
    if ($cjobseeker_resume_academic_warn				)	{ $warning_jobseeker_resume_academic		= "warning"; } else { $warning_jobseeker_resume_academic		= "normal_12_black"; }
    if ($cjobseeker_resume_workingyear_warn				)	{ $warning_jobseeker_resume_workingyear		= "warning"; } else { $warning_jobseeker_resume_workingyear		= "normal_12_black"; }
    if ($cjobseeker_resume_expectedsalary_warn			)	{ $warning_jobseeker_resume_expectedsalary	= "warning"; } else { $warning_jobseeker_resume_expectedsalary	= "normal_12_black"; }
	
	if (
	
		$cjobseeker_resume_availabilitydate_date_warn	|| 
		$cjobseeker_resume_availabilitydate_month_warn 	|| 
		$cjobseeker_resume_availabilitydate_year_warn
	
	) { $cjobseeker_resume_availabilitydate_warn = 1; }
	
    if ($cjobseeker_resume_availabilitydate_warn		)	{ $warning_jobseeker_resume_availability	= "warning"; } else { $warning_jobseeker_resume_availability	= "normal_12_black"; }
    if ($cjobseeker_resume_document_warn				)	{ $warning_jobseeker_resume_document		= "warning"; } else { $warning_jobseeker_resume_document		= "normal_12_black"; }
    if ($cjobseeker_resume_photo_warn					)	{ $warning_jobseeker_resume_photo			= "warning"; } else { $warning_jobseeker_resume_photo			= "normal_12_black"; }
    if ($cverification_code_warn						)	{ $warning_verification_code				= "warning"; } else { $warning_verification_code				= "normal_12_black"; }




	
	$smarty->assign("warning_jobseeker_resume_fresh"			, $warning_jobseeker_resume_fresh				);
	$smarty->assign("warning_jobseeker_resume_title"			, $warning_jobseeker_resume_title				);
	$smarty->assign("warning_jobseeker_resume_academic"			, $warning_jobseeker_resume_academic			);
	$smarty->assign("warning_jobseeker_resume_workingyear"		, $warning_jobseeker_resume_workingyear			);
	$smarty->assign("warning_jobseeker_resume_expectedsalary"	, $warning_jobseeker_resume_expectedsalary		);
	$smarty->assign("warning_jobseeker_resume_availability"		, $warning_jobseeker_resume_availability		);
	$smarty->assign("warning_jobseeker_resume_document"			, $warning_jobseeker_resume_document			);
	$smarty->assign("warning_jobseeker_resume_photo"			, $warning_jobseeker_resume_photo				);

	
	$smarty->assign("resume_academic_id"						, $arr_resume_academic_id						);
	$smarty->assign("resume_academic_name"						, $arr_resume_academic_name						);
	$smarty->assign("resume_academic_status"					, $arr_resume_academic_status					);
	$smarty->assign("resume_availabilitydate_date_id"			, $arr_resume_availabilitydate_date_id			);
	$smarty->assign("resume_availabilitydate_date_status"		, $arr_resume_availabilitydate_date_status		);
	$smarty->assign("resume_availabilitydate_month_id"			, $arr_resume_availabilitydate_month_id			);
	$smarty->assign("resume_availabilitydate_month_name"		, $arr_resume_availabilitydate_month_name		);
	$smarty->assign("resume_availabilitydate_month_status"		, $arr_resume_availabilitydate_month_status		);
	$smarty->assign("resume_availabilitydate_year_id"			, $arr_resume_availabilitydate_year_id			);
	$smarty->assign("resume_availabilitydate_year_status"		, $arr_resume_availabilitydate_year_status		);

	
	$smarty->assign("jobseeker_username"						, $jobseeker_username							);
	$smarty->assign("jobseeker_resume_title"					, $jobseeker_resume_title						);
	$smarty->assign("jobseeker_resume_fresh"					, $jobseeker_resume_fresh						);
	$smarty->assign("jobseeker_resume_academic"					, $jobseeker_resume_academic					);
	$smarty->assign("jobseeker_resume_workingyear"				, $jobseeker_resume_workingyear					);
	$smarty->assign("jobseeker_resume_expectedsalary"			, $jobseeker_resume_expectedsalary				);
	$smarty->assign("jobseeker_resume_availability"				, $jobseeker_resume_availability				);
	$smarty->assign("jobseeker_resume_file"						, $jobseeker_resume_file						);
	$smarty->assign("jobseeker_resume_file_url"					, $jobseeker_resume_file_url					);
	$smarty->assign("jobseeker_resume_file_available"			, $jobseeker_resume_file_available				);
	$smarty->assign("jobseeker_photo_found"						, $photo_found									);
	$smarty->assign("jobseeker_photo_id"						, $photo_id										);
	$smarty->assign("status_img_captcha"						, $status_img_captcha							);

	$smarty->display('jobseeker_resume_step2.html');	



?>