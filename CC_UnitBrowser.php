<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Units</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet">
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet">   

  </head>

  <body>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="CC_UnitBrowser.php" class="parent"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="#">Grade II ELA</a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container">

      <!--  Carousel -->
      <!--  consult Bootstrap docs at http://twitter.github.com/bootstrap/javascript.html#carousel -->
      <div id="unit-carousel-id" class="carousel slide unit-carousel">
        <div class="carousel-inner">
              <div class="item active">
              	<div class="item-inner">
                    <div class="unit-carousel-caption">
                        <p>UNIT 1:</p>
                        <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
                    <div class="unit-carousel-content">
                        <p>One way to understand America is to read its literature. In this unit, you will read many stories and begin to see their connection to American life, experience, and history. In Episode 1, you will recall what you know about the genre of short stories. After reading “Orange” by Neil Gaiman, a story that uses an unusual format, you will continue to explore and define short stories. Steven Millhauser’s essay, “The Ambition of the Short Story,” makes some interesting claims about short stories as the writer compares them to novels. First and foremost, you will read the essay to comprehend Millhauser’s ideas, but you will also examine his writing style and organization in preparation for writing a comparison/contrast essay later in the unit.</p>
                    	<div class="pagination-centered">
                        <a href="CC_EpisodeBrowser.php" class="btn btn-large btn-primary cc-start-btn transition" >START</a>
                        </div>
                    </div>
              	</div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="unit-carousel-caption">
                      <p>UNIT 2:</p>
                      <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
					<div class="unit-carousel-content">
                    <a href="http://pearsonfoundation.org">
                        <img src="img/cc_mockups/285.jpg" alt="" />
                    </a>
                    </div>
                </div>
              </div>
              <div class="item">
              	<div class="item-inner">
                    <div class="unit-carousel-caption">
                      <p>UNIT 3:</p>
                      <p class="browserUnitTitle">Lorem Ipsum Dolor</p>
                    </div>
					<div class="unit-carousel-content">
                    <a href="http://pearsonfoundation.org">
                        <img src="img/cc_mockups/285.jpg" alt="" />
                    </a>
                    </div>
                </div>
              </div>
              
        </div><!-- .carousel-inner -->

          <a class="carousel-control unit-carousel-control left" href="#unit-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control unit-carousel-control right" href="#unit-carousel-id" data-slide="next">&nbsp;</a>
      </div><!-- .carousel -->
      
      <!-- end carousel -->

    </div> <!-- /container -->


    <script type='text/javascript' src="http://code.jquery.com/jquery-latest.js"></script>
	<script type='text/javascript' src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
    <script type='text/javascript' src="js/bootstrap-carousel.js"></script>

    <script>
		$(document).ready(function(){
			
			$('body').css('display', 'none');
			$('body').fadeIn(2000);
			$("a.transition").click(function(event){
				event.preventDefault();
				linkLocation = this.href;
				$("body").fadeOut(1000, redirectPage);      
			});
			function redirectPage() {
				window.location = linkLocation;
			}
			
			
			$('.carousel').carousel({
			  interval: false,
			  pause: true
			});
		});
    </script>

  </body>
</html>
