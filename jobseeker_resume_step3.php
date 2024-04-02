<?



	



	$section	= "jobseeker";
	include("setting.php");
	include("jobseeker_check.php");
	


	
	$random_code 			= strtoupper(F6655399800C8826ABD253A180B1AF9B6(5));
	$status_img_captcha		= "no";
	setcookie("cpasscode", $random_code);
	


	$db_connect	= mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $db_connect) || die(mysql_error());



	
	$jobseeker							= $clogin_jobseeker;
	$sql_query  						= "SELECT * FROM jobseeker WHERE jobseeker_id = '$jobseeker'";
	$result								= mysql_query($sql_query) or die(mysql_error());
	$row 								= mysql_fetch_array($result);

	$jobseeker_interest_industry		= "-". $row[jobseeker_interest_industry];
	$jobseeker_interest_jobfunction		= "-". $row[jobseeker_interest_jobfunction];
	$jobseeker_interest_position		= $row[jobseeker_interest_position];
	$jobseeker_interest_employmentterm	= "-" . $row[jobseeker_interest_employmentterm];
	$jobseeker_interest_joblocation		= "-" . $row[jobseeker_interest_joblocation];
	$jobseeker_education_certification	= $row[jobseeker_education_certification];
	
	
	
	
	
	$i									= 0;
	$industry_id						= 0;
	$industry_name						= $lang[lang_value_any];
	$industry_pos						= strpos($jobseeker_interest_industry, "-$industry_id-");
	$arr_interest_industry_id[$i]		= $industry_id;
	$arr_interest_industry_name[$i]		= $industry_name;
	$arr_interest_industry_status[$i]	= "no";
	if ($industry_pos > 0				) { $arr_interest_industry_status[$i] = "yes";	}
	
	$i++;

	$sql_query	= "SELECT * FROM setup_industry ORDER BY industry_order ASC, industry_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$industry_id						= $row[industry_id];
		$industry_name						= $row[industry_name];
		$industry_pos						= strpos($jobseeker_interest_industry, "-$industry_id-");

		$arr_interest_industry_id[$i]		= $industry_id;
		$arr_interest_industry_name[$i]		= $industry_name;
		$arr_interest_industry_status[$i]	= "no";
		if ($industry_pos > 0				) { $arr_interest_industry_status[$i] = "yes";	}
		$i++;

	} 




	
	$i										= 0;
	$jobfunction_id							= 0;
	$jobfunction_name						= $lang[lang_value_any];
	$jobfunction_pos						= strpos($jobseeker_interest_jobfunction, "-$jobfunction_id-");
	$arr_interest_jobfunction_id[$i]		= $jobfunction_id;
	$arr_interest_jobfunction_name[$i]		= $jobfunction_name;
	$arr_interest_jobfunction_status[$i]	= "no";
	if ($jobfunction_pos > 0				) { $arr_interest_jobfunction_status[$i] = "yes";	}
	
	$i++;

	$sql_query	= "SELECT * FROM setup_jobfunction ORDER BY jobfunction_pathname ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$jobfunction_id							= $row[jobfunction_id];
		$jobfunction_name						= $row[jobfunction_name];
		$jobfunction_level						= FB10052434D1D793F3AF424A01B909A4A($jobfunction_id);
		$jobfunction_pos						= strpos($jobseeker_interest_jobfunction, "-$jobfunction_id-");

		$jobfunction_space						= "";
		for ($j=1; $j<=$jobfunction_level-1; $j++)  { $jobfunction_space .= "&nbsp;&nbsp;&nbsp;&nbsp;";	}
		if  ($jobfunction_level > 1)				{ $jobfunction_space .= "+"; 					}

		$jobfunction_name						= "$jobfunction_space $jobfunction_name";
		$arr_interest_jobfunction_id[$i]		= $jobfunction_id;
		$arr_interest_jobfunction_name[$i]		= $jobfunction_name;
		$arr_interest_jobfunction_status[$i]	= "no";
		if ($jobfunction_pos > 0				) { $arr_interest_jobfunction_status[$i] = "yes";	}
		$i++;

	} 
	
	
	

	
	
	$trow		= 0;
	$sql_query	= "SELECT * FROM setup_term ORDER BY term_order ASC, term_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)) {
	
		$term_id							= $row[term_id];
		$term_name							= $row[term_name];
		$term_pos							= strpos($jobseeker_interest_employmentterm, "-$term_id-");
		$arr_interest_rterm_id[$trow]		= $term_id;
		$arr_interest_rterm_name[$trow]		= $term_name;
		$arr_interest_rterm_status[$trow]	= "no";
		if ($term_pos > 0					) { $arr_interest_rterm_status[$trow] = "yes";	}
		
		for ($tcol=0; $tcol<=1; $tcol++) {
		
			if ($row	= mysql_fetch_array($result)) {

				$term_id									= $row[term_id];
				$term_name									= $row[term_name];
				$term_pos									= strpos($jobseeker_interest_employmentterm, "-$term_id-");
				$arr_interest_cterm_id[$trow][$tcol]		= $term_id;
				$arr_interest_cterm_name[$trow][$tcol]		= $term_name;
				$arr_interest_cterm_status[$trow][$tcol]	= "no";
				if ($term_pos > 0							) { $arr_interest_cterm_status[$trow][$tcol] = "yes";	}

			}
		
		}
		$trow++;

	} 
	
	
	
	
	
	$i										= 0;
	$joblocation_id							= 0;
	$joblocation_name						= $lang[lang_value_any];
	$joblocation_pos						= strpos($jobseeker_interest_joblocation, "-$joblocation_id-");
	$arr_interest_joblocation_id[$i]		= $joblocation_id;
	$arr_interest_joblocation_name[$i]		= $joblocation_name;
	$arr_interest_joblocation_status[$i]	= "no";
	if ($joblocation_pos > 0				) { $arr_interest_joblocation_status[$i] = "yes";	}
	
	$i++;

	$sql_query	= "SELECT * FROM setup_joblocation ORDER BY joblocation_order ASC, joblocation_name ASC";
	$result		= mysql_query($sql_query) or die(mysql_error());
	while($row	= mysql_fetch_array($result)){
		
		$joblocation_id							= $row[joblocation_id];
		$joblocation_name						= $row[joblocation_name];
		$joblocation_pos						= strpos($jobseeker_interest_joblocation, "-$joblocation_id-");

		$arr_interest_joblocation_id[$i]		= $joblocation_id;
		$arr_interest_joblocation_name[$i]		= $joblocation_name;
		$arr_interest_joblocation_status[$i]	= "no";
		if ($joblocation_pos > 0				) { $arr_interest_joblocation_status[$i] = "yes";	}
		$i++;

	} 
	


	
	
    if ($cjobseeker_interest_industry_warn			)	{ $warning_jobseeker_interest_industry			= "warning"; } else { $warning_jobseeker_interest_industry			= "normal_12_black"; }
    if ($cjobseeker_interest_jobfunction_warn		)	{ $warning_jobseeker_interest_jobfunction		= "warning"; } else { $warning_jobseeker_interest_jobfunction		= "normal_12_black"; }
    if ($cjobseeker_interest_position_warn			)	{ $warning_jobseeker_interest_position			= "warning"; } else { $warning_jobseeker_interest_position			= "normal_12_black"; }
    if ($cjobseeker_interest_employmentterm_warn	)	{ $warning_jobseeker_interest_employmentterm	= "warning"; } else { $warning_jobseeker_interest_employmentterm	= "normal_12_black"; }
    if ($cjobseeker_interest_joblocation_warn		)	{ $warning_jobseeker_interest_joblocation		= "warning"; } else { $warning_jobseeker_interest_joblocation		= "normal_12_black"; }
    if ($cverification_code_warn					)	{ $warning_verification_code					= "warning"; } else { $warning_verification_code					= "normal_12_black"; }

	
	$smarty->assign("warning_jobseeker_interest_industry"		, $warning_jobseeker_interest_industry			);
	$smarty->assign("warning_jobseeker_interest_jobfunction"	, $warning_jobseeker_interest_jobfunction		);
	$smarty->assign("warning_jobseeker_interest_position"		, $warning_jobseeker_interest_position			);
	$smarty->assign("warning_jobseeker_interest_employmentterm"	, $warning_jobseeker_interest_employmentterm	);
	$smarty->assign("warning_jobseeker_interest_joblocation"	, $warning_jobseeker_interest_joblocation		);
	$smarty->assign("warning_verification_code"					, $warning_verification_code					);

	
	$smarty->assign("interest_industry_id"						, $arr_interest_industry_id						);
	$smarty->assign("interest_industry_name"					, $arr_interest_industry_name					);
	$smarty->assign("interest_industry_status"					, $arr_interest_industry_status					);
	$smarty->assign("interest_jobfunction_id"					, $arr_interest_jobfunction_id					);
	$smarty->assign("interest_jobfunction_name"					, $arr_interest_jobfunction_name				);
	$smarty->assign("interest_jobfunction_status"				, $arr_interest_jobfunction_status				);

	$smarty->assign("interest_rterm_id"							, $arr_interest_rterm_id						);
	$smarty->assign("interest_rterm_name"						, $arr_interest_rterm_name						);
	$smarty->assign("interest_rterm_status"						, $arr_interest_rterm_status					);
	$smarty->assign("interest_cterm_id"							, $arr_interest_cterm_id						);
	$smarty->assign("interest_cterm_name"						, $arr_interest_cterm_name						);
	$smarty->assign("interest_cterm_status"						, $arr_interest_cterm_status					);

	$smarty->assign("interest_joblocation_id"					, $arr_interest_joblocation_id					);
	$smarty->assign("interest_joblocation_name"					, $arr_interest_joblocation_name				);
	$smarty->assign("interest_joblocation_status"				, $arr_interest_joblocation_status				);

	
	$smarty->assign("jobseeker_interest_position"				, $jobseeker_interest_position					);
	$smarty->assign("status_img_captcha"						, $status_img_captcha							);
	$smarty->display('jobseeker_resume_step3.html');	



?>