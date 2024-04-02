<?



	

	$section	= "home";
	include("setting.php");
	

	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	


	

	$i			= 0;
	$sql_query 	= "
	SELECT * FROM employer
	WHERE 
	employer_status				= 'approved'		AND  
	employer_status_email		= 'approved' 		AND
	employer_status_featured	= 'Y'				AND
	employer_date_expired 		> '$date_database'	AND
	employer_job_total			> '0'
	ORDER BY RAND()
	LIMIT 0, 3
	";


	$sql_query 	= "
	SELECT * FROM employer
	WHERE 
	employer_status				= 'approved'		AND  
	employer_status_email		= 'approved' 		AND
	employer_status_featured	= 'Y'				AND
	employer_date_expired 		> '$date_database'	
	ORDER BY RAND()
	LIMIT 0, 3
	";
	
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){

		$employer_id				= $row[employer_id];
		$employer_number			= $employer_id + $start_employer;
		$employer_logo				= file_exists("$dir_logo/$employer_id.jpg");
		$employer_jobs				= $row[employer_job_total];
		$employer_company			= $row[employer_company];
		$employer_company_mod		= F69C27348CCA7B5F625165B15956CB3BD($employer_company);
		$employer_url				= "site_company_list.php?company=$employer_number";;

		if ($status_url_rewrite == "yes") {	
			$employer_url 			= "company-$employer_number-0-1-$employer_company_mod.php"; 
		}
		
		$arr_employer_id[$i]		= $employer_id;
		$arr_employer_number[$i]	= $employer_number;
		$arr_employer_logo[$i]		= $employer_logo;
		$arr_employer_company[$i]	= $employer_company;
		$arr_employer_url[$i]		= $employer_url;
		$arr_employer_jobs[$i]		= $employer_jobs;
		$i++;
		
	
	} 



	$i			= 0;
	$sql_query 	= "SELECT * FROM setup_jobfunction WHERE jobfunction_parent = '$cat' AND jobfunction_featured = 'yes' ORDER BY jobfunction_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row 	= mysql_fetch_array($result)) {
	
		if ($i % 2 == 1)	{ $bgcolor	= "#EAF8FE"; } 
		else 				{ $bgcolor	= "#FFFFFF"; }

		$jobfunction_id					= $row[jobfunction_id];
		$jobfunction_color				= $bgcolor;
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
		$arr_ljobfunction_color[$i]		= $jobfunction_color;
		$arr_ljobfunction_parent[$i]	= $jobfunction_parent;
		$arr_ljobfunction_name[$i]		= $jobfunction_name;
		$arr_ljobfunction_name_mod[$i]	= $jobfunction_name_mod;
		$arr_ljobfunction_path[$i]		= $jobfunction_path;
		$arr_ljobfunction_featured[$i]	= $jobfunction_featured;
		$arr_ljobfunction_found[$i]		= $jobfunction_found;
		$arr_ljobfunction_url[$i]		= $jobfunction_url;
		$i++;

	}

	mysql_close($db_connect);




	
	$smarty->assign("employer_id"					, $arr_employer_id				);
	$smarty->assign("employer_number"				, $arr_employer_number			);
	$smarty->assign("employer_logo"					, $arr_employer_logo			);
	$smarty->assign("employer_company"				, $arr_employer_company			);
	$smarty->assign("employer_url"					, $arr_employer_url				);
	$smarty->assign("employer_jobs"					, $arr_employer_jobs			);

	$smarty->assign("left_jobfunction_id"			, $arr_ljobfunction_id			);
	$smarty->assign("left_jobfunction_color"		, $arr_ljobfunction_color		);
	$smarty->assign("left_jobfunction_name"			, $arr_ljobfunction_name		);
	$smarty->assign("left_jobfunction_name_mod"		, $arr_ljobfunction_name_mod	);
	$smarty->assign("left_jobfunction_path"			, $arr_ljobfunction_path		);
	$smarty->assign("left_jobfunction_featured"		, $arr_ljobfunction_featured	);
	$smarty->assign("left_jobfunction_found"		, $arr_ljobfunction_found		);
	$smarty->assign("left_jobfunction_url"			, $arr_ljobfunction_url			);

	$smarty->display('package.html');	



?>