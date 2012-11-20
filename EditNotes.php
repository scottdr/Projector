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

$StepId = "-1";
if (isset($_GET['StepId'])) {
  $StepId = $_GET['StepId'];
}
mysql_select_db($database_projector, $projector);
$query_Recordset = sprintf("SELECT * FROM TeacherNotes WHERE StepId = %s", GetSQLValueString($StepId, "int"));
$Recordset = mysql_query($query_Recordset, $projector) or die(mysql_error());
$row_Recordset = mysql_fetch_assoc($Recordset);
$totalRows_Recordset = mysql_num_rows($Recordset);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// If there are no matching Details we will be adding a new record instead of editing.
if ($totalRows_Recordset == 0) {
	print "No Notes Exist, going to Add Notes";
	$action = "Add";
	$actionTitle = "Add";
} else {
	$StepId = $row_Recordset['StepId'];
	$action = "Update";
	$actionTitle = "Edit";
	if (isset($_GET["action"])) {
		$action = $_GET["action"];
		$actionTitle = $_GET["action"];
	}
}

if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
			$sqlCommand = sprintf("INSERT INTO TeacherNotes SET StepId = %s, Text = %s",
                       GetSQLValueString($_POST['StepId'], "int"),
											 GetSQLValueString($_POST['Notes'], "text"));
	} else
  	$sqlCommand = sprintf("UPDATE TeacherNotes SET StepId=%s, Text=%s WHERE Id=%s",
                       GetSQLValueString($_POST['StepId'], "int"),
											 GetSQLValueString($_POST['Notes'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

//	print "sqlCommand: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());
	
	// go to project details
  $updateGoTo = "EditNotes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
	$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	$updateGoTo .= "StepId=" . $StepId;
//	print "Goint to: " . $updateGoTo;
  header(sprintf("Location: %s", $updateGoTo));
} 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Teacher Notes</title>
<style type="text/css">
/* BeginOAWidget_Instance_2921536: #OAWidget */

.blueLayer {
	height: 300px;
	width: 300px;
}

.layer {
	font-family: Helvetica Neue, Helvetica, nimbus-sans, Arial, "Lucida Grande", sans-serif;
	background-color: #eee;
	margin-right: auto;
	margin-left: auto;
	padding: 15px;
	border-color : #666;
	border-style: solid;
	border-width: 3px;
	opacity : 1;
	-moz-border-radius : 10px;
	-webkit-border-radius : 10px;
	border-radius : 10px;
	width: 800px;
	-moz-box-shadow: 3px 3px 5px 6px #ccc;
	-webkit-box-shadow: 5px 5px 5px 6px #ccc;
	box-shadow: 3px 3px 5px 6px #ccc;
}

body {
	font-family: Helvetica Neue, Helvetica, nimbus-sans, Arial, "Lucida Grande", sans-serif;
}

label {
	float: left;
	text-align: right;
	margin-top: 5px;
	margin-bottom: 5px;
	margin-right: 15px;
	padding-top: 5px;
	font-size: 1.2em;
	width : 120px;
	color:#555;
}

.descriptionText {	
	margin-top: 5px;
	margin-bottom: 5px;
	font-size: 1em;
	margin-top: 5px;
	margin-bottom: 5px;
}

.wideLabel {
		width: 305px;
}

input
{
	font-size: 1.2em; 
	padding: 5px; 
	border: 1px solid #b9bdc1;  
	color: #444;	
	margin-top:5px;
	margin-bottom:5px;
}
	
input:focus{
	background-color:LightYellow;
	color : #222;	
}
	
textarea {
	font-size: 1em;
	padding: 5px;
	height: 110px;
	color: #444;
	border: 1px solid #b9bdc1;
	margin-top: 5px;
	margin-bottom: 5px;
	width: 550px;
}

select {
	font-size:1.2em;
	margin-top : 5px;
	margin-bottom: 5px;
	border: 1px solid #b9bdc1;  
	color: #444;		
}

legend {
	font-size: 1.5em;
	text-align:center;
	color : #222;
}
.hint{
	display:none;
}
	
.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 455px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}

.clearFloat {
	clear:both;
}

.verticalAlign {
	float : left;
}

.lineUp {
}

.imageDiv {
	margin-left: 10px;
	float: left;
}


		
/* EndOAWidget_Instance_2921536 */
.blueButton {
	background-color: #3AADEF;
	color:#FFF;
	padding-left:30px;
	padding-right:30px;
}

/* EndOAWidget_Instance_2921536 */


</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<!--<link href="css/formStyle.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

function updateThumbnailImage(object)
{
	var thumbnailURL = object.value;
	console.log('thumbnailURL: ' + thumbnailURL);	
	document.getElementById('thumbnailImage').src = thumbnailURL;
}

tinyMCE.init({
        mode : "exact",
				elements : "Notes",
				theme : "advanced",
					// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect",
				theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,charmap",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_resizing : true,
});
</script>
</head>

<body>
<?php include("HeaderNav.php") ?>
<div class="layer">
	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
  <fieldset>
    <legend><?php echo $actionTitle; ?> Teacher Notes</legend>
   <label for="Id">Id:</label>
      <input name="Id" type="text" id="Id" value="<?php echo $row_Recordset['Id']; ?>" size="5" readonly="readonly" />
    <div class="clearFloat"></div>
    <label for="StepId">StepId:</label>
    <input name="StepId" type="text" id="StepId" placeholder="Project Name" value="<?php echo $StepId; ?>" size="5" />
    <div class="clearFloat"></div>
    <label for="Notes">Notes:</label>
    <textarea name="Notes" id="Notes"><?php echo $row_Recordset['Text']; ?></textarea>
    <div class="clearFloat"></div>
  </fieldset>
  <div style="text-align:center">
    <input class="blueButton" type="submit" name="button" id="button" value="<?php echo $action; ?>" />
  </div>
  <input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
	</form>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset);
?>
