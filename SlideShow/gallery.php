<?php require_once('../../Connections/projector.php'); ?>
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
$query_featuredProjects = "SELECT * FROM projectGallery";
$featuredProjects = mysql_query($query_featuredProjects, $projector) or die(mysql_error());
$row_featuredProjects = mysql_fetch_assoc($featuredProjects);
$totalRows_featuredProjects = mysql_num_rows($featuredProjects);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Slides, A Slideshow Plugin for jQuery</title>
	
	<link rel="stylesheet" href="css/global.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
	<script src="js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true
			});
		});
	</script>
</head>
<body>
<div id="container">
		<div id="example">
		  <div id="slides">
      	
				<div class="slides_container">
        <?php
				 do {
					 print '<a href="#"><img src="' . $row_featuredProjects['SrcImg'] . '" width="570" height="270" alt="' . $row_featuredProjects['Name'] . '"></img></a>' . "\n";
					} while ($row_featuredProjects = mysql_fetch_assoc($featuredProjects)); 
				?>
					<a href="http://www.flickr.com/photos/jliba/4665625073/" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-1.jpg" width="570" height="270" alt="Slide 1"></a>
					<a href="http://www.flickr.com/photos/stephangeyer/3020487807/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-2.jpg" width="570" height="270" alt="Slide 2"></a>
					
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			<img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
		</div>
		<div id="footer">
			<p>For full instructions go to <a href="http://slidesjs.com" target="_blank">http://slidesjs.com</a>.</p>
			<p>Slider design by Orman Clark at <a href="http://www.premiumpixels.com/" target="_blank">Premium Pixels</a>. You can donwload the source PSD at <a href="http://www.premiumpixels.com/clean-simple-image-slider-psd/" target="_blank">Premium Pixels</a></p>
			<p>&copy; 2010 <a href="http://nathansearles.com" target="_blank">Nathan Searles</a>. All rights reserved. Slides is licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache license</a>.</p>
		</div>
	</div>
</body>
</html>
<?php
mysql_free_result($featuredProjects);
?>
