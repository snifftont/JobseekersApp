<?



	

	$section	= "jobseeker";
	include("setting.php");
	
	
	$row_admin	= $front_search_rows;
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	
	$employer					= $company - $start_employer;
	$sql_query  				= "SELECT * FROM employer WHERE employer_id = '$employer'";
	$result						= mysql_query($sql_query) or die(mysql_error());													
	$row						= mysql_fetch_array($result);
	
	$employer_id				= $row[employer_id];
	$employer_number			= $employer_id + $start_employer;
	$employer_logo				= file_exists("$dir_logo/$employer_id.jpg");

	$employer_username			= $row[employer_username];
	$employer_password			= $row[employer_password];
	$employer_company			= $row[employer_company];
	$employer_company_mod		= F69C27348CCA7B5F625165B15956CB3BD($employer_company);
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

	$sql_query	= "
	SELECT * FROM job, employer, setup_jobfunction
	WHERE 
	job_employer				=  employer_id		AND
	employer_status_email		= 'approved'		AND
	employer_status 			= 'approved'		AND
	job_date_expire				> '$date_database'	AND
	job_status					= 'approved'		AND
	job_function		 		=  jobfunction_id	AND
	job_employer	 			= '$employer_id'
	";
	$result_tmp		      		= mysql_query($sql_query) or die(mysql_error());
	$employer_total_jobs		= mysql_num_rows($result_tmp);








	
	$i			= 0;
	$sql_query	= "
	SELECT * FROM job, employer, setup_jobfunction
	WHERE 
	job_employer			= employer_id		AND
	employer_status_email	= 'approved'		AND
	employer_status 		= 'approved'		AND
	job_date_expire			> '$date_database'	AND
	job_status				= 'approved'		AND
	job_function		 	= jobfunction_id	AND
	job_employer	 		= '$employer'
	ORDER BY job_status_featured DESC, job_date_add DESC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$job_total	= mysql_num_rows($result);


	if (!$current_item) { $current_item = 0; }
	$sql_query .= " LIMIT $current_item, $row_admin";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		

		if ($i % 2 == 1) { $job_bgcolor	= "#F5FCFF"; } else { $job_bgcolor	= "#D7F3FE"; }
		if ($i % 2 == 1) { $job_bgcolor	= "#EAF8FE"; } else { $job_bgcolor	= "#FFFFFF"; }

		$job_id						= $row[job_id];
		$job_number					= $job_id + $start_job;
		$job_title					= $row[job_title];
		$job_title_mod				= F69C27348CCA7B5F625165B15956CB3BD($job_title);
		$job_employer				= $row[employer_company];
		$job_employer_id			= $row[job_employer];
		$job_employer_logo			= file_exists("$dir_logo/$job_employer_id.jpg");

		$job_function				= $row[job_function];
		$job_term					= $row[job_term];
		$job_office_city			= $row[job_office_city];
		$job_office_state			= $row[job_office_state];
		$job_office_zip				= $row[job_office_zip];
		$job_office_country			= $row[job_office_country];
		$job_salary_type			= $row[job_salary_type];
		$job_salary_min				= $row[job_salary_min];
		$job_salary_max				= $row[job_salary_max];
		$job_salary_min				= $currency_symbol . number_format($job_salary_min, 2, $web_decimal_separator, $web_thousand_separator);
		$job_salary_max				= $currency_symbol . number_format($job_salary_max, 2, $web_decimal_separator, $web_thousand_separator);
		$job_salary_payment			= $row[job_salary_payment];
		$job_status_featured		= $row[job_status_featured];

		$job_date_add				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_add], $date_format);
		$job_date_last				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_lastdate], $date_format);
		$job_in_favourite			= 0;
		$job_in_apply				= 0;


		$sql_query 					= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$job_function'";
		$tresult					= mysql_query($sql_query) or die(mysql_error());
		$trow 						= mysql_fetch_array($tresult);
		$job_function				= $trow[jobfunction_name];

		$sql_query					= "SELECT * FROM setup_term WHERE term_id = '$job_term'";
		$tresult					= mysql_query($sql_query) or die(mysql_error());
		$trow						= mysql_fetch_array($tresult);
		$job_term					= $trow[term_name];
	
		$sql_query					= "SELECT * FROM setup_country WHERE country_id = '$job_office_country'";
		$tresult					= mysql_query($sql_query) or die(mysql_error());
		$trow						= mysql_fetch_array($tresult);
		$job_office_country			= $trow[country_name];
	
		$sql_query					= "SELECT * FROM setup_salarypayment WHERE salarypayment_id = '$job_salary_payment'";
		$tresult					= mysql_query($sql_query) or die(mysql_error());
		$trow						= mysql_fetch_array($tresult);
		$job_salary_payment			= $trow[salarypayment_name];



		if ($clogin_jobseeker) {

			$sql_query				= "SELECT * FROM jobseeker_favourite WHERE favourite_jobseeker = '$clogin_jobseeker' AND favourite_job = '$job_id'";
			$tresult				= mysql_query($sql_query) or die(mysql_error());
			$job_in_favourite		= mysql_num_rows($tresult);

			$sql_query				= "SELECT * FROM job_application  WHERE application_jobseeker = '$clogin_jobseeker' AND application_job = '$job_id'";
			$tresult				= mysql_query($sql_query) or die(mysql_error());
			$job_in_apply			= mysql_num_rows($tresult);

		}




		
		$this_url					= $_SERVER['REQUEST_URI'];
		$this_url_encoded			= htmlentities(urlencode($this_url));
		$job_url_detail				= "site_detail.php?job=$job_number";
		$job_url_detail_print		= "site_detail_print.php?job=$job_number";
		$job_url_detail_share		= "site_detail_share.php?job=$job_number";
		$job_url_detail_apply		= "system_job_apply.php?job=$job_id&backurl=$this_url_encoded";
		$job_url_detail_favourite	= "system_job_favourite.php?job=$job_id&backurl=$this_url_encoded";
		$job_url_company_map		= "site_company_map.php?company=$employer_number";;
	
		if($status_url_rewrite == "yes") {	
			$job_url_detail 		= "detail-$job_number-$job_title_mod.php"; 
			$job_url_detail_print 	= "print-$job_number-$job_title_mod.php"; 
			$job_url_detail_share 	= "share-$job_number-$job_title_mod.php"; 
			$job_url_company_map 	= "map-$employer_number-$employer_company_mod.php"; 
		}
	
	
		if($job_status_featured == "yes"){$job_bgcolor	= "#FFF7D2"; }



		$arr_job_id[$i]					= $job_id;
		$arr_job_number[$i]				= $job_number;
		$arr_job_bgcolor[$i]			= $job_bgcolor;
		$arr_job_title[$i]				= $job_title;
		$arr_job_title_mod[$i]			= $job_title_mod;
		$arr_job_employer[$i]			= $job_employer;
		$arr_job_employer_id[$i]		= $job_employer_id;
		$arr_job_employer_logo[$i]		= $job_employer_logo;
		$arr_job_function[$i]			= $job_function;
		$arr_job_term[$i]				= $job_term;
		$arr_job_office_city[$i]		= $job_office_city;
		$arr_job_office_state[$i]		= $job_office_state;
		$arr_job_office_zip[$i]			= $job_office_zip;
		$arr_job_office_country[$i]		= $job_office_country;
		$arr_job_salary_type[$i]		= $job_salary_type;
		$arr_job_salary_min[$i]			= $job_salary_min;
		$arr_job_salary_max[$i]			= $job_salary_max;
		$arr_job_salary_payment[$i]		= $job_salary_payment;
		$arr_job_status_featured[$i]	= $job_status_featured;
		$arr_job_date_add[$i]			= $job_date_add;
		$arr_job_date_last[$i]			= $job_date_last;
		$arr_job_in_favourite[$i]		= $job_in_favourite;
		$arr_job_in_apply[$i]			= $job_in_apply;

		$arr_job_url_detail[$i]			= $job_url_detail;
		$arr_job_url_detail_print[$i]	= $job_url_detail_print;
		$arr_job_url_detail_share[$i]	= $job_url_detail_share;
		$i++;

	} 
	mysql_close($db_connect);





	$job_url_company_map	= "site_company_map.php?company=$employer_number";;
	if($status_url_rewrite == "yes") {	
		$job_url_company_map 	= "map-$employer_number-$employer_company_mod.php"; 
	}
	


	
	$row_admin	= $front_search_rows;
	if ($status_url_rewrite == "yes")	{ 

		$item				= $current_item;
		$page				= $current_page;
		$current_url		= "company-$employer_number-[item]-[page]-$employer_company_mod.php";
		$this_url			= $_SERVER['REQUEST_URI'];
		$this_url_encoded	= htmlentities(urlencode($this_url));
		$search_detail		= "mod_rewrite=";

	} else {
		
		$current_url		= "site_company_list.php";
		$this_url			= $_SERVER['REQUEST_URI'];
		$this_url_encoded	= htmlentities(urlencode($this_url));
		$search_detail 		= "&company=$employer_number";
		
	}

	if (!$current_page				)	{ $current_page = 1; 											} 
	if (!$page_url					)	{ $page_url 	= $current_url; 								} 
	if ($job_total % $row_admin > 0	)	{ $total_page 	= floor($job_total / $row_admin) + 1;			} 
    else								{ $total_page 	= $job_total / $row_admin;						}




	
	$smarty->assign("job_total"						, $job_total					);
	$smarty->assign("job_id"						, $arr_job_id					);
	$smarty->assign("job_number"					, $arr_job_number				);
	$smarty->assign("job_bgcolor"					, $arr_job_bgcolor				);
	$smarty->assign("job_title"						, $arr_job_title				);
	$smarty->assign("job_title_mod"					, $arr_job_title_mod			);
	$smarty->assign("job_employer"					, $arr_job_employer				);
	$smarty->assign("job_employer_id"				, $arr_job_employer_id			);
	$smarty->assign("job_employer_logo"				, $arr_job_employer_logo		);
	$smarty->assign("job_function"					, $arr_job_function				);
	$smarty->assign("job_term"						, $arr_job_term					);
	$smarty->assign("job_office_city"				, $arr_job_office_city			);
	$smarty->assign("job_office_state"				, $arr_job_office_state			);
	$smarty->assign("job_office_zip"				, $arr_job_office_zip			);
	$smarty->assign("job_office_country"			, $arr_job_office_country		);
	$smarty->assign("job_salary_type"				, $arr_job_salary_type			);
	$smarty->assign("job_salary_min"				, $arr_job_salary_min			);
	$smarty->assign("job_salary_max"				, $arr_job_salary_max			);
	$smarty->assign("job_salary_payment"			, $arr_job_salary_payment		);
	$smarty->assign("job_status_featured"			, $arr_job_status_featured		);
	$smarty->assign("job_date_add"					, $arr_job_date_add				);
	$smarty->assign("job_date_last"					, $arr_job_date_last			);
	$smarty->assign("job_in_favourite"				, $arr_job_in_favourite			);
	$smarty->assign("job_in_apply"					, $arr_job_in_apply				);
	$smarty->assign("job_url_detail"				, $arr_job_url_detail			);
	$smarty->assign("job_url_detail_print"			, $arr_job_url_detail_print		);
	$smarty->assign("job_url_detail_share"			, $arr_job_url_detail_share		);
	$smarty->assign("job_url_company_map"			, $job_url_company_map			);

	$smarty->assign("form_back_url"					, $this_url						);
	$smarty->assign("form_back_url_encoded"			, $this_url_encoded				);
	$smarty->assign("cresponse_processed"			, $cresponse_processed			);


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

	include("system_paging.php");
	$smarty->display('site_company_list.html');	
	
	

?>