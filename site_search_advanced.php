<?



	



	$section	= "search";
	include("setting.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_term ORDER BY term_order ASC, term_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$term_id				= $row[term_id];
		$term_name				= $row[term_name];	
		$arr_term_id[$i]		= $term_id;
		$arr_term_name[$i]		= $term_name;
		$arr_term_status[$i]	= "no";

		if ($term_id == $sterm) { $arr_term_status[$i] = "yes"; }
		$i++;
		
	} 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_industry ORDER BY industry_order ASC, industry_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$industry_id				= $row[industry_id];
		$industry_name				= $row[industry_name];	
		$arr_industry_id[$i]		= $industry_id;
		$arr_industry_name[$i]		= $industry_name;
		$arr_industry_status[$i]	= "no";

		if ($industry_id == $sindustry) { $arr_industry_status[$i] = "yes"; }
		$i++;
		
	}	 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_jobfunction ORDER BY jobfunction_pathname ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$jobfunction_id					= $row[jobfunction_id];
		$jobfunction_name				= $row[jobfunction_name];	
		$jobfunction_level				= FB10052434D1D793F3AF424A01B909A4A($jobfunction_id);
		$jobfunction_space				= "";
		
		
		for ($j=1; $j<=$jobfunction_level-1; $j++	)	{ $jobfunction_space .= "&nbsp;&nbsp;&nbsp;&nbsp;";	}
		if  ($jobfunction_level > 1)					{ $jobfunction_space .= "+"; 						}
		
		
		$jobfunction_name				= "$jobfunction_space $jobfunction_name";
		$arr_jobfunction_id[$i]			= $jobfunction_id;
		$arr_jobfunction_name[$i]		= $jobfunction_name;
		$arr_jobfunction_status[$i]		= "no";


		if ($jobfunction_id == $sfunction			)	{ $arr_jobfunction_status[$i] = "yes"; }
		$i++;
		
		
	}	





	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_salarypayment ORDER BY salarypayment_order ASC, salarypayment_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$salarypayment_id					= $row[salarypayment_id];
		$salarypayment_name					= $row[salarypayment_name];	
		$arr_salarypayment_id[$i]			= $salarypayment_id;
		$arr_salarypayment_name[$i]			= $salarypayment_name;
		$arr_salarypayment_status[$i]		= "no";

		if ($salarypayment_id == $ssalary_payment) { $arr_salarypayment_status[$i] = "yes"; }
		$i++;
		
	}
	
	
	
	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_country ORDER BY country_order ASC, country_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$country_id					= $row[country_id];
		$country_name				= $row[country_name];	
		$arr_country_id[$i]			= $country_id;
		$arr_country_name[$i]		= $country_name;
		$arr_country_status[$i]		= "no";
		
		if ($country_id == $scountry) { $arr_country_status[$i] = "yes"; }
		$i++;

	} 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_radius ORDER BY radius_order ASC, radius_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$radius_id					= $row[radius_id];
		$radius_name				= $row[radius_name];	
		$arr_radius_id[$i]			= $radius_id;
		$arr_radius_name[$i]		= $radius_name;
		$arr_radius_status[$i]		= "no";
		
		if ($radius_id == $sradius) { $arr_radius_status[$i] = "yes"; }
		$i++;

	} 
	
	
	
	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_joblocation ORDER BY joblocation_order ASC, joblocation_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$joblocation_id					= $row[joblocation_id];
		$joblocation_name				= $row[joblocation_name];	
		$arr_joblocation_id[$i]			= $joblocation_id;
		$arr_joblocation_name[$i]		= $joblocation_name;
		$arr_joblocation_status[$i]		= "no";
		
		if ($joblocation_id == $slocation) { $arr_joblocation_status[$i] = "yes"; }
		$i++;

	} 	
	
	
	

	
	$i							= 0;
	$sql_query		= "SELECT * FROM setup_religion ORDER BY religion_order ASC, religion_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$religion_id				= $row[religion_id];
		$religion_name				= $row[religion_name];	
		$religion_status			= "no";

		$arr_religion_id[$i]		= $religion_id;
		$arr_religion_name[$i]		= $religion_name;
		$arr_religion_status[$i]	= $religion_status;

		if ($religion_id == $sreligion) { $arr_religion_status[$i] = "yes";	}
		$i++;

	} 	




	
	$i						= 0;
	$sql_query		= "SELECT * FROM setup_race ORDER BY race_order ASC, race_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$race_id				= $row[race_id];
		$race_name				= $row[race_name];	
		$race_status			= "no";

		$arr_race_id[$i]		= $race_id;
		$arr_race_name[$i]		= $race_name;
		$arr_race_status[$i]	= $race_status;

		if ($race_id == $srace) { $arr_race_status[$i] = "yes";	}
		$i++;

	} 




	
	$i								= 0;
	$sql_query		= "SELECT * FROM setup_maritalstatus ORDER BY maritalstatus_order ASC, maritalstatus_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$maritalstatus_id				= $row[maritalstatus_id];
		$maritalstatus_name				= $row[maritalstatus_name];	
		$maritalstatus_status			= "no";

		$arr_maritalstatus_id[$i]		= $maritalstatus_id;
		$arr_maritalstatus_name[$i]		= $maritalstatus_name;
		$arr_maritalstatus_status[$i]	= $maritalstatus_status;

		if ($maritalstatus_id == $smarital) { $arr_maritalstatus_status[$i] = "yes";	}
		$i++;

	} 
	
	

	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_academic ORDER BY academic_order ASC, academic_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$academic_id					= $row[academic_id];
		$academic_name					= $row[academic_name];	
		$arr_academic_id[$i]			= $academic_id;
		$arr_academic_name[$i]			= $academic_name;
		$arr_academic_status[$i]		= "no";
		
		if ($academic_id == $sacademic) { $arr_academic_status[$i] = "yes"; }
		$i++;

	} 




	
	$smarty->assign("term_id"					, $arr_term_id						);
	$smarty->assign("term_name"					, $arr_term_name					);
	$smarty->assign("term_status"				, $arr_term_status					);
	$smarty->assign("industry_id"				, $arr_industry_id					);
	$smarty->assign("industry_name"				, $arr_industry_name				);
	$smarty->assign("industry_status"			, $arr_industry_status				);
	$smarty->assign("jobfunction_id"			, $arr_jobfunction_id				);
	$smarty->assign("jobfunction_name"			, $arr_jobfunction_name				);
	$smarty->assign("jobfunction_status"		, $arr_jobfunction_status			);
	$smarty->assign("lastdate_date_id"			, $arr_lastdate_date_id				);
	$smarty->assign("lastdate_date_status"		, $arr_lastdate_date_status			);
	$smarty->assign("lastdate_month_id"			, $arr_lastdate_month_id			);
	$smarty->assign("lastdate_month_name"		, $arr_lastdate_month_name			);
	$smarty->assign("lastdate_month_status"		, $arr_lastdate_month_status		);
	$smarty->assign("lastdate_year_id"			, $arr_lastdate_year_id				);
	$smarty->assign("lastdate_year_status"		, $arr_lastdate_year_status			);
	$smarty->assign("salarypayment_id"			, $arr_salarypayment_id				);
	$smarty->assign("salarypayment_name"		, $arr_salarypayment_name			);
	$smarty->assign("salarypayment_status"		, $arr_salarypayment_status			);
	$smarty->assign("country_id"				, $arr_country_id					);
	$smarty->assign("country_name"				, $arr_country_name					);
	$smarty->assign("country_status"			, $arr_country_status				);
	$smarty->assign("radius_id"					, $arr_radius_id					);
	$smarty->assign("radius_name"				, $arr_radius_name					);
	$smarty->assign("radius_status"				, $arr_radius_status				);
	$smarty->assign("joblocation_id"			, $arr_joblocation_id				);
	$smarty->assign("joblocation_name"			, $arr_joblocation_name				);
	$smarty->assign("joblocation_status"		, $arr_joblocation_status			);
	$smarty->assign("religion_id"				, $arr_religion_id					);
	$smarty->assign("religion_name"				, $arr_religion_name				);
	$smarty->assign("religion_status"			, $arr_religion_status				);
	$smarty->assign("race_id"					, $arr_race_id						);
	$smarty->assign("race_name"					, $arr_race_name					);
	$smarty->assign("race_status"				, $arr_race_status					);
	$smarty->assign("maritalstatus_id"			, $arr_maritalstatus_id				);
	$smarty->assign("maritalstatus_name"		, $arr_maritalstatus_name			);
	$smarty->assign("maritalstatus_status"		, $arr_maritalstatus_status			);
	$smarty->assign("academic_id"				, $arr_academic_id					);
	$smarty->assign("academic_name"				, $arr_academic_name				);
	$smarty->assign("academic_status"			, $arr_academic_status				);


	
	$smarty->assign("snumber"					, $snumber						);
	$smarty->assign("sterm"						, $sterm						);
	$smarty->assign("stitle"					, $stitle						);
	$smarty->assign("sposition"					, $sposition					);
	$smarty->assign("sindustry"					, $sindustry					);
	$smarty->assign("sfunction"					, $sfunction					);
	$smarty->assign("ssalary_amount"			, $ssalary_amount				);
	$smarty->assign("ssalary_payment"			, $ssalary_payment				);
	$smarty->assign("ssalary_negotiable"		, $ssalary_negotiable			);
	$smarty->assign("scity"						, $scity						);
	$smarty->assign("sstate"					, $sstate						);
	$smarty->assign("szip"						, $szip							);
	$smarty->assign("sradius"					, $sradius						);
	$smarty->assign("scountry"					, $scountry						);
	$smarty->assign("slocation"					, $slocation					);
	$smarty->assign("sreligion"					, $sreligion					);
	$smarty->assign("srace"						, $srace						);
	$smarty->assign("smarital"					, $smarital						);
	$smarty->assign("sage"						, $sage							);
	$smarty->assign("sworkexp"					, $sworkexp						);
	$smarty->assign("sacademic"					, $sacademic					);


	if (!$sorder_by) {
		$sorder_by		= "date_add";
		$sorder_method	= "desc";
	}

	$smarty->assign("sorder_by"					, $sorder_by					);
	$smarty->assign("sorder_method"				, $sorder_method				);
	$smarty->display('site_search_advanced.html');	



?>