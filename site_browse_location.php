<?



	

	$section	= "jobseeker";
	include("setting.php");
	

	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	$cat		= 0; 
	$sql_query 	= "SELECT * FROM setup_joblocation ORDER BY joblocation_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$found		= mysql_num_rows($result);
	$min_rows	= floor($found / 2);



	if ($found % 2 == 1) { 
	
		$left_start		= 0;
		$left_end		= $min_rows + 1;
		$right_start	= $left_end;
		$right_end		= $right_start + $min_rows;
	
	}
	else {
	
		$left_start		= 0;
		$left_end		= $min_rows;
		$right_start	= $left_end;
		$right_end		= $right_start + $min_rows;
	
	}




	$i			= 0;
	$sql_query 	= "SELECT * FROM setup_joblocation ORDER BY joblocation_name ASC LIMIT $left_start, $left_end";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row 	= mysql_fetch_array($result)) {
	
		$joblocation_id					= $row[joblocation_id];
		$joblocation_name				= $row[joblocation_name];		
		$joblocation_name_mod			= F69C27348CCA7B5F625165B15956CB3BD($joblocation_name);
		$joblocation_url				= "site_search.php?slocation=$joblocation_id";

		$sql_query	= "
		SELECT * FROM job , employer
		WHERE 
		job_office_location 			= '$joblocation_id'		AND 
		job_employer					=   employer_id			AND
		employer_status_email			=  'approved'			AND
		employer_status					=  'approved'			AND
		job_date_expire					>  '$date_database'		AND
		job_status						=  'approved'		
		";

		$result_found					= mysql_query($sql_query) or die(mysql_error());
		$joblocation_found				= mysql_num_rows($result_found);

		$arr_ljoblocation_id[$i]		= $joblocation_id;
		$arr_ljoblocation_name[$i]		= $joblocation_name;
		$arr_ljoblocation_name_mod[$i]	= $joblocation_name_mod;
		$arr_ljoblocation_found[$i]		= $joblocation_found;
		$arr_ljoblocation_url[$i]		= $joblocation_url;
		$i++;

	}


	$i			= 0;
	$sql_query 	= "SELECT * FROM setup_joblocation ORDER BY joblocation_name ASC LIMIT $right_start, $right_end";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row 	= mysql_fetch_array($result)) {
	
		$joblocation_id					= $row[joblocation_id];
		$joblocation_name				= $row[joblocation_name];		
		$joblocation_name_mod			= F69C27348CCA7B5F625165B15956CB3BD($joblocation_name);
		$joblocation_url				= "site_search.php?slocation=$joblocation_id";

		$sql_query	= "
		SELECT * FROM job , employer
		WHERE 
		job_office_location 			= '$joblocation_id'		AND 
		job_employer					=   employer_id			AND
		employer_status_email			=  'approved'			AND
		employer_status					=  'approved'			AND
		job_date_expire					>  '$date_database'		AND
		job_status						=  'approved'		
		";

		$result_found					= mysql_query($sql_query) or die(mysql_error());
		$joblocation_found				= mysql_num_rows($result_found);
			
		$arr_rjoblocation_id[$i]		= $joblocation_id;
		$arr_rjoblocation_name[$i]		= $joblocation_name;
		$arr_rjoblocation_name_mod[$i]	= $joblocation_name_mod;
		$arr_rjoblocation_found[$i]		= $joblocation_found;
		$arr_rjoblocation_url[$i]		= $joblocation_url;
		$i++;

	}


	mysql_close($db_connect);




	
	$smarty->assign("left_joblocation_id"			, $arr_ljoblocation_id			);
	$smarty->assign("left_joblocation_name"			, $arr_ljoblocation_name		);
	$smarty->assign("left_joblocation_name_mod"		, $arr_ljoblocation_name_mod	);
	$smarty->assign("left_joblocation_path"			, $arr_ljoblocation_path		);
	$smarty->assign("left_joblocation_featured"		, $arr_ljoblocation_featured	);
	$smarty->assign("left_joblocation_found"		, $arr_ljoblocation_found		);
	$smarty->assign("left_joblocation_url"			, $arr_ljoblocation_url			);

	$smarty->assign("right_joblocation_id"			, $arr_rjoblocation_id			);
	$smarty->assign("right_joblocation_name"		, $arr_rjoblocation_name		);
	$smarty->assign("right_joblocation_name_mod"	, $arr_rjoblocation_name_mod	);
	$smarty->assign("right_joblocation_path"		, $arr_rjoblocation_path		);
	$smarty->assign("right_joblocation_featured"	, $arr_rjoblocation_featured	);
	$smarty->assign("right_joblocation_found"		, $arr_rjoblocation_found		);
	$smarty->assign("right_joblocation_url"			, $arr_rjoblocation_url			);

	$smarty->display('site_browse_location.html');	


?>