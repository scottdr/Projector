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

mysql_select_db($database_projector, $projector);
$query_TopicsMenu = "SELECT Id, Name FROM Topics";
$TopicsMenu = mysql_query($query_TopicsMenu, $projector) or die(mysql_error());
$row_TopicsMenu = mysql_fetch_assoc($TopicsMenu);
$totalRows_TopicsMenu = mysql_num_rows($TopicsMenu);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label for="select"></label>
  <select name="select" id="select">
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['Id']?>"><?php echo $row_TopicsMenu['Name']?></option>
    <?php
} while ($row_TopicsMenu = mysql_fetch_assoc($TopicsMenu));
  $rows = mysql_num_rows($TopicsMenu);
  if($rows > 0) {
      mysql_data_seek($TopicsMenu, 0);
	  $row_TopicsMenu = mysql_fetch_assoc($TopicsMenu);
  }
?>
  </select>
</form>
</body>
</html>
<?php
mysql_free_result($TopicsMenu);
?>
