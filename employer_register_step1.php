<?



	



	$section	= "employer";
	include("setting.php");
	


	
	$random_code 	= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_personaltitle ORDER BY personaltitle_order ASC, personaltitle_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$personaltitle_id				= $row[personaltitle_id];
		$personaltitle_name				= $row[personaltitle_name];	
		
		$arr_personaltitle_id[$i]		= $personaltitle_id;
		$arr_personaltitle_name[$i]		= $personaltitle_name;
		$arr_personaltitle_status[$i]	= "no";

		if ($personaltitle_id == $cemployer_title) { $arr_personaltitle_status[$i] = "yes"; }

		$i++;
		
	} 


	
	
	
    if ($cemployer_username_warn			)	{ $warning_employer_username		= "warning"; } else { $warning_employer_username		= "normal_12_black"; }
    if ($cemployer_password_warn			)	{ $warning_employer_password		= "warning"; } else { $warning_employer_password		= "normal_12_black"; }
    if ($cemployer_firstname_warn			)	{ $warning_employer_firstname		= "warning"; } else { $warning_employer_firstname		= "normal_12_black"; }
    if ($cemployer_lastname_warn			)	{ $warning_employer_lastname		= "warning"; } else { $warning_employer_lastname		= "normal_12_black"; }
    if ($cemployer_birthdate_date_warn		)	{ $warning_employer_birthdate		= "warning"; } else { $warning_employer_birthdate		= "normal_12_black"; }
    if ($cemployer_birthdate_month_warn	)	{ $warning_employer_birthdate		= "warning"; } else { $warning_employer_birthdate		= "normal_12_black"; }
    if ($cemployer_birthdate_year_warn		)	{ $warning_employer_birthdate		= "warning"; } else { $warning_employer_birthdate		= "normal_12_black"; }
    if ($cemployer_nationality_warn		)	{ $warning_employer_nationality	= "warning"; } else { $warning_employer_nationality	= "normal_12_black"; }
    if ($cemployer_idnumber_warn			)	{ $warning_employer_idnumber		= "warning"; } else { $warning_employer_idnumber		= "normal_12_black"; }
    if ($cemployer_religion_warn			)	{ $warning_employer_religion		= "warning"; } else { $warning_employer_religion		= "normal_12_black"; }
    if ($cemployer_race_warn				)	{ $warning_employer_race			= "warning"; } else { $warning_employer_race			= "normal_12_black"; }
    if ($cemployer_marital_warn			)	{ $warning_employer_marital		= "warning"; } else { $warning_employer_marital		= "normal_12_black"; }
    if ($cemployer_address_warn			)	{ $warning_employer_address		= "warning"; } else { $warning_employer_address		= "normal_12_black"; }
    if ($cemployer_city_warn				)	{ $warning_employer_city			= "warning"; } else { $warning_employer_city			= "normal_12_black"; }
    if ($cemployer_state_warn				)	{ $warning_employer_state			= "warning"; } else { $warning_employer_state			= "normal_12_black"; }
    if ($cemployer_zip_warn				)	{ $warning_employer_zip			= "warning"; } else { $warning_employer_zip			= "normal_12_black"; }
    if ($cemployer_country_warn			)	{ $warning_employer_country		= "warning"; } else { $warning_employer_country		= "normal_12_black"; }
    if ($cemployer_phone_warn				)	{ $warning_employer_phone			= "warning"; } else { $warning_employer_phone			= "normal_12_black"; }
    if ($cemployer_cellphone_warn			)	{ $warning_employer_cellphone		= "warning"; } else { $warning_employer_cellphone		= "normal_12_black"; }
    if ($cemployer_fax_warn				)	{ $warning_employer_fax			= "warning"; } else { $warning_employer_fax			= "normal_12_black"; }
    if ($cemployer_email_warn				)	{ $warning_employer_email			= "warning"; } else { $warning_employer_email			= "normal_12_black"; }
    if ($cemployer_website_warn			)	{ $warning_employer_website		= "warning"; } else { $warning_employer_website		= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code		= "warning"; } else { $warning_verification_code		= "normal_12_black"; }



	
	if (!$cemployer_website) { $cemployer_website = "http://www.";}



	

	$smarty->assign("warning_employer_username"	, $warning_employer_username		);
	$smarty->assign("warning_employer_password"	, $warning_employer_password		);
	$smarty->assign("warning_employer_firstname"	, $warning_employer_firstname		);
	$smarty->assign("warning_employer_lastname"	, $warning_employer_lastname		);
	$smarty->assign("warning_employer_gender"		, $warning_employer_gender			);
	$smarty->assign("warning_employer_birthdate"	, $warning_employer_birthdate		);
	$smarty->assign("warning_employer_nationality"	, $warning_employer_nationality	);
	$smarty->assign("warning_employer_idnumber"	, $warning_employer_idnumber		);
	$smarty->assign("warning_employer_religion"	, $warning_employer_religion		);
	$smarty->assign("warning_employer_race"		, $warning_employer_race			);
	$smarty->assign("warning_employer_marital"		, $warning_employer_marital		);
	$smarty->assign("warning_employer_address"		, $warning_employer_address		);
	$smarty->assign("warning_employer_city"		, $warning_employer_city			);
	$smarty->assign("warning_employer_state"		, $warning_employer_state			);
	$smarty->assign("warning_employer_zip"			, $warning_employer_zip			);
	$smarty->assign("warning_employer_country"		, $warning_employer_country		);
	$smarty->assign("warning_employer_phone"		, $warning_employer_phone			);
	$smarty->assign("warning_employer_cellphone"	, $warning_employer_cellphone		);
	$smarty->assign("warning_employer_fax"			, $warning_employer_fax			);
	$smarty->assign("warning_employer_email"		, $warning_employer_email			);
	$smarty->assign("warning_employer_website"		, $warning_employer_website		);
	$smarty->assign("warning_verification_code"		, $warning_verification_code		);

	
	
	
	
	$smarty->assign("personaltitle_id"				, $arr_personaltitle_id				);
	$smarty->assign("personaltitle_name"			, $arr_personaltitle_name			);
	$smarty->assign("personaltitle_status"			, $arr_personaltitle_status			);
	$smarty->assign("gender_id"						, $arr_gender_id					);
	$smarty->assign("gender_name"					, $arr_gender_name					);
	$smarty->assign("gender_status"					, $arr_gender_status				);
	$smarty->assign("birthdate_date_id"				, $arr_birthdate_date_id			);
	$smarty->assign("birthdate_date_status"			, $arr_birthdate_date_status		);
	$smarty->assign("birthdate_month_id"			, $arr_birthdate_month_id			);
	$smarty->assign("birthdate_month_name"			, $arr_birthdate_month_name			);
	$smarty->assign("birthdate_month_status"		, $arr_birthdate_month_status		);
	$smarty->assign("birthdate_year_id"				, $arr_birthdate_year_id			);
	$smarty->assign("birthdate_year_status"			, $arr_birthdate_year_status		);
	$smarty->assign("religion_id"					, $arr_religion_id					);
	$smarty->assign("religion_name"					, $arr_religion_name				);
	$smarty->assign("religion_status"				, $arr_religion_status				);
	$smarty->assign("race_id"						, $arr_race_id						);
	$smarty->assign("race_name"						, $arr_race_name					);
	$smarty->assign("race_status"					, $arr_race_status					);
	$smarty->assign("maritalstatus_id"				, $arr_maritalstatus_id				);
	$smarty->assign("maritalstatus_name"			, $arr_maritalstatus_name			);
	$smarty->assign("maritalstatus_status"			, $arr_maritalstatus_status			);
	$smarty->assign("country_id"					, $arr_country_id					);
	$smarty->assign("country_name"					, $arr_country_name					);
	$smarty->assign("country_status"				, $arr_country_status				);

	
	$smarty->assign("cemployer_username"			, $cemployer_username				);
	$smarty->assign("cemployer_password"			, $cemployer_password				);
	$smarty->assign("cemployer_title"				, $cemployer_title					);
	$smarty->assign("cemployer_firstname"			, $cemployer_firstname				);
	$smarty->assign("cemployer_lastname"			, $cemployer_lastname				);
	$smarty->assign("cemployer_gender"				, $cemployer_gender				);
	$smarty->assign("cemployer_birthdate_date"		, $cemployer_birthdate_date		);
	$smarty->assign("cemployer_birthdate_month"	, $cemployer_birthdate_month		);
	$smarty->assign("cemployer_birthdate_year"		, $cemployer_birthdate_year		);
	$smarty->assign("cemployer_nationality"		, $cemployer_nationality			);
	$smarty->assign("cemployer_idnumber"			, $cemployer_idnumber				);
	$smarty->assign("cemployer_religion"			, $cemployer_religion				);
	$smarty->assign("cemployer_race"				, $cemployer_race					);
	$smarty->assign("cemployer_marital"			, $cemployer_marital				);
	$smarty->assign("cemployer_address"			, $cemployer_address				);
	$smarty->assign("cemployer_address2"			, $cemployer_address2				);
	$smarty->assign("cemployer_city"				, $cemployer_city					);
	$smarty->assign("cemployer_state"				, $cemployer_state					);
	$smarty->assign("cemployer_zip"				, $cemployer_zip					);
	$smarty->assign("cemployer_country"			, $cemployer_country				);
	$smarty->assign("cemployer_phone"				, $cemployer_phone					);
	$smarty->assign("cemployer_cellphone"			, $cemployer_cellphone				);
	$smarty->assign("cemployer_fax"				, $cemployer_fax					);
	$smarty->assign("cemployer_email"				, $cemployer_email					);
	$smarty->assign("cemployer_website"			, $cemployer_website				);

	$smarty->display('employer_register_step1.html');	



?>