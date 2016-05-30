<?php

require_once("includes/functions.php");
require_once("modules/projects/projects.config.php");
require_once("modules/swppp/swppp.class.php");

class PROJECTS extends SWPPP {

	public function __construct($id) {
		debug("BEGIN proj.class.php->__construct()");
		$this->id			= $id;
		$this->table_name	= "projects";
		$this->prefix		= "proj_";
		
		$this->setData($this->getPageData());
		
		$this->setTitle("Project");
		
		//Start parsing the page
		$this->parsePage();
		
		debug("END proj.class.php->__construct()");
	}
	
	public function insert(array $post_data)
    {
        
        global $sys;
		global $swppp;
		
        $binds = array();
        
		$this->columns = array();
        $this->parseColumns($swppp);
        
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
            $sql .= $item[2] . ", ";
        }
        
        $sql = substr($sql, 0, -2);
        
        $sql .= ") VALUES (";
        
        //More of that manual stuff
        $sql .= ":" . $this->prefix . "last_modified, ";
		        
        //Build value list for PDO bindValues()
        foreach ($this->columns as $item) {
            $sql .= ":" . $item[2] . ", ";
            $binds[":" . $item[2]] = $post_data[$item[1]];
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
	
	
    public function delete() {
		
        global $sys;
        
        debug("swppp.class.php->delete(): " . $this->id);
        
		//PROJECTS TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[projects] WHERE proj_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//BATCH PLANTS TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[batch_plants] WHERE bp_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//ELECTRIC TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[electric] WHERE elec_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//GAS TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[gas] WHERE gas_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//HOME BUILDING TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[home_building] WHERE hb_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//LAND DEVELOPMENT TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[land_development] WHERE ld_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
		//GEN CONTRACTING TABLE
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[gen_contracting] WHERE gc_id = :id;");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
	
	}
	
	public function getLatLong() {
		global $sys;
		
		if ($sys->page->action == "view" && $this->data_set['proj_latitude'] != "" && $this->data_set['proj_longitude'] != "") { 
			return $this->data_set['proj_latitude'] . ", " . $this->data_set['proj_longitude'];
		} else {
			return false;
		}
	}
	
}