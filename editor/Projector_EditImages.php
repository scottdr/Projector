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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


/* We are either adding or editing a Project */
if (isset($_POST["MM_action"])) {
	
	$sqlCommand = sprintf("UPDATE Projects SET ImgSmall=%s, ImgMedium=%s, ImgLarge=%s WHERE Id=%s",
                       GetSQLValueString($_POST['ImgSmall'], "text"),
											 GetSQLValueString($_POST['ImgMedium'], "text"),
											 GetSQLValueString($_POST['ImgLarge'], "text"),
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
$_SESSION['ActiveNav'] = "images";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Project</title>
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
        <h3 class="span11 offset1">Images:</h3>
	</section>
    <section class="row-fluid">
        <table class="table table-condensed unborderedTable span11 offset1" style="font-size:12px;">
              <tbody>
                <!--<tr>
                  <td width="154">ID</td>
                  <td colspan="2">26</td>
                </tr>-->
                <tr>
                  <td>Small image</td>
                  <td>
                 <form action="_php/UploadProjectImage.php" method='post' enctype="multipart/form-data" id="uploadImageForm">
                 			<input type="hidden" name="FieldName" value="ImgSmall" />
                      <input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
                  		<input type='file' name='file' />           
                 			<input type="submit" name="UploadImage" id="UploadImage" value="Upload Image" class="btn">           
                 </form> 
                 <!--<a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add image</a>-->
                 <br/><br/>
                 <img src="<?php echo $row_foundRecord['ImgSmall']; ?>" name="ImgSmallPreview" width="100" height="100" class="img-polaroid" id="ImgSmallPreview">
                 <br/><br/>
                 <input name="ImgSmall" type="text" class="width-auto" id="ImgSmall" value="<?php echo $row_foundRecord['ImgSmall']; ?>" onblur="updateThumbnailImage(this,'ImgSmallPreview')">
                 </td>
                </tr>
                <tr>
                  <td>Medium image</td>
                  <td>
                  <form action="_php/UploadProjectImage.php" method='post' enctype="multipart/form-data" id="uploadImageForm">
                 			<input type="hidden" name="FieldName" value="ImgMedium" />
                      <input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
                  		<input type='file' name='file'/>           
                 			<input type="submit" name="UploadImage" id="UploadImage" value="Upload Image" class="btn">           
                 	</form> 
                 <br/><br/>
                 <img src="<?php echo $row_foundRecord['ImgMedium']; ?>" name="ImgMediumPreview" width="200" height="200" class="img-polaroid" id="ImgMediumPreview">
                 <br/><br/>
                 <input name="ImgMedium" type="text" class="width-auto" id="ImgMedium" value="<?php echo $row_foundRecord['ImgMedium']; ?>" onblur="updateThumbnailImage(this,'ImgMediumPreview')">
                  </td>
                </tr>
                <tr>
                  <td>Large image</td>
                  <td>
                  <form action="_php/UploadProjectImage.php" method='post' enctype="multipart/form-data" id="uploadImageForm">
                 			<input type="hidden" name="FieldName" value="ImgLarge" />
                      <input type="hidden" name="ProjectId" value="<?php echo $projectId; ?>" />
                  		<input type='file' name='file'/>           
                 			<input type="submit" name="UploadImage" id="UploadImage" value="Upload Image" class="btn">           
                 	</form>
                 <br/><br/>
                 <img src="<?php echo $row_foundRecord['ImgLarge']; ?>" name="ImgLargePreview" width="300" height="300" class="img-polaroid" id="ImgLargePreview">
                  <br/><br/>
                 <input name="ImgLarge" type="text" class="width-auto" id="ImgLarge" value="<?php echo $row_foundRecord['ImgLarge']; ?>" onblur="updateThumbnailImage(this,'ImgLargePreview')">
                  </td>
                </tr>
               <!-- <tr>
                  <td width="154"></td>
                  <td>
                  <input class="btn btn-primary" type="submit" name="button" id="button" value="Save" />
                  <a href="_php/DeleteProject.php?Id=<?php echo $projectId; ?>" class="btn btn-primary btn-danger">Delete</a>
                  </td>
                </tr>-->
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
?>
