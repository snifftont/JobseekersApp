<?



	


	$section	= "jobseeker";
	$jobseeker	= $clogin_jobseeker;

	include("setting.php");
	include("jobseeker_check.php");
	

	
    if ($cdocument_title_warn		)	{ $warning_document_title		= "warning"; } else { $warning_document_title		= "normal_12_black"; }
    if ($cdocument_url_warn			)	{ $warning_document_url			= "warning"; } else { $warning_document_url			= "normal_12_black"; }
    if ($cdocument_file_warn		)	{ $warning_document_file		= "warning"; } else { $warning_document_file		= "normal_12_black"; }
    if ($cdocument_description_warn	)	{ $warning_document_description	= "warning"; } else { $warning_document_description	= "normal_12_black"; }


	
	$smarty->assign("cdocument_title"				, $cdocument_title				);
	$smarty->assign("cdocument_url"					, $cdocument_url				);
	$smarty->assign("cdocument_description"			, $cdocument_description		);

	$smarty->assign("warning_document_title"		, $warning_document_title		);
	$smarty->assign("warning_document_url"			, $warning_document_url			);
	$smarty->assign("warning_document_file"			, $warning_document_file		);
	$smarty->assign("warning_document_description"	, $warning_document_description	);
	$smarty->display('jobseeker_document_add.html');	


?>