<?



	include("admin/setting.php");
	include_once("system_function.php");
	include_once("system_function_initialize.php");
	require("libs/Smarty.class.php");	
	
	
	$setup_demo_sorry	= "demo_mode";


	
	if (!$section) { $nav_section = "home"; } else { $nav_section = $section; }


	
	if ($web_right_click_protect == "yes") {
		$web_javascript	= "<script language=\"javascript\" type=\"text/javascript\" src=\"javascript_rightclick.js\"></script>";	
	}




	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	
	

	$i			= 0;
	$sql_query	= "SELECT * FROM setup_jobfunction ORDER BY jobfunction_pathname ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$jobfunction_id		= $row[jobfunction_id];
		$jobfunction_name	= $row[jobfunction_name];
		$jobfunction_level	= FB10052434D1D793F3AF424A01B909A4A($jobfunction_id);
		$jobfunction_status	= "";
	
		$jobfunction_space	= "";
		if ($jobfunction_id == $sfunction)	{ $jobfunction_status	= "yes";						}
		for ($j=1; $j<=$jobfunction_level-1; $j++)  { $jobfunction_space   .= "&nbsp;&nbsp;&nbsp;&nbsp;";	}
		if  ($jobfunction_level > 1)				{ $jobfunction_space   .= "+"; 							}
		
		
		$arr_topsearch_jobfunction_id[$i]			= $jobfunction_id;
		$arr_topsearch_jobfunction_name[$i]			= "$jobfunction_space $jobfunction_name";
		$arr_topsearch_jobfunction_status[$i]		= $jobfunction_status;
		$i++;
		
	
	} 




	
	

	$i			= 0;
	$sql_query	= "SELECT * FROM setup_joblocation ORDER BY joblocation_order ASC, joblocation_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$joblocation_id		= $row[joblocation_id];
		$joblocation_name	= $row[joblocation_name];
		$joblocation_level	= FB10052434D1D793F3AF424A01B909A4A($joblocation_id);
		$joblocation_status	= "";

		if ($joblocation_id == $slocation)	{ $joblocation_status	= "yes";	}
	
		$arr_topsearch_joblocation_id[$i]			= $joblocation_id;
		$arr_topsearch_joblocation_name[$i]			= $joblocation_name;
		$arr_topsearch_joblocation_status[$i]		= $joblocation_status;
		$i++;
		
	
	} 




	
	

	$i			= 0;
	$sql_query	= "
	SELECT * FROM setup_jobfunction 
	WHERE 
	jobfunction_name 		!= ''		AND
	jobfunction_parent 	 	 = '0'		AND
	jobfunction_featured	 = 'yes'
	ORDER BY jobfunction_name ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$jobfunction_id			= $row[jobfunction_id];
		$jobfunction_name		= $row[jobfunction_name];
		$jobfunction_name_mod	= F69C27348CCA7B5F625165B15956CB3BD($jobfunction_name);
		$jobfunction_url		= "site_browse_category_detail.php?cat=$jobfunction_id";

		if ($status_url_rewrite == "yes")	{ $jobfunction_url	= "browse-$jobfunction_id-0-1-$jobfunction_name_mod.php";	}
	
		$arr_popular_jobfunction_id[$i]		= $jobfunction_id;
		$arr_popular_jobfunction_name[$i]	= $jobfunction_name;
		$arr_popular_jobfunction_url[$i]	= $jobfunction_url;
		$i++;
		
	
	} 




	

	$i			= 0;
	$sql_query	= "
	SELECT * FROM job , employer
	WHERE 
	job_employer			=   employer_id			AND
	employer_status_email	=  'approved'			AND
	employer_status			=  'approved'			AND
	job_date_expire			>  '$date_database'		AND
	job_status				=  'approved'			AND
	job_status_featured		=  'yes'
	ORDER BY RAND()
	LIMIT 0, $front_featured_jobs
	";

	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$featured_job_id				= $row[job_id];
		$featured_job_number			= $row[job_id] + $start_job;
		$featured_job_employer			= $row[employer_company];
		$featured_job_date				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_add], $date_format);
		$featured_job_title				= $row[job_title];
		$featured_job_title_mod			= F69C27348CCA7B5F625165B15956CB3BD($featured_job_title);
		$featured_job_url				= "site_detail.php?job=$featured_job_number";


		
		if ($status_url_rewrite == "yes") {	$featured_job_url 		= "detail-$featured_job_number-$featured_job_title_mod.php"; }
		if ($i % 2 == 1					) { $featured_job_bgcolor	= "#F5FCFF"; } else { $featured_job_bgcolor	= "#D7F3FE"; }
	
		$arr_featured_job_id[$i]		= $featured_job_id;
		$arr_featured_job_employer[$i]	= $featured_job_employer;
		$arr_featured_job_title[$i]		= $featured_job_title;
		$arr_featured_job_url[$i]		= $featured_job_url;
		$arr_featured_job_date[$i]		= $featured_job_date;
		$arr_featured_job_bgcolor[$i]	= $featured_job_bgcolor;
		$i++;
		
	
	} 




	
	$sql_query							= "SELECT * FROM jobseeker WHERE jobseeker_id = '$clogin_jobseeker'";
	$result								= mysql_query($sql_query) or die(mysql_error());
	$found								= mysql_num_rows($result);
	$row 								= mysql_fetch_array($result);
	$jobseeker_id						= $row[jobseeker_id];
	$jobseeker_title					= $row[jobseeker_title];
	$clogin_jobseeker_firstname			= $row[jobseeker_firstname];
	$clogin_jobseeker_lastname			= $row[jobseeker_lastname];
	$clogin_jobseeker_status			= $row[jobseeker_status];
	$clogin_jobseeker_status_resume		= $row[jobseeker_status_resume];
	$clogin_jobseeker_status_email		= $row[jobseeker_status_email];
	$clogin_jobseeker_lastlogin			= $row[jobseeker_date_lastlogin];	
	$clogin_jobseeker_lastlogin			= F2BE712F08F5878F1C8F3DFF139674C86($clogin_jobseeker_lastlogin, "DD MM YYYY TT");	
	



	
	$sql_query							= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
	$result								= mysql_query($sql_query) or die(mysql_error());
	$found								= mysql_num_rows($result);
	$row 								= mysql_fetch_array($result);
	$employer_id						= $row[employer_id];
	$employer_title						= $row[employer_title];
	$clogin_employer_firstname			= $row[employer_firstname];
	$clogin_employer_lastname			= $row[employer_lastname];
	$clogin_employer_type				= $row[employer_type];
	$clogin_employer_status				= $row[employer_status];
	$clogin_employer_status_email		= $row[employer_status_email];
	$clogin_employer_lastlogin			= $row[employer_date_lastlogin];	
	$clogin_employer_lastlogin			= F2BE712F08F5878F1C8F3DFF139674C86($clogin_employer_lastlogin, "DD MM YYYY TT");	
	$clogin_employer_date_expired		= $row[employer_date_expired];	
	$clogin_employer_is_expired			= "no";
	
	
	if ($clogin_employer_type == "subscription") {
	
		$sql_query		= "SELECT UNIX_TIMESTAMP('$clogin_employer_date_expired') - UNIX_TIMESTAMP(NOW()) AS expire_time";
		$result			= mysql_query($sql_query) or die(mysql_error());
		$row 			= mysql_fetch_array($result);
		$expire_time	= $row[expire_time];
		if ($expire_time <0 ) { $clogin_employer_is_expired = "yes"; }
	
	}



	
	$sql_query 	= "
	SELECT * FROM job , employer
	WHERE 
	job_employer						=   employer_id		AND
	employer_status_email				=  'approved'		AND
	employer_status						=  'approved'		AND
	job_date_expire						>  '$date_database'	AND
	job_status							=  'approved'		
	";

	$result								= mysql_query($sql_query) or die(mysql_error());
	$topsearch_total_jobs				= mysql_num_rows($result);
	$topsearch_total_jobs				= number_format($topsearch_total_jobs, 0, $web_decimal_separator, $web_thousand_separator);

	mysql_close($db_connect);
	





	

	$smarty = new Smarty;	
	$smarty->compile_check = true;	

	$smarty->assign("status_img_captcha"				, $status_img_captcha						);
	$smarty->assign("javascript_rightclick"				, $web_javascript							);
	$smarty->assign("meta_title"						, $web_title								); 				
	$smarty->assign("meta_encoding"						, $web_encodings							); 			
	$smarty->assign("meta_keyword"						, $web_keywords								); 			
	$smarty->assign("meta_description"					, $web_desc									); 			
	$smarty->assign("nav_section"						, $nav_section								);
	$smarty->assign("search_keyword"					, $search_keyword							);
		

	$smarty->assign("skeyword"							, $skeyword									);
	$smarty->assign("topsearch_jobfunction_id"			, $arr_topsearch_jobfunction_id				);
	$smarty->assign("topsearch_jobfunction_name"		, $arr_topsearch_jobfunction_name			);
	$smarty->assign("topsearch_jobfunction_status"		, $arr_topsearch_jobfunction_status			);

	$smarty->assign("topsearch_joblocation_id"			, $arr_topsearch_joblocation_id				);
	$smarty->assign("topsearch_joblocation_name"		, $arr_topsearch_joblocation_name			);
	$smarty->assign("topsearch_joblocation_status"		, $arr_topsearch_joblocation_status			);
	$smarty->assign("topsearch_total_jobs"				, $topsearch_total_jobs						);

	$smarty->assign("popular_jobfunction_id"			, $arr_popular_jobfunction_id				);
	$smarty->assign("popular_jobfunction_name"			, $arr_popular_jobfunction_name				);
	$smarty->assign("popular_jobfunction_status"		, $arr_popular_jobfunction_status			);
	$smarty->assign("popular_jobfunction_url"			, $arr_popular_jobfunction_url				);

	$smarty->assign("featured_job_id"					, $arr_featured_job_id						);
	$smarty->assign("featured_job_title"				, $arr_featured_job_title					);
	$smarty->assign("featured_job_employer"				, $arr_featured_job_employer				);
	$smarty->assign("featured_job_url"					, $arr_featured_job_url						);
	$smarty->assign("featured_job_date"					, $arr_featured_job_date					);
	$smarty->assign("featured_job_bgcolor"				, $arr_featured_job_bgcolor					);




	
	$clogin_jobseeker_firstname	= str_replace("\\'", "'", $clogin_jobseeker_firstname	);
	$clogin_jobseeker_lastname	= str_replace("\\'", "'", $clogin_jobseeker_lastname	);

	$clogin_employer_firstname	= str_replace("\\'", "'", $clogin_employer_firstname	);
	$clogin_employer_lastname	= str_replace("\\'", "'", $clogin_employer_lastname		);


	$smarty->assign("warning"							, $warning									); 
	$smarty->assign("warning_message"					, $warning									); 
	$smarty->assign("clogin_jobseeker"					, $clogin_jobseeker							); 
	$smarty->assign("clogin_jobseeker_firstname"		, $clogin_jobseeker_firstname				); 
	$smarty->assign("clogin_jobseeker_lastname"			, $clogin_jobseeker_lastname				); 
	$smarty->assign("clogin_jobseeker_status"			, $clogin_jobseeker_status					); 
	$smarty->assign("clogin_jobseeker_status_email"		, $clogin_jobseeker_status_email			); 
	$smarty->assign("clogin_jobseeker_status_resume"	, $clogin_jobseeker_status_resume			); 
	$smarty->assign("clogin_jobseeker_lastlogin"		, $clogin_jobseeker_lastlogin				); 
	$smarty->assign("clogin_employer"					, $clogin_employer							); 
	$smarty->assign("clogin_employer_firstname"			, $clogin_employer_firstname				); 
	$smarty->assign("clogin_employer_lastname"			, $clogin_employer_lastname					); 
	$smarty->assign("clogin_employer_type"				, $clogin_employer_type						); 
	$smarty->assign("clogin_employer_status"			, $clogin_employer_status					); 
	$smarty->assign("clogin_employer_status_email"		, $clogin_employer_status_email				); 
	$smarty->assign("clogin_employer_lastlogin"			, $clogin_employer_lastlogin				); 
	$smarty->assign("clogin_employer_is_expired"		, $clogin_employer_is_expired				); 
	


	
	$smarty->assign("listing_currency_name"				, $currency_name							); 
	$smarty->assign("listing_currency_symbol"			, $currency_symbol							); 
	$smarty->assign("listing_currency_initial"			, $currency_initial							); 
	$smarty->assign("payment_currency_name"				, $pcurrency_name							); 
	$smarty->assign("payment_currency_symbol"			, $pcurrency_symbol							); 
	$smarty->assign("payment_currency_initial"			, $pcurrency_initial						); 
	

	
	$smarty->assign("google_map_display"				, $google_map_display						); 	
	$smarty->assign("google_key"						, $google_map_api_key						); 	
	$smarty->assign("zip_radius_enable"					, $zip_radius_enable						); 	
	$smarty->assign("zip_radius_unit"					, $zip_radius_unit							); 	


	
	$smarty->assign("setup_enable_employer_phone"					, $setup['enable_employer_phone']					); 
	$smarty->assign("setup_enable_employer_fax"						, $setup['enable_employer_fax']						); 
	$smarty->assign("setup_enable_employer_website"					, $setup['enable_employer_website']					); 
	$smarty->assign("setup_enable_employer_numemployees"			, $setup['enable_employer_numemployees']			); 
	$smarty->assign("setup_enable_employer_details"					, $setup['enable_employer_details']					); 
	$smarty->assign("setup_enable_employer_logo"					, $setup['enable_employer_logo']					); 

	$smarty->assign("setup_enable_jobseeker_nationality"			, $setup['enable_jobseeker_nationality']			); 
	$smarty->assign("setup_enable_jobseeker_idnumber"				, $setup['enable_jobseeker_idnumber']				); 
	$smarty->assign("setup_enable_jobseeker_religion"				, $setup['enable_jobseeker_religion']				); 
	$smarty->assign("setup_enable_jobseeker_race"					, $setup['enable_jobseeker_race']					); 
	$smarty->assign("setup_enable_jobseeker_maritalstatus"			, $setup['enable_jobseeker_maritalstatus']			); 
	$smarty->assign("setup_enable_jobseeker_phone"					, $setup['enable_jobseeker_phone']					); 
	$smarty->assign("setup_enable_jobseeker_mobile"					, $setup['enable_jobseeker_mobile']					); 
	$smarty->assign("setup_enable_jobseeker_fax"					, $setup['enable_jobseeker_fax']					); 
	$smarty->assign("setup_enable_jobseeker_website"				, $setup['enable_jobseeker_website']				); 
	$smarty->assign("setup_enable_jobseeker_resume_title"			, $setup['enable_jobseeker_resume_title']			); 
	$smarty->assign("setup_enable_jobseeker_interested_position"	, $setup['enable_jobseeker_interested_position']	); 

	$smarty->assign("setup_enable_job_term"							, $setup['enable_job_term']							); 
	$smarty->assign("setup_enable_job_position"						, $setup['enable_job_position']						); 
	$smarty->assign("setup_enable_job_office_city"					, $setup['enable_job_office_city']					); 
	$smarty->assign("setup_enable_job_office_state"					, $setup['enable_job_office_state']					); 
	$smarty->assign("setup_enable_job_office_zip"					, $setup['enable_job_office_zip']					); 
	$smarty->assign("setup_enable_job_office_country"				, $setup['enable_job_office_country']				); 
	$smarty->assign("setup_enable_job_office_location"				, $setup['enable_job_office_location']				); 
	$smarty->assign("setup_enable_job_req_religion"					, $setup['enable_job_req_religion']					); 
	$smarty->assign("setup_enable_job_req_race"						, $setup['enable_job_req_race']						); 
	$smarty->assign("setup_enable_job_req_maritalstatus"			, $setup['enable_job_req_maritalstatus']			); 
	$smarty->assign("setup_enable_job_req_age"						, $setup['enable_job_req_age']						); 
	$smarty->assign("setup_enable_job_req_workexp"					, $setup['enable_job_req_workexp']					); 

	

	
?>