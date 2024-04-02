<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker							= $clogin_jobseeker;
	$sql_query  						= "SELECT * FROM jobseeker WHERE jobseeker_id = '$jobseeker'";
	$result								= mysql_query($sql_query) or die(mysql_error());
	$row 								= mysql_fetch_array($result);
	$jobseeker_education_certification	= $row[jobseeker_education_certification];




	
	$i			= 0;
	$sql_query	= "
	SELECT * FROM jobseeker_education 
	WHERE 
	education_jobseeker  = '$jobseeker' AND
	education_start		!= ''			AND
	education_end		!= ''			AND
	education_school	!= ''			
	ORDER BY education_start ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while ($row	= mysql_fetch_array($result)) {
	
		if ( $i % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_education_counter[$i]		= $i + 1;
		$arr_jobseeker_education_id[$i]				= $row[education_id];
		$arr_jobseeker_education_bgcolor[$i]		= $bg_color;
		$arr_jobseeker_education_year_start[$i]		= $row[education_start];
		$arr_jobseeker_education_year_end[$i]		= $row[education_end];
		$arr_jobseeker_education_school[$i]			= $row[education_school];
		$arr_jobseeker_education_qualification[$i]	= $row[education_qualification];
		$arr_jobseeker_education_major[$i]			= $row[education_major];
		$arr_jobseeker_education_gpa[$i]			= $row[education_gpa];
		$i++;

	
	}
	
	
	
	
	
	for ($j=$i; $j < $row_jobseeker_education; $j++) {

		if ( $j % 2 == 0 )	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; }

		$arr_jobseeker_education_counter[$j]		= $j + 1;
		$arr_jobseeker_education_id[$j]				= $row[education_id];
		$arr_jobseeker_education_bgcolor[$j]		= $bg_color;
		$arr_jobseeker_education_year_start[$j]		= "";
		$arr_jobseeker_education_year_end[$j]		= "";
		$arr_jobseeker_education_school[$j]			= "";
		$arr_jobseeker_education_qualification[$j]	= "";
		$arr_jobseeker_education_major[$j]			= "";
		$arr_jobseeker_education_gpa[$j]			= "";
	
	}
		

	
	
	
	$smarty->assign("warning_verification_code"			, $warning_verification_code			);

	
	$smarty->assign("jobseeker_education_id"			, $arr_jobseeker_education_id				);
	$smarty->assign("jobseeker_education_counter"		, $arr_jobseeker_education_counter			);
	$smarty->assign("jobseeker_education_bgcolor"		, $arr_jobseeker_education_bgcolor			);
	$smarty->assign("jobseeker_education_year_start"	, $arr_jobseeker_education_year_start		);
	$smarty->assign("jobseeker_education_year_end"		, $arr_jobseeker_education_year_end			);
	$smarty->assign("jobseeker_education_school"		, $arr_jobseeker_education_school			);
	$smarty->assign("jobseeker_education_qualification"	, $arr_jobseeker_education_qualification	);
	$smarty->assign("jobseeker_education_major"			, $arr_jobseeker_education_major			);
	$smarty->assign("jobseeker_education_gpa"			, $arr_jobseeker_education_gpa				);
	$smarty->assign("jobseeker_education_certification"	, $jobseeker_education_certification		);
	$smarty->assign("status_img_captcha"				, $status_img_captcha					);
	$smarty->display('jobseeker_resume_step5.html');	



?>