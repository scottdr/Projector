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

$projectId = "-1";
if (isset($_GET['ProjectId'])) {
	$projectId = $_GET['ProjectId'];
}

mysql_select_db($database_projector, $projector);
$query_AudioQuery = "SELECT * FROM Audio WHERE ProjectId = $projectId";
$AudioQuery = mysql_query($query_AudioQuery, $projector) or die(mysql_error());
$row_AudioQuery = mysql_fetch_assoc($AudioQuery);
$totalRows_AudioQuery = mysql_num_rows($AudioQuery);

mysql_select_db($database_projector, $projector);
$query_ProjectRecordset = sprintf("SELECT Name, Author FROM projects WHERE Id = %s", GetSQLValueString($projectId, "int"));
$ProjectRecordset = mysql_query($query_ProjectRecordset, $projector) or die(mysql_error());
$row_ProjectRecordset = mysql_fetch_assoc($ProjectRecordset);
$totalRows_ProjectRecordset = mysql_num_rows($ProjectRecordset);


mysql_select_db($database_projector, $projector);
$query_SlideRecordset = sprintf("SELECT * FROM Slides WHERE ProjectId = %s", GetSQLValueString($projectId, "int"));
$SlideRecordset = mysql_query($query_SlideRecordset, $projector) or die(mysql_error());
$row_SlideRecordset = mysql_fetch_assoc($SlideRecordset);
$totalRows_SlideRecordset = mysql_num_rows($SlideRecordset);

header('Content-Type: text/html; charset=utf-8');

if ($totalRows_AudioQuery > 0 && $totalRows_ProjectRecordset > 0) 

	print "{\n";
	print "\t" . '"id"' . "\t : $projectId,\n";
	print "\t" . '"title"' . "\t : \"". $row_ProjectRecordset['Name'] . '",' . "\n";
	print "\t" . '"author"' . "\t : \"By " . $row_ProjectRecordset['Author']. '",' . "\n";
	print "\t" . '"audioURLM4A"' . "\t : \"" . $row_AudioQuery['mp3Url']. '",' . "\n";
	print "\t" . '"audioURLOGG"' . "\t : \"" . $row_AudioQuery['oggUrl']. '",' . "\n";

if ($totalRows_SlideRecordset > 0) {
	print "\t\t" . '"slides":' . "\n";
  print "\t\t[\n";
	$prependComma = false;
	do {	
		$jsonData = array();
		$jsonData['id'] =  $row_SlideRecordset['Id'];
		$jsonData['layout'] = $row_SlideRecordset['TemplateName'];
		$jsonData['text'] = $row_SlideRecordset['Text'];
		
		$imageArray = array();
		mysql_select_db($database_projector, $projector);
		$query_SlideAttachRecordset = sprintf("SELECT Media.Url as url FROM SlideAttach, Media WHERE SlideId = %s AND Media.Id = MediaId", $jsonData['id']);
//		print "sql: $query_SlideAttachRecordset";
		$SlideAttachQuery = mysql_query($query_SlideAttachRecordset, $projector) or die(mysql_error());
		$row_SlideAttach = mysql_fetch_assoc($SlideAttachQuery);
		$totalRows_SlideAttach = mysql_num_rows($SlideAttachQuery);
//		print "num rows: $totalRows_SlideAttach";
		if ($totalRows_SlideAttach > 0) {
			do {
//				print_r($row_SlideAttach);
				array_push($imageArray,	$row_SlideAttach);
			} while($row_SlideAttach = mysql_fetch_assoc($SlideAttachQuery));
		}
		$jsonData['images'] = $imageArray;
		if ($prependComma) print ",\n";
			else $prependComma = true;
		echo json_encode($jsonData);
	} while ($row_SlideRecordset = mysql_fetch_assoc($SlideRecordset)); 
	print "\n\t\t]\n";
}
	print "}\n";
?>
<?php
mysql_free_result($AudioQuery);

mysql_free_result($ProjectRecordset);

mysql_free_result($SlideRecordset);
?>
