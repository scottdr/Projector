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

$colname_CourseInfo = "-1";
if (isset($_GET['CourseId'])) {
  $colname_CourseInfo = $_GET['CourseId'];
}
mysql_select_db($database_projector, $projector);
$query_CourseInfo = sprintf("SELECT * FROM Courses WHERE Id = %s", GetSQLValueString($colname_CourseInfo, "int"));
$CourseInfo = mysql_query($query_CourseInfo, $projector) or die(mysql_error());
$row_CourseInfo = mysql_fetch_assoc($CourseInfo);
$totalRows_CourseInfo = mysql_num_rows($CourseInfo);

$colname_UnitInfo = "-1";
if (isset($_GET['UnitId'])) {
  $colname_UnitInfo = $_GET['UnitId'];
}
mysql_select_db($database_projector, $projector);
$query_UnitInfo = sprintf("SELECT * FROM Units WHERE Id = %s", GetSQLValueString($colname_UnitInfo, "int"));
$UnitInfo = mysql_query($query_UnitInfo, $projector) or die(mysql_error());
$row_UnitInfo = mysql_fetch_assoc($UnitInfo);
$totalRows_UnitInfo = mysql_num_rows($UnitInfo);

$addToUrl = "";
// get URL parameter's already on the url and pass them on to next page.
if (isset($_SERVER['QUERY_STRING'])) {
    $addToUrl = "?";
		$addToUrl .= $_SERVER['QUERY_STRING'];
} 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Lessons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet"/>
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet"/>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="/editor/CC_CourseBrowser.php" class="parent transition"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="CC_UnitBrowserLive.php<?php echo $addToUrl; ?>" class="parent transition"><?php echo $row_CourseInfo["Name"]; ?></a></li>
              <li><a href="CC_EpisodeBrowserLive.php<?php echo $addToUrl; ?>" class="parent"><?php echo $row_UnitInfo["Name"]; ?></a></li>
              <li><a href="#"><?php echo $row_EpisodeInfo["Name"]; ?>: <?php echo $row_EpisodeInfo["Title"]; ?>, <?php echo $row_LessonInfo["Name"]; ?></a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container" style="padding-top:80px;">
    
    	<div class="row-fluid">
      	<div class="span12" style="color:#FFF;">
                <img id="RoutineIcon" src="_images/CC_UI/cc_math_groupwork.png" style="float:left; padding-right:10px;"/>
                <p id="RoutineName" class="lessonTypeHeading">GROUP PROJECT</p>
                <H1 id="StepTitle">WorkTime</H1>
				</div><!-- /.span -->
      </div><!-- /.row fluid -->
        
      <div class="row-fluid">
          <div id="LessonContent" class="span8 offset2 lessonContent">	
          </div><!-- /.span -->
      </div><!-- /.row fluid -->
      
    </div> <!-- /container -->
    
    <div class="navbar-fixed-bottom lessonNavigation">
      <div class="pagination pagination-centered">
        <ul>
            <li><a id="PreviousButton" href="#">&lt;</a></li>
            <li>
                <a href="#" id="lesson-ribbon" data-placement="top" rel="popover" data-original-title="In Lesson 1:" data-number="1">1</a>
                <div id="popover-content" style="display: none">
                  <?php require_once("_php/LessonNavigatorContent.php"); ?> 
                </div>
            </li>
            <li><a id="NextButton" href="#">&gt;</a></li>
        </ul>
      </div>
    </div>

    <script type='text/javascript' src="http://code.jquery.com/jquery-latest.js"></script>
    
    <script type='text/javascript' src="js/bootstrap.js"></script>
    <script type='text/javascript' src="js/bootstrap-tooltip.js"></script>
    <script type='text/javascript' src="js/bootstrap-popover.js"></script>
    <script type='text/javascript' src="js/utility.js"></script>
    <script type='text/javascript' src="_scripts/LessonBrowser.js"></script>
    
    <script>  

		
		$(document).ready(function(){
			loadLessonSteps();	// load json encoded array of all the step info
			// load in the info for the first step
			//loadStep(ProjectId,-1,1);
			//selectStep(1);	// select the first step
			
			$('body').css('display', 'none');
			$('body').fadeIn(1000);
			$("a.transition").click(function(event){
				event.preventDefault();
				linkLocation = this.href;
				$("body").fadeOut(1000, redirectPage);      
			});
			function redirectPage() {
				window.location = linkLocation;
			}	
		
			$("#NextButton").click(function() {
				var newStepNumber = parseInt($("#lesson-ribbon").attr("data-number")) + 1;
				selectStep(newStepNumber);
			});
			
			$("#PreviousButton").click(function() {
				var newStepNumber = parseInt($("#lesson-ribbon").attr("data-number")) - 1;
				selectStep(newStepNumber);
			});
			
		  $('#lesson-ribbon').popover({ 
			html : true,
			content: function() {
			  return $('#popover-content').html();
			}
		  });
		});
	</script>  

  </body>
</html>
<?php
mysql_free_result($LessonInfo);
mysql_free_result($UnitInfo);
mysql_free_result($CourseInfo);
?>
