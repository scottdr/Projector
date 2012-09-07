<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Projector Home</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="Project.css" rel="stylesheet" type="text/css">
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
			pause: 8000,
			hoverPause: true
		});
	});
</script>
<style type="text/css"> 
body {
	background-color: #343434;
	background-image:url(http://labs.pearsonfoundation.org/_images/Bourgeois_Louise-Crouching_Spider.jpg);
	background-position:top;
	background-repeat: no-repeat;
	background-size: 150% auto;
	-webkit-background-size: 150% auto;
	-moz-background-size: 150% auto;
	-o-background-size: 150% auto;
}
.pagination {
	clear:both;
	margin-left: auto;
	margin-right: auto;
	padding: 0px;
	width: 170px;
	overflow:hidden;
}
.pagination ul ol {
	margin: 0px;
	padding: 0px;
	text-indent: 0px;
	list-style-type: none;
	text-align: center;
	display: block;
	left: 0px;
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
	background-image:url(_images/home_banner_dot_down.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}

.pagination li.current a {
	width:12px;
	height:0px;
	padding-top:24px;
	background-image:url(_images/home_banner_dot_up.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}


</style>

</head>

<body>

<body>

    <div class="gridContainer clearfix">
    </div> 
    <div class="ProjGalleryBackgroundDiv">
  
        <!-- HEADER AND NAVIGATION --------------------------------------------->
        <?php $selectedNav = "NavHome"; ?>
        <?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div> 
        
        <!-- BANNER --------------------------------------------->
        <div id="HomeBannerDiv">
        
            <p>The Projector is a free, community-driven set of high-quality projects for classrooms everywhere. It provides interdiscipliary, authentic experiences that blend informal and formal learning environments.  <a href="About.php">Read more.</a></p>
            <hr>
            <div id="slides">
                <div id="HomeBannerRotatorPrevious">
                    <a href="#" class="prev"><img src="http://labs.pearsonfoundation.org/_images/arrow-left-blue.png" alt="previous item"></a>
                </div>
                <div id="HomeBannerRotator">
                        <div class="slides_container">
                            <?php require_once("SlideShowDivData.php"); ?>
                        </div>
                </div>
                <div id="HomeBannerRotatorNext">
                    <a href="#" class="next"><img src="http://labs.pearsonfoundation.org/_images/arrow-right-blue.png" alt="next item"></a>
                </div>  
        	</div>
    </div>           
        
        <!-- FOOTER --------------------------------------------->
        <div id="HomeFooterDiv">
            <a href="http://www.teachingawards.com/home" target="_blank"><img src="http://labs.pearsonfoundation.org/_images/logo_teachingawards.gif" alt="Pearson Teaching Awards"></a>
            <!--a href="http://www.si.edu" target="_blank"><img src="http://labs.pearsonfoundation.org/_images/logo_smithsonian.gif" alt="Pearson Teaching Awards"></a-->
            <a href="http://www.pearsonfoundation.org" target="_blank"><img src="http://labs.pearsonfoundation.org/_images/logo_pearsonfound.gif" alt="Pearson Teaching Awards"></a>
        </div>
    


</body>
</html>