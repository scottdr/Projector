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
<link href="Project.css" rel="stylesheet" type="text/css">

<style type="text/css">
body {
	background-image: url(images/proj_gal_bg.gif);
	background-repeat: repeat-x;
	background-color:#FBF9FA;
}

select {
	margin-top:2px;
	background-color : #666;
	color : #FFF;
	border: 1px solid #b9bdc1; 
}
</style>

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
        <div id="HeaderBgDiv">
        <div id="HeaderDiv">
          <div id="HeaderImg">
          	<a href="Index.html"><img src="images/headerlogo.png" width="48" height="24"></a>
            <h1>The Projector</h1>
          </div>
          <div id="HeaderLogin">
            name@org.edu <img src="images/layers/down_arrow.png" alt="login" width="10" height="20">
            </div>
        </div>
        </div>
            
        <div id="NavDiv">
            <div id="NavItemUp">
              <a class="navUp" href="index.php">HOME</a>
            </div>
            <div id="NavItemDown">
                <a class="navDown" href="Gallery.php">PROJECT GALLERY</a>
            </div>
            <div id="NavItemUp">
               <a class="navUp" href="StudentGallery.html">STUDENT GALLERY</a>
            </div>
            <div id="NavSearchContainter">
            	<div id="NavSearchTextContainer">
            		<input type="text" id="NavSearchText" placeholder="Search ...">
              </div>
   <!--             <div id="NavSearch">
                   Search ...-->
                    <!--form id="searchbox" action="">
                    <input type="text" id="NavSearch" value="Search ...">
        
                    </form-->
                <input type="submit" class="searchButton" id="submit" value="">
        	</div>
        </div>
        <div class="clearFloat">
        </div>
        <?php
           require_once "GalleryQuery.php";
         ?>
        <!-- TOP PAGE NAVIGATION --------------------------------------------->
        <div id="ContentDiv">
        
          <div id="GalleryNavFilter">
                <p>&nbsp;</p>
          </div>
            
            <div id="GalleryNavItemsPerPg">
       					<form name="form1" method="post" action="">
                  <label> View
                    <select name="recordsPerPage" id="recordsPerPage" onChange="updateRecordCount(this.value)">
                      <option value="3">3 per page</option>
                      <option value="9">9 per page</option>
                      <option value="9000">all</option>
                    </select>
                  </label>
                </form>
            </div>
            
            <div id="GalleryNavPgOfX"><p>  page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?></p>              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="images/proj_gal_next_up.gif"></a>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="images/proj_gal_back_up.gif"></a>
          </div>
        
        
          <!-- PAGE CONTENT --------------------------------------------->
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
                  <label>View
                    <select name="recordsPerPage2" id="recordsPerPage2" onChange="updateRecordCount(this.value)">
                      <option value="3">3 per page</option>
                      <option value="9">9 per page</option>
                      <option value="9000">all</option>
                    </select>
                  </label>
                </form>
            </div>
            
          <div id="GalleryNavPgOfX">
              <p> page <?php echo ($pageNum_Recordset1 + 1) ?> of <?php echo ($totalPages_Recordset1 + 1) ?> </p>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="images/proj_gal_next_up.gif"></a>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="images/proj_gal_back_up.gif"></a>
            </div>
            
            <!-- FOOTER --------------------------------------------->
          
        </div>
        
      </div>
      
    </div>

</body>
</html>
