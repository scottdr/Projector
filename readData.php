<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Import Data</title>
<style type="text/css">
#main {
	padding : 5px;
	margin : 5px;
	background-color: #ffffff;
	float : left;
	margin-top:20px;
	min-height:200px;
	min-width:300px;
}

#filter {
	padding: 5px;
	border: thin solid #CCC;
	background-color:#eee;
	font-size:.8em;
	max-width:200px;
}

#sidePane {
	margin: 5px;
	float : left;
	
}

#instructions{
	font-size:.8em;
	margin-top:5px;
	max-width:250px;
}

.logo-primary {
	height : 66px;
	width : 290px;
	background-image: url(images/sulogo.png);
	background-repeat:no-repeat;
	float:left;
}

.nav-home {
	background-image: url(images/home.gif);
	background-repeat:no-repeat;
	float:right;
}

header {
/*padding: 5px; */
}

body {
	font-family: Verdana, Geneva, sans-serif;
	background-color: #f1f1ee;
}
.centered {
	text-align: center;
}

.clearFloat {
	clear : both;
}

</style>

<script type="text/javascript">
/*
function doAction(action) {
	console.log(location);
	window.location = "http://33.33.33.33/preakness/stumbleupon/readData.php?action=" + action; 
}*/
</script>
</head>

<body>
<header>
<img src="images/sulogo.png" width="213" height="48" alt="StumbleUpon" style="float:left"/>
<a href="index.html"><img src="images/home.gif" style="float:right" /></a>
<h2 class="clearFloat centered">Import Data</h2>
</header>
<div id="filter">
<form id="form1" name="form1" method="get" action="">  

  <table width="200" border="0" cellpadding="1" cellspacing="2">
   	<tr>
      <td>Action:</td>
      <td><select name="action" id="action" style="width:80px">
          <option value="create">Create</option>
          <option value="import" selected="selected">Import</option>
          <option value="delete">Delete</option>
          </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Do It" /></td>
    </tr>
	</table>
</form>
</div>
<p>Output:</p>
<div  id="main">

