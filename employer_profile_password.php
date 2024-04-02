<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$employer	= $clogin_employer;
	
	
	
	
    if ($cemployer_password_warn			)	{ $warning_employer_password			= "warning"; } else { $warning_employer_password			= "normal_12_black"; }
    if ($cemployer_password_confirm_warn	)	{ $warning_employer_password_confirm	= "warning"; } else { $warning_employer_password_confirm	= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code			= "warning"; } else { $warning_verification_code			= "normal_12_black"; }




	

	$smarty->assign("warning_employer_username"			, $warning_employer_username			);
	$smarty->assign("warning_employer_password"			, $warning_employer_password			);
	$smarty->assign("warning_employer_password_confirm"	, $warning_employer_password_confirm	);
	$smarty->assign("warning_verification_code"			, $warning_verification_code			);
	$smarty->assign("status_img_captcha"				, $status_img_captcha					);

	$smarty->display('employer_profile_password.html');	



?>