<?php

require_once("includes/core.php");
require_once("includes/functions.php");
require_once("includes/data_map.php");

class SWPPP
{
    
    public  $id = 0;
    public  $table_name;
    public  $data_set;
    public  $prefix;
    private $javascript		= array();
    public  $columns		= array();
    private $html			= "";
    private $title			= "";
    public  $messages		= "";
	private $menu			= array();
    private $row_div		= "\t<div class=\"data_row\">";
    private $label_div		= "\t\t<div class=\"column_label\">";
    private $data_div		= "\t\t<div class=\"column_data\">";
    private $close_div		= "</div>";
    
    //CONSTRUCTOR FUNCTIONS
    public function __construct($id, $table_name, $prefix, $title)
    {
        debug("BEGIN swppp.class.php->construct()");
        
        $this->id         = $id;
        $this->table_name = $table_name;
        $this->prefix     = $prefix;
        $this->title      = $title;
        $this->data_set   = $this->getPageData();
        
        //Start parsing the page
        $this->parsePage();
        debug("END swppp.class.php->construct()");
    }
    
    public function getPageData()
    {
        
        global $sys;
        
        debug("swppp.class.php->getPageData(): " . $this->id);
        
        $query = $sys->db()->prepare("SELECT * FROM " . $this->table_name . " WHERE " . $this->prefix . "id = :id");
		
        $query->bindParam(":id", $this->id);
		
        $query->execute();
		
		$result = $query->fetchAll();
		
        if ($query->rowCount() > 0) {
            return $result[0];
        } else {
			$sys->page->action = "add";
            return $this->getEmptyArray();
        }
    }
    
    
    public function setTitle($string)
    {
        $this->title = $string;
    }
	
	public function setData(array $array) {
		$this->data_set = $array;
	}
    
    //ACTION/DATA FUNCTIONS
    
