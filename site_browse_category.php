<?



	

	$section	= "jobseeker";
	include("setting.php");
	

	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	$cat		= 0; 
	$sql_query 	= "SELECT * FROM setup_jobfunction WHERE jobfunction_parent = '$cat' ORDER BY jobfunction_name ASC";
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
	$sql_query 	= "SELECT * FROM setup_jobfunction WHERE jobfunction_parent = '$cat' ORDER BY jobfunction_name ASC LIMIT $left_start, $left_end";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row 	= mysql_fetch_array($result)) {
	
		$jobfunction_id					= $row[jobfunction_id];
		$jobfunction_parent				= $row[jobfunction_parent];
		$jobfunction_name				= $row[jobfunction_name];		
		$jobfunction_name_mod			= F69C27348CCA7B5F625165B15956CB3BD($jobfunction_name);
		$jobfunction_path				= $row[jobfunction_path];
		$jobfunction_featured			= $row[jobfunction_featured];
		$jobfunction_found				= 0;
		$jobfunction_url				= "site_browse_category_detail.php?cat=$jobfunction_id";

		if ($status_url_rewrite == "yes"){ 
			$jobfunction_url			= "browse-$jobfunction_id-0-1-$jobfunction_name_mod.php";	
		}


			$sql_query					= "SELECT * FROM setup_jobfunction WHERE jobfunction_path LIKE '$jobfunction_path%'";
			$result_tmp					= mysql_query($sql_query) or die(mysql_error());
			while($row_tmp 				= mysql_fetch_array($result_tmp)) {
			
				$tmp_jobfunction_id		= $row_tmp[jobfunction_id];

				$sql_query				= "
				SELECT * FROM job , employer
				WHERE 
				job_function 			= '$tmp_jobfunction_id' AND 
				job_employer			=   employer_id			AND
				employer_status_email	=  'approved'			AND
				employer_status			=  'approved'			AND
				job_date_expire			>  '$date_database'		AND
				job_status				=  'approved'		
				";

				$result_found			= mysql_query($sql_query) or die(mysql_error());
				$jobfunction_found_tmp	= mysql_num_rows($result_found);
				$jobfunction_found		= $jobfunction_found + $jobfunction_found_tmp;
	
			}
			
			
		$arr_ljobfunction_id[$i]		= $jobfunction_id;
		$arr_ljobfunction_parent[$i]	= $jobfunction_parent;
		$arr_ljobfunction_name[$i]		= $jobfunction_name;
		$arr_ljobfunction_name_mod[$i]	= $jobfunction_name_mod;
		$arr_ljobfunction_path[$i]		= $jobfunction_path;
		$arr_ljobfunction_featured[$i]	= $jobfunction_featured;
		$arr_ljobfunction_found[$i]		= $jobfunction_found;
		$arr_ljobfunction_url[$i]		= $jobfunction_url;
		$i++;

	}

	$i			= 0;
	$sql_query 	= "SELECT * FROM setup_jobfunction WHERE jobfunction_parent = '$cat' ORDER BY jobfunction_name ASC LIMIT $right_start, $right_end";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row 	= mysql_fetch_array($result)) {
	
		$jobfunction_id					= $row[jobfunction_id];
		$jobfunction_parent				= $row[jobfunction_parent];
		$jobfunction_name				= $row[jobfunction_name];		
		$jobfunction_name_mod			= F69C27348CCA7B5F625165B15956CB3BD($jobfunction_name);
		$jobfunction_path				= $row[jobfunction_path];
		$jobfunction_featured			= $row[jobfunction_featured];
		$jobfunction_found				= 0;
		$jobfunction_url				= "site_browse_category_detail.php?cat=$jobfunction_id";

		if ($status_url_rewrite == "yes"){ 
			$jobfunction_url			= "browse-$jobfunction_id-0-1-$jobfunction_name_mod.php";	
		}


			$sql_query					= "SELECT * FROM setup_jobfunction WHERE jobfunction_path LIKE '$jobfunction_path%'";
			$result_tmp					= mysql_query($sql_query) or die(mysql_error());
			while($row_tmp 				= mysql_fetch_array($result_tmp)) {
			
				$tmp_jobfunction_id		= $row_tmp[jobfunction_id];

				$sql_query				= "
				SELECT * FROM job , employer
				WHERE 
				job_function 			= '$tmp_jobfunction_id' AND 
				job_employer			=   employer_id			AND
				employer_status_email	=  'approved'			AND
				employer_status			=  'approved'			AND
				job_date_expire			>  '$date_database'		AND
				job_status				=  'approved'		
				";

				$result_found			= mysql_query($sql_query) or die(mysql_error());
				$jobfunction_found_tmp	= mysql_num_rows($result_found);
				$jobfunction_found		= $jobfunction_found + $jobfunction_found_tmp;
	
			}


		$arr_rjobfunction_id[$i]		= $jobfunction_id;
		$arr_rjobfunction_parent[$i]	= $jobfunction_parent;
		$arr_rjobfunction_name[$i]		= $jobfunction_name;
		$arr_rjobfunction_name_mod[$i]	= $jobfunction_name_mod;
		$arr_rjobfunction_path[$i]		= $jobfunction_path;
		$arr_rjobfunction_featured[$i]	= $jobfunction_featured;
		$arr_rjobfunction_found[$i]		= $jobfunction_found;
		$arr_rjobfunction_url[$i]		= $jobfunction_url;
		$i++;

	}


	mysql_close($db_connect);




	
	$smarty->assign("left_jobfunction_id"			, $arr_ljobfunction_id			);
	$smarty->assign("left_jobfunction_name"			, $arr_ljobfunction_name		);
	$smarty->assign("left_jobfunction_name_mod"		, $arr_ljobfunction_name_mod	);
	$smarty->assign("left_jobfunction_path"			, $arr_ljobfunction_path		);
	$smarty->assign("left_jobfunction_featured"		, $arr_ljobfunction_featured	);
	$smarty->assign("left_jobfunction_found"		, $arr_ljobfunction_found		);
	$smarty->assign("left_jobfunction_url"			, $arr_ljobfunction_url			);

	$smarty->assign("right_jobfunction_id"			, $arr_rjobfunction_id			);
	$smarty->assign("right_jobfunction_name"		, $arr_rjobfunction_name		);
	$smarty->assign("right_jobfunction_name_mod"	, $arr_rjobfunction_name_mod	);
	$smarty->assign("right_jobfunction_path"		, $arr_rjobfunction_path		);
	$smarty->assign("right_jobfunction_featured"	, $arr_rjobfunction_featured	);
	$smarty->assign("right_jobfunction_found"		, $arr_rjobfunction_found		);
	$smarty->assign("right_jobfunction_url"			, $arr_rjobfunction_url			);

	$smarty->display('site_browse_category.html');	


?>