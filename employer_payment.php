<?



	


	$section	= "employer";
	include("setting.php");
	include("employer_check.php");



	setcookie("cpromo_disc"		, ""	);
	setcookie("cpromo_code"		, ""	);
	setcookie("cpromo_warning"	, ""	);
	

	
	$employer	= $clogin_employer;
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	

	if (!$current_item) { $current_item = 0; }

	$sql_query	= "SELECT * FROM employer_payment WHERE payment_employer = '$clogin_employer' AND payment_status = 'paid' AND payment_amount > 0";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$found		= mysql_num_rows($result);

	$i			= 0;
	$sql_query	= "SELECT * FROM employer_payment WHERE payment_employer = '$clogin_employer' AND payment_status = 'paid' AND payment_amount > 0 ORDER BY payment_date DESC LIMIT $current_item, $row_admin";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){


		if ($i % 2 == 1)	{ $bg_color = "EAF8FE"; }
		else 				{ $bg_color = "FFFFFF"; }

		$payment_id						= $row[payment_id];
		$payment_number					= $payment_id + $start_payment;
		$payment_type					= $row[payment_type];
		$payment_employer				= $row[payment_employer];
		$payment_details				= $row[payment_details];
		$payment_discount_code			= $row[payment_discount_code];
		$payment_amount					= $row[payment_amount];
		$payment_amount_required		= $row[payment_amount_required];
		$payment_amount_disc			= $row[payment_amount_disc];
		$payment_amount_prorated		= $row[payment_amount_prorated];
		$payment_date					= $row[payment_date];
		$payment_date					= F2BE712F08F5878F1C8F3DFF139674C86($payment_date, $date_format);
		$payment_job					= $row[payment_job];
		$payment_job_package			= $row[payment_job_package];
		$payment_job_days				= $row[payment_job_days];
		$payment_subscription			= $row[payment_subscription];
		$payment_subscription_package	= $row[payment_subscription_package];
		$payment_subscription_days		= $row[payment_subscription_days];
		$payment_status					= $row[payment_status];

		$payment_famount				= $pcurrency_symbol . number_format($payment_amount				, 2, $web_decimal_separator, $web_thousand_separator);
		$payment_famount_required		= $pcurrency_symbol . number_format($payment_amount_required	, 2, $web_decimal_separator, $web_thousand_separator);
		$payment_famount_disc			= $pcurrency_symbol . number_format($payment_amount_disc		, 2, $web_decimal_separator, $web_thousand_separator);
		$payment_famount_prorated		= $pcurrency_symbol . number_format($payment_amount_prorated	, 2, $web_decimal_separator, $web_thousand_separator);
		


		$sql_query  					= "SELECT * FROM job WHERE job_id = '$payment_job'";
		$tresult						= mysql_query($sql_query) or die(mysql_error());													
		$trow							= mysql_fetch_array($tresult);
		$payment_job_id					= $trow[job_id];
		$payment_job_number				= $payment_job_id + $start_job;
		$payment_job_title				= $trow[job_title];
			
		$sql_query	        			= "SELECT * FROM setup_package WHERE package_id = '$payment_job_package'";
		$tresult		        		= mysql_query($sql_query) or die(mysql_error());
		$trow		        			= mysql_fetch_array($tresult);
		$payment_job_package			= $trow[package_name];
		$payment_job_package			= ucfirst(strtolower($payment_job_package));

		$sql_query	        			= "SELECT * FROM setup_package_subscription WHERE package_id = '$payment_subscription_package'";
		$tresult		        		= mysql_query($sql_query) or die(mysql_error());
		$trow		       				= mysql_fetch_array($tresult);
		$payment_subs_package			= $trow[package_name];



		$arr_payment_id[$i]				= $payment_id;
		$arr_payment_number[$i]			= $payment_number;
		$arr_payment_type[$i]			= $payment_type;
		$arr_payment_job_id[$i]			= $payment_job_id;
		$arr_payment_job_number[$i]		= $payment_job_number;
		$arr_payment_job_title[$i]		= $payment_job_title;
		$arr_payment_job_package[$i]	= $payment_job_package;
		$arr_payment_subs_package[$i]	= $payment_subs_package;
		$arr_payment_details[$i]		= $payment_details;
		$arr_payment_discount_code[$i]	= $payment_discount_code;
		$arr_payment_famount[$i]		= $payment_famount;
		$arr_payment_date[$i]			= $payment_date;
		$arr_payment_bgcolor[$i]		= $bg_color;
		$i++;
		
	
	} 
	mysql_close($db_connect);



	
	if (!$current_page			)	{ $current_page = 1; 								} 
	if (!$page_url				)	{ $page_url 	= "employer_payment.php"; 			} 
	if ($found % $row_admin > 0	)	{ $total_page 	= floor($found / $row_admin) + 1;	} 
    else							{ $total_page 	= $found / $row_admin;				}
	


	
	$smarty->assign("payment_found"			, $found						);
	$smarty->assign("payment_id"			, $arr_payment_id				);
	$smarty->assign("payment_number"		, $arr_payment_number			);
	$smarty->assign("payment_type"			, $arr_payment_type				);

	$smarty->assign("payment_job_id"		, $arr_payment_job_id			);
	$smarty->assign("payment_job_number"	, $arr_payment_job_number		);
	$smarty->assign("payment_job_title"		, $arr_payment_job_title		);
	$smarty->assign("payment_job_package"	, $arr_payment_job_package		);
	$smarty->assign("payment_subs_package"	, $arr_payment_subs_package		);

	$smarty->assign("payment_details"		, $arr_payment_details			);
	$smarty->assign("payment_discount_code"	, $arr_payment_discount_code	);
	$smarty->assign("payment_famount"		, $arr_payment_famount			);
	$smarty->assign("payment_date"			, $arr_payment_date				);
	$smarty->assign("payment_bgcolor"		, $arr_payment_bgcolor			);

	include("system_paging.php");
	$smarty->display('employer_payment.html');	








?>