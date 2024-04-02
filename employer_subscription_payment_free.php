<?



	



	$section	= "employer";
	include("setting.php");
	

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
	
	
	$sql_query  					= "SELECT * FROM employer WHERE employer_id = '$payment_employer'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$employer_id					= $row[employer_id];
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
	
	if ($employer_package_payment	== "1m" ) { $employer_package_payment_text	= $employer_package_price_1m; 	}
	if ($employer_package_payment	== "3m" ) { $employer_package_payment_text	= $employer_package_price_3m; 	}
	if ($employer_package_payment	== "6m" ) { $employer_package_payment_text	= $employer_package_price_6m; 	}
	if ($employer_package_payment	== "12m") { $employer_package_payment_text	= $employer_package_price_12m; 	}
	
	$employer_package_payment_text	= $pcurrency_symbol . number_format($employer_package_payment_text, 2, $web_decimal_separator, $web_thousand_separator);

	
	
	
	$smarty->assign("employer_package_id"			, $employer_package_id				);
	$smarty->assign("employer_package_name"			, $employer_package_name			);
	$smarty->assign("employer_package_payment"		, $employer_package_payment			);
	$smarty->assign("employer_package_price_1m"		, $employer_package_price_1m		);
	$smarty->assign("employer_package_payment_text"	, $employer_package_payment_text	);
	$smarty->assign("employer_date_expired"			, $employer_date_expired			);
	$smarty->assign("payment_details"				, $payment_details					);
	$smarty->display('employer_subscription_payment_free.html');	



?>