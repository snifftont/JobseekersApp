<?



	

	$section	= "jobseeker";
	include("setting.php");
	

	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	$employer_id				= $company - $start_employer;

	$sql_query  				= "SELECT * FROM employer WHERE employer_id = '$employer_id'";
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
	



	mysql_close($db_connect);






	
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

	$smarty->display('site_company_map.html');	
	

?>