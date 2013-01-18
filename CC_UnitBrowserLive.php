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

$colname_CourseInfo = "-1";
if (isset($_GET['CourseId'])) {
  $colname_CourseInfo = $_GET['CourseId'];
}
mysql_select_db($database_projector, $projector);
$query_CourseInfo = sprintf("SELECT Name FROM Courses WHERE Id = %s", GetSQLValueString($colname_CourseInfo, "int"));
$CourseInfo = mysql_query($query_CourseInfo, $projector) or die(mysql_error());
$row_CourseInfo = mysql_fetch_assoc($CourseInfo);
$totalRows_CourseInfo = mysql_num_rows($CourseInfo);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Units</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet"/>
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet"/>

  </head>

  <body>
  
  <div class="img-background">
  	<img src="_images/CC_UI/dkgray-background.png">
  </div>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="/editor/CC_CourseBrowser.php" class="parent"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="#"><?php echo $row_CourseInfo['Name']; ?></a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container">

      <!--  Carousel -->
      <div id="unit-carousel-id" class="carousel slide unit-carousel">
        <div class="carousel-inner">
        				<?php require("_php/CC_UnitBrowserContent.php"); ?>
<!--              <div class="item active">
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
              </div>-->
              
        </div><!-- .carousel-inner -->

          <a class="carousel-control unit-carousel-control left" href="#unit-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control unit-carousel-control right" href="#unit-carousel-id" data-slide="next">&nbsp;</a>
      </div><!-- .carousel -->
      
      <!-- end carousel -->

    </div> <!-- /container -->


    <script type='text/javascript' src="http://code.jquery.com/jquery-latest.js"></script>
    <script type='text/javascript' src="js/jquery.mobile.custom.min.js"></script>
    
	<script type='text/javascript' src="js/bootstrap.js"></script>
	<script type='text/javascript' src="js/bootstrap-carousel.js"></script>

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
			 
		});
    </script>

  </body>
</html>
<?php
mysql_free_result($UnitList);

mysql_free_result($CourseInfo);
?>
