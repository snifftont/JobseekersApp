<?



	


	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	
	
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	

	$i					= 0;
	$employer			= $clogin_employer;

	$sql_query			= "SELECT * FROM job WHERE job_employer = '$clogin_employer' ORDER BY job_id DESC";
	$result				= mysql_query($sql_query) or die(mysql_error());
	$found				= mysql_num_rows($result);

	$sql_query			= "SELECT * FROM job WHERE job_employer = '$clogin_employer' ORDER BY job_id DESC LIMIT 0, 8";
	$result				= mysql_query($sql_query) or die(mysql_error());
	while($row			= mysql_fetch_array($result)){


		if ($i % 2 == 0)			{ $bg_color = "EAF8FE"; }
		else 						{ $bg_color = "FFFFFF"; }
		
		$job_id						= $row[job_id];
		$job_package				= $row[job_package];
		
		$job_number					= $job_id + $start_job;
		$job_title					= $row[job_title];
		$job_date_add				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_add], $date_format);
		$job_lastdate				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_lastdate], $date_format);
		$job_date_expire			= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_expire], $date_format);
		$job_stat_views				= $row[job_stat_views];
		$job_status					= $row[job_status];
		
		$sql_query					= "SELECT * FROM job_application WHERE application_job = '$job_id'";
		$result_tmp					= mysql_query($sql_query) or die(mysql_error());
		$job_apply					= mysql_num_rows($result_tmp);

		$arr_job_id[$i]				= $job_id;
		$arr_job_number[$i]			= $job_number;
		$arr_job_title[$i]			= $job_title;
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

	$smarty->display('employer_home.html');	


?>