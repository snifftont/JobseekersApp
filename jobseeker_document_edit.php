<?



	


	$section	= "jobseeker";
	$jobseeker	= $clogin_jobseeker;

	include("setting.php");
	include("jobseeker_check.php");


    $db_connect	= mysql_connect($db_host, $db_username, $db_password);
    mysql_select_db($db_name, $db_connect) || die(mysql_error());
    
    $sql_query				= "SELECT * FROM jobseeker_document WHERE document_id = '$document'";
    $result					= mysql_query($sql_query) or die(mysql_error());
    $row					= mysql_fetch_array($result);
	$document_jobseeker		= $row[document_jobseeker];
	$document_title			= $row[document_title];
	$document_description	= $row[document_description];
	$document_file			= $row[document_file];
	$document_file_url		= "$url_document/$document/$document_file";
	$document_url			= $row[document_url];
	
	mysql_close($db_connect);	


	if ($document_jobseeker != $clogin_jobseeker) { 
		header("Location:jobseeker_document.php");
	}


	
    if ($cdocument_title_warn		)	{ $warning_document_title		= "warning"; } else { $warning_document_title		= "normal_12_black"; }
    if ($cdocument_url_warn			)	{ $warning_document_url			= "warning"; } else { $warning_document_url			= "normal_12_black"; }
    if ($cdocument_file_warn		)	{ $warning_document_file		= "warning"; } else { $warning_document_file		= "normal_12_black"; }
    if ($cdocument_description_warn	)	{ $warning_document_description	= "warning"; } else { $warning_document_description	= "normal_12_black"; }


	
	$smarty->assign("document"						, $document						);
	$smarty->assign("document_title"				, $document_title				);
	$smarty->assign("document_file"					, $document_file				);
	$smarty->assign("document_file_url"				, $document_file_url			);
	$smarty->assign("document_url"					, $document_url					);
	$smarty->assign("document_description"			, $document_description			);

	$smarty->assign("warning_document_title"		, $warning_document_title		);
	$smarty->assign("warning_document_url"			, $warning_document_url			);
	$smarty->assign("warning_document_file"			, $warning_document_file		);
	$smarty->assign("warning_document_description"	, $warning_document_description	);
	$smarty->display('jobseeker_document_edit.html');	


?>