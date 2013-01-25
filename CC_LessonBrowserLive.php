<?php require_once('Globals.php'); ?>
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

$colname_LessonInfo = "-1";
if (isset($_GET['Id'])) {
  $colname_LessonInfo = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_LessonInfo = sprintf("SELECT * FROM Projects WHERE Id = %s", GetSQLValueString($colname_LessonInfo, "int"));
$LessonInfo = mysql_query($query_LessonInfo, $projector) or die(mysql_error());
$row_LessonInfo = mysql_fetch_assoc($LessonInfo);
$totalRows_LessonInfo = mysql_num_rows($LessonInfo);


mysql_select_db($database_projector, $projector);
$query_EpisodeInfo = sprintf("SELECT * FROM Episodes WHERE Id = %s", GetSQLValueString($row_LessonInfo["EpisodeId"], "int"));
$EpisodeInfo = mysql_query($query_EpisodeInfo, $projector) or die(mysql_error());
$row_EpisodeInfo = mysql_fetch_assoc($EpisodeInfo);
$totalRows_EpisodeInfo = mysql_num_rows($EpisodeInfo);



$colname_UnitInfo = "-1";
if (isset($_GET['UnitId'])) {
  $colname_UnitInfo = $_GET['UnitId'];
} else {
	$colname_UnitInfo = $row_LessonInfo['UnitId'];
}

$editable = true;
$GLOBALS['demoMode'] = false;
if ($GLOBALS['demoMode']) {
	if (!isset($_GET['Action']) || $_GET['Action'] != 'Edit')
  	$editable = false;
}
mysql_select_db($database_projector, $projector);
$query_UnitInfo = sprintf("SELECT * FROM Units WHERE Id = %s", GetSQLValueString($colname_UnitInfo, "int"));
$UnitInfo = mysql_query($query_UnitInfo, $projector) or die(mysql_error());
$row_UnitInfo = mysql_fetch_assoc($UnitInfo);
$totalRows_UnitInfo = mysql_num_rows($UnitInfo);

$colname_CourseInfo = "-1";
if (isset($_GET['CourseId'])) {
  $colname_CourseInfo = $_GET['CourseId'];
} else {		// if course id is not provided look it up from the Units table
	$colname_CourseInfo = $row_UnitInfo['CourseId'];
}
	
mysql_select_db($database_projector, $projector);
$query_CourseInfo = sprintf("SELECT * FROM Courses WHERE Id = %s", GetSQLValueString($colname_CourseInfo, "int"));
$CourseInfo = mysql_query($query_CourseInfo, $projector) or die(mysql_error());
$row_CourseInfo = mysql_fetch_assoc($CourseInfo);
$totalRows_CourseInfo = mysql_num_rows($CourseInfo);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Lessons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">


    <link href="_css/bootstrap.css" rel="stylesheet"/>
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet"/>
    <link href="_css/gf-styles.css" rel="stylesheet"/>

	 <style type="text/css">
	
		body {
			background-color:#FFF;
		}

    </style>
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body class="lesson-body be-invisible">
  
  <div class="img-background">
  	<img src="<?php if (isset($row_LessonInfo["ImgLarge"])) echo $row_LessonInfo["ImgLarge"]; else echo ""; ?>">
  </div>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="/editor/CC_CourseBrowser.php" class="parent transition"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="CC_UnitBrowserLive.php?CourseId=<?php echo $colname_CourseInfo; ?>" class="parent transition"><?php echo $row_CourseInfo["Name"]; ?></a></li>
              <li><a href="CC_EpisodeBrowserLive.php?CourseId=<?php echo $colname_CourseInfo; ?>&UnitId=<?php echo $colname_UnitInfo; ?>" class="parent"><?php echo $row_UnitInfo["Name"]; ?></a></li>
              <li><a href="#"><?php echo $row_EpisodeInfo["Name"]; ?>: <?php echo $row_EpisodeInfo["Title"]; ?>, <?php echo $row_LessonInfo["Name"]; ?></a></li>
          </ul>
          <div style=" position:fixed; right:10px; top:8px;">
          	<?php if ($editable) : ?>
          	<a class="btn btn-mini btn-primary" href="<?php if ($PROJECTOR["cc"]) echo "/editor/CCSoC_EditLesson.php"; else echo "Projector_EditChallenge.php"; echo "?Id=" . $colname_LessonInfo ."&Action=Edit" ?>"><i class="icon-edit icon-white"></i> Edit</a>
           	<?php endif; ?>
          </div>
        </div><!-- /.container -->
        
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container main-container" style="padding-top:80px;">
    
    	<div id="LessonContent" class="pages">
        
        </div>
      
    </div> <!-- /container -->
    
    <div class="navbar-fixed-bottom lessonNavigation">
      <div class="pagination pagination-centered">
        <ul class="relative pag" id="pag">
            <li><a class="previous" href="#">&lt;</a></li>
            <li>
                <a href="#" id="lesson-ribbon">1</a>
                <div id="popover" class="popover fade top in">
                	<div class="arrow"></div>
                    <div class="popover-inner">
                    	<h3 class="popover-title"><?php echo $row_EpisodeInfo["Title"]; ?>, <?php echo $row_LessonInfo["Name"]; ?>:</h3>
                        <div class="popover-content">
                  			<?php require_once("_php/LessonNavigatorContent.php"); ?> 
                        </div>
                    </div>
                </div>
            </li>
            <li><a class="next" href="#">&gt;</a></li>
        </ul>
      </div>
    </div>

    <script type='text/javascript' src="http://code.jquery.com/jquery-latest.js"></script>
    
    <script type='text/javascript' src="js/utility.js"></script>
    <script type='text/javascript' src="_scripts/modernizr.custom.42097.js"></script>
    <script type='text/javascript' src="_scripts/jquery.snapview.js"></script>
    <script type='text/javascript' src="_scripts/LessonBrowser.js"></script>
    
    <script>  
		loadLessonSteps();	
		$('body').addClass('fading-in');
	</script>  

  </body>
</html>
<?php
mysql_free_result($LessonInfo);
mysql_free_result($UnitInfo);
mysql_free_result($CourseInfo);
?>
