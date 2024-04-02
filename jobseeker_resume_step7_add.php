<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker	= $clogin_jobseeker;




	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_monthname ORDER BY monthname_order ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$monthname_id						= $row[monthname_id];
		$monthname_name						= $row[monthname_name];
		$arr_workperiod_month_id[$i]		= $monthname_id;
		$arr_workperiod_month_name[$i]		= $monthname_name;
		$arr_workperiod_month_status[$i]	= "no";
		if ($monthname_id == $jobseeker_workperiod_month) { $arr_workperiod_month_status[$i]	= "yes";	}
		$i++;

	} 
	
	
	
	
	
	$i	= 0;
	for ($year = $year_start; $year <= $date_year; $year++) {

		$arr_workperiod_year_id[$i]		= $year;
		$arr_workperiod_year_status[$i]	= "no";
		if ($year == $jobseeker_workperiod_year) { $arr_workperiod_year_status[$i] = "yes";	}
		$i++;

	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_industry ORDER BY industry_order ASC, industry_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$industry_id					= $row[industry_id];
		$industry_name					= $row[industry_name];

		$arr_work_industry_id[$i]		= $industry_id;
		$arr_work_industry_name[$i]		= $industry_name;
		$arr_work_industry_status[$i]	= "no";
		$i++;

	}




	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_jobfunction ORDER BY jobfunction_pathname ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$jobfunction_id								= $row[jobfunction_id];
		$jobfunction_name							= $row[jobfunction_name];
		$jobfunction_level							= FB10052434D1D793F3AF424A01B909A4A($jobfunction_id);
		$jobfunction_space							= "";

		for ($j=1; $j<=$jobfunction_level-1; $j++)  { $jobfunction_space .= "&nbsp;&nbsp;&nbsp;&nbsp;";	}
		if  ($jobfunction_level > 1)				{ $jobfunction_space .= "+"; 					}

		$jobfunction_name							= "$jobfunction_space $jobfunction_name";
		$arr_work_jobfunction_id[$i]				= $jobfunction_id;
		$arr_work_jobfunction_name[$i]				= $jobfunction_name;
		$i++;

	} 	
	
	
	
    if ($cjobseeker_work_start_month_warn	)	{ $warning_jobseeker_work_period_start	= "warning"; } else { $warning_jobseeker_work_period_start	= "normal_12_black"; }
    if ($cjobseeker_work_start_year_warn	)	{ $warning_jobseeker_work_period_start	= "warning"; } else { $warning_jobseeker_work_period_start	= "normal_12_black"; }
    if ($cjobseeker_work_end_month_warn		)	{ $warning_jobseeker_work_period_end	= "warning"; } else { $warning_jobseeker_work_period_end	= "normal_12_black"; }
    if ($cjobseeker_work_end_year_warn		)	{ $warning_jobseeker_work_period_end	= "warning"; } else { $warning_jobseeker_work_period_end	= "normal_12_black"; }
    if ($cjobseeker_work_company_warn		)	{ $warning_jobseeker_work_company		= "warning"; } else { $warning_jobseeker_work_company		= "normal_12_black"; }
    if ($cjobseeker_work_industry_warn		)	{ $warning_jobseeker_work_industry		= "warning"; } else { $warning_jobseeker_work_industry		= "normal_12_black"; }
    if ($cjobseeker_work_jobfunction_warn	)	{ $warning_jobseeker_work_jobfunction	= "warning"; } else { $warning_jobseeker_work_jobfunction	= "normal_12_black"; }
    if ($cjobseeker_work_position_warn		)	{ $warning_jobseeker_work_position		= "warning"; } else { $warning_jobseeker_work_position		= "normal_12_black"; }
    if ($cjobseeker_work_salary_warn		)	{ $warning_jobseeker_work_salary		= "warning"; } else { $warning_jobseeker_work_salary		= "normal_12_black"; }
    if ($cjobseeker_work_achievement_warn	)	{ $warning_jobseeker_work_achievement	= "warning"; } else { $warning_jobseeker_work_achievement	= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code			= "warning"; } else { $warning_verification_code			= "normal_12_black"; }




	
	$smarty->assign("warning_jobseeker_work_period_start"	, $warning_jobseeker_work_period_start	);
	$smarty->assign("warning_jobseeker_work_period_end"		, $warning_jobseeker_work_period_end	);
	$smarty->assign("warning_jobseeker_work_company"		, $warning_jobseeker_work_company		);
	$smarty->assign("warning_jobseeker_work_industry"		, $warning_jobseeker_work_industry		);
	$smarty->assign("warning_jobseeker_work_jobfunction"	, $warning_jobseeker_work_jobfunction	);
	$smarty->assign("warning_jobseeker_work_position"		, $warning_jobseeker_work_position		);
	$smarty->assign("warning_jobseeker_work_salary"			, $warning_jobseeker_work_salary		);
	$smarty->assign("warning_jobseeker_work_achievement"	, $warning_jobseeker_work_achievement	);

	
	
	$smarty->assign("workperiod_month_id"					, $arr_workperiod_month_id				);
	$smarty->assign("workperiod_month_name"					, $arr_workperiod_month_name			);
	$smarty->assign("workperiod_month_status"				, $arr_workperiod_month_status			);
	$smarty->assign("workperiod_year_id"					, $arr_workperiod_year_id				);
	$smarty->assign("workperiod_year_status"				, $arr_workperiod_year_status			);
	$smarty->assign("work_industry_id"						, $arr_work_industry_id					);
	$smarty->assign("work_industry_name"					, $arr_work_industry_name				);
	$smarty->assign("work_industry_status"					, $arr_work_industry_status				);
	$smarty->assign("work_jobfunction_id"					, $arr_work_jobfunction_id				);
	$smarty->assign("work_jobfunction_name"					, $arr_work_jobfunction_name			);
	$smarty->assign("work_jobfunction_status"				, $arr_work_jobfunction_status			);

	
	$smarty->assign("cjobseeker_work_start_month"			, $cjobseeker_work_start_month			);
	$smarty->assign("cjobseeker_work_start_year"			, $cjobseeker_work_start_year			);
	$smarty->assign("cjobseeker_work_end_month"				, $cjobseeker_work_end_month			);
	$smarty->assign("cjobseeker_work_end_year"				, $cjobseeker_work_end_year				);
	$smarty->assign("cjobseeker_work_end_present"			, $cjobseeker_work_end_present			);
	$smarty->assign("cjobseeker_work_company"				, $cjobseeker_work_company				);
	$smarty->assign("cjobseeker_work_industry"				, $cjobseeker_work_industry				);
	$smarty->assign("cjobseeker_work_jobfunction"			, $cjobseeker_work_jobfunction			);
	$smarty->assign("cjobseeker_work_position"				, $cjobseeker_work_position				);
	$smarty->assign("cjobseeker_work_salary"				, $cjobseeker_work_salary				);
	$smarty->assign("cjobseeker_work_achievement"			, $cjobseeker_work_achievement			);
	$smarty->assign("status_img_captcha"					, $status_img_captcha					);

	$smarty->display('jobseeker_resume_step7_add.html');	



?>