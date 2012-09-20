<?php require_once('Connections/projector.php'); ?>
<?php include('Globals.php'); ?>
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

function getDuration($duration)
{
	$numWeeks = round($duration / 5);
	$numDays = $duration % 5;
	$durationStr = '';
	if ($numWeeks > 1) {
		$durationStr =  $numWeeks . " Weeks ";
	}  else if ($numWeeks == 1) {
		$durationStr =  $numWeeks . " Week ";
	}
	if ($numDays > 1) {
		$durationStr .= $numDays . " Days";
	}
	else if ($numDays == 1) {
		$durationStr .= $numDays . " Day";
	}
	return $durationStr;
}

$colname_foundRecord = "1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT projects.Id, Name, Description, Duration, Subject, GradeMin, GradeMax, ImgSmall, Brief, Detail, Questions, Start, ProjectDetails.ProjectId FROM projects, ProjectDetails WHERE projects.Id = ProjectDetails.ProjectId and projects.Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = "0";
$colname_foundRecord = "-1";
if (isset($_GET['Id'])) {
  $colname_foundRecord = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_foundRecord = sprintf("SELECT * FROM projects WHERE Id = %s", GetSQLValueString($colname_foundRecord, "int"));
$foundRecord = mysql_query($query_foundRecord, $projector) or die(mysql_error());
$row_foundRecord = mysql_fetch_assoc($foundRecord);
$totalRows_foundRecord = mysql_num_rows($foundRecord);

$colname_ProjectDetails = "-1";
if (isset($_GET['Id'])) {
  $colname_ProjectDetails = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_ProjectDetails = sprintf("SELECT * FROM ProjectDetails WHERE ProjectId = %s", GetSQLValueString($colname_ProjectDetails, "int"));
$ProjectDetails = mysql_query($query_ProjectDetails, $projector) or die(mysql_error());
$row_ProjectDetails = mysql_fetch_assoc($ProjectDetails);
$totalRows_ProjectDetails = mysql_num_rows($ProjectDetails);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>The Projector</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css"/>
<link href="_css/Root_Project.css" rel="stylesheet" type="text/css"/>
<link href="_css/main.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
        $(function () {
            var tabContainers = $('div.tabs > div');
            tabContainers.hide().filter(':first').show();
 
            $('div.tabs ul.tabNavigation a').click(function () {
                tabContainers.hide();
                tabContainers.filter(this.hash).show();
                $('div.tabs ul.tabNavigation a').removeClass('selected');
                $(this).addClass('selected');
                return false;
            }).filter(':first').click();
        });
</script>    
<script src="_scripts/respond.min.js"></script>
<script type="text/javascript" src="js/utility.js"></script>
</head>

<body>

    <div class="gridContainer clearfix"> 
      <div class="ProjGalleryBackgroundDiv">

        <!-- HEADER AND NAVIGATION --------------------------------------------->
        <?php $selectedNav = ""; ?>
        <?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div> 
        
        <!-- PAGE CONTENT --------------------------------------------->
        <div id="ContentDiv">
            <div id="GalleryDetailPageTitle">
               <h1><?php echo $row_foundRecord['Name']; ?></h1>
            </div>
            <div id="titleNav" class="floatRight">
              <form action="EditProject.php" method="get">
                  <input name="Id" type="hidden" id="Id" value="<?php echo $row_foundRecord['Id']; ?>" size="5" readonly="readonly" />   <a href="Gallery.php"><img src="images/back_to_gallery.gif" id="backToGallery" width="120" height="26" alt="Back to Gallery" /></a>
									<?php if (isset($PROJECTOR['editMode'])): ?>
                  	<input class="button" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="submit" value="Edit" />
                  <?php endif; ?>
              </form>
            </div>
          
        	<!-- SUMMARY --------------------------------------------->
            <div id="ProjectSummary">
                <a href="ChallengeContent.html"><img src="<?php echo $row_foundRecord['ImgSmall']; ?>" alt="" name="imgPlaceHolder" width="350" height="250" id="imgPlaceHolder"/></a>
                <div class="projectInfo">
                    <div class="projectData">
                      <h2>Challenge Objective:</h2>
                      <p><?php echo $row_foundRecord['Description']; ?></p>
                      <h2>Challenge Duration: <?php echo getDuration($row_foundRecord['Duration']); ?></h2>
                      <h2>Subject Areas: <?php echo $row_foundRecord['Subject']; ?></h2>
                      <h2>Grade Level: <?php echo getGrade($row_foundRecord); ?></h2>
                    </div>
                </div>
          	</div>
            
            <!-- TABS --------------------------------------------->
            <div class="tabs" id="tabDiv">
            	<ul class="tabNavigation">
                <li><a href="#projectTab1">The Challenge</a></li>
                <li><a href="#projectTab2">Credits</a></li>
                <li><a href="#projectTab3">Teacher Notes</a></li>
              </ul>
            <!-- TAB ONE ----------------------------------------->
            <div id="projectTab1">
              <div id="resources">
                <h2>Start the challenge</h2>
                <p>You can work through the challenge online or you can download it in a PDF format</p>
                <hr/>
                <h3>Online Challenge</h3>
                <p>Ready to start the challenge online? You'll begin with a short video that will give you an idea of what’s ahead. Click the Start button below and begin the adventure.</p>
                <p><a href="ChallengeTemplate.php?ProjectId=<?php echo $row_foundRecord['Id']; ?>" class="bluebutton">Start the Online Challenge</a></p>
              </div>
              	<?php if (isset($editMode)): ?>
	                <input class="button floatRight" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="button" value="Edit" onclick="goToURL('EditDetails.php?action=Update&ProjectId=<?php echo $row_foundRecord['Id']; ?>')" />
                <?php endif; ?>
                <h2><?php echo $row_foundRecord['Name']; ?></h2>
                <p><?php echo $row_ProjectDetails['Detail']; ?></p>
            </div>
            
            <!-- TAB TWO ----------------------------------------->
            <div id="projectTab2">
            		
                <div id="lightGreyRightColumn"> 
									<h2>Project Author</h2>
									<?php echo $row_ProjectDetails['Author']; ?> 
                <!--   
                    <img src="_images/user.jpg" alt="Firstname, Lastname">
                    <h3 class="name">Firstname Lastname</h3>
                    <p class="title">Title, School/Org</p>
                    <p>&nbsp;</p>
                    <p><a class="bluebutton">View Projects (7)</a></p>
                    <p>&nbsp;</p>
                    <p>About - Morbi sed massa eu diam egestas posuere sit amet a ante. Vivamus eleifend elementum convallis. Cras interdum ligula ut dolor tincidunt tincidunt. Ma;ecenas ornare tellus et justo scelerisque sodales. Tgestas posuere sit amet a ante. Vivamus eleifend elementum convallis. Cras interdum ligula ut dolor tincidunt tincidunt. Ma;ecenas ornare tellus et justo scelerisque sodales.</p>--> 
              </div>
              	<?php if (isset($editMode)): ?>
              	<input class="button floatRight" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="button" value="Edit" onclick="goToURL('EditCredits.php?action=Update&ProjectId=<?php echo $row_foundRecord['Id']; ?>')" />
                <?php endif; ?>
                <div id="ProjectContributors">
                <h2>Project Contributors</h2>
               	<?php echo $row_ProjectDetails['Contributor']; ?>
              </div>
              </div>
            <!-- TAB THREE ----------------------------------------->
            <div id="projectTab3">
            	<?php if (isset($editMode)): ?>
            		<input class="button floatRight" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="button" value="Edit" onclick="goToURL('EditTeacherNotes.php?action=Update&ProjectId=<?php echo $row_foundRecord['Id']; ?>')" /> 							<?php endif; ?>
							<?php echo $row_ProjectDetails['Teacher']; ?>
            </div>
          </div>
 
            
           <!-- FOOTER ---------------------------------------------> 
            <div id="GeneralFooterDiv">
            <a href="http://www.teachingawards.com/home" target="_blank"><img src="_images/logo_teachingawards.gif" alt="Pearson Teaching Awards"></a>
            <!--a href="http://www.si.edu" target="_blank"><img src="_images/logo_smithsonian.gif" alt="Smithsonian"></a-->
            <a href="http://www.pearsonfoundation.org" target="_blank"><img src="_images/logo_pearsonfound.gif" alt="Pearson Teaching Awards"></a>
            <a href="http://www.nationalmockelection.org" target="_blank"><img src="_images/logo_myvoice.gif" alt="My Voice My Election"></a>
        	</div>
        </div>
		</div>
	</div>
</div>

</body>
</html>
<?php
mysql_free_result($foundRecord);

mysql_free_result($ProjectDetails);
?>
