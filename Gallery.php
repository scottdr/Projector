<?php include("Connections/projector.php"); ?>
<?php
// Choose the topic to filter by
$topic = "All";
if (isset($_GET['topic'])) {
	$topic = $_GET['topic'];
	$topicSQL = "Topic = " . $topic; 
}
 
mysql_select_db($database_projector, $projector);
if ($topic != "All")
	$query_FeaturedProject = "SELECT * FROM Topics WHERE Id = " . $topic;
else
	$query_FeaturedProject = "SELECT * FROM Topics WHERE Featured = 1";
$FeaturedProject = mysql_query($query_FeaturedProject, $projector) or die(mysql_error());
$row_FeaturedProject = mysql_fetch_assoc($FeaturedProject);
$totalRows_FeaturedProject = mysql_num_rows($FeaturedProject);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Project Gallery</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css" />
<link href="_css/Root_Project.css" rel="stylesheet" type="text/css" />
<link href="_css/main.css" rel="stylesheet" type="text/css" />
	
<script src="js/gallery.js" type="text/javascript"></script>
<!--<script src="js/respond.min.js" type="text/javascript"></script>-->
<script src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.GalleryColumn1Div,.GalleryColumn2Div,.GalleryColumn3Div').click(function(e) {
		/*
		alert('You clicked the DIV:' + e.currentTarget.getAttribute("data-id")); */
		window.location = "ProjectDetails.php?Id=" + e.currentTarget.getAttribute("data-id");
	});  
});
</script>

</head>
<body>

<div class="gridContainer clearfix"> 
	<div class="ProjGalleryBackgroundDiv">
      
    <!-- HEADER AND NAVIGATION -->
    <?php include("Globals.php"); ?>
    <?php $selectedNav = "NavGallery"; ?>
    <?php include("HeaderNav.php"); ?>
    <div id="NavShadowDiv"></div>
          
          
    <div class="clearFloat">
    </div>
    <?php
    require_once "GalleryQuery.php";
    ?>
        
        
    <!-- CONTENT -->
    
    <div id="ContentDiv">
        <!-- Banner for Featured Topic -->
        <?php if ($topic == "All") : ?>
        	
            <div id="GalleryBanner">
            <a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>">
                <div id="TopicIcon" style="float:left; margin-right:10px;">
                	<img src="<?php echo $row_FeaturedProject['LargeIcon']; ?>" alt="<?php echo $row_FeaturedProject['Name']; ?>" />
                </div>
                <div>
                    <h1 style="color:#333"><?php echo $row_FeaturedProject['Name']; ?></h1>
                    <p style="color:#333"><?php echo $row_FeaturedProject['TagLine']; ?></p>
                    <p><a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>">View Projects</a></p>
                </div>
            </a>
            </div>
           
            <div class="horzontalSpacer"></div>
        <?php else: ?>
            <div id="GalleryBanner">
                <div id="TopicIcon" style="float:left; margin-right:10px;">
                  <img src="<?php echo $row_FeaturedProject['LargeIcon']; ?>" alt="<?php echo $row_FeaturedProject['Name']; ?>" />
                </div>
                <div>
                  <h1><?php echo $row_FeaturedProject['Name']; ?></h1>
                  <p><?php echo $row_FeaturedProject['TagLine']; ?></p>
                </div>
            </div>
            <div class="horzontalSpacer"></div>
        <?php endif; ?>
        
        <div id="GalleryNavFilter">
            <p>&nbsp;</p>
        </div>
                  
        <div id="GalleryNavItemsPerPg">
            <form action="" method="post" name="form1" id="form1">
              <select name="recordsPerPage" id="recordsPerPage" onchange="updateRecordCount(this.value)">
                <option value="3">View 3 per page</option>
                <option value="9">View 9 per page</option>
                <option value="9000">all</option>
              </select>
            </form>
        </div>
        
        <div id="GalleryNavPgOfX"><p>  page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?></p>              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_next_up.gif" /></a>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_back_up.gif" /></a>
        </div>
        
            
        
        <!-- GALLERY ITEMS CONTENT -->
        <?php
        require_once "GallerySQLContent.php";
        ?>
        
        <p></p>
        <!-- BOTTOM PAGE NAVIGATION -->
        <div id="GalleryNavFilter">
            <p>&nbsp;</p>
        </div>
        
        <div id="GalleryNavItemsPerPg">
            <form action="" method="post" name="form1" id="form1">
                <select name="recordsPerPage2" id="recordsPerPage2" onchange="updateRecordCount(this.value)">
                  <option value="3">View 3 per page</option>
                  <option value="9">View 9 per page</option>
                  <option value="9000">all</option>
                </select>
            </form>
        </div>
        
        <div id="GalleryNavPgOfX">
          <p> page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?> </p>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_next_up.gif" /></a>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_back_up.gif" /></a>
        </div>

        <!-- FOOTER --> 
        <?php include("GeneralFooter.php"); ?>
    </div>  
	</div>
</div>
</body>
</html>
