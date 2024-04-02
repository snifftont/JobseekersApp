<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());




	$sql_query  			= "SELECT * FROM job WHERE job_id = '$job'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	
	$job_id					= $row[job_id];
	$job_title				= $row[job_title];
	$job_position			= $row[job_position];
	$job_employer			= $row[job_employer];
	$job_package			= $row[job_package];
	$job_term				= $row[job_term];
	$job_industry			= $row[job_industry];
	$job_function			= $row[job_function];

	$job_lastdate			= $row[job_lastdate];
	$job_lastdate_tmp		= split(" ", $job_lastdate);
	$job_lastdate_tmp		= $job_lastdate_tmp[0];
	$job_lastdate_tmp		= explode("-", $job_lastdate_tmp);
	$job_lastdate_year		= $job_lastdate_tmp[0] * 1;
	$job_lastdate_month		= $job_lastdate_tmp[1] * 1;
	$job_lastdate_date		= $job_lastdate_tmp[2] * 1;
	
	$job_salary_type		= $row[job_salary_type];
	$job_salary_min			= $row[job_salary_min];
	$job_salary_max			= $row[job_salary_max];
	$job_salary_payment		= $row[job_salary_payment];

	$job_office_city		= $row[job_office_city];
	$job_office_state		= $row[job_office_state];
	$job_office_zip			= $row[job_office_zip];
	$job_office_country		= $row[job_office_country];
	$job_office_location	= $row[job_office_location];
	
	$job_req_religion		= $row[job_req_religion];
	$job_req_race			= $row[job_req_race];
	$job_req_marital		= $row[job_req_marital];
	$job_req_age_min		= $row[job_req_age_min];
	$job_req_age_max		= $row[job_req_age_max];
	$job_req_workexp		= $row[job_req_workexp];
	$job_req_academic		= $row[job_req_academic];
	$job_details			= $row[job_details];
	$job_date_add			= $row[job_date_add];

	$job_date_expire		= $row[job_date_expire];
	$job_date_expire_tmp	= explode(" ", $job_date_expire);
	$job_date_expire		= $job_date_expire_tmp[0];
	$job_status				= $row[job_status];



	if ($job_employer != $clogin_employer || $job_status == 'closed') { 
		header("Location:employer_job.php");
	}
	
	$sql_query  			= "SELECT * FROM employer WHERE employer_id = '$job_employer'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	
	$employer_id			= $row[employer_id];
	$employer_username		= $row[employer_username];
	$employer_password		= $row[employer_password];
	$employer_company		= $row[employer_company];
	$employer_type			= $row[employer_type];

	


	
	$sql_query  		= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
	$result				= mysql_query($sql_query) or die(mysql_error());													
	$row				= mysql_fetch_array($result);

	$sql_query	        = "SELECT * FROM setup_package WHERE package_id = '$package'";
	$result		        = mysql_query($sql_query) or die(mysql_error());
	$row		        = mysql_fetch_array($result);
		
	$package_name		= strtoupper($row[package_name]);
	$package_price		= $row[package_price];
	$package_days		= $row[package_days];
	$package_chars		= $row[package_chars];
	$package_picture    = $row[package_picture];
	$package_video		= $row[package_video];
	$package_doc		= $row[package_doc];
	$package_map		= $row[package_map];
	$package_renewable	= $row[package_renewable];



	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_term ORDER BY term_order ASC, term_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$term_id				= $row[term_id];
		$term_name				= $row[term_name];	
		$arr_term_id[$i]		= $term_id;
		$arr_term_name[$i]		= $term_name;
		$arr_term_status[$i]	= "no";

		if ($term_id == $job_term) { $arr_term_status[$i] = "yes"; }
		$i++;
		
	} 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_industry ORDER BY industry_order ASC, industry_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$industry_id					= $row[industry_id];
		$industry_name					= $row[industry_name];	
		$arr_industry_id[$i]			= $industry_id;
		$arr_industry_name[$i]			= $industry_name;
		$arr_industry_status[$i]		= "no";

		if ($industry_id == $job_industry) { $arr_industry_status[$i] = "yes"; }
		$i++;
		
	}	 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_jobfunction ORDER BY jobfunction_pathname ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$jobfunction_id					= $row[jobfunction_id];
		$jobfunction_name				= $row[jobfunction_name];	
		$jobfunction_level				= FB10052434D1D793F3AF424A01B909A4A($jobfunction_id);
		$jobfunction_space				= "";
		
		
		for ($j=1; $j<=$jobfunction_level-1; $j++	)	{ $jobfunction_space .= "&nbsp;&nbsp;&nbsp;&nbsp;";	}
		if  ($jobfunction_level > 1)					{ $jobfunction_space .= "+"; 						}
		
		
		$jobfunction_name				= "$jobfunction_space $jobfunction_name";
		$arr_jobfunction_id[$i]			= $jobfunction_id;
		$arr_jobfunction_name[$i]		= $jobfunction_name;
		$arr_jobfunction_status[$i]		= "no";


		if ($jobfunction_id == $job_function		)	{ $arr_jobfunction_status[$i] = "yes"; }
		$i++;
		
		
	}	




	
	for ($i=1; $i<=31; $i++) { 
		
		$arr_lastdate_date_id[$i - 1]		= $i;
		$arr_lastdate_date_status[$i - 1]	= "no";
		if ($i == $job_lastdate_date) 		{ $arr_lastdate_date_status[$i - 1]	= "yes";	}
		
	}




	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_monthname ORDER BY monthname_order ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$monthname_id					= $row[monthname_id];
		$monthname_name					= $row[monthname_name];

		$arr_lastdate_month_id[$i]		= $monthname_id;
		$arr_lastdate_month_name[$i]	= $monthname_name;
		$arr_lastdate_month_status[$i]	= "no";
		
		if ($monthname_id == $job_lastdate_month) { $arr_lastdate_month_status[$i]	= "yes";	}
		$i++;

	} 




	
	$i	= 0;
	for ($year = $date_year; $year <= $date_year + 3; $year++) {

		$arr_lastdate_year_id[$i]		= $year;
		$arr_lastdate_year_status[$i]	= "no";
		if ($year == $job_lastdate_year) { $arr_lastdate_year_status[$i] = "yes";	}
		$i++;

	}




	
	if (
			$job_salary_type != "negotiable" && 
			$job_salary_type != "range"
		
		) { $job_salary_type  = "negotiable"; }


	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_salarypayment ORDER BY salarypayment_order ASC, salarypayment_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$salarypayment_id					= $row[salarypayment_id];
		$salarypayment_name					= $row[salarypayment_name];	
		$arr_salarypayment_id[$i]			= $salarypayment_id;
		$arr_salarypayment_name[$i]			= $salarypayment_name;
		$arr_salarypayment_status[$i]		= "no";

		if ($salarypayment_id == $job_salary_payment) { $arr_salarypayment_status[$i] = "yes"; }
		$i++;
		
	}
	
	
	
	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_country ORDER BY country_order ASC, country_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$country_id					= $row[country_id];
		$country_name				= $row[country_name];	
		$arr_country_id[$i]			= $country_id;
		$arr_country_name[$i]		= $country_name;
		$arr_country_status[$i]		= "no";
		
		if ($country_id == $job_office_country) { $arr_country_status[$i] = "yes"; }
		$i++;

	} 
	
	
	
	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_joblocation ORDER BY joblocation_order ASC, joblocation_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$joblocation_id					= $row[joblocation_id];
		$joblocation_name				= $row[joblocation_name];	
		$arr_joblocation_id[$i]			= $joblocation_id;
		$arr_joblocation_name[$i]		= $joblocation_name;
		$arr_joblocation_status[$i]		= "no";
		
		if ($joblocation_id == $job_office_location) { $arr_joblocation_status[$i] = "yes"; }
		$i++;

	} 	
	
	
	

	
	$i							= 0;
	$religion_id				= "0";
	$religion_name				= $lang[lang_value_any];	
	$religion_status			= "no";
	
	$job_req_religion			= "-" . $job_req_religion;
	$religion_pos				= strpos($job_req_religion, "-0-"	); 
	if ($religion_pos > 0) 		{ $religion_status = "yes";			}

	$arr_religion_id[$i]		= $religion_id;
	$arr_religion_name[$i]		= $religion_name;
	$arr_religion_status[$i]	= $religion_status;
	
	$i++;

	
	$sql_query		= "SELECT * FROM setup_religion ORDER BY religion_order ASC, religion_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$religion_id				= $row[religion_id];
		$religion_name				= $row[religion_name];	
		$religion_status			= "no";

		$job_req_religion			= "-" . $job_req_religion;
		$religion_pos				= strpos($job_req_religion, "-$religion_id-"	); 
		if ($religion_pos > 0) 		{ $religion_status = "yes";						}

		$arr_religion_id[$i]		= $religion_id;
		$arr_religion_name[$i]		= $religion_name;
		$arr_religion_status[$i]	= $religion_status;
		
		$i++;

	} 	




	
	$i						= 0;
	$race_id				= "0";
	$race_name				= $lang[lang_value_any];	
	$race_status			= "no";
	
	$job_req_race			= "-" . $job_req_race;
	$race_pos				= strpos($job_req_race, "-0-"	); 
	if ($race_pos > 0) 		{ $race_status = "yes";			}

	$arr_race_id[$i]		= $race_id;
	$arr_race_name[$i]		= $race_name;
	$arr_race_status[$i]	= $race_status;
	
	$i++;

	
	$sql_query		= "SELECT * FROM setup_race ORDER BY race_order ASC, race_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$race_id				= $row[race_id];
		$race_name				= $row[race_name];	
		$race_status			= "no";

		$job_req_race			= "-" . $job_req_race;
		$race_pos				= strpos($job_req_race, "-$race_id-"	); 
		if ($race_pos > 0) 		{ $race_status = "yes";					}

		$arr_race_id[$i]		= $race_id;
		$arr_race_name[$i]		= $race_name;
		$arr_race_status[$i]	= $race_status;
		
		$i++;

	} 




	
	$i								= 0;
	$maritalstatus_id				= "0";
	$maritalstatus_name				= $lang[lang_value_any];	
	$maritalstatus_status			= "no";
	
	$job_req_marital				= "-" . $job_req_marital;
	$maritalstatus_pos				= strpos($job_req_marital, "-0-"	); 
	if ($maritalstatus_pos > 0) 	{ $maritalstatus_status = "yes";	}

	$arr_maritalstatus_id[$i]		= $maritalstatus_id;
	$arr_maritalstatus_name[$i]		= $maritalstatus_name;
	$arr_maritalstatus_status[$i]	= $maritalstatus_status;
	
	$i++;

	
	$sql_query		= "SELECT * FROM setup_maritalstatus ORDER BY maritalstatus_order ASC, maritalstatus_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$maritalstatus_id				= $row[maritalstatus_id];
		$maritalstatus_name				= $row[maritalstatus_name];	
		$maritalstatus_status			= "no";

		$job_req_marital				= "-" . $job_req_marital;
		$maritalstatus_pos				= strpos($job_req_marital, "-$maritalstatus_id-"	); 
		if ($maritalstatus_pos > 0) 	{ $maritalstatus_status = "yes";					}

		$arr_maritalstatus_id[$i]		= $maritalstatus_id;
		$arr_maritalstatus_name[$i]		= $maritalstatus_name;
		$arr_maritalstatus_status[$i]	= $maritalstatus_status;
		
		$i++;

	} 
	
	

	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_academic ORDER BY academic_order ASC, academic_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$academic_id					= $row[academic_id];
		$academic_name					= $row[academic_name];	
		$arr_academic_id[$i]			= $academic_id;
		$arr_academic_name[$i]			= $academic_name;
		$arr_academic_status[$i]		= "no";
		
		if ($academic_id == $job_req_academic) { $arr_academic_status[$i] = "yes"; }
		$i++;

	} 




	
    if ($cjob_lastdate_date_warn ||	$cjob_lastdate_month_warn || $cjob_lastdate_year_warn) 	{ 
		$cjob_lastdate_warn		  = "1";
	}

    if ($cjob_term_warn				) { $warning_job_term				= "warning"; } else { $warning_job_term				= "normal_12_black"; }
    if ($cjob_title_warn			) { $warning_job_title				= "warning"; } else { $warning_job_title			= "normal_12_black"; }
    if ($cjob_position_warn			) { $warning_job_position			= "warning"; } else { $warning_job_position			= "normal_12_black"; }
    if ($cjob_industry_warn			) { $warning_job_industry			= "warning"; } else { $warning_job_industry			= "normal_12_black"; }
    if ($cjob_function_warn			) { $warning_job_function			= "warning"; } else { $warning_job_function			= "normal_12_black"; }
    if ($cjob_lastdate_warn			) { $warning_job_lastdate			= "warning"; } else { $warning_job_lastdate			= "normal_12_black"; }
    if ($cjob_salary_min_warn		) { $warning_job_salary_min			= "warning"; } else { $warning_job_salary_min		= "normal_12_black"; }
    if ($cjob_salary_max_warn		) { $warning_job_salary_max			= "warning"; } else { $warning_job_salary_max		= "normal_12_black"; }
    if ($cjob_office_city_warn		) { $warning_job_office_city		= "warning"; } else { $warning_job_office_city		= "normal_12_black"; }
    if ($cjob_office_state_warn		) { $warning_job_office_state		= "warning"; } else { $warning_job_office_state		= "normal_12_black"; }
    if ($cjob_office_zip_warn		) { $warning_job_office_zip			= "warning"; } else { $warning_job_office_zip		= "normal_12_black"; }
    if ($cjob_office_country_warn	) { $warning_job_office_country		= "warning"; } else { $warning_job_office_country	= "normal_12_black"; }
    if ($cjob_office_location_warn	) { $warning_job_office_location	= "warning"; } else { $warning_job_office_location	= "normal_12_black"; }
    if ($cjob_req_religion_warn		) { $warning_job_req_religion		= "warning"; } else { $warning_job_req_religion		= "normal_12_black"; }
    if ($cjob_req_race_warn			) { $warning_job_req_race			= "warning"; } else { $warning_job_req_race			= "normal_12_black"; }
    if ($cjob_req_marital_warn		) { $warning_job_req_marital		= "warning"; } else { $warning_job_req_marital		= "normal_12_black"; }
    if ($cjob_req_age_min_warn		) { $warning_job_req_age_min		= "warning"; } else { $warning_job_req_age_min		= "normal_12_black"; }
    if ($cjob_req_age_max_warn		) { $warning_job_req_age_max		= "warning"; } else { $warning_job_req_age_max		= "normal_12_black"; }
    if ($cjob_req_workexp_warn		) { $warning_job_req_workexp		= "warning"; } else { $warning_job_req_workexp		= "normal_12_black"; }
    if ($cjob_req_academic_warn		) { $warning_job_req_academic		= "warning"; } else { $warning_job_req_academic		= "normal_12_black"; }
    if ($cjob_details_warn			) { $warning_job_details			= "warning"; } else { $warning_job_details			= "normal_12_black"; }
    if ($cverification_code_warn	) { $warning_verification_code		= "warning"; } else { $warning_verification_code	= "normal_12_black"; }




	
	$smarty->assign("warning_job_term"				, $warning_job_term					);
	$smarty->assign("warning_job_title"				, $warning_job_title				);
	$smarty->assign("warning_job_position"			, $warning_job_position				);
	$smarty->assign("warning_job_industry"			, $warning_job_industry				);
	$smarty->assign("warning_job_function"			, $warning_job_function				);
	$smarty->assign("warning_job_lastdate"			, $warning_job_lastdate				);
	$smarty->assign("warning_job_salary_min"		, $warning_job_salary_min			);
	$smarty->assign("warning_job_salary_max"		, $warning_job_salary_max			);
	$smarty->assign("warning_job_office_city"		, $warning_job_office_city			);
	$smarty->assign("warning_job_office_state"		, $warning_job_office_state			);
	$smarty->assign("warning_job_office_zip"		, $warning_job_office_zip			);
	$smarty->assign("warning_job_office_country"	, $warning_job_office_country		);
	$smarty->assign("warning_job_office_location"	, $warning_job_office_location		);
	$smarty->assign("warning_job_req_religion"		, $warning_job_req_religion			);
	$smarty->assign("warning_job_req_race"			, $warning_job_req_race				);
	$smarty->assign("warning_job_req_marital"		, $warning_job_req_marital			);
	$smarty->assign("warning_job_req_age_min"		, $warning_job_req_age_min			);
	$smarty->assign("warning_job_req_age_max"		, $warning_job_req_age_max			);
	$smarty->assign("warning_job_req_workexp"		, $warning_job_req_workexp			);
	$smarty->assign("warning_job_req_academic"		, $warning_job_req_academic			);
	$smarty->assign("warning_job_details"			, $warning_job_details				);
	$smarty->assign("warning_verification_code"		, $warning_verification_code		);

	
	$smarty->assign("term_id"						, $arr_term_id						);
	$smarty->assign("term_name"						, $arr_term_name					);
	$smarty->assign("term_status"					, $arr_term_status					);
	$smarty->assign("industry_id"					, $arr_industry_id					);
	$smarty->assign("industry_name"					, $arr_industry_name				);
	$smarty->assign("industry_status"				, $arr_industry_status				);
	$smarty->assign("jobfunction_id"				, $arr_jobfunction_id				);
	$smarty->assign("jobfunction_name"				, $arr_jobfunction_name				);
	$smarty->assign("jobfunction_status"			, $arr_jobfunction_status			);
	$smarty->assign("lastdate_date_id"				, $arr_lastdate_date_id				);
	$smarty->assign("lastdate_date_status"			, $arr_lastdate_date_status			);
	$smarty->assign("lastdate_month_id"				, $arr_lastdate_month_id			);
	$smarty->assign("lastdate_month_name"			, $arr_lastdate_month_name			);
	$smarty->assign("lastdate_month_status"			, $arr_lastdate_month_status		);
	$smarty->assign("lastdate_year_id"				, $arr_lastdate_year_id				);
	$smarty->assign("lastdate_year_status"			, $arr_lastdate_year_status			);
	$smarty->assign("salarypayment_id"				, $arr_salarypayment_id				);
	$smarty->assign("salarypayment_name"			, $arr_salarypayment_name			);
	$smarty->assign("salarypayment_status"			, $arr_salarypayment_status			);
	$smarty->assign("country_id"					, $arr_country_id					);
	$smarty->assign("country_name"					, $arr_country_name					);
	$smarty->assign("country_status"				, $arr_country_status				);
	$smarty->assign("joblocation_id"				, $arr_joblocation_id				);
	$smarty->assign("joblocation_name"				, $arr_joblocation_name				);
	$smarty->assign("joblocation_status"			, $arr_joblocation_status			);
	$smarty->assign("religion_id"					, $arr_religion_id					);
	$smarty->assign("religion_name"					, $arr_religion_name				);
	$smarty->assign("religion_status"				, $arr_religion_status				);
	$smarty->assign("race_id"						, $arr_race_id						);
	$smarty->assign("race_name"						, $arr_race_name					);
	$smarty->assign("race_status"					, $arr_race_status					);
	$smarty->assign("maritalstatus_id"				, $arr_maritalstatus_id				);
	$smarty->assign("maritalstatus_name"			, $arr_maritalstatus_name			);
	$smarty->assign("maritalstatus_status"			, $arr_maritalstatus_status			);
	$smarty->assign("academic_id"					, $arr_academic_id					);
	$smarty->assign("academic_name"					, $arr_academic_name				);
	$smarty->assign("academic_status"				, $arr_academic_status				);


	
	$smarty->assign("package_id"					, $package							);
	$smarty->assign("package_name"					, $package_name						);
	$smarty->assign("package_price"					, $package_price					);
	$smarty->assign("package_days"					, $package_days						);

	$smarty->assign("job_id"						, $job_id							);
	$smarty->assign("job_term"						, $job_term							);
	$smarty->assign("job_title"						, $job_title						);
	$smarty->assign("job_position"					, $job_position						);
	$smarty->assign("job_industry"					, $job_industry						);
	$smarty->assign("job_function"					, $job_function						);
	$smarty->assign("job_lastdate_date"				, $job_lastdate_date				);
	$smarty->assign("job_lastdate_month"			, $job_lastdate_month				);
	$smarty->assign("job_lastdate_year"				, $job_lastdate_year				);
	$smarty->assign("job_salary_type"				, $job_salary_type					);
	$smarty->assign("job_salary_min"				, $job_salary_min					);
	$smarty->assign("job_salary_max"				, $job_salary_max					);
	$smarty->assign("job_salary_payment"			, $job_salary_payment				);
	$smarty->assign("job_office_city"				, $job_office_city					);
	$smarty->assign("job_office_state"				, $job_office_state					);
	$smarty->assign("job_office_zip"				, $job_office_zip					);
	$smarty->assign("job_office_country"			, $job_office_country				);
	$smarty->assign("job_office_location"			, $job_office_location				);
	$smarty->assign("job_req_religion"				, $job_req_religion					);
	$smarty->assign("job_req_race"					, $job_req_race						);
	$smarty->assign("job_req_marital"				, $job_req_marital					);
	$smarty->assign("job_req_age_min"				, $job_req_age_min					);
	$smarty->assign("job_req_age_max"				, $job_req_age_max					);
	$smarty->assign("job_req_workexp"				, $job_req_workexp					);
	$smarty->assign("job_req_academic"				, $job_req_academic					);
	$smarty->assign("job_details"					, $job_details						);
	$smarty->assign("status_img_captcha"			, $status_img_captcha				);
	$smarty->display('employer_job_edit.html');	



?>