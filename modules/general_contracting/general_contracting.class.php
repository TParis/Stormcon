<?php

require_once("includes/functions.php");
require_once("modules/swppp/swppp.class.php");
require_once("modules/general_contracting/general_contracting.config.php");

class GENCONTRACTING extends SWPPP {

	public function __construct($id) {
		debug("BEGIN gc.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "gen_contracting";
		$this->prefix		= "gc_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("General Contracting");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END gc.class.php->__construct()");
	}
	
}