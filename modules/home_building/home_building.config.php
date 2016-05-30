<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'hb_id', 'hidden', 10, 'hb_id', null),
			Array('Last Modified', 'hb_last_modified', 'modified', 10, 'hb_last_modified', null),
			Array('SWPPP Information', null, 'zone', 0,  null, 
				Array('Project Information', null, 'zone', 0,  null,
					Array('Project Number', 'hb_proj_num', 'text', 10, 'hb_proj_num', null),
					Array('Project originator', 'hb_proj_orig', 'text', 50, 'hb_proj_orig', null),
					Array('Project Contact', 'hb_proj_contact', 'drop-down', 50, 'hb_proj_contact',
						Array(
							'table_name' => 'view_contacts',
							'hb_proj_contact' => 'contact_name'
						)
					),
					Array('Customer Project #/s', 'hb_proj_customer_num', 'text', 50, 'hb_proj_customer_num', null)
				),
				Array('Order Date', 'hb_proj_order_date', 'text', '25', 'hb_proj_order_date', null),
				Array('Preparation Date', 'hb_proj_prep_date', 'text', '25', 'hb_proj_prep_date', null),
			),
			Array('Operator Information', null, 'zone', 0,  null, 
				Array('Owner', null, 'zone', 0,  null,
					Array('Legal Name', 'hb_owner_company_name', 'drop-down', 100, 'hb_owner_company_name',
						Array(
							'table_name'							=>	'companies',
							'hb_owner_company_name'				=>	'[Legal Company Name]',
							'hb_owner_company_owner'				=>	'[Company name]',
							'hb_owner_company_address'				=>	'Address',
							'hb_owner_company_city'				=>	'City',
							'hb_owner_company_state'				=>	'State',
							'hb_owner_company_zip'					=>	'Zip',
							'hb_owner_company_phone'				=>	'[Phone number]',
							'hb_owner_company_fax'					=>	'[Fax Number]',
							'hb_owner_company_cn'					=>	'[CN number]',
							'hb_owner_company_num_of_employees'	=>	'[# of comployees]',
							'hb_owner_company_tax_id'				=>	'[State tax id]',
							'hb_owner_company_sos_num'				=>	'[SOS #]',
							'hb_owner_company_duns_num'			=>	'[DUNS #]',
							'hb_owner_company_type'				=>	'[Type of company]',
							'hb_owner_company_sic_code'			=>	'[SIC code]',
							'hb_owner_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "hb_owner_company_name"),
																			'hb_owner_company_contact' => 'contact_name'
																		),
							'hb_owner_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "hb_owner_company_name", "[NOI Signer]" => 1),
																			'hb_owner_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'hb_owner_company_owner', 'text', 100, 'hb_owner_company_owner', null),
					Array('Address', 'hb_owner_company_address', 'text', 250, 'hb_owner_company_address', null),
					Array('City', 'hb_owner_company_city', 'text', 100, 'hb_owner_company_city', null),
					Array('State', 'hb_owner_company_state', 'text', 100, 'hb_owner_company_state', null),
					Array('Zip', 'hb_owner_company_zip', 'num', 25, 'hb_owner_company_zip', null),
					Array('Phone number', 'hb_owner_company_phone', 'phone', 25, 'hb_owner_company_phone', null),
					Array('Fax Number', 'hb_owner_company_fax', 'phone', 25, 'hb_owner_company_fax', null),
					Array('CN number', 'hb_owner_company_cn', 'text', 25, 'hb_owner_company_cn', null),
					Array('# of employees', 'hb_owner_company_num_of_employees', 'text', 10, 'hb_owner_company_num_of_employees', null),
					Array('State tax id', 'hb_owner_company_tax_id', 'text', 25, 'hb_owner_company_tax_id', null),
					Array('SOS #', 'hb_owner_company_sos_num', 'text', 25, 'hb_owner_company_sos_num', null),
					Array('DUNS #', 'hb_owner_company_duns_num', 'text', 25, 'hb_owner_company_duns_num', null),
					Array('Type of company', 'hb_owner_company_type', 'text', 50, 'hb_owner_company_type', null),
					Array('SIC code', 'hb_owner_company_sic_code', 'text', 25, 'hb_owner_company_sic_code', null),
					Array('Contact', 'hb_owner_company_contact', 'drop-down', 250, 'hb_owner_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'hb_owner_company_name'),
							'hb_owner_company_contact'				=>	'contact_name',
							'hb_owner_company_contact_title'		=>	'Title',
							'hb_owner_company_contact_email'		=>	'Email',
							'hb_owner_company_contact_company'		=>	'Company',
							'hb_owner_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'hb_owner_company_contact_title', 'text', 25, 'hb_owner_company_contact_title', null),
					Array('Contact phone', 'hb_owner_company_contact_phone', 'phone', 25, 'hb_owner_company_contact_phone', null),
					Array('Contact email', 'hb_owner_company_contact_email', 'email', 250, 'hb_owner_company_contact_email', null),
					Array('Contact company', 'hb_owner_company_contact_company', 'text', 100, 'hb_owner_company_contact_company', null),
					Array('Contact fax', 'hb_owner_company_contact_fax', 'text', 25, 'hb_owner_company_contact_fax', null),
					Array('NOI Signer', 'hb_owner_company_noi_signer', 'drop-down', 250, 'hb_owner_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'hb_owner_company_name', '[NOI Signer]' => 1),
							'hb_owner_company_noi_signer'			=>	'contact_name',
							'hb_owner_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'hb_owner_company_noi_signer_title', 'text', 250, 'hb_owner_company_noi_signer_title', null)
				),
				Array('Land owner/Developer', 'hb_land_owner', 'text', 250, 'hb_land_owner', null),
				Array('Other Operator 1', 'hb_other_operator_1', 'text', 250, 'hb_other_operator_1', null),
				Array('Other Operator 2', 'hb_other_operator_2', 'text', 250, 'hb_other_operator_2', null),
				Array('Other Operator 3', 'hb_other_operator_3', 'text', 250, 'hb_other_operator_3', null)
			),
			Array('Construction Site Information', null, 'zone', 0,  null,
				Array('Dates', null, 'zone', 0,  null,
					Array('Start date', 'hb_est_start_date', 'text', 25, 'hb_est_start_date', null),
					Array('Completion date', 'hb_est_comp_date', 'text', 25, 'hb_est_comp_date', null),
				),
				Array('Description', null, 'zone', 0,  null,
					Array('Project description', 'hb_proj_desc', 'textarea', 2000, 'hb_proj_desc', null),
					Array('Total Acres', 'hb_total_acres', 'num', 10, 'hb_total_acres', null),
					Array('Acres disturbed', 'hb_acres_disturbed', 'num', 10, 'hb_acres_disturbed', null),
					Array('Existing stormdrain sys', 'hb_existing_stormdrain', 'textarea', 1000, 'hb_existing_stormdrain', null),
					Array('Part of a larger plan', 'hb_larger_plan', 'drop-down', 25, 'hb_larger_plan', 'bool')
				)
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Soil type', null, 'zone', 0,  null,
					Array('Soil 1 type', 'hb_soil_1_type', 'drop-down', 255, 'hb_soil_1_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_1_type'	=>	'[Soil name]',
							'hb_soil_1_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_1_k'		=>	'[K factor]'
						)
					),
					Array('Soil 1 HSG', 'hb_soil_1_hsg', 'text', 50, 'hb_soil_1_hsg', null),
					Array('Soil 1 K Factor', 'hb_soil_1_k', 'text', 50, 'hb_soil_1_k', null),
					Array('Soil 1 Area', 'hb_soil_1_area', 'text', 25, 'hb_soil_1_area', null),
					Array('Soil 2 type', 'hb_soil_2_type', 'drop-down', 255, 'hb_soil_2_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_2_type'	=>	'[Soil name]',
							'hb_soil_2_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_2_k'		=>	'[K factor]'
						)
					),
					Array('Soil 2 HSG', 'hb_soil_2_hsg', 'text', 50, 'hb_soil_2_hsg', null),
					Array('Soil 2 K Factor', 'hb_soil_2_k', 'text', 50, 'hb_soil_2_k', null),
					Array('Soil 2 Area', 'hb_soil_2_area', 'text', 25, 'hb_soil_2_area', null),
					Array('Soil 3 type', 'hb_soil_3_type', 'drop-down', 255, 'hb_soil_3_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_3_type'	=>	'[Soil name]',
							'hb_soil_3_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_3_k'		=>	'[K factor]'
						)
					),
					Array('Soil 3 HSG', 'hb_soil_3_hsg', 'text', 50, 'hb_soil_3_hsg', null),
					Array('Soil 3 K Factor', 'hb_soil_3_k', 'text', 50, 'hb_soil_3_k', null),
					Array('Soil 3 Area', 'hb_soil_3_area', 'text', 25, 'hb_soil_3_area', null),
					Array('Soil 4 type', 'hb_soil_4_type', 'drop-down', 255, 'hb_soil_4_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_4_type'	=>	'[Soil name]',
							'hb_soil_4_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_4_k'		=>	'[K factor]'
						)
					),
					Array('Soil 4 HSG', 'hb_soil_4_hsg', 'text', 50, 'hb_soil_4_hsg', null),
					Array('Soil 4 K Factor', 'hb_soil_4_k', 'text', 50, 'hb_soil_4_k', null),
					Array('Soil 4 Area', 'hb_soil_4_area', 'text', 25, 'hb_soil_4_area', null),
					Array('Soil 5 type', 'hb_soil_5_type', 'drop-down', 255, 'hb_soil_5_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_5_type'	=>	'[Soil name]',
							'hb_soil_5_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_5_k'		=>	'[K factor]'
						)
					),
					Array('Soil 5 HSG', 'hb_soil_5_hsg', 'text', 50, 'hb_soil_5_hsg', null),
					Array('Soil 5 K Factor', 'hb_soil_5_k', 'text', 50, 'hb_soil_5_k', null),
					Array('Soil 5 Area', 'hb_soil_5_area', 'text', 25, 'hb_soil_5_area', null),
					Array('Soil 6 type', 'hb_soil_6_type', 'drop-down', 255, 'hb_soil_6_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_6_type'	=>	'[Soil name]',
							'hb_soil_6_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_6_k'		=>	'[K factor]'
						)
					),
					Array('Soil 6 HSG', 'hb_soil_6_hsg', 'text', 50, 'hb_soil_6_hsg', null),
					Array('Soil 6 K Factor', 'hb_soil_6_k', 'text', 50, 'hb_soil_6_k', null),
					Array('Soil 6 Area', 'hb_soil_6_area', 'text', 25, 'hb_soil_6_area', null),
					Array('Soil 7 type', 'hb_soil_7_type', 'drop-down', 255, 'hb_soil_7_type', 
						Array(
							'table_name'		=>	'soils',
							'hb_soil_7_type'	=>	'[Soil name]',
							'hb_soil_7_hsg'	=>	'[Soil hydrologic Group]',
							'hb_soil_7_k'		=>	'[K factor]'
						)
					),
					Array('Soil 7 HSG', 'hb_soil_7_hsg', 'text', 50, 'hb_soil_7_hsg', null),
					Array('Soil 7 K Factor', 'hb_soil_7_k', 'text', 50, 'hb_soil_7_k', null),
					Array('Soil 7 Area', 'hb_soil_7_area', 'text', 25, 'hb_soil_7_area', null),
				),
				Array('Erosivity', null, 'zone', 0,  null,
					Array('Erosivity', 'hb_erosivity', 'text', 100, 'hb_erosivity', null)
				),
				Array('Coefficient', null, 'zone', 0,  null,
					Array('Pre-Constionion Coefficient', 'hb_pre_coefficient', 'text', 100, 'hb_pre_coefficient', null),
					Array('Post-Constionion Coefficient', 'hb_post_coefficient', 'text', 100, 'hb_post_coefficient', null)
				),
			),
			Array('BMPs', null, 'zone', 0,  null, 
				Array('Critical Areas', null, 'zone', 0,  null,
					Array('Critical Area', 'hb_crit_area', 'textarea', 1000, 'hb_crit_area', null)
				),
				Array('Structural Controls', null, 'zone', 0,  null,
					Array('S-BMP1', 'hb_s_bmp_1', 'drop-down', 250, 'hb_s_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'hb_s_bmp_1'				=>	'BMP',
							'hb_s_bmp_1_desc'			=>	'Description',
							'hb_s_bmp_1_uses'			=>	'Uses',
							'hb_s_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'hb_s_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP1 Description', 'hb_s_bmp_1_desc', 'textarea', 1000, 'hb_s_bmp_1_desc', null),
					Array('S-BMP1 Uses', 'hb_s_bmp_1_uses', 'textarea', 1000, 'hb_s_bmp_1_uses', null),
					Array('S-BMP1 Inspection Schedule', 'hb_s_bmp_1_insp_sche', 'textarea', 1000, 'hb_s_bmp_1_insp_sche', null),
					Array('S-BMP1 Maintenance', 'hb_s_bmp_1_maint', 'textarea', 1000, 'hb_s_bmp_1_maint', null),
					Array('S-BMP1 Installation Schedule', 'hb_s_bmp_1_inst_sche', 'textarea', 1000, 'hb_s_bmp_1_inst_sche', null),
					Array('S-BMP2', 'hb_s_bmp_2', 'drop-down', 250, 'hb_s_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'hb_s_bmp_2'				=>	'BMP',
							'hb_s_bmp_2_desc'			=>	'Description',
							'hb_s_bmp_2_uses'			=>	'Uses',
							'hb_s_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'hb_s_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP2 Description', 'hb_s_bmp_2_desc', 'textarea', 1000, 'hb_s_bmp_2_desc', null),
					Array('S-BMP2 Uses', 'hb_s_bmp_2_uses', 'textarea', 1000, 'hb_s_bmp_2_uses', null),
					Array('S-BMP2 Inspection Schedule', 'hb_s_bmp_2_insp_sche', 'textarea', 1000, 'hb_s_bmp_2_insp_sche', null),
					Array('S-BMP2 Maintenance', 'hb_s_bmp_2_maint', 'textarea', 1000, 'hb_s_bmp_2_maint', null),
					Array('S-BMP2 Installation Schedule', 'hb_s_bmp_2_inst_sche', 'textarea', 1000, 'hb_s_bmp_2_inst_sche', null),
					Array('S-BMP3', 'hb_s_bmp_3', 'drop-down', 250, 'hb_s_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'hb_s_bmp_3'				=>	'BMP',
							'hb_s_bmp_3_desc'			=>	'Description',
							'hb_s_bmp_3_uses'			=>	'Uses',
							'hb_s_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'hb_s_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP3 Description', 'hb_s_bmp_3_desc', 'textarea', 1000, 'hb_s_bmp_3_desc', null),
					Array('S-BMP3 Uses', 'hb_s_bmp_3_uses', 'textarea', 1000, 'hb_s_bmp_3_uses', null),
					Array('S-BMP3 Inspection Schedule', 'hb_s_bmp_3_insp_sche', 'textarea', 1000, 'hb_s_bmp_3_insp_sche', null),
					Array('S-BMP3 Maintenance', 'hb_s_bmp_3_maint', 'textarea', 1000, 'hb_s_bmp_3_maint', null),
					Array('S-BMP3 Installation Schedule', 'hb_s_bmp_3_inst_sche', 'textarea', 1000, 'hb_s_bmp_3_inst_sche', null),
					Array('S-BMP4', 'hb_s_bmp_4', 'drop-down', 250, 'hb_s_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'hb_s_bmp_4'				=>	'BMP',
							'hb_s_bmp_4_desc'			=>	'Description',
							'hb_s_bmp_4_uses'			=>	'Uses',
							'hb_s_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'hb_s_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP4 Description', 'hb_s_bmp_4_desc', 'textarea', 1000, 'hb_s_bmp_4_desc', null),
					Array('S-BMP4 Uses', 'hb_s_bmp_4_uses', 'textarea', 1000, 'hb_s_bmp_4_uses', null),
					Array('S-BMP4 Inspection Schedule', 'hb_s_bmp_4_insp_sche', 'textarea', 1000, 'hb_s_bmp_4_insp_sche', null),
					Array('S-BMP4 Maintenance', 'hb_s_bmp_4_maint', 'textarea', 1000, 'hb_s_bmp_4_maint', null),
					Array('S-BMP4 Installation Schedule', 'hb_s_bmp_4_inst_sche', 'textarea', 1000, 'hb_s_bmp_4_inst_sche', null),
				),
				Array('NonStructural Controls', null, 'zone', 0,  null,
					Array('NS-BMP1', 'hb_ns_bmp_1', 'drop-down', 250, 'hb_ns_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'hb_ns_bmp_1'				=>	'BMP',
							'hb_ns_bmp_1_desc'		=>	'Description',
							'hb_ns_bmp_1_uses'		=>	'Uses',
							'hb_ns_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'hb_ns_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP1 Description', 'hb_ns_bmp_1_desc', 'textarea', 1000, 'hb_ns_bmp_1_desc', null),
					Array('NS-BMP1 Uses', 'hb_ns_bmp_1_uses', 'textarea', 1000, 'hb_ns_bmp_1_uses', null),
					Array('NS-BMP1 Inspection Schedule', 'hb_ns_bmp_1_insp_sche', 'textarea', 1000, 'hb_ns_bmp_1_insp_sche', null),
					Array('NS-BMP1 Maintenance', 'hb_ns_bmp_1_maint', 'textarea', 1000, 'hb_ns_bmp_1_maint', null),
					Array('NS-BMP1 Installation Schedule', 'hb_ns_bmp_1_inst_sche', 'textarea', 1000, 'hb_ns_bmp_1_inst_sche', null),
					Array('NS-BMP2', 'hb_ns_bmp_2', 'drop-down', 250, 'hb_ns_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'hb_ns_bmp_2'				=>	'BMP',
							'hb_ns_bmp_2_desc'		=>	'Description',
							'hb_ns_bmp_2_uses'		=>	'Uses',
							'hb_ns_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'hb_ns_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP2 Description', 'hb_ns_bmp_2_desc', 'textarea', 1000, 'hb_ns_bmp_2_desc', null),
					Array('NS-BMP2 Uses', 'hb_ns_bmp_2_uses', 'textarea', 1000, 'hb_ns_bmp_2_uses', null),
					Array('NS-BMP2 Inspection Schedule', 'hb_ns_bmp_2_insp_sche', 'textarea', 1000, 'hb_ns_bmp_2_insp_sche', null),
					Array('NS-BMP2 Maintenance', 'hb_ns_bmp_2_maint', 'textarea', 1000, 'hb_ns_bmp_2_maint', null),
					Array('NS-BMP2 Installation Schedule', 'hb_ns_bmp_2_inst_sche', 'textarea', 1000, 'hb_ns_bmp_2_inst_sche', null),
					Array('NS-BMP3', 'hb_ns_bmp_3', 'drop-down', 250, 'hb_ns_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'hb_ns_bmp_3'				=>	'BMP',
							'hb_ns_bmp_3_desc'		=>	'Description',
							'hb_ns_bmp_3_uses'		=>	'Uses',
							'hb_ns_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'hb_ns_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP3 Description', 'hb_ns_bmp_3_desc', 'textarea', 1000, 'hb_ns_bmp_3_desc', null),
					Array('NS-BMP3 Uses', 'hb_ns_bmp_3_uses', 'textarea', 1000, 'hb_ns_bmp_3_uses', null),
					Array('NS-BMP3 Inspection Schedule', 'hb_ns_bmp_3_insp_sche', 'textarea', 1000, 'hb_ns_bmp_3_insp_sche', null),
					Array('NS-BMP3 Maintenance', 'hb_ns_bmp_3_maint', 'textarea', 1000, 'hb_ns_bmp_3_maint', null),
					Array('NS-BMP3 Installation Schedule', 'hb_ns_bmp_3_inst_sche', 'textarea', 1000, 'hb_ns_bmp_3_inst_sche', null),
					Array('NS-BMP4', 'hb_ns_bmp_4', 'drop-down', 250, 'hb_ns_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'hb_ns_bmp_4'				=>	'BMP',
							'hb_ns_bmp_4_desc'		=>	'Description',
							'hb_ns_bmp_4_uses'		=>	'Uses',
							'hb_ns_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'hb_ns_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP4 Description', 'hb_ns_bmp_4_desc', 'textarea', 1000, 'hb_ns_bmp_4_desc', null),
					Array('NS-BMP4 Uses', 'hb_ns_bmp_4_uses', 'textarea', 1000, 'hb_ns_bmp_4_uses', null),
					Array('NS-BMP4 Inspection Schedule', 'hb_ns_bmp_4_insp_sche', 'textarea', 1000, 'hb_ns_bmp_4_insp_sche', null),
					Array('NS-BMP4 Maintenance', 'hb_ns_bmp_4_maint', 'textarea', 1000, 'hb_ns_bmp_4_maint', null),
					Array('NS-BMP4 Installation Schedule', 'hb_ns_bmp_4_inst_sche', 'textarea', 1000, 'hb_ns_bmp_4_inst_sche', null),
				),
				Array('Sedimentation pond', null, 'zone', 0,  null,
					Array('Yes/No', 'hb_sedi_pond', 'drop-down', 25, 'hb_sedi_pond', 'bool'),
					Array('Not feasible', 'hb_sedi_pond_feasible', 'textarea', 1000, 'hb_sedi_pond_feasible', null),
					Array('Design', 'hb_sedi_pond_design', 'textarea', 1000, 'hb_sedi_pond_design', null),
					Array('Construction', 'hb_sedi_pond_const', 'textarea', 1000, 'hb_sedi_pond_const', null),
					Array('Maintenance', 'hb_sedi_pond_maint', 'textarea', 1000, 'hb_sedi_pond_maint', null),
				),
			),
			Array('Project Responsibilities', null, 'zone', 0,  null, 
				Array('SWPPP Team', null, 'zone', 0,  null,
					Array('Team Member 1', 'hb_team_1_name', 'drop-down', 550, 'hb_team_1_name',
						Array(
							'table_name'			=>	'view_contacts',
							'hb_team_1_name'		=>	'contact_name',
							'hb_team_1_phone'		=>	'[Phone number]',
							'hb_team_1_email'		=>	'Email'
						)
					),
					Array('Team Member 1 Position', 'hb_team_1_position', 'text', 250, 'hb_team_1_position', null),
					Array('Team Member 1 Role', 'hb_team_1_role', 'text', 250, 'hb_team_1_role', null),
					Array('Team Member 1 Phone', 'hb_team_1_phone', 'phone', 25, 'hb_team_1_phone', null),
					Array('Team Member 1 Email', 'hb_team_1_email', 'email', 250, 'hb_team_1_email', null),
					Array('Team Member 2', 'hb_team_2_name', 'drop-down', 550, 'hb_team_2_name',
						Array(
							'table_name'			=>	'view_contacts',
							'hb_team_2_name'		=>	'contact_name',
							'hb_team_2_phone'		=>	'[Phone number]',
							'hb_team_2_email'		=>	'Email'
						)
					),
					Array('Team Member 2 Position', 'hb_team_2_position', 'text', 250, 'hb_team_2_position', null),
					Array('Team Member 2 Role', 'hb_team_2_role', 'text', 250, 'hb_team_2_role', null),
					Array('Team Member 2 Phone', 'hb_team_2_phone', 'phone', 25, 'hb_team_2_phone', null),
					Array('Team Member 2 Email', 'hb_team_2_email', 'email', 250, 'hb_team_2_email', null),
					Array('Team Member 3', 'hb_team_3_name', 'drop-down', 550, 'hb_team_3_name',
						Array(
							'table_name'			=>	'view_contacts',
							'hb_team_3_name'		=>	'contact_name',
							'hb_team_3_phone'		=>	'[Phone number]',
							'hb_team_3_email'		=>	'Email'
						)
					),
					Array('Team Member 3 Position', 'hb_team_3_position', 'text', 250, 'hb_team_3_position', null),
					Array('Team Member 3 Role', 'hb_team_3_role', 'text', 250, 'hb_team_3_role', null),
					Array('Team Member 3 Phone', 'hb_team_3_phone', 'phone', 25, 'hb_team_3_phone', null),
					Array('Team Member 3 Email', 'hb_team_3_email', 'email', 250, 'hb_team_3_email', null),
					Array('Team Member 4', 'hb_team_4_name', 'drop-down', 550, 'hb_team_4_name',
						Array(
							'table_name'			=>	'view_contacts',
							'hb_team_4_name'		=>	'contact_name',
							'hb_team_4_phone'		=>	'[Phone number]',
							'hb_team_4_email'		=>	'Email'
						)
					),
					Array('Team Member 4 Position', 'hb_team_4_position', 'text', 250, 'hb_team_4_position', null),
					Array('Team Member 4 Role', 'hb_team_4_role', 'text', 250, 'hb_team_4_role', null),
					Array('Team Member 4 Phone', 'hb_team_4_phone', 'phone', 25, 'hb_team_4_phone', null),
					Array('Team Member 4 Email', 'hb_team_4_email', 'email', 250, 'hb_team_4_email', null),
				),
				Array('Inspections', null, 'zone', 0,  null, 
					Array('Inspector 1 name', 'hb_insp_1_name', 'drop-down', 550, 'hb_insp_1_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'hb_insp_1_name'		=>	'contact_name',
							'hb_insp_1_company'	=>	'Company',
							'hb_insp_1_phone'		=>	'[Phone number]',
							'hb_insp_1_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 1 company', 'hb_insp_1_company', 'text', 250, 'hb_insp_1_company', null),
					Array('Inspector 1 phone', 'hb_insp_1_phone', 'text', 25, 'hb_insp_1_phone', null),
					Array('Inspector 1 qualifications', 'hb_insp_1_quals', 'text', 500, 'hb_insp_1_quals', null),
					Array('Inspector 2 name', 'hb_insp_2_name', 'drop-down', 550, 'hb_insp_2_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'hb_insp_2_name'		=>	'contact_name',
							'hb_insp_2_company'	=>	'Company',
							'hb_insp_2_phone'		=>	'[Phone number]',
							'hb_insp_2_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 2 company', 'hb_insp_2_company', 'text', 250, 'hb_insp_2_company', null),
					Array('Inspector 2 phone', 'hb_insp_2_phone', 'text', 25, 'hb_insp_2_phone', null),
					Array('Inspector 2 qualifications', 'hb_insp_2_quals', 'text', 500, 'hb_insp_2_quals', null),
					Array('Inspector 3 name', 'hb_insp_3_name', 'drop-down', 550, 'hb_insp_3_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'hb_insp_3_name'		=>	'contact_name',
							'hb_insp_3_company'	=>	'Company',
							'hb_insp_3_phone'		=>	'[Phone number]',
							'hb_insp_3_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 3 company', 'hb_insp_3_company', 'text', 250, 'hb_insp_3_company', null),
					Array('Inspector 3 phone', 'hb_insp_3_phone', 'text', 25, 'hb_insp_3_phone', null),
					Array('Inspector 3 qualifications', 'hb_insp_3_quals', 'text', 500, 'hb_insp_3_quals', null),
					Array('Inspector 4 name', 'hb_insp_4_name', 'drop-down', 550, 'hb_insp_4_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'hb_insp_4_name'		=>	'contact_name',
							'hb_insp_4_company'	=>	'Company',
							'hb_insp_4_phone'		=>	'[Phone number]',
							'hb_insp_4_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 4 company', 'hb_insp_4_company', 'text', 250, 'hb_insp_4_company', null),
					Array('Inspector 4 phone', 'hb_insp_4_phone', 'text', 25, 'hb_insp_4_phone', null),
					Array('Inspector 4 qualifications', 'hb_insp_4_quals', 'text', 500, 'hb_insp_4_quals', null),
					Array('Inspection Schedule', 'hb_insp_sche', 'drop-down', 550, 'hb_insp_sche',
						Array(
							'table_name'		=>	'inspection_schedule',
							'hb_insp_sche'		=>	'is_short'
						)
					)
				),
				Array('Stabilization', null, 'zone', 0,  null, 
					Array('Stabilization description', 'hb_stab_desc', 'textarea', 1000, 'hb_stab_desc', null),
					Array('Stabilization dates', 'hb_stab_dates', 'textarea', 1000, 'hb_stab_dates', null),
					Array('Stabilization schedule', 'hb_stab_sche', 'textarea', 1000, 'hb_stab_sche', null),
					Array('Stabilization responsibility', 'hb_stab_resp', 'textarea', 1000, 'hb_stab_resp', null)
				)
			)
		);
