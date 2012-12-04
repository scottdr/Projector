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

$projectId = "-1";
if (isset($_GET['Id'])) {
  $projectId = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
if ($projectId == -1)
	$query_MediaQuery = "SELECT * FROM Media ORDER BY ProjectId";
else
	$query_MediaQuery = sprintf("SELECT * FROM Media WHERE ProjectId = %s", GetSQLValueString($projectId, "int"));
$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);

$projectName = "All Projects";
if ($projectId > -1) {
	$query_ProjectQuery = sprintf("SELECT Name FROM projects WHERE Id = %s", GetSQLValueString($projectId, "int"));
	$ProjectQuery = mysql_query($query_ProjectQuery, $projector) or die(mysql_error());
	$row_ProjectQuery = mysql_fetch_assoc($ProjectQuery);
	$totalRows_ProjectQuery = mysql_num_rows($ProjectQuery);
	if ($totalRows_ProjectQuery > 0 )	
		$projectName = $row_ProjectQuery['Name'];
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Content</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />
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
      <h2 class="brand"><?php echo $projectName; ?></h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php<?php if ($projectId > 0) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Challenge details</a></li>
          <li><a href="Projector_EditSteps.php<?php if ($projectId > 0) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Steps</a></li>
          <li class="active"><a href="#"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="Projector_Preview.php<?php if ($projectId > 0) echo "?Id=" . $projectId; ?>"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid" style="margin-top: 44px;">
        <h3 class="span11 offset1">Media:</h3>
    </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover" style="min-width:400px">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                      	<!--<th width="5%">ID</th> -->
                        <th width="20%">Thumbnail</th>
                        <th width="70%">Caption</th>
                        <!--<th width="10%">Project ID</th>-->
                    </tr>
                </thead>
                <tbody>
                		<?php do { ?>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="#"><i class="icon-edit icon-white"></i> Edit</a>
                        <form id="stepForm" name="form1" method="get" action="EditMedia.php">
        <input class="btn btn-mini btn-primary" style="width:50px" type="submit" name="button" id="button" value="Edit" />
        <br />
        <input name="Id" type="hidden" id="Id" value="<?php echo $row_MediaQuery['Id']; ?>" />
      									</form>
                  			</td>
                        <!-- <td><?php echo $row_MediaQuery['Id']; ?></td> -->
                        <td width="140"><img src="/<?php echo $row_MediaQuery['Url']; ?>" class="img-polaroid" width="100"></td>
                        <td><?php echo $row_MediaQuery['Caption']; ?></td>
                        <!--<td><?php echo $row_MediaQuery['ProjectId']; ?></td>-->
                    </tr>
                  	<?php } while ($row_MediaQuery = mysql_fetch_assoc($MediaQuery)); ?>
                </tbody>
            </table>
      </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>