    public function delete()
    {
        
        global $sys;
        
        debug("swppp.class.php->delete(): " . $this->id);
        
        $stmt = $sys->db()->prepare("DELETE FROM [dbo].[" . $this->table_name . "] WHERE " . $this->prefix . "id = :id;");
        
        $stmt->bindParam(":id", $this->id);
        
        $stmt->execute();
        
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
        $sql .= $this->prefix . "id, ";
        $sql .= $this->prefix . "last_modified, ";
        
        //Set up some manual data
        $binds[":" . $this->prefix . "id"]            = $this->id;
        $binds[":" . $this->prefix . "last_modified"] = time();
        
        //Build column list for insert
        foreach ($this->columns as $item) {
            $sql .= "[" . $item[2] . "], ";
        }
        
        $sql = substr($sql, 0, -2);
        
        $sql .= ") VALUES (";
        
        //More of that manual stuff
        $sql .= ":" . $this->prefix . "id, ";
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
        
		$this->data_set[$this->prefix . "id"] = $this->id;
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
    
    //PAGE CONTENT FUNCTIONS
    public function flushJavascript()
    {
        echo "<script language=\"javascript\" type=\"text/javascript\">\n";
        echo "\n\tdata = " . json_encode($this->javascript) . "\n\n";
		echo "\n\tprefix = \"" . $this->prefix . "\"";
        echo "</script>";
        
    }
    
    public function displayPage()
    {
        debug("swppp.class.php->displayPage()");
        echo $this->html;
    }
    
    public function getTitle()
    {
        echo $this->title;
    }
    
    public function getMessages()
    {
        echo "<h3 align=center>" . $this->messages . "</h3>";
    }
    
    public function actionLinks()
    {
        
        global $sys;
        
        if ($sys->page->action != "view" && $sys->page->action != "add") {
            echo "<a href=\"?page=" . $sys->page->page . "&action=view&id=" . $sys->page->id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
        }
        if ($sys->page->action != "edit" && $sys->page->action != "add") {
            echo "<a href=\"?page=" . $sys->page->page . "&action=edit&id=" . $sys->page->id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
        }
        if ($sys->page->action != "delete" && $sys->page->action != "add") {
            echo "<a href=\"?page=" . $sys->page->page . "&action=delete&id=" . $sys->page->id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
        }
		if ($sys->page->action == "add") {
			echo "<div style=\"height: 26px; display: block;\"></div>";
		}
        
    }
    
    public function createForm()
    {
        global $sys;
        
        if ($sys->page->action == "edit" || $sys->page->action == "add") {
            //If there are no results, this is an add, not an edit.
            $submit_action = ($sys->page->id > 0) ? $sys->page->action : "add";
            
            echo "<form action=\"?page=" . $sys->page->page . "&action=" . $submit_action . "&id=" . $sys->page->id . "\" method=\"post\">";
        }
    }
	
	public function getProjectTitle() {
	
		global $sys;
		
		if ($this->id == 0) {
		  return "New";
		}
		
		$stmt = $sys->db()->prepare("SELECT proj_name FROM [dbo].[projects] WHERE proj_id = :proj_id;");
		$stmt->bindParam(":proj_id", $this->id);
		
		$stmt->execute();
		
		$results = $stmt->fetchAll();
		
		return $results[0]['proj_name'];
	
	}
	
	public function getMenuLinks() {
		echo "<select id=\"swppp-menu\">\n";
		foreach ($this->menu as $item) {
			echo "<option value=\"#" . $item[1] . "\">" . $item[0] . "</option>";
		}
		echo "</select>";
	}
    
    //PARSING PAGE DATA FUNCTIONS
    
    public function parsePage()
    {
        debug("BEGIN swppp.class.php->parsePage()");
        
        //Variable of the config array in *.config.php
        global $swppp;
        
        //Clear out HTML buffer
        $this->html = "";
		
        //Parse HTML
        $this->parseData($swppp);
        
        debug("END swppp.class.php->parsePage()");
    }
    
    private function parseData(array $obj, $level = 1)
    {
        debug("swppp.class.php->parseData(): " . $level);
        foreach ($obj as $key => $data) {
            if (is_array($data)) {
                if ($data[2] == 'zone') {
                    $this->parseZone($data, $level);
                } else {
                    $this->parseField($data);
                }
            }
        }
    }
    
    private function parseZone(array $data, $level)
    {
        
		array_push($this->menu, array(str_repeat('-', $level) . ' ' . $data[0], strtolower(str_replace(" ", "", $data[0]))));
		
        $this->html .= $this->row_div;
        $this->html .= "<div class=\"level-" . $level . "\" style=\"display: table-cell\">";
        $this->html .= "<a name=\"" . strtolower(str_replace(" ", "", $data[0])) . "\">" . $data[0] . "</a>";
        $this->html .= $this->close_div;
        $this->html .= "<div class=\"level-" . $level . "\" style=\"display: table-cell\">&nbsp;</div>";
        $this->html .= $this->close_div;
		
        $this->parseData($data, 2);
		
	}
    
    private function parseField(array $data)
    {
        switch ($data[2]) {
            case 'textarea':
                $this->createTextArea($data);
                break;
            case 'drop-down':
                $this->createDropDown($data);
                break;
            case 'hidden':
                $this->createHiddenField($data);
                break;
            case 'modified':
                $this->createLastModified($data);
                break;
            case 'email':
				$this->createEmailField($data);
				break;
			case 'url':
				$this->createURLField($data);
				break;
			case 'checkbox':
				$this->createCheckbox($data);
				break;
            case 'text':
            case 'phone':
            case 'num':
            default:
                $this->createTextField($data);
        }
    }
    
    private function createTextField(array $data)
    {
        
        global $sys;
        
        $this->html .= $this->row_div . "\n";
        
        switch ($sys->page->action) {
            case "add":
            case "edit":
                $this->getLabel($data);
                $this->html .= $this->data_div . "<input class=\"edit\" type=\"text\" maxlength=\"" . $data[3] . "\" value=\"" . htmlspecialchars($this->data_set[$data[4]]) . "\" name=\"" . $data[1] . "\"></input>" . $this->close_div . "\n";
                break;
            case "view":
            default:
                $this->getLabel($data);
                $this->html .= $this->data_div . htmlspecialchars($this->data_set[$data[4]]) . $this->close_div . "\n";
        }
        
        $this->html .= "\t" . $this->close_div . "\n";
    }
	
	private function createURLField(array $data)
	{
        
        global $sys;
                //If this is just a "view" page, then we don't really actually need a drop-down
        if ($sys->page->action == "add" || $sys->page->action == "edit") {
            //Send it over to a function we already have for this job
            $this->createTextField($data);
            //If we do need a drop down, because it's an edit/add page, then
        } else {

        	$this->html .= $this->row_div . "\n";
			$this->getLabel($data);
			$this->html .= $this->data_div . "<a href=\"" . htmlspecialchars($this->data_set[$data[4]]) . "\" target=\"_blank\">" . htmlspecialchars($this->data_set[$data[4]]) . "</a>" . $this->close_div . "\n";
        	$this->html .= "\t" . $this->close_div . "\n";
		}
    }
	
	private function createEmailField(array $data)
    {
        
        global $sys;
                //If this is just a "view" page, then we don't really actually need a drop-down
        if ($sys->page->action == "add" || $sys->page->action == "edit") {
            //Send it over to a function we already have for this job
            $this->createTextField($data);
            //If we do need a drop down, because it's an edit/add page, then
        } else {

        	$this->html .= $this->row_div . "\n";
			$this->getLabel($data);
			$this->html .= $this->data_div . "<a href=\"mailto:" . htmlspecialchars($this->data_set[$data[4]]) . "\">" . htmlspecialchars($this->data_set[$data[4]]) . "</a>" . $this->close_div . "\n";
      		$this->html .= "\t" . $this->close_div . "\n";
		}
    }
    
    private function createTextArea(array $data)
    {
        
        global $sys;
		
        //If this is just a "view" page, then we don't really actually need a drop-down
        if ($sys->page->action != "add" && $sys->page->action != "edit") {
            //Send it over to a function we already have for this job
            $this->createTextField($data);
            //If we do need a drop down, because it's an edit/add page, then
        } else {
            $this->html .= $this->row_div . "\n";
            $this->getLabel($data);
            $this->html .= $this->data_div . "<textarea class=\"edit\" rows=\"4\" cols=\"50\" maxlength=\"" . $data[3] . "\" name=\"" . $data[1] . "\">" . htmlspecialchars($this->data_set[$data[4]]) . "</textarea>" . $this->close_div . "\n";
            $this->html .= "\t" . $this->close_div . "\n";
        }
    }
    
    private function createDropDown(array $data)
    {
        
        global $sys;
        
        //If this is just a "view" page, then we don't really actually need a drop-down
        if ($sys->page->action != "add" && $sys->page->action != "edit") {
            //Send it over to a function we already have for this job
            $this->createTextField($data);
            //If we do need a drop down, because it's an edit/add page, then
        } else {
            
            if (is_array($data[5])) {
                $this->parseConstraints($data);
            }
            
            $this->html .= $this->row_div . "\n";
            $this->getLabel($data);
            $this->html .= $this->data_div . "<select class=\"edit\" name=\"" . $data[1] . "\" value=\"" . htmlspecialchars($this->data_set[$data[4]]) . "\">";
            if ($data[5] == 'bool') {
				$yes = ($this->data_set[$data[4]] == "Yes") ? 'SELECTED' : NULL;
				$no = ($this->data_set[$data[4]] == "No") ? 'SELECTED' : NULL;
                $this->html .= "<option value=\"\">Select One</option>";
                $this->html .= "<option value=\"Yes\"" . $yes . ">Yes</option>";
                $this->html .= "<option value=\"No\"" . $no . ">No</option>";
            } else {
                $this->html .= "<option value=\"\">Select One</option>";
            }
            $this->html .= "</select>" . $this->close_div . "\n";
            $this->html .= "\t" . $this->close_div . "\n";
        }
    }
    
    private function getLabel(array $data)
    {
        $this->html .= $this->label_div . ucwords($data[0]) . $this->close_div . "\n";
    }
    
    private function parseConstraints(array $data)
    {
        //This function figures out what the first field that isn't the table name or constraints is in this array
        $drop_down_select = $this->getDropDownField($data[5]);
        
        $this->javascript[$drop_down_select] = array(
            $data[5]
        );
        
    }
    
    //Get the first data field from an array where the key names are not static (table_name, constraints)
    private function getDropDownField(array $data)
    {
        //This will either break on the return or when we run out of data
        while (current($data)) {
            switch (key($data)) {
                case "table_name":
                case "constraints":
                    next($data);
                    break;
                default:
                    return key($data);
            }
        }
    }
    
    private function createHiddenField(array $data)
    {
        $this->html .= "<input type=\"hidden\" value=\"" . $this->data_set[$data[4]] . "\" maxlength=\"" . $data[3] . "\" name=\"" . $data[1] . "\"></input>\n";
    }
    
    private function createLastModified(array $data)
    {
        
        global $sys;
        
        //If this is an add screen, then there won't be a last modified
        
        switch ($sys->page->action) {
            case "view":
                $this->html .= $this->row_div . "\n";
                $this->getLabel($data);
                
                if (is_numeric($this->data_set[$data[4]])) {
                    $this->html .= $this->data_div . date('Y-m-d @ g:m:s A T', $this->data_set[$data[4]]) . $this->close_div . "\n";
                } else {
                    $this->html .= $this->data_div . "New" . $this->close_div . "\n";
                }
                
                $this->html .= "\t" . $this->close_div . "\n";
                break;
            default:
        }
        
    }
	
    private function createCheckBox(array $data)
    {
        
        global $sys;
        
        $this->html .= $this->row_div . "\n";
        
        switch ($sys->page->action) {
            case "add":
            case "edit":
                $this->getLabel($data);
				$checked = ($this->data_set[$data[4]] == "1") ? "CHECKED" : "";
                $this->html .= $this->data_div . "<input class=\"edit\" style=\"width: auto;\"  type=\"checkbox\" maxlength=\"" . $data[3] . "\" " . $checked . " name=\"" . $data[1] . "\"></input>" . $this->close_div . "\n";
                break;
            case "view":
            default:
                $this->getLabel($data);
                $this->html .= $this->data_div;
				$this->html .= ($this->data_set[$data[4]] == "1") ? "Yes" : "No";
				$this->html .= $this->close_div . "\n";
        }
        
        $this->html .= "\t" . $this->close_div . "\n";
        
    }
    
    public function parseColumns(array $data)
    {
		foreach ($data as $key => $item) {
			if (is_array($item) && $item[1] != NULL && $item[4] != NULL && $item[2] != "hidden" && $item[2] != "modified") {
				array_push($this->columns, array(
					$item[0],
					$item[1],
					$item[4]
				));
			}
			if ($item[2] == "zone") {
				$this->parseColumns($item);
			}
		}
		
    }
	
	private function getEmptyArray() {
		
		global $swppp;
		
		$array = array();
		
		$this->columns = array();
        $this->parseColumns($swppp);
        
        //Update the $this->data_set for each column
        foreach ($this->columns as $item) {
            $array[$item[2]] = NULL;
        }
		
		$array[$this->prefix . "id"] = NULL;
		$array[$this->prefix . "ID"] = NULL;
		$array[$this->prefix . "last_modified"] = NULL;
		
		return $array;
	}
    
}