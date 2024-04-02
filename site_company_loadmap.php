<?

	include("setting.php");
	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());

	$employer_id			= $company;
	$sql_query  			= "SELECT * FROM employer WHERE employer_id = '$employer_id'";
	$result					= mysql_query($sql_query) or die(mysql_error());													
	$row					= mysql_fetch_array($result);
	
	$employer_id			= $row[employer_id];
	$employer_logo			= file_exists("$dir_logo/$employer_id.jpg");
	$employer_username		= $row[employer_username];
	$employer_password		= $row[employer_password];
	$employer_company		= $row[employer_company];
	$employer_title			= $row[employer_title];
	$employer_firstname		= $row[employer_firstname];
	$employer_lastname		= $row[employer_lastname];
	$employer_fullname		= "$employer_firstname $employer_lastname";
	$employer_address		= $row[employer_address];
	$employer_address2		= $row[employer_address2];
	$employer_city			= $row[employer_city];
	$employer_state			= $row[employer_state];
	$employer_zip			= $row[employer_zip];
	$employer_country		= $row[employer_country];
	$employer_phone			= $row[employer_phone];
	$employer_fax			= $row[employer_fax];
	$employer_email			= $row[employer_email];
	$employer_website		= $row[employer_website];



	
	$sql_query				= "SELECT * FROM setup_country WHERE country_id = '$employer_country'";
	$result					= mysql_query($sql_query) or die(mysql_error());
	$row					= mysql_fetch_array($result);
	$employer_country		= $row[country_name];
	
	
	
	$google_address			 = "$employer_address $employer_city, $employer_state $employer_zip, $employer_country";
	$google_company			 = "<strong>$employer_address</strong><br>$employer_city, $employer_state, $employer_zip<br>$employer_country";
	mysql_close($db_connect);


?>
showAddress("<?= $google_address ?>", "<?= $google_company ?>");