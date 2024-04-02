<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$payment_number					= $payment;
	$payment_id						= $payment - $start_payment;
	
	$sql_query  					= "SELECT * FROM employer_payment WHERE payment_id = '$payment_id'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$payment_employer				= $row[payment_employer];
	$payment_subscription_package	= $row[payment_subscription_package];
	$payment_subscription_days		= $row[payment_subscription_days];
	$payment_amount					= $row[payment_amount];
	$payment_amount					= $pcurrency_symbol . number_format($payment_amount	, 2, $web_decimal_separator, $web_thousand_separator);

	

	
	$sql_query  					= "SELECT * FROM employer WHERE employer_id = '$payment_employer'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$employer_id					= $row[employer_id];
	$employer_number				= $employer_id + $start_employer;
	$employer_company				= $row[employer_company];
	$employer_firstname				= $row[employer_firstname];
	$employer_lastname				= $row[employer_lastname];
	$employer_email					= $row[employer_email];
	$employer_type					= $row[employer_type];
	$employer_package				= $row[employer_package];
	$employer_package_payment		= $row[employer_package_payment];
	$employer_date_expired			= F2BE712F08F5878F1C8F3DFF139674C86($row[employer_date_expired], $date_format);
		

	
	$sql_query	        			= "SELECT * FROM setup_package_subscription WHERE package_id = '$employer_package'";
	$result		        			= mysql_query($sql_query) or die(mysql_error());
	$row		        			= mysql_fetch_array($result);
	$employer_package_id		   	= $row[package_id];
	$employer_package_name			= $row[package_name];
	$employer_package_price_1m		= $row[package_price_1m];
	$employer_package_price_3m		= $row[package_price_3m];
	$employer_package_price_6m		= $row[package_price_6m];
	$employer_package_price_12m		= $row[package_price_12m];
	$employer_package_listing		= $row[package_listing];
	$employer_package_picture		= $row[package_picture];
	$employer_package_video			= $row[package_video];
	$employer_package_doc			= $row[package_doc];
	$employer_package_map			= $row[package_map];
	
	if ($employer_package_payment	== "1m" ) { $employer_package_price	= $employer_package_price_1m; 	$employer_package_days = 30;	}
	if ($employer_package_payment	== "3m" ) { $employer_package_price	= $employer_package_price_3m; 	$employer_package_days = 90;	}
	if ($employer_package_payment	== "6m" ) { $employer_package_price	= $employer_package_price_6m; 	$employer_package_days = 180;	}
	if ($employer_package_payment	== "12m") { $employer_package_price	= $employer_package_price_12m; 	$employer_package_days = 365;	}

	$employer_package_price_text	= $pcurrency_symbol . number_format($employer_package_price, 2, $web_decimal_separator, $web_thousand_separator);
	
	

	
	$sql_query	        			= "SELECT * FROM setup_package_subscription WHERE package_id = '$payment_subscription_package'";
	$result		       				= mysql_query($sql_query) or die(mysql_error());
	$row		        			= mysql_fetch_array($result);
	$package_id		    			= $row[package_id];
	$package_name					= $row[package_name];
	$package_price_1m				= $row[package_price_1m];
	$package_price_3m				= $row[package_price_3m];
	$package_price_6m				= $row[package_price_6m];
	$package_price_12m				= $row[package_price_12m];
	$package_listing				= $row[package_listing];
	$package_picture				= $row[package_picture];
	$package_video					= $row[package_video];
	$package_doc					= $row[package_doc];
	$package_map					= $row[package_map];



	
	if ($job_employer != $clogin_employer) { 
		
	}



	
	$smarty->assign("employer_company"				, $employer_company				);
	$smarty->assign("employer_date_expired"			, $employer_date_expired		);
	$smarty->assign("employer_package_name"			, $employer_package_name		);
	$smarty->assign("employer_package_price_text"	, $employer_package_price_text	);
	$smarty->assign("employer_package_payment"		, $employer_package_payment		);
	$smarty->assign("payment_number"				, $payment_number				);
	$smarty->assign("payment_amount"				, $payment_amount				);
	$smarty->assign("status_img_captcha"			, $status_img_captcha			);
	$smarty->display('employer_subscription_payment_cod.html');	



?>