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
$_SESSION['ActiveNav'] = "units";

$courseId = "-1";
if (isset($_GET['CourseId'])) {
  $courseId = $_GET['CourseId'];
}
mysql_select_db($database_projector, $projector);
if ($courseId == -1)
	$query_MediaQuery = "SELECT * FROM Units ORDER BY SortOrder";
else
	$query_MediaQuery = sprintf("SELECT * FROM Units WHERE CourseId = %s ORDER BY SortOrder", GetSQLValueString($courseId, "int"));
$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);

$projectName = "All Courses";
if ($courseId > -1) {
	$query_ProjectQuery = sprintf("SELECT Name FROM Courses WHERE Id = %s", GetSQLValueString($courseId, "int"));
	$ProjectQuery = mysql_query($query_ProjectQuery, $projector) or die(mysql_error());
	$row_ProjectQuery = mysql_fetch_assoc($ProjectQuery);
	$totalRows_ProjectQuery = mysql_num_rows($ProjectQuery);
	if ($totalRows_ProjectQuery > 0 )	
		$courseName = $row_ProjectQuery['Name'];
}

// get URL parameter's already on the url and pass them on to next page.
if (isset($_SERVER['QUERY_STRING'])) {
    $addToUrl = "?";
		$addToUrl .= $_SERVER['QUERY_STRING'];
} 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Units</title>
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
	
    <?php include("CC_EditorHeader.php"); ?>
    
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      	<h2 class="brand"><?php echo $courseName; ?></h2>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid" style="margin-top: 44px;">

        <h3 class="span11 offset1">
        	Units:
            <br/><br/>
            
            <a class="btn btn-small" style="height:20px; padding:5px; line-height:20px;" href="Projector_MediaEdit.php?action=Add<?php if ($courseId > 0) echo "&CourseId=" . $courseId; if (isset($projectName)) echo "&ProjectName=" . $courseName; ?>">
            <i class="icon-plus"></i> 
            Add new Unit
            </a>
        
        </h3>

  </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover" style="min-width:400px">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                        <th width="10%">&nbsp;</th>
                      	<!--<th width="5%">ID</th> -->
                        <th width="80%">Unit</th>
                        <!--<th width="10%">Project ID</th>-->
                    </tr>
                </thead>
                <tbody>
                		<?php do { ?>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="CC_EditUnit.php?Id=<?php echo $row_MediaQuery['Id']; if (isset($projectName)) echo "&ProjectName=" . $projectName; if (isset($courseId)) echo "&ProjectId=" . $courseId;?>"><i class="icon-edit icon-white"></i> Edit</a>
                  			</td>
                        <td width="140"><a class="btn btn-mini btn-primary" href="../CC_EpisodeBrowserLive.php?CourseId=<?php echo $courseId . "&UnitId=" . $row_MediaQuery['Id']; ?>"><i class="icon-eye-open icon-white"></i> View</a></td>
                        <!-- <td><?php echo $row_MediaQuery['Id']; ?></td> -->
                        <td><a href="CC_ViewLessons.php?UnitId=<?php echo $row_MediaQuery['Id']; ?>&CourseId=<?php echo $courseId; ?>"><?php echo $row_MediaQuery['Name']; ?></a></td>
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