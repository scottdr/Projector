<?php
$colname_EpisodeList = "-1";
if (isset($_GET['UnitId'])) {
  $colname_EpisodeList = $_GET['UnitId'];
}
mysql_select_db($database_projector, $projector);
$query_EpisodeList = sprintf("SELECT * FROM Episodes WHERE UnitId = %s ORDER BY SortOrder ASC", GetSQLValueString($colname_EpisodeList, "int"));
$EpisodeList = mysql_query($query_EpisodeList, $projector) or die(mysql_error());
$row_EpisodeList = mysql_fetch_assoc($EpisodeList);
$totalRows_EpisodeList = mysql_num_rows($EpisodeList);
?>

<div id="episode-carousel-id" class="carousel slide episode-carousel">
	<div class="carousel-inner">
	<?php 
		if ($totalRows_EpisodeList > 0) {
      $itemNum = 0;
      do { 
        echo '<div class="item ' ;
        if ($itemNum == 0) echo "active"; 
        echo '">' . "\n";
        echo '<div class="episode-carousel-item-inner">' . "\n";
        echo '<div class="episode-carousel-caption">' . "\n";
        echo '<p class="browserEpisode">' .  $row_EpisodeList['Name'] . ":</p>\n";
        echo '<p class="browserEpisodeTitle">' . $row_EpisodeList['Title'] . "</p>\n";
        echo '<p class="browserEpisodeDescription">' . $row_EpisodeList['Description'] . "</p>\n";
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
			
				if ($totalRows_ProjectList > 0) {
					$projectNum = 0;
					do { 
						if ($projectNum % 3 == 0) {
							echo '<div class="row-fluid">' . "\n\t";
							echo '<ul class="thumbnails">' . "\n";
						}
						echo '<li class="span4">' . "\n";
						echo '<a href="#lessonModal" role="button" data-toggle="modal">' . "\n";
						echo '<div class="thumbnail">' . "\n";
						echo '<img src="' . $row_ProjectList['ImgSmall'] . '" >' . "\n";
						echo '<h3>' . $row_ProjectList['Name'] . '</h3>' . "\n";
						echo '</div>' . "\n";
						echo '</a>' . "\n";
						echo '</li>' . "\n";                       
		
						if ($projectNum % 3 == 0) {
							echo '</ul>' . "\n\t";
							echo '</div>' . "\n";
						}
						$projectNum++;
					} while ($row_ProjectList = mysql_fetch_assoc($ProjectList)); 
	        
					
					                        
 					echo '</div> <!--  end episode-carousel-content -->' . "\n"; 
        	echo '</div> <!-- end item inner -->' . "\n"; 
      		echo '</div> <!-- end item -->' . "\n"; 
       		$itemNum++;
				}
			} while ($row_EpisodeList = mysql_fetch_assoc($EpisodeList)); 
		}
	?>
  </div>
  <!-- end Carousel inner --> 
</div>