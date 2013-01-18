<?php
require_once('Connections/projector.php');
require_once('Globals.php');
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

$colname_UnitList = "-1";
if (isset($_GET['CourseId'])) {
  $colname_UnitList = $_GET['CourseId'];
}
mysql_select_db($database_projector, $projector);
$query_UnitList = sprintf("SELECT * FROM Units WHERE CourseId = %s ORDER BY SortOrder ASC", GetSQLValueString($colname_UnitList, "int"));
$UnitList = mysql_query($query_UnitList, $projector) or die(mysql_error());
$row_UnitList = mysql_fetch_assoc($UnitList);
$totalRows_UnitList = mysql_num_rows($UnitList);
$itemNum = 0;
if ($totalRows_UnitList > 0) {
	do {
	 echo "<div ";
	 if ($itemNum == 0) echo 'class="item active"'; else echo 'class="item"'; 
	 echo ">\n";
	 echo '<div class="item-inner">' . "\n\t";
   echo '<div class="unit-carousel-caption">' . "\n\t";
	 echo '<p>' . $row_UnitList['Name'] . "</p>\n\t\t";
   echo '<p class="browserUnitTitle">' . $row_UnitList['Title'] . "</p>\n\t";                 
   echo "</div>\n";                    
   echo '<div class="unit-carousel-content">' . "\n";
	 echo "<p>" .  $row_UnitList['Description'] . "</p>\n";
	 echo '<div class="pagination-centered">' . "\n";
   echo '<a href="CC_EpisodeBrowser.php" class="btn btn-large btn-primary cc-start-btn transition" >START</a>' . "\n";                     
   echo "</div>\n"; 
	 echo "</div>\n"; 
	 echo "</div>\n";
	 echo "</div>\n";                 
	 $itemNum++; 
	} while ($row_UnitList = mysql_fetch_assoc($UnitList));
}

mysql_free_result($UnitList);
?>