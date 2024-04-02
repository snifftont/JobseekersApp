<?



	

	$section	= "resources";
	include("setting.php");
	
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	
	$i			= 0;
	$sql_query 	= "SELECT * FROM setup_page ORDER BY page_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while ($row	= mysql_fetch_array($result)) {
	
		$page_id				= $row[page_id];
		$page_name				= $row[page_name];
		$page_name_mod			= F69C27348CCA7B5F625165B15956CB3BD($page_name);
		$page_url				= "site_page.php?page=$page_id";

		if ($status_url_rewrite == "yes") { 
			$page_url			= "page-$page_id-$page_name_mod.php";	
		}

		$arr_page_id[$i]		= $page_id;
		$arr_page_name[$i]		= $page_name;
		$arr_page_url[$i]		= $page_url;
		$i++;
	
	}
	mysql_close($db_connect);	



	$smarty->assign("page_id"		, $arr_page_id		);
	$smarty->assign("page_name"		, $arr_page_name	);
	$smarty->assign("page_url"		, $arr_page_url		);
	$smarty->display('site_resources.html');	


?>