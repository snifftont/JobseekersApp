<?



	


	$section	= "jobseeker";
	$jobseeker	= $clogin_jobseeker;
	include("setting.php");
	include("jobseeker_check.php");
	
	

	
	for ($i=0; $i<= $row_photo_add - 1; $i++) {
		$arr_photo_row[$i] = $i + 1;
	}
	


	
	$smarty->assign("photo_row"		, $arr_photo_row	);
	$smarty->display('jobseeker_photo_add.html');	


?>