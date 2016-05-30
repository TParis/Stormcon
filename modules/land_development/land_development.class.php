<?php

require_once("includes/functions.php");
require_once("modules/swppp/swppp.class.php");
require_once("modules/land_development/land_development.config.php");

class LANDDEVELOPMENT extends SWPPP {

	public function __construct($id) {
		debug("BEGIN ld.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "land_development";
		$this->prefix		= "ld_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Land Development");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END ld.class.php->__construct()");
	}
	
}