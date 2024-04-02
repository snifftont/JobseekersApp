<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());




	
	$sql_query  					= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
	$result							= mysql_query($sql_query) or die(mysql_error());													
	$row							= mysql_fetch_array($result);
	$employer_id					= $row[employer_id];
	$employer_type					= $row[employer_type];
	$employer_package				= $row[employer_package];
	$employer_package_payment		= $row[employer_package_payment];
	$employer_date_expired			= $row[employer_date_expired];
	

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
	
	


	
	$sql_query	        			= "SELECT * FROM setup_package_subscription WHERE package_id = '$package'";
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

	if ($payment	== "1m" 	) 	{ $package_price	= $package_price_1m; 	}
	if ($payment	== "3m" 	) 	{ $package_price	= $package_price_3m; 	}
	if ($payment	== "6m" 	) 	{ $package_price	= $package_price_6m; 	}
	if ($payment	== "12m" 	) 	{ $package_price	= $package_price_12m; 	}



	
	$sql_query						= "SELECT TO_DAYS('$employer_date_expired') - TO_DAYS('$date_database') AS days_left";
	$result							= mysql_query($sql_query) or die(mysql_error());
	$row							= mysql_fetch_array($result);
	$subscription_days_left			= $row[days_left];
	$employer_date_expired			= F2BE712F08F5878F1C8F3DFF139674C86($employer_date_expired, $date_format);
	




	
	

	

	
	if ($subscription_days_left >  0) {

		if ($employer_package == $package) {

			$subscription_days_left	= 0;
			$cost_package			= $package_price;
			$cost_discount			= $package_price * $cpromo_disc / 100;
			$cost_discount_prorated	= 0;
			$cost_final				= $cost_package - $cost_discount - $cost_discount_prorated;

		}
		else {

			$subscription_days_left	= $subscription_days_left;
			$cost_package			= $package_price;
			$cost_discount			= $package_price * $cpromo_disc / 100;
			$cost_discount_prorated	= $subscription_days_left / $employer_package_days * $employer_package_price;
			$cost_final				= $cost_package - $cost_discount - $cost_discount_prorated;
			$cost_prorated_show		= "yes";

		}

	}
	else {
	
		$subscription_days_left		= 0;
		$cost_package				= $package_price;
		$cost_discount				= $package_price * $cpromo_disc / 100;
		$cost_discount_prorated		= 0;
		$cost_final					= $cost_package - $cost_discount - $cost_discount_prorated;

	}
	
	
	

	$promo_disc					= number_format($cpromo_disc, 2) . "%";
	$cost_package				= $pcurrency_symbol . number_format($cost_package			, 2, $web_decimal_separator, $web_thousand_separator);
	$cost_discount				= $pcurrency_symbol . number_format($cost_discount			, 2, $web_decimal_separator, $web_thousand_separator);
	$cost_discount_prorated		= $pcurrency_symbol . number_format($cost_discount_prorated	, 2, $web_decimal_separator, $web_thousand_separator);

	if ($cost_final > 0)  		{ $cost_final = $pcurrency_symbol . number_format($cost_final, 2); 	}
	else						{ $cost_final = "FREE"; 											}




	
	$smarty->assign("employer_package_id"			, $employer_package_id				);
	$smarty->assign("employer_package_name"			, $employer_package_name			);
	$smarty->assign("employer_package_payment"		, $employer_package_payment			);
	$smarty->assign("employer_package_price"		, $employer_package_price			);
	$smarty->assign("employer_package_price_text"	, $employer_package_price_text		);
	$smarty->assign("employer_date_expired"			, $employer_date_expired			);

	$smarty->assign("package_id"					, $package_id						);
	$smarty->assign("package_name"					, $package_name						);
	$smarty->assign("package_price"					, $package_price					);
	$smarty->assign("package_days"					, $package_days						);
	$smarty->assign("package_renewable"				, $package_renewable				);
	$smarty->assign("package_mode"					, $mode								);

	$smarty->assign("promo_package"					, $package							);
	$smarty->assign("promo_payment"					, $payment							);
	$smarty->assign("promo_mode"					, $mode								);
	$smarty->assign("promo_code"					, $cpromo_code						);
	$smarty->assign("promo_disc"					, $promo_disc						);
	$smarty->assign("promo_warn"					, $cpromo_warning					);

	$smarty->assign("cost_package"					, $cost_package						);
	$smarty->assign("cost_discount"					, $cost_discount					);
	$smarty->assign("cost_discount_prorated"		, $cost_discount_prorated			);
	$smarty->assign("cost_prorated_show"			, $cost_prorated_show				);
	$smarty->assign("cost_final"					, $cost_final						);
	$smarty->assign("cost_days_left"				, $subscription_days_left			);
	$smarty->assign("status_img_captcha"			, $status_img_captcha				);

	$smarty->display('employer_subscription_calculation.html');	



?>