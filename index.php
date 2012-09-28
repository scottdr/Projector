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

mysql_select_db($database_projector, $projector);
$query_FeaturedProject = "SELECT * FROM Topics WHERE Featured = 1";
$FeaturedProject = mysql_query($query_FeaturedProject, $projector) or die(mysql_error());
$row_FeaturedProject = mysql_fetch_assoc($FeaturedProject);
$totalRows_FeaturedProject = mysql_num_rows($FeaturedProject);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Projector Home</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css" />
<link href="_css/Root_Project.css" rel="stylesheet" type="text/css" />
<link href="_css/main.css" rel="stylesheet" type="text/css" />	

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: 'images/loading.gif',
			play: 4000,
			pause: 8000,
			hoverPause: true
		});
	});
</script>
<style type="text/css"> 
/*pagination is used in the banner*/
.pagination {
	clear:both;
	margin-left: 64px;
	padding: 0px;
	width: 400px;
	overflow:hidden;
}
.pagination ul ol {
	margin: 0px;
	padding: 0px;
	text-indent: 0px;
	list-style-type: none;
	text-align: center;
	display: block;
}
.pagination li {
	text-indent: 0px;
	left: 0px;
	text-align:center;
	margin:0px 1px;
	list-style:none;
}

.pagination a {
	width:12px;
	height:0px;
	padding-top:24px;
	background-image:url(_images/home_banner_square_up.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}

.pagination li.current a {
	width:12px;
	height:0px;
	padding-top:24px;
	background-image:url(_images/home_banner_square_down.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}


</style>

</head>

<body>

    <div class="gridContainer clearfix">
    </div> 
    
        <!-- HEADER AND NAVIGATION --------------------------------------------->
        <?php $selectedNav = "NavHome"; ?>
        <?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div>
               
        <!-- BANNER ------------------------------------------- -->

        <div id="HomeBannerDiv">
        
            <p>The Projector is a free, community-driven set of high-quality projects for classrooms everywhere. It provides interdisciplinary, authentic experiences that blend informal and formal learning environments.  <br/><a href="About.php">Read more.</a></p>
            <hr />
            <a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>"><img src="<?php echo $row_FeaturedProject['LargeIcon']; ?>" alt="<?php echo $row_FeaturedProject['Name']; ?>" /></a>
            <p style="font-size:16px; padding-top:5px;">This month ...</p>
            <h2><a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>"><?php echo $row_FeaturedProject['Name']; ?></a></h2>
            <p><?php echo $row_FeaturedProject['TagLine']; ?></p>
            <hr />
            <div id="slides">
                <div id="HomeBannerRotatorPrevious">
                    <a href="#" class="prev"><img src="_images/arrow-left-blue.png" alt="previous item" width="64" height="64"></a>
                </div>
                <div id="HomeBannerRotator">
                        <div class="slides_container">
                            <?php require_once("SlideShowDivData.php"); ?>
                        </div>
                </div>
                <div id="HomeBannerRotatorNext">
                    <a href="#" class="next"><img src="_images/arrow-right-blue.png" alt="next item" width="64" height="64"></a>
                </div>  
            </div>
    	</div>
                  
        
        <!-- FOOTER --------------------------------------------->
        <div id="HomeFooterDiv">
            <a href="http://www.teachingawards.com/home" target="_blank"><img src="_images/logo_teachingawards.gif" alt="Pearson Teaching Awards" /></a>
            <!--a href="http://www.si.edu" target="_blank"><img src="_images/logo_smithsonian.gif" alt="Smithsonian"></a-->
            <a href="http://www.pearsonfoundation.org" target="_blank"><img src="_images/logo_pearsonfound.gif" alt="Pearson Teaching Awards" /></a>
            <a href="http://www.nationalmockelection.org" target="_blank"><img src="_images/logo_myvoice.gif" alt="My Voice My Election" /></a>
            <p>&copy; Pearson Foundation 2012 | <a href="mailto:labs@pearsonfoundation.org">Contact</a> | <a href="TermsConditions.php">Terms and Conditions</a></p>
        	
        </div>
        
        
        <!-- BACKGROUND IMAGES --------------------------------------------->
        <div id="HomeBackgroundWrapper">
        	<div id="HomeBackgroundDiv">
        	</div>
       </div>


</body>
</html>
<?php
mysql_free_result($FeaturedProject);
?>
