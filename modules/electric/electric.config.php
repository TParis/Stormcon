<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'elec_id', 'hidden', 10, 'elec_id', null),
			Array('Last Modified', 'elec_last_modified', 'modified', 10, 'elec_last_modified', null),
			Array('SWPPP Information', null, 'zone', 0,  null, 
				Array('Project Information', null, 'zone', 0,  null,
					Array('Project Number', 'elec_proj_num', 'text', 10, 'elec_proj_num', null),
					Array('Project originator', 'elec_proj_orig', 'text', 50, 'elec_proj_orig', null),
					Array('Project Contact', 'elec_proj_contact', 'drop-down', 50, 'elec_proj_contact',
						Array(
							'table_name' => 'view_contacts',
							'elec_proj_contact' => 'contact_name'
						)
					),
					Array('Customer Project #/s', 'elec_proj_customer_num', 'text', 50, 'elec_proj_customer_num', null)
				),
				Array('Order Date', 'elec_proj_order_date', 'text', '25', 'elec_proj_order_date', null),
				Array('Preparation Date', 'elec_proj_prep_date', 'text', '25', 'elec_proj_prep_date', null),
			),
			Array('Operator Information', null, 'zone', 0,  null, 
				Array('Electric provider company', null, 'zone', 0,  null,
					Array('Legal Name', 'elec_prov_company_name', 'drop-down', 100, 'elec_prov_company_name',
						Array(
							'table_name'							=>	'companies',
							'elec_prov_company_name'				=>	'[Legal Company Name]',
							'elec_prov_company_owner'				=>	'[Company name]',
							'elec_prov_company_address'				=>	'Address',
							'elec_prov_company_city'				=>	'City',
							'elec_prov_company_state'				=>	'State',
							'elec_prov_company_zip'					=>	'Zip',
							'elec_prov_company_phone'				=>	'[Phone number]',
							'elec_prov_company_fax'					=>	'[Fax Number]',
							'elec_prov_company_cn'					=>	'[CN number]',
							'elec_prov_company_num_of_employees'	=>	'[# of comployees]',
							'elec_prov_company_tax_id'				=>	'[State tax id]',
							'elec_prov_company_sos_num'				=>	'[SOS #]',
							'elec_prov_company_duns_num'			=>	'[DUNS #]',
							'elec_prov_company_type'				=>	'[Type of company]',
							'elec_prov_company_sic_code'			=>	'[SIC code]',
							'elec_prov_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "elec_prov_company_name"),
																			'elec_prov_company_contact' => 'contact_name'
																		),
							'elec_prov_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "elec_prov_company_name", "[NOI Signer]" => 1),
																			'elec_prov_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'elec_prov_company_owner', 'text', 100, 'elec_prov_company_owner', null),
					Array('Address', 'elec_prov_company_address', 'text', 250, 'elec_prov_company_address', null),
					Array('City', 'elec_prov_company_city', 'text', 100, 'elec_prov_company_city', null),
					Array('State', 'elec_prov_company_state', 'text', 100, 'elec_prov_company_state', null),
					Array('Zip', 'elec_prov_company_zip', 'num', 25, 'elec_prov_company_zip', null),
					Array('Phone number', 'elec_prov_company_phone', 'phone', 25, 'elec_prov_company_phone', null),
					Array('Fax Number', 'elec_prov_company_fax', 'phone', 25, 'elec_prov_company_fax', null),
					Array('CN number', 'elec_prov_company_cn', 'text', 25, 'elec_prov_company_cn', null),
					Array('# of employees', 'elec_prov_company_num_of_employees', 'text', 10, 'elec_prov_company_num_of_employees', null),
					Array('State tax id', 'elec_prov_company_tax_id', 'text', 25, 'elec_prov_company_tax_id', null),
					Array('SOS #', 'elec_prov_company_sos_num', 'text', 25, 'elec_prov_company_sos_num', null),
					Array('DUNS #', 'elec_prov_company_duns_num', 'text', 25, 'elec_prov_company_duns_num', null),
					Array('Type of company', 'elec_prov_company_type', 'text', 50, 'elec_prov_company_type', null),
					Array('SIC code', 'elec_prov_company_sic_code', 'text', 25, 'elec_prov_company_sic_code', null),
					Array('Contact', 'elec_prov_company_contact', 'drop-down', 250, 'elec_prov_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'elec_prov_company_name'),
							'elec_prov_company_contact'				=>	'contact_name',
							'elec_prov_company_contact_title'		=>	'Title',
							'elec_prov_company_contact_email'		=>	'Email',
							'elec_prov_company_contact_company'		=>	'Company',
							'elec_prov_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'elec_prov_company_contact_title', 'text', 25, 'elec_prov_company_contact_title', null),
					Array('Contact phone', 'elec_prov_company_contact_phone', 'phone', 25, 'elec_prov_company_contact_phone', null),
					Array('Contact email', 'elec_prov_company_contact_email', 'email', 250, 'elec_prov_company_contact_email', null),
					Array('Contact company', 'elec_prov_company_contact_company', 'text', 100, 'elec_prov_company_contact_company', null),
					Array('Contact fax', 'elec_prov_company_contact_fax', 'text', 25, 'elec_prov_company_contact_fax', null),
					Array('NOI Signer', 'elec_prov_company_noi_signer', 'drop-down', 250, 'elec_prov_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'elec_prov_company_name', '[NOI Signer]' => 1),
							'elec_prov_company_noi_signer'			=>	'contact_name',
							'elec_prov_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'elec_prov_company_noi_signer_title', 'text', 250, 'elec_prov_company_noi_signer_title', null)
				),
				Array('Electric contractor', null, 'zone', 0,  null,
					Array('Legal Name', 'elec_cont_company_name', 'drop-down', 250, 'elec_cont_company_name',
						Array(
							'table_name'							=>	'companies',
							'elec_cont_company_name'				=>	'[Legal Company Name]',
							'elec_cont_company_owner'				=>	'[Company name]',
							'elec_cont_company_address'				=>	'Address',
							'elec_cont_company_city'				=>	'City',
							'elec_cont_company_state'				=>	'State',
							'elec_cont_company_zip'					=>	'Zip',
							'elec_cont_company_phone'				=>	'[Phone number]',
							'elec_cont_company_fax'					=>	'[Fax Number]',
							'elec_cont_company_cn'					=>	'[CN number]',
							'elec_cont_company_num_of_employees'	=>	'[# of comployees]',
							'elec_cont_company_tax_id'				=>	'[State tax id]',
							'elec_cont_company_sos_num'				=>	'[SOS #]',
							'elec_cont_company_duns_num'			=>	'[DUNS #]',
							'elec_cont_company_type'				=>	'[Type of company]',
							'elec_cont_company_sic_code'			=>	'[SIC code]',
							'elec_cont_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "elec_cont_company_name"),
																			'elec_cont_company_contact' => 'contact_name'
																		),
							'elec_cont_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "elec_cont_company_name", "[NOI Signer]" => 1),
																			'elec_cont_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'elec_cont_company_owner', 'text', 250, 'elec_cont_company_owner', null),
					Array('Address', 'elec_cont_company_address', 'text', 100, 'elec_cont_company_address', null),
					Array('City', 'elec_cont_company_city', 'text', 250, 'elec_cont_company_city', null),
					Array('State', 'elec_cont_company_state', 'text', 100, 'elec_cont_company_state', null),
					Array('Zip', 'elec_cont_company_zip', 'num', 25, 'elec_cont_company_zip', null),
					Array('Phone number', 'elec_cont_company_phone', 'phone', 25, 'elec_cont_company_phone', null),
					Array('Fax Number', 'elec_cont_company_fax', 'phone', 25, 'elec_cont_company_fax', null),
					Array('CN number', 'elec_cont_company_cn', 'text', 25, 'elec_cont_company_cn', null),
					Array('# of comployees', 'elec_cont_company_num_of_employees', 'text', 10, 'elec_cont_company_num_of_employees', null),
					Array('State tax id', 'elec_cont_company_tax_id', 'text', 25, 'elec_cont_company_tax_id', null),
					Array('SOS #', 'elec_cont_company_sos_num', 'text', 25, 'elec_cont_company_sos_num', null),
					Array('DUNS #', 'elec_cont_company_duns_num', 'text', 25, 'elec_cont_company_duns_num', null),
					Array('Type of company', 'elec_cont_company_type', 'text', 50, 'elec_cont_company_type', null),
					Array('SIC code', 'elec_cont_company_sic_code', 'text', 25, 'elec_cont_company_sic_code', null),
					Array('Contact', 'elec_cont_company_contact', 'drop-down', 250, 'elec_cont_company_contact', 
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'elec_cont_company_name'),
							'elec_cont_company_contact'				=>	'contact_name',
							'elec_cont_company_contact_title'		=>	'Title',
							'elec_cont_company_contact_email'		=>	'Email',
							'elec_cont_company_contact_company'		=>	'Company',
							'elec_cont_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'elec_cont_company_contact_title', 'text', 250, 'elec_cont_company_contact_title', null),
					Array('Contact phone', 'elec_cont_company_contact_phone', 'phone', 25, 'elec_cont_company_contact_phone', null),
					Array('Contact email', 'elec_cont_company_contact_email', 'email', 250, 'elec_cont_company_contact_email', null),
					Array('Contact company', 'elec_cont_company_contact_company', 'text', 100, 'elec_cont_company_contact_company', null),
					Array('Contact fax', 'elec_cont_company_contact_fax', 'text', 25, 'elec_cont_company_contact_fax', null),
					Array('NOI Signer', 'elec_cont_company_noi_signer', 'drop-down', 250, 'elec_cont_company_noi_signer',
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'elec_cont_company_name', '[NOI Signer]' => 1),
							'elec_cont_company_noi_signer'			=>	'contact_name',
							'elec_cont_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'elec_cont_company_noi_signer_title', 'text', 250, 'elec_cont_company_noi_signer_title', null)
				),
				Array('Land owner/Developer', 'elec_land_owner', 'text', 250, 'elec_land_owner', null),
				Array('Other Operator 1', 'elec_other_operator_1', 'text', 250, 'elec_other_operator_1', null),
				Array('Other Operator 2', 'elec_other_operator_2', 'text', 250, 'elec_other_operator_2', null),
				Array('Other Operator 3', 'elec_other_operator_3', 'text', 250, 'elec_other_operator_3', null)
			),
			Array('Construction Site Information', null, 'zone', 0,  null,
				Array('Dates', null, 'zone', 0,  null,
					Array('Start date', 'elec_est_start_date', 'text', 25, 'elec_est_start_date', null),
					Array('Completion date', 'elec_est_comp_date', 'text', 25, 'elec_est_comp_date', null),
				),
				Array('Description', null, 'zone', 0,  null,
					Array('Project description', 'elec_proj_desc', 'textarea', 2000, 'elec_proj_desc', null),
					Array('Total Acres', 'elec_total_acres', 'num', 10, 'elec_total_acres', null),
					Array('Acres disturbed', 'elec_acres_disturbed', 'num', 10, 'elec_acres_disturbed', null),
					Array('Existing stormdrain sys', 'elec_existing_stormdrain', 'textarea', 1000, 'elec_existing_stormdrain', null),
					Array('Part of a larger plan', 'elec_larger_plan', 'drop-down', 25, 'elec_larger_plan', 'bool')
				)
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Soil type', null, 'zone', 0,  null,
					Array('Soil 1 type', 'elec_soil_1_type', 'drop-down', 255, 'elec_soil_1_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_1_type'	=>	'[Soil name]',
							'elec_soil_1_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_1_k'		=>	'[K factor]'
						)
					),
					Array('Soil 1 HSG', 'elec_soil_1_hsg', 'text', 50, 'elec_soil_1_hsg', null),
					Array('Soil 1 K Factor', 'elec_soil_1_k', 'text', 50, 'elec_soil_1_k', null),
					Array('Soil 1 Area', 'elec_soil_1_area', 'text', 25, 'elec_soil_1_area', null),
					Array('Soil 2 type', 'elec_soil_2_type', 'drop-down', 255, 'elec_soil_2_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_2_type'	=>	'[Soil name]',
							'elec_soil_2_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_2_k'		=>	'[K factor]'
						)
					),
					Array('Soil 2 HSG', 'elec_soil_2_hsg', 'text', 50, 'elec_soil_2_hsg', null),
					Array('Soil 2 K Factor', 'elec_soil_2_k', 'text', 50, 'elec_soil_2_k', null),
					Array('Soil 2 Area', 'elec_soil_2_area', 'text', 25, 'elec_soil_2_area', null),
					Array('Soil 3 type', 'elec_soil_3_type', 'drop-down', 255, 'elec_soil_3_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_3_type'	=>	'[Soil name]',
							'elec_soil_3_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_3_k'		=>	'[K factor]'
						)
					),
					Array('Soil 3 HSG', 'elec_soil_3_hsg', 'text', 50, 'elec_soil_3_hsg', null),
					Array('Soil 3 K Factor', 'elec_soil_3_k', 'text', 50, 'elec_soil_3_k', null),
					Array('Soil 3 Area', 'elec_soil_3_area', 'text', 25, 'elec_soil_3_area', null),
					Array('Soil 4 type', 'elec_soil_4_type', 'drop-down', 255, 'elec_soil_4_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_4_type'	=>	'[Soil name]',
							'elec_soil_4_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_4_k'		=>	'[K factor]'
						)
					),
					Array('Soil 4 HSG', 'elec_soil_4_hsg', 'text', 50, 'elec_soil_4_hsg', null),
					Array('Soil 4 K Factor', 'elec_soil_4_k', 'text', 50, 'elec_soil_4_k', null),
					Array('Soil 4 Area', 'elec_soil_4_area', 'text', 25, 'elec_soil_4_area', null),
					Array('Soil 5 type', 'elec_soil_5_type', 'drop-down', 255, 'elec_soil_5_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_5_type'	=>	'[Soil name]',
							'elec_soil_5_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_5_k'		=>	'[K factor]'
						)
					),
					Array('Soil 5 HSG', 'elec_soil_5_hsg', 'text', 50, 'elec_soil_5_hsg', null),
					Array('Soil 5 K Factor', 'elec_soil_5_k', 'text', 50, 'elec_soil_5_k', null),
					Array('Soil 5 Area', 'elec_soil_5_area', 'text', 25, 'elec_soil_5_area', null),
					Array('Soil 6 type', 'elec_soil_6_type', 'drop-down', 255, 'elec_soil_6_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_6_type'	=>	'[Soil name]',
							'elec_soil_6_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_6_k'		=>	'[K factor]'
						)
					),
					Array('Soil 6 HSG', 'elec_soil_6_hsg', 'text', 50, 'elec_soil_6_hsg', null),
					Array('Soil 6 K Factor', 'elec_soil_6_k', 'text', 50, 'elec_soil_6_k', null),
					Array('Soil 6 Area', 'elec_soil_6_area', 'text', 25, 'elec_soil_6_area', null),
					Array('Soil 7 type', 'elec_soil_7_type', 'drop-down', 255, 'elec_soil_7_type', 
						Array(
							'table_name'		=>	'soils',
							'elec_soil_7_type'	=>	'[Soil name]',
							'elec_soil_7_hsg'	=>	'[Soil hydrologic Group]',
							'elec_soil_7_k'		=>	'[K factor]'
						)
					),
					Array('Soil 7 HSG', 'elec_soil_7_hsg', 'text', 50, 'elec_soil_7_hsg', null),
					Array('Soil 7 K Factor', 'elec_soil_7_k', 'text', 50, 'elec_soil_7_k', null),
					Array('Soil 7 Area', 'elec_soil_7_area', 'text', 25, 'elec_soil_7_area', null),
				),
				Array('Erosivity', null, 'zone', 0,  null,
					Array('Erosivity', 'elec_erosivity', 'text', 100, 'elec_erosivity', null)
				),
				Array('Coefficient', null, 'zone', 0,  null,
					Array('Pre-Constionion Coefficient', 'elec_pre_coefficient', 'text', 100, 'elec_pre_coefficient', null),
					Array('Post-Constionion Coefficient', 'elec_post_coefficient', 'text', 100, 'elec_post_coefficient', null)
				),
			),
			Array('BMPs', null, 'zone', 0,  null, 
				Array('Critical Areas', null, 'zone', 0,  null,
					Array('Critical Area', 'elec_crit_area', 'textarea', 1000, 'elec_crit_area', null)
				),
				Array('Structural Controls', null, 'zone', 0,  null,
					Array('S-BMP1', 'elec_s_bmp_1', 'drop-down', 250, 'elec_s_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'elec_s_bmp_1'				=>	'BMP',
							'elec_s_bmp_1_desc'			=>	'Description',
							'elec_s_bmp_1_uses'			=>	'Uses',
							'elec_s_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'elec_s_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP1 Description', 'elec_s_bmp_1_desc', 'textarea', 1000, 'elec_s_bmp_1_desc', null),
					Array('S-BMP1 Uses', 'elec_s_bmp_1_uses', 'textarea', 1000, 'elec_s_bmp_1_uses', null),
					Array('S-BMP1 Inspection Schedule', 'elec_s_bmp_1_insp_sche', 'textarea', 1000, 'elec_s_bmp_1_insp_sche', null),
					Array('S-BMP1 Maintenance', 'elec_s_bmp_1_maint', 'textarea', 1000, 'elec_s_bmp_1_maint', null),
					Array('S-BMP1 Installation Schedule', 'elec_s_bmp_1_inst_sche', 'textarea', 1000, 'elec_s_bmp_1_inst_sche', null),
					Array('S-BMP2', 'elec_s_bmp_2', 'drop-down', 250, 'elec_s_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'elec_s_bmp_2'				=>	'BMP',
							'elec_s_bmp_2_desc'			=>	'Description',
							'elec_s_bmp_2_uses'			=>	'Uses',
							'elec_s_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'elec_s_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP2 Description', 'elec_s_bmp_2_desc', 'textarea', 1000, 'elec_s_bmp_2_desc', null),
					Array('S-BMP2 Uses', 'elec_s_bmp_2_uses', 'textarea', 1000, 'elec_s_bmp_2_uses', null),
					Array('S-BMP2 Inspection Schedule', 'elec_s_bmp_2_insp_sche', 'textarea', 1000, 'elec_s_bmp_2_insp_sche', null),
					Array('S-BMP2 Maintenance', 'elec_s_bmp_2_maint', 'textarea', 1000, 'elec_s_bmp_2_maint', null),
					Array('S-BMP2 Installation Schedule', 'elec_s_bmp_2_inst_sche', 'textarea', 1000, 'elec_s_bmp_2_inst_sche', null),
					Array('S-BMP3', 'elec_s_bmp_3', 'drop-down', 250, 'elec_s_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'elec_s_bmp_3'				=>	'BMP',
							'elec_s_bmp_3_desc'			=>	'Description',
							'elec_s_bmp_3_uses'			=>	'Uses',
							'elec_s_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'elec_s_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP3 Description', 'elec_s_bmp_3_desc', 'textarea', 1000, 'elec_s_bmp_3_desc', null),
					Array('S-BMP3 Uses', 'elec_s_bmp_3_uses', 'textarea', 1000, 'elec_s_bmp_3_uses', null),
					Array('S-BMP3 Inspection Schedule', 'elec_s_bmp_3_insp_sche', 'textarea', 1000, 'elec_s_bmp_3_insp_sche', null),
					Array('S-BMP3 Maintenance', 'elec_s_bmp_3_maint', 'textarea', 1000, 'elec_s_bmp_3_maint', null),
					Array('S-BMP3 Installation Schedule', 'elec_s_bmp_3_inst_sche', 'textarea', 1000, 'elec_s_bmp_3_inst_sche', null),
					Array('S-BMP4', 'elec_s_bmp_4', 'drop-down', 250, 'elec_s_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'elec_s_bmp_4'				=>	'BMP',
							'elec_s_bmp_4_desc'			=>	'Description',
							'elec_s_bmp_4_uses'			=>	'Uses',
							'elec_s_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'elec_s_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP4 Description', 'elec_s_bmp_4_desc', 'textarea', 1000, 'elec_s_bmp_4_desc', null),
					Array('S-BMP4 Uses', 'elec_s_bmp_4_uses', 'textarea', 1000, 'elec_s_bmp_4_uses', null),
					Array('S-BMP4 Inspection Schedule', 'elec_s_bmp_4_insp_sche', 'textarea', 1000, 'elec_s_bmp_4_insp_sche', null),
					Array('S-BMP4 Maintenance', 'elec_s_bmp_4_maint', 'textarea', 1000, 'elec_s_bmp_4_maint', null),
					Array('S-BMP4 Installation Schedule', 'elec_s_bmp_4_inst_sche', 'textarea', 1000, 'elec_s_bmp_4_inst_sche', null),
				),
				Array('NonStructural Controls', null, 'zone', 0,  null,
					Array('NS-BMP1', 'elec_ns_bmp_1', 'drop-down', 250, 'elec_ns_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'elec_ns_bmp_1'				=>	'BMP',
							'elec_ns_bmp_1_desc'		=>	'Description',
							'elec_ns_bmp_1_uses'		=>	'Uses',
							'elec_ns_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'elec_ns_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP1 Description', 'elec_ns_bmp_1_desc', 'textarea', 1000, 'elec_ns_bmp_1_desc', null),
					Array('NS-BMP1 Uses', 'elec_ns_bmp_1_uses', 'textarea', 1000, 'elec_ns_bmp_1_uses', null),
					Array('NS-BMP1 Inspection Schedule', 'elec_ns_bmp_1_insp_sche', 'textarea', 1000, 'elec_ns_bmp_1_insp_sche', null),
					Array('NS-BMP1 Maintenance', 'elec_ns_bmp_1_maint', 'textarea', 1000, 'elec_ns_bmp_1_maint', null),
					Array('NS-BMP1 Installation Schedule', 'elec_ns_bmp_1_inst_sche', 'textarea', 1000, 'elec_ns_bmp_1_inst_sche', null),
					Array('NS-BMP2', 'elec_ns_bmp_2', 'drop-down', 250, 'elec_ns_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'elec_ns_bmp_2'				=>	'BMP',
							'elec_ns_bmp_2_desc'		=>	'Description',
							'elec_ns_bmp_2_uses'		=>	'Uses',
							'elec_ns_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'elec_ns_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP2 Description', 'elec_ns_bmp_2_desc', 'textarea', 1000, 'elec_ns_bmp_2_desc', null),
					Array('NS-BMP2 Uses', 'elec_ns_bmp_2_uses', 'textarea', 1000, 'elec_ns_bmp_2_uses', null),
					Array('NS-BMP2 Inspection Schedule', 'elec_ns_bmp_2_insp_sche', 'textarea', 1000, 'elec_ns_bmp_2_insp_sche', null),
					Array('NS-BMP2 Maintenance', 'elec_ns_bmp_2_maint', 'textarea', 1000, 'elec_ns_bmp_2_maint', null),
					Array('NS-BMP2 Installation Schedule', 'elec_ns_bmp_2_inst_sche', 'textarea', 1000, 'elec_ns_bmp_2_inst_sche', null),
					Array('NS-BMP3', 'elec_ns_bmp_3', 'drop-down', 250, 'elec_ns_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'elec_ns_bmp_3'				=>	'BMP',
							'elec_ns_bmp_3_desc'		=>	'Description',
							'elec_ns_bmp_3_uses'		=>	'Uses',
							'elec_ns_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'elec_ns_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP3 Description', 'elec_ns_bmp_3_desc', 'textarea', 1000, 'elec_ns_bmp_3_desc', null),
					Array('NS-BMP3 Uses', 'elec_ns_bmp_3_uses', 'textarea', 1000, 'elec_ns_bmp_3_uses', null),
					Array('NS-BMP3 Inspection Schedule', 'elec_ns_bmp_3_insp_sche', 'textarea', 1000, 'elec_ns_bmp_3_insp_sche', null),
					Array('NS-BMP3 Maintenance', 'elec_ns_bmp_3_maint', 'textarea', 1000, 'elec_ns_bmp_3_maint', null),
					Array('NS-BMP3 Installation Schedule', 'elec_ns_bmp_3_inst_sche', 'textarea', 1000, 'elec_ns_bmp_3_inst_sche', null),
					Array('NS-BMP4', 'elec_ns_bmp_4', 'drop-down', 250, 'elec_ns_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'elec_ns_bmp_4'				=>	'BMP',
							'elec_ns_bmp_4_desc'		=>	'Description',
							'elec_ns_bmp_4_uses'		=>	'Uses',
							'elec_ns_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'elec_ns_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP4 Description', 'elec_ns_bmp_4_desc', 'textarea', 1000, 'elec_ns_bmp_4_desc', null),
					Array('NS-BMP4 Uses', 'elec_ns_bmp_4_uses', 'textarea', 1000, 'elec_ns_bmp_4_uses', null),
					Array('NS-BMP4 Inspection Schedule', 'elec_ns_bmp_4_insp_sche', 'textarea', 1000, 'elec_ns_bmp_4_insp_sche', null),
					Array('NS-BMP4 Maintenance', 'elec_ns_bmp_4_maint', 'textarea', 1000, 'elec_ns_bmp_4_maint', null),
					Array('NS-BMP4 Installation Schedule', 'elec_ns_bmp_4_inst_sche', 'textarea', 1000, 'elec_ns_bmp_4_inst_sche', null),
				),
				Array('Sedimentation pond', null, 'zone', 0,  null,
					Array('Yes/No', 'elec_sedi_pond', 'drop-down', 25, 'elec_sedi_pond', 'bool'),
					Array('Not feasible', 'elec_sedi_pond_feasible', 'textarea', 1000, 'elec_sedi_pond_feasible', null),
					Array('Design', 'elec_sedi_pond_design', 'textarea', 1000, 'elec_sedi_pond_design', null),
					Array('Construction', 'elec_sedi_pond_const', 'textarea', 1000, 'elec_sedi_pond_const', null),
					Array('Maintenance', 'elec_sedi_pond_maint', 'textarea', 1000, 'elec_sedi_pond_maint', null),
				),
			),
			Array('Project Responsibilities', null, 'zone', 0,  null, 
				Array('SWPPP Team', null, 'zone', 0,  null,
					Array('Team Member 1', 'elec_team_1_name', 'drop-down', 550, 'elec_team_1_name',
						Array(
							'table_name'			=>	'view_contacts',
							'elec_team_1_name'		=>	'contact_name',
							'elec_team_1_phone'		=>	'[Phone number]',
							'elec_team_1_email'		=>	'Email'
						)
					),
					Array('Team Member 1 Position', 'elec_team_1_position', 'text', 250, 'elec_team_1_position', null),
					Array('Team Member 1 Role', 'elec_team_1_role', 'text', 250, 'elec_team_1_role', null),
					Array('Team Member 1 Phone', 'elec_team_1_phone', 'phone', 25, 'elec_team_1_phone', null),
					Array('Team Member 1 Email', 'elec_team_1_email', 'email', 250, 'elec_team_1_email', null),
					Array('Team Member 2', 'elec_team_2_name', 'drop-down', 550, 'elec_team_2_name',
						Array(
							'table_name'			=>	'view_contacts',
							'elec_team_2_name'		=>	'contact_name',
							'elec_team_2_phone'		=>	'[Phone number]',
							'elec_team_2_email'		=>	'Email'
						)
					),
					Array('Team Member 2 Position', 'elec_team_2_position', 'text', 250, 'elec_team_2_position', null),
					Array('Team Member 2 Role', 'elec_team_2_role', 'text', 250, 'elec_team_2_role', null),
					Array('Team Member 2 Phone', 'elec_team_2_phone', 'phone', 25, 'elec_team_2_phone', null),
					Array('Team Member 2 Email', 'elec_team_2_email', 'email', 250, 'elec_team_2_email', null),
					Array('Team Member 3', 'elec_team_3_name', 'drop-down', 550, 'elec_team_3_name',
						Array(
							'table_name'			=>	'view_contacts',
							'elec_team_3_name'		=>	'contact_name',
							'elec_team_3_phone'		=>	'[Phone number]',
							'elec_team_3_email'		=>	'Email'
						)
					),
					Array('Team Member 3 Position', 'elec_team_3_position', 'text', 250, 'elec_team_3_position', null),
					Array('Team Member 3 Role', 'elec_team_3_role', 'text', 250, 'elec_team_3_role', null),
					Array('Team Member 3 Phone', 'elec_team_3_phone', 'phone', 25, 'elec_team_3_phone', null),
					Array('Team Member 3 Email', 'elec_team_3_email', 'email', 250, 'elec_team_3_email', null),
					Array('Team Member 4', 'elec_team_4_name', 'drop-down', 550, 'elec_team_4_name',
						Array(
							'table_name'			=>	'view_contacts',
							'elec_team_4_name'		=>	'contact_name',
							'elec_team_4_phone'		=>	'[Phone number]',
							'elec_team_4_email'		=>	'Email'
						)
					),
					Array('Team Member 4 Position', 'elec_team_4_position', 'text', 250, 'elec_team_4_position', null),
					Array('Team Member 4 Role', 'elec_team_4_role', 'text', 250, 'elec_team_4_role', null),
					Array('Team Member 4 Phone', 'elec_team_4_phone', 'phone', 25, 'elec_team_4_phone', null),
					Array('Team Member 4 Email', 'elec_team_4_email', 'email', 250, 'elec_team_4_email', null),
				),
				Array('Inspections', null, 'zone', 0,  null, 
					Array('Inspector 1 name', 'elec_insp_1_name', 'drop-down', 550, 'elec_insp_1_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'elec_insp_1_name'		=>	'contact_name',
							'elec_insp_1_company'	=>	'Company',
							'elec_insp_1_phone'		=>	'[Phone number]',
							'elec_insp_1_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 1 company', 'elec_insp_1_company', 'text', 250, 'elec_insp_1_company', null),
					Array('Inspector 1 phone', 'elec_insp_1_phone', 'text', 25, 'elec_insp_1_phone', null),
					Array('Inspector 1 qualifications', 'elec_insp_1_quals', 'text', 500, 'elec_insp_1_quals', null),
					Array('Inspector 2 name', 'elec_insp_2_name', 'drop-down', 550, 'elec_insp_2_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'elec_insp_2_name'		=>	'contact_name',
							'elec_insp_2_company'	=>	'Company',
							'elec_insp_2_phone'		=>	'[Phone number]',
							'elec_insp_2_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 2 company', 'elec_insp_2_company', 'text', 250, 'elec_insp_2_company', null),
					Array('Inspector 2 phone', 'elec_insp_2_phone', 'text', 25, 'elec_insp_2_phone', null),
					Array('Inspector 2 qualifications', 'elec_insp_2_quals', 'text', 500, 'elec_insp_2_quals', null),
					Array('Inspector 3 name', 'elec_insp_3_name', 'drop-down', 550, 'elec_insp_3_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'elec_insp_3_name'		=>	'contact_name',
							'elec_insp_3_company'	=>	'Company',
							'elec_insp_3_phone'		=>	'[Phone number]',
							'elec_insp_3_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 3 company', 'elec_insp_3_company', 'text', 250, 'elec_insp_3_company', null),
					Array('Inspector 3 phone', 'elec_insp_3_phone', 'text', 25, 'elec_insp_3_phone', null),
					Array('Inspector 3 qualifications', 'elec_insp_3_quals', 'text', 500, 'elec_insp_3_quals', null),
					Array('Inspector 4 name', 'elec_insp_4_name', 'drop-down', 550, 'elec_insp_4_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'elec_insp_4_name'		=>	'contact_name',
							'elec_insp_4_company'	=>	'Company',
							'elec_insp_4_phone'		=>	'[Phone number]',
							'elec_insp_4_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 4 company', 'elec_insp_4_company', 'text', 250, 'elec_insp_4_company', null),
					Array('Inspector 4 phone', 'elec_insp_4_phone', 'text', 25, 'elec_insp_4_phone', null),
					Array('Inspector 4 qualifications', 'elec_insp_4_quals', 'text', 500, 'elec_insp_4_quals', null),
					Array('Inspection Schedule', 'elec_insp_sche', 'drop-down', 550, 'elec_insp_sche',
						Array(
							'table_name'		=>	'inspection_schedule',
							'elec_insp_sche'	=>	'is_short'
						)
					)
				),
				Array('Stabilization', null, 'zone', 0,  null, 
					Array('Stabilization description', 'elec_stab_desc', 'textarea', 1000, 'elec_stab_desc', null),
					Array('Stabilization dates', 'elec_stab_dates', 'textarea', 1000, 'elec_stab_dates', null),
					Array('Stabilization schedule', 'elec_stab_sche', 'textarea', 1000, 'elec_stab_sche', null),
					Array('Stabilization responsibility', 'elec_stab_resp', 'textarea', 1000, 'elec_stab_resp', null)
				)
			)
		);
