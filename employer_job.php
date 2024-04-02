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
	


	
	$sql_query  		= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
	$result				= mysql_query($sql_query) or die(mysql_error());													
	$row				= mysql_fetch_array($result);
	$employer_id		= $row[employer_id];
	$employer_type		= $row[employer_type];
	$employer_package	= $row[employer_package];
	
	$sql_query	    	= "SELECT * FROM setup_package_subscription WHERE package_id = '$employer_package'";
	$result		    	= mysql_query($sql_query) or die(mysql_error());
	$row		    	= mysql_fetch_array($result);
	$limit_max			= $row[package_listing];

	$sql_query			= "SELECT * FROM job WHERE job_employer = '$clogin_employer' AND job_status != 'closed'";
	$result				= mysql_query($sql_query) or die(mysql_error());
	$found				= mysql_num_rows($result);
	$limit_used			= $found;
	$limit_available	= $limit_max - $limit_used;

	$sql_query			= "SELECT * FROM job WHERE job_employer = '$clogin_employer'";
	$result				= mysql_query($sql_query) or die(mysql_error());
	$found				= mysql_num_rows($result);
	


	if (!$current_item) { $current_item = 0; }

	$i					= 0;
	$sql_query			= "SELECT * FROM job WHERE job_employer = '$clogin_employer' ORDER BY job_id DESC LIMIT $current_item, $row_admin";
	$result				= mysql_query($sql_query) or die(mysql_error());
	while($row			= mysql_fetch_array($result)){


		if ($i % 2 == 0){ $bg_color = "EAF8FE"; }
		else 			{ $bg_color = "FFFFFF"; }
		
		$job_id						= $row[job_id];
		$job_package				= $row[job_package];
		
		$job_number					= $job_id + $start_job;
		$job_title					= $row[job_title];
		$job_title2					= str_replace("'", "\'", $job_title);
		$job_date_add				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_add], $date_format);
		$job_lastdate				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_lastdate], $date_format);
		$job_date_expire			= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_expire], $date_format);
		$job_stat_views				= $row[job_stat_views];
		$job_status					= $row[job_status];
		
		$sql_query					= "
		SELECT * FROM job_application, jobseeker 
		WHERE 
		application_job 			= '$job_id'			AND 
		application_jobseeker 		=  jobseeker_id 	AND 
		jobseeker_status 			= 'approved' 		AND 
		jobseeker_status_email		= 'approved' 
		ORDER BY application_date DESC
		";

		$result_tmp					= mysql_query($sql_query) or die(mysql_error());
		$job_apply					= mysql_num_rows($result_tmp);

		$sql_query					= "SELECT * FROM setup_package WHERE package_id = '$job_package'";
		$result_tmp					= mysql_query($sql_query) or die(mysql_error());
		$row_tmp					= mysql_fetch_array($result_tmp);
		$job_renewable				= $row_tmp[package_renewable];

		$arr_job_id[$i]				= $job_id;
		$arr_job_number[$i]			= $job_number;
		$arr_job_renewable[$i]		= $job_renewable;
		$arr_job_title[$i]			= $job_title;
		$arr_job_title2[$i]			= $job_title2;
		$arr_job_date_add[$i]		= $job_date_add;
		$arr_job_lastdate[$i]		= $job_lastdate;
		$arr_job_date_expire[$i]	= $job_date_expire;
		$arr_job_stat_views[$i]		= $job_stat_views;
		$arr_job_status[$i]			= $job_status;
		$arr_job_apply[$i]			= $job_apply;
		$arr_job_bgcolor[$i]		= $bg_color;
		$i++;
		
	
	} 
	mysql_close($db_connect);



	
	if (!$current_page			)	{ $current_page = 1; 								} 
	if (!$page_url				)	{ $page_url 	= "employer_job.php"; 				} 
	if ($found % $row_admin > 0	)	{ $total_page 	= floor($found / $row_admin) + 1;	} 
    else							{ $total_page 	= $found / $row_admin;				}
	


	
	$smarty->assign("job_found"				, $found						);
	$smarty->assign("job_id"				, $arr_job_id					);
	$smarty->assign("job_number"			, $arr_job_number				);
	$smarty->assign("job_renewable"			, $arr_job_renewable			);
	$smarty->assign("job_title"				, $arr_job_title				);
	$smarty->assign("job_title2"			, $arr_job_title2				);
	$smarty->assign("job_date_add"			, $arr_job_date_add				);
	$smarty->assign("job_lastdate"			, $arr_job_lastdate				);
	$smarty->assign("job_date_expire"		, $arr_job_date_expire			);
	$smarty->assign("job_stat_views"		, $arr_job_stat_views			);
	$smarty->assign("job_status"			, $arr_job_status				);
	$smarty->assign("job_apply"				, $arr_job_apply				);
	$smarty->assign("job_bgcolor"			, $arr_job_bgcolor				);

	$smarty->assign("limit_max"				, $limit_max					);
	$smarty->assign("limit_used"			, $limit_used					);
	$smarty->assign("limit_available"		, $limit_available				);

	include("system_paging.php");
	$smarty->display('employer_job.html');	








?>