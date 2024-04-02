<?



	

	$section	= "resources";
	include("setting.php");



	$db_connect 	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());
	
	$sql_query 		= "SELECT * FROM setup_page WHERE page_id = '$page'";
	$result			= mysql_query($sql_query) or die(mysql_error());
	$row			= mysql_fetch_array($result);
	$page_name		= $row[page_name];

	$row			= F36B3279F83EA290317DA9B94D8357EB4($row);
	$page_content	= html_entity_decode($row[page_content]);
	
	mysql_close($db_connect);	



    
	$smarty->assign("page_title"	, $page_name		);
	$smarty->assign("page_content" 	, $page_content		);
	$smarty->display('site_page.html');	


?>