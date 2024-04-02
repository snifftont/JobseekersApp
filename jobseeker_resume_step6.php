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
	$sql_query	= "SELECT * FROM setup_skilllevel ORDER BY skilllevel_order ASC, skilllevel_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {

		$skilllevel_id				= $row[skilllevel_id];
		$skilllevel_name			= $row[skilllevel_name];
		$arr_skilllevel_id[$i]		= $skilllevel_id;
		$arr_skilllevel_name[$i]	= $skilllevel_name;
		$i++;
	
	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_skilllanguage ORDER BY skilllanguage_order ASC, skilllanguage_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {

		$skilllanguage_id			= $row[skilllanguage_id];
		$skilllanguage_name			= $row[skilllanguage_name];
		$arr_skilllanguage_id[$i]	= $skilllanguage_id;
		$arr_skilllanguage_name[$i]	= $skilllanguage_name;
		$i++;
	
	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_skillcomputer ORDER BY skillcomputer_order ASC, skillcomputer_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {

		$skillcomputer_id			= $row[skillcomputer_id];
		$skillcomputer_name			= $row[skillcomputer_name];
		$arr_skillcomputer_id[$i]	= $skillcomputer_id;
		$arr_skillcomputer_name[$i]	= $skillcomputer_name;
		$i++;
	
	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_skillother ORDER BY skillother_order ASC, skillother_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {

		$skillother_id				= $row[skillother_id];
		$skillother_name			= $row[skillother_name];
		$arr_skillother_id[$i]		= $skillother_id;
		$arr_skillother_name[$i]	= $skillother_name;
		$i++;
	
	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM jobseeker_language WHERE language_jobseeker = '$jobseeker' AND language_name != '' ORDER BY language_id ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while ($row	= mysql_fetch_array($result)) {
	
		if ( $i % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_language_counter[$i]		= $i + 1;
		$arr_jobseeker_language_id[$i]			= $row[language_id];
		$arr_jobseeker_language_bgcolor[$i]		= $bg_color;
		$arr_jobseeker_language_name[$i]		= $row[language_name];
		$arr_jobseeker_language_reading[$i]		= $row[language_reading];
		$arr_jobseeker_language_writting[$i]	= $row[language_writting];
		$arr_jobseeker_language_speaking[$i]	= $row[language_speaking];
		$arr_jobseeker_language_listening[$i]	= $row[language_listening];
		$i++;
	
	}

	
	for ($j=$i; $j < $row_jobseeker_language; $j++) {

		if ( $j % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_language_counter[$j]		= $j + 1;
		$arr_jobseeker_language_id[$j]			= "";
		$arr_jobseeker_language_bgcolor[$j]		= $bg_color;
		$arr_jobseeker_language_name[$j]		= "";
		$arr_jobseeker_language_reading[$j]		= "";
		$arr_jobseeker_language_writting[$j]	= "";
		$arr_jobseeker_language_speaking[$j]	= "";
		$arr_jobseeker_language_listening[$j]	= "";
	
	}
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM jobseeker_technical WHERE technical_jobseeker = '$jobseeker' AND technical_skill != '' ORDER BY technical_id ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while ($row	= mysql_fetch_array($result)) {

		if ( $i % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_technical_id[$i]			= $row[technical_id];
		$arr_jobseeker_technical_bgcolor[$i]	= $bg_color;
		$arr_jobseeker_technical_counter[$i]	= $i + 1;
		$arr_jobseeker_technical_skill[$i]		= $row[technical_skill];
		$arr_jobseeker_technical_exp[$i]		= $row[technical_exp];
		$arr_jobseeker_technical_level[$i]		= $row[technical_level];
		if (!$arr_jobseeker_technical_exp[$i]) { $jobseeker_technical_exp[$i] = 0; }
		$i++;
	
	}
	
	
	for ($j=$i; $j < $row_jobseeker_technical; $j++) {

		if ( $j % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_technical_id[$j]			= "";
		$arr_jobseeker_technical_bgcolor[$j]	= $bg_color;
		$arr_jobseeker_technical_counter[$j]	= $j + 1;
		$arr_jobseeker_technical_skill[$j]		= "";
		$arr_jobseeker_technical_exp[$j]		= "";
		$arr_jobseeker_technical_level[$j]		= "";
	
	}	
	
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM jobseeker_other WHERE other_jobseeker = '$jobseeker' AND other_skill != '' ORDER BY other_id ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while ($row	= mysql_fetch_array($result)) {

		if ( $i % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_other_id[$i]			= $row[other_id];
		$arr_jobseeker_other_bgcolor[$i]	= $bg_color;
		$arr_jobseeker_other_counter[$i]	= $i + 1;
		$arr_jobseeker_other_skill[$i]		= $row[other_skill];
		$arr_jobseeker_other_exp[$i]		= $row[other_exp];
		$arr_jobseeker_other_level[$i]		= $row[other_level];
		if (!$arr_jobseeker_other_exp[$i]) { $jobseeker_other_exp[$i] = 0; }
		$i++;
	
	}
	
	
	for ($j=$i; $j < $row_jobseeker_other; $j++) {

		if ( $j % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_other_id[$j]			= "";
		$arr_jobseeker_other_bgcolor[$j]	= $bg_color;
		$arr_jobseeker_other_counter[$j]	= $j + 1;
		$arr_jobseeker_other_skill[$j]		= "";
		$arr_jobseeker_other_exp[$j]		= "";
		$arr_jobseeker_other_level[$j]		= "";
	
	}	

	
	
	
	$smarty->assign("warning_verification_code"			, $warning_verification_code			);


	
	$smarty->assign("skilllevel_id"						, $arr_skilllevel_id					);
	$smarty->assign("skilllevel_name"					, $arr_skilllevel_name					);
	$smarty->assign("skilllanguage_id"					, $arr_skilllanguage_id					);
	$smarty->assign("skilllanguage_name"				, $arr_skilllanguage_name				);
	$smarty->assign("skillcomputer_id"					, $arr_skillcomputer_id					);
	$smarty->assign("skillcomputer_name"				, $arr_skillcomputer_name				);
	$smarty->assign("skillother_id"						, $arr_skillother_id					);
	$smarty->assign("skillother_name"					, $arr_skillother_name					);

	
	$smarty->assign("jobseeker_language_id"				, $arr_jobseeker_language_id			);
	$smarty->assign("jobseeker_language_counter"		, $arr_jobseeker_language_counter		);
	$smarty->assign("jobseeker_language_bgcolor"		, $arr_jobseeker_language_bgcolor		);
	$smarty->assign("jobseeker_language_name"			, $arr_jobseeker_language_name			);
	$smarty->assign("jobseeker_language_reading"		, $arr_jobseeker_language_reading		);
	$smarty->assign("jobseeker_language_writting"		, $arr_jobseeker_language_writting		);
	$smarty->assign("jobseeker_language_speaking"		, $arr_jobseeker_language_speaking		);
	$smarty->assign("jobseeker_language_listening"		, $arr_jobseeker_language_listening		);

	$smarty->assign("jobseeker_technical_id"			, $arr_jobseeker_technical_id			);
	$smarty->assign("jobseeker_technical_counter"		, $arr_jobseeker_technical_counter		);
	$smarty->assign("jobseeker_technical_bgcolor"		, $arr_jobseeker_technical_bgcolor		);
	$smarty->assign("jobseeker_technical_skill"			, $arr_jobseeker_technical_skill		);
	$smarty->assign("jobseeker_technical_exp"			, $arr_jobseeker_technical_exp			);
	$smarty->assign("jobseeker_technical_level"			, $arr_jobseeker_technical_level		);

	$smarty->assign("jobseeker_other_id"				, $arr_jobseeker_other_id				);
	$smarty->assign("jobseeker_other_counter"			, $arr_jobseeker_other_counter			);
	$smarty->assign("jobseeker_other_bgcolor"			, $arr_jobseeker_other_bgcolor			);
	$smarty->assign("jobseeker_other_skill"				, $arr_jobseeker_other_skill			);
	$smarty->assign("jobseeker_other_exp"				, $arr_jobseeker_other_exp				);
	$smarty->assign("jobseeker_other_level"				, $arr_jobseeker_other_level			);


	$smarty->assign("status_img_captcha"				, $status_img_captcha					);
	$smarty->display('jobseeker_resume_step6.html');	



?>