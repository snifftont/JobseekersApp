<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker			= $clogin_jobseeker;
	$sql_query  		= "SELECT * FROM jobseeker WHERE jobseeker_id = '$jobseeker'";
	$result				= mysql_query($sql_query) or die(mysql_error());
	$row 				= mysql_fetch_array($result);
	$jobseeker_summary	= $row[jobseeker_summary];


	
	
    if ($cjobseeker_summary_warn	)	{ $warning_jobseeker_summary	= "warning"; 			} 
	else 								{ $warning_jobseeker_summary	= "normal_12_black"; 	}

	
	$smarty->assign("warning_jobseeker_summary"			, $warning_jobseeker_summary			);
	$smarty->assign("warning_verification_code"			, $warning_verification_code			);

	
	$smarty->assign("jobseeker_summary"					, $jobseeker_summary					);
	$smarty->assign("status_img_captcha"				, $status_img_captcha					);
	$smarty->display('jobseeker_resume_step4.html');	



?>