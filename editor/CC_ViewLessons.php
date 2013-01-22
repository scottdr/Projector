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

function getGrade($row_foundRecord)
{
	if ($row_foundRecord['GradeMin'] == $row_foundRecord['GradeMax']) {
		return $row_foundRecord['GradeMin'];
	} else {
		return $row_foundRecord['GradeMin'] . ' - ' . $row_foundRecord['GradeMax'];
	}
}

$colname_projectList = "-1";
if (isset($_GET['UnitId'])) {
  $colname_projectList = $_GET['UnitId'];
}
mysql_select_db($database_projector, $projector);
if ($colname_projectList > -1)
	$query_projectList = sprintf("SELECT * FROM Projects WHERE UnitId = %s ORDER BY `Number` ASC", GetSQLValueString($colname_projectList, "int"));
else
	$query_projectList = sprintf("SELECT * FROM Projects ORDER BY `Number` ASC");
$projectList = mysql_query($query_projectList, $projector) or die(mysql_error());
$row_projectList = mysql_fetch_assoc($projectList);
$totalRows_projectList = mysql_num_rows($projectList);

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
<title>View Projects</title>
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
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid" style="margin-top: 44px;">
        <h3 class="span11 offset1"> <?php if ($PROJECTOR['cc']) echo "Lessons:"; else echo "Projects:"; ?></h3>
	</section>
    <section class="row-fluid">
        <p class="span11 offset1">Select a <?php if ($PROJECTOR['cc']) echo "lesson"; else echo "project"; ?> to edit or <a href="Projector_EditChallenge.php">add a new <?php if ($PROJECTOR['cc']) echo "lesson"; else echo "project"; ?></a></p>
    </section>
    <section class="row-fluid">
    <div class="span10 offset1" style="background-color: #EDEDED;">
    <p style="padding:10px; margin:0;">Filter: &nbsp;
        <select class="dropdown">
          <option>Select Grade</option>
        </select>
        <select class="dropdown">
          <option>Select Subject</option>
        </select>
        <select class="dropdown">
          <option>Select Status</option>
        </select>
    </p>
    </div>
    </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="15%">&nbsp;</th>
                        <th width="15%">Thumbnail</th>
                        <th width="30%">Title</th>
                        <th width="10%">Grade</th>
                        <th width="20%">Subject</th>
												<th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                	<?php do { ?>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="<?php if ($PROJECTOR["cc"]) echo "CCSoC_EditLesson.php"; else echo "Projector_EditChallenge.php"; echo "?Id=" . $row_projectList['Id']   ?>"><i class="icon-edit icon-white"></i> Edit</a></td>
                        <td><a href="/ProjectDetails.php<?php echo "?Id=" . $row_projectList['Id'] ?>"><img src="<?php echo $row_projectList['ImgSmall']; ?>" alt="" name="" width="96" height="63" /></a></td>
                        <td><a href="/CC_LessonBrowserLive.php<?php echo $addToUrl . "&Id=" . $row_projectList['Id'] . "&UnitId=" . $row_projectList['UnitId']; ?>"><?php echo $row_projectList['Name']; ?></a></td>
                        <td><?php echo getGrade($row_projectList); ?></td>
                        <td><?php echo $row_projectList['Subject']; ?></td>
                        <td><?php echo $row_projectList['Status']; ?></td>
                    </tr>
                  <?php } while ($row_projectList = mysql_fetch_assoc($projectList)); ?>
                </tbody>
            </table>
      </div>
    </section>
    <section class="row-fluid">
        <hr class="span11 offset1"/>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
mysql_free_result($projectList);
?>