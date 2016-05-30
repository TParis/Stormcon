<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'ld_id', 'hidden', 10, 'ld_id', null),
			Array('Last Modified', 'ld_last_modified', 'modified', 10, 'ld_last_modified', null),
			Array('SWPPP Information', null, 'zone', 0,  null, 
				Array('Project Information', null, 'zone', 0,  null,
					Array('Project Number', 'ld_proj_num', 'text', 10, 'ld_proj_num', null),
					Array('Project originator', 'ld_proj_orig', 'text', 50, 'ld_proj_orig', null),
					Array('Project Contact', 'ld_proj_contact', 'drop-down', 50, 'ld_proj_contact',
						Array(
							'table_name' => 'view_contacts',
							'ld_proj_contact' => 'contact_name'
						)
					),
					Array('Customer Project #/s', 'ld_proj_customer_num', 'text', 50, 'ld_proj_customer_num', null)
				),
				Array('Order Date', 'ld_proj_order_date', 'text', '25', 'ld_proj_order_date', null),
				Array('Preparation Date', 'ld_proj_prep_date', 'text', '25', 'ld_proj_prep_date', null),
			),
			Array('Operator Information', null, 'zone', 0,  null, 
				Array('Owner', null, 'zone', 0,  null,
					Array('Legal Name', 'ld_owner_company_name', 'drop-down', 100, 'ld_owner_company_name',
						Array(
							'table_name'							=>	'companies',
							'ld_owner_company_name'				=>	'[Legal Company Name]',
							'ld_owner_company_owner'				=>	'[Company name]',
							'ld_owner_company_address'				=>	'Address',
							'ld_owner_company_city'				=>	'City',
							'ld_owner_company_state'				=>	'State',
							'ld_owner_company_zip'					=>	'Zip',
							'ld_owner_company_phone'				=>	'[Phone number]',
							'ld_owner_company_fax'					=>	'[Fax Number]',
							'ld_owner_company_cn'					=>	'[CN number]',
							'ld_owner_company_num_of_employees'	=>	'[# of comployees]',
							'ld_owner_company_tax_id'				=>	'[State tax id]',
							'ld_owner_company_sos_num'				=>	'[SOS #]',
							'ld_owner_company_duns_num'			=>	'[DUNS #]',
							'ld_owner_company_type'				=>	'[Type of company]',
							'ld_owner_company_sic_code'			=>	'[SIC code]',
							'ld_owner_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_owner_company_name"),
																			'ld_owner_company_contact' => 'contact_name'
																		),
							'ld_owner_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_owner_company_name", "[NOI Signer]" => 1),
																			'ld_owner_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'ld_owner_company_owner', 'text', 100, 'ld_owner_company_owner', null),
					Array('Address', 'ld_owner_company_address', 'text', 250, 'ld_owner_company_address', null),
					Array('City', 'ld_owner_company_city', 'text', 100, 'ld_owner_company_city', null),
					Array('State', 'ld_owner_company_state', 'text', 100, 'ld_owner_company_state', null),
					Array('Zip', 'ld_owner_company_zip', 'num', 25, 'ld_owner_company_zip', null),
					Array('Phone number', 'ld_owner_company_phone', 'phone', 25, 'ld_owner_company_phone', null),
					Array('Fax Number', 'ld_owner_company_fax', 'phone', 25, 'ld_owner_company_fax', null),
					Array('CN number', 'ld_owner_company_cn', 'text', 25, 'ld_owner_company_cn', null),
					Array('# of employees', 'ld_owner_company_num_of_employees', 'text', 10, 'ld_owner_company_num_of_employees', null),
					Array('State tax id', 'ld_owner_company_tax_id', 'text', 25, 'ld_owner_company_tax_id', null),
					Array('SOS #', 'ld_owner_company_sos_num', 'text', 25, 'ld_owner_company_sos_num', null),
					Array('DUNS #', 'ld_owner_company_duns_num', 'text', 25, 'ld_owner_company_duns_num', null),
					Array('Type of company', 'ld_owner_company_type', 'text', 50, 'ld_owner_company_type', null),
					Array('SIC code', 'ld_owner_company_sic_code', 'text', 25, 'ld_owner_company_sic_code', null),
					Array('Contact', 'ld_owner_company_contact', 'drop-down', 250, 'ld_owner_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'ld_owner_company_name'),
							'ld_owner_company_contact'				=>	'contact_name',
							'ld_owner_company_contact_title'		=>	'Title',
							'ld_owner_company_contact_email'		=>	'Email',
							'ld_owner_company_contact_company'		=>	'Company',
							'ld_owner_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'ld_owner_company_contact_title', 'text', 25, 'ld_owner_company_contact_title', null),
					Array('Contact phone', 'ld_owner_company_contact_phone', 'phone', 25, 'ld_owner_company_contact_phone', null),
					Array('Contact email', 'ld_owner_company_contact_email', 'email', 250, 'ld_owner_company_contact_email', null),
					Array('Contact company', 'ld_owner_company_contact_company', 'text', 100, 'ld_owner_company_contact_company', null),
					Array('Contact fax', 'ld_owner_company_contact_fax', 'text', 25, 'ld_owner_company_contact_fax', null),
					Array('NOI Signer', 'ld_owner_company_noi_signer', 'drop-down', 250, 'ld_owner_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'ld_owner_company_name', '[NOI Signer]' => 1),
							'ld_owner_company_noi_signer'			=>	'contact_name',
							'ld_owner_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'ld_owner_company_noi_signer_title', 'text', 250, 'ld_owner_company_noi_signer_title', null)
				),
				Array('Excavation', null, 'zone', 0,  null,
					Array('Legal Name', 'ld_exc_company_name', 'drop-down', 100, 'ld_exc_company_name',
						Array(
							'table_name'							=>	'companies',
							'ld_exc_company_name'				=>	'[Legal Company Name]',
							'ld_exc_company_owner'				=>	'[Company name]',
							'ld_exc_company_address'				=>	'Address',
							'ld_exc_company_city'				=>	'City',
							'ld_exc_company_state'				=>	'State',
							'ld_exc_company_zip'					=>	'Zip',
							'ld_exc_company_phone'				=>	'[Phone number]',
							'ld_exc_company_fax'					=>	'[Fax Number]',
							'ld_exc_company_cn'					=>	'[CN number]',
							'ld_exc_company_num_of_employees'	=>	'[# of comployees]',
							'ld_exc_company_tax_id'				=>	'[State tax id]',
							'ld_exc_company_sos_num'				=>	'[SOS #]',
							'ld_exc_company_duns_num'			=>	'[DUNS #]',
							'ld_exc_company_type'				=>	'[Type of company]',
							'ld_exc_company_sic_code'			=>	'[SIC code]',
							'ld_exc_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_exc_company_name"),
																			'ld_exc_company_contact' => 'contact_name'
																		),
							'ld_exc_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_exc_company_name", "[NOI Signer]" => 1),
																			'ld_exc_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'ld_exc_company_owner', 'text', 100, 'ld_exc_company_owner', null),
					Array('Address', 'ld_exc_company_address', 'text', 250, 'ld_exc_company_address', null),
					Array('City', 'ld_exc_company_city', 'text', 100, 'ld_exc_company_city', null),
					Array('State', 'ld_exc_company_state', 'text', 100, 'ld_exc_company_state', null),
					Array('Zip', 'ld_exc_company_zip', 'num', 25, 'ld_exc_company_zip', null),
					Array('Phone number', 'ld_exc_company_phone', 'phone', 25, 'ld_exc_company_phone', null),
					Array('Fax Number', 'ld_exc_company_fax', 'phone', 25, 'ld_exc_company_fax', null),
					Array('CN number', 'ld_exc_company_cn', 'text', 25, 'ld_exc_company_cn', null),
					Array('# of employees', 'ld_exc_company_num_of_employees', 'text', 10, 'ld_exc_company_num_of_employees', null),
					Array('State tax id', 'ld_exc_company_tax_id', 'text', 25, 'ld_exc_company_tax_id', null),
					Array('SOS #', 'ld_exc_company_sos_num', 'text', 25, 'ld_exc_company_sos_num', null),
					Array('DUNS #', 'ld_exc_company_duns_num', 'text', 25, 'ld_exc_company_duns_num', null),
					Array('Type of company', 'ld_exc_company_type', 'text', 50, 'ld_exc_company_type', null),
					Array('SIC code', 'ld_exc_company_sic_code', 'text', 25, 'ld_exc_company_sic_code', null),
					Array('Contact', 'ld_exc_company_contact', 'drop-down', 250, 'ld_exc_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'ld_exc_company_name'),
							'ld_exc_company_contact'				=>	'contact_name',
							'ld_exc_company_contact_title'		=>	'Title',
							'ld_exc_company_contact_email'		=>	'Email',
							'ld_exc_company_contact_company'		=>	'Company',
							'ld_exc_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'ld_exc_company_contact_title', 'text', 25, 'ld_exc_company_contact_title', null),
					Array('Contact phone', 'ld_exc_company_contact_phone', 'phone', 25, 'ld_exc_company_contact_phone', null),
					Array('Contact email', 'ld_exc_company_contact_email', 'email', 250, 'ld_exc_company_contact_email', null),
					Array('Contact company', 'ld_exc_company_contact_company', 'text', 100, 'ld_exc_company_contact_company', null),
					Array('Contact fax', 'ld_exc_company_contact_fax', 'text', 25, 'ld_exc_company_contact_fax', null),
					Array('NOI Signer', 'ld_exc_company_noi_signer', 'drop-down', 250, 'ld_exc_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'ld_exc_company_name', '[NOI Signer]' => 1),
							'ld_exc_company_noi_signer'			=>	'contact_name',
							'ld_exc_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'ld_exc_company_noi_signer_title', 'text', 250, 'ld_exc_company_noi_signer_title', null)
				),
				Array('Wet Utility', null, 'zone', 0,  null,
					Array('Legal Name', 'ld_wet_company_name', 'drop-down', 100, 'ld_wet_company_name',
						Array(
							'table_name'							=>	'companies',
							'ld_wet_company_name'				=>	'[Legal Company Name]',
							'ld_wet_company_owner'				=>	'[Company name]',
							'ld_wet_company_address'				=>	'Address',
							'ld_wet_company_city'				=>	'City',
							'ld_wet_company_state'				=>	'State',
							'ld_wet_company_zip'					=>	'Zip',
							'ld_wet_company_phone'				=>	'[Phone number]',
							'ld_wet_company_fax'					=>	'[Fax Number]',
							'ld_wet_company_cn'					=>	'[CN number]',
							'ld_wet_company_num_of_employees'	=>	'[# of comployees]',
							'ld_wet_company_tax_id'				=>	'[State tax id]',
							'ld_wet_company_sos_num'				=>	'[SOS #]',
							'ld_wet_company_duns_num'			=>	'[DUNS #]',
							'ld_wet_company_type'				=>	'[Type of company]',
							'ld_wet_company_sic_code'			=>	'[SIC code]',
							'ld_wet_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_wet_company_name"),
																			'ld_wet_company_contact' => 'contact_name'
																		),
							'ld_wet_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_wet_company_name", "[NOI Signer]" => 1),
																			'ld_wet_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'ld_wet_company_owner', 'text', 100, 'ld_wet_company_owner', null),
					Array('Address', 'ld_wet_company_address', 'text', 250, 'ld_wet_company_address', null),
					Array('City', 'ld_wet_company_city', 'text', 100, 'ld_wet_company_city', null),
					Array('State', 'ld_wet_company_state', 'text', 100, 'ld_wet_company_state', null),
					Array('Zip', 'ld_wet_company_zip', 'num', 25, 'ld_wet_company_zip', null),
					Array('Phone number', 'ld_wet_company_phone', 'phone', 25, 'ld_wet_company_phone', null),
					Array('Fax Number', 'ld_wet_company_fax', 'phone', 25, 'ld_wet_company_fax', null),
					Array('CN number', 'ld_wet_company_cn', 'text', 25, 'ld_wet_company_cn', null),
					Array('# of employees', 'ld_wet_company_num_of_employees', 'text', 10, 'ld_wet_company_num_of_employees', null),
					Array('State tax id', 'ld_wet_company_tax_id', 'text', 25, 'ld_wet_company_tax_id', null),
					Array('SOS #', 'ld_wet_company_sos_num', 'text', 25, 'ld_wet_company_sos_num', null),
					Array('DUNS #', 'ld_wet_company_duns_num', 'text', 25, 'ld_wet_company_duns_num', null),
					Array('Type of company', 'ld_wet_company_type', 'text', 50, 'ld_wet_company_type', null),
					Array('SIC code', 'ld_wet_company_sic_code', 'text', 25, 'ld_wet_company_sic_code', null),
					Array('Contact', 'ld_wet_company_contact', 'drop-down', 250, 'ld_wet_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'ld_wet_company_name'),
							'ld_wet_company_contact'				=>	'contact_name',
							'ld_wet_company_contact_title'		=>	'Title',
							'ld_wet_company_contact_email'		=>	'Email',
							'ld_wet_company_contact_company'		=>	'Company',
							'ld_wet_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'ld_wet_company_contact_title', 'text', 25, 'ld_wet_company_contact_title', null),
					Array('Contact phone', 'ld_wet_company_contact_phone', 'phone', 25, 'ld_wet_company_contact_phone', null),
					Array('Contact email', 'ld_wet_company_contact_email', 'email', 250, 'ld_wet_company_contact_email', null),
					Array('Contact company', 'ld_wet_company_contact_company', 'text', 100, 'ld_wet_company_contact_company', null),
					Array('Contact fax', 'ld_wet_company_contact_fax', 'text', 25, 'ld_wet_company_contact_fax', null),
					Array('NOI Signer', 'ld_wet_company_noi_signer', 'drop-down', 250, 'ld_wet_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'ld_wet_company_name', '[NOI Signer]' => 1),
							'ld_wet_company_noi_signer'			=>	'contact_name',
							'ld_wet_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'ld_wet_company_noi_signer_title', 'text', 250, 'ld_wet_company_noi_signer_title', null)
				),
				Array('Paving', null, 'zone', 0,  null,
					Array('Legal Name', 'ld_pav_company_name', 'drop-down', 100, 'ld_pav_company_name',
						Array(
							'table_name'							=>	'companies',
							'ld_pav_company_name'				=>	'[Legal Company Name]',
							'ld_pav_company_owner'				=>	'[Company name]',
							'ld_pav_company_address'				=>	'Address',
							'ld_pav_company_city'				=>	'City',
							'ld_pav_company_state'				=>	'State',
							'ld_pav_company_zip'					=>	'Zip',
							'ld_pav_company_phone'				=>	'[Phone number]',
							'ld_pav_company_fax'					=>	'[Fax Number]',
							'ld_pav_company_cn'					=>	'[CN number]',
							'ld_pav_company_num_of_employees'	=>	'[# of comployees]',
							'ld_pav_company_tax_id'				=>	'[State tax id]',
							'ld_pav_company_sos_num'				=>	'[SOS #]',
							'ld_pav_company_duns_num'			=>	'[DUNS #]',
							'ld_pav_company_type'				=>	'[Type of company]',
							'ld_pav_company_sic_code'			=>	'[SIC code]',
							'ld_pav_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_pav_company_name"),
																			'ld_pav_company_contact' => 'contact_name'
																		),
							'ld_pav_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_pav_company_name", "[NOI Signer]" => 1),
																			'ld_pav_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'ld_pav_company_owner', 'text', 100, 'ld_pav_company_owner', null),
					Array('Address', 'ld_pav_company_address', 'text', 250, 'ld_pav_company_address', null),
					Array('City', 'ld_pav_company_city', 'text', 100, 'ld_pav_company_city', null),
					Array('State', 'ld_pav_company_state', 'text', 100, 'ld_pav_company_state', null),
					Array('Zip', 'ld_pav_company_zip', 'num', 25, 'ld_pav_company_zip', null),
					Array('Phone number', 'ld_pav_company_phone', 'phone', 25, 'ld_pav_company_phone', null),
					Array('Fax Number', 'ld_pav_company_fax', 'phone', 25, 'ld_pav_company_fax', null),
					Array('CN number', 'ld_pav_company_cn', 'text', 25, 'ld_pav_company_cn', null),
					Array('# of employees', 'ld_pav_company_num_of_employees', 'text', 10, 'ld_pav_company_num_of_employees', null),
					Array('State tax id', 'ld_pav_company_tax_id', 'text', 25, 'ld_pav_company_tax_id', null),
					Array('SOS #', 'ld_pav_company_sos_num', 'text', 25, 'ld_pav_company_sos_num', null),
					Array('DUNS #', 'ld_pav_company_duns_num', 'text', 25, 'ld_pav_company_duns_num', null),
					Array('Type of company', 'ld_pav_company_type', 'text', 50, 'ld_pav_company_type', null),
					Array('SIC code', 'ld_pav_company_sic_code', 'text', 25, 'ld_pav_company_sic_code', null),
					Array('Contact', 'ld_pav_company_contact', 'drop-down', 250, 'ld_pav_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'ld_pav_company_name'),
							'ld_pav_company_contact'				=>	'contact_name',
							'ld_pav_company_contact_title'		=>	'Title',
							'ld_pav_company_contact_email'		=>	'Email',
							'ld_pav_company_contact_company'		=>	'Company',
							'ld_pav_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'ld_pav_company_contact_title', 'text', 25, 'ld_pav_company_contact_title', null),
					Array('Contact phone', 'ld_pav_company_contact_phone', 'phone', 25, 'ld_pav_company_contact_phone', null),
					Array('Contact email', 'ld_pav_company_contact_email', 'email', 250, 'ld_pav_company_contact_email', null),
					Array('Contact company', 'ld_pav_company_contact_company', 'text', 100, 'ld_pav_company_contact_company', null),
					Array('Contact fax', 'ld_pav_company_contact_fax', 'text', 25, 'ld_pav_company_contact_fax', null),
					Array('NOI Signer', 'ld_pav_company_noi_signer', 'drop-down', 250, 'ld_pav_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'ld_pav_company_name', '[NOI Signer]' => 1),
							'ld_pav_company_noi_signer'			=>	'contact_name',
							'ld_pav_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'ld_pav_company_noi_signer_title', 'text', 250, 'ld_pav_company_noi_signer_title', null)
				),
				Array('Dry Utilities', null, 'zone', 0,  null,
					Array('Legal Name', 'ld_dry_company_name', 'drop-down', 100, 'ld_dry_company_name',
						Array(
							'table_name'							=>	'companies',
							'ld_dry_company_name'				=>	'[Legal Company Name]',
							'ld_dry_company_owner'				=>	'[Company name]',
							'ld_dry_company_address'				=>	'Address',
							'ld_dry_company_city'				=>	'City',
							'ld_dry_company_state'				=>	'State',
							'ld_dry_company_zip'					=>	'Zip',
							'ld_dry_company_phone'				=>	'[Phone number]',
							'ld_dry_company_fax'					=>	'[Fax Number]',
							'ld_dry_company_cn'					=>	'[CN number]',
							'ld_dry_company_num_of_employees'	=>	'[# of comployees]',
							'ld_dry_company_tax_id'				=>	'[State tax id]',
							'ld_dry_company_sos_num'				=>	'[SOS #]',
							'ld_dry_company_duns_num'			=>	'[DUNS #]',
							'ld_dry_company_type'				=>	'[Type of company]',
							'ld_dry_company_sic_code'			=>	'[SIC code]',
							'ld_dry_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_dry_company_name"),
																			'ld_dry_company_contact' => 'contact_name'
																		),
							'ld_dry_company_noi_signer'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "ld_dry_company_name", "[NOI Signer]" => 1),
																			'ld_dry_company_noi_signer' => 'contact_name'
																		),
						)
					),
					Array('Company name', 'ld_dry_company_owner', 'text', 100, 'ld_dry_company_owner', null),
					Array('Address', 'ld_dry_company_address', 'text', 250, 'ld_dry_company_address', null),
					Array('City', 'ld_dry_company_city', 'text', 100, 'ld_dry_company_city', null),
					Array('State', 'ld_dry_company_state', 'text', 100, 'ld_dry_company_state', null),
					Array('Zip', 'ld_dry_company_zip', 'num', 25, 'ld_dry_company_zip', null),
					Array('Phone number', 'ld_dry_company_phone', 'phone', 25, 'ld_dry_company_phone', null),
					Array('Fax Number', 'ld_dry_company_fax', 'phone', 25, 'ld_dry_company_fax', null),
					Array('CN number', 'ld_dry_company_cn', 'text', 25, 'ld_dry_company_cn', null),
					Array('# of employees', 'ld_dry_company_num_of_employees', 'text', 10, 'ld_dry_company_num_of_employees', null),
					Array('State tax id', 'ld_dry_company_tax_id', 'text', 25, 'ld_dry_company_tax_id', null),
					Array('SOS #', 'ld_dry_company_sos_num', 'text', 25, 'ld_dry_company_sos_num', null),
					Array('DUNS #', 'ld_dry_company_duns_num', 'text', 25, 'ld_dry_company_duns_num', null),
					Array('Type of company', 'ld_dry_company_type', 'text', 50, 'ld_dry_company_type', null),
					Array('SIC code', 'ld_dry_company_sic_code', 'text', 25, 'ld_dry_company_sic_code', null),
					Array('Contact', 'ld_dry_company_contact', 'drop-down', 250, 'ld_dry_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'ld_dry_company_name'),
							'ld_dry_company_contact'				=>	'contact_name',
							'ld_dry_company_contact_title'		=>	'Title',
							'ld_dry_company_contact_email'		=>	'Email',
							'ld_dry_company_contact_company'		=>	'Company',
							'ld_dry_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact title', 'ld_dry_company_contact_title', 'text', 25, 'ld_dry_company_contact_title', null),
					Array('Contact phone', 'ld_dry_company_contact_phone', 'phone', 25, 'ld_dry_company_contact_phone', null),
					Array('Contact email', 'ld_dry_company_contact_email', 'email', 250, 'ld_dry_company_contact_email', null),
					Array('Contact company', 'ld_dry_company_contact_company', 'text', 100, 'ld_dry_company_contact_company', null),
					Array('Contact fax', 'ld_dry_company_contact_fax', 'text', 25, 'ld_dry_company_contact_fax', null),
					Array('NOI Signer', 'ld_dry_company_noi_signer', 'drop-down', 250, 'ld_dry_company_noi_signer', 
						Array(
							'table_name'					=>	'view_contacts',
							'constraints'					=>	Array("[Company]" => 'ld_dry_company_name', '[NOI Signer]' => 1),
							'ld_dry_company_noi_signer'			=>	'contact_name',
							'ld_dry_company_noi_signer_title'	=>	'Title',
						)
					),
					Array('NOI Signer title', 'ld_dry_company_noi_signer_title', 'text', 250, 'ld_dry_company_noi_signer_title', null)
				),
				Array('Land owner/Developer', 'ld_land_owner', 'text', 250, 'ld_land_owner', null),
				Array('Other Operator 1', 'ld_other_operator_1', 'text', 250, 'ld_other_operator_1', null),
				Array('Other Operator 2', 'ld_other_operator_2', 'text', 250, 'ld_other_operator_2', null),
				Array('Other Operator 3', 'ld_other_operator_3', 'text', 250, 'ld_other_operator_3', null)
			),
			Array('Construction Site Information', null, 'zone', 0,  null,
				Array('Dates', null, 'zone', 0,  null,
					Array('Start date', 'ld_est_start_date', 'text', 25, 'ld_est_start_date', null),
					Array('Completion date', 'ld_est_comp_date', 'text', 25, 'ld_est_comp_date', null),
				),
				Array('Description', null, 'zone', 0,  null,
					Array('Project description', 'ld_proj_desc', 'textarea', 2000, 'ld_proj_desc', null),
					Array('Total Acres', 'ld_total_acres', 'num', 10, 'ld_total_acres', null),
					Array('Acres disturbed', 'ld_acres_disturbed', 'num', 10, 'ld_acres_disturbed', null),
					Array('Existing stormdrain sys', 'ld_existing_stormdrain', 'textarea', 1000, 'ld_existing_stormdrain', null),
					Array('Part of a larger plan', 'ld_larger_plan', 'drop-down', 25, 'ld_larger_plan', 'bool')
				)
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Soil type', null, 'zone', 0,  null,
					Array('Soil 1 type', 'ld_soil_1_type', 'drop-down', 255, 'ld_soil_1_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_1_type'	=>	'[Soil name]',
							'ld_soil_1_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_1_k'		=>	'[K factor]'
						)
					),
					Array('Soil 1 HSG', 'ld_soil_1_hsg', 'text', 50, 'ld_soil_1_hsg', null),
					Array('Soil 1 K Factor', 'ld_soil_1_k', 'text', 50, 'ld_soil_1_k', null),
					Array('Soil 1 Area', 'ld_soil_1_area', 'text', 25, 'ld_soil_1_area', null),
					Array('Soil 2 type', 'ld_soil_2_type', 'drop-down', 255, 'ld_soil_2_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_2_type'	=>	'[Soil name]',
							'ld_soil_2_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_2_k'		=>	'[K factor]'
						)
					),
					Array('Soil 2 HSG', 'ld_soil_2_hsg', 'text', 50, 'ld_soil_2_hsg', null),
					Array('Soil 2 K Factor', 'ld_soil_2_k', 'text', 50, 'ld_soil_2_k', null),
					Array('Soil 2 Area', 'ld_soil_2_area', 'text', 25, 'ld_soil_2_area', null),
					Array('Soil 3 type', 'ld_soil_3_type', 'drop-down', 255, 'ld_soil_3_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_3_type'	=>	'[Soil name]',
							'ld_soil_3_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_3_k'		=>	'[K factor]'
						)
					),
					Array('Soil 3 HSG', 'ld_soil_3_hsg', 'text', 50, 'ld_soil_3_hsg', null),
					Array('Soil 3 K Factor', 'ld_soil_3_k', 'text', 50, 'ld_soil_3_k', null),
					Array('Soil 3 Area', 'ld_soil_3_area', 'text', 25, 'ld_soil_3_area', null),
					Array('Soil 4 type', 'ld_soil_4_type', 'drop-down', 255, 'ld_soil_4_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_4_type'	=>	'[Soil name]',
							'ld_soil_4_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_4_k'		=>	'[K factor]'
						)
					),
					Array('Soil 4 HSG', 'ld_soil_4_hsg', 'text', 50, 'ld_soil_4_hsg', null),
					Array('Soil 4 K Factor', 'ld_soil_4_k', 'text', 50, 'ld_soil_4_k', null),
					Array('Soil 4 Area', 'ld_soil_4_area', 'text', 25, 'ld_soil_4_area', null),
					Array('Soil 5 type', 'ld_soil_5_type', 'drop-down', 255, 'ld_soil_5_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_5_type'	=>	'[Soil name]',
							'ld_soil_5_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_5_k'		=>	'[K factor]'
						)
					),
					Array('Soil 5 HSG', 'ld_soil_5_hsg', 'text', 50, 'ld_soil_5_hsg', null),
					Array('Soil 5 K Factor', 'ld_soil_5_k', 'text', 50, 'ld_soil_5_k', null),
					Array('Soil 5 Area', 'ld_soil_5_area', 'text', 25, 'ld_soil_5_area', null),
					Array('Soil 6 type', 'ld_soil_6_type', 'drop-down', 255, 'ld_soil_6_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_6_type'	=>	'[Soil name]',
							'ld_soil_6_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_6_k'		=>	'[K factor]'
						)
					),
					Array('Soil 6 HSG', 'ld_soil_6_hsg', 'text', 50, 'ld_soil_6_hsg', null),
					Array('Soil 6 K Factor', 'ld_soil_6_k', 'text', 50, 'ld_soil_6_k', null),
					Array('Soil 6 Area', 'ld_soil_6_area', 'text', 25, 'ld_soil_6_area', null),
					Array('Soil 7 type', 'ld_soil_7_type', 'drop-down', 255, 'ld_soil_7_type', 
						Array(
							'table_name'		=>	'soils',
							'ld_soil_7_type'	=>	'[Soil name]',
							'ld_soil_7_hsg'	=>	'[Soil hydrologic Group]',
							'ld_soil_7_k'		=>	'[K factor]'
						)
					),
					Array('Soil 7 HSG', 'ld_soil_7_hsg', 'text', 50, 'ld_soil_7_hsg', null),
					Array('Soil 7 K Factor', 'ld_soil_7_k', 'text', 50, 'ld_soil_7_k', null),
					Array('Soil 7 Area', 'ld_soil_7_area', 'text', 25, 'ld_soil_7_area', null),
				),
				Array('Erosivity', null, 'zone', 0,  null,
					Array('Erosivity', 'ld_erosivity', 'text', 100, 'ld_erosivity', null)
				),
				Array('Coefficient', null, 'zone', 0,  null,
					Array('Pre-Constionion Coefficient', 'ld_pre_coefficient', 'text', 100, 'ld_pre_coefficient', null),
					Array('Post-Constionion Coefficient', 'ld_post_coefficient', 'text', 100, 'ld_post_coefficient', null)
				),
			),
			Array('BMPs', null, 'zone', 0,  null, 
				Array('Critical Areas', null, 'zone', 0,  null,
					Array('Critical Area', 'ld_crit_area', 'textarea', 1000, 'ld_crit_area', null)
				),
				Array('Structural Controls', null, 'zone', 0,  null,
					Array('S-BMP1', 'ld_s_bmp_1', 'drop-down', 250, 'ld_s_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'ld_s_bmp_1'				=>	'BMP',
							'ld_s_bmp_1_desc'			=>	'Description',
							'ld_s_bmp_1_uses'			=>	'Uses',
							'ld_s_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'ld_s_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP1 Description', 'ld_s_bmp_1_desc', 'textarea', 1000, 'ld_s_bmp_1_desc', null),
					Array('S-BMP1 Uses', 'ld_s_bmp_1_uses', 'textarea', 1000, 'ld_s_bmp_1_uses', null),
					Array('S-BMP1 Inspection Schedule', 'ld_s_bmp_1_insp_sche', 'textarea', 1000, 'ld_s_bmp_1_insp_sche', null),
					Array('S-BMP1 Maintenance', 'ld_s_bmp_1_maint', 'textarea', 1000, 'ld_s_bmp_1_maint', null),
					Array('S-BMP1 Installation Schedule', 'ld_s_bmp_1_inst_sche', 'textarea', 1000, 'ld_s_bmp_1_inst_sche', null),
					Array('S-BMP2', 'ld_s_bmp_2', 'drop-down', 250, 'ld_s_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'ld_s_bmp_2'				=>	'BMP',
							'ld_s_bmp_2_desc'			=>	'Description',
							'ld_s_bmp_2_uses'			=>	'Uses',
							'ld_s_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'ld_s_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP2 Description', 'ld_s_bmp_2_desc', 'textarea', 1000, 'ld_s_bmp_2_desc', null),
					Array('S-BMP2 Uses', 'ld_s_bmp_2_uses', 'textarea', 1000, 'ld_s_bmp_2_uses', null),
					Array('S-BMP2 Inspection Schedule', 'ld_s_bmp_2_insp_sche', 'textarea', 1000, 'ld_s_bmp_2_insp_sche', null),
					Array('S-BMP2 Maintenance', 'ld_s_bmp_2_maint', 'textarea', 1000, 'ld_s_bmp_2_maint', null),
					Array('S-BMP2 Installation Schedule', 'ld_s_bmp_2_inst_sche', 'textarea', 1000, 'ld_s_bmp_2_inst_sche', null),
					Array('S-BMP3', 'ld_s_bmp_3', 'drop-down', 250, 'ld_s_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'ld_s_bmp_3'				=>	'BMP',
							'ld_s_bmp_3_desc'			=>	'Description',
							'ld_s_bmp_3_uses'			=>	'Uses',
							'ld_s_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'ld_s_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP3 Description', 'ld_s_bmp_3_desc', 'textarea', 1000, 'ld_s_bmp_3_desc', null),
					Array('S-BMP3 Uses', 'ld_s_bmp_3_uses', 'textarea', 1000, 'ld_s_bmp_3_uses', null),
					Array('S-BMP3 Inspection Schedule', 'ld_s_bmp_3_insp_sche', 'textarea', 1000, 'ld_s_bmp_3_insp_sche', null),
					Array('S-BMP3 Maintenance', 'ld_s_bmp_3_maint', 'textarea', 1000, 'ld_s_bmp_3_maint', null),
					Array('S-BMP3 Installation Schedule', 'ld_s_bmp_3_inst_sche', 'textarea', 1000, 'ld_s_bmp_3_inst_sche', null),
					Array('S-BMP4', 'ld_s_bmp_4', 'drop-down', 250, 'ld_s_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'ld_s_bmp_4'				=>	'BMP',
							'ld_s_bmp_4_desc'			=>	'Description',
							'ld_s_bmp_4_uses'			=>	'Uses',
							'ld_s_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'ld_s_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('S-BMP4 Description', 'ld_s_bmp_4_desc', 'textarea', 1000, 'ld_s_bmp_4_desc', null),
					Array('S-BMP4 Uses', 'ld_s_bmp_4_uses', 'textarea', 1000, 'ld_s_bmp_4_uses', null),
					Array('S-BMP4 Inspection Schedule', 'ld_s_bmp_4_insp_sche', 'textarea', 1000, 'ld_s_bmp_4_insp_sche', null),
					Array('S-BMP4 Maintenance', 'ld_s_bmp_4_maint', 'textarea', 1000, 'ld_s_bmp_4_maint', null),
					Array('S-BMP4 Installation Schedule', 'ld_s_bmp_4_inst_sche', 'textarea', 1000, 'ld_s_bmp_4_inst_sche', null),
				),
				Array('NonStructural Controls', null, 'zone', 0,  null,
					Array('NS-BMP1', 'ld_ns_bmp_1', 'drop-down', 250, 'ld_ns_bmp_1', 
						Array(
							'table_name'				=>	'bmps',
							'ld_ns_bmp_1'				=>	'BMP',
							'ld_ns_bmp_1_desc'		=>	'Description',
							'ld_ns_bmp_1_uses'		=>	'Uses',
							'ld_ns_bmp_1_insp_sche'	=>	'[Inspection Schedule]',
							'ld_ns_bmp_1_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP1 Description', 'ld_ns_bmp_1_desc', 'textarea', 1000, 'ld_ns_bmp_1_desc', null),
					Array('NS-BMP1 Uses', 'ld_ns_bmp_1_uses', 'textarea', 1000, 'ld_ns_bmp_1_uses', null),
					Array('NS-BMP1 Inspection Schedule', 'ld_ns_bmp_1_insp_sche', 'textarea', 1000, 'ld_ns_bmp_1_insp_sche', null),
					Array('NS-BMP1 Maintenance', 'ld_ns_bmp_1_maint', 'textarea', 1000, 'ld_ns_bmp_1_maint', null),
					Array('NS-BMP1 Installation Schedule', 'ld_ns_bmp_1_inst_sche', 'textarea', 1000, 'ld_ns_bmp_1_inst_sche', null),
					Array('NS-BMP2', 'ld_ns_bmp_2', 'drop-down', 250, 'ld_ns_bmp_2', 
						Array(
							'table_name'				=>	'bmps',
							'ld_ns_bmp_2'				=>	'BMP',
							'ld_ns_bmp_2_desc'		=>	'Description',
							'ld_ns_bmp_2_uses'		=>	'Uses',
							'ld_ns_bmp_2_insp_sche'	=>	'[Inspection Schedule]',
							'ld_ns_bmp_2_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP2 Description', 'ld_ns_bmp_2_desc', 'textarea', 1000, 'ld_ns_bmp_2_desc', null),
					Array('NS-BMP2 Uses', 'ld_ns_bmp_2_uses', 'textarea', 1000, 'ld_ns_bmp_2_uses', null),
					Array('NS-BMP2 Inspection Schedule', 'ld_ns_bmp_2_insp_sche', 'textarea', 1000, 'ld_ns_bmp_2_insp_sche', null),
					Array('NS-BMP2 Maintenance', 'ld_ns_bmp_2_maint', 'textarea', 1000, 'ld_ns_bmp_2_maint', null),
					Array('NS-BMP2 Installation Schedule', 'ld_ns_bmp_2_inst_sche', 'textarea', 1000, 'ld_ns_bmp_2_inst_sche', null),
					Array('NS-BMP3', 'ld_ns_bmp_3', 'drop-down', 250, 'ld_ns_bmp_3', 
						Array(
							'table_name'				=>	'bmps',
							'ld_ns_bmp_3'				=>	'BMP',
							'ld_ns_bmp_3_desc'		=>	'Description',
							'ld_ns_bmp_3_uses'		=>	'Uses',
							'ld_ns_bmp_3_insp_sche'	=>	'[Inspection Schedule]',
							'ld_ns_bmp_3_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP3 Description', 'ld_ns_bmp_3_desc', 'textarea', 1000, 'ld_ns_bmp_3_desc', null),
					Array('NS-BMP3 Uses', 'ld_ns_bmp_3_uses', 'textarea', 1000, 'ld_ns_bmp_3_uses', null),
					Array('NS-BMP3 Inspection Schedule', 'ld_ns_bmp_3_insp_sche', 'textarea', 1000, 'ld_ns_bmp_3_insp_sche', null),
					Array('NS-BMP3 Maintenance', 'ld_ns_bmp_3_maint', 'textarea', 1000, 'ld_ns_bmp_3_maint', null),
					Array('NS-BMP3 Installation Schedule', 'ld_ns_bmp_3_inst_sche', 'textarea', 1000, 'ld_ns_bmp_3_inst_sche', null),
					Array('NS-BMP4', 'ld_ns_bmp_4', 'drop-down', 250, 'ld_ns_bmp_4', 
						Array(
							'table_name'				=>	'bmps',
							'ld_ns_bmp_4'				=>	'BMP',
							'ld_ns_bmp_4_desc'		=>	'Description',
							'ld_ns_bmp_4_uses'		=>	'Uses',
							'ld_ns_bmp_4_insp_sche'	=>	'[Inspection Schedule]',
							'ld_ns_bmp_4_maint'		=>	'maintenance'
						)
					),
					Array('NS-BMP4 Description', 'ld_ns_bmp_4_desc', 'textarea', 1000, 'ld_ns_bmp_4_desc', null),
					Array('NS-BMP4 Uses', 'ld_ns_bmp_4_uses', 'textarea', 1000, 'ld_ns_bmp_4_uses', null),
					Array('NS-BMP4 Inspection Schedule', 'ld_ns_bmp_4_insp_sche', 'textarea', 1000, 'ld_ns_bmp_4_insp_sche', null),
					Array('NS-BMP4 Maintenance', 'ld_ns_bmp_4_maint', 'textarea', 1000, 'ld_ns_bmp_4_maint', null),
					Array('NS-BMP4 Installation Schedule', 'ld_ns_bmp_4_inst_sche', 'textarea', 1000, 'ld_ns_bmp_4_inst_sche', null),
				),
				Array('Sedimentation pond', null, 'zone', 0,  null,
					Array('Yes/No', 'ld_sedi_pond', 'drop-down', 25, 'ld_sedi_pond', 'bool'),
					Array('Not feasible', 'ld_sedi_pond_feasible', 'textarea', 1000, 'ld_sedi_pond_feasible', null),
					Array('Design', 'ld_sedi_pond_design', 'textarea', 1000, 'ld_sedi_pond_design', null),
					Array('Construction', 'ld_sedi_pond_const', 'textarea', 1000, 'ld_sedi_pond_const', null),
					Array('Maintenance', 'ld_sedi_pond_maint', 'textarea', 1000, 'ld_sedi_pond_maint', null),
				),
			),
			Array('Project Responsibilities', null, 'zone', 0,  null, 
				Array('SWPPP Team', null, 'zone', 0,  null,
					Array('Team Member 1', 'ld_team_1_name', 'drop-down', 550, 'ld_team_1_name',
						Array(
							'table_name'			=>	'view_contacts',
							'ld_team_1_name'		=>	'contact_name',
							'ld_team_1_phone'		=>	'[Phone number]',
							'ld_team_1_email'		=>	'Email'
						)
					),
					Array('Team Member 1 Position', 'ld_team_1_position', 'text', 250, 'ld_team_1_position', null),
					Array('Team Member 1 Role', 'ld_team_1_role', 'text', 250, 'ld_team_1_role', null),
					Array('Team Member 1 Phone', 'ld_team_1_phone', 'phone', 25, 'ld_team_1_phone', null),
					Array('Team Member 1 Email', 'ld_team_1_email', 'email', 250, 'ld_team_1_email', null),
					Array('Team Member 2', 'ld_team_2_name', 'drop-down', 550, 'ld_team_2_name',
						Array(
							'table_name'			=>	'view_contacts',
							'ld_team_2_name'		=>	'contact_name',
							'ld_team_2_phone'		=>	'[Phone number]',
							'ld_team_2_email'		=>	'Email'
						)
					),
					Array('Team Member 2 Position', 'ld_team_2_position', 'text', 250, 'ld_team_2_position', null),
					Array('Team Member 2 Role', 'ld_team_2_role', 'text', 250, 'ld_team_2_role', null),
					Array('Team Member 2 Phone', 'ld_team_2_phone', 'phone', 25, 'ld_team_2_phone', null),
					Array('Team Member 2 Email', 'ld_team_2_email', 'email', 250, 'ld_team_2_email', null),
					Array('Team Member 3', 'ld_team_3_name', 'drop-down', 550, 'ld_team_3_name',
						Array(
							'table_name'			=>	'view_contacts',
							'ld_team_3_name'		=>	'contact_name',
							'ld_team_3_phone'		=>	'[Phone number]',
							'ld_team_3_email'		=>	'Email'
						)
					),
					Array('Team Member 3 Position', 'ld_team_3_position', 'text', 250, 'ld_team_3_position', null),
					Array('Team Member 3 Role', 'ld_team_3_role', 'text', 250, 'ld_team_3_role', null),
					Array('Team Member 3 Phone', 'ld_team_3_phone', 'phone', 25, 'ld_team_3_phone', null),
					Array('Team Member 3 Email', 'ld_team_3_email', 'email', 250, 'ld_team_3_email', null),
					Array('Team Member 4', 'ld_team_4_name', 'drop-down', 550, 'ld_team_4_name',
						Array(
							'table_name'			=>	'view_contacts',
							'ld_team_4_name'		=>	'contact_name',
							'ld_team_4_phone'		=>	'[Phone number]',
							'ld_team_4_email'		=>	'Email'
						)
					),
					Array('Team Member 4 Position', 'ld_team_4_position', 'text', 250, 'ld_team_4_position', null),
					Array('Team Member 4 Role', 'ld_team_4_role', 'text', 250, 'ld_team_4_role', null),
					Array('Team Member 4 Phone', 'ld_team_4_phone', 'phone', 25, 'ld_team_4_phone', null),
					Array('Team Member 4 Email', 'ld_team_4_email', 'email', 250, 'ld_team_4_email', null),
				),
				Array('Inspections', null, 'zone', 0,  null, 
					Array('Inspector 1 name', 'ld_insp_1_name', 'drop-down', 550, 'ld_insp_1_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'ld_insp_1_name'		=>	'contact_name',
							'ld_insp_1_company'	=>	'Company',
							'ld_insp_1_phone'		=>	'[Phone number]',
							'ld_insp_1_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 1 company', 'ld_insp_1_company', 'text', 250, 'ld_insp_1_company', null),
					Array('Inspector 1 phone', 'ld_insp_1_phone', 'text', 25, 'ld_insp_1_phone', null),
					Array('Inspector 1 qualifications', 'ld_insp_1_quals', 'text', 500, 'ld_insp_1_quals', null),
					Array('Inspector 2 name', 'ld_insp_2_name', 'drop-down', 550, 'ld_insp_2_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'ld_insp_2_name'		=>	'contact_name',
							'ld_insp_2_company'	=>	'Company',
							'ld_insp_2_phone'		=>	'[Phone number]',
							'ld_insp_2_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 2 company', 'ld_insp_2_company', 'text', 250, 'ld_insp_2_company', null),
					Array('Inspector 2 phone', 'ld_insp_2_phone', 'text', 25, 'ld_insp_2_phone', null),
					Array('Inspector 2 qualifications', 'ld_insp_2_quals', 'text', 500, 'ld_insp_2_quals', null),
					Array('Inspector 3 name', 'ld_insp_3_name', 'drop-down', 550, 'ld_insp_3_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'ld_insp_3_name'		=>	'contact_name',
							'ld_insp_3_company'	=>	'Company',
							'ld_insp_3_phone'		=>	'[Phone number]',
							'ld_insp_3_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 3 company', 'ld_insp_3_company', 'text', 250, 'ld_insp_3_company', null),
					Array('Inspector 3 phone', 'ld_insp_3_phone', 'text', 25, 'ld_insp_3_phone', null),
					Array('Inspector 3 qualifications', 'ld_insp_3_quals', 'text', 500, 'ld_insp_3_quals', null),
					Array('Inspector 4 name', 'ld_insp_4_name', 'drop-down', 550, 'ld_insp_4_name', 
						Array(
							'table_name'			=>	'view_contacts',
							'constraints'			=>	Array('inspector'	=> 1),
							'ld_insp_4_name'		=>	'contact_name',
							'ld_insp_4_company'	=>	'Company',
							'ld_insp_4_phone'		=>	'[Phone number]',
							'ld_insp_4_quals'		=>	'Qualifications'
						)
					),
					Array('Inspector 4 company', 'ld_insp_4_company', 'text', 250, 'ld_insp_4_company', null),
					Array('Inspector 4 phone', 'ld_insp_4_phone', 'text', 25, 'ld_insp_4_phone', null),
					Array('Inspector 4 qualifications', 'ld_insp_4_quals', 'text', 500, 'ld_insp_4_quals', null),
					Array('Inspection Schedule', 'ld_insp_sche', 'drop-down', 550, 'ld_insp_sche',
						Array(
							'table_name'		=>	'inspection_schedule',
							'ld_insp_sche'		=>	'is_short'
						)
					)
				),
				Array('Stabilization', null, 'zone', 0,  null, 
					Array('Stabilization description', 'ld_stab_desc', 'textarea', 1000, 'ld_stab_desc', null),
					Array('Stabilization dates', 'ld_stab_dates', 'textarea', 1000, 'ld_stab_dates', null),
					Array('Stabilization schedule', 'ld_stab_sche', 'textarea', 1000, 'ld_stab_sche', null),
					Array('Stabilization responsibility', 'ld_stab_resp', 'textarea', 1000, 'ld_stab_resp', null)
				)
			)
		);
