<?



	

	$section	= "jobseeker";
	include("setting.php");
	

	if ($clogin_jobseeker) {
		header("location:jobseeker_home.php");
	}


	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);
	


	
    if ($cjobseeker_username_warn			)	{ $warning_jobseeker_username		= "warning"; } else { $warning_jobseeker_username		= "normal_12_black"; }
    if ($cjobseeker_password_warn			)	{ $warning_jobseeker_password		= "warning"; } else { $warning_jobseeker_password		= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code		= "warning"; } else { $warning_verification_code		= "normal_12_black"; }

	
	$smarty->assign("warning_jobseeker_username"	, $warning_jobseeker_username		);
	$smarty->assign("warning_jobseeker_password"	, $warning_jobseeker_password		);
	$smarty->assign("warning_verification_code"		, $warning_verification_code		);

	
	$smarty->assign("cjobseeker_username"			, $cjobseeker_username				);
	$smarty->assign("cjobseeker_password"			, $cjobseeker_password				);

	$smarty->display('jobseeker_login.html');	



?>