<?



	


	$section	= "employer";
	include("setting.php");
	include("employer_check.php");



	setcookie("cpromo_disc"		, ""	);
	setcookie("cpromo_code"		, ""	);
	setcookie("cpromo_warning"	, ""	);
	

	
	$employer	= $clogin_employer;
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	


	$sql_query  	= "SELECT * FROM job WHERE job_id = '$job'";
	$result			= mysql_query($sql_query) or die(mysql_error());													
	$row			= mysql_fetch_array($result);
	$job_id			= $row[job_id];
	$job_number		= $job_id + $start_job;
	$job_title		= $row[job_title];
	$job_employer	= $row[job_employer];
	$job_package	= $row[job_package];



	if ($job_employer != $clogin_employer) { 
		header("Location:employer_job.php");
	}




	$sql_query		= "SELECT * FROM job_application, jobseeker WHERE application_job = '$job' AND application_jobseeker = jobseeker_id AND jobseeker_status = 'approved' AND jobseeker_status_email = 'approved' ORDER BY application_date DESC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	$found			= mysql_num_rows($result);



	if (!$current_item) { $current_item = 0; }

	$i				= 0;
	$sql_query		= "
	SELECT * FROM job_application, jobseeker 
	WHERE 
	application_job 		= '$job'			AND 
	application_jobseeker 	=  jobseeker_id 	AND 
	jobseeker_status 		= 'approved'		AND
	jobseeker_status_email	= 'approved'		
	ORDER BY application_date DESC 
	LIMIT $current_item, $row_admin
	";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){


		if ($i % 2 == 0){ $bg_color = "EAF8FE"; }
		else 			{ $bg_color = "FFFFFF"; }


		$application_id						= $row[application_id];
		$application_job					= $row[application_job];
		$application_jobseeker				= $row[application_jobseeker];
		$application_shortlisted			= $row[application_shortlisted];
		$application_date					= $row[application_date];
		$application_date					= F2BE712F08F5878F1C8F3DFF139674C86($application_date, $date_format);
		
		$jobseeker_r_title					= $row[jobseeker_resume_title];
		$jobseeker_r_academic				= $row[jobseeker_resume_academic];
		$jobseeker_r_workingyear			= $row[jobseeker_resume_workingyear];
		$jobseeker_r_salary					= $row[jobseeker_resume_expectedsalary];
		$jobseeker_r_salary					= $currency_symbol . number_format($jobseeker_r_salary, 2, $web_decimal_separator, $web_thousand_separator);
		$jobseeker_r_availability			= $row[jobseeker_resume_availability];
		$jobseeker_r_availabilitydate		= $row[jobseeker_resume_availabilitydate];
		$jobseeker_r_availabilitydate		= F2BE712F08F5878F1C8F3DFF139674C86($jobseeker_r_availabilitydate, $date_format);
		
		$sql_query							= "SELECT * FROM setup_academic WHERE academic_id = '$jobseeker_r_academic'";
		$tresult							= mysql_query($sql_query) or die(mysql_error());
		$trow								= mysql_fetch_array($tresult);
		$jobseeker_r_academic				= $trow[academic_name];
		
		$jobseeker_id						= $row[jobseeker_id];
		$jobseeker_username					= $row[jobseeker_username];
		$jobseeker_password					= $row[jobseeker_password];
		$jobseeker_title					= $row[jobseeker_title];
		$jobseeker_firstname				= $row[jobseeker_firstname];
		$jobseeker_lastname					= $row[jobseeker_lastname];
		$jobseeker_fullname					= "$jobseeker_firstname $jobseeker_lastname";
		$jobseeker_fullname					= str_replace("'", "\'", $jobseeker_fullname);
		
		
		$jobseeker_birthdate				= $row[jobseeker_birthdate];
		$sql_query							= "SELECT TO_DAYS(NOW()) - TO_DAYS('$jobseeker_birthdate') AS age";
		$tresult							= mysql_query($sql_query) or die(mysql_error());
		$trow								= mysql_fetch_array($tresult);
		$jobseeker_days						= $trow[age];
		$jobseeker_age						= floor($jobseeker_days / 365);

		$jobseeker_nationality				= $row[jobseeker_nationality];
		$jobseeker_idnumber					= $row[jobseeker_idnumber];
		$jobseeker_gender					= $row[jobseeker_gender];
		$jobseeker_religion					= $row[jobseeker_religion];
		$jobseeker_race						= $row[jobseeker_race];
		$jobseeker_marital					= $row[jobseeker_marital];
		
		$jobseeker_address					= $row[jobseeker_address];
		$jobseeker_address2					= $row[jobseeker_address2];
		$jobseeker_city						= $row[jobseeker_city];
		$jobseeker_state					= $row[jobseeker_state];
		$jobseeker_zip						= $row[jobseeker_zip];
		$jobseeker_country					= $row[jobseeker_country];

		$sql_query							= "SELECT * FROM setup_country WHERE country_id = '$jobseeker_country'";
		$tresult							= mysql_query($sql_query) or die(mysql_error());
		$trow								= mysql_fetch_array($tresult);
		$jobseeker_country					= $trow[country_name];
	
		$jobseeker_phone					= $row[jobseeker_phone];
		$jobseeker_cellphone				= $row[jobseeker_cellphone];
		$jobseeker_fax						= $row[jobseeker_fax];
		$jobseeker_email					= $row[jobseeker_email];
		$jobseeker_website					= $row[jobseeker_website];

		$sql_query							= "SELECT * FROM jobseeker_photo WHERE photo_main = 'yes' AND photo_jobseeker = '$jobseeker_id'";
		$tresult							= mysql_query($sql_query) or die(mysql_error());
		$trow								= mysql_fetch_array($tresult);
		$jobseeker_photo_id					= $trow[photo_id];
		
		$arr_application_id[$i]				= $application_id;
		$arr_application_job[$i]			= $application_job;
		$arr_application_jobseeker[$i]		= $application_jobseeker;
		$arr_application_date[$i]			= $application_date;

		$arr_jobseeker_r_title[$i]			= $jobseeker_r_title;
		$arr_jobseeker_r_academic[$i]		= $jobseeker_r_academic;
		$arr_jobseeker_r_workingyear[$i]	= $jobseeker_r_workingyear;
		$arr_jobseeker_r_salary[$i]			= $jobseeker_r_salary;
		$arr_jobseeker_r_availability[$i]	= $jobseeker_r_availability;
		$arr_jobseeker_r_availdate[$i]		= $jobseeker_r_availabilitydate;
		
		$arr_jobseeker_id[$i]				= $jobseeker_id;
		$arr_jobseeker_username[$i]			= $jobseeker_username;
		$arr_jobseeker_password[$i]			= $jobseeker_password;
		$arr_jobseeker_firstname[$i]		= $jobseeker_firstname;
		$arr_jobseeker_lastname[$i]			= $jobseeker_lastname;
		$arr_jobseeker_fullname[$i]			= $jobseeker_fullname;
		$arr_jobseeker_birthdate[$i]		= $jobseeker_birthdate;
		$arr_jobseeker_age[$i]				= $jobseeker_age;
		$arr_jobseeker_nationality[$i]		= $jobseeker_nationality;
		$arr_jobseeker_idnumber[$i]			= $jobseeker_idnumber;
		$arr_jobseeker_gender[$i]			= $jobseeker_gender;
		$arr_jobseeker_religion[$i]			= $jobseeker_religion;
		$arr_jobseeker_race[$i]				= $jobseeker_race;
		$arr_jobseeker_marital[$i]			= $jobseeker_marital;
		$arr_jobseeker_address[$i]			= $jobseeker_address;
		$arr_jobseeker_address2[$i]			= $jobseeker_address2;
		$arr_jobseeker_city[$i]				= $jobseeker_city;
		$arr_jobseeker_state[$i]			= $jobseeker_state;
		$arr_jobseeker_zip[$i]				= $jobseeker_zip;
		$arr_jobseeker_country[$i]			= $jobseeker_country;
		$arr_jobseeker_phone[$i]			= $jobseeker_phone;
		$arr_jobseeker_cellphone[$i]		= $jobseeker_cellphone;
		$arr_jobseeker_fax[$i]				= $jobseeker_fax;
		$arr_jobseeker_email[$i]			= $jobseeker_email;
		$arr_jobseeker_website[$i]			= $jobseeker_website;
		$arr_jobseeker_photo_id[$i]			= $jobseeker_photo_id;
		$arr_jobseeker_bgcolor[$i]			= $bg_color;
		$i++;
		
	
	} 
	mysql_close($db_connect);



	
	$search_detail 	= "&job=$job";
	if (!$current_page			)	{ $current_page = 1; 								} 
	if (!$page_url				)	{ $page_url 	= "employer_job_jobseekers.php"; 	} 
	if ($found % $row_admin > 0	)	{ $total_page 	= floor($found / $row_admin) + 1;	} 
    else							{ $total_page 	= $found / $row_admin;				}
	


	
	$smarty->assign("job_id"					, $job_id						);
	$smarty->assign("job_number"				, $job_number					);
	$smarty->assign("job_title"					, $job_title					);

	$smarty->assign("application_id"			, $arr_application_id				);
	$smarty->assign("application_job"			, $arr_application_job				);
	$smarty->assign("application_jobseeker"		, $arr_application_jobseeker		);
	$smarty->assign("application_date"			, $arr_application_date				);
	
	$smarty->assign("jobseeker_bgcolor"			, $arr_jobseeker_bgcolor			);
	$smarty->assign("jobseeker_found"			, $found							);

	$smarty->assign("jobseeker_r_title"			, $arr_jobseeker_r_title			);
	$smarty->assign("jobseeker_r_academic"		, $arr_jobseeker_r_academic			);
	$smarty->assign("jobseeker_r_workingyear"	, $arr_jobseeker_r_workingyear		);
	$smarty->assign("jobseeker_r_salary"		, $arr_jobseeker_r_salary			);
	$smarty->assign("jobseeker_r_availability"	, $arr_jobseeker_r_availability		);
	$smarty->assign("jobseeker_r_availdate"		, $arr_jobseeker_r_availdate		);

	$smarty->assign("jobseeker_id"				, $arr_jobseeker_id					);
	$smarty->assign("jobseeker_username"		, $arr_jobseeker_username			);
	$smarty->assign("jobseeker_password"		, $arr_jobseeker_password			);
	$smarty->assign("jobseeker_title"			, $arr_jobseeker_title				);
	$smarty->assign("jobseeker_firstname"		, $arr_jobseeker_firstname			);
	$smarty->assign("jobseeker_lastname"		, $arr_jobseeker_lastname			);
	$smarty->assign("jobseeker_fullname"		, $arr_jobseeker_fullname			);
	$smarty->assign("jobseeker_birthdate"		, $arr_jobseeker_birthdate			);
	$smarty->assign("jobseeker_age"				, $arr_jobseeker_age				);
	$smarty->assign("jobseeker_nationality"		, $arr_jobseeker_nationality		);
	$smarty->assign("jobseeker_idnumber"		, $arr_jobseeker_idnumber			);
	$smarty->assign("jobseeker_gender"			, $arr_jobseeker_gender				);
	$smarty->assign("jobseeker_religion"		, $arr_jobseeker_religion			);
	$smarty->assign("jobseeker_race"			, $arr_jobseeker_race				);
	$smarty->assign("jobseeker_marital"			, $arr_jobseeker_marital			);
	$smarty->assign("jobseeker_address"			, $arr_jobseeker_address			);
	$smarty->assign("jobseeker_address2"		, $arr_jobseeker_address2			);
	$smarty->assign("jobseeker_city"			, $arr_jobseeker_city				);
	$smarty->assign("jobseeker_state"			, $arr_jobseeker_state				);
	$smarty->assign("jobseeker_zip"				, $arr_jobseeker_zip				);
	$smarty->assign("jobseeker_country"			, $arr_jobseeker_country			);
	$smarty->assign("jobseeker_phone"			, $arr_jobseeker_phone				);
	$smarty->assign("jobseeker_cellphone"		, $arr_jobseeker_cellphone			);
	$smarty->assign("jobseeker_fax"				, $arr_jobseeker_fax				);
	$smarty->assign("jobseeker_email"			, $arr_jobseeker_email				);
	$smarty->assign("jobseeker_website"			, $arr_jobseeker_website			);
	$smarty->assign("jobseeker_photo_id"		, $arr_jobseeker_photo_id			);

	include("system_paging.php");
	$smarty->display('employer_job_jobseekers.html');	








?>