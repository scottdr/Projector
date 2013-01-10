<?php require_once('../Connections/projector.php'); ?>
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

session_start(); 
$_SESSION['ActiveNav'] = "routines";

// put url parameters back on the url we pass when you click the save button to re-post form data to this same page
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$projectId = "";
if (isset($_GET['ProjectId'])) 
	$projectId = $_GET['ProjectId'];

$projectName = "";
if (isset($_GET['ProjectName'])) 
	$projectName = $_GET['ProjectName'];
	
$mediaId = "";
if (isset($_GET['Id'])) 
	$mediaId = $_GET['Id'];

	
// Default to performing an upate unless we posted a action on the url then use that
$action = "Edit";
if (isset($_GET["action"])) {
	$action = $_GET["action"];
}

/* We are either adding or editing a Project */
if (isset($_POST["MM_action"])) {
	
	if ($_POST["MM_action"] == "Add") {
		$sqlCommand = sprintf("INSERT INTO Routines (RoutineName) VALUES (%s)",
                       GetSQLValueString($_POST['RoutineName'], "text"));
	} else
	$sqlCommand = sprintf("UPDATE Routines SET RoutineName=%s WHERE Id=%s",
                       GetSQLValueString($_POST['RoutineName'], "text"),
											 GetSQLValueString($mediaId, "int")
											 );
//	echo "sql: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

	$updateGoTo = "CCSoC_ViewRoutines.php";
	if (isset($projectId)) {
		$updateGoTo .= '?Id=' . $projectId;
	} 
	header(sprintf("Location: %s", $updateGoTo));

} 


$colname_foundRecord = "-1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT * FROM Routines WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Routine</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/prettify.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-wysihtml5.css"/>
<script src="../js/utility.js"></script>

<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<div class="container-fluid">
	
    <?php include("EditorHeader.php"); ?>
    
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand"><?php echo $projectName; ?></h2>
      	<?php require("SubNav.php"); ?>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1"><?php echo $action; ?> routine:</h3>
	</section>
    <section class="row-fluid">
        <table id="mediaForm" class="table table-condensed unborderedTable span10 offset1">
              <tbody>

                <form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
      					<input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
								<tr>
                  <td>Name</td>
                  <td><input name="RoutineName" type="text" class="width-auto" id="RoutineName" value="<?php echo $row_foundRecord['RoutineName']; ?>"></td>
                </tr>
                <tr>
                  <td colspan="2"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                  <input class="btn btn-primary" type="submit" name="button" id="button" value="Save" />
                  <a href="_php/DeleteRoutine.php?Id=<?php echo $colname_foundRecord; ?>&ProjectId=<?php echo $projectId; ?>" class="btn btn-primary btn-danger">Delete</a>
                  </td>
                </tr>
                <input type="hidden" name="MM_action" value="<?php echo $action; ?>" />
    						</form>
                
              </tbody>
            </table>
  		
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
</script>

</body>
</html>