<?php

require_once("includes/functions.php");
require_once("modules/gas/gas.config.php");
require_once("modules/swppp/swppp.class.php");

class GAS extends SWPPP {

	public function __construct($id) {
		debug("BEGIN gas.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "gas";
		$this->prefix		= "gas_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Gas");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END gas.class.php->__construct()");
	}
	
}