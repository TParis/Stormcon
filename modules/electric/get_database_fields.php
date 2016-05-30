<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("electric.config.php");
$i=0;
function getdata($data) {
		if ($data[2] != "zone") {
			echo $data[1] . "," . $data[4] . "\n";
		}
		
		$arrChild = array_slice($data, 4);
		if ($data[2] != "drop-down") {
			foreach ($arrChild as $item) {
					if (is_array($item)) {
						getdata($item);
					}
			}
		}
}

foreach ($swppp as $item) {
	getdata($item);
}