<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Browse Lessons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet"/>
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet"/>
    
    <style type="text/css">
	
	   .lesson-carousel .carousel-pills {
		  display:block;
		}
		
		.lessonNavigation {
			display:none;
		}

    </style>

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
              <li class="active"><a href="CC_UnitBrowser.php" class="parent transition"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="CC_UnitBrowser.php" class="parent transition">Grade II ELA</a></li>
              <li><a href="CC_EpisodeBrowser.php" class="parent">Unit 1</a></li>
              <li><a href="#">Episode 1: Title, Lesson x</a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->
    
    
  <div class="container" style="padding-top:80px;">
    
    <!--  Carousel -->
    <div id="lesson-carousel-id" class="carousel slide lesson-carousel">
        <div class="carousel-inner">
        
        
          <div class="item active">
              	<div class="lesson-carousel-item-inner">
                    <div class="lesson-carousel-caption">
                        <div class="row-fluid">
                            <div class="span12" style="color:#FFF;">
                                <img src="_images/CC_UI/cc_ela_worktime.png" style="float:left; padding-right:10px;"/>
                                <p class="lessonTypeHeading">OPENING</p>
                                <H1>Common Writing</H1>
                            </div><!-- /.span -->
                        </div><!-- /.row fluid -->
                    </div>
                    <div class="lesson-carousel-content">
                         <div class="row-fluid">
                            <div class="span8 offset2 lessonContent">
                                <p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <p>Ised nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. </p>
                            </div><!-- /.span -->
                        </div><!-- /.row fluid -->
                    </div><!-- /.lesson-carousel-content-->
              	</div><!-- /.item-inner -->
              </div><!-- /.item -->
              
              <div class="item">
              	<div class="lesson-carousel-item-inner">
                    <div class="lesson-carousel-caption">
                        <div class="row-fluid">
                            <div class="span12" style="color:#FFF;">
                                <img src="_images/CC_UI/cc_wholegroupshare.png" style="float:left; padding-right:10px;"/>
                                <p class="lessonTypeHeading">IDENTIFYING KEY IDEAS AND DETAILS</p>
                                <H1>Whole Class Share</H1>
                            </div><!-- /.span -->
                        </div><!-- /.row fluid -->
                    </div>
                    <div class="lesson-carousel-content">
                         <div class="row-fluid">
                            <div class="span8 offset2 lessonContent">
                                <p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <p>Ised nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
                            </div><!-- /.span -->
                        </div><!-- /.row fluid -->
                    </div><!-- /.lesson-carousel-content-->
              	</div><!-- /.item-inner -->
              </div><!-- /.item -->
              
              
		</div><!-- .carousel-inner -->

          <a class="carousel-control lesson-carousel-control left" href="#lesson-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control lesson-carousel-control right" href="#lesson-carousel-id" data-slide="next">&nbsp;</a>
      </div><!-- .carousel -->
     
  </div> <!-- /container -->
    
	
    <div class="navbar-fixed-bottom lessonNavigation">
        <div class="pagination pagination-centered">
            <ul>
                <li><a href="#">&lt;</a></li>
                <li>
                  <a href="#" id="lesson-ribbon" data-placement="top" rel="popover" data-original-title="In Lesson 1:">1</a>
                    <div id="popover-content" style="display: none">
                        <div class="ribbon">
                          <div class="ribbon-item">
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                                <p class="ribbon-item-number">1</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                
                          </div>
                          <div class="ribbon-item">
                                <p class="ribbon-item-number">2</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                          </div>
                          <div class="ribbon-item">
                                <p class="ribbon-item-number">3</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                          </div>
                          <div class="ribbon-item">
                                <p class="ribbon-item-number">4</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                          </div>
                          <div class="ribbon-item">
                                <p class="ribbon-item-number">5</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                          </div>
                          <div class="ribbon-item">
                                <p class="ribbon-item-number">6</p>
                                <p class="ribbon-item-title">Title</p>
                                <p class="ribbon-item-description">Discription fusce mollis augue at nunc blandit accumsan. Donec id ante lacinia velit viverra ullamcorper. </p>
                                <img class="ribbon-item-image" src="_images/placeholder_img.gif">
                          </div>
                      </div><!-- end of ribbon -->
                    </div><!-- popover content -->
                </li>
                <li><a href="#">&gt;</a></li>
            </ul>
      </div><!-- end pagination centered -->
    </div><!-- end bottom navbar -->
    
    
  <script type='text/javascript' src="http://code.jquery.com/jquery-latest.js"></script>
  <script type='text/javascript' src="js/jquery.mobile.custom.min.js"></script>

  <script type='text/javascript' src="js/bootstrap.js"></script>
  <script type='text/javascript' src="js/bootstrap-carousel.js"></script> 
  <script type='text/javascript' src="js/bootstrap-tooltip.js"></script>
  <script type='text/javascript' src="js/bootstrap-popover.js"></script>
    
  <script>
		$(document).ready(function(){
			
			$('body').css('display', 'none');
			$('body').fadeIn(1000);
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
			$(".carousel").swiperight(function() {  
			  $(".carousel").carousel('prev');  
			});  
		    $(".carousel").swipeleft(function() {  
			  $(".carousel").carousel('next');  
		    });
						 
		
			$('#lesson-ribbon').popover({ 
			html : true,
			content: function() {
			  return $('#popover-content').html();
			}
			});
			
		});
	</script>  

  </body>
</html>
