<?



	



	$section	= "jobseeker";
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

		if ($personaltitle_id == $cjobseeker_title) { $arr_personaltitle_status[$i] = "yes"; }

		$i++;
		
	} 



	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_gender ORDER BY gender_order ASC, gender_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$gender_id				= $row[gender_id];
		$gender_name			= $row[gender_name];
		
		$arr_gender_id[$i]		= $gender_id;
		$arr_gender_name[$i]	= $gender_name;
		$arr_gender_status[$i]	= "no";
		
		if ($i == 0  &&  !$cjobseeker_gender) { $cjobseeker_gender		= $gender_id; 	}
		if ($gender_id == $cjobseeker_gender) { $arr_gender_status[$i]	= "yes";		}
		$i++;

	} 
	
	
	
	
	for ($i=1; $i<=31; $i++) { 
		
		$arr_birthdate_date_id[$i - 1]		= $i;
		$arr_birthdate_date_status[$i - 1]	= "no";
		if ($i == $cjobseeker_birthdate_date) { $arr_birthdate_date_status[$i - 1]	= "yes";	}
		
	}



	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_monthname ORDER BY monthname_order ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$monthname_id					= $row[monthname_id];
		$monthname_name					= $row[monthname_name];

		$arr_birthdate_month_id[$i]		= $monthname_id;
		$arr_birthdate_month_name[$i]	= $monthname_name;
		$arr_birthdate_month_status[$i]	= "no";
		
		if ($monthname_id == $cjobseeker_birthdate_month) { $arr_birthdate_month_status[$i]	= "yes";	}
		$i++;

	} 



	
	$i	= 0;
	for ($year = $year_start; $year <= $date_year - $year_candidate_age_min; $year++) {

		$arr_birthdate_year_id[$i]		= $year;
		$arr_birthdate_year_status[$i]	= "no";

		if ($year == $cjobseeker_birthdate_year) { $arr_birthdate_year_status[$i] = "yes";	}
		$i++;

	}
	
	

	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_religion ORDER BY religion_order ASC, religion_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$religion_id				= $row[religion_id];
		$religion_name				= $row[religion_name];	

		$arr_religion_id[$i]		= $religion_id;
		$arr_religion_name[$i]		= $religion_name;
		$arr_religion_status[$i]	= "no";
		
		if ($religion_id == $cjobseeker_religion) { $arr_religion_status[$i] = "yes"; }
		$i++;

	} 
	
	

	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_race ORDER BY race_order ASC, race_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$race_id				= $row[race_id];
		$race_name				= $row[race_name];	

		$arr_race_id[$i]		= $race_id;
		$arr_race_name[$i]		= $race_name;
		$arr_race_status[$i]	= "no";
		
		if ($race_id == $cjobseeker_race) { $arr_race_status[$i] = "yes"; }
		$i++;

	} 




	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_maritalstatus ORDER BY maritalstatus_order ASC, maritalstatus_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$maritalstatus_id				= $row[maritalstatus_id];
		$maritalstatus_name				= $row[maritalstatus_name];	

		$arr_maritalstatus_id[$i]		= $maritalstatus_id;
		$arr_maritalstatus_name[$i]		= $maritalstatus_name;
		$arr_maritalstatus_status[$i]	= "no";
		
		if ($maritalstatus_id == $cjobseeker_marital) { $arr_maritalstatus_status[$i] = "yes"; }
		$i++;

	} 
	
	
	
	
	$i			= 0;
	$sql_query	= "SELECT * FROM setup_country ORDER BY country_order ASC, country_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$country_id					= $row[country_id];
		$country_name				= $row[country_name];	

		$arr_country_id[$i]			= $country_id;
		$arr_country_name[$i]		= $country_name;
		$arr_country_status[$i]		= "no";
		
		if ($country_id == $cjobseeker_country) { $arr_country_status[$i] = "yes"; }
		$i++;

	} 
	
	
	
	
    if ($cjobseeker_username_warn			)	{ $warning_jobseeker_username		= "warning"; } else { $warning_jobseeker_username		= "normal_12_black"; }
    if ($cjobseeker_password_warn			)	{ $warning_jobseeker_password		= "warning"; } else { $warning_jobseeker_password		= "normal_12_black"; }
    if ($cjobseeker_firstname_warn			)	{ $warning_jobseeker_firstname		= "warning"; } else { $warning_jobseeker_firstname		= "normal_12_black"; }
    if ($cjobseeker_lastname_warn			)	{ $warning_jobseeker_lastname		= "warning"; } else { $warning_jobseeker_lastname		= "normal_12_black"; }
    if ($cjobseeker_birthdate_date_warn		)	{ $warning_jobseeker_birthdate		= "warning"; } else { $warning_jobseeker_birthdate		= "normal_12_black"; }
    if ($cjobseeker_birthdate_month_warn	)	{ $warning_jobseeker_birthdate		= "warning"; } else { $warning_jobseeker_birthdate		= "normal_12_black"; }
    if ($cjobseeker_birthdate_year_warn		)	{ $warning_jobseeker_birthdate		= "warning"; } else { $warning_jobseeker_birthdate		= "normal_12_black"; }
    if ($cjobseeker_nationality_warn		)	{ $warning_jobseeker_nationality	= "warning"; } else { $warning_jobseeker_nationality	= "normal_12_black"; }
    if ($cjobseeker_idnumber_warn			)	{ $warning_jobseeker_idnumber		= "warning"; } else { $warning_jobseeker_idnumber		= "normal_12_black"; }
    if ($cjobseeker_religion_warn			)	{ $warning_jobseeker_religion		= "warning"; } else { $warning_jobseeker_religion		= "normal_12_black"; }
    if ($cjobseeker_race_warn				)	{ $warning_jobseeker_race			= "warning"; } else { $warning_jobseeker_race			= "normal_12_black"; }
    if ($cjobseeker_marital_warn			)	{ $warning_jobseeker_marital		= "warning"; } else { $warning_jobseeker_marital		= "normal_12_black"; }
    if ($cjobseeker_address_warn			)	{ $warning_jobseeker_address		= "warning"; } else { $warning_jobseeker_address		= "normal_12_black"; }
    if ($cjobseeker_city_warn				)	{ $warning_jobseeker_city			= "warning"; } else { $warning_jobseeker_city			= "normal_12_black"; }
    if ($cjobseeker_state_warn				)	{ $warning_jobseeker_state			= "warning"; } else { $warning_jobseeker_state			= "normal_12_black"; }
    if ($cjobseeker_zip_warn				)	{ $warning_jobseeker_zip			= "warning"; } else { $warning_jobseeker_zip			= "normal_12_black"; }
    if ($cjobseeker_country_warn			)	{ $warning_jobseeker_country		= "warning"; } else { $warning_jobseeker_country		= "normal_12_black"; }
    if ($cjobseeker_phone_warn				)	{ $warning_jobseeker_phone			= "warning"; } else { $warning_jobseeker_phone			= "normal_12_black"; }
    if ($cjobseeker_cellphone_warn			)	{ $warning_jobseeker_cellphone		= "warning"; } else { $warning_jobseeker_cellphone		= "normal_12_black"; }
    if ($cjobseeker_fax_warn				)	{ $warning_jobseeker_fax			= "warning"; } else { $warning_jobseeker_fax			= "normal_12_black"; }
    if ($cjobseeker_email_warn				)	{ $warning_jobseeker_email			= "warning"; } else { $warning_jobseeker_email			= "normal_12_black"; }
    if ($cjobseeker_website_warn			)	{ $warning_jobseeker_website		= "warning"; } else { $warning_jobseeker_website		= "normal_12_black"; }
    if ($cverification_code_warn			)	{ $warning_verification_code		= "warning"; } else { $warning_verification_code		= "normal_12_black"; }



	
	if (!$cjobseeker_website) { $cjobseeker_website = "http://www.";}



	

	$smarty->assign("warning_jobseeker_username"	, $warning_jobseeker_username		);
	$smarty->assign("warning_jobseeker_password"	, $warning_jobseeker_password		);
	$smarty->assign("warning_jobseeker_firstname"	, $warning_jobseeker_firstname		);
	$smarty->assign("warning_jobseeker_lastname"	, $warning_jobseeker_lastname		);
	$smarty->assign("warning_jobseeker_gender"		, $warning_jobseeker_gender			);
	$smarty->assign("warning_jobseeker_birthdate"	, $warning_jobseeker_birthdate		);
	$smarty->assign("warning_jobseeker_nationality"	, $warning_jobseeker_nationality	);
	$smarty->assign("warning_jobseeker_idnumber"	, $warning_jobseeker_idnumber		);
	$smarty->assign("warning_jobseeker_religion"	, $warning_jobseeker_religion		);
	$smarty->assign("warning_jobseeker_race"		, $warning_jobseeker_race			);
	$smarty->assign("warning_jobseeker_marital"		, $warning_jobseeker_marital		);
	$smarty->assign("warning_jobseeker_address"		, $warning_jobseeker_address		);
	$smarty->assign("warning_jobseeker_city"		, $warning_jobseeker_city			);
	$smarty->assign("warning_jobseeker_state"		, $warning_jobseeker_state			);
	$smarty->assign("warning_jobseeker_zip"			, $warning_jobseeker_zip			);
	$smarty->assign("warning_jobseeker_country"		, $warning_jobseeker_country		);
	$smarty->assign("warning_jobseeker_phone"		, $warning_jobseeker_phone			);
	$smarty->assign("warning_jobseeker_cellphone"	, $warning_jobseeker_cellphone		);
	$smarty->assign("warning_jobseeker_fax"			, $warning_jobseeker_fax			);
	$smarty->assign("warning_jobseeker_email"		, $warning_jobseeker_email			);
	$smarty->assign("warning_jobseeker_website"		, $warning_jobseeker_website		);
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

	
	$smarty->assign("cjobseeker_username"			, $cjobseeker_username				);
	$smarty->assign("cjobseeker_password"			, $cjobseeker_password				);
	$smarty->assign("cjobseeker_title"				, $cjobseeker_title					);
	$smarty->assign("cjobseeker_firstname"			, $cjobseeker_firstname				);
	$smarty->assign("cjobseeker_lastname"			, $cjobseeker_lastname				);
	$smarty->assign("cjobseeker_gender"				, $cjobseeker_gender				);
	$smarty->assign("cjobseeker_birthdate_date"		, $cjobseeker_birthdate_date		);
	$smarty->assign("cjobseeker_birthdate_month"	, $cjobseeker_birthdate_month		);
	$smarty->assign("cjobseeker_birthdate_year"		, $cjobseeker_birthdate_year		);
	$smarty->assign("cjobseeker_nationality"		, $cjobseeker_nationality			);
	$smarty->assign("cjobseeker_idnumber"			, $cjobseeker_idnumber				);
	$smarty->assign("cjobseeker_religion"			, $cjobseeker_religion				);
	$smarty->assign("cjobseeker_race"				, $cjobseeker_race					);
	$smarty->assign("cjobseeker_marital"			, $cjobseeker_marital				);
	$smarty->assign("cjobseeker_address"			, $cjobseeker_address				);
	$smarty->assign("cjobseeker_address2"			, $cjobseeker_address2				);
	$smarty->assign("cjobseeker_city"				, $cjobseeker_city					);
	$smarty->assign("cjobseeker_state"				, $cjobseeker_state					);
	$smarty->assign("cjobseeker_zip"				, $cjobseeker_zip					);
	$smarty->assign("cjobseeker_country"			, $cjobseeker_country				);
	$smarty->assign("cjobseeker_phone"				, $cjobseeker_phone					);
	$smarty->assign("cjobseeker_cellphone"			, $cjobseeker_cellphone				);
	$smarty->assign("cjobseeker_fax"				, $cjobseeker_fax					);
	$smarty->assign("cjobseeker_email"				, $cjobseeker_email					);
	$smarty->assign("cjobseeker_website"			, $cjobseeker_website				);

	$smarty->display('jobseeker_register.html');	



?>