<?php 

	define('EXECUTE_SQL_STATEMENTS',true);		// for debugging turn this off to prevent execution of sql statements
	$uniqueId = 100;	// to be used for initial id in the siteViews table id column
	
	/* displays the last mysql error and an optional error message
	*
	* $errorMsg -> optional error messgae
	*/
	function showError($errorMsg = NULL)
	{
		if ($errorMsg)
			print "$errorMsg\n";
		die("Error " . mysql_errno() . " : " . mysql_error( ));
	}

	/* executeSqlStatements
	*
	* executes an array of sql statements
	*/
	function executeSqlStatements($sqlStatements) {
		
		print"SQL View STATEMENTS:\n</br>";
		foreach ($sqlStatements as $sqlStatement) {
			print "$sqlStatement\n</br>";
		}
		// create a connection to mysql
		if (! ($connection = @ mysql_connect("localhost","root")))
			die ("could not connect to mysql localhost");
		
		// select the stumbleupon database
		if (! (@mysql_select_db("projector",$connection)))
			showError("Could not select the stumbleupon database, make sure it exists");
			
		foreach ($sqlStatements as $sqlStatement) {
			if (EXECUTE_SQL_STATEMENTS) {
				if (!($result = @ mysql_query("$sqlStatement",$connection)))
					showError("mysql_query: $sqlStatement\n<br />" );
				print "result: $result\n";
			}
		} 
	}
	
	/* parses a comma separated value file and breaks it down into data to be inserted into siteViews table to track each person viewing a site and
	the tags table which for each siteView has entries for all the tags associated with that user 
	*/
	function importFile($filePath,$siteName) {
		global $uniqueId;
		print "Import Data from file: $filePath\n<br />";
		$fp = fopen($filePath,'r') or die("can't open file, $filePath");
		define('NUM_SITE_VIEW_COLS_TO_READ',5);		// number of columns of data to read from csv file to be inserted into siteViews table
		
		print '<table border="1">'."\n"; 
		print "<tr><td>id</td><td>name</td><td>subject</td><td>grade</td><td>duration</td><td>imgSrc</td><td>description</td></tr>\n";
		
		$columnNames = array('Project_id', 'Name', 'Subject', 'Grade', 'Duration', 'SrcImg', 'Description');
		$sqlStatements = array();
		$myFile = "sql/data.json";
		$jsonFile = fopen($myFile,'w') or die("\ncan't open file.txt: $php_errormsg");
		$jsonString = "{\"results\": [";
	
	  $numRows = 0;
		while ($csv_line = fgetcsv($fp)) {
			$sqlStatement = "INSERT INTO projectGallery SET $columnNames[0]=$uniqueId";
			print '<td>'.$uniqueId.'</td>'."\n";
			$jsonString .= "\n\t{\n\t\"id\" : \"$uniqueId\"";
			// read up to where the tags start, to create sql insert statements for the siteViews
			for ($i = 0; $i < (count($columnNames) - 1); $i++) {
				print '<td>'.$csv_line[$i].'</td>'."\n";
				
				$columnIndex = $i + 1;	// skip over the id we already added
	//			print ", $columnNames[$columnIndex]=$csv_line[$i]\n";
				$jsonString .= ", \"$columnNames[$columnIndex]\" : \"$csv_line[$i]\"";
				$sqlStatement .= ", $columnNames[$columnIndex]=\"$csv_line[$i]\"";
		
			}
			$jsonString .= "\n\t},";
			print $sqlStatement;	
			$uniqueId += 1;
			$numRows++;
			print "</tr>\n";
			$sqlStatements[] = $sqlStatement;
		} 
		$jsonString .= "\t]\n}";
		fwrite($jsonFile,$jsonString);
		fclose($jsonFile) or die("can't close file");
		print "</table>\n"; 
		print "</body>\n</html>\n";
		print "\n<br/>jsonString = $jsonString";
		fclose($fp) or die("can't close file");
		executeSqlStatements($sqlStatements);
	}
	
	/* For every file in the directory $dirPath look for a filename ending
	* in .csv and import all the ones we find
	*/
	function iterateThroughDirectory($dirPath) {
		print "$dirPath: " . $dirPath . "/n</br>";
		foreach (new DirectoryIterator($dirPath) as $file) {
			$filePathParts = explode('/',$file->getPathname());
			$fileName = $filePathParts[1];
			$fileParts = explode('.',$fileName);
			if ($fileParts[count($fileParts) - 1] == "csv") {
				$siteName = substr($fileName,0,count($fileName) - 5);
				print "Imported: " . $file->getPathname() . " siteName: " . $siteName . "\n<br />";
				importFile($file->getPathname(),$siteName);
			}
		}
	}
	
	/* deletes the two tables 'tags' and 'siteViews' if they exists
	*/
	function delete() {
		$sqlStatements = array();
		$sqlStatements[] = "DROP TABLE IF EXISTS tags";
		$sqlStatements[] = "DROP TABLE IF EXISTS siteViews";
		executeSqlStatements($sqlStatements);
	}

	/* Creates the database 'stumbleupon' and the two tables, 'tags' and 'siteViews'
	*/
	function create() {
		$sqlStatements = array();
		$sqlStatements[] = "CREATE DATABASE IF NOT EXISTS projector";
		$sqlStatements[] = "USE projector";
		$sqlStatements[] = "DROP TABLE IF EXISTS `projectGallery`";
		$sqlStatements[] = "CREATE TABLE IF NOT EXISTS `projectGallery` (
  `Project_id` int(11) NOT NULL AUTO_INCREMENT,
	`Name` varchar(255) NOT NULL,
  `Subject` varchar(255),
	`Grade` varchar(255),
	`Duration` varchar(255),
	`SrcImg` varchar(255),
	`Description` text,
   PRIMARY KEY (`Project_id`)
);";
		executeSqlStatements($sqlStatements);
	}
	
	
	// get action & data parameters passed on the url
	$action = @ $_GET["action"];
	if (isset($action))
		print "action = $action\n<br />";
	$importPath = "sql";
	print "data to import: $importPath\n<br />";
	print "path = " . $importPath;
	switch ($action) {
		case "import" :
			iterateThroughDirectory($importPath);
			break;
		case "create" :
			create(); 
			break;
	}
?>
</div>
</body>
</html>