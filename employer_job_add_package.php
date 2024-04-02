<?



	



	$section	= "employer";
	include("setting.php");
	include("employer_check.php");
	

	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_package ORDER BY package_price ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());													
	while($row	= mysql_fetch_array($result)) {

		$package_id		    		= $row[package_id];
		$package_name				= $row[package_name];
		$package_days				= $row[package_days];
		$package_map				= $row[package_map];
		$package_price				= $row[package_price];
		$package_price				= number_format($package_price, 2, $web_decimal_separator, $web_thousand_separator);
		
		$arr_package_id[$i]			= $package_id;
		$arr_package_name[$i]		= $package_name;
		$arr_package_days[$i]		= $package_days;
		$arr_package_map[$i]		= $package_map;
		$arr_package_price[$i]		= $pcurrency_symbol . $package_price;
		$i++;

	}
	
	
	
	$smarty->assign("package_id"		, $arr_package_id			);
	$smarty->assign("package_name"		, $arr_package_name			);
	$smarty->assign("package_days"		, $arr_package_days			);
	$smarty->assign("package_map"		, $arr_package_map			);
	$smarty->assign("package_price"		, $arr_package_price		);
	$smarty->display('employer_job_add_package.html');	



?>