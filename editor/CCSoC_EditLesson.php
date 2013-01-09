<?php require_once('../Connections/projector.php'); ?>
<?php


class StepInfo {
	public $name, $title, $template, $routineId, $sortOrder;
	
	function __construct($routineId,$sortOrder,$name,$template) {
       $this->name = $name;
			 $this->routineId = $routineId;
			 $this->sortOrder = $sortOrder;
			 $this->template = $template;
	}
}

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// Default to performing an upate unless we posted a action on the url then use that
$action = "Update";
$actionTitle = "Edit";
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	$actionTitle = $_GET["action"];
}

/* We are either adding or editing a Project */
if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
		$sqlCommand = sprintf("INSERT INTO Projects (Name, Subject, GradeMin, GradeMax, Duration, `Description`, Author, Status, Topic) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Subject'], "text"),
                       GetSQLValueString($_POST['MinGrade'], "int"),
                       GetSQLValueString($_POST['MaxGrade'], "int"),
                       GetSQLValueString($_POST['Duration'], "int"),
                       GetSQLValueString($_POST['Description'], "text"),
											 GetSQLValueString($_POST['Author'], "text"),
											 GetSQLValueString($_POST['Status'], "text"),
											 GetSQLValueString($_POST['Topic'], "int"));
	/*	
	  TO DO get row of last inserted record
		$insertId = last_insert_id( );
		print "Insert Id: $insertId\n";
		*/
	} else
	$sqlCommand = sprintf("UPDATE Projects SET Name=%s, Subject=%s, GradeMin=%s, GradeMax=%s, Duration=%s, Author=%s, `Description`=%s, Status=%s, Topic=%s WHERE Id=%s",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Subject'], "text"),
                       GetSQLValueString($_POST['MinGrade'], "int"),
                       GetSQLValueString($_POST['MaxGrade'], "int"),
                       GetSQLValueString($_POST['Duration'], "int"),
                       GetSQLValueString($_POST['Author'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
											 GetSQLValueString($_POST['Status'], "text"),
											 GetSQLValueString($_POST['Topic'], "int"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

	$updateGoTo = "ViewAll.php";

	if (isset($_SERVER['QUERY_STRING'])) {
		$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		$updateGoTo .= $_SERVER['QUERY_STRING'];
	} 
	header(sprintf("Location: %s", $updateGoTo));
} 


$colname_foundRecord = "-1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT * FROM Projects WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);
$projectId = $row_foundRecord['Id'];
session_start();
$_SESSION['ProjectName'] = $row_foundRecord['Name'];
$_SESSION['ProjectImage'] = $row_foundRecord['ImgSmall'];
$_SESSION['ActiveNav'] = "details";

// Query for the Topics Menu
mysql_select_db($database_projector, $projector);
$query_TopicsMenu = "SELECT Id, Name FROM Topics";
$TopicsMenu = mysql_query($query_TopicsMenu, $projector) or die(mysql_error());
$row_TopicsMenu = mysql_fetch_assoc($TopicsMenu);
$totalRows_TopicsMenu = mysql_num_rows($TopicsMenu);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Lesson</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/prettify.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-wysihtml5.css"/>

<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<div class="container-fluid">
	
    <?php include("EditorHeader.php"); ?>
    
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">      
        <h2 class="brand" ><?php echo $row_foundRecord['Name']; ?></h2>
        <?php require("SubNav.php"); ?>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Lesson details:</h3>
	</section>
    <section class="row-fluid">
    	<form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
      	<input name="Id" type="hidden" id="Id" value="<?php echo $row_foundRecord['Id']; ?>">
        <table class="table table-condensed unborderedTable span11 offset1" style="font-size:12px;">
              <tbody>
                <!--<tr>
                  <td width="154">ID</td>
                  <td colspan="2">26</td>
                </tr>-->
                <tr>
                  <td width="154">Unit</td>
                  <td><input name="Unit" type="text" id="Unit" value="<?php echo $row_foundRecord['Unit']; ?>"></td>
                </tr>
                <tr>
                  <td width="154">Lesson Number</td>
                  <td><input name="Number" type="text" id="Number" value="<?php echo $row_foundRecord['Number']; ?>"></td>
                </tr>
                <tr>
                  <td width="154">Name</td>
                  <td><input name="Name" type="text" id="Name" value="<?php echo $row_foundRecord['Name']; ?>"></td>
                </tr>
                <tr>
                  <td width="154">Author</td>
                  <td><input name="Author" type="text" id="author" value="<?php echo $row_foundRecord['Author']; ?>"></td>
                </tr>
                <tr>
                  <td width="154">Subject</td>
                  <td><input name="Subject" type="text" id="subject" value="<?php echo $row_foundRecord['Subject']; ?>"></td>
                </tr>
                <tr>
                  <td>Grade level</td>
                  <td>Min.
                    <select name="MinGrade" id="MinGrade" class="span2">
                      <option value="K" <?php if (!(strcmp("K", $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>K</option>
                      <option value="1" <?php if (!(strcmp(1, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>1</option>
                      <option value="2" <?php if (!(strcmp(2, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>2</option>
                      <option value="3" <?php if (!(strcmp(3, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>3</option>
                      <option value="4" <?php if (!(strcmp(4, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>4</option>
                      <option value="5" <?php if (!(strcmp(5, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>5</option>
                      <option value="6" <?php if (!(strcmp(6, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>6</option>
                      <option value="7" <?php if (!(strcmp(7, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>7</option>
                      <option value="8" <?php if (!(strcmp(8, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>8</option>
                      <option value="9" <?php if (!(strcmp(9, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>9</option>
                      <option value="10" <?php if (!(strcmp(10, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>10</option>
                      <option value="11" <?php if (!(strcmp(11, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>11</option>
                      <option value="12" <?php if (!(strcmp(12, $row_foundRecord['GradeMin']))) {echo "selected=\"selected\"";} ?>>12</option>
                    </select>
&nbsp;&nbsp;&nbsp;Max.
                   <select name="MaxGrade" class="span2" id="MaxGrade">
                     <option value="K" <?php if (!(strcmp("K", $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>K</option>
                     <option value="1" <?php if (!(strcmp(1, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>1</option>
                     <option value="2" <?php if (!(strcmp(2, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>2</option>
                     <option value="3" <?php if (!(strcmp(3, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>3</option>
                     <option value="4" <?php if (!(strcmp(4, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>4</option>
                     <option value="5" <?php if (!(strcmp(5, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>5</option>
                     <option value="6" <?php if (!(strcmp(6, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>6</option>
                     <option value="7" <?php if (!(strcmp(7, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>7</option>
                     <option value="8" <?php if (!(strcmp(8, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>8</option>
                     <option value="9" <?php if (!(strcmp(9, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>9</option>
                     <option value="10" <?php if (!(strcmp(10, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>10</option>
                     <option value="11" <?php if (!(strcmp(11, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>11</option>
                     <option value="12" <?php if (!(strcmp(12, $row_foundRecord['GradeMax']))) {echo "selected=\"selected\"";} ?>>12</option>
                   </select></td>
                </tr>
                <tr>
                  <td>Duration<span class="muted"> (days)</span></td>
                  <td>
                  <select name="Duration" class="span2" id="Duration">
                    <option value="1" <?php if (!(strcmp(1, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp(2, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp(3, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>3</option>
                    <option value="4" <?php if (!(strcmp(4, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>4</option>
                    <option value="5" <?php if (!(strcmp(5, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>5</option>
                    <option value="6" <?php if (!(strcmp(6, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>6</option>
                    <option value="7" <?php if (!(strcmp(7, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>7</option>
                    <option value="8" <?php if (!(strcmp(8, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>8</option>
                    <option value="9" <?php if (!(strcmp(9, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>9</option>
                    <option value="10" <?php if (!(strcmp(10, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>10</option>
                    <option value="11" <?php if (!(strcmp(11, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>11</option>
                    <option value="12" <?php if (!(strcmp(12, $row_foundRecord['Duration']))) {echo "selected=\"selected\"";} ?>>12</option>
                  </select></td>
                </tr>
                <tr>
                  <td width="154">Description</td>
                  <td>
                  <textarea name="Description" placeholder="Enter description ..." rows="10" id="Description" class="wysiwyg-editor width-auto"><?php echo $row_foundRecord['Description']; ?></textarea>
                  </td>
                </tr>
                <tr>
                  <td width="154">Status</td>
                  <td><select name="Status" id="Status">
                    <option value="Edit" <?php if (!(strcmp("Edit", $row_foundRecord['Status']))) {echo "selected=\"selected\"";} ?>>Edit</option>
                    <option value="Review" <?php if (!(strcmp("Review", $row_foundRecord['Status']))) {echo "selected=\"selected\"";} ?>>Review</option>
                    <option value="Pilot" <?php if (!(strcmp("Pilot", $row_foundRecord['Status']))) {echo "selected=\"selected\"";} ?>>Pilot</option>
                    <option value="Publish" <?php if (!(strcmp("Publish", $row_foundRecord['Status']))) {echo "selected=\"selected\"";} ?>>Publish</option>
                  </select></td>
                </tr>
                <tr>
                  <td width="154">Topic</td>
                  <td><input name="Topic" type="text" id="Topic" value="<?php echo $row_foundRecord['Topic']; ?>"></td>
                </tr>
                <tr>
                  <td width="154"></td>
                  <td>
                  <input class="btn btn-primary" type="submit" name="button" id="button" value="Save" />
                  <a href="_php/DeleteProject.php?Id=<?php echo $projectId; ?>" class="btn btn-primary btn-danger">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
  	<input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
		</form>
	</section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/prettify.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>

<script>
	$('.wysiwyg-editor').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
	
/* when exiting the edit field update the image preview with the previewId id */	
function updateThumbnailImage(object,previewId)
{
	var thumbnailURL = object.value;
	document.getElementById(previewId).src = thumbnailURL;
}
</script>

</body>
</html>
<?php
mysql_free_result($foundRecord);
mysql_free_result($TopicsMenu);
?>
