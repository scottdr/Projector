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

$colname_CourseList = "-1";
if (isset($_GET['Grade'])) {
  $colname_CourseList = $_GET['Grade'];
}
mysql_select_db($database_projector, $projector);
if ($colname_CourseList > -1)
	$query_CourseList = sprintf("SELECT * FROM Courses WHERE Grade = %s ORDER BY Grade ASC", GetSQLValueString($colname_CourseList, "int"));
else
 	$query_CourseList = "SELECT * FROM Courses ORDER BY Grade ASC";

$CourseList = mysql_query($query_CourseList, $projector) or die(mysql_error());
$row_CourseList = mysql_fetch_assoc($CourseList);
$totalRows_CourseList = mysql_num_rows($CourseList);

function getGrade($row_foundRecord)
{
	if ($row_foundRecord['GradeMin'] == $row_foundRecord['GradeMax']) {
		return $row_foundRecord['GradeMin'];
	} else {
		return $row_foundRecord['GradeMin'] . ' - ' . $row_foundRecord['GradeMax'];
	}
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
        <h3 class="span11 offset1"> Courses:</h3>
	</section>
    <section class="row-fluid">
        <p class="span11 offset1">Select a course to edit or <a href="#">add a new course</a></p>
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
    </p>
    </div>
    </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                        <th width="5%">&nbsp;</th>
                        <th width="40%">Name</th>
                        <th width="10%">Grade</th>
                        <th width="10%">Subject</th>
						</tr>
                </thead>
                <tbody>
                	<?php do { ?>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="<?php if ($PROJECTOR["cc"]) echo "CCSoC_EditLesson.php"; else echo "CC_EditCourse.php"; echo "?Id=" . $row_CourseList['Id'] ?>"><i class="icon-edit icon-white"></i> Edit</a></td>
                        <td><a class="btn btn-mini btn-primary" href="../CC_UnitBrowserLive.php?CourseId=<?php echo $row_CourseList['Id']; ?>"><i class="icon-eye-open icon-white"></i> Preview</a></td>
                        <td><a href="CC_ViewUnits.php?CourseId=<?php echo $row_CourseList['Id']; ?>"><?php echo $row_CourseList['Name']; ?></a></td>
                        <td><?php echo $row_CourseList['Grade']; ?></td>
                        <td><?php echo $row_CourseList['Subject']; ?></td>
                    </tr>
                  <?php } while ($row_CourseList = mysql_fetch_assoc($CourseList)); ?>
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
mysql_free_result($CourseList);
?>
