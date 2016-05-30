<?php

//Array(Display Name, Input Name, Type, db Field, Options, Options, Option, etc)

$swppp = Array(
			Array('id', 'proj_id', 'hidden', 10, 'proj_id', null),
			Array('Last Modified', 'proj_last_modified', 'modified', 10, 'proj_last_modified', null),
			Array('Project Information', null, 'zone', 0,  null, 
				Array('Project', null, 'zone', 0,  null,
					Array('Project Name', 'proj_name', 'text', 250, 'proj_name', null),
					Array('Latitude', 'proj_latitude', 'text', 50, 'proj_latitude', null),
					Array('Longitude', 'proj_longitude', 'text', 50, 'proj_longitude', null),
					Array('Location (city)', 'proj_city', 'text', 50, 'proj_city', null),
					Array('State', 'proj_state', 'text', 50, 'proj_state', null),
					Array('Zip', 'proj_zip', 'text', 50, 'proj_zip', null),
					Array('County', 'proj_county', 'text', 50, 'proj_county', null),
					Array('Directions', 'proj_directions', 'text', 50, 'proj_directions', null),
					Array('Nearest City', 'proj_nearest_city', 'text', 50, 'proj_nearest_city', null),
					Array('Local Official MS4', 'proj_local_official_ms4', 'drop-down', 50, 'proj_local_official_ms4',
						array(
							'table_name'					=> 'companies',
							'proj_local_official_ms4'		=> '[Legal Company Name]',
							'proj_local_official_address'	=>	'Address',
							'proj_local_official_city'		=>	'City',
							'proj_local_official_state'		=>	'State',
							'proj_local_official_contact'	=>	array(
									'table_name'				=> 'view_contacts',
									'constraints'				=> array('Company' => 'proj_local_official_ms4'),
									'proj_local_official_contact' => 'contact_name'
									
								)
						)
					),
					Array('Local Official Address', 'proj_local_official_address', 'text', 50, 'proj_local_official_address', null),
					Array('Local Official City', 'proj_local_official_city', 'text', 50, 'proj_local_official_city', null),
					Array('Local Official State', 'proj_local_official_state', 'text', 50, 'proj_local_official_state', null),
					Array('Local Official Zip', 'proj_local_official_zip', 'text', 50, 'proj_local_official_zip', null),
					Array('Local Official Contact', 'proj_local_official_contact', 'drop-down', 50, 'proj_local_official_contact', 
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'proj_local_official_ms4'),
							'proj_local_official_contact'			=>	'contact_name',
						)
					),
				),
				Array('Mailing Address', null, 'zone', 0,  null,
					Array('Street Number', 'proj_street_address', 'text', '25', 'proj_street_address', null),
					Array('Street Name', 'proj_street_name', 'text', '25', 'proj_street_name', null),
				),
			),
			Array('Engineer\'s Information', null, 'zone', 0,  null, 
				Array('Engineer company', null, 'zone', 0,  null,
					Array('Company Name', 'proj_engi_company_name', 'drop-down', 100, 'proj_engi_company_name',
						Array(
							'table_name'							=>	'companies',
							'proj_engi_company_name'				=>	'[Legal Company Name]',
							'proj_engi_company_address'				=>	'Address',
							'proj_engi_company_city'				=>	'City',
							'proj_engi_company_state'				=>	'State',
							'proj_engi_company_zip'					=>	'Zip',
							'proj_engi_company_contact'				=>	Array(
																			'table_name' => 'view_contacts',
																			'constraints' => Array("Company" => "proj_engi_company_name"),
																			'proj_engi_company_contact' => 'contact_name'
																		),
						)
					),
					Array('Address', 'proj_engi_company_address', 'text', 250, 'proj_engi_company_address', null),
					Array('City', 'proj_engi_company_city', 'text', 100, 'proj_engi_company_city', null),
					Array('State', 'proj_engi_company_state', 'text', 100, 'proj_engi_company_state', null),
					Array('Zip', 'proj_engi_company_zip', 'num', 25, 'proj_engi_company_zip', null),
					Array('Contact', 'proj_engi_company_contact', 'drop-down', 250, 'proj_engi_company_contact',  
						Array(
							'table_name'							=>	'view_contacts',
							'constraints'							=>	Array("[Company]" => 'proj_engi_company_name'),
							'proj_engi_company_contact'				=>	'contact_name',
							'proj_engi_company_contact_phone'		=>	'Phone number',
							'proj_engi_company_contact_email'		=>	'Email',
							'proj_engi_company_contact_fax'			=>	'Fax',
						)
					),
					Array('Contact phone', 'proj_engi_company_contact_phone', 'phone', 25, 'proj_engi_company_contact_phone', null),
					Array('Contact email', 'proj_engi_company_contact_email', 'email', 250, 'proj_engi_company_contact_email', null),
					Array('Contact fax', 'proj_engi_company_contact_fax', 'text', 25, 'proj_engi_company_contact_fax', null),
				),
			),
			Array('SWPPP Preparer', null, 'zone', 0,  null,
				Array('Company', null, 'zone', 0,  null,
					Array('Company Name', 'proj_swppp_prep_company_name', 'drop-down', 100, 'proj_swppp_prep_company_name',
						Array(
							'table_name'								=>	'companies',
							'proj_swppp_prep_company_name'				=>	'[Legal Company Name]',
							'proj_swppp_prep_company_address'			=>	'Address',
							'proj_swppp_prep_company_city'				=>	'City',
							'proj_swppp_prep_company_state'				=>	'State',
							'proj_swppp_prep_company_zip'				=>	'Zip',
							'proj_swppp_prep_company_phone'				=>	'[Phone number]',
							'proj_swppp_prep_company_contact'			=>	array(
																			'table_name' => 'view_contacts',
																			'constraints' => array("Company" => "proj_swppp_prep_company_name"),
																			'proj_swppp_prep_company_contact' => 'contact_name'
																		),
						)
					),
					Array('Address', 'proj_swppp_prep_company_address', 'text', 250, 'proj_swppp_prep_company_address', null),
					Array('City', 'proj_swppp_prep_company_city', 'text', 100, 'proj_swppp_prep_company_city', null),
					Array('State', 'proj_swppp_prep_company_state', 'text', 100, 'proj_swppp_prep_company_state', null),
					Array('Zip', 'proj_swppp_prep_company_zip', 'num', 25, 'proj_swppp_prep_company_zip', null),
				),
				Array('Contact', null, 'zone', 0,  null,
					Array('Name', 'proj_swppp_prep_company_contact', 'drop-down', 250, 'proj_swppp_prep_company_contact',  
						Array(
							'table_name'								=>	'view_contacts',
							'constraints'								=>	Array("[Company]" => 'proj_swppp_prep_company_name'),
							'proj_swppp_prep_company_contact'			=>	'contact_name',
							'proj_swppp_prep_company_contact_phone'		=>	'Phone number',
							'proj_swppp_prep_company_contact_email'		=>	'Email',
							'proj_swppp_prep_company_contact_fax'		=>	'Fax',
						)
					),
					Array('Phone', 'proj_swppp_prep_company_contact_phone', 'phone', 25, 'proj_swppp_prep_company_contact_phone', null),
					Array('Email', 'proj_swppp_prep_company_contact_email', 'email', 250, 'proj_swppp_prep_company_contact_email', null),
				),
			),
			Array('Project Research', null, 'zone', 0,  null, 
				Array('Water', null, 'zone', 0,  null,
					Array('Edwards Aquifer', 						'proj_edwards_aquifer', 'drop-down', 100, 'proj_edwards_aquifer', 
						array(
							'table_name'	=>	'edwards_aquifer',
							'proj_edwards_aquifer'	=> 'ea_type'
						)
					),
					Array('Water Features surrounding project', 	'proj_water_features', 'text', 1000, 'proj_water_features', null),
					Array('Receiving Waters', 						'proj_receiving_waters', 'text', 1000, 'proj_receiving_waters', null),
					Array('8 Digit HUC #', 							'proj_8_digit_huc', 'text', 100, 'proj_8_digit_huc', null),
					Array('303 d Seg ID #', 						'proj_303d_seg_id', 'text', 100, 'proj_303d_seg_id', null),
					Array('Constituent 1', 							'proj_constituent_1', 'text', 100, 'proj_constituent_1', null),
					Array('Constituent 1 CO Area', 					'proj_constituent_1_co_area', 'text', 100, 'proj_constituent_1_co_area', null),
					Array('Constituent 1 TMDL', 					'proj_constituent_1_tmdl', 'text', 100, 'proj_constituent_1_tmdl', null),
					Array('Constituent 2', 							'proj_constituent_2', 'text', 100, 'proj_constituent_2', null),
					Array('Constituent 2 CO Area', 					'proj_constituent_2_co_area', 'text', 100, 'proj_constituent_2_co_area', null),
					Array('Constituent 2 TMDL', 					'proj_constituent_2_tmdl', 'text', 100, 'proj_constituent_2_tmdl', null),
					Array('Constituent 3', 							'proj_constituent_3', 'text', 100, 'proj_constituent_3', null),
					Array('Constituent 3 CO Area', 					'proj_constituent_3_co_area', 'text', 100, 'proj_constituent_3_co_area', null),
					Array('Constituent 3 TMDL', 					'proj_constituent_3_tmdl', 'text', 100, 'proj_constituent_3_tmdl', null),
					Array('303 d Listed EPA', 						'proj_303d_listed_epa', 'text', 100, 'proj_303d_listed_epa', null),
					Array('303 d Listed TCEQ', 						'proj_303d_listed_tceq', 'text', 100, 'proj_303d_listed_tceq', null),
					Array('Impaired Waters List', 					'proj_impaired_waters_list', 'text', 1000, 'proj_impaired_waters_list', null),
				),
				Array('Endangered Species', null, 'zone', 0,  null,
					Array('Website for ES research', 'proj_es_website', 'url', 250, 'proj_es_website', null),
					Array('County', 'proj_es_county', 'drop-down', 100, 'proj_es_county',
						array(
							'table_name'		=>	'endangered_species',
							'proj_es_county'	=>	'es_county'
						)
					)
				),
				Array('Indian Lands', null, 'zone', 0,  null,
					Array('Indian Lands', 'proj_indian_lands', 'drop-down', 10, 'proj_indian_lands', 'bool'),
				),
			)
		);
