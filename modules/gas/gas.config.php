<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'gas_id', 'hidden', 10, 'gas_id', null),
			Array('Last Modified', 'gas_last_modified', 'modified', 10, 'gas_last_modified', null),
			Array('SWPPP Information', null, 'zone', 0,  null, 
				Array('Project Information', null, 'zone', 0,  null,
					Array('Project Number', 'gas_proj_num', 'text', 10, 'gas_proj_num', null),
					Array('Project originator', 'gas_proj_orig', 'text', 50, 'gas_proj_orig', null),
					Array('Project Contact', 'gas_proj_contact', 'drop-down', 50, 'gas_proj_contact',
						Array(
							'table_name' => 'view_contacts',
							'gas_proj_contact' => 'contact_name'
						)
					),
					Array('Customer Project #/s', 'gas_proj_customer_num', 'text', 50, 'gas_proj_customer_num', null)
				),
				Array('Order Date', 'gas_proj_order_date', 'text', '25', 'gas_proj_order_date', null),
				Array('Preparation Date', 'gas_proj_prep_date', 'text', '25', 'gas_proj_prep_date', null),
			),
			Array('Operator Information', null, 'zone', 0,  null, 
				Array('Gas provider company', null, 'zone', 0,  null,
					Array('Legal Name', 'gas_prov_company_name', 'drop-down', 100, 'gas_prov_company_name',
						Array(
							'table_name'							=>	'companies',
							'gas_prov_company_name'				=>	'[Legal Company Name]',
							'gas_prov_company_owner'				=>	'[Company name]',
							'gas_prov_company_address'				=>	'Address',
							'gas_prov_company_city'				=>	'City',
							'gas_prov_company_state'				=>	'State',
							'gas_prov_company_zip'					=>	'Zip',
							'gas_prov_company_phone'				=>	'[Phone number]',
							'gas_prov_company_fax'					=>	'[Fax Number]',
							'gas_prov_company_cn'					=>	'[CN number]',
							'gas_prov_company_num_of_employees'	=>	'[# of comployees]',
							'gas_prov_company_tax_id'				=>	'[State tax id]',
							'gas_prov_company_sos_num'				=>	'[SOS #]',
							'gas_prov_company_duns_num'			=>	'[DUNS #]',
							'gas_prov_company_type'				=>	'[Type of company]',
							'gas_prov_company_sic_code'			=>	'[SIC code]',
							'gas_prov_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "gas_prov_company_name"),
																			'gas_prov_company_contact' => 'contact_name'
																		),
							'gas_prov_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "gas_prov_company_name", "[NOI Signer]" => 1),
																			'gas_prov_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'gas_prov_company_owner', 'text', 100, 'gas_prov_company_owner', null),
					Array('Address', 'gas_prov_company_address', 'text', 250, 'gas_prov_company_address', null),
					Array('City', 'gas_prov_company_city', 'text', 100, 'gas_prov_company_city', null),
					Array('State', 'gas_prov_company_state', 'text', 100, 'gas_prov_company_state', null),
					Array('Zip', 'gas_prov_company_zip', 'num', 25, 'gas_prov_company_zip', null),
					Array('Phone number', 'gas_prov_company_phone', 'phone', 25, 'gas_prov_company_phone', null),
					Array('Fax Number', 'gas_prov_company_fax', 'phone', 25, 'gas_prov_company_fax', null),
					Array('CN number', 'gas_prov_company_cn', 'text', 25, 'gas_prov_company_cn', null),
					Array('# of employees', 'gas_prov_company_num_of_employees', 'text', 10, 'gas_prov_company_num_of_employees', null),
					Array('State tax id', 'gas_prov_company_tax_id', 'text', 25, 'gas_prov_company_tax_id', null),
					Array('SOS #', 'gas_prov_company_sos_num', 'text', 25, 'gas_prov_company_sos_num', null),
					Array('DUNS #', 'gas_prov_company_duns_num', 'text', 25, 'gas_prov_company_duns_num', null),
					Array('Type of company', 'gas_prov_company_type', 'text', 50, 'gas_prov_company_type', null),
					Array('SIC code', 'gas_prov_company_sic_code', 'text', 25, 'gas_prov_company_sic_code', null),
					Array('Contact', 'gas_prov_company_contact', 'drop-down', 250, 'gas_prov_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'gas_prov_company_name'),
							'gas_prov_company_contact'				=>	'contact_name',
							'gas_prov_company_contact_title'		=>	'Title',
							'gas_prov_company_contact_email'		=>	'Email',
							'gas_prov_company_contact_company'		=>	'Company',
							'gas_prov_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'gas_prov_company_contact_title', 'text', 25, 'gas_prov_company_contact_title', null),
					Array('Contact phone', 'gas_prov_company_contact_phone', 'phone', 25, 'gas_prov_company_contact_phone', null),
					Array('Contact email', 'gas_prov_company_contact_email', 'email', 250, 'gas_prov_company_contact_email', null),
					Array('Contact company', 'gas_prov_company_contact_company', 'text', 100, 'gas_prov_company_contact_company', null),
					Array('Contact fax', 'gas_prov_company_contact_fax', 'text', 25, 'gas_prov_company_contact_fax', null),
					Array('NOI Signer', 'gas_prov_company_noi_signer', 'drop-down', 250, 'gas_prov_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'gas_prov_company_name', '[NOI Signer]' => 1),
							'gas_prov_company_noi_signer'			=>	'contact_name',
							'gas_prov_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'gas_prov_company_noi_signer_title', 'text', 250, 'gas_prov_company_noi_signer_title', null)
				),
				Array('Gas contractor', null, 'zone', 0,  null,
					Array('Legal Name', 'gas_cont_company_name', 'drop-down', 250, 'gas_cont_company_name',
						Array(
							'table_name'							=>	'companies',
							'gas_cont_company_name'				=>	'[Legal Company Name]',
							'gas_cont_company_owner'				=>	'[Company name]',
							'gas_cont_company_address'				=>	'Address',
							'gas_cont_company_city'				=>	'City',
							'gas_cont_company_state'				=>	'State',
							'gas_cont_company_zip'					=>	'Zip',
							'gas_cont_company_phone'				=>	'[Phone number]',
							'gas_cont_company_fax'					=>	'[Fax Number]',
							'gas_cont_company_cn'					=>	'[CN number]',
							'gas_cont_company_num_of_employees'	=>	'[# of comployees]',
							'gas_cont_company_tax_id'				=>	'[State tax id]',
							'gas_cont_company_sos_num'				=>	'[SOS #]',
							'gas_cont_company_duns_num'			=>	'[DUNS #]',
							'gas_cont_company_type'				=>	'[Type of company]',
							'gas_cont_company_sic_code'			=>	'[SIC code]',
							'gas_cont_company_contact'				=>	Array('table_name' => 'view_contacts', 'gas_cont_company_contact' => 'contact_name')
						)
					),
					Array('Company name', 'gas_cont_company_owner', 'text', 250, 'gas_cont_company_owner', null),
					Array('Address', 'gas_cont_company_address', 'text', 100, 'gas_cont_company_address', null),
					Array('City', 'gas_cont_company_city', 'text', 250, 'gas_cont_company_city', null),
					Array('State', 'gas_cont_company_state', 'text', 100, 'gas_cont_company_state', null),
					Array('Zip', 'gas_cont_company_zip', 'num', 25, 'gas_cont_company_zip', null),
					Array('Phone number', 'gas_cont_company_phone', 'phone', 25, 'gas_cont_company_phone', null),
					Array('Fax Number', 'gas_cont_company_fax', 'phone', 25, 'gas_cont_company_fax', null),
					Array('CN number', 'gas_cont_company_cn', 'text', 25, 'gas_cont_company_cn', null),
					Array('# of comployees', 'gas_cont_company_num_of_employees', 'text', 10, 'gas_cont_company_num_of_employees', null),
					Array('State tax id', 'gas_cont_company_tax_id', 'text', 25, 'gas_cont_company_tax_id', null),
					Array('SOS #', 'gas_cont_company_sos_num', 'text', 25, 'gas_cont_company_sos_num', null),
					Array('DUNS #', 'gas_cont_company_duns_num', 'text', 25, 'gas_cont_company_duns_num', null),
					Array('Type of company', 'gas_cont_company_type', 'text', 50, 'gas_cont_company_type', null),
					Array('SIC code', 'gas_cont_company_sic_code', 'text', 25, 'gas_cont_company_sic_code', null),
					Array('Contact', 'gas_cont_company_contact', 'drop-down', 250, 'gas_cont_company_contact', 
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'gas_cont_company_name'),
							'gas_cont_company_contact'				=>	'contact_name',
							'gas_cont_company_contact_title'		=>	'Title',
							'gas_cont_company_contact_email'		=>	'Email',
							'gas_cont_company_contact_company'		=>	'Company',
							'gas_cont_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'gas_cont_company_contact_title', 'text', 250, 'gas_cont_company_contact_title', null),
					Array('Contact phone', 'gas_cont_company_contact_phone', 'phone', 25, 'gas_cont_company_contact_phone', null),
					Array('Contact email', 'gas_cont_company_contact_email', 'email', 250, 'gas_cont_company_contact_email', null),
					Array('Contact company', 'gas_cont_company_contact_company', 'text', 100, 'gas_cont_company_contact_company', null),
					Array('Contact fax', 'gas_cont_company_contact_fax', 'text', 25, 'gas_cont_company_contact_fax', null),
					Array('NOI Signer', 'gas_cont_company_noi_signer', 'drop-down', 250, 'gas_cont_company_noi_signer',
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'gas_cont_company_name', '[NOI Signer]' => 1),
							'gas_cont_company_noi_signer'			=>	'contact_name',
							'gas_cont_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'gas_cont_company_noi_signer_title', 'text', 250, 'gas_cont_company_noi_signer_title', null)
				),
				Array('Land owner/Developer', 'gas_land_owner', 'text', 250, 'gas_land_owner', null),
				Array('Other Operator 1', 'gas_other_operator_1', 'text', 250, 'gas_other_operator_1', null),
				Array('Other Operator 2', 'gas_other_operator_2', 'text', 250, 'gas_other_operator_2', null),
				Array('Other Operator 3', 'gas_other_operator_3', 'text', 250, 'gas_other_operator_3', null)
			),
			Array('Construction Site Information', null, 'zone', 0,  null,
				Array('Dates', null, 'zone', 0,  null,
					Array('Start date', 'gas_est_start_date', 'text', 25, 'gas_est_start_date', null),
					Array('Completion date', 'gas_est_comp_date', 'text', 25, 'gas_est_comp_date', null),
				),
				Array('Description', null, 'zone', 0,  null,
					Array('Project description', 'gas_proj_desc', 'textarea', 2000, 'gas_proj_desc', null),
					Array('Total Acres', 'gas_total_acres', 'num', 10, 'gas_total_acres', null),
					Array('Acres disturbed', 'gas_acres_disturbed', 'num', 10, 'gas_acres_disturbed', null),
					Array('Existing stormdrain sys', 'gas_existing_stormdrain', 'textarea', 1000, 'gas_existing_stormdrain', null),
					Array('Part of a larger plan', 'gas_larger_plan', 'drop-down', 25, 'gas_larger_plan', 'bool')
				)
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Soil type', null, 'zone', 0,  null,
					Array('Soil 1 type', 'gas_soil_1_type', 'drop-down', 255, 'gas_soil_1_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_1_type'	=>	'[Soil name]',
							'gas_soil_1_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_1_k'		=>	'[K factor]'
						)
					),
					Array('Soil 1 HSG', 'gas_soil_1_hsg', 'text', 50, 'gas_soil_1_hsg', null),
					Array('Soil 1 K Factor', 'gas_soil_1_k', 'text', 50, 'gas_soil_1_k', null),
					Array('Soil 1 Area', 'gas_soil_1_area', 'text', 25, 'gas_soil_1_area', null),
					Array('Soil 2 type', 'gas_soil_2_type', 'drop-down', 255, 'gas_soil_2_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_2_type'	=>	'[Soil name]',
							'gas_soil_2_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_2_k'		=>	'[K factor]'
						)
					),
					Array('Soil 2 HSG', 'gas_soil_2_hsg', 'text', 50, 'gas_soil_2_hsg', null),
					Array('Soil 2 K Factor', 'gas_soil_2_k', 'text', 50, 'gas_soil_2_k', null),
					Array('Soil 2 Area', 'gas_soil_2_area', 'text', 25, 'gas_soil_2_area', null),
					Array('Soil 3 type', 'gas_soil_3_type', 'drop-down', 255, 'gas_soil_3_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_3_type'	=>	'[Soil name]',
							'gas_soil_3_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_3_k'		=>	'[K factor]'
						)
					),
					Array('Soil 3 HSG', 'gas_soil_3_hsg', 'text', 50, 'gas_soil_3_hsg', null),
					Array('Soil 3 K Factor', 'gas_soil_3_k', 'text', 50, 'gas_soil_3_k', null),
					Array('Soil 3 Area', 'gas_soil_3_area', 'text', 25, 'gas_soil_3_area', null),
					Array('Soil 4 type', 'gas_soil_4_type', 'drop-down', 255, 'gas_soil_4_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_4_type'	=>	'[Soil name]',
							'gas_soil_4_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_4_k'		=>	'[K factor]'
						)
					),
					Array('Soil 4 HSG', 'gas_soil_4_hsg', 'text', 50, 'gas_soil_4_hsg', null),
					Array('Soil 4 K Factor', 'gas_soil_4_k', 'text', 50, 'gas_soil_4_k', null),
					Array('Soil 4 Area', 'gas_soil_4_area', 'text', 25, 'gas_soil_4_area', null),
					Array('Soil 5 type', 'gas_soil_5_type', 'drop-down', 255, 'gas_soil_5_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_5_type'	=>	'[Soil name]',
							'gas_soil_5_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_5_k'		=>	'[K factor]'
						)
					),
					Array('Soil 5 HSG', 'gas_soil_5_hsg', 'text', 50, 'gas_soil_5_hsg', null),
					Array('Soil 5 K Factor', 'gas_soil_5_k', 'text', 50, 'gas_soil_5_k', null),
					Array('Soil 5 Area', 'gas_soil_5_area', 'text', 25, 'gas_soil_5_area', null),
					Array('Soil 6 type', 'gas_soil_6_type', 'drop-down', 255, 'gas_soil_6_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_6_type'	=>	'[Soil name]',
							'gas_soil_6_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_6_k'		=>	'[K factor]'
						)
					),
					Array('Soil 6 HSG', 'gas_soil_6_hsg', 'text', 50, 'gas_soil_6_hsg', null),
					Array('Soil 6 K Factor', 'gas_soil_6_k', 'text', 50, 'gas_soil_6_k', null),
					Array('Soil 6 Area', 'gas_soil_6_area', 'text', 25, 'gas_soil_6_area', null),
					Array('Soil 7 type', 'gas_soil_7_type', 'drop-down', 255, 'gas_soil_7_type', 
						Array(
							'table_name'		=>	'soils',
							'gas_soil_7_type'	=>	'[Soil name]',
							'gas_soil_7_hsg'	=>	'[Soil hydrologic Group]',
							'gas_soil_7_k'		=>	'[K factor]'
						)
					),
					Array('Soil 7 HSG', 'gas_soil_7_hsg', 'text', 50, 'gas_soil_7_hsg', null),
					Array('Soil 7 K Factor', 'gas_soil_7_k', 'text', 50, 'gas_soil_7_k', null),
					Array('Soil 7 Area', 'gas_soil_7_area', 'text', 25, 'gas_soil_7_area', null),
				),
				Array('Erosivity', null, 'zone', 0,  null,
					Array('Erosivity', 'gas_erosivity', 'text', 100, 'gas_erosivity', null)
				),
				Array('Coefficient', null, 'zone', 0,  null,
					Array('Pre-Constionion Coefficient', 'gas_pre_coefficient', 'text', 100, 'gas_pre_coefficient', null),
					Array('Post-Constionion Coefficient', 'gas_post_coefficient', 'text', 100, 'gas_post_coefficient', null)
				),
			),
			Array('BMPs', null, 'zone', 0,  null, 
				Array('Critical Areas', null, 'zone', 0,  null,
					Array('Critical Area', 'gas_crit_area', 'textarea', 1000, 'gas_crit_area', null)
				),
				Array('Structural Controls', null, 'zone', 0,  null,
					Array('S-BMP1', 'gas_s_bmp_1', 'drop-down', 250, 'gas_s_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'gas_s_bmp_1'				=>	'BMP',
							'gas_s_bmp_1_desc'			=>	'Description',
							'gas_s_bmp_1_uses'			=>	'Uses',
							'gas_s_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'gas_s_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP1 Description', 'gas_s_bmp_1_desc', 'textarea', 1000, 'gas_s_bmp_1_desc', null),
					Array('S-BMP1 Uses', 'gas_s_bmp_1_uses', 'textarea', 1000, 'gas_s_bmp_1_uses', null),
					Array('S-BMP1 Inspection Schedule', 'gas_s_bmp_1_insp_sche', 'textarea', 1000, 'gas_s_bmp_1_insp_sche', null),
					Array('S-BMP1 Maintenance', 'gas_s_bmp_1_maint', 'textarea', 1000, 'gas_s_bmp_1_maint', null),
					Array('S-BMP1 Installation Schedule', 'gas_s_bmp_1_inst_sche', 'textarea', 1000, 'gas_s_bmp_1_inst_sche', null),
					Array('S-BMP2', 'gas_s_bmp_2', 'drop-down', 250, 'gas_s_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'gas_s_bmp_2'				=>	'BMP',
							'gas_s_bmp_2_desc'			=>	'Description',
							'gas_s_bmp_2_uses'			=>	'Uses',
							'gas_s_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'gas_s_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP2 Description', 'gas_s_bmp_2_desc', 'textarea', 1000, 'gas_s_bmp_2_desc', null),
					Array('S-BMP2 Uses', 'gas_s_bmp_2_uses', 'textarea', 1000, 'gas_s_bmp_2_uses', null),
					Array('S-BMP2 Inspection Schedule', 'gas_s_bmp_2_insp_sche', 'textarea', 1000, 'gas_s_bmp_2_insp_sche', null),
					Array('S-BMP2 Maintenance', 'gas_s_bmp_2_maint', 'textarea', 1000, 'gas_s_bmp_2_maint', null),
					Array('S-BMP2 Installation Schedule', 'gas_s_bmp_2_inst_sche', 'textarea', 1000, 'gas_s_bmp_2_inst_sche', null),
					Array('S-BMP3', 'gas_s_bmp_3', 'drop-down', 250, 'gas_s_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'gas_s_bmp_3'				=>	'BMP',
							'gas_s_bmp_3_desc'			=>	'Description',
							'gas_s_bmp_3_uses'			=>	'Uses',
							'gas_s_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'gas_s_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP3 Description', 'gas_s_bmp_3_desc', 'textarea', 1000, 'gas_s_bmp_3_desc', null),
					Array('S-BMP3 Uses', 'gas_s_bmp_3_uses', 'textarea', 1000, 'gas_s_bmp_3_uses', null),
					Array('S-BMP3 Inspection Schedule', 'gas_s_bmp_3_insp_sche', 'textarea', 1000, 'gas_s_bmp_3_insp_sche', null),
					Array('S-BMP3 Maintenance', 'gas_s_bmp_3_maint', 'textarea', 1000, 'gas_s_bmp_3_maint', null),
					Array('S-BMP3 Installation Schedule', 'gas_s_bmp_3_inst_sche', 'textarea', 1000, 'gas_s_bmp_3_inst_sche', null),
					Array('S-BMP4', 'gas_s_bmp_4', 'drop-down', 250, 'gas_s_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'gas_s_bmp_4'				=>	'BMP',
							'gas_s_bmp_4_desc'			=>	'Description',
							'gas_s_bmp_4_uses'			=>	'Uses',
							'gas_s_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'gas_s_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP4 Description', 'gas_s_bmp_4_desc', 'textarea', 1000, 'gas_s_bmp_4_desc', null),
					Array('S-BMP4 Uses', 'gas_s_bmp_4_uses', 'textarea', 1000, 'gas_s_bmp_4_uses', null),
					Array('S-BMP4 Inspection Schedule', 'gas_s_bmp_4_insp_sche', 'textarea', 1000, 'gas_s_bmp_4_insp_sche', null),
					Array('S-BMP4 Maintenance', 'gas_s_bmp_4_maint', 'textarea', 1000, 'gas_s_bmp_4_maint', null),
					Array('S-BMP4 Installation Schedule', 'gas_s_bmp_4_inst_sche', 'textarea', 1000, 'gas_s_bmp_4_inst_sche', null),
				),
				Array('NonStructural Controls', null, 'zone', 0,  null,
					Array('NS-BMP1', 'gas_ns_bmp_1', 'drop-down', 250, 'gas_ns_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'gas_ns_bmp_1'				=>	'BMP',
							'gas_ns_bmp_1_desc'		=>	'Description',
							'gas_ns_bmp_1_uses'		=>	'Uses',
							'gas_ns_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'gas_ns_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP1 Description', 'gas_ns_bmp_1_desc', 'textarea', 1000, 'gas_ns_bmp_1_desc', null),
					Array('NS-BMP1 Uses', 'gas_ns_bmp_1_uses', 'textarea', 1000, 'gas_ns_bmp_1_uses', null),
					Array('NS-BMP1 Inspection Schedule', 'gas_ns_bmp_1_insp_sche', 'textarea', 1000, 'gas_ns_bmp_1_insp_sche', null),
					Array('NS-BMP1 Maintenance', 'gas_ns_bmp_1_maint', 'textarea', 1000, 'gas_ns_bmp_1_maint', null),
					Array('NS-BMP1 Installation Schedule', 'gas_ns_bmp_1_inst_sche', 'textarea', 1000, 'gas_ns_bmp_1_inst_sche', null),
					Array('NS-BMP2', 'gas_ns_bmp_2', 'drop-down', 250, 'gas_ns_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'gas_ns_bmp_2'				=>	'BMP',
							'gas_ns_bmp_2_desc'		=>	'Description',
							'gas_ns_bmp_2_uses'		=>	'Uses',
							'gas_ns_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'gas_ns_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP2 Description', 'gas_ns_bmp_2_desc', 'textarea', 1000, 'gas_ns_bmp_2_desc', null),
					Array('NS-BMP2 Uses', 'gas_ns_bmp_2_uses', 'textarea', 1000, 'gas_ns_bmp_2_uses', null),
					Array('NS-BMP2 Inspection Schedule', 'gas_ns_bmp_2_insp_sche', 'textarea', 1000, 'gas_ns_bmp_2_insp_sche', null),
					Array('NS-BMP2 Maintenance', 'gas_ns_bmp_2_maint', 'textarea', 1000, 'gas_ns_bmp_2_maint', null),
					Array('NS-BMP2 Installation Schedule', 'gas_ns_bmp_2_inst_sche', 'textarea', 1000, 'gas_ns_bmp_2_inst_sche', null),
					Array('NS-BMP3', 'gas_ns_bmp_3', 'drop-down', 250, 'gas_ns_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'gas_ns_bmp_3'				=>	'BMP',
							'gas_ns_bmp_3_desc'		=>	'Description',
							'gas_ns_bmp_3_uses'		=>	'Uses',
							'gas_ns_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'gas_ns_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP3 Description', 'gas_ns_bmp_3_desc', 'textarea', 1000, 'gas_ns_bmp_3_desc', null),
					Array('NS-BMP3 Uses', 'gas_ns_bmp_3_uses', 'textarea', 1000, 'gas_ns_bmp_3_uses', null),
					Array('NS-BMP3 Inspection Schedule', 'gas_ns_bmp_3_insp_sche', 'textarea', 1000, 'gas_ns_bmp_3_insp_sche', null),
					Array('NS-BMP3 Maintenance', 'gas_ns_bmp_3_maint', 'textarea', 1000, 'gas_ns_bmp_3_maint', null),
					Array('NS-BMP3 Installation Schedule', 'gas_ns_bmp_3_inst_sche', 'textarea', 1000, 'gas_ns_bmp_3_inst_sche', null),
					Array('NS-BMP4', 'gas_ns_bmp_4', 'drop-down', 250, 'gas_ns_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'gas_ns_bmp_4'				=>	'BMP',
							'gas_ns_bmp_4_desc'		=>	'Description',
							'gas_ns_bmp_4_uses'		=>	'Uses',
							'gas_ns_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'gas_ns_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP4 Description', 'gas_ns_bmp_4_desc', 'textarea', 1000, 'gas_ns_bmp_4_desc', null),
					Array('NS-BMP4 Uses', 'gas_ns_bmp_4_uses', 'textarea', 1000, 'gas_ns_bmp_4_uses', null),
					Array('NS-BMP4 Inspection Schedule', 'gas_ns_bmp_4_insp_sche', 'textarea', 1000, 'gas_ns_bmp_4_insp_sche', null),
					Array('NS-BMP4 Maintenance', 'gas_ns_bmp_4_maint', 'textarea', 1000, 'gas_ns_bmp_4_maint', null),
					Array('NS-BMP4 Installation Schedule', 'gas_ns_bmp_4_inst_sche', 'textarea', 1000, 'gas_ns_bmp_4_inst_sche', null),
				),
				Array('Sedimentation pond', null, 'zone', 0,  null,
					Array('Yes/No', 'gas_sedi_pond', 'drop-down', 25, 'gas_sedi_pond', 'bool'),
					Array('Not feasible', 'gas_sedi_pond_feasible', 'textarea', 1000, 'gas_sedi_pond_feasible', null),
					Array('Design', 'gas_sedi_pond_design', 'textarea', 1000, 'gas_sedi_pond_design', null),
					Array('Construction', 'gas_sedi_pond_const', 'textarea', 1000, 'gas_sedi_pond_const', null),
					Array('Maintenance', 'gas_sedi_pond_maint', 'textarea', 1000, 'gas_sedi_pond_maint', null),
				),
			),
			Array('Project Responsibilities', null, 'zone', 0,  null, 
				Array('SWPPP Team', null, 'zone', 0,  null,
					Array('Team Member 1', 'gas_team_1_name', 'drop-down', 550, 'gas_team_1_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gas_team_1_name'		=>	'contact_name',
							'gas_team_1_phone'		=>	'[Phone number]',
							'gas_team_1_email'		=>	'Email'
						)
					),
					Array('Team Member 1 Position', 'gas_team_1_position', 'text', 250, 'gas_team_1_position', null),
					Array('Team Member 1 Role', 'gas_team_1_role', 'text', 250, 'gas_team_1_role', null),
					Array('Team Member 1 Phone', 'gas_team_1_phone', 'phone', 25, 'gas_team_1_phone', null),
					Array('Team Member 1 Email', 'gas_team_1_email', 'email', 250, 'gas_team_1_email', null),
					Array('Team Member 2', 'gas_team_2_name', 'drop-down', 550, 'gas_team_2_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gas_team_2_name'		=>	'contact_name',
							'gas_team_2_phone'		=>	'[Phone number]',
							'gas_team_2_email'		=>	'Email'
						)
					),
					Array('Team Member 2 Position', 'gas_team_2_position', 'text', 250, 'gas_team_2_position', null),
					Array('Team Member 2 Role', 'gas_team_2_role', 'text', 250, 'gas_team_2_role', null),
					Array('Team Member 2 Phone', 'gas_team_2_phone', 'phone', 25, 'gas_team_2_phone', null),
					Array('Team Member 2 Email', 'gas_team_2_email', 'email', 250, 'gas_team_2_email', null),
					Array('Team Member 3', 'gas_team_3_name', 'drop-down', 550, 'gas_team_3_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gas_team_3_name'		=>	'contact_name',
							'gas_team_3_phone'		=>	'[Phone number]',
							'gas_team_3_email'		=>	'Email'
						)
					),
					Array('Team Member 3 Position', 'gas_team_3_position', 'text', 250, 'gas_team_3_position', null),
					Array('Team Member 3 Role', 'gas_team_3_role', 'text', 250, 'gas_team_3_role', null),
					Array('Team Member 3 Phone', 'gas_team_3_phone', 'phone', 25, 'gas_team_3_phone', null),
					Array('Team Member 3 Email', 'gas_team_3_email', 'email', 250, 'gas_team_3_email', null),
					Array('Team Member 4', 'gas_team_4_name', 'drop-down', 550, 'gas_team_4_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gas_team_4_name'		=>	'contact_name',
							'gas_team_4_phone'		=>	'[Phone number]',
							'gas_team_4_email'		=>	'Email'
						)
					),
					Array('Team Member 4 Position', 'gas_team_4_position', 'text', 250, 'gas_team_4_position', null),
					Array('Team Member 4 Role', 'gas_team_4_role', 'text', 250, 'gas_team_4_role', null),
					Array('Team Member 4 Phone', 'gas_team_4_phone', 'phone', 25, 'gas_team_4_phone', null),
					Array('Team Member 4 Email', 'gas_team_4_email', 'email', 250, 'gas_team_4_email', null),
				),
				Array('Inspections', null, 'zone', 0,  null, 
					Array('Inspector 1 name', 'gas_insp_1_name', 'drop-down', 550, 'gas_insp_1_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gas_insp_1_name'		=>	'contact_name',
							'gas_insp_1_company'	=>	'Company',
							'gas_insp_1_phone'		=>	'[Phone number]',
							'gas_insp_1_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 1 company', 'gas_insp_1_company', 'text', 250, 'gas_insp_1_company', null),
					Array('Inspector 1 phone', 'gas_insp_1_phone', 'text', 25, 'gas_insp_1_phone', null),
					Array('Inspector 1 qualifications', 'gas_insp_1_quals', 'text', 500, 'gas_insp_1_quals', null),
					Array('Inspector 2 name', 'gas_insp_2_name', 'drop-down', 550, 'gas_insp_2_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gas_insp_2_name'		=>	'contact_name',
							'gas_insp_2_company'	=>	'Company',
							'gas_insp_2_phone'		=>	'[Phone number]',
							'gas_insp_2_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 2 company', 'gas_insp_2_company', 'text', 250, 'gas_insp_2_company', null),
					Array('Inspector 2 phone', 'gas_insp_2_phone', 'text', 25, 'gas_insp_2_phone', null),
					Array('Inspector 2 qualifications', 'gas_insp_2_quals', 'text', 500, 'gas_insp_2_quals', null),
					Array('Inspector 3 name', 'gas_insp_3_name', 'drop-down', 550, 'gas_insp_3_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gas_insp_3_name'		=>	'contact_name',
							'gas_insp_3_company'	=>	'Company',
							'gas_insp_3_phone'		=>	'[Phone number]',
							'gas_insp_3_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 3 company', 'gas_insp_3_company', 'text', 250, 'gas_insp_3_company', null),
					Array('Inspector 3 phone', 'gas_insp_3_phone', 'text', 25, 'gas_insp_3_phone', null),
					Array('Inspector 3 qualifications', 'gas_insp_3_quals', 'text', 500, 'gas_insp_3_quals', null),
					Array('Inspector 4 name', 'gas_insp_4_name', 'drop-down', 550, 'gas_insp_4_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gas_insp_4_name'		=>	'contact_name',
							'gas_insp_4_company'	=>	'Company',
							'gas_insp_4_phone'		=>	'[Phone number]',
							'gas_insp_4_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 4 company', 'gas_insp_4_company', 'text', 250, 'gas_insp_4_company', null),
					Array('Inspector 4 phone', 'gas_insp_4_phone', 'text', 25, 'gas_insp_4_phone', null),
					Array('Inspector 4 qualifications', 'gas_insp_4_quals', 'text', 500, 'gas_insp_4_quals', null),
					Array('Inspection Schedule', 'gas_insp_sche', 'drop-down', 550, 'gas_insp_sche',
						Array(
							'table_name'		=>	'inspection_schedule',
							'gas_insp_sche'		=>	'is_short'
						)
					)
				),
				Array('Stabilization', null, 'zone', 0,  null, 
					Array('Stabilization description', 'gas_stab_desc', 'textarea', 1000, 'gas_stab_desc', null),
					Array('Stabilization dates', 'gas_stab_dates', 'textarea', 1000, 'gas_stab_dates', null),
					Array('Stabilization schedule', 'gas_stab_sche', 'textarea', 1000, 'gas_stab_sche', null),
					Array('Stabilization responsibility', 'gas_stab_resp', 'textarea', 1000, 'gas_stab_resp', null)
				)
			)
		);
