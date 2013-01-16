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
			padding-top: 60px;
			padding-bottom: 40px;
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
		.carousel {
			position: fixed;
			top: 100px;
			left: 0px;
			width: auto;
			margin-top: 0px;
			margin-bottom: 30px;
			margin-left:0px;
			margin-right:0px;
			border-left:#CCC;
			border-left-width: 30px;
			border-left-style:solid;
			border-right:#CCC;
			border-right-width: 30px;
			border-right-style:solid;	
		}
		.item-inner {
			margin-left: 60px;
			margin-right: 60px;
			height: 500px;
			overflow: hidden;
			background-color: #E3E3E3;
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
			padding: 0px;
			width: 100%;
			height: 500px;
			margin:0px;
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
			font-weight:400;
			letter-spacing: 2px;
			width: 200px;
			height: 22px;
			-webkit-border-radius: 15px;
			-moz-border-radius: 15px;
			border-radius: 15px;
		}
		.carousel-caption {
			position: relative;
			float:left;
			width:100%;
			height: 60px;
			padding:30px;
			background-color:#FFFFFF;
			margin: 0px;
		}
		.carousel-caption p {
			color: #000;
		}
		.browserUnitTitle {
			font-size:40px;
			padding-top:10px;
			font-weight:100;
		}
		.carousel-control {
			position:fixed;
			top: 100px;
			left: 0px;
			width: 30px;
			height:500px;
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
              <li><a href="#">Grade II ELA</a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container">

      <!--  Carousel -->
      <!--  consult Bootstrap docs at http://twitter.github.com/bootstrap/javascript.html#carousel -->
      <div id="unit-carousel-id" class="carousel slide">
        <div class="carousel-inner">
              <div class="item active">
              	<div class="item-inner">
                    <div class="carousel-caption">
                        <p>UNIT 1:</p>
                        <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
                    <div class="carousel-content">
                        <p>One way to understand America is to read its literature. In this unit, you will read many stories and begin to see their connection to American life, experience, and history. In Episode 1, you will recall what you know about the genre of short stories. After reading “Orange” by Neil Gaiman, a story that uses an unusual format, you will continue to explore and define short stories. Steven Millhauser’s essay, “The Ambition of the Short Story,” makes some interesting claims about short stories as the writer compares them to novels. First and foremost, you will read the essay to comprehend Millhauser’s ideas, but you will also examine his writing style and organization in preparation for writing a comparison/contrast essay later in the unit.</p>
                    	<div class=" pagination-centered">
                        <a href="CC_EpisodeBrowser.php" class="btn btn-large btn-primary cc-start-btn" >START</a>
                        </div>
                    </div>
              	</div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="carousel-caption">
                      <p>UNIT 2:</p>
                      <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
					<div class="carousel-content">
                    <a href="http://pearsonfoundation.org">
                        <img src="img/cc_mockups/285.jpg" alt="" />
                    </a>
                    </div>
                </div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="carousel-caption">
                      <p>UNIT 3:</p>
                      <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
					<div class="carousel-content">
                    <a href="http://pearsonfoundation.org">
                        <img src="img/cc_mockups/285.jpg" alt="" />
                    </a>
                    </div>
                </div>
              </div>
              
        </div><!-- .carousel-inner -->
        <!--  next and previous controls here href values must reference the id for this carousel -->
          <a class="carousel-control left" href="#unit-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control right" href="#unit-carousel-id" data-slide="next">&nbsp;</a>
      </div>
     
      <!-- .carousel -->
      <!-- end carousel -->

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
			
		$('#unit-carousel-id').carousel();
		});
    </script>

  </body>
</html>