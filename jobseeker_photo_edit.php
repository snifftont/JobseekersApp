<?



	


	$section	= "jobseeker";
	$jobseeker	= $clogin_jobseeker;
	include("setting.php");
	include("jobseeker_check.php");
	

    $db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
			
    $sql_query			= "SELECT * FROM jobseeker_photo WHERE photo_id = '$photo'";
	$result				= mysql_query($sql_query) or die(mysql_error());
    $row				= mysql_fetch_array($result);
    $photo_jobseeker	= $row[photo_jobseeker];
    mysql_close($db_connect);


	if ($photo_jobseeker != $clogin_jobseeker) { 
		header("Location:jobseeker_photo.php");
	}


	
	$smarty->assign("photo"				, $photo				);
	$smarty->assign("photo_width"		, $photo_width_photo	);
	$smarty->assign("photo_height"		, $photo_height_photo	);

	$smarty->display('jobseeker_photo_edit.html');	


?>