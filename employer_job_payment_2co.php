<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$payment_number			= $payment;
	$payment_id				= $payment - $start_payment;
	
	$sql_query  			= "SELECT * FROM employer_payment WHERE payment_id = '$payment_id'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	$payment_job			= $row[payment_job];
	$payment_job_package	= $row[payment_job_package];
	$payment_employer		= $row[payment_employer];
	$payment_amount			= $row[payment_amount];
	$payment_amount			= $pcurrency_symbol . number_format($payment_amount	, 2, $web_decimal_separator, $web_thousand_separator);

	$payment_text			= $p2co_payment_text;
	$payment_text			= str_replace("[payment_website]"	, $web_name			, $payment_text);
	$payment_text			= str_replace("[payment_number]"	, $payment_number	, $payment_text);
	$payment_amount_2co		= $row[payment_amount];

	if($web_payment_2co_mode == "demo") {$web_payment_2co_mode = "Y"; }
	if($web_payment_2co_mode == "real") {$web_payment_2co_mode = "N"; }



	
	$sql_query  			= "SELECT * FROM employer, setup_country WHERE employer_id = '$payment_employer' AND employer_country = country_id";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	$employer_id			= $row[employer_id];
	$employer_number		= $employer_id + $start_employer;
	$employer_company		= $row[employer_company];
	$employer_firstname		= $row[employer_firstname];
	$employer_lastname		= $row[employer_lastname];
	$employer_fullname		= "$employer_firstname $employer_lastname";
	$employer_address		= $row[employer_address];
	$employer_address2		= $row[employer_address2];
	$employer_city			= $row[employer_city];
	$employer_state			= $row[employer_state];
	$employer_zip			= $row[employer_zip];
	$employer_country		= $row[country_name];
	$employer_phone			= $row[employer_phone];
	$employer_email			= $row[employer_email];




	
	$sql_query  			= "SELECT * FROM job WHERE job_id = '$payment_job'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	$job_id					= $row[job_id];
	$job_number				= $job_id + $start_job;
	$job_title				= $row[job_title];
	$job_employer			= $row[job_employer];
	$job_package			= $row[job_package];
	$job_date_expire		= F2BE712F08F5878F1C8F3DFF139674C86($row[job_date_expire], $date_format);




	$sql_query				= "SELECT * FROM setup_package WHERE package_id = '$job_package'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	$job_package_id			= $row[package_id];
	$job_package_name		= $row[package_name];
	$job_package_price		= $row[package_price];
	$job_package_price		= $pcurrency_symbol . number_format($job_package_price, 2, $web_decimal_separator, $web_thousand_separator);
	$job_package_price2		= $row[package_price];
	$job_package_days		= $row[package_days];
	$job_package_chars		= $row[package_chars];
	$job_package_renewable	= $row[package_renewable];	



	
	if ($job_employer != $clogin_employer) { 
		
	}




	

	
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

	$smarty->assign("payment_number"			, $payment_number				);
	$smarty->assign("payment_amount"			, $payment_amount				);

	$smarty->assign("2co_sid"					, $web_payment_2co_store		); 			
	$smarty->assign("2co_total"					, $payment_amount_2co			); 			
	$smarty->assign("2co_order_id"				, $payment_number				); 			
	$smarty->assign("2co_order_text"			, $payment_text					); 			
	$smarty->assign("2co_mode"					, $web_payment_2co_mode			); 			
	$smarty->assign("2co_fullname"				, $employer_fullname			); 			
	$smarty->assign("2co_street_address"		, $employer_address				); 			
	$smarty->assign("2co_city"					, $employer_city				); 			
	$smarty->assign("2co_state"					, $employer_state				); 			
	$smarty->assign("2co_zip"					, $employer_zip					); 			
	$smarty->assign("2co_country"				, $employer_country				); 			
	$smarty->assign("2co_email"					, $employer_email				); 			
	$smarty->assign("2co_phone"					, $employer_phone				); 

	$smarty->assign("status_img_captcha"		, $status_img_captcha			);
	$smarty->display('employer_job_payment_2co.html');	



?>