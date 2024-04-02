<?



	



	$section	= "employer";
	include("setting.php");
	

	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_package_subscription ORDER BY package_price_1m ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());													
	while($row	= mysql_fetch_array($result)) {

		$package_id		    		= $row[package_id];
		$package_name				= $row[package_name];
		$package_listing			= $row[package_listing];
		$package_map				= $row[package_map];

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
		$arr_package_price_1m[$i]	= $pcurrency_symbol . $package_price_1m;
		$arr_package_price_3m[$i]	= $pcurrency_symbol . $package_price_3m;
		$arr_package_price_6m[$i]	= $pcurrency_symbol . $package_price_6m;
		$arr_package_price_12m[$i]	= $pcurrency_symbol . $package_price_12m;
		$i++;

	}
	
	
	
	$smarty->assign("package_id"			, $arr_package_id			);
	$smarty->assign("package_name"			, $arr_package_name			);
	$smarty->assign("package_listing"		, $arr_package_listing		);
	$smarty->assign("package_map"			, $arr_package_map			);
	$smarty->assign("package_price_1m"		, $arr_package_price_1m		);
	$smarty->assign("package_price_3m"		, $arr_package_price_3m		);
	$smarty->assign("package_price_6m"		, $arr_package_price_6m		);
	$smarty->assign("package_price_12m"		, $arr_package_price_12m	);
	$smarty->display('employer_register_package.html');	



?>