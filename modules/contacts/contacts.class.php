<?php

require_once("includes/functions.php");
require_once("modules/swppp/swppp.class.php");
require_once("modules/contacts/contacts.config.php");

class CONTACT extends SWPPP {

	public function __construct($id) {
		debug("BEGIN ld.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "contacts";
		$this->prefix		= "";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Contacts");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END contacts.class.php->__construct()");
	}
	
		public function insert(array $post_data)
    {
        
        global $sys;
		global $swppp;
		
        $binds = array();
        
		$this->columns = array();
        $this->parseColumns($swppp);
		
		$post_data['Inspector'] = (isset($post_data['Inspector']) && $post_data['Inspector'] == "on") ? 1 : 0;
		$post_data['noi_signer'] = (isset($post_data['noi_signer']) && $post_data['noi_signer'] == "on") ? 1 : 0;
        
        //Update the $this->data_set for each column
        foreach ($this->columns as $item) {
            $this->data_set[$item[2]] = $post_data[$item[1]];
        }
        
        $sql = "INSERT INTO " . $this->table_name . " (";
        
        //I want these to be inputted manually by me
        $sql .= $this->prefix . "last_modified, ";
        
        //Set up some manual data
        $binds[":" . $this->prefix . "last_modified"] = time();
        
        //Build column list for insert
        foreach ($this->columns as $item) {
            $sql .= "[" . $item[2] . "], ";
        }
        
        $sql = substr($sql, 0, -2);
        
        $sql .= ") VALUES (";
        
        //More of that manual stuff
        $sql .= ":" . $this->prefix . "last_modified, ";
		        
        //Build value list for PDO bindValues()
        foreach ($this->columns as $item) {
            $sql .= ":" . str_replace(" ", "_", $item[2]) . ", ";
            $binds[":" . str_replace(" ", "_", $item[2])] = $post_data[$item[1]];
        }
        
        $sql = substr($sql, 0, -2);
		
		$sql .= ");";
        
        $query = $sys->db()->prepare($sql);
		
		debug($sql);
        
        $result = $query->execute($binds);
        
        $this->messages .= "<font color=\"green\">Added Successfully</font><br>\n";
        
		$this->data_set[$this->prefix . "id"] = $sys->db()->lastInsertId();
		$this->id = $sys->db()->lastInsertId();
		$sys->page->id = $sys->db()->lastInsertId();
		$this->data_set[$this->prefix . "last_modified"] = time();
		
		$sys->page->action = "view";
		
        $this->parsePage();
    }
	
	public function update(array $post_data)
    {
        
        global $sys;
		global $swppp;
		
        $binds = array();
        
		$this->columns = array();
        $this->parseColumns($swppp);
		
		$post_data['Inspector'] = (isset($post_data['Inspector']) && $post_data['Inspector'] == "on") ? 1 : 0;
		$post_data['noi_signer'] = (isset($post_data['noi_signer']) && $post_data['noi_signer'] == "on") ? 1 : 0;
        
        //Update the $this->data_set for each column
        foreach ($this->columns as $item) {
            $this->data_set[$item[2]] = $post_data[$item[1]];
        }
		
        $sql = "UPDATE " . $this->table_name . " SET ";
        
        //I want these to be inputted manually by me
        $sql .= $this->prefix . "last_modified = :" . $this->prefix . "last_modified, ";
        
        //Set up some manual data
        $binds[":" . $this->prefix . "id"]            = $this->id;
        $binds[":" . $this->prefix . "last_modified"] = time();
        
        //Build column list for insert
        foreach ($this->columns as $item) {
            $sql .= "[" . $item[2] . "] = :" . str_replace(" ", "_", $item[2]) . ", ";
            $binds[":" . str_replace(" ", "_", $item[2])] = $post_data[$item[1]];
        }
        
        $sql = substr($sql, 0, -2);
        
        $sql .= " WHERE " . $this->prefix . "id = :" . $this->prefix . "id;";
        
        $query = $sys->db()->prepare($sql);
		
		debug($sql);
        
        $result = $query->execute($binds);
        
        $this->messages .= "<font color=\"green\">Updated Successfully</font><br>\n";
        
		$this->data_set[$this->prefix . "id"] = $this->id;
		$this->data_set[$this->prefix . "last_modified"] = time();
		
		$sys->page->action = "view";
		
        $this->parsePage();
    }
	
}