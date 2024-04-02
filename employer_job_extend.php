<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	$sql_query  		= "SELECT * FROM job WHERE job_id = '$job'";
	$result				= mysql_query($sql_query) or die(mysql_error());													
	$row				= mysql_fetch_array($result);
	
	$job_id				= $row[job_id];
	$job_number			= $job_id + $start_job;
	$job_title			= $row[job_title];
	$job_employer		= $row[job_employer];
	$job_package		= $row[job_package];
	$job_date_expire	= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_expire], $date_format);
	mysql_close($db_connect);



	
	if ($job_employer != $clogin_employer) { 
		header("Location:employer_job.php");
	}


	
	header("location:employer_job_upgrade_calculation.php?job=$job&package=$job_package");
	

?>