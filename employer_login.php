<?



	



	$section	= "employer";
	include("setting.php");
	


	if ($clogin_employer) {
		header("location:employer_home.php");
	}



	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);
	


	
    if ($cemployer_username_warn			)	{ $warning_employer_username		= "warning"; } else { $warning_employer_username		= "normal_12_black"; }
    if ($cemployer_password_warn			)	{ $warning_employer_password		= "warning"; } else { $warning_employer_password		= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code		= "warning"; } else { $warning_verification_code		= "normal_12_black"; }

	
	$smarty->assign("warning_employer_username"		, $warning_employer_username		);
	$smarty->assign("warning_employer_password"		, $warning_employer_password		);
	$smarty->assign("warning_verification_code"		, $warning_verification_code		);

	
	$smarty->assign("cemployer_username"			, $cemployer_username				);
	$smarty->assign("cemployer_password"			, $cemployer_password				);

	$smarty->display('employer_login.html');	


?>