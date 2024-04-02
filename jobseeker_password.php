<?



	

	$section	= "jobseeker";
	include("setting.php");
	


	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);
	


	
    if ($cjobseeker_email_warn		)	{ $warning_jobseeker_email		= "warning"; } else { $warning_jobseeker_email		= "normal_12_black"; }
    if ($cverification_code_warn	)	{ $warning_verification_code	= "warning"; } else { $warning_verification_code	= "normal_12_black"; }

	
	$smarty->assign("warning_jobseeker_email"		, $warning_jobseeker_email		);
	$smarty->assign("warning_verification_code"		, $warning_verification_code	);
	$smarty->display('jobseeker_password.html');	


?>