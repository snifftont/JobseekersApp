<?



	


	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	
	
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	

	$i				= 0;
	$jobseeker		= $clogin_jobseeker;

    $sql_query		= "SELECT * FROM jobseeker_document WHERE document_jobseeker = '$clogin_jobseeker' ORDER BY document_title ASC"; 
	$result			= mysql_query($sql_query) or die(mysql_error());
	$document_found	= mysql_num_rows($result);
	while ($row		= mysql_fetch_array($result)) {

		$document_id				= $row[document_id];
		$document_number			= $document_id + $start_document;
		$document_title				= $row[document_title];
		$document_title2			= str_replace("'", "\'", $document_title);
		$document_description		= $row[document_description];
		$document_file				= $row[document_file];
		$document_file_url			= "$url_document/$document_id/$document_file";
		$document_file_path			= "$dir_document/$document_id/$document_file";
		$document_url				= $row[document_url];
		$document_status			= $row[document_status];

		if ($document_status  == "pending" 		) { $document_status 	= $lang['lang_status_pending']; 	}
		if ($document_status  == "approved"		) { $document_status 	= $lang['lang_status_approved']; 	}
		if ($document_status  == "rejected"		) { $document_status 	= $lang['lang_status_rejected']; 	}
		
		if (!file_exists($document_file_path) || strlen($document_file) < 3	) { 
			$document_file_url 	= ""; 
			$document_file 		= "";
		}
		
		$arr_doc_id[$i]				= $document_id;
		$arr_doc_number[$i]			= $document_number;
		$arr_doc_title[$i]			= $document_title;
		$arr_doc_title2[$i]			= $document_title2;
		$arr_doc_description[$i]	= $document_description;
		$arr_doc_file[$i]			= $document_file;
		$arr_doc_url_file[$i]		= $document_file_url;
		$arr_doc_url_website[$i]	= $document_url;
		$arr_doc_status[$i]			= $document_status;
		$i++;

		
	}	

	mysql_close($db_connect);



	
	$smarty->assign("document_found"		, $document_found		);
	$smarty->assign("document_max"			, $max_document			);
	$smarty->assign("document_id"			, $arr_doc_id			);
	$smarty->assign("document_number"		, $arr_doc_number		);
	$smarty->assign("document_title"		, $arr_doc_title		);
	$smarty->assign("document_title2"		, $arr_doc_title2		);
	$smarty->assign("document_description"	, $arr_doc_description	);
	$smarty->assign("document_file"			, $arr_doc_file			);
	$smarty->assign("document_file_url"		, $arr_doc_url_file		);
	$smarty->assign("document_url"			, $arr_doc_url_website	);
	$smarty->assign("document_status"		, $arr_doc_status		);

	$smarty->display('jobseeker_document.html');	


?>