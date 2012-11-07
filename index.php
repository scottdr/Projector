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

<script type="text/javascript" src="jquery-ui-1.8.23.custom/js/jquery-1.8.0.min.js"></script>
<!--<script type="text/javascript" src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>-->
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: 'images/loading.gif',
			play: 0,
			pause: 8000,
			hoverPause: true,
			slideSpeed: 1000
			});
		
		// load the background image for the first carousel item / project
		var carouselItem = document.getElementById("carouselItemNumber1");
		var elem = document.getElementById("HomeBackgroundDiv");
		elem.setAttribute("style","background-image: " + "url(" + carouselItem.getAttribute("data-imageURL") + ");");
	});
	
		// do a fadeout (fast) then a fade back in (slow) 
	function slideTransition(url) {
		img = new Image();	// this is doing a preload of the image using javascript so that when we set the background via css using jQuery below after the 1 second fadeOut it has hopefully already loaded!
		img.src = url;
		$('#HomeBackgroundDiv').animate( {opacity: .5} , 500, "swing", function() {				// fade out old background image to 50% opacity for half a second
				// Animation complete
				$(this).css("opacity", ".5");				// set background image opacity at 50% 
				$(this).css("background-image",'url("' + url + '")');		// set the background image to the url for next / prev slide
				$(this).animate({opacity: 1} , 500, "swing");			// toggle visibility fading the image back in to view over half a second using swing easing
		});
	}
	
	// when the user clicks on little boxes to skip to a specific project	
	function navHandler(e) {
		if (e.currentTarget.text > 0) {
			var carouselItem = document.getElementById("carouselItemNumber" + e.currentTarget.text);
			var imageUrl = carouselItem.getAttribute("data-imageURL");
			slideTransition(imageUrl);
		}
	}
	
	currentProject = 1;
	jQuery(document).ready(function(e) {
		var numProjects = 0;
		var backgroundDiv = document.getElementById("HomeBackgroundDiv");
		var elem = document.getElementById("carouselCounter");
		if (elem)
			numProjects = elem.getAttribute("value");

	

			
		jQuery(".next").bind("click",function(e){			
				if (currentProject < numProjects)
					currentProject++;
				else 
					currentProject = 1;
				var carouselItem = document.getElementById("carouselItemNumber" + currentProject);
				var imageUrl = carouselItem.getAttribute("data-imageURL");
				slideTransition(imageUrl);
		});
		
		jQuery(".prev").click(function(e){
					var elem = document.getElementById("HomeBackgroundDiv");
				if (currentProject > 1)
					currentProject--;
				else 
					currentProject = numProjects;
				var carouselItem = document.getElementById("carouselItemNumber" + currentProject);
				var imageUrl = carouselItem.getAttribute("data-imageURL");
				slideTransition(imageUrl);
		});
		
		// add handler to be called when user clicks in the little boxes to go to a specific project
		jQuery(".pagination a").click(navHandler);
  });
</script>
<style type="text/css"> 
/*pagination is used in the banner*/
.pagination {
	clear:both;
	position:relative;
	display: block;
	margin-left: 68px;
	padding-top: 10px;
	padding-left: 0px;
	width: 400px;
	height: 9px;
	overflow:hidden;
}
.pagination ul ol {
	position:relative;
	display: block;
	margin: 0px;
	padding: 0px;
	text-indent: 0px;
	list-style-type: none;
	text-align: center;
	
}
.pagination li {
	text-indent: 0px;
	left: 0px;
	text-align:center;
	margin:0px;
	list-style:none;
}

.pagination a {
	width:9px;
	height:0px;
	padding-top:24px;
	margin-left:0px;
	margin-top:0px;
	margin-bottom:0px;
	margin-right:5px;
	background-image:url(_images/home_banner_square_up.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}

.pagination li.current a {
	width:9px;
	height:0px;
	margin-left:0px;
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
    
        <!-- HEADER AND NAVIGATION -->
        <?php $selectedNav = "NavHome"; ?>
        <?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div>
               
        <!-- BANNER -->

        <div id="HomeBannerDiv">
        
            <p>The Projector is a free, community-driven set of high-quality projects for classrooms everywhere. It provides interdisciplinary, authentic experiences that blend informal and formal learning environments.  <br/><a href="About.php">Read more.</a></p>
            <hr />
            <a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>"><img src="<?php echo $row_FeaturedProject['LargeIcon']; ?>" alt="<?php echo $row_FeaturedProject['Name']; ?>" /></a>
            <p style="font-size:14px; padding-top:5px;">This month ...</p>
            <h1><a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>"><?php echo $row_FeaturedProject['Name']; ?></a></h1>
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
            </div><input type="hidden" id="carouselCounter" value="<?php echo $numProjects; ?>" />

            <div class="viewAllProjects"><p><a href="Gallery.php">View all projects</a></p></div>
</div>
                  
        
        <!-- FOOTER -->
        <div id="FooterHomeDiv" style="z-index:-3;">
            <?php include("GeneralFooter.php"); ?>
        </div>
        
        <!-- BACKGROUND IMAGES -->
        <div id="HomeBackgroundWrapper">
        	<div id="HomeBackgroundDiv">
        	</div>
       </div>


</body>
</html>
<?php
mysql_free_result($FeaturedProject);
?>
