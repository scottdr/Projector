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

$colname_Resource = "-1";
if (isset($_GET['Id'])) {
  $colname_Resource = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_Resource = sprintf("SELECT * FROM CF_Resources WHERE Id = %s", GetSQLValueString($colname_Resource, "int"));
$Resource = mysql_query($query_Resource, $projector) or die(mysql_error());
$row_Resource = mysql_fetch_assoc($Resource);
$totalRows_Resource = mysql_num_rows($Resource);

// Age string:
$ageStart = $row_Resource['AgeStart'];
$ageEnd = $row_Resource['AgeEnd'];
$ageRangeStr = "all ages";
if ($ageStart && $ageEnd) {
	$ageRangeStr = $ageStart . '-' . $ageEnd . ' years';
} else {
	if ($ageEnd) {
		$ageRangeStr = 'up to ' . $ageEnd . ' years old';
	} else if ($ageStart) {
		$ageRangeStr = $ageStart . ' years and older';
	}
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resource Detail Page</title>
        
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-customized-web.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 shim for IE backwards compatibility -->
            <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
    	
        
    <!-- Header Starts -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
	            <div class="container-fluid">
                 <a class="brand" href="ResourcesViewAll.php" style="background-color:pink">Candy Floss</a>
                </div>
            </div>
        </div>
        
    	<div class="container-fluid">
            <section class="row-fluid" style="padding-top:50px;">
              <div class="span12" style="background-color: #02ACF0; height: 40px; overflow: hidden; border: 0; padding: 0; margin: 0;">
                    <a href="#" class="navItemDown">COLLECTIONS</a>
                    <a href="#" class="navItemUp">MY WEB</a>
                    <a href="#" class="navItemUp">ABOUT</a>
                </div>
            </section>  
        </div>
        
        
        <!-- Content Starts -->
        <div class="container-fluid">
            <section class="row-fluid" style="padding-top:10px;padding-bottom:20px;"> 
              
              <div class="span8">
                <h3>Resource Details</h3>
              </div>
              <div class="span4">
              	<div id="headerBackButton">
                  <a href="CollectionsPage.php">Back to Collections </a>
                </div>
              </div>
              
            </section>
            
            <section class="row-fluid" style="background-color:#FFF;">
            <img class="span7" <?php echo $row_Resource['ImageLarge']?'':'style="opacity:0;"'; ?> src="<?php echo $row_Resource['ImageLarge']?$row_Resource['ImageLarge']:'img/static-content/powersoften.jpg'; ?>">
            <div class="span5" style="padding-top:20px; padding-right:20px;">
            	<a href="<?php echo $row_Resource['URL']; ?>" target="_blank" class="btn btn-small btn-success" style="float:right; clear:none;"><i class="icon-globe icon-white"></i> Open web link</a>
                <h4 class="descriptionSectionHeading"><?php echo $row_Resource['Name']; ?></h4>
                
                <p class="descriptionCopyBody"><?php echo $row_Resource['AboutDetail']; ?></p>
                <h5 class="descriptionCopyHeading">Publisher</h5>
                <p class="descriptionCopyBody"><?php echo $row_Resource['Publisher']; ?></p>
                <h5 class="descriptionCopyHeading">Grade level</h5>
                <p class="descriptionCopyBody">10</p>
                <h5 class="descriptionCopyHeading">Age suitability</h5>
                <p class="descriptionCopyBody"><?php echo $ageRangeStr; ?></p>
                <h5 class="descriptionCopyHeading">Media Type</h5>
                <p class="descriptionCopyBody"><?php echo $row_Resource['MediaType']; ?></p>
            </div>
            </section>
            
            <section class="row-fluid">
                <div class="span12" style="padding-top:10px;">
                	<hr/>
                    <h4 class="descriptionSectionHeading">Further Resource Details</h4>
                </div>
            </section>
            
            <section class="row-fluid">
                <div class="span3">
                    <h5 class="descriptionCopyHeading">Author</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['Author']?$row_Resource['Author']:'--'; ?></p>
                    <h5 class="descriptionCopyHeading">Language</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['InLanguage']?$row_Resource['InLanguage']:'--'; ?></p>
                    <h5 class="descriptionCopyHeading">Date created</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['DateCreated']?$row_Resource['DateCreated']:'--'; ?></p>
                </div>
                <div class="span3">
                    <h5 class="descriptionCopyHeading">Educational alignment</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['EducationalAlignment']?$row_Resource['EducationalAlignment']:'--'; ?></p>
                    <h5 class="descriptionCopyHeading">Educational use</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['EducationalUse']?$row_Resource['EducationalUse']:'--'; ?></p>
                    <h5 class="descriptionCopyHeading">Time required</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['TimeRequired']?$row_Resource['TimeRequired']:'--'; ?></p>
                </div>
                <div class="span3">
                    <h5 class="descriptionCopyHeading">Intended audience</h5>
                    <p class="descriptionCopyBody"><?php echo $row_Resource['EndUserRole']; ?></p>
                </div>         
            </section>
            
		</div>
        
        <!-- JS at the end of the page for faster loading -->
          <script src="http://code.jquery.com/jquery-latest.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script>
        <p></p> 
</body>
</html>
<?php
mysql_free_result($Resource);
?>