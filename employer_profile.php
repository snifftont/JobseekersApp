<?



	



	$section	= "employer";
	include("setting.php");
	


	
	$random_code 		= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha	= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());




	
	$sql_query  				= "SELECT * FROM employer WHERE employer_id = '$clogin_employer'";
	$result						= mysql_query($sql_query) or die(mysql_error());													
	$row						= mysql_fetch_array($result);
	
	$employer_id				= $row[employer_id];
	$employer_type				= $row[employer_type];
	$employer_package			= $row[employer_package];
	$employer_package_payment	= $row[employer_package_payment];
	$employer_username			= $row[employer_username];
	$employer_password			= $row[employer_password];
	$employer_company			= $row[employer_company];
	$employer_company_employees	= $row[employer_company_employees];
	$employer_company_industry	= $row[employer_company_industry];
	$employer_company_type		= $row[employer_company_type];
	$employer_company_details	= $row[employer_company_details];
	$employer_title				= $row[employer_title];
	$employer_firstname			= $row[employer_firstname];
	$employer_lastname			= $row[employer_lastname];
	$employer_address			= $row[employer_address];
	$employer_address2			= $row[employer_address2];
	$employer_city				= $row[employer_city];
	$employer_state				= $row[employer_state];
	$employer_zip				= $row[employer_zip];
	$employer_country			= $row[employer_country];
	$employer_phone				= $row[employer_phone];
	$employer_fax				= $row[employer_fax];
	$employer_email				= $row[employer_email];
	$employer_website			= $row[employer_website];
	$employer_date_expired		= $row[employer_date_expired];
	$employer_logo				= file_exists("$dir_logo/$employer_id.jpg");



	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_personaltitle ORDER BY personaltitle_order ASC, personaltitle_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$personaltitle_id				= $row[personaltitle_id];
		$personaltitle_name				= $row[personaltitle_name];	
		$arr_personaltitle_id[$i]		= $personaltitle_id;
		$arr_personaltitle_name[$i]		= $personaltitle_name;
		$arr_personaltitle_status[$i]	= "no";

		if ($personaltitle_id == $employer_title) { $arr_personaltitle_status[$i] = "yes"; }
		$i++;
		
	} 




	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_companysize ORDER BY companysize_order ASC, companysize_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$companysize_id					= $row[companysize_id];
		$companysize_name				= $row[companysize_name];	
		$arr_companysize_id[$i]			= $companysize_id;
		$arr_companysize_name[$i]		= $companysize_name;
		$arr_companysize_status[$i]		= "no";

		if ($companysize_id == $employer_company_employees) { $arr_companysize_status[$i] = "yes"; }
		$i++;
		
	}
	
	
	
	
	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_industry ORDER BY industry_order ASC, industry_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$industry_id					= $row[industry_id];
		$industry_name					= $row[industry_name];	
		$arr_industry_id[$i]			= $industry_id;
		$arr_industry_name[$i]			= $industry_name;
		$arr_industry_status[$i]		= "no";

		if ($industry_id == $employer_company_industry) { $arr_industry_status[$i] = "yes"; }
		$i++;
		
	}	 



	
	$i				= 0;
	$sql_query		= "SELECT * FROM setup_companytype ORDER BY companytype_order ASC, companytype_name ASC";
	$result			= mysql_query($sql_query) or die(mysql_error());
	while($row		= mysql_fetch_array($result)){
		
		$companytype_id					= $row[companytype_id];
		$companytype_name				= $row[companytype_name];	
		$arr_companytype_id[$i]			= $companytype_id;
		$arr_companytype_name[$i]		= $companytype_name;
		$arr_companytype_status[$i]		= "no";

		if ($companytype_id == $employer_company_type) { $arr_companytype_status[$i] = "yes"; }
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
		
		if ($country_id == $employer_country) { $arr_country_status[$i] = "yes"; }
		$i++;

	} 




	
	if (!$cemployer_website					) 	{ $cemployer_website = "http://www.";	}


	
    if ($cemployer_username_warn			)	{ $warning_employer_username			= "warning"; } else { $warning_employer_username			= "normal_12_black"; }
    if ($cemployer_password_warn			)	{ $warning_employer_password			= "warning"; } else { $warning_employer_password			= "normal_12_black"; }
    if ($cemployer_firstname_warn			)	{ $warning_employer_firstname			= "warning"; } else { $warning_employer_firstname			= "normal_12_black"; }
    if ($cemployer_lastname_warn			)	{ $warning_employer_lastname			= "warning"; } else { $warning_employer_lastname			= "normal_12_black"; }
    if ($cemployer_phone_warn				)	{ $warning_employer_phone				= "warning"; } else { $warning_employer_phone				= "normal_12_black"; }
    if ($cemployer_fax_warn					)	{ $warning_employer_fax					= "warning"; } else { $warning_employer_fax					= "normal_12_black"; }
    if ($cemployer_email_warn				)	{ $warning_employer_email				= "warning"; } else { $warning_employer_email				= "normal_12_black"; }
    if ($cemployer_website_warn				)	{ $warning_employer_website				= "warning"; } else { $warning_employer_website				= "normal_12_black"; }
    if ($cemployer_company_warn				)	{ $warning_employer_company				= "warning"; } else { $warning_employer_company				= "normal_12_black"; }
    if ($cemployer_address_warn				)	{ $warning_employer_address				= "warning"; } else { $warning_employer_address				= "normal_12_black"; }
    if ($cemployer_city_warn				)	{ $warning_employer_city				= "warning"; } else { $warning_employer_city				= "normal_12_black"; }
    if ($cemployer_state_warn				)	{ $warning_employer_state				= "warning"; } else { $warning_employer_state				= "normal_12_black"; }
    if ($cemployer_zip_warn					)	{ $warning_employer_zip					= "warning"; } else { $warning_employer_zip					= "normal_12_black"; }
    if ($cemployer_country_warn				)	{ $warning_employer_country				= "warning"; } else { $warning_employer_country				= "normal_12_black"; }
    if ($cemployer_company_employees_warn	)	{ $warning_employer_company_employees	= "warning"; } else { $warning_employer_company_employees	= "normal_12_black"; }
    if ($cemployer_company_industry_warn	)	{ $warning_employer_company_industry	= "warning"; } else { $warning_employer_company_industry	= "normal_12_black"; }
    if ($cemployer_company_type_warn		)	{ $warning_employer_company_type		= "warning"; } else { $warning_employer_company_type		= "normal_12_black"; }
    if ($cemployer_company_logo_warn		)	{ $warning_employer_company_logo		= "warning"; } else { $warning_employer_company_logo		= "normal_12_black"; }
    if ($cemployer_company_details_warn		)	{ $warning_employer_company_details		= "warning"; } else { $warning_employer_company_details		= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code			= "warning"; } else { $warning_verification_code			= "normal_12_black"; }




	
	$smarty->assign("type"									, $type									);
	$smarty->assign("package"								, $package								);
	$smarty->assign("payment"								, $payment								);
	$smarty->assign("package_name"							, $package_name							);
	$smarty->assign("package_price"							, $package_price						);

	
	$smarty->assign("warning_employer_username"				, $warning_employer_username			);
	$smarty->assign("warning_employer_password"				, $warning_employer_password			);
	$smarty->assign("warning_employer_firstname"			, $warning_employer_firstname			);
	$smarty->assign("warning_employer_lastname"				, $warning_employer_lastname			);
	$smarty->assign("warning_employer_phone"				, $warning_employer_phone				);
	$smarty->assign("warning_employer_fax"					, $warning_employer_fax					);
	$smarty->assign("warning_employer_email"				, $warning_employer_email				);
	$smarty->assign("warning_employer_website"				, $warning_employer_website				);
	$smarty->assign("warning_employer_company"				, $warning_employer_company				);
	$smarty->assign("warning_employer_address"				, $warning_employer_address				);
	$smarty->assign("warning_employer_city"					, $warning_employer_city				);
	$smarty->assign("warning_employer_state"				, $warning_employer_state				);
	$smarty->assign("warning_employer_zip"					, $warning_employer_zip					);
	$smarty->assign("warning_employer_country"				, $warning_employer_country				);
	$smarty->assign("warning_employer_company_employees"	, $warning_employer_company_employees	);
	$smarty->assign("warning_employer_company_industry"		, $warning_employer_company_industry	);
	$smarty->assign("warning_employer_company_type"			, $warning_employer_company_type		);
	$smarty->assign("warning_employer_company_logo"			, $warning_employer_company_logo		);
	$smarty->assign("warning_employer_company_details"		, $warning_employer_company_details		);
	$smarty->assign("warning_verification_code"				, $warning_verification_code			);

	
	$smarty->assign("personaltitle_id"						, $arr_personaltitle_id					);
	$smarty->assign("personaltitle_name"					, $arr_personaltitle_name				);
	$smarty->assign("personaltitle_status"					, $arr_personaltitle_status				);
	$smarty->assign("companysize_id"						, $arr_companysize_id					);
	$smarty->assign("companysize_name"						, $arr_companysize_name					);
	$smarty->assign("companysize_status"					, $arr_companysize_status				);
	$smarty->assign("industry_id"							, $arr_industry_id						);
	$smarty->assign("industry_name"							, $arr_industry_name					);
	$smarty->assign("industry_status"						, $arr_industry_status					);
	$smarty->assign("companytype_id"						, $arr_companytype_id					);
	$smarty->assign("companytype_name"						, $arr_companytype_name					);
	$smarty->assign("companytype_status"					, $arr_companytype_status				);
	$smarty->assign("country_id"							, $arr_country_id						);
	$smarty->assign("country_name"							, $arr_country_name						);
	$smarty->assign("country_status"						, $arr_country_status					);

	
	$smarty->assign("employer_id"							, $employer_id							);
	$smarty->assign("employer_logo"							, $employer_logo						);
	$smarty->assign("employer_username"						, $employer_username					);
	$smarty->assign("employer_password"						, $employer_password					);
	$smarty->assign("employer_title"						, $employer_title						);
	$smarty->assign("employer_firstname"					, $employer_firstname					);
	$smarty->assign("employer_lastname"						, $employer_lastname					);
	$smarty->assign("employer_phone"						, $employer_phone						);
	$smarty->assign("employer_fax"							, $employer_fax							);
	$smarty->assign("employer_email"						, $employer_email						);
	$smarty->assign("employer_website"						, $employer_website						);
	$smarty->assign("employer_company"						, $employer_company						);
	$smarty->assign("employer_address"						, $employer_address						);
	$smarty->assign("employer_address2"						, $employer_address2					);
	$smarty->assign("employer_city"							, $employer_city						);
	$smarty->assign("employer_state"						, $employer_state						);
	$smarty->assign("employer_zip"							, $employer_zip							);
	$smarty->assign("employer_country"						, $employer_country						);
	$smarty->assign("employer_company_employees"			, $employer_company_employees			);
	$smarty->assign("employer_company_industry"				, $employer_company_industry			);
	$smarty->assign("employer_company_type"					, $employer_company_type				);
	$smarty->assign("employer_company_logo"					, $employer_company_logo				);
	$smarty->assign("employer_company_details"				, $employer_company_details				);
	$smarty->assign("status_img_captcha"					, $status_img_captcha					);
	$smarty->display('employer_profile.html');	



?>