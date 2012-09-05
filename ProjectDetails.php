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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Projector Spec</title>
<style type="text/css">
body {
	background-color: #eeeeee;
}
body, td, th {
	font-family: "Helvetica Neue", "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.centeredText {
	text-align: center;
}
.projectorTitle {
	font-size: 16px;
	letter-spacing: 0.01em;
	line-height: 20px;
	margin: 10px;
}
#ContentDiv {
	margin: 20px;
}
th {
	padding: 3px;
}
td {
	padding: 3px;
}
.projectInfo {
	float: left;
	background-color: #FFF;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 20px;
	padding-right: 20px;
	width: 600px;
}
#projectDiv #imgPlaceHolder {
	float: left;
}
#projectDiv {
	margin-top: 20px;
	width : 940px;
	height: 200px;
	background-color: #FFF;
	float: left;
}
.projectInfo h2 {
	margin-top: 5px;
	margin-bottom: 5px;
	font-weight: 400;
	font-size: 15px;
}
.projectData {
	font-size: 12px;
}
#title {
	width: 940px;
	margin-top: 20px;
	color: #666;
	font-size: 24px;
}
#titleNav {
	float: right;
	display: inline;
	vertical-align: middle;
}
#projectName {
	float: left;
}
#ContentDiv {
	margin-right: auto;
	margin-left: auto;
	width: 940px;
}
#ContentTab {
	margin-top: 20px;
	margin-bottom: 20px;
	margin-right: auto;
	margin-left: auto;
	width: 940px;
}
#backToGallery {
}
.toolIcon {
	background-color: #00ADEF;
	width: 26px;
	height: 26px;/*float : left;
	display:inline; */
}
#editButton {
	float: right;
}
#startChallenge {
	float: right;
}

#details {
	font-size: 12px;
}
</style>
<link href="_css/main.css" rel="stylesheet" type="text/css" />
<!--<link href="_css/Project.css" rel="stylesheet" type="text/css" /> -->
<link href="jquery-ui-1.8.21/css/custom-theme/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.21/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	
	function goToURL(url) {
		window.location = url;
	}
</script>
</head>

<body>
<!-- Header -->
<div id="HeaderBgDiv">
  <div id="HeaderDiv">
    <div id="HeaderImg"> <a href="#"><img src="images/headerlogo.png" width="48" height="24" /></a> 
      <!--<span class="projectorTitle">The Projector</span> -->
      <h1>The Projector</h1>
    </div>
  </div>
</div>

<!-- Navigation -->
<div id="NavDiv">
  <div id="NavHome" class="NavItemUp"> <a class="navUp" href="index.php">HOME</a> </div>
  <div id="NavGallery" class="NavItemDown"> <a class="navDown" href="Gallery.php">PROJECT GALLERY</a> </div>
  <div id="NavAbout" class="NavItemUp"> <a class="navUp" href="About.php">ABOUT</a> </div>
  <div id="NavSearchContainter">
    <div id="NavSearchTextContainer">
      <input type="text" id="NavSearchText" placeholder="Search ..." />
    </div>
    <!--             <div id="NavSearch">
                   Search ...--> 
    <!--form id="searchbox" action="">
                    <input type="text" id="NavSearch" value="Search ...">
        
                    </form-->
    <input type="submit" class="searchButton" id="submit" value="" />
  </div>
</div>
<div class="clearFloat" />

<!-- Content -->
<div id="ContentDiv">
  <div id="title">
    <div id="projectName"> <?php echo $row_foundRecord['Name']; ?></div>
    <form action="EditProject.php" method="get">
      <div id="titleNav"> <a href="Gallery.php"><img src="../images/back_to_gallery.gif" id="backToGallery" width="120" height="26" alt="Back to Gallery" /></a>#
        <input name="Id" type="text" id="Id" value="<?php echo $row_foundRecord['Id']; ?>" size="5" readonly="readonly" />
        <input class="button" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="submit" value="Edit" />
        <!-- <input class="button" style="background-image: url(icons/delete26x26.fw.png);" name="action" type="submit" value="Delete" /> -->
      </div>
    </form>
  </div>
  <div id="projectDiv"> <img src="<?php echo $row_foundRecord['ImgSmall']; ?>" alt="" name="imgPlaceHolder" id="imgPlaceHolder" width="300" height="200"/>
    <div class="projectInfo">
      <h2>Challenge Objective:</h2>
      <div class="projectData"><?php echo $row_foundRecord['Description']; ?></div>
      <h2>Challenge Duration:</h2>
      <div class="projectData"><?php echo $row_foundRecord['Duration']; ?></div>
      <h2>Subject Areas:</h2>
      <div class="projectData"><?php echo $row_foundRecord['Subject']; ?></div>
      <h2>Grade Level:</h2>
      <div class="projectData"><?php echo $row_foundRecord['GradeMin']; ?> - <?php echo $row_foundRecord['GradeMax']; ?></div>
    </div>
  </div>
</div>
<div class="clearFloat"></div>
<div id="ContentTab">
  <div id="tabs">
    <ul>
      <li><a href="#tabs-1">CHALLENGE DETAILS</a></li>
      <li><a href="#tabs-2">COMMUNITY</a></li>
      <li><a href="#tabs-3">STUDENT GALLERY</a></li>
    </ul>
    <div id="tabs-1">
      <div id="projectDetails">
     
        <input id="editButton" class="button" style="background-image: url(icons/Writing.fw.26x26png.png);" name="action" type="button" value="Edit" onclick="goToURL('EditDetails.php?action=Update&ProjectId=<?php echo $row_foundRecord['Id']; ?>')" /> <input id="startChallenge" class="button" style="" name="action" type="button" value="Start Challenge" onclick="goToURL('ChallengeTemplate.php?ProjectId=<?php echo $row_foundRecord['Id']; ?>')" />
        <h3><?php echo $row_foundRecord['Name']; ?> </h3>
        <div id="details"> <?php echo $row_ProjectDetails['Detail']; ?> </div>
      </div>
     <!-- <div id="resources">
        <h2>Start the challenge</h2>
        <p>You can work through the challenge online or you can download it in a PDF format</p>
        <hr/>
        <h3>Online Challenge</h3>
        <p>Nunc et felis quis purus rhoncus venenatis vitae a mi. In scelerisque malesuada diam, vitae semper eros hendrerit nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
        <p><a href="ChallengeContent.html" class="bluebutton">Start the Challenge</a></p>
        <hr/>
        <h3>Download the PDF (1.8MB)</h3>
        <p>Nunc et felis quis purus rhoncus venenatis vitae a mi. In scelerisque malesuada diam, vitae semper eros hendrerit nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
        <p><a href="_pdfs/CulturalVibrations_author template.pdf">Download the challlenge</a></p>
      </div> -->
    </div>
    <div id="tabs-2">
      <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    </div>
    <div id="tabs-3">
      <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
      <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
    </div>
  </div>
</div>
<div id="footer"> &copy;2012 Pearson Foundation </div>
</body>
</html>
<?php
mysql_free_result($foundRecord);

mysql_free_result($ProjectDetails);
?>
