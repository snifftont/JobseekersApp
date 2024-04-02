<?



	


	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	
	
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	

	$jobseeker				= $clogin_jobseeker;
	$sql_query  			= "SELECT * FROM jobseeker WHERE jobseeker_id = '$clogin_jobseeker'";
	$result					= mysql_query($sql_query) or die(mysql_error());
	$row 					= mysql_fetch_array($result);
	$jobseeker_id			= $row[jobseeker_id];
	$jobseeker_username		= $row[jobseeker_username];
	$jobseeker_password		= $row[jobseeker_password];
	$jobseeker_firstname	= $row[jobseeker_firstname];
	$jobseeker_lastname		= $row[jobseeker_lastname];
	$jobseeker_fullname		= "$jobseeker_title $jobseeker_firstname $jobseeker_lastname";


	

	$trow          	= 0;
	$sql_query		= "SELECT * FROM jobseeker_photo WHERE photo_jobseeker = '$clogin_jobseeker'";
	$result			= mysql_query($sql_query) or die(mysql_error());
	$photo_found	= mysql_num_rows($result);
	while ($row		= mysql_fetch_array($result)) {

		$photo_id						= $row[photo_id];
		$photo_number					= $photo_id + $start_photo;
		$photo_jobseeker  				= $row[photo_jobseeker];
		$photo_status   				= strtoupper($lang['lang_status_'. strtolower($row[photo_status]) ]);
		$photo_main						= $row[photo_main];
		
		$arr_photo_row_id[$trow]		= $photo_id;
		$arr_photo_row_number[$trow]	= $photo_number;
		$arr_photo_row_status[$trow]	= $photo_status;
		$arr_photo_row_main[$trow]		= $photo_main;
		
		
		for ($tcol=0; $tcol<=3; $tcol++) {
		
			if ($row		= mysql_fetch_array($result)) {

				$photo_id								= $row[photo_id];
				$photo_number							= $photo_id + $start_photo;
				$photo_jobseeker  						= $row[photo_jobseeker];
				$photo_status   						= strtoupper($lang['lang_status_'. strtolower($row[photo_status]) ]);
				$photo_main								= $row[photo_main];
				
				$arr_photo_col_id[$trow][$tcol]			= $photo_id;
				$arr_photo_col_number[$trow][$tcol]		= $photo_number;
				$arr_photo_col_status[$trow][$tcol]		= $photo_status;
				$arr_photo_col_main[$trow][$tcol]		= $photo_main;

			} 
		
		} 
		$trow++;
		
	}	

	mysql_close($db_connect);



	
	$smarty->assign("photo_found"			, $photo_found					);
	$smarty->assign("photo_width_thumb"		, $photo_width_thumb			);
	$smarty->assign("photo_height_thumb"	, $photo_height_thumb			);

	$smarty->assign("row_photo_id"			, $arr_photo_row_id				);
	$smarty->assign("row_photo_number"		, $arr_photo_row_number			);
	$smarty->assign("row_photo_status"		, $arr_photo_row_status			);
	$smarty->assign("row_photo_main"		, $arr_photo_row_main			);

	$smarty->assign("col_photo_id"			, $arr_photo_col_id				);
	$smarty->assign("col_photo_number"		, $arr_photo_col_number			);
	$smarty->assign("col_photo_status"		, $arr_photo_col_status			);
	$smarty->assign("col_photo_main"		, $arr_photo_col_main			);

	$smarty->display('jobseeker_photo.html');	


?>