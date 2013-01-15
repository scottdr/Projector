<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Units</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif;
			font-weight: 300;
			background-color: #242424;
		}
		.navbar .nav > li > a {
			float: none;
			padding: 12px 15px 10px;
		}
		.navbar .nav > li > a.parent {
			background-image:url(_images/CC_UI/breadcrumbDivider.png);
			background-position:right;
			background-repeat:no-repeat;
			background-size:contain;
		}
		.unitInfo {
	position: fixed;
	top: 40px;
	left: 0px;
	bottom: 0px;
	width: 30%;
	margin: 0px;
	border: 0px;
	background-color: #E3E3E3;
	/* Firefox v3.5+ */
	-moz-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
	/* Safari v3.0+ and by Chrome v0.2+ */
	-webkit-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		}
		.unitHeader {
			margin:0px;
			padding-right:30px;
			padding-top:30px;
			padding-left:60px;
			padding-bottom:25px;
			background-color:#FFF;
		}
		.unitHeader h1 {
			font-size:26px;
			font-weight:200;
			line-height:30px;
			margin:0px;
			padding:0px;
		}
		.unitHeader p {
			font-size:16px;
			font-weight:200;
			line-height:20px;
			margin:0px;
			padding:0px;
		}
		.unitBody {
			margin: 0px;
			padding-right: 30px;
			padding-top: 30px;
			padding-left: 60px;
		}
		.unitBody p {
			font-size:18px;
			font-weight:200;
			line-height:24px;
		}
		.carousel {
			position: fixed;
			top: 40px;
			right: 0px;
			width: 70%;
			margin-top: 0px;
			margin-bottom: 30px;
			margin-left: 0px;
			margin-right: 0px;
			border: 0px;
		}
		.item-inner {
			margin-left: 60px;
			margin-right: 60px;
			height: 560px;
			overflow: hidden;
			background-color:#3E3E3E;
		}
		.carousel img {
			width: 100%;
			overflow:hidden;
		}
		.carousel .item {
		  -webkit-transition: 0.9s ease-in-out left;
			 -moz-transition: 0.9s ease-in-out left;
			   -o-transition: 0.9s ease-in-out left;
				  transition: 0.9s ease-in-out left;
		}
		.carousel-content {
			position: relative;
			float: left;
			clear: both;
			padding-left: 30px;
			padding-right: 30px;
			height: 560px;
			margin: 0px;
		}
		.carousel-content p {
			margin-left: 30px;
			margin-right: 30px;
			margin-top: 20px;
			padding: 0px;
			font-size:20px;
			line-height:26px;
			padding-top:10px;
			font-weight:100;
		}
		.cc-start-btn {
			margin-top:30px;
			border-color:#FFF;
			border-style:solid;
			border-width: 3px;
			font-size:14px;
			font-weight:600;
			letter-spacing: 2px;
			width: 200px;
			height: 55px;
			-webkit-border-radius: 15px;
			-moz-border-radius: 15px;
			border-radius: 15px;
		}
		.carousel-caption {
			position: relative;
			float:left;
			width: auto;
			height: 60px;
			padding:30px;
			background-color: transparent;
			margin: 0px;
			overflow:hidden;
		}
		.carousel-caption p {
			color:#FFF;
			background:transparent;
		}
		.browserUnitTitle {
			font-size:40px;
			padding-top:10px;
			font-weight:100;
		}
		.carousel-control {
			position:fixed;
			top: 40px;
			left: 30%;
			width: 30px;
			height:560px;
			margin-top: 0px;
			font-size: 60px;
			font-weight: 100;
			line-height: 30px;
			color: #ffffff;
			text-align: center;
			background-color: #CCCCCC;
			border: 0px solid transparent;
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			border-radius: 0px;
			opacity: 0.2;
			filter: alpha(opacity=20);
		}
		
		.carousel-control.right {
		  right: 0px;
		  left: auto;
		}
		.browserEpisode {
			font-size:16px;
			font-weight:100;
			padding-bottom:10px;
		}
		.browserEpisodeTitle {
			font-size:28px;
			font-weight:100;
			padding-bottom:20px;
		}
		.browserEpisodeDescription{
			font-size:20px;
			font-weight:100;
			line-height:32px;
			padding-bottom:0px;
		}
		.thumbnails {
			margin:0px;
			padding:0px;
		}
		.thumbnail {
			background-color: #333333;
			display: block;
			padding: 0px;
			line-height: 15px;
			border: 0px;
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			border-radius: 0px;
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			-o-transition: all 0.2s ease-in-out;
			transition: all 0.2s ease-in-out;
		}
		.thumbnail a {
		}
		.thumbnail a:hover {
			text-decoration: none;
			background-color:#999;
		}
		.thumbnail h3 {
			color:#FFF;
			font-size:14px;
			font-weight:200;
			line-height: 22px;
			padding: 5px;
			margin: 5px;
		}
				
		@black:                 #000;
		@grayDarker:            #222;
		@grayDark:              #333;
		@gray:                  #555;
		@grayLight:             #999;
		@grayLighter:           #eee;
		@white:                 #fff;
		
		// Drop shadows
		.box-shadow(@shadow) {
		  -webkit-box-shadow: @shadow;
			 -moz-box-shadow: @shadow;
				  box-shadow: @shadow;
		}
		
		// Border Radius
		.border-radius(@radius) {
		  -webkit-border-radius: @radius;
			 -moz-border-radius: @radius;
				  border-radius: @radius;
		}
		
		// Gradients
		#gradient {
		  .vertical(@startColor: #555, @endColor: #333) {
			background-color: mix(@startColor, @endColor, 60%);
			background-image: -moz-linear-gradient(top, @startColor, @endColor); // FF 3.6+
			background-image: -ms-linear-gradient(top, @startColor, @endColor); // IE10
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(@startColor), to(@endColor)); // Safari 4+, Chrome 2+
			background-image: -webkit-linear-gradient(top, @startColor, @endColor); // Safari 5.1+, Chrome 10+
			background-image: -o-linear-gradient(top, @startColor, @endColor); // Opera 11.10
			background-image: linear-gradient(top, @startColor, @endColor); // The standard
			background-repeat: repeat-x;
			filter: e(%("progid:DXImageTransform.Microsoft.gradient(startColorstr='%d', endColorstr='%d', GradientType=0)",@startColor,@endColor)); // IE9 and down
		  }
		}
		
		// Pills for indicating active image
		// ---------------------------------
		
		.carousel-pills {
		  position: absolute;
		  bottom: -30px;
		  left: 0;
		  right: 10px;
		  display: block;
		  text-align: center;
		}
		
		.carousel-pills span {
		  display: inline-block;
		  margin: 0px 5px;
		  width: 8px;
		  height: 8px;
		  border:#999;
		  border-width:1px;
		  border-style:solid;
		  .border-radius(15px);
		  background: @grayDark;
		  @shadow: 0 1px 3px rgba(0,0,0,.25), inset 0 -1px 0 rgba(0,0,0,.1);
		  .box-shadow(@shadow);
		  cursor: pointer;
		
		  &.active-pill {
			#gradient > .vertical(@white, @grayLighter);
		  }
		
		  &:hover {
			background: @grayLighter;
		  }
		}
    </style>
    <link href="_css/bootstrap-responsive.css" rel="stylesheet">

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
              <li class="active"><a href="CC_UnitBrowser.php" class="parent"><i class="icon-home"></i></a></li>
              <li><a href="CC_UnitBrowser.php" class="parent">Grade II ELA</a></li>
              <li><a href="#">Unit 1</a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container">

      <!--  Carousel -->
      <!--  consult Bootstrap docs at http://twitter.github.com/bootstrap/javascript.html#carousel -->
      <div id="episode-carousel-id" class="carousel slide">
        <div class="carousel-inner">
              <div class="item active">
              	<div class="item-inner">
                    <div class="carousel-caption">
                        <p class="browserEpisode">EPISODE 1:</p>
                        <p class="browserEpisodeTitle">Lorem Ipsum Dolor</p>
                        <p class="browserEpisodeDescription">In this episode</p> 
                    </div>
                    <div class="carousel-content">
						<hr/>
                        <div class="row-fluid">
                        
                            <ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Unit Accomplishments</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 1</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 2</h3>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="row-fluid">
                            	<ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 3</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 4</h3>
                                        </div>
                                    </a>
                                    </li>
                            </ul>
                          </div>  
                    </div>
              	</div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="carousel-caption">
                        <p class="browserEpisode">EPISODE 2:</p>
                        <p class="browserEpisodeTitle">Lorem Ipsum Dolor</p>
                        <p class="browserEpisodeDescription">In this episode</p> 
                    </div>
					<div class="carousel-content">
						<hr/>
                        
                        <div class="row-fluid">
                            <ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Unit Accomplishments</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 1</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 2</h3>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="row-fluid">
                            	<ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 3</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 4</h3>
                                        </div>
                                    </a>
                                    </li>
                            </ul>
                          </div>  
                    </div>
				</div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="carousel-caption">
                        <p class="browserEpisode">EPISODE 3:</p>
                        <p class="browserEpisodeTitle">Lorem Ipsum Dolor</p>
                        <p class="browserEpisodeDescription">In this episode</p> 
                    </div>
                    <div class="carousel-content">
						<hr/>
                        <div class="row-fluid">
                        
                            <ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Unit Accomplishments</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 1</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 2</h3>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="row-fluid">
                            	<ul class="thumbnails">
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 3</h3>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="span4">
                                    <a href="#">
                                        <div class="thumbnail">
                                          <img src="img/cc_mockups/thumbnail.png" alt="">
                                          <h3>Lesson 4</h3>
                                        </div>
                                    </a>
                                    </li>
                            </ul>
                          </div>  
                    </div>
                </div>
              </div>
              
        </div><!-- .carousel-inner -->
        <!--  next and previous controls here href values must reference the id for this carousel -->
          <a class="carousel-control left" href="#episode-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control right" href="#episode-carousel-id" data-slide="next">&nbsp;</a>
      </div>
     
      <!-- .carousel -->
      <!-- end carousel -->
	<div class="unitInfo">
    
		<div class="unitHeader">
            <p>UNIT 1</p>
            <H1>Title of the Unit</H1>
        </div>
        <div class="unitBody">
        	<p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. </p>
        	<p>Donec id ante lacinia velit viverra ullamcorper. </p>
        	<ul>
        	  <li>Nunc nec consectetur orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; </li>
        	  <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
   	      </ul>
        </div>
        
    </div><!-- end Unit Info -->

    </div> <!-- /container -->


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!-- Bootstrap jQuery plugins compiled and minified -->
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
    <script type='text/javascript' src="js/bootstrap-carousel.js"></script>
	<script type='text/javascript' src="http://lesscss.googlecode.com/files/less-1.3.0.min.js"></script>
    <script>
		$(document).ready(function(){
			$('.carousel').carousel({
			  interval: 50000
			});
		});
		
		$(window).load(function(){
		/* Add LESS support to the browser */
		(function(){ $('head style[type="text/css"]').attr('type', 'text/less');less.refreshStyles(); })();
			
		$('#episode-carousel-id').carousel();
		});
    </script>

  </body>
</html>
