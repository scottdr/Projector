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

// put url parameters back on the url we pass when you click the save button to re-post form data to this same page
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// put url parameters back on the url we pass when you click the save button to upload he image
$uploadImageAction = "_php/UploadFile.php";
if (isset($_SERVER['QUERY_STRING'])) {
  $uploadImageAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
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
		$sqlCommand = sprintf("INSERT INTO Media (ProjectId, Url, Caption,`Description`, Width, Height) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ProjectId'], "text"),
                       GetSQLValueString($_POST['Url'], "text"),
                       GetSQLValueString($_POST['Caption'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Width'], "int"),
                       GetSQLValueString($_POST['Height'], "int"));
	} else
	$sqlCommand = sprintf("UPDATE Media SET ProjectId=%s, Url=%s, Caption=%s, Description=%s, Width=%s, Height=%s WHERE Id=%s",
                       GetSQLValueString($_POST['ProjectId'], "text"),
                       GetSQLValueString($_POST['Url'], "text"),
                       GetSQLValueString($_POST['Caption'], "text"),
											 GetSQLValueString($_POST['Description'], "text"),
											 GetSQLValueString($_POST['Width'], "int"),
                       GetSQLValueString($_POST['Height'], "int"),
											 GetSQLValueString($mediaId, "int")
											 );
//	echo "sql: " . $sqlCommand;
  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

	$updateGoTo = "Projector_ViewMedia.php";
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
$query_foundRecord = sprintf("SELECT * FROM Media WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Lesson media</title>
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
    
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand"><?php echo $projectName; ?></h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php?Id=<?php echo $projectId; ?>"><i class="icon-edit"></i> Details</a></li>
          <li><a href="Projector_EditSteps.php?Id=<?php echo $projectId; ?>"><i class="icon-edit"></i> Steps</a></li>
          <li class="active"><a href="Projector_ViewMedia.php?Id=<?php echo $projectId; ?>&ProjectName=<?php echo $projectName; ?>"><i class="icon-eye-open"></i>Media</a></li>
          <li><a href="../ChallengeTemplate.php?ProjectId=<?php echo $projectId; ?>"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1"><?php echo $action; ?> media:</h3>
	</section>
    <section class="row-fluid">

        <table class="table table-condensed unborderedTable span10 offset1">
              <tbody>
              	<tr>
                	
                  <td class="width-narrow">Media</td>
                  <td>
                  	<form action="<?php echo $uploadImageAction; ?>" method='post' enctype="multipart/form-data" id="uploadImageForm">
                  		<input type='file' name='file'/>
                      <input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
                 			<input type="submit" name="UploadImage" id="UploadImage" value="Upload Image">
                      <!--<a class="btn btn-small" onClick="uploadImage()"><i class="icon-arrow-up"></i> Upload image</a>-->
                    </form>
									 	<br/><br/>
                    <img src="<?php echo $row_foundRecord['Url']; ?>" alt="" class="img-polaroid"></td>
                </tr>
                <form action="<?php echo $editFormAction; ?>" id="updateForm" name="updateForm" method="POST">
      					<input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
                <tr>
                  <td>URL</td>
                  <td><input name="Url" type="text" class="width-auto" id="Url" value="<?php echo $row_foundRecord['Url']; ?>" readonly></td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td><textarea name="Description" class="width-auto" id="Description"><?php echo $row_foundRecord['Description']; ?></textarea></td>
                </tr>
                <tr>
                  <td>Caption</td>
                  <td><textarea name="Caption" placeholder="Enter caption..." rows="10" id="Caption" class="wysiwyg-editor width-auto"><?php echo $row_foundRecord['Caption']; ?></textarea></td>
                </tr>
                <tr>
                  <td>Width<span class="muted"> (pixels)</span></td>
                  <td><input name="Width" type="text" id="Width" value="<?php echo $row_foundRecord['Width']; ?>"></td>
                </tr>
                
                
                <tr>
                  <td>Height<span class="muted"> (pixels)</span></td>
                  <td><input name="Height" type="text" id="Height" value="<?php echo $row_foundRecord['Height']; ?>"></td>
                </tr>
                <tr>
                  <td colspan="2"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                  <input class="btn btn-primary" type="submit" name="button" id="button" value="Save" />
                  <a href="#" class="btn btn-primary btn-danger">Delete</a>
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
	
function uploadImage()
{
	 var myform = $('#uploadImageForm');
	 alert(myform.serialize());
	 $.ajax( {
      type: "POST",
      url: "_php/UploadFile.php",
      data: myform.serialize(),
      success: function( response ) {
        console.log( response );
      }
    } );
}

</script>

</body>
</html>