<?php

// comment in below 2 lines to run stand alone
/*require_once('../Globals.php'); 
require_once('../Connections/projector.php');
*/
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

if (!isset($addToUrl))
	$addToUrl = "";

$colname_EpisodeList = "-1";
if (isset($_GET['UnitId'])) {
  $colname_EpisodeList = $_GET['UnitId'];
}
mysql_select_db($database_projector, $projector);
$query_EpisodeList = sprintf("SELECT * FROM Episodes WHERE UnitId = %s ORDER BY SortOrder ASC", GetSQLValueString($colname_EpisodeList, "int"));
$EpisodeList = mysql_query($query_EpisodeList, $projector) or die(mysql_error());
$row_EpisodeList = mysql_fetch_assoc($EpisodeList);
$totalRows_EpisodeList = mysql_num_rows($EpisodeList);

function outputAddNewLesson() {
	global $colname_CourseInfo, $colname_UnitInfo, $row_ProjectList;
	
	echo '<li class="span4">' . "\n";
	echo '<a href="/editor/CCSoC_EditLesson.php?action=Add' . "&CourseId=" . $colname_CourseInfo. "&UnitId=". $colname_UnitInfo . '" role="button" data-toggle="modal">' . "\n";
	echo '<div class="thumbnail">' . "\n";
	echo '<img src="/_images/CC_UI/addnewlesson300x200.jpg" >' . "\n";
	echo '<h3>Add New Lesson</h3>' . "\n";
	echo '</div>' . "\n";
	echo '</a>' . "\n";
	echo '</li>' . "\n"; 
}
?>

<div id="episode-carousel-id" class="carousel slide episode-carousel">
	<div class="carousel-inner">
	<?php 

		if ($totalRows_EpisodeList > 0) {
      $itemNum = 0;
			
				
					
      do { 
				if ($row_EpisodeList['Type'] == "1")
					$editableEpisode = true;
        else
					$editableEpisode = false;
					
				echo '<div class="item ' ;
        if ($itemNum == 0) echo "active"; 
        echo '">' . "\n";
        echo '<div class="episode-carousel-item-inner">' . "\n";
        echo '<div class="episode-carousel-caption">' . "\n";
        echo '<p class="episode-carousel-caption-number">' .  $row_EpisodeList['Name'] . ":</p>\n";
        echo '<p class="episode-carousel-caption-title">' . $row_EpisodeList['Title'] . "</p>\n";
        echo '<p class="episode-carousel-caption-description">' . $row_EpisodeList['Description'] . "</p>\n";
        echo "</div>\n";
        echo '<div class="episode-carousel-content">' . "\n";
        echo "<hr/>\n";
   //     echo "EpisodeId = " . $row_EpisodeList['Id'] . "\n";
  
        mysql_select_db($database_projector, $projector);
        $query_ProjectList = sprintf("SELECT * FROM Projects WHERE UnitId = %s AND EpisodeId = %s ORDER BY Number ASC", GetSQLValueString($colname_EpisodeList, "int"), $row_EpisodeList['Id']);
  //      echo "sql: " . $query_ProjectList . "\n";
        $ProjectList = mysql_query($query_ProjectList, $projector) or die(mysql_error());
        $row_ProjectList = mysql_fetch_assoc($ProjectList);
        $totalRows_ProjectList = mysql_num_rows($ProjectList);
				$projectNum = 0;
				if ($totalRows_ProjectList > 0 || $row_EpisodeList['Type'] == "1") {
					do { 
						if ($projectNum % 3 == 0) {
							echo '<div class="episode-carousel-content-padding"><div class="row-fluid">' . "\n\t";
							echo '<ul class="thumbnails">' . "\n";
						}
						if ($totalRows_ProjectList > 0) {		// don't output a thumbnail if we don't have any lessons (need to handle case where we are adding Add New Lesson)
							echo '<li class="span4">' . "\n";
	//						echo '<a href="#lessonModal" role="button" data-toggle="modal">' . "\n";
	// 						SCOTT Taking out the modal dialog for now going directly to the Lesson Browser (that page does not add a lot of value imho)
	
							echo '<a href="CC_LessonBrowserLive.php' . "?CourseId=" . $colname_CourseInfo. "&UnitId=". $colname_UnitInfo . "&Id=" . $row_ProjectList['Id']; 			
							if ($editableEpisode) echo '&Action=Edit';
							echo '" role="button" data-toggle="modal">' . "\n";
							echo '<div class="thumbnail">' . "\n";
							echo '<img src="' . $row_ProjectList['ImgSmall'] . '" >' . "\n";
							echo '<h3>' . $row_ProjectList['Name'] . '</h3>' . "\n";
							echo '</div>' . "\n";
							echo '</a>' . "\n";
							echo '</li>' . "\n";
						}
						$projectNum++;
						if ($projectNum % 3 == 0) {
							echo '</ul>' . "\n\t";
							echo '</div><!-- end row fluid and padding -->' . "\n" . '</div><!-- end episode-carousel-content-padding --> ' . "\n";
						}
					} while ($row_ProjectList = mysql_fetch_assoc($ProjectList)); 
	        
					// if we are in myLessons we need to add a add new episode tile
					if ($row_EpisodeList['Type'] == "1") {
						if ($projectNum % 3 == 0) {
							echo '<div class="episode-carousel-content-padding"><div class="row-fluid">' . "\n\t";
							echo '<ul class="thumbnails">' . "\n";
						}
						outputAddNewLesson();
						if ($projectNum % 3 == 0) {
							echo '</ul>' . "\n\t";
							echo '</div><!-- end row fluid and padding -->' . "\n" . '</div><!-- end episode-carousel-content-padding --> ' . "\n";
						}
					}
					
					if ($projectNum % 3 != 0) {	// add closing div tags
							echo '</ul>' . "\n\t";
							echo '</div></div> <!-- end row fluid and padding -->' . "\n";
					}
					                        
 					echo '</div> <!--  end episode-carousel-content -->' . "\n"; 
        	echo '</div> <!-- end item inner -->' . "\n"; 
      		echo '</div> <!-- end item -->' . "\n"; 
       		$itemNum++;
				}
				
			} while ($row_EpisodeList = mysql_fetch_assoc($EpisodeList)); 
		}
/*		if (isset($EpisodeList))
			mysql_free_result($EpisodeList);*/
	?>
  </div>
  <!-- end Carousel inner --> 
</div>