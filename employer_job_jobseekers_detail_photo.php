<?



	



	$section	= "employer";
	include("setting.php");
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	
	$sql_query  			= "SELECT * FROM jobseeker, jobseeker_photo WHERE photo_jobseeker = jobseeker_id AND photo_id = '$photo'";
	$result					= mysql_query($sql_query) or die(mysql_error());
	$row 					= mysql_fetch_array($result);
	
	$jobseeker_id			= $row[jobseeker_id];
	$jobseeker_username		= $row[jobseeker_username];
	$jobseeker_password		= $row[jobseeker_password];
	$jobseeker_title		= $row[jobseeker_title];
	$jobseeker_firstname	= $row[jobseeker_firstname];
	$jobseeker_lastname		= $row[jobseeker_lastname];
	$jobseeker_fullname		= "$jobseeker_firstname $jobseeker_lastname";

	mysql_close($db_connect);
	
	
	

	
	$smarty->assign("photo"					, $photo				);
	$smarty->assign("photo_width_popup"		, $photo_width_popup	);
	$smarty->assign("photo_height_popup"	, $photo_height_popup	);
	$smarty->assign("photo_fullname"		, $jobseeker_fullname	);
	$smarty->display('employer_job_jobseekers_detail_photo.html');	


?>