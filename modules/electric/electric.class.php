<?php

require_once("includes/functions.php");
require_once("modules/electric/electric.config.php");
require_once("modules/swppp/swppp.class.php");

class ELECTRIC extends SWPPP {

	public function __construct($id) {
		debug("BEGIN electric.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "electric";
		$this->prefix		= "elec_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Electric");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END electric.class.php->__construct()");
	}
	
}