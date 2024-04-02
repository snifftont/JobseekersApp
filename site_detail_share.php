<?



	

	$section	= "jobseeker";
	include("setting.php");
	

	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);


	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	$job		= $job - $start_job;
	$sql_query	= "
	SELECT * FROM job, employer
	WHERE 
	job_employer			=  employer_id		AND
	employer_status_email	= 'approved'		AND
	employer_status 		= 'approved'		AND
	job_date_expire			> '$date_database'	AND
	job_status				= 'approved'		AND
	job_id					= '$job'
	";
	$result					= mysql_query($sql_query) or die(mysql_error());
	$row					= mysql_fetch_array($result);
		

	$job_id					= $row[job_id];
	$job_number				= $job_id + $start_job;
	$job_title				= $row[job_title];
	$job_title_mod			= F69C27348CCA7B5F625165B15956CB3BD($job_title);
	$job_employer			= $row[job_employer];
	$job_position			= $row[job_position];
	$job_package			= $row[job_package];
	$job_term				= $row[job_term];
	$job_industry			= $row[job_industry];
	$job_function			= $row[job_function];
	
	$job_salary_type		= $row[job_salary_type];
	$job_salary_min			= $row[job_salary_min];
	$job_salary_max			= $row[job_salary_max];
	$job_salary_min			= $currency_symbol . number_format($job_salary_min, 2, $web_decimal_separator, $web_thousand_separator);
	$job_salary_max			= $currency_symbol . number_format($job_salary_max, 2, $web_decimal_separator, $web_thousand_separator);
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

	$job_date_add			= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_add], $date_format);
	$job_date_last			= F2BE712F08F5878F1C8F3DFF139674C86($row[job_lastdate], $date_format);
	$job_status_featured	= $row[job_status_featured];

	

	$job_in_favourite		= 0;
	$job_in_apply			= 0;

	$sql_query				= "SELECT * FROM setup_industry WHERE industry_id = '$job_industry'";
	$tresult				= mysql_query($sql_query) or die(mysql_error());
	$trow					= mysql_fetch_array($tresult);
	$job_industry			= $trow[industry_name];

	$sql_query				= "SELECT * FROM setup_term WHERE term_id = '$job_term'";
	$tresult				= mysql_query($sql_query) or die(mysql_error());
	$trow					= mysql_fetch_array($tresult);
	$job_term				= $trow[term_name];

	$sql_query				= "SELECT * FROM setup_country WHERE country_id = '$job_office_country'";
	$tresult				= mysql_query($sql_query) or die(mysql_error());
	$trow					= mysql_fetch_array($tresult);
	$job_office_country		= $trow[country_name];

	$sql_query				= "SELECT * FROM setup_salarypayment WHERE salarypayment_id = '$job_salary_payment'";
	$tresult				= mysql_query($sql_query) or die(mysql_error());
	$trow					= mysql_fetch_array($tresult);
	$job_salary_payment		= $trow[salarypayment_name];


	$sql_query				= "SELECT * FROM setup_academic WHERE academic_id = '$job_req_academic'";
	$tresult				= mysql_query($sql_query) or die(mysql_error());
	$trow					= mysql_fetch_array($tresult);
	$job_req_academic		= $trow[academic_name];


	$text					= "";
	$found_any				= 0;
	$tmp_religion			= split("-", $job_req_religion);
	for ($i=0; $i<= sizeof($tmp_religion); $i++) {
	
		$cur_religion		= $tmp_religion[$i];
		if ($cur_religion  != "" ) {

			if ($cur_religion	> 0) {
			
				$sql_query		= "SELECT * FROM setup_religion WHERE religion_id = '$cur_religion'";
				$result			= mysql_query($sql_query) or die(mysql_error());
				$row			= mysql_fetch_array($result);
				$religion_name	= $row[religion_name];
				$text			= $text . "$religion_name , ";
			
			}
	
			if ($cur_religion == 0){ $found_any++; }

		}

	}
	
	$text = substr($text, 0, strlen($text) - 3);
	if ($found_any) { $text = $lang[lang_value_any]; }
	$job_req_religion		= $text;





	$text				= "";
	$found_any			= 0;
	$tmp_race			= split("-", $job_req_race);
	for ($i=0; $i<= sizeof($tmp_race); $i++) {
	
		$cur_race		= $tmp_race[$i];
		if ($cur_race  != "" ) {

			if ($cur_race	> 0) {
			
				$sql_query	= "SELECT * FROM setup_race WHERE race_id = '$cur_race'";
				$result		= mysql_query($sql_query) or die(mysql_error());
				$row		= mysql_fetch_array($result);
				$race_name	= $row[race_name];
				$text		= $text . "$race_name , ";
			
			}
	
			if ($cur_race == 0){ $found_any++; }

		}

	}
	
	$text = substr($text, 0, strlen($text) - 3);
	if ($found_any) { $text = $lang[lang_value_any]; }
	$job_req_race = $text;





	$text				= "";
	$found_any			= 0;
	$tmp_maritalstatus	= split("-", $job_req_marital);
	for ($i=0; $i<= sizeof($tmp_maritalstatus); $i++) {
	
		$cur_maritalstatus		= $tmp_maritalstatus[$i];
		if ($cur_maritalstatus  != "" ) {

			if ($cur_maritalstatus	> 0) {
			
				$sql_query	= "SELECT * FROM setup_maritalstatus WHERE maritalstatus_id = '$cur_maritalstatus'";
				$result		= mysql_query($sql_query) or die(mysql_error());
				$row		= mysql_fetch_array($result);
				$maritalstatus_name	= $row[maritalstatus_name];
				$text		= $text . "$maritalstatus_name , ";
			
			}
	
			if ($cur_maritalstatus == 0){ $found_any++; }

		}

	}
	
	$text = substr($text, 0, strlen($text) - 3);
	if ($found_any) { $text = $lang[lang_value_any]; }
	$job_req_marital = $text;




	if ($clogin_jobseeker) {

		$sql_query			= "SELECT * FROM jobseeker_favourite WHERE favourite_jobseeker = '$clogin_jobseeker' AND favourite_job = '$job_id'";
		$tresult			= mysql_query($sql_query) or die(mysql_error());
		$job_in_favourite	= mysql_num_rows($tresult);

		$sql_query			= "SELECT * FROM job_application  WHERE application_jobseeker = '$clogin_jobseeker' AND application_job = '$job_id'";
		$tresult			= mysql_query($sql_query) or die(mysql_error());
		$job_in_apply		= mysql_num_rows($tresult);

	}




	
	$this_url					= $_SERVER['REQUEST_URI'];
	$this_url_encoded			= htmlentities(urlencode($this_url));
	$job_url_detail				= "site_detail.php?job=$job_number";
	$job_url_detail_print		= "site_detail_print.php?job=$job_number";
	$job_url_detail_share		= "site_detail_share.php?job=$job_number";
	$job_url_detail_apply		= "system_job_apply.php?job=$job_id&backurl=$this_url_encoded";
	$job_url_detail_favourite	= "system_job_favourite.php?job=$job_id&backurl=$this_url_encoded";

	if($status_url_rewrite == "yes") {	
		$job_url_detail 		= "detail-$job_number-$job_title_mod.php"; 
		$job_url_detail_print 	= "print-$job_number-$job_title_mod.php"; 
		$job_url_detail_share 	= "share-$job_number-$job_title_mod.php"; 
	}

	if($job_status_featured == "yes"){$job_bgcolor	= "#FFF7D2"; }
		




	
	$sql_query  				= "SELECT * FROM employer WHERE employer_id = '$job_employer'";
	$result						= mysql_query($sql_query) or die(mysql_error());													
	$row						= mysql_fetch_array($result);
	
	$employer_id				= $row[employer_id];
	$employer_logo				= file_exists("$dir_logo/$employer_id.jpg");

	$employer_username			= $row[employer_username];
	$employer_password			= $row[employer_password];
	$employer_company			= $row[employer_company];
	$employer_company_employees	= $row[employer_company_employees];
	$employer_company_industry	= $row[employer_company_industry];
	$employer_company_type		= $row[employer_company_type];
	$employer_company_details	= $row[employer_company_details];
	
	$employer_title				= $row[employer_title];
	$employer_firstname			= $row[employer_firstname];
	$employer_lastname			= $row[employer_lastname];
	$employer_fullname			= "$employer_firstname $employer_lastname";
	$employer_address			= $row[employer_address];
	$employer_address2			= $row[employer_address2];
	$employer_city				= $row[employer_city];
	$employer_state				= $row[employer_state];
	$employer_zip				= $row[employer_zip];
	$employer_country			= $row[employer_country];

	$employer_phone				= $row[employer_phone];
	$employer_fax				= $row[employer_fax];
	$employer_email				= $row[employer_email];
	$employer_website			= $row[employer_website];
	$employer_website2			= $row[employer_website];
	$employer_website2			= str_replace("http://"	, "" , $employer_website2	);
	$employer_website2			= str_replace("www."	, "" , $employer_website2	);
	$employer_website2			= strlen($employer_website2);
	

	$sql_query					= "SELECT * FROM setup_industry WHERE industry_id = '$employer_company_industry'";
	$tresult					= mysql_query($sql_query) or die(mysql_error());
	$trow						= mysql_fetch_array($tresult);
	$employer_company_industry	= $trow[industry_name];

	$sql_query					= "SELECT * FROM setup_companytype WHERE companytype_id = '$employer_company_type'";
	$result_tmp					= mysql_query($sql_query) or die(mysql_error());
	$row_tmp					= mysql_fetch_array($result_tmp);
	$employer_company_type		= $row_tmp[companytype_name];

	$sql_query					= "SELECT * FROM setup_companysize WHERE companysize_id = '$employer_company_employees'";
	$result_tmp					= mysql_query($sql_query) or die(mysql_error());
	$row_tmp					= mysql_fetch_array($result_tmp);
	$employer_company_employees	= $row_tmp[companysize_name];

	$sql_query					= "SELECT * FROM setup_country WHERE country_id = '$employer_country'";
	$result_tmp					= mysql_query($sql_query) or die(mysql_error());
	$row_tmp					= mysql_fetch_array($result_tmp);
	$employer_country			= $row_tmp[country_name];
		
	$sql_query           		= "SELECT * FROM job WHERE job_employer = '$employer_id'";
	$result_tmp		      		= mysql_query($sql_query) or die(mysql_error());
	$employer_total_jobs		= mysql_num_rows($result_tmp);
	



	
	$sql_query 					= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$job_function'";
	$result						= mysql_query($sql_query) or die(mysql_error());
    $row 						= mysql_fetch_array($result);
	$jobfunction_id				= $row[jobfunction_id];
	$jobfunction_name			= $row[jobfunction_name];
	$jobfunction_name_mod		= F69C27348CCA7B5F625165B15956CB3BD($jobfunction_name);
	$jobfunction_parent			= $row[jobfunction_parent];
	$jobfunction_path			= $row[jobfunction_path];	
	$jobfunction_split			= explode("-", $jobfunction_path);
	$jobfunction_path_link		= "";
	
	for ($i=0; $i<sizeof($jobfunction_split); $i++) {
	
		$tjobfunction_id		= $jobfunction_split[$i];
		if ($tjobfunction_id) 	{


			$sql_query				= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$tjobfunction_id'";
			$result					= mysql_query($sql_query) or die(mysql_error());
			$row					= mysql_fetch_array($result);
			$tjobfunction_name		= $row[jobfunction_name];			
			$tjobfunction_name_mod	= F69C27348CCA7B5F625165B15956CB3BD($tjobfunction_name);
	
			$tjobfunction_url		= "site_browse_category_detail.php?cat=$tjobfunction_id";
			if ($status_url_rewrite == "yes"){ 
				$tjobfunction_url	= "browse-$tjobfunction_id-0-1-$tjobfunction_name_mod.php";	
			}
	
			$jobfunction_path_link	= $jobfunction_path_link. " &raquo; <a href='$tjobfunction_url' class='normal_12_red'>" . $tjobfunction_name . "</a>";


		}
		
	}		
	mysql_close($db_connect);




	
    if ($ccontact_from_name_warn	)	{ $warning_contact_from_name	= "warning"; } else { $warning_contact_from_name	= "normal_12_black"; }
    if ($ccontact_from_email_warn	)	{ $warning_contact_from_email	= "warning"; } else { $warning_contact_from_email	= "normal_12_black"; }
    if ($ccontact_friend_name_warn	)	{ $warning_contact_friend_name	= "warning"; } else { $warning_contact_friend_name	= "normal_12_black"; }
    if ($ccontact_friend_email_warn	)	{ $warning_contact_friend_email	= "warning"; } else { $warning_contact_friend_email	= "normal_12_black"; }
    if ($ccontact_code_warn			)	{ $warning_contact_code			= "warning"; } else { $warning_contact_code			= "normal_12_black"; }




	
	$smarty->assign("jobfunction_found"				, $cat_total					);
	$smarty->assign("jobfunction_id"				, $jobfunction_id				);
	$smarty->assign("jobfunction_name"				, $jobfunction_name				);
	$smarty->assign("jobfunction_parent"			, $jobfunction_parent			);
	$smarty->assign("jobfunction_path"				, $jobfunction_path				);
	$smarty->assign("jobfunction_path_link"			, $jobfunction_path_link		);


	$smarty->assign("job_id"						, $job_id						);
	$smarty->assign("job_number"					, $job_number					);
	$smarty->assign("job_bgcolor"					, $job_bgcolor					);
	$smarty->assign("job_title"						, $job_title					);
	$smarty->assign("job_title_mod"					, $job_title_mod				);
	$smarty->assign("job_employer"					, $job_employer					);
	$smarty->assign("job_function"					, $job_function					);
	$smarty->assign("job_term"						, $job_term						);
	$smarty->assign("job_industry"					, $job_industry					);
	$smarty->assign("job_position"					, $job_position					);
	$smarty->assign("job_office_city"				, $job_office_city				);
	$smarty->assign("job_office_state"				, $job_office_state				);
	$smarty->assign("job_office_zip"				, $job_office_zip				);
	$smarty->assign("job_office_country"			, $job_office_country			);
	$smarty->assign("job_salary_type"				, $job_salary_type				);
	$smarty->assign("job_salary_min"				, $job_salary_min				);
	$smarty->assign("job_salary_max"				, $job_salary_max				);
	$smarty->assign("job_salary_payment"			, $job_salary_payment			);
	$smarty->assign("job_status_featured"			, $job_status_featured			);
	$smarty->assign("job_date_add"					, $job_date_add					);
	$smarty->assign("job_date_last"					, $job_date_last				);
	$smarty->assign("job_in_favourite"				, $job_in_favourite				);
	$smarty->assign("job_in_apply"					, $job_in_apply					);
	$smarty->assign("job_req_religion"				, $job_req_religion				);
	$smarty->assign("job_req_race"					, $job_req_race					);
	$smarty->assign("job_req_marital"				, $job_req_marital				);
	$smarty->assign("job_req_age_min"				, $job_req_age_min				);
	$smarty->assign("job_req_age_max"				, $job_req_age_max				);
	$smarty->assign("job_req_workexp"				, $job_req_workexp				);
	$smarty->assign("job_req_academic"				, $job_req_academic				);
	$smarty->assign("job_details"					, $job_details					);

	$smarty->assign("job_url_detail"				, $job_url_detail				);
	$smarty->assign("job_url_detail_print"			, $job_url_detail_print			);
	$smarty->assign("job_url_detail_share"			, $job_url_detail_share			);
	$smarty->assign("job_url_detail_apply"			, $job_url_detail_apply			);
	$smarty->assign("job_url_detail_favourite"		, $job_url_detail_favourite		);

	$smarty->assign("employer_id"					, $employer_id					);
	$smarty->assign("employer_logo"					, $employer_logo				);
	$smarty->assign("employer_username"				, $employer_username			);
	$smarty->assign("employer_company"				, $employer_company				);
	$smarty->assign("employer_company_employees"	, $employer_company_employees	);
	$smarty->assign("employer_company_industry"		, $employer_company_industry	);
	$smarty->assign("employer_company_type"			, $employer_company_type		);
	$smarty->assign("employer_company_details"		, $employer_company_details		);
	$smarty->assign("employer_title"				, $employer_title				);
	$smarty->assign("employer_firstname"			, $employer_firstname			);
	$smarty->assign("employer_lastname"				, $employer_lastname			);
	$smarty->assign("employer_fullname"				, $employer_fullname			);
	$smarty->assign("employer_address"				, $employer_address				);
	$smarty->assign("employer_address2"				, $employer_address2			);
	$smarty->assign("employer_city"					, $employer_city				);
	$smarty->assign("employer_state"				, $employer_state				);
	$smarty->assign("employer_zip"					, $employer_zip					);
	$smarty->assign("employer_country"				, $employer_country				);
	$smarty->assign("employer_phone"				, $employer_phone				);
	$smarty->assign("employer_fax"					, $employer_fax					);
	$smarty->assign("employer_email"				, $employer_email				);
	$smarty->assign("employer_website"				, $employer_website				);
	$smarty->assign("employer_website2"				, $employer_website2			);
	$smarty->assign("employer_total_jobs"			, $employer_total_jobs			);


	$smarty->assign("warning_message"				, $warning						);
	$smarty->assign("warning_contact_from_name"		, $warning_contact_from_name	);
	$smarty->assign("warning_contact_from_email"	, $warning_contact_from_email	);
	$smarty->assign("warning_contact_friend_name"	, $warning_contact_friend_name	);
	$smarty->assign("warning_contact_friend_email"	, $warning_contact_friend_email	);
	$smarty->assign("warning_contact_code"			, $warning_contact_code			);

	$smarty->assign("ccontact_from_name"			, $ccontact_from_name			);
	$smarty->assign("ccontact_from_email"			, $ccontact_from_email			);
	$smarty->assign("ccontact_friend_name"			, $ccontact_friend_name			);
	$smarty->assign("ccontact_friend_email"			, $ccontact_friend_email		);

	$smarty->display('site_detail_share.html');	
	

?>