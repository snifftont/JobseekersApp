<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	
	$sql_query  			= "SELECT * FROM job WHERE job_id = '$job'";
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
		header("Location:employer_job.php");
	}


	
	$sql_query				= "SELECT TO_DAYS(job_date_expire) - TO_DAYS('$date_database') AS days_left FROM job WHERE job_id = '$job'";
	$result					= mysql_query($sql_query) or die(mysql_error());
	$row					= mysql_fetch_array($result);
	$job_days_left			= $row[days_left];



	
	$sql_query				= "SELECT * FROM setup_package WHERE package_id = '$package'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	$package_id				= $row[package_id];
	$package_name			= $row[package_name];
	$package_price			= $row[package_price];
	$package_days			= $row[package_days];
	$package_chars			= $row[package_chars];
	$package_renewable		= $row[package_renewable];


	

	
	if ($job_days_left >  0) {

		if ($job_package == $package) {

			$job_days_left			= 0;
			$cost_package			= $package_price;
			$cost_discount			= $package_price * $cpromo_disc / 100;
			$cost_discount_prorated	= 0;
			$cost_final				= $cost_package - $cost_discount - $cost_discount_prorated;

		}
		else {

			$job_days_left			= $job_days_left;
			$cost_package			= $package_price;
			$cost_discount			= $package_price * $cpromo_disc / 100;
			$cost_discount_prorated	= $job_days_left / $job_package_days * $job_package_price2;
			$cost_final				= $cost_package - $cost_discount - $cost_discount_prorated;
			$cost_prorated_show		= "yes";

		}

	}
	else {
	
		$job_days_left			= 0;
		$cost_package			= $package_price;
		$cost_discount			= $package_price * $cpromo_disc / 100;
		$cost_discount_prorated	= 0;
		$cost_final				= $cost_package - $cost_discount - $cost_discount_prorated;

	}
	
	
	

	$promo_disc					= number_format($cpromo_disc, 2) . "%";
	$cost_package				= $pcurrency_symbol . number_format($cost_package			, 2, $web_decimal_separator, $web_thousand_separator);
	$cost_discount				= $pcurrency_symbol . number_format($cost_discount			, 2, $web_decimal_separator, $web_thousand_separator);
	$cost_discount_prorated		= $pcurrency_symbol . number_format($cost_discount_prorated	, 2, $web_decimal_separator, $web_thousand_separator);

	if ($cost_final > 0)  		{ $cost_final = $pcurrency_symbol . number_format($cost_final, 2); 	}
	else						{ $cost_final = "FREE"; 											}




	
    if ($cjob_term_warn				) { $warning_job_term				= "warning"; } else { $warning_job_term				= "normal_12_black"; }
    if ($cverification_code_warn	) { $warning_verification_code		= "warning"; } else { $warning_verification_code	= "normal_12_black"; }




	
	$smarty->assign("warning_job_term"			, $warning_job_term				);
	$smarty->assign("warning_verification_code"	, $warning_verification_code	);



	
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

	$smarty->assign("package_id"				, $package_id					);
	$smarty->assign("package_name"				, $package_name					);
	$smarty->assign("package_price"				, $package_price				);
	$smarty->assign("package_days"				, $package_days					);
	$smarty->assign("package_renewable"			, $package_renewable			);
	$smarty->assign("package_mode"				, $mode							);


	$smarty->assign("promo_job"					, $job							);
	$smarty->assign("promo_package"				, $package						);
	$smarty->assign("promo_code"				, $cpromo_code					);
	$smarty->assign("promo_disc"				, $promo_disc					);
	$smarty->assign("promo_warn"				, $cpromo_warning				);
	
	$smarty->assign("cost_package"				, $cost_package					);
	$smarty->assign("cost_discount"				, $cost_discount				);
	$smarty->assign("cost_discount_prorated"	, $cost_discount_prorated		);
	$smarty->assign("cost_prorated_show"		, $cost_prorated_show			);
	$smarty->assign("cost_final"				, $cost_final					);
	$smarty->assign("cost_days_left"			, $job_days_left				);

	$smarty->assign("status_img_captcha"		, $status_img_captcha			);
	$smarty->display('employer_job_upgrade_calculation.html');	



?>