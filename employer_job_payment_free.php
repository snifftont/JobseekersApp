<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	$payment_id						= $payment - $start_payment;
	$sql_query						= "SELECT * FROM employer_payment WHERE payment_id = '$payment_id'";
	$result							= mysql_query($sql_query) or die(mysql_error());
	$row							= mysql_fetch_array($result);
	$payment_id						= $row[payment_id];
	$payment_type					= $row[payment_type];
	$payment_employer				= $row[payment_employer];
	$payment_details				= $row[payment_details];
	$payment_discount_code			= $row[payment_discount_code];
	$payment_amount					= $row[payment_amount];
	$payment_amount_required		= $row[payment_amount_required];
	$payment_amount_disc			= $row[payment_amount_disc];
	$payment_amount_prorated		= $row[payment_amount_prorated];
	$payment_date					= $row[payment_date];
	$payment_job					= $row[payment_job];
	$payment_job_package			= $row[payment_job_package];
	$payment_job_days				= $row[payment_job_days];
	$payment_subscription			= $row[payment_subscription];
	$payment_subscription_package	= $row[payment_subscription_package];
	$payment_subscription_days		= $row[payment_subscription_days];
	$payment_status					= $row[payment_status];


	$sql_query  					= "SELECT * FROM job WHERE job_id = '$payment_job'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$job_id							= $row[job_id];
	$job_number						= $job_id + $start_job;
	$job_title						= $row[job_title];
	$job_employer					= $row[job_employer];
	$job_package					= $row[job_package];
	$job_date_expire				= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_expire], $date_format);


	$sql_query						= "SELECT * FROM setup_package WHERE package_id = '$job_package'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$job_package_id					= $row[package_id];
	$job_package_name				= $row[package_name];
	$job_package_price				= $row[package_price];
	$job_package_price				= $pcurrency_symbol . number_format($job_package_price, 2, $web_decimal_separator, $web_thousand_separator);
	$job_package_price2				= $row[package_price];
	$job_package_days				= $row[package_days];
	$job_package_chars				= $row[package_chars];
	$job_package_renewable			= $row[package_renewable];	



	
	$smarty->assign("job_id"					, $job_id						);
	$smarty->assign("job_number"				, $job_number					);
	$smarty->assign("job_title"					, $job_title					);
	$smarty->assign("job_date_expire"			, $job_date_expire				);
	$smarty->assign("job_package_id"			, $job_package_id				);
	$smarty->assign("job_package_name"			, $job_package_name				);
	$smarty->assign("job_package_price"			, $job_package_price			);
	$smarty->assign("job_package_price2"		, $job_package_price2			);
	$smarty->assign("job_package_days"			, $job_package_days				);
	$smarty->assign("job_package_chars"			, $job_package_chars			);
	$smarty->assign("job_package_renewable"		, $job_package_renewable		);
	$smarty->assign("payment_details"			, $payment_details				);

	$smarty->assign("status_img_captcha"		, $status_img_captcha			);
	$smarty->display('employer_job_payment_free.html');	



?>