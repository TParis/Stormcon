<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'gc_id', 'hidden', 10, 'gc_id', null),
			Array('Last Modified', 'gc_last_modified', 'modified', 10, 'gc_last_modified', null),
			Array('SWPPP Information', null, 'zone', 0,  null, 
				Array('Project Information', null, 'zone', 0,  null,
					Array('Project Number', 'gc_proj_num', 'text', 10, 'gc_proj_num', null),
					Array('Project originator', 'gc_proj_orig', 'text', 50, 'gc_proj_orig', null),
					Array('Project Contact', 'gc_proj_contact', 'drop-down', 50, 'gc_proj_contact',
						Array(
							'table_name' => 'view_contacts',
							'gc_proj_contact' => 'contact_name'
						)
					),
					Array('Customer Project #/s', 'gc_proj_customer_num', 'text', 50, 'gc_proj_customer_num', null)
				),
				Array('Order Date', 'gc_proj_order_date', 'text', '25', 'gc_proj_order_date', null),
				Array('Preparation Date', 'gc_proj_prep_date', 'text', '25', 'gc_proj_prep_date', null),
			),
			Array('Operator Information', null, 'zone', 0,  null, 
				Array('Owner', null, 'zone', 0,  null,
					Array('Legal Name', 'gc_owner_company_name', 'drop-down', 100, 'gc_owner_company_name',
						Array(
							'table_name'							=>	'companies',
							'gc_owner_company_name'				=>	'[Legal Company Name]',
							'gc_owner_company_owner'				=>	'[Company name]',
							'gc_owner_company_address'				=>	'Address',
							'gc_owner_company_city'				=>	'City',
							'gc_owner_company_state'				=>	'State',
							'gc_owner_company_zip'					=>	'Zip',
							'gc_owner_company_phone'				=>	'[Phone number]',
							'gc_owner_company_fax'					=>	'[Fax Number]',
							'gc_owner_company_cn'					=>	'[CN number]',
							'gc_owner_company_num_of_employees'	=>	'[# of comployees]',
							'gc_owner_company_tax_id'				=>	'[State tax id]',
							'gc_owner_company_sos_num'				=>	'[SOS #]',
							'gc_owner_company_duns_num'			=>	'[DUNS #]',
							'gc_owner_company_type'				=>	'[Type of company]',
							'gc_owner_company_sic_code'			=>	'[SIC code]',
							'gc_owner_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "gc_owner_company_name"),
																			'gc_owner_company_contact' => 'contact_name'
																		),
							'gc_owner_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "gc_owner_company_name", "[NOI Signer]" => 1),
																			'gc_owner_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'gc_owner_company_owner', 'text', 100, 'gc_owner_company_owner', null),
					Array('Address', 'gc_owner_company_address', 'text', 250, 'gc_owner_company_address', null),
					Array('City', 'gc_owner_company_city', 'text', 100, 'gc_owner_company_city', null),
					Array('State', 'gc_owner_company_state', 'text', 100, 'gc_owner_company_state', null),
					Array('Zip', 'gc_owner_company_zip', 'num', 25, 'gc_owner_company_zip', null),
					Array('Phone number', 'gc_owner_company_phone', 'phone', 25, 'gc_owner_company_phone', null),
					Array('Fax Number', 'gc_owner_company_fax', 'phone', 25, 'gc_owner_company_fax', null),
					Array('CN number', 'gc_owner_company_cn', 'text', 25, 'gc_owner_company_cn', null),
					Array('# of employees', 'gc_owner_company_num_of_employees', 'text', 10, 'gc_owner_company_num_of_employees', null),
					Array('State tax id', 'gc_owner_company_tax_id', 'text', 25, 'gc_owner_company_tax_id', null),
					Array('SOS #', 'gc_owner_company_sos_num', 'text', 25, 'gc_owner_company_sos_num', null),
					Array('DUNS #', 'gc_owner_company_duns_num', 'text', 25, 'gc_owner_company_duns_num', null),
					Array('Type of company', 'gc_owner_company_type', 'text', 50, 'gc_owner_company_type', null),
					Array('SIC code', 'gc_owner_company_sic_code', 'text', 25, 'gc_owner_company_sic_code', null),
					Array('Contact', 'gc_owner_company_contact', 'drop-down', 250, 'gc_owner_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'gc_owner_company_name'),
							'gc_owner_company_contact'				=>	'contact_name',
							'gc_owner_company_contact_title'		=>	'Title',
							'gc_owner_company_contact_email'		=>	'Email',
							'gc_owner_company_contact_company'		=>	'Company',
							'gc_owner_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'gc_owner_company_contact_title', 'text', 25, 'gc_owner_company_contact_title', null),
					Array('Contact phone', 'gc_owner_company_contact_phone', 'phone', 25, 'gc_owner_company_contact_phone', null),
					Array('Contact email', 'gc_owner_company_contact_email', 'email', 250, 'gc_owner_company_contact_email', null),
					Array('Contact company', 'gc_owner_company_contact_company', 'text', 100, 'gc_owner_company_contact_company', null),
					Array('Contact fax', 'gc_owner_company_contact_fax', 'text', 25, 'gc_owner_company_contact_fax', null),
					Array('NOI Signer', 'gc_owner_company_noi_signer', 'drop-down', 250, 'gc_owner_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'gc_owner_company_name', '[NOI Signer]' => 1),
							'gc_owner_company_noi_signer'			=>	'contact_name',
							'gc_owner_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'gc_owner_company_noi_signer_title', 'text', 250, 'gc_owner_company_noi_signer_title', null)
				),
				Array('General Contractor', null, 'zone', 0,  null,
					Array('Legal Name', 'gc_cont_company_name', 'drop-down', 250, 'gc_cont_company_name',
						Array(
							'table_name'							=>	'companies',
							'gc_cont_company_name'				=>	'[Legal Company Name]',
							'gc_cont_company_owner'				=>	'[Company name]',
							'gc_cont_company_address'				=>	'Address',
							'gc_cont_company_city'				=>	'City',
							'gc_cont_company_state'				=>	'State',
							'gc_cont_company_zip'					=>	'Zip',
							'gc_cont_company_phone'				=>	'[Phone number]',
							'gc_cont_company_fax'					=>	'[Fax Number]',
							'gc_cont_company_cn'					=>	'[CN number]',
							'gc_cont_company_num_of_employees'	=>	'[# of comployees]',
							'gc_cont_company_tax_id'				=>	'[State tax id]',
							'gc_cont_company_sos_num'				=>	'[SOS #]',
							'gc_cont_company_duns_num'			=>	'[DUNS #]',
							'gc_cont_company_type'				=>	'[Type of company]',
							'gc_cont_company_sic_code'			=>	'[SIC code]',
							'gc_cont_company_contact'				=>	Array('table_name' => 'view_contacts', 'gc_cont_company_contact' => 'contact_name')
						)
					),
					Array('Company name', 'gc_cont_company_owner', 'text', 250, 'gc_cont_company_owner', null),
					Array('Address', 'gc_cont_company_address', 'text', 100, 'gc_cont_company_address', null),
					Array('City', 'gc_cont_company_city', 'text', 250, 'gc_cont_company_city', null),
					Array('State', 'gc_cont_company_state', 'text', 100, 'gc_cont_company_state', null),
					Array('Zip', 'gc_cont_company_zip', 'num', 25, 'gc_cont_company_zip', null),
					Array('Phone number', 'gc_cont_company_phone', 'phone', 25, 'gc_cont_company_phone', null),
					Array('Fax Number', 'gc_cont_company_fax', 'phone', 25, 'gc_cont_company_fax', null),
					Array('CN number', 'gc_cont_company_cn', 'text', 25, 'gc_cont_company_cn', null),
					Array('# of comployees', 'gc_cont_company_num_of_employees', 'text', 10, 'gc_cont_company_num_of_employees', null),
					Array('State tax id', 'gc_cont_company_tax_id', 'text', 25, 'gc_cont_company_tax_id', null),
					Array('SOS #', 'gc_cont_company_sos_num', 'text', 25, 'gc_cont_company_sos_num', null),
					Array('DUNS #', 'gc_cont_company_duns_num', 'text', 25, 'gc_cont_company_duns_num', null),
					Array('Type of company', 'gc_cont_company_type', 'text', 50, 'gc_cont_company_type', null),
					Array('SIC code', 'gc_cont_company_sic_code', 'text', 25, 'gc_cont_company_sic_code', null),
					Array('Contact', 'gc_cont_company_contact', 'drop-down', 250, 'gc_cont_company_contact', 
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'gc_cont_company_name'),
							'gc_cont_company_contact'				=>	'contact_name',
							'gc_cont_company_contact_title'		=>	'Title',
							'gc_cont_company_contact_email'		=>	'Email',
							'gc_cont_company_contact_company'		=>	'Company',
							'gc_cont_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'gc_cont_company_contact_title', 'text', 250, 'gc_cont_company_contact_title', null),
					Array('Contact phone', 'gc_cont_company_contact_phone', 'phone', 25, 'gc_cont_company_contact_phone', null),
					Array('Contact email', 'gc_cont_company_contact_email', 'email', 250, 'gc_cont_company_contact_email', null),
					Array('Contact company', 'gc_cont_company_contact_company', 'text', 100, 'gc_cont_company_contact_company', null),
					Array('Contact fax', 'gc_cont_company_contact_fax', 'text', 25, 'gc_cont_company_contact_fax', null),
					Array('NOI Signer', 'gc_cont_company_noi_signer', 'drop-down', 250, 'gc_cont_company_noi_signer',
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'gc_cont_company_name', '[NOI Signer]' => 1),
							'gc_cont_company_noi_signer'			=>	'contact_name',
							'gc_cont_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'gc_cont_company_noi_signer_title', 'text', 250, 'gc_cont_company_noi_signer_title', null)
				),
				Array('Land owner/Developer', 'gc_land_owner', 'text', 250, 'gc_land_owner', null),
				Array('Other Operator 1', 'gc_other_operator_1', 'text', 250, 'gc_other_operator_1', null),
				Array('Other Operator 2', 'gc_other_operator_2', 'text', 250, 'gc_other_operator_2', null),
				Array('Other Operator 3', 'gc_other_operator_3', 'text', 250, 'gc_other_operator_3', null)
			),
			Array('Construction Site Information', null, 'zone', 0,  null,
				Array('Dates', null, 'zone', 0,  null,
					Array('Start date', 'gc_est_start_date', 'text', 25, 'gc_est_start_date', null),
					Array('Completion date', 'gc_est_comp_date', 'text', 25, 'gc_est_comp_date', null),
				),
				Array('Description', null, 'zone', 0,  null,
					Array('Project description', 'gc_proj_desc', 'textarea', 2000, 'gc_proj_desc', null),
					Array('Total Acres', 'gc_total_acres', 'num', 10, 'gc_total_acres', null),
					Array('Acres disturbed', 'gc_acres_disturbed', 'num', 10, 'gc_acres_disturbed', null),
					Array('Existing stormdrain sys', 'gc_existing_stormdrain', 'textarea', 1000, 'gc_existing_stormdrain', null),
					Array('Part of a larger plan', 'gc_larger_plan', 'drop-down', 25, 'gc_larger_plan', 'bool')
				)
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Soil type', null, 'zone', 0,  null,
					Array('Soil 1 type', 'gc_soil_1_type', 'drop-down', 255, 'gc_soil_1_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_1_type'	=>	'[Soil name]',
							'gc_soil_1_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_1_k'		=>	'[K factor]'
						)
					),
					Array('Soil 1 HSG', 'gc_soil_1_hsg', 'text', 50, 'gc_soil_1_hsg', null),
					Array('Soil 1 K Factor', 'gc_soil_1_k', 'text', 50, 'gc_soil_1_k', null),
					Array('Soil 1 Area', 'gc_soil_1_area', 'text', 25, 'gc_soil_1_area', null),
					Array('Soil 2 type', 'gc_soil_2_type', 'drop-down', 255, 'gc_soil_2_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_2_type'	=>	'[Soil name]',
							'gc_soil_2_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_2_k'		=>	'[K factor]'
						)
					),
					Array('Soil 2 HSG', 'gc_soil_2_hsg', 'text', 50, 'gc_soil_2_hsg', null),
					Array('Soil 2 K Factor', 'gc_soil_2_k', 'text', 50, 'gc_soil_2_k', null),
					Array('Soil 2 Area', 'gc_soil_2_area', 'text', 25, 'gc_soil_2_area', null),
					Array('Soil 3 type', 'gc_soil_3_type', 'drop-down', 255, 'gc_soil_3_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_3_type'	=>	'[Soil name]',
							'gc_soil_3_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_3_k'		=>	'[K factor]'
						)
					),
					Array('Soil 3 HSG', 'gc_soil_3_hsg', 'text', 50, 'gc_soil_3_hsg', null),
					Array('Soil 3 K Factor', 'gc_soil_3_k', 'text', 50, 'gc_soil_3_k', null),
					Array('Soil 3 Area', 'gc_soil_3_area', 'text', 25, 'gc_soil_3_area', null),
					Array('Soil 4 type', 'gc_soil_4_type', 'drop-down', 255, 'gc_soil_4_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_4_type'	=>	'[Soil name]',
							'gc_soil_4_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_4_k'		=>	'[K factor]'
						)
					),
					Array('Soil 4 HSG', 'gc_soil_4_hsg', 'text', 50, 'gc_soil_4_hsg', null),
					Array('Soil 4 K Factor', 'gc_soil_4_k', 'text', 50, 'gc_soil_4_k', null),
					Array('Soil 4 Area', 'gc_soil_4_area', 'text', 25, 'gc_soil_4_area', null),
					Array('Soil 5 type', 'gc_soil_5_type', 'drop-down', 255, 'gc_soil_5_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_5_type'	=>	'[Soil name]',
							'gc_soil_5_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_5_k'		=>	'[K factor]'
						)
					),
					Array('Soil 5 HSG', 'gc_soil_5_hsg', 'text', 50, 'gc_soil_5_hsg', null),
					Array('Soil 5 K Factor', 'gc_soil_5_k', 'text', 50, 'gc_soil_5_k', null),
					Array('Soil 5 Area', 'gc_soil_5_area', 'text', 25, 'gc_soil_5_area', null),
					Array('Soil 6 type', 'gc_soil_6_type', 'drop-down', 255, 'gc_soil_6_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_6_type'	=>	'[Soil name]',
							'gc_soil_6_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_6_k'		=>	'[K factor]'
						)
					),
					Array('Soil 6 HSG', 'gc_soil_6_hsg', 'text', 50, 'gc_soil_6_hsg', null),
					Array('Soil 6 K Factor', 'gc_soil_6_k', 'text', 50, 'gc_soil_6_k', null),
					Array('Soil 6 Area', 'gc_soil_6_area', 'text', 25, 'gc_soil_6_area', null),
					Array('Soil 7 type', 'gc_soil_7_type', 'drop-down', 255, 'gc_soil_7_type', 
						Array(
							'table_name'		=>	'soils',
							'gc_soil_7_type'	=>	'[Soil name]',
							'gc_soil_7_hsg'	=>	'[Soil hydrologic Group]',
							'gc_soil_7_k'		=>	'[K factor]'
						)
					),
					Array('Soil 7 HSG', 'gc_soil_7_hsg', 'text', 50, 'gc_soil_7_hsg', null),
					Array('Soil 7 K Factor', 'gc_soil_7_k', 'text', 50, 'gc_soil_7_k', null),
					Array('Soil 7 Area', 'gc_soil_7_area', 'text', 25, 'gc_soil_7_area', null),
				),
				Array('Erosivity', null, 'zone', 0,  null,
					Array('Erosivity', 'gc_erosivity', 'text', 100, 'gc_erosivity', null)
				),
				Array('Coefficient', null, 'zone', 0,  null,
					Array('Pre-Constionion Coefficient', 'gc_pre_coefficient', 'text', 100, 'gc_pre_coefficient', null),
					Array('Post-Constionion Coefficient', 'gc_post_coefficient', 'text', 100, 'gc_post_coefficient', null)
				),
			),
			Array('BMPs', null, 'zone', 0,  null, 
				Array('Critical Areas', null, 'zone', 0,  null,
					Array('Critical Area', 'gc_crit_area', 'textarea', 1000, 'gc_crit_area', null)
				),
				Array('Structural Controls', null, 'zone', 0,  null,
					Array('S-BMP1', 'gc_s_bmp_1', 'drop-down', 250, 'gc_s_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'gc_s_bmp_1'				=>	'BMP',
							'gc_s_bmp_1_desc'			=>	'Description',
							'gc_s_bmp_1_uses'			=>	'Uses',
							'gc_s_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'gc_s_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP1 Description', 'gc_s_bmp_1_desc', 'textarea', 1000, 'gc_s_bmp_1_desc', null),
					Array('S-BMP1 Uses', 'gc_s_bmp_1_uses', 'textarea', 1000, 'gc_s_bmp_1_uses', null),
					Array('S-BMP1 Inspection Schedule', 'gc_s_bmp_1_insp_sche', 'textarea', 1000, 'gc_s_bmp_1_insp_sche', null),
					Array('S-BMP1 Maintenance', 'gc_s_bmp_1_maint', 'textarea', 1000, 'gc_s_bmp_1_maint', null),
					Array('S-BMP1 Installation Schedule', 'gc_s_bmp_1_inst_sche', 'textarea', 1000, 'gc_s_bmp_1_inst_sche', null),
					Array('S-BMP2', 'gc_s_bmp_2', 'drop-down', 250, 'gc_s_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'gc_s_bmp_2'				=>	'BMP',
							'gc_s_bmp_2_desc'			=>	'Description',
							'gc_s_bmp_2_uses'			=>	'Uses',
							'gc_s_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'gc_s_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP2 Description', 'gc_s_bmp_2_desc', 'textarea', 1000, 'gc_s_bmp_2_desc', null),
					Array('S-BMP2 Uses', 'gc_s_bmp_2_uses', 'textarea', 1000, 'gc_s_bmp_2_uses', null),
					Array('S-BMP2 Inspection Schedule', 'gc_s_bmp_2_insp_sche', 'textarea', 1000, 'gc_s_bmp_2_insp_sche', null),
					Array('S-BMP2 Maintenance', 'gc_s_bmp_2_maint', 'textarea', 1000, 'gc_s_bmp_2_maint', null),
					Array('S-BMP2 Installation Schedule', 'gc_s_bmp_2_inst_sche', 'textarea', 1000, 'gc_s_bmp_2_inst_sche', null),
					Array('S-BMP3', 'gc_s_bmp_3', 'drop-down', 250, 'gc_s_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'gc_s_bmp_3'				=>	'BMP',
							'gc_s_bmp_3_desc'			=>	'Description',
							'gc_s_bmp_3_uses'			=>	'Uses',
							'gc_s_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'gc_s_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP3 Description', 'gc_s_bmp_3_desc', 'textarea', 1000, 'gc_s_bmp_3_desc', null),
					Array('S-BMP3 Uses', 'gc_s_bmp_3_uses', 'textarea', 1000, 'gc_s_bmp_3_uses', null),
					Array('S-BMP3 Inspection Schedule', 'gc_s_bmp_3_insp_sche', 'textarea', 1000, 'gc_s_bmp_3_insp_sche', null),
					Array('S-BMP3 Maintenance', 'gc_s_bmp_3_maint', 'textarea', 1000, 'gc_s_bmp_3_maint', null),
					Array('S-BMP3 Installation Schedule', 'gc_s_bmp_3_inst_sche', 'textarea', 1000, 'gc_s_bmp_3_inst_sche', null),
					Array('S-BMP4', 'gc_s_bmp_4', 'drop-down', 250, 'gc_s_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'gc_s_bmp_4'				=>	'BMP',
							'gc_s_bmp_4_desc'			=>	'Description',
							'gc_s_bmp_4_uses'			=>	'Uses',
							'gc_s_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'gc_s_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP4 Description', 'gc_s_bmp_4_desc', 'textarea', 1000, 'gc_s_bmp_4_desc', null),
					Array('S-BMP4 Uses', 'gc_s_bmp_4_uses', 'textarea', 1000, 'gc_s_bmp_4_uses', null),
					Array('S-BMP4 Inspection Schedule', 'gc_s_bmp_4_insp_sche', 'textarea', 1000, 'gc_s_bmp_4_insp_sche', null),
					Array('S-BMP4 Maintenance', 'gc_s_bmp_4_maint', 'textarea', 1000, 'gc_s_bmp_4_maint', null),
					Array('S-BMP4 Installation Schedule', 'gc_s_bmp_4_inst_sche', 'textarea', 1000, 'gc_s_bmp_4_inst_sche', null),
				),
				Array('NonStructural Controls', null, 'zone', 0,  null,
					Array('NS-BMP1', 'gc_ns_bmp_1', 'drop-down', 250, 'gc_ns_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'gc_ns_bmp_1'				=>	'BMP',
							'gc_ns_bmp_1_desc'		=>	'Description',
							'gc_ns_bmp_1_uses'		=>	'Uses',
							'gc_ns_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'gc_ns_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP1 Description', 'gc_ns_bmp_1_desc', 'textarea', 1000, 'gc_ns_bmp_1_desc', null),
					Array('NS-BMP1 Uses', 'gc_ns_bmp_1_uses', 'textarea', 1000, 'gc_ns_bmp_1_uses', null),
					Array('NS-BMP1 Inspection Schedule', 'gc_ns_bmp_1_insp_sche', 'textarea', 1000, 'gc_ns_bmp_1_insp_sche', null),
					Array('NS-BMP1 Maintenance', 'gc_ns_bmp_1_maint', 'textarea', 1000, 'gc_ns_bmp_1_maint', null),
					Array('NS-BMP1 Installation Schedule', 'gc_ns_bmp_1_inst_sche', 'textarea', 1000, 'gc_ns_bmp_1_inst_sche', null),
					Array('NS-BMP2', 'gc_ns_bmp_2', 'drop-down', 250, 'gc_ns_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'gc_ns_bmp_2'				=>	'BMP',
							'gc_ns_bmp_2_desc'		=>	'Description',
							'gc_ns_bmp_2_uses'		=>	'Uses',
							'gc_ns_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'gc_ns_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP2 Description', 'gc_ns_bmp_2_desc', 'textarea', 1000, 'gc_ns_bmp_2_desc', null),
					Array('NS-BMP2 Uses', 'gc_ns_bmp_2_uses', 'textarea', 1000, 'gc_ns_bmp_2_uses', null),
					Array('NS-BMP2 Inspection Schedule', 'gc_ns_bmp_2_insp_sche', 'textarea', 1000, 'gc_ns_bmp_2_insp_sche', null),
					Array('NS-BMP2 Maintenance', 'gc_ns_bmp_2_maint', 'textarea', 1000, 'gc_ns_bmp_2_maint', null),
					Array('NS-BMP2 Installation Schedule', 'gc_ns_bmp_2_inst_sche', 'textarea', 1000, 'gc_ns_bmp_2_inst_sche', null),
					Array('NS-BMP3', 'gc_ns_bmp_3', 'drop-down', 250, 'gc_ns_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'gc_ns_bmp_3'				=>	'BMP',
							'gc_ns_bmp_3_desc'		=>	'Description',
							'gc_ns_bmp_3_uses'		=>	'Uses',
							'gc_ns_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'gc_ns_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP3 Description', 'gc_ns_bmp_3_desc', 'textarea', 1000, 'gc_ns_bmp_3_desc', null),
					Array('NS-BMP3 Uses', 'gc_ns_bmp_3_uses', 'textarea', 1000, 'gc_ns_bmp_3_uses', null),
					Array('NS-BMP3 Inspection Schedule', 'gc_ns_bmp_3_insp_sche', 'textarea', 1000, 'gc_ns_bmp_3_insp_sche', null),
					Array('NS-BMP3 Maintenance', 'gc_ns_bmp_3_maint', 'textarea', 1000, 'gc_ns_bmp_3_maint', null),
					Array('NS-BMP3 Installation Schedule', 'gc_ns_bmp_3_inst_sche', 'textarea', 1000, 'gc_ns_bmp_3_inst_sche', null),
					Array('NS-BMP4', 'gc_ns_bmp_4', 'drop-down', 250, 'gc_ns_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'gc_ns_bmp_4'				=>	'BMP',
							'gc_ns_bmp_4_desc'		=>	'Description',
							'gc_ns_bmp_4_uses'		=>	'Uses',
							'gc_ns_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'gc_ns_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP4 Description', 'gc_ns_bmp_4_desc', 'textarea', 1000, 'gc_ns_bmp_4_desc', null),
					Array('NS-BMP4 Uses', 'gc_ns_bmp_4_uses', 'textarea', 1000, 'gc_ns_bmp_4_uses', null),
					Array('NS-BMP4 Inspection Schedule', 'gc_ns_bmp_4_insp_sche', 'textarea', 1000, 'gc_ns_bmp_4_insp_sche', null),
					Array('NS-BMP4 Maintenance', 'gc_ns_bmp_4_maint', 'textarea', 1000, 'gc_ns_bmp_4_maint', null),
					Array('NS-BMP4 Installation Schedule', 'gc_ns_bmp_4_inst_sche', 'textarea', 1000, 'gc_ns_bmp_4_inst_sche', null),
				),
				Array('Sedimentation pond', null, 'zone', 0,  null,
					Array('Yes/No', 'gc_sedi_pond', 'drop-down', 25, 'gc_sedi_pond', 'bool'),
					Array('Not feasible', 'gc_sedi_pond_feasible', 'textarea', 1000, 'gc_sedi_pond_feasible', null),
					Array('Design', 'gc_sedi_pond_design', 'textarea', 1000, 'gc_sedi_pond_design', null),
					Array('Construction', 'gc_sedi_pond_const', 'textarea', 1000, 'gc_sedi_pond_const', null),
					Array('Maintenance', 'gc_sedi_pond_maint', 'textarea', 1000, 'gc_sedi_pond_maint', null),
				),
			),
			Array('Project Responsibilities', null, 'zone', 0,  null, 
				Array('SWPPP Team', null, 'zone', 0,  null,
					Array('Team Member 1', 'gc_team_1_name', 'drop-down', 550, 'gc_team_1_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gc_team_1_name'		=>	'contact_name',
							'gc_team_1_phone'		=>	'[Phone number]',
							'gc_team_1_email'		=>	'Email'
						)
					),
					Array('Team Member 1 Position', 'gc_team_1_position', 'text', 250, 'gc_team_1_position', null),
					Array('Team Member 1 Role', 'gc_team_1_role', 'text', 250, 'gc_team_1_role', null),
					Array('Team Member 1 Phone', 'gc_team_1_phone', 'phone', 25, 'gc_team_1_phone', null),
					Array('Team Member 1 Email', 'gc_team_1_email', 'email', 250, 'gc_team_1_email', null),
					Array('Team Member 2', 'gc_team_2_name', 'drop-down', 550, 'gc_team_2_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gc_team_2_name'		=>	'contact_name',
							'gc_team_2_phone'		=>	'[Phone number]',
							'gc_team_2_email'		=>	'Email'
						)
					),
					Array('Team Member 2 Position', 'gc_team_2_position', 'text', 250, 'gc_team_2_position', null),
					Array('Team Member 2 Role', 'gc_team_2_role', 'text', 250, 'gc_team_2_role', null),
					Array('Team Member 2 Phone', 'gc_team_2_phone', 'phone', 25, 'gc_team_2_phone', null),
					Array('Team Member 2 Email', 'gc_team_2_email', 'email', 250, 'gc_team_2_email', null),
					Array('Team Member 3', 'gc_team_3_name', 'drop-down', 550, 'gc_team_3_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gc_team_3_name'		=>	'contact_name',
							'gc_team_3_phone'		=>	'[Phone number]',
							'gc_team_3_email'		=>	'Email'
						)
					),
					Array('Team Member 3 Position', 'gc_team_3_position', 'text', 250, 'gc_team_3_position', null),
					Array('Team Member 3 Role', 'gc_team_3_role', 'text', 250, 'gc_team_3_role', null),
					Array('Team Member 3 Phone', 'gc_team_3_phone', 'phone', 25, 'gc_team_3_phone', null),
					Array('Team Member 3 Email', 'gc_team_3_email', 'email', 250, 'gc_team_3_email', null),
					Array('Team Member 4', 'gc_team_4_name', 'drop-down', 550, 'gc_team_4_name',
						Array(
							'table_name'			=>	'view_contacts',
							'gc_team_4_name'		=>	'contact_name',
							'gc_team_4_phone'		=>	'[Phone number]',
							'gc_team_4_email'		=>	'Email'
						)
					),
					Array('Team Member 4 Position', 'gc_team_4_position', 'text', 250, 'gc_team_4_position', null),
					Array('Team Member 4 Role', 'gc_team_4_role', 'text', 250, 'gc_team_4_role', null),
					Array('Team Member 4 Phone', 'gc_team_4_phone', 'phone', 25, 'gc_team_4_phone', null),
					Array('Team Member 4 Email', 'gc_team_4_email', 'email', 250, 'gc_team_4_email', null),
				),
				Array('Inspections', null, 'zone', 0,  null, 
					Array('Inspector 1 name', 'gc_insp_1_name', 'drop-down', 550, 'gc_insp_1_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gc_insp_1_name'		=>	'contact_name',
							'gc_insp_1_company'	=>	'Company',
							'gc_insp_1_phone'		=>	'[Phone number]',
							'gc_insp_1_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 1 company', 'gc_insp_1_company', 'text', 250, 'gc_insp_1_company', null),
					Array('Inspector 1 phone', 'gc_insp_1_phone', 'text', 25, 'gc_insp_1_phone', null),
					Array('Inspector 1 qualifications', 'gc_insp_1_quals', 'text', 500, 'gc_insp_1_quals', null),
					Array('Inspector 2 name', 'gc_insp_2_name', 'drop-down', 550, 'gc_insp_2_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gc_insp_2_name'		=>	'contact_name',
							'gc_insp_2_company'	=>	'Company',
							'gc_insp_2_phone'		=>	'[Phone number]',
							'gc_insp_2_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 2 company', 'gc_insp_2_company', 'text', 250, 'gc_insp_2_company', null),
					Array('Inspector 2 phone', 'gc_insp_2_phone', 'text', 25, 'gc_insp_2_phone', null),
					Array('Inspector 2 qualifications', 'gc_insp_2_quals', 'text', 500, 'gc_insp_2_quals', null),
					Array('Inspector 3 name', 'gc_insp_3_name', 'drop-down', 550, 'gc_insp_3_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gc_insp_3_name'		=>	'contact_name',
							'gc_insp_3_company'	=>	'Company',
							'gc_insp_3_phone'		=>	'[Phone number]',
							'gc_insp_3_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 3 company', 'gc_insp_3_company', 'text', 250, 'gc_insp_3_company', null),
					Array('Inspector 3 phone', 'gc_insp_3_phone', 'text', 25, 'gc_insp_3_phone', null),
					Array('Inspector 3 qualifications', 'gc_insp_3_quals', 'text', 500, 'gc_insp_3_quals', null),
					Array('Inspector 4 name', 'gc_insp_4_name', 'drop-down', 550, 'gc_insp_4_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'gc_insp_4_name'		=>	'contact_name',
							'gc_insp_4_company'	=>	'Company',
							'gc_insp_4_phone'		=>	'[Phone number]',
							'gc_insp_4_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 4 company', 'gc_insp_4_company', 'text', 250, 'gc_insp_4_company', null),
					Array('Inspector 4 phone', 'gc_insp_4_phone', 'text', 25, 'gc_insp_4_phone', null),
					Array('Inspector 4 qualifications', 'gc_insp_4_quals', 'text', 500, 'gc_insp_4_quals', null),
					Array('Inspection Schedule', 'gc_insp_sche', 'drop-down', 550, 'gc_insp_sche',
						Array(
							'table_name'		=>	'inspection_schedule',
							'gc_insp_sche'		=>	'is_short'
						)
					)
				),
				Array('Stabilization', null, 'zone', 0,  null, 
					Array('Stabilization description', 'gc_stab_desc', 'textarea', 1000, 'gc_stab_desc', null),
					Array('Stabilization dates', 'gc_stab_dates', 'textarea', 1000, 'gc_stab_dates', null),
					Array('Stabilization schedule', 'gc_stab_sche', 'textarea', 1000, 'gc_stab_sche', null),
					Array('Stabilization responsibility', 'gc_stab_resp', 'textarea', 1000, 'gc_stab_resp', null)
				)
			)
		);
