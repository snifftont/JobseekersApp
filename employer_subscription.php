<?



	



	$section	= "employer";
	include("setting.php");



	setcookie("cpromo_disc"		, ""	);
	setcookie("cpromo_code"		, ""	);
	setcookie("cpromo_warning"	, ""	);
		

	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	


	
	$sql_query  					= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
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




	$i			= 0;
	$sql_query	= "SELECT * FROM setup_package_subscription ORDER BY package_price_1m ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());													
	while($row	= mysql_fetch_array($result)) {

		$package_id		    		= $row[package_id];
		$package_name				= $row[package_name];
		$package_listing			= $row[package_listing];
		$package_map				= $row[package_map];

		$package_price				= $row[package_price_1m];
		$package_price_1m			= $row[package_price_1m];
		$package_price_3m			= $row[package_price_3m];
		$package_price_6m			= $row[package_price_6m];
		$package_price_12m			= $row[package_price_12m];

		$package_price_1m			= number_format($package_price_1m, 2, $web_decimal_separator, $web_thousand_separator);
		$package_price_3m			= number_format($package_price_3m, 2, $web_decimal_separator, $web_thousand_separator);
		$package_price_6m			= number_format($package_price_6m, 2, $web_decimal_separator, $web_thousand_separator);
		$package_price_12m			= number_format($package_price_12m, 2, $web_decimal_separator, $web_thousand_separator);
		
		$arr_package_id[$i]			= $package_id;
		$arr_package_name[$i]		= $package_name;
		$arr_package_listing[$i]	= $package_listing;
		$arr_package_map[$i]		= $package_map;
		$arr_package_price[$i]		= $package_price;
		$arr_package_price_1m[$i]	= $pcurrency_symbol . $package_price_1m;
		$arr_package_price_3m[$i]	= $pcurrency_symbol . $package_price_3m;
		$arr_package_price_6m[$i]	= $pcurrency_symbol . $package_price_6m;
		$arr_package_price_12m[$i]	= $pcurrency_symbol . $package_price_12m;
		$i++;

	}
	
	
	
	$smarty->assign("employer_package_id"			, $employer_package_id				);
	$smarty->assign("employer_package_name"			, $employer_package_name			);
	$smarty->assign("employer_package_payment"		, $employer_package_payment			);
	$smarty->assign("employer_package_price_1m"		, $employer_package_price_1m		);
	$smarty->assign("employer_package_payment_text"	, $employer_package_payment_text	);
	$smarty->assign("employer_date_expired"			, $employer_date_expired			);

	$smarty->assign("package_id"					, $arr_package_id					);
	$smarty->assign("package_name"					, $arr_package_name					);
	$smarty->assign("package_listing"				, $arr_package_listing				);
	$smarty->assign("package_map"					, $arr_package_map					);
	$smarty->assign("package_price"					, $arr_package_price				);
	$smarty->assign("package_price_1m"				, $arr_package_price_1m				);
	$smarty->assign("package_price_3m"				, $arr_package_price_3m				);
	$smarty->assign("package_price_6m"				, $arr_package_price_6m				);
	$smarty->assign("package_price_12m"				, $arr_package_price_12m			);
	$smarty->display('employer_subscription.html');	



?>