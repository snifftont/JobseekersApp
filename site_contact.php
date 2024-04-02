<?



	

	$section	= "contact";
	include("setting.php");


	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);


	
    if ($ccontact_from_name_warn	)	{ $warning_contact_from_name	= "warning"; } else { $warning_contact_from_name	= "normal_12_black"; }
    if ($ccontact_from_email_warn	)	{ $warning_contact_from_email	= "warning"; } else { $warning_contact_from_email	= "normal_12_black"; }
    if ($ccontact_subject_warn		)	{ $warning_contact_subject		= "warning"; } else { $warning_contact_subject		= "normal_12_black"; }
    if ($ccontact_message_warn		)	{ $warning_contact_message		= "warning"; } else { $warning_contact_message		= "normal_12_black"; }
    if ($ccontact_code_warn			)	{ $warning_contact_code			= "warning"; } else { $warning_contact_code			= "normal_12_black"; }


    
	$smarty->assign("page_title"					, $page_name					);
	$smarty->assign("page_content" 					, $page_content					);

	$smarty->assign("warning_message"				, $warning						);
	$smarty->assign("warning_contact_from_name"		, $warning_contact_from_name	);
	$smarty->assign("warning_contact_from_email"	, $warning_contact_from_email	);
	$smarty->assign("warning_contact_subject"		, $warning_contact_subject		);
	$smarty->assign("warning_contact_message"		, $warning_contact_message		);
	$smarty->assign("warning_contact_code"			, $warning_contact_code			);

	$smarty->assign("ccontact_from_name"			, $ccontact_from_name			);
	$smarty->assign("ccontact_from_email"			, $ccontact_from_email			);
	$smarty->assign("ccontact_subject"				, $ccontact_subject				);
	$smarty->assign("ccontact_message"				, $ccontact_message				);

	$smarty->display('site_contact.html');	


?>