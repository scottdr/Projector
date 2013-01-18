<?php require_once('Globals.php'); ?>
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
$query_CourseInfo = sprintf("SELECT * FROM Courses WHERE Id = %s", GetSQLValueString($colname_CourseInfo, "int"));
$CourseInfo = mysql_query($query_CourseInfo, $projector) or die(mysql_error());
$row_CourseInfo = mysql_fetch_assoc($CourseInfo);
$totalRows_CourseInfo = mysql_num_rows($CourseInfo);

$colname_UnitInfo = "-1";
if (isset($_GET['UnitId'])) {
  $colname_UnitInfo = $_GET['UnitId'];
}
mysql_select_db($database_projector, $projector);
$query_UnitInfo = sprintf("SELECT * FROM Units WHERE Id = %s", GetSQLValueString($colname_UnitInfo, "int"));
$UnitInfo = mysql_query($query_UnitInfo, $projector) or die(mysql_error());
$row_UnitInfo = mysql_fetch_assoc($UnitInfo);
$totalRows_UnitInfo = mysql_num_rows($UnitInfo);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Episodes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet"/>
    <link href="_css/bootstrap-commoncore.css" rel="stylesheet"/>

  </head>

  <body>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="/editor/CC_CourseBrowser.php" class="parent transition"><img src="_images/CC_UI/home_icon.png" width="20" height="20"></a></li>
              <li><a href="CC_UnitBrowser.php" class="parent transition"><?php echo $row_CourseInfo["Name"]; ?></a></li>
              <li><a href="#"><?php echo $row_UnitInfo['Name']; ?></a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container">
    
      <!--  Carousel -->
      <div id="episode-carousel-id" class="carousel slide episode-carousel">
        <div class="carousel-inner">
        
              	<div class="item active">
                	<div class="episode-carousel-item-inner">
                
                        <div class="episode-carousel-caption">
                            <p class="browserEpisode">EPISODE 1:</p>
                            <p class="browserEpisodeTitle">Lorem Ipsum Dolor</p>
                            <p class="browserEpisodeDescription">In this episode</p> 
                        </div>
                        
                        <div class="episode-carousel-content">
                            <hr/>
                            <div class="row-fluid">
                            
                                <ul class="thumbnails">
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 1</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 2</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 3</h3>
                                            </div>
                                        </a>
                                        </li>
                                    </ul>
                                </div><!-- end row fluid -->
                                
                                <div class="row-fluid">
                                    <ul class="thumbnails">
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 4</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 5</h3>
                                            </div>
                                        </a>
                                        </li>
                                     </ul>
                                </div><!--  end row fluid -->
                                
                            </div><!--  end episode-carousel-content -->
                                
                        </div><!-- end item inner -->

					</div><!-- end item -->

              	<div class="item">
                	<div class="episode-carousel-item-inner">
                
                        <div class="episode-carousel-caption">
                            <p class="browserEpisode">EPISODE 2:</p>
                            <p class="browserEpisodeTitle">Lorem Ipsum Dolor</p>
                            <p class="browserEpisodeDescription">In this episode</p> 
                        </div>
                        
                        <div class="episode-carousel-content">
                            <hr/>
                            <div class="row-fluid">
                            
                                <ul class="thumbnails">
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 1</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 2</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 3</h3>
                                            </div>
                                        </a>
                                        </li>
                                    </ul>
                                </div><!-- end row fluid -->
                                
                                <div class="row-fluid">
                                    <ul class="thumbnails">
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 4</h3>
                                            </div>
                                        </a>
                                        </li>
                                        <li class="span4">
                                        <a href="#lessonModal" role="button" data-toggle="modal">
                                            <div class="thumbnail">
                                              <img src="img/cc_mockups/thumbnail.png" alt="">
                                              <h3>Lesson 5</h3>
                                            </div>
                                        </a>
                                        </li>
                                     </ul>
                                </div><!--  end row fluid -->
                                
                            </div><!--  end episode-carousel-content -->
                                
                        </div><!-- end item inner -->

					</div><!-- end item -->

              </div><!-- end Carousel inner -->           
              
        </div><!-- .carousel-inner -->
        
        <!--  next and previous controls here href values must reference the id for this carousel -->
          <a class="carousel-control episode-carousel-control left" href="#episode-carousel-id" data-slide="prev">&nbsp;</a>
          <a class="carousel-control episode-carousel-control right" href="#episode-carousel-id" data-slide="next">&nbsp;</a>
      </div>
     
      <!-- .carousel -->
      <!-- end carousel -->
	<div class="unitInfo">
    
		<div class="unitHeader">
            <p><?php echo $row_UnitInfo['Name']; ?></p>
            <H1><?php echo $row_UnitInfo['Title']; ?></H1>
        </div>
        <div class="unitBody">
        	<?php echo $row_UnitInfo['Description']; ?>
        </div>
        <div>
        </div>
        
    </div><!-- end Unit Info -->


<!-- Modals -->
        <div id="lessonModal" class="modal hide fade" tabindex="10" role="dialog" aria-labelledby="lessonModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <p class="lessonHeader">EPISODE 1: TITLE</p>
            <h2 id="lessonModalLabel">Lesson 1</h2>
          </div>
          <div class="modal-body">
            <p>Lesson Description</p>
            <div class="pagination-centered">
            	<a href="CC_LessonBrowser.php" class="btn btn-large btn-primary cc-start-btn transition" >START</a>
            </div>
          </div>
        </div>
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
mysql_free_result($CourseInfo);

mysql_free_result($UnitInfo);
?>
