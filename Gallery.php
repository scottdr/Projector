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
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="Project.css" rel="stylesheet" type="text/css">

<style type="text/css">
body {
	background-image: url(images/proj_gal_bg.gif);
	background-repeat: repeat-x;
	background-color: #FFFFFF;
}
</style>

<script src="respond.min.js"></script>

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
              <a class="navUp" href="Index.html">HOME</a>
            </div>
            <div id="NavItemDown">
                <a class="navDown" href="ProjectGallery.html">PROJECT GALLERY</a>
            </div>
            <div id="NavItemUp">
               <a class="navUp" href="StudentGallery.html">STUDENT GALLERY</a>
            </div>
                <div id="NavSearch">
                   Search ...
                    <!--form id="searchbox" action="">
                    <input id="search" type="text" placeholder="Type here">
        
                    </form-->
                <input type="submit" class="searchButton" id="submit" value="">
                </div>
        </div>
        <!-- TOP PAGE NAVIGATION --------------------------------------------->
        <div id="ContentDiv">
        
          <div id="GalleryNavFilter">
                <p>All Grades, ELA, Math, Art & Science, 7-8 days </p>
            </div>
            
            <div id="GalleryNavItemsPerPg">
                <p>View 12 per page </p>
            </div>
            
            <div id="GalleryNavPgOfX">
              <p> page 1 of 9 </p>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="images/proj_gal_next_up.gif"></a>
              <a href="#"><img src="images/proj_gal_back_up.gif"></a>
             </div>
        
        
          <!-- PAGE CONTENT --------------------------------------------->

					 <?php
           require_once "TestDivNoBody.php";
           ?>
            <p></p>
            <!-- BOTTOM PAGE NAVIGATION ----------------------------->
            <div id="GalleryNavFilter">
                <p>All Grades, ELA, Math, Art & Science, 7-8 days </p>
            </div>
            
            <div id="GalleryNavItemsPerPg">
                <p>View 3 per page </p>
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
