<?



	

	$section	= "employer";
	include("setting.php");
	

	$db_connect = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());


	$sql_query  					= "SELECT * FROM jobseeker WHERE jobseeker_id = '$jobseeker'";
	$result							= mysql_query($sql_query) or die(mysql_error());
	$row 							= mysql_fetch_array($result);
	
	$jobseeker_id					= $row[jobseeker_id];
	$jobseeker_username				= $row[jobseeker_username];
	$jobseeker_password				= $row[jobseeker_password];
	
	$jobseeker_title				= $row[jobseeker_title];
	$sql_query						= "SELECT * FROM setup_personaltitle WHERE personaltitle_id = '$jobseeker_title'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_title				= $row_tmp[personaltitle_name];

	$jobseeker_firstname			= $row[jobseeker_firstname];
	$jobseeker_lastname				= $row[jobseeker_lastname];
	$jobseeker_fullname				= "$jobseeker_title $jobseeker_firstname $jobseeker_lastname";



	$jobseeker_birthdate			= F2BE712F08F5878F1C8F3DFF139674C86($row[jobseeker_birthdate], $date_format);
	$jobseeker_nationality			= $row[jobseeker_nationality];
	$jobseeker_idnumber				= $row[jobseeker_idnumber];

	$jobseeker_gender				= $row[jobseeker_gender];
	$sql_query						= "SELECT * FROM setup_gender WHERE gender_id = '$jobseeker_gender'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_gender				= $row_tmp[gender_name];	
	
	$jobseeker_religion				= $row[jobseeker_religion];
	$sql_query						= "SELECT * FROM setup_religion WHERE religion_id = '$jobseeker_religion'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_religion				= $row_tmp[religion_name];
		
	$jobseeker_race					= $row[jobseeker_race];
	$sql_query						= "SELECT * FROM setup_race WHERE race_id = '$jobseeker_race'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_race					= $row_tmp[race_name];
		
	$jobseeker_marital				= $row[jobseeker_marital];
	$sql_query						= "SELECT * FROM setup_maritalstatus WHERE maritalstatus_id = '$jobseeker_marital'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_marital				= $row_tmp[maritalstatus_name];
	
	$jobseeker_address				= $row[jobseeker_address];
	$jobseeker_address2				= $row[jobseeker_address2];
	$jobseeker_city					= $row[jobseeker_city];
	$jobseeker_state				= $row[jobseeker_state];
	$jobseeker_zip					= $row[jobseeker_zip];

	$jobseeker_country				= $row[jobseeker_country];
	$sql_query						= "SELECT * FROM setup_country WHERE country_id = '$jobseeker_country'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_country				= $row_tmp[country_name];

	$jobseeker_phone				= $row[jobseeker_phone];
	$jobseeker_cellphone			= $row[jobseeker_cellphone];
	$jobseeker_fax					= $row[jobseeker_fax];
	$jobseeker_email				= $row[jobseeker_email];
	$jobseeker_website				= $row[jobseeker_website];




	
	$jobseeker_r_title				= $row[jobseeker_resume_title];
	$jobseeker_r_workingyear		= $row[jobseeker_resume_workingyear];
	$jobseeker_r_expectedsalary		= $row[jobseeker_resume_expectedsalary];
	$jobseeker_r_expectedsalary		= $currency_symbol . number_format($jobseeker_r_expectedsalary, 2, $web_decimal_separator, $web_thousand_separator);;

	$jobseeker_r_fresh				= $row[jobseeker_resume_fresh];
	if ($jobseeker_r_fresh == "Y")	{ $jobseeker_r_fresh = $lang[lang_jobseeker_resume1_field_resume_fresh_option_yes];	}
	else							{ $jobseeker_r_fresh = $lang[lang_jobseeker_resume1_field_resume_fresh_option_no];	}
	
	$jobseeker_r_academic			= $row[jobseeker_resume_academic];
	$sql_query						= "SELECT * FROM setup_academic WHERE academic_id = '$jobseeker_r_academic'";
	$result_tmp						= mysql_query($sql_query) or die(mysql_error());
	$row_tmp						= mysql_fetch_array($result_tmp);
	$jobseeker_r_academic			= $row_tmp[academic_name];

	$jobseeker_r_availability		= $row[jobseeker_resume_availability];
	$jobseeker_r_availabilitydate	= F2BE712F08F5878F1C8F3DFF139674C86($row[jobseeker_resume_availabilitydate], $date_format);
	if ($jobseeker_r_availability	== "immediate" ) { $jobseeker_r_availability = $lang[lang_jobseeker_resume1_field_resume_availability_option_immediate]; }
	else											 { $jobseeker_r_availability = $jobseeker_r_availabilitydate; }

	$jobseeker_r_choice				= $row[jobseeker_resume_choice];
	$jobseeker_r_file				= $row[jobseeker_resume_file];



	
	$jobseeker_summary				= $row[jobseeker_summary];


	
	$jobseeker_i_industry			= "-". $row[jobseeker_interest_industry];
	$jobseeker_i_jobfunction		= "-". $row[jobseeker_interest_jobfunction];
	$jobseeker_i_position			= $row[jobseeker_interest_position];
	$jobseeker_i_employmentterm		= "-" . $row[jobseeker_interest_employmentterm];
	$jobseeker_i_joblocation		= "-" . $row[jobseeker_interest_joblocation];
	$jobseeker_certification		= $row[jobseeker_education_certification];



	if (strpos($jobseeker_i_industry, "-0-") > 0) { $jobseeker_i_industry = $lang[lang_value_any]; }
	else {
		$tmp_industry 			= explode("-", $jobseeker_i_industry);
		$tmp_industry_text		= "";
	
		for ($i=0; $i<=sizeof($tmp_industry); $i++) {
		
			$cur_industry		= $tmp_industry[$i];
			if ($cur_industry)	{
			
				$sql_query		= "SELECT * FROM setup_industry WHERE industry_id = '$cur_industry'";
				$result			= mysql_query($sql_query) or die(mysql_error());
				$row			= mysql_fetch_array($result);
				$industry_name	= $row[industry_name];
				if ($industry_name) { $tmp_industry_text .= "$industry_name<br>"; }
				
			}
		}
		$jobseeker_i_industry	= $tmp_industry_text;
	}
	
	
	


	if (strpos($jobseeker_i_jobfunction, "-0-") > 0) { $jobseeker_i_jobfunction = $lang[lang_value_any]; }
	else {
		$tmp_jobfunction		= explode("-", $jobseeker_i_jobfunction);
		$tmp_jobfunction_text	= "";
		
		for ($i=0; $i<=sizeof($tmp_jobfunction); $i++) {
		
			$cur_jobfunction	= $tmp_jobfunction[$i];
			if ($cur_jobfunction) {
	
				$sql_query			= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$cur_jobfunction'";
				$result				= mysql_query($sql_query) or die(mysql_error());
				$row				= mysql_fetch_array($result);
				$jobfunction_path	= FAC702E8FAC127246283241F9D547A143($row[jobfunction_path]);
				$jobfunction_path	= substr($jobfunction_path, 0, strlen($jobfunction_path) - 9);
				if ($jobfunction_path) { $tmp_jobfunction_text .= "$jobfunction_path<br>"; }
	
			}
		}
		$jobseeker_i_jobfunction	= $tmp_jobfunction_text;
	}
	



	$tmp_term			= explode("-", $jobseeker_i_employmentterm);
	$tmp_term_text		= "";
	
	for ($i=0; $i<=sizeof($tmp_term); $i++) {
	
		$cur_term	= $tmp_term[$i];
		if ($cur_term) {

			$sql_query	= "SELECT * FROM setup_term WHERE term_id = '$cur_term'";
			$result		= mysql_query($sql_query) or die(mysql_error());
			$row		= mysql_fetch_array($result);
			$term_name	= $row[term_name];
			if ($term_name) { $tmp_term_text .= "$term_name , "; }

		}

	}
	$jobseeker_i_employmentterm	= substr($tmp_term_text, 0, strlen($text_term) - 3);






	if (strpos($jobseeker_i_joblocation, "-0-") > 0) { $jobseeker_i_joblocation = $lang[lang_value_any]; }
	else {
		$tmp_joblocation		= explode("-", $jobseeker_i_joblocation);
		$tmp_joblocation_text	= "";
	
		for ($i=0; $i<=sizeof($tmp_joblocation); $i++) {
		
			$cur_joblocation	= $tmp_joblocation[$i];
			if ($cur_joblocation) {
	
				$sql_query			= "SELECT * FROM setup_joblocation WHERE joblocation_id = '$cur_joblocation'";
				$result				= mysql_query($sql_query) or die(mysql_error());
				$row				= mysql_fetch_array($result);
				$joblocation_name	= $row[joblocation_name];
				if ($joblocation_name) { $tmp_joblocation_text .= "$joblocation_name<br>"; }
	
			}
		}
		$jobseeker_i_joblocation	= $tmp_joblocation_text;
	}




	
	$sql_query						= "SELECT * FROM jobseeker_photo WHERE photo_main = 'yes' AND photo_jobseeker = '$jobseeker' AND photo_status = 'approved'";
	$result							= mysql_query($sql_query) or die(mysql_error());
	$row 							= mysql_fetch_array($result);
	$jobseeker_photo_found			= mysql_num_rows($result);
	$jobseeker_photo_id				= $row[photo_id];




	

	$i			= 0;
	$sql_query	= "
	SELECT * FROM jobseeker_education 
	WHERE 
	education_jobseeker  = '$jobseeker' AND
	education_start		!= ''			AND
	education_end		!= ''			AND
	education_school	!= ''			
	ORDER BY education_start ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$education	= mysql_num_rows($result);
	while ($row	= mysql_fetch_array($result)) {

		if ($i % 2 == 1) 	{ $bg_color = "FFFFFF"; } 
		else 				{ $bg_color = "EAF2FF"; } 
	
		$jobseeker_e_id						= $row[education_id];
		$jobseeker_e_year_start				= $row[education_start];
		$jobseeker_e_year_end				= $row[education_end];
		$jobseeker_e_school					= $row[education_school];
		$jobseeker_e_qualification			= $row[education_qualification];
		$jobseeker_e_major					= $row[education_major];
		$jobseeker_e_gpa					= $row[education_gpa];
		
		$arr_jobseeker_e_id[$i]				= $jobseeker_e_id;
		$arr_jobseeker_e_year_start[$i]		= $jobseeker_e_year_start;
		$arr_jobseeker_e_year_end[$i]		= $jobseeker_e_year_end;
		$arr_jobseeker_e_school[$i]			= $jobseeker_e_school;
		$arr_jobseeker_e_qualification[$i]	= $jobseeker_e_qualification;
		$arr_jobseeker_e_major[$i]			= $jobseeker_e_major;
		$arr_jobseeker_e_gpa[$i]			= $jobseeker_e_gpa;
		$i++;
		
	
	}
	
	
	
	
	
	$sql_query				= "SELECT * FROM setup_skilllevel";
	$result_tmp				= mysql_query($sql_query) or die(mysql_error());
	while ($row_tmp			= mysql_fetch_array($result_tmp)) {
	
		$skilllevel_id					= $row_tmp[skilllevel_id];
		$skilllevel_name				= $row_tmp[skilllevel_name];
		$arr_skill_id[$skilllevel_id]	= $skilllevel_name;
	
	}



	
	

	$i			= 0;
	$sql_query	= "
	SELECT * FROM jobseeker_language, setup_skilllanguage
	WHERE
	language_jobseeker   = '$jobseeker'			AND
	language_name		 =  skilllanguage_id	
	ORDER BY language_id ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$language	= mysql_num_rows($result);
	while ($row	= mysql_fetch_array($result)) {
	
	
		if ($i % 2 == 1) 		{ $bg_color = "FFFFFF"; } 
		else 					{ $bg_color = "EAF2FF"; } 

		$jobseeker_l_id					= $row[language_id];
		$jobseeker_l_name				= $row[skilllanguage_name];
		$jobseeker_l_reading			= $row[language_reading];
		$jobseeker_l_writting			= $row[language_writting];
		$jobseeker_l_speaking			= $row[language_speaking];
		$jobseeker_l_listening			= $row[language_listening];

		$jobseeker_l_reading			= $arr_skill_id[$jobseeker_l_reading];
		$jobseeker_l_writting			= $arr_skill_id[$jobseeker_l_writting];
		$jobseeker_l_speaking			= $arr_skill_id[$jobseeker_l_speaking];
		$jobseeker_l_listening			= $arr_skill_id[$jobseeker_l_listening];
		
		$arr_jobseeker_l_id[$i]			= $jobseeker_l_id;
		$arr_jobseeker_l_name[$i]		= $jobseeker_l_name;
		$arr_jobseeker_l_reading[$i]	= $jobseeker_l_reading;
		$arr_jobseeker_l_writting[$i]	= $jobseeker_l_writting;
		$arr_jobseeker_l_speaking[$i]	= $jobseeker_l_speaking;
		$arr_jobseeker_l_listening[$i]	= $jobseeker_l_listening;

		$i++;

	}



	

	$i			= 0;
	$sql_query	= "
	SELECT * FROM jobseeker_technical , setup_skillcomputer
	WHERE 
	technical_jobseeker  = '$jobseeker' 		AND
	technical_skill		 = 	skillcomputer_id
	ORDER BY technical_id ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$computer	= mysql_num_rows($result);
	while ($row	= mysql_fetch_array($result)) {
	

		if ($i % 2 == 1) 				{ $bg_color = "FFFFFF"; } 
		else 							{ $bg_color = "EAF2FF"; } 

		$jobseeker_t_id					= $row[technical_id];
		$jobseeker_t_skill				= $row[skillcomputer_name];
		$jobseeker_t_exp				= $row[technical_exp];
		$jobseeker_t_level				= $row[technical_level];
		$jobseeker_t_level				= $arr_skill_id[$jobseeker_t_level];

		if (!$jobseeker_t_exp)			{ $jobseeker_t_exp = 0; }

		
		$arr_jobseeker_t_id[$i]			= $jobseeker_t_id;
		$arr_jobseeker_t_skill[$i]		= $jobseeker_t_skill;
		$arr_jobseeker_t_exp[$i]		= $jobseeker_t_exp;
		$arr_jobseeker_t_level[$i]		= $jobseeker_t_level;
		$i++;

	}




	
	
	$i			= 0;
	$sql_query	= "
	SELECT * FROM jobseeker_other , setup_skillother
	WHERE 
	other_jobseeker  = '$jobseeker' 		AND
	other_skill		 = 	skillother_id
	ORDER BY other_id ASC
	";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$other		= mysql_num_rows($result);
	while ($row	= mysql_fetch_array($result)) {
	

		if ($i % 2 == 1) 				{ $bg_color = "FFFFFF"; } 
		else 							{ $bg_color = "EAF2FF"; } 

		$jobseeker_o_id					= $row[other_id];
		$jobseeker_o_skill				= $row[skillother_name];
		$jobseeker_o_exp				= $row[other_exp];
		$jobseeker_o_level				= $row[other_level];
		$jobseeker_o_level				= $arr_skill_id[$jobseeker_o_level];

		if (!$jobseeker_o_exp)			{ $jobseeker_o_exp = 0; }
		
		$arr_jobseeker_o_id[$i]			= $jobseeker_o_id;
		$arr_jobseeker_o_skill[$i]		= $jobseeker_o_skill;
		$arr_jobseeker_o_exp[$i]		= $jobseeker_o_exp;
		$arr_jobseeker_o_level[$i]		= $jobseeker_o_level;
		$i++;

	}




	

	$sql_query	= "SELECT * FROM jobseeker_workhistory WHERE history_jobseeker = '$jobseeker' ORDER BY history_end_present DESC, history_end DESC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {

		if ( $i % 2 == 1 )		{ $bg_color = "FFFFFF"; } 
		else 					{ $bg_color = "EAF2FF"; }

		$history_id				= $row[history_id];
		$history_jobseeker		= $row[history_jobseeker];
		$history_start			= $row[history_start];
		$history_end			= $row[history_end];
		$history_end_present	= $row[history_end_present];
		$history_company		= $row[history_company];
		$history_company2		= str_replace("'", "\'", $history_company);
		$history_industry		= $row[history_industry];
		$history_jobfunction	= $row[history_jobfunction];
		$history_position		= $row[history_position];
		$history_salary			= $row[history_salary];
		$history_salary			= "$currency_symbol " . number_format($history_salary, 2, $web_decimal_separator, $web_thousand_separator);
		$history_achievement	= $row[history_achievement];
		$history_achievement	= str_replace("\n", "<br>", $history_achievement);
		
		$sql_query				= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$history_jobfunction'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_jobfunction	= $row_tmp[jobfunction_name];

		$sql_query				= "SELECT * FROM setup_industry WHERE industry_id = '$history_industry'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_industry		= $row_tmp[industry_name];

		$history_start			= str_replace(" 00:00:00", "", $history_start);
		list ($yy, $mm, $dd)	= split("-", $history_start);
		$history_start_month	= $setup_monthname[$mm * 1];
		$history_start_year		= $yy;
		$history_start			= "$history_start_month $history_start_year";

		$history_end			= str_replace(" 00:00:00", "", $history_end);
		list ($yy, $mm, $dd)	= split("-", $history_end);
		$history_end_month		= $setup_monthname[$mm * 1];
		$history_end_year		= $yy;
		$history_end			= "$history_end_month $history_end_year";
		if ($history_end_present == "Y") { $history_end = $lang[lang_jobseeker_resume5_form_field_period_present]; }


		$arr_jobseeker_o_id[$i]			= $jobseeker_o_id;
		$arr_jobseeker_o_skill[$i]		= $jobseeker_o_skill;
		$arr_jobseeker_o_exp[$i]		= $jobseeker_o_exp;
		$arr_jobseeker_o_level[$i]		= $jobseeker_o_level;
		$i++;

	}





	$i			= 0;
	$sql_query	= "SELECT * FROM jobseeker_workhistory WHERE history_jobseeker = '$jobseeker' ORDER BY history_end_present DESC, history_end DESC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	$history	= mysql_num_rows($result);
	while($row	= mysql_fetch_array($result)) {


		if ($i % 2 == 0) 		{ $bgcolor	= "#EAF8FE"; } 
		else 					{ $bgcolor	= "#FFFFFF"; }

		$history_id				= $row[history_id];
		$history_jobseeker		= $row[history_jobseeker];
		$history_start			= $row[history_start];
		$history_end			= $row[history_end];
		$history_end_present	= $row[history_end_present];
		$history_company		= $row[history_company];
		$history_company2		= str_replace("'", "\'", $history_company);
		$history_industry		= $row[history_industry];
		$history_jobfunction	= $row[history_jobfunction];
		$history_position		= $row[history_position];
		$history_salary			= $row[history_salary];
		$history_salary			= "$currency_symbol " . number_format($history_salary, 2, $web_decimal_separator, $web_thousand_separator);
		$history_achievement	= $row[history_achievement];
		$history_achievement	= str_replace("\n", "<br>", $history_achievement);
		
		$sql_query				= "SELECT * FROM setup_jobfunction WHERE jobfunction_id = '$history_jobfunction'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_jobfunction	= $row_tmp[jobfunction_name];

		$sql_query				= "SELECT * FROM setup_industry WHERE industry_id = '$history_industry'";
		$result_tmp				= mysql_query($sql_query) or die(mysql_error());
		$row_tmp				= mysql_fetch_array($result_tmp);
		$history_industry		= $row_tmp[industry_name];

		$history_start			= str_replace(" 00:00:00", "", $history_start);
		list ($yy, $mm, $dd)	= split("-", $history_start);
		$history_start_month	= $setup_monthname[$mm * 1];
		$history_start_year		= $yy;
		$history_start			= "$history_start_month $history_start_year";

		$history_end			= str_replace(" 00:00:00", "", $history_end);
		list ($yy, $mm, $dd)	= split("-", $history_end);
		$history_end_month		= $setup_monthname[$mm * 1];
		$history_end_year		= $yy;
		$history_end			= "$history_end_month $history_end_year";
		if($history_end_present == "Y") { $history_end = $lang[lang_jobseeker_resume5_form_field_period_present]; }


		$arr_history_bgcolor[$i]		= $bgcolor;
		$arr_history_id[$i]				= $history_id;
		$arr_history_start[$i]			= $history_start;
		$arr_history_end[$i]			= $history_end;
		$arr_history_company[$i]		= $history_company;
		$arr_history_company2[$i]		= $history_company2;
		$arr_history_industry[$i]		= $history_industry;
		$arr_history_jobfunction[$i]	= $history_jobfunction;
		$arr_history_position[$i]		= $history_position;
		$arr_history_salary[$i]			= $history_salary;
		$arr_history_achievement[$i]	= $history_achievement;
		$i++;

	}




	
	$trow			= 0;
	$sql_query		= "SELECT * FROM jobseeker_photo WHERE photo_jobseeker = '$jobseeker' AND photo_status = 'approved'";
	$result			= mysql_query($sql_query) or die(mysql_error());
	$photo_found	= mysql_num_rows($result);
	while ($row		= mysql_fetch_array($result)) {

		$photo_id						= $row[photo_id];
		$photo_number					= $photo_id + $start_photo;
		$photo_main						= $row[photo_main];
		
		$arr_photo_row_id[$trow]		= $photo_id;
		$arr_photo_row_number[$trow]	= $photo_number;
		$arr_photo_row_main[$trow]		= $photo_main;
		
		
		for ($tcol=0; $tcol<=3; $tcol++) {
		
			if ($row	= mysql_fetch_array($result)) {

				$photo_id								= $row[photo_id];
				$photo_number							= $photo_id + $start_photo;
				$photo_main								= $row[photo_main];
				
				$arr_photo_col_id[$trow][$tcol]			= $photo_id;
				$arr_photo_col_number[$trow][$tcol]		= $photo_number;
				$arr_photo_col_main[$trow][$tcol]		= $photo_main;

			} 
		
		} 
		$trow++;
		
	}	

	mysql_close($db_connect);






	
	$smarty->assign("jobseeker_r_title"					, $jobseeker_r_title				);
	$smarty->assign("jobseeker_r_workingyear"			, $jobseeker_r_workingyear			);
	$smarty->assign("jobseeker_r_expectedsalary"		, $jobseeker_r_expectedsalary		);
	$smarty->assign("jobseeker_r_fresh"					, $jobseeker_r_fresh				);
	$smarty->assign("jobseeker_r_academic"				, $jobseeker_r_academic				);
	$smarty->assign("jobseeker_r_availability"			, $jobseeker_r_availability			);
	$smarty->assign("jobseeker_r_availabilitydate"		, $jobseeker_r_availabilitydate		);
	$smarty->assign("jobseeker_r_file"					, $jobseeker_r_file					);

	$smarty->assign("jobseeker_title"					, $jobseeker_title					);
	$smarty->assign("jobseeker_firstname"				, $jobseeker_firstname				);
	$smarty->assign("jobseeker_lastname"				, $jobseeker_lastname				);
	$smarty->assign("jobseeker_fullname"				, $jobseeker_fullname				);
	$smarty->assign("jobseeker_birthdate"				, $jobseeker_birthdate				);
	$smarty->assign("jobseeker_nationality"				, $jobseeker_nationality			);
	$smarty->assign("jobseeker_idnumber"				, $jobseeker_idnumber				);
	$smarty->assign("jobseeker_gender"					, $jobseeker_gender					);
	$smarty->assign("jobseeker_religion"				, $jobseeker_religion				);
	$smarty->assign("jobseeker_race"					, $jobseeker_race					);
	$smarty->assign("jobseeker_marital"					, $jobseeker_marital				);
	$smarty->assign("jobseeker_address"					, $jobseeker_address				);
	$smarty->assign("jobseeker_address2"				, $jobseeker_address2				);
	$smarty->assign("jobseeker_city"					, $jobseeker_city					);
	$smarty->assign("jobseeker_state"					, $jobseeker_state					);
	$smarty->assign("jobseeker_zip"						, $jobseeker_zip					);
	$smarty->assign("jobseeker_country"					, $jobseeker_country				);
	$smarty->assign("jobseeker_phone"					, $jobseeker_phone					);
	$smarty->assign("jobseeker_cellphone"				, $jobseeker_cellphone				);
	$smarty->assign("jobseeker_fax"						, $jobseeker_fax					);
	$smarty->assign("jobseeker_email"					, $jobseeker_email					);
	$smarty->assign("jobseeker_website"					, $jobseeker_website				);
	$smarty->assign("jobseeker_summary"					, $jobseeker_summary				);

	$smarty->assign("jobseeker_photo_found"				, $jobseeker_photo_found			);
	$smarty->assign("jobseeker_photo_id"				, $jobseeker_photo_id				);

	$smarty->assign("jobseeker_i_industry"				, $jobseeker_i_industry				);
	$smarty->assign("jobseeker_i_jobfunction"			, $jobseeker_i_jobfunction			);
	$smarty->assign("jobseeker_i_position"				, $jobseeker_i_position				);
	$smarty->assign("jobseeker_i_employmentterm"		, $jobseeker_i_employmentterm		);
	$smarty->assign("jobseeker_i_joblocation"			, $jobseeker_i_joblocation			);
	$smarty->assign("jobseeker_certification"			, $jobseeker_certification			);

	$smarty->assign("jobseeker_e_found"					, $education						);
	$smarty->assign("jobseeker_e_id"					, $arr_jobseeker_e_id				);
	$smarty->assign("jobseeker_e_year_start"			, $arr_jobseeker_e_year_start		);
	$smarty->assign("jobseeker_e_year_end"				, $arr_jobseeker_e_year_end			);
	$smarty->assign("jobseeker_e_school"				, $arr_jobseeker_e_school			);
	$smarty->assign("jobseeker_e_qualification"			, $arr_jobseeker_e_qualification	);
	$smarty->assign("jobseeker_e_major"					, $arr_jobseeker_e_major			);
	$smarty->assign("jobseeker_e_gpa"					, $arr_jobseeker_e_gpa				);

	$smarty->assign("jobseeker_l_found"					, $language							);
	$smarty->assign("jobseeker_l_id"					, $arr_jobseeker_l_id				);
	$smarty->assign("jobseeker_l_name"					, $arr_jobseeker_l_name				);
	$smarty->assign("jobseeker_l_reading"				, $arr_jobseeker_l_reading			);
	$smarty->assign("jobseeker_l_writting"				, $arr_jobseeker_l_writting			);
	$smarty->assign("jobseeker_l_speaking"				, $arr_jobseeker_l_speaking			);
	$smarty->assign("jobseeker_l_listening"				, $arr_jobseeker_l_listening		);

	$smarty->assign("jobseeker_t_found"					, $computer							);
	$smarty->assign("jobseeker_t_id"					, $arr_jobseeker_t_id				);
	$smarty->assign("jobseeker_t_skill"					, $arr_jobseeker_t_skill			);
	$smarty->assign("jobseeker_t_exp"					, $arr_jobseeker_t_exp				);
	$smarty->assign("jobseeker_t_level"					, $arr_jobseeker_t_level			);

	$smarty->assign("jobseeker_o_found"					, $other							);
	$smarty->assign("jobseeker_o_id"					, $arr_jobseeker_o_id				);
	$smarty->assign("jobseeker_o_skill"					, $arr_jobseeker_o_skill			);
	$smarty->assign("jobseeker_o_exp"					, $arr_jobseeker_o_exp				);
	$smarty->assign("jobseeker_o_level"					, $arr_jobseeker_o_level			);

	$smarty->assign("history_found"						, $history							);
	$smarty->assign("history_bgcolor"					, $arr_history_bgcolor				);
	$smarty->assign("history_id"						, $arr_history_id					);
	$smarty->assign("history_start"						, $arr_history_start				);
	$smarty->assign("history_end"						, $arr_history_end					);
	$smarty->assign("history_company"					, $arr_history_company				);
	$smarty->assign("history_company2"					, $arr_history_company2				);
	$smarty->assign("history_industry"					, $arr_history_industry				);
	$smarty->assign("history_jobfunction"				, $arr_history_jobfunction			);
	$smarty->assign("history_position"					, $arr_history_position				);
	$smarty->assign("history_salary"					, $arr_history_salary				);
	$smarty->assign("history_achievement"				, $arr_history_achievement			);

	$smarty->assign("photo_found"						, $photo_found						);
	$smarty->assign("photo_width_thumb"					, $photo_width_thumb				);
	$smarty->assign("photo_height_thumb"				, $photo_height_thumb				);

	$smarty->assign("row_photo_id"						, $arr_photo_row_id					);
	$smarty->assign("row_photo_number"					, $arr_photo_row_number				);
	$smarty->assign("row_photo_main"					, $arr_photo_row_main				);

	$smarty->assign("col_photo_id"						, $arr_photo_col_id					);
	$smarty->assign("col_photo_number"					, $arr_photo_col_number				);
	$smarty->assign("col_photo_main"					, $arr_photo_col_main				);

	$smarty->display('employer_job_jobseekers_detail_print.html');	
	


?>