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
<!doctype html>
<!--[if lt IE 7]><html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]><html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]><html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Projector Gallery</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="_css/Root_Project.css" rel="stylesheet" type="text/css">
<link href="_css/main.css" rel="stylesheet" type="text/css" />	

<script src="js/respond.min.js"></script>
<script src="js/gallery.js"></script>
<script src="jquery-ui-1.8.21/js/jquery-1.7.2.min.js"></script>
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
      
		<!-- HEADER AND NAVIGATION --------------------------------------------->
		<?php include("Globals.php"); ?>
        <?php $selectedNav = "NavGallery"; ?>
        <?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div>
        
        
        <div class="clearFloat">
        </div>
        <?php
        require_once "GalleryQuery.php";
        ?>
        
        
        <!-- CONTENT --------------------------------------------->
        
        <div id="ContentDiv">
            <!-- Banner for Featured Topic -->
            <?php if ($topic == "All") : ?>
                <div id="GalleryBanner">
                  <h1><?php echo $row_FeaturedProject['Name']; ?></h1>
                  <p><?php echo $row_FeaturedProject['TagLine']; ?></p>
                  <p><a href="Gallery.php?topic=<?php echo $row_FeaturedProject['Id']; ?>">View Projects</a></p>
                </div>
                <div class="horzontalSpacer"></div>
            <?php else: ?>
                  <div id="TopicIcon" style="float:left; margin-right:10px;"><img src="<?php echo $row_FeaturedProject['LargeIcon']; ?>" alt="<?php echo $row_FeaturedProject['Name']; ?>" /></div>
                  <div>
                    <h1><?php echo $row_FeaturedProject['Name']; ?></h1>
                    <h2 style="margin-top:10px"><?php echo $row_FeaturedProject['TagLine']; ?></h2>
                  </div>
                  <div class="horzontalSpacer"></div>
            <?php endif; ?>
          
            <!-- Gallery Nav Filters --------------------------------------------->
            <div id="GalleryNavFilter">
        <!--    <form name="statusFilterForm" method="post" action="Gallery.php">
            &nbsp;Show Status:
            <?php if ($PROJECTOR['editMode']) : ?>
                <select name="filterStatus" id="filterStatus">
                    <option value="All" selected="selected">All</option>
                  <option value="Edit">Edit</option>
                  <option value="Review">Review</option>
                  <option value="Pilot">Pilot</option> 
                  <option value="Published">Published</option>
                        </select>
                    <?php endif; ?>
            </form>-->
            </div>
            
            <div id="GalleryNavItemsPerPg">
                  <form name="form1" method="post" action="">
                    <select name="recordsPerPage" id="recordsPerPage" onChange="updateRecordCount(this.value)">
                      <option value="3">View 3 per page</option>
                      <option value="9">View 9 per page</option>
                      <option value="9000">all</option>
                    </select>
                </form>
            </div>
            
            <div id="GalleryNavPgOfX"><p>  page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?></p>              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_next_up.gif"></a>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_back_up.gif"></a>
            </div>
            
                
            
            <!-- GALLERY ITEMS CONTENT --------------------------------------------->
            <?php
            require_once "GallerySQLContent.php";
            ?>
            
            <p></p>
            <!-- BOTTOM PAGE NAVIGATION ----------------------------->
            <div id="GalleryNavFilter">
                <p>&nbsp;</p>
            </div>
            
            <div id="GalleryNavItemsPerPg">
                <form name="form1" method="post" action="">
                    <select name="recordsPerPage2" id="recordsPerPage2" onChange="updateRecordCount(this.value)">
                      <option value="3">View 3 per page</option>
                      <option value="9">View 9 per page</option>
                      <option value="9000">all</option>
                    </select>
                </form>
            </div>
            
          <div id="GalleryNavPgOfX">
              <p> page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?> </p>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_next_up.gif"></a>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="_images/proj_gal_back_up.gif"></a>
            </div>
            
           <!-- FOOTER ---------------------------------------------> 
            <div id="GeneralFooterDiv">
            <hr/>
            <a href="http://www.teachingawards.com/home" target="_blank"><img src="_images/logo_teachingawards.gif" alt="Pearson Teaching Awards"></a>
              <!--a href="http://www.si.edu" target="_blank"><img src="_images/logo_smithsonian.gif" alt="Smithsonian"></a-->
              <a href="http://www.pearsonfoundation.org" target="_blank"><img src="_images/logo_pearsonfound.gif" alt="Pearson Teaching Awards"></a>
              <a href="http://www.nationalmockelection.org" target="_blank"><img src="_images/logo_myvoice.gif" alt="My Voice My Election"></a>
              <p>© Pearson Foundation 2012 | <a href="mailto:labs@pearsonfoundation.org">Contact</a></p>
        	</div>
        </div>
        
      </div>
      
    </div>

</body>
</html>
