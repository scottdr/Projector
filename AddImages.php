<?php require_once('Connections/projector.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

function checkIfExists($imagePath,$projectId)
{
	global $database_projector, $projector;

	mysql_select_db($database_projector, $projector);
	$query_MediaQuery = sprintf("SELECT Url, Id FROM Media WHERE Url = %s", GetSQLValueString($imagePath, "text"));
	$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
	$row_MediaQuery = mysql_fetch_assoc($MediaQuery);
	$totalRows_MediaQuery = mysql_num_rows($MediaQuery);
	if (isset($MediaQuery))
		mysql_free_result($MediaQuery);
	if ($totalRows_MediaQuery > 0 ) {
		print "$imagePath already exists at Id $row_MediaQuery[Id] in the MEDIA table ignoring it.\n<br />";
		return false;
	} else {
		print "ADDING $imagePath to the MEDIA table for project# $projectId.\n<br />";
		return true;
	}
}

function addToMediaTable($projectId,$url)
{
		global $database_projector, $projector;
		
		$pattern = '/(\d+)x(\d+)\.jpg/';
		$addDimensions = false;
		if (preg_match($pattern, $url, $matches )) {
			print_r($matches);
			if (count($matches) > 2) {
				$width = $matches[1];
				$height = $matches[2];
				$addDimensions = true;
			}
		}
		$sqlCommand = sprintf("INSERT INTO Media SET ProjectId = %s, Type = 'Image', Url = %s",
			 								 GetSQLValueString($projectId, "int"),
                       GetSQLValueString($url, "text"));
		if ($addDimensions)
			$sqlCommand .= sprintf(", Width = %s, Height = %s",
			 								 GetSQLValueString($width, "text"),
                       GetSQLValueString($height, "text"));
		 mysql_select_db($database_projector, $projector);
  	$Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Images</title>
</head>
<?php 

	if (isset($_GET['folder'])) {
		print "get folder: " . $_GET['folder'];
		iterateThroughImages($_GET['folder'],$_GET['projectId']);
	} else {
		print "File Listing: \n<br />";
		iterateThroughProjects("_images/projects");
	}
	
	/* For every file in the directory $dirPath look for a filename ending
	* in .csv and import all the ones we find
	*/
	function iterateThroughProjects($dirPath) {
		foreach (new DirectoryIterator($dirPath) as $file) {
			$filePathParts = explode('/',$file->getPathname());
			$projectId = $filePathParts[count($filePathParts)-1];
			print 'Filename: <a href="AddImages.php?folder=' . $file->getPathname(). '">' . $file->getPathname() . "</a>";
			if (is_dir($file->getPathname() . "/challenge"))
				print '&nbsp;&nbsp;&nbsp;&nbsp;<a href="AddImages.php?folder=' . $file->getPathname() . '/challenge&projectId=' . $projectId . '">' . "Add Challenge Images " . $projectId . "</a>";
			print "\n<br />";
		}
	}
	
	function iterateThroughImages($dirPath,$projectId) {
		foreach (new DirectoryIterator($dirPath) as $file) {
	/*		$lastDirPos = strrpos($file->getPathname(),'/');
			$lastDirPos = strrpos($file->getPathname(),'/');
			$fileName = substr($file->getPathname(),$lastDirPos+1);
*/
			$filePathParts = explode('/',$file->getPathname());
			$fileName = $filePathParts[count($filePathParts) - 1];
			if (!isset($projectId))
				$projectId = $filePathParts[count($filePathParts) - 2];
			$fileParts = explode('.',$fileName);
			$fileExtension = $fileParts[count($fileParts) - 1];
			echo "File: <strong>$fileName</strong>, ProjectId: $projectId, Extension: $fileExtension\n<br />";
			switch ($fileExtension) { 
				case "jpg" : 
					if (checkIfExists($file->getPathname(),$projectId)) {
						addToMediaTable($projectId,$file->getPathname());
					};
			}
		}
	}
	
	
?>
</body>
</html>

