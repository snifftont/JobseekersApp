<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker	= $clogin_jobseeker;
	
	$i			= 0;
	$sql_query	= "SELECT * FROM jobseeker_workhistory WHERE history_jobseeker = '$jobseeker' ORDER BY history_end_present DESC, history_end DESC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$found		= mysql_num_rows($result);
	while($row	= mysql_fetch_array($result)) {

		$history_id				= $row[history_id];
		$history_jobseeker		= $row[history_jobseeker];
		$history_start			= $row[history_start];
		$history_end			= $row[history_end];
		$history_end_present	= $row[history_end_present];
		$history_company		= $row[history_company];
		$history_company2		= str_replace("'", "\'", $history_company);
		$history_industry		= $row[history_industry];
		$history_jobfunction	= $row[history_jobfunction];
		$history_position		= $row[history_position];
		$history_salary			= $row[history_salary];
		$history_salary			= "$currency_symbol " . number_format($history_salary, 2, $web_decimal_separator, $web_thousand_separator);
		$history_achievement	= $row[history_achievement];
		$history_achievement	= str_replace("\n", "<br>", $history_achievement);
		
		
		if ( $i % 2 == 0 )		{ $bgcolor = "FFFFFF"; } 
		else 					{ $bgcolor = "EAF2FF"; }

		$sql_query				= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$history_jobfunction'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_jobfunction	= $row_tmp[jobfunction_name];

		$sql_query				= "SELECT * FROM setup_industry WHERE industry_id = '$history_industry'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_industry		= $row_tmp[industry_name];

		$history_start			= str_replace(" 00:00:00", "", $history_start);
		list ($yy, $mm, $dd)	= split("-", $history_start);
		$history_start_month	= $setup_monthname[$mm * 1];
		$history_start_year		= $yy;
		$history_start			= "$history_start_month $history_start_year";

		$history_end			= str_replace(" 00:00:00", "", $history_end);
		list ($yy, $mm, $dd)	= split("-", $history_end);
		$history_end_month		= $setup_monthname[$mm * 1];
		$history_end_year		= $yy;
		$history_end			= "$history_end_month $history_end_year";
		if ($history_end_present == "Y") { $history_end = $lang[lang_jobseeker_resume5_form_field_period_present]; }
		
		
		
		$arr_history_id[$i]				= $history_id;
		$arr_history_bgcolor[$i]		= $bgcolor;
		$arr_history_start[$i]			= $history_start;
		$arr_history_end[$i]			= $history_end;
		$arr_history_end_present[$i]	= $history_end_present;
		$arr_history_company[$i]		= $history_company;
		$arr_history_company2[$i]		= $history_company2;
		$arr_history_industry[$i]		= $history_industry;
		$arr_history_jobfunction[$i]	= $history_jobfunction;
		$arr_history_position[$i]		= $history_position;
		$arr_history_salary[$i]			= $history_salary;
		$arr_history_achievement[$i]	= $history_achievement;
		$i++;

	}
		

	
	
	
	$smarty->assign("history_found"			, $found						);
	$smarty->assign("history_id"			, $arr_history_id				);
	$smarty->assign("history_bgcolor"		, $arr_history_bgcolor			);
	$smarty->assign("history_start"			, $arr_history_start			);
	$smarty->assign("history_end"			, $arr_history_end				);
	$smarty->assign("history_end_present"	, $arr_history_end_present		);
	$smarty->assign("history_company"		, $arr_history_company			);
	$smarty->assign("history_company2"		, $arr_history_company2			);
	$smarty->assign("history_industry"		, $arr_history_industry			);
	$smarty->assign("history_jobfunction"	, $arr_history_jobfunction		);
	$smarty->assign("history_position"		, $arr_history_position			);
	$smarty->assign("history_salary"		, $arr_history_salary			);
	$smarty->assign("history_achievement"	, $arr_history_achievement		);
	$smarty->display('jobseeker_resume_step7.html');	



?>