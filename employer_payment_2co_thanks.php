<?

	

	if (!$_COOKIE['clogin_employer']) { header("location:employer_login.php"); }


	$section = "employer";
	include("system_payment_2co.php");


    
	$smarty->display('employer_payment_2co_thanks.html');
	

?>