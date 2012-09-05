<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Projector Home</title>
<link rel="stylesheet" href="_css/slideshow.css">
<link href="_css/main.css" rel="stylesheet" type="text/css" />	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
	<script src="js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'images/loading.gif',
				play: 4000,
				pause: 2500,
				hoverPause: true
			});
		});
	</script>
<style type="text/css"> 
.slides_container {
		width:600px;
		height:380px;
}
.slides_container div {
	width: 600px;
	/* [disabled]height:380px; */
	display: block;
}

.captionBackground { 
  color : #ffffff;
  background-color: #000000; 
  margin: 20px; 
  padding-top: 5px;
	padding-left: 20px; 
	padding-right: 20px; 
  opacity : 0.8;
	min-width:200px;
	max-width:300px;
	height:120px;
	-moz-border-radius : 8px; 
	-webkit-border-radius : 8px;
	border-radius : 8px;
}

.captionLayer {
	color : #ffffff;
	background-color: #000000;
	padding-top: 5px;
	padding-left: 20px;
	padding-right: 20px;
	opacity : 0.7;
	min-width: 200px;
	max-width: 300px;
	height: 70px;
	-moz-border-radius : 8px;
	-webkit-border-radius : 8px;
	border-radius : 8px;
	left: 30px;
	top: 10px;
	position: relative;
}

.captionLayer h2 {
	font-size:1.2em;
	margin-top:10px;
	color : #3AADEF;
}

.captionLayer h3 {
	margin-top:10px;
	color : #fff;
}

#imgDiv {
	width : 600px;
	height : 380px;
	background-color: LightYellow;
	background-image: url(images/backgroundCropped2.jpg);
	background-size:600px 380px;
	background-repeat:no-repeat;
}

</style>

</head>

<body>
<?php $selectedNav = "NavHome"; ?>
<?php include("HeaderNav.php"); ?>
<div id="container">
			<div id="slides">
				<div class="slides_container">
 					<?php require_once("SlideShowDivData.php"); ?>
				</div>
				<a href="#" class="prev"><img src="images/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="images/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
</div>
</body>
</html>