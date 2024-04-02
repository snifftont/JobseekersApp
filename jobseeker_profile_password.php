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
	
	
	
	
    if ($cjobseeker_password_warn			)	{ $warning_jobseeker_password			= "warning"; } else { $warning_jobseeker_password			= "normal_12_black"; }
    if ($cjobseeker_password_confirm_warn	)	{ $warning_jobseeker_password_confirm	= "warning"; } else { $warning_jobseeker_password_confirm	= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code			= "warning"; } else { $warning_verification_code			= "normal_12_black"; }




	

	$smarty->assign("warning_jobseeker_username"			, $warning_jobseeker_username			);
	$smarty->assign("warning_jobseeker_password"			, $warning_jobseeker_password			);
	$smarty->assign("warning_jobseeker_password_confirm"	, $warning_jobseeker_password_confirm	);
	$smarty->assign("warning_verification_code"				, $warning_verification_code			);
	$smarty->assign("status_img_captcha"					, $status_img_captcha					);

	$smarty->display('jobseeker_profile_password.html');	



?>