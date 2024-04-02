<?



	

	$section	= "employer";
	include("setting.php");
	


	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);
	


	
    if ($cemployer_email_warn		)	{ $warning_employer_email		= "warning"; } else { $warning_employer_email		= "normal_12_black"; }
    if ($cverification_code_warn	)	{ $warning_verification_code	= "warning"; } else { $warning_verification_code	= "normal_12_black"; }

	
	$smarty->assign("warning_employer_email"		, $warning_employer_email		);
	$smarty->assign("warning_verification_code"		, $warning_verification_code	);
	$smarty->display('employer_password.html');	


?>