<?php

require_once("includes/functions.php");
require_once("modules/swppp/swppp.class.php");
require_once("modules/home_building/home_building.config.php");

class HOMEBUILDING extends SWPPP {

	public function __construct($id) {
		debug("BEGIN hb.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "home_building";
		$this->prefix		= "hb_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Home Building");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END hb.class.php->__construct()");
	}
	
}