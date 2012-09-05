<?php
if (!isset($selectedNav)) $selectedNav = "NavGallery";
?>
<!-- Header -->
<div id="HeaderBgDiv">
  <div id="HeaderDiv">
    <div id="HeaderImg">
      <a href="#"><img src="images/headerlogo.png" width="48" height="24"></a>
    <!--<span class="projectorTitle">The Projector</span> -->
    	<h1>The Projector</h1>
    </div>
  </div>
</div>

<!-- Navigation -->
<div id="NavDiv">
  <div id="NavHome" <?php ($selectedNav == 'NavHome') ? print 'class="NavItemDown"' : print 'class="NavItemUp"'; ?>> <a <?php ($selectedNav == 'NavHome') ? print 'class="navDown"' : print 'class="navUp"'; ?> href="index.php">HOME</a> </div>
  <div id="NavGallery" <?php ($selectedNav == 'NavGallery') ? print 'class="NavItemDown"' : print 'class="NavItemUp"'; ?>> <a <?php ($selectedNav == 'NavGallery') ? print 'class="navDown"' : print 'class="navUp"'; ?> href="Gallery.php">PROJECT GALLERY</a> </div>
  <div id="NavAbout" <?php ($selectedNav == 'NavAbout') ? print 'class="NavItemDown"' : print 'class="NavItemUp"'; ?>> <a <?php ($selectedNav == 'NavAbout') ? print 'class="navDown"' : print 'class="navUp"'; ?> href="About.php">ABOUT</a> </div>
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
<div class="clearFloat" />