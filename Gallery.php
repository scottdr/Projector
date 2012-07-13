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
<title>Pearson</title>
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
              <a href="#"><img src="images/proj_gal_next_up.gif"></a>
              <a href="#"><img src="images/proj_gal_back_up.gif"></a>
             </div>
        
        
          <!-- PAGE CONTENT --------------------------------------------->
       <?php
			 require_once "GalleryContent.php";
			 ?>
       <!--
		  <div id="GalleryColumn1Div" onClick="location.href='ProjectGalleryDetail-SculptureDramaDialogue.html'">
            	<div id="GalleryMedia">
                	<img src="images/project1-sculpture.png" alt="Sculpture, drama, and dialogue" width="300" height="200">
                </div>
				<h1>Sculpture, Drama and Dialogue</h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
            <div id="GalleryColumn2Div" onClick="location.href='ProjectGalleryDetail-CulturalVibrations.html'">
            	<div id="GalleryMedia">
                	<img src="images/project7-cvibrations.png" alt="Exploring the deep seas" width="300" height="197">
                </div>
                <h1>Cultural Vibrations</h1>
                <p>Use materials around you to build instruments and  then  perform a brief musical performance.</p>
                <p><strong>Subject: </strong>Science</p>
                <p><strong>Grade:</strong> 6</p>
                <p><strong>Duration: </strong>6+ weeks</p>
			</div>
            <div id="GalleryColumn3Div" onClick="location.href='ProjectGalleryDetail-MakeAnImpact.html'">
            	<div id="GalleryMedia">
                	<img src="images/drought-h.jpg" alt="Yunnan China drought" width="300" height="200">
                </div>
                <h1>Make an Impact</h1>
                <p>Students respond to a call for design solutions to a community water shortage. </p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
            
			<div id="GalleryColumn1Div" onClick="location.href='ProjectGalleryDetail-ReadWriteShare.html'">
            	<div id="GalleryMedia">
                	<img src="images/ellisisland-h.jpg" alt="arriving at Ellis Island" width="300" height="200">
                </div>
				<h1>Read, Write, Share!</h1>
                <p>You're going to tell the story of what you've learned about moving and immigration.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 5</p>
                <p><strong>Duration: </strong>6 weeks</p>
			</div>
            <div id="GalleryColumn2Div" onClick="location.href='ProjectGalleryDetail.html'">
            	<div id="GalleryMedia">
                	<img src="images/project5-wireframes.png" alt="Figure wireframe" width="300" height="200">
                </div>
                <h1>Exploring the Deep Seas</h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
            <div id="GalleryColumn3Div" onClick="location.href='ProjectGalleryDetail.html'">
            	<div id="GalleryMedia">
                	<img src="images/project6-earth.png" alt="Big blue earth" width="300" height="200">
                </div>
                <h1>Space, Planets and the Universe </h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>

			<div id="GalleryColumn1Div" onClick="location.href='ProjectGalleryDetail.html'">
            	<div id="GalleryMedia"><img src="images/project1-sculpture.png" alt="Sculpture, drama, and dialogue" width="300" height="200"></div>
				<h1>Sculpture, Drama and Dialogue</h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
            <div id="GalleryColumn2Div" onClick="location.href='ProjectGalleryDetail.html'">
            	<div id="GalleryMedia"><img src="images/project2-explore.png" alt="Exploring the deep seas" width="300" height="200"></div>
                <h1>Exploring the Deep Seas</h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
            <div id="GalleryColumn3Div" onClick="location.href='ProjectGalleryDetail.html'">
            	<div id="GalleryMedia"><img src="images/project3-space.png" alt="Space, planets, and the universe" width="300" height="200"></div>
                <h1>Space, Planets and the Universe </h1>
                <p>You will make up a story about what the animals would be like if they were alive and they could talk.</p>
                <p><strong>Subject: </strong>ELA with cross-curricular content in Art</p>
                <p><strong>Grade:</strong> 1 - 2</p>
                <p><strong>Duration: </strong>10 days</p>
			</div>
      -->
            
            <!-- BOTTOM PAGE NAVIGATION ----------------------------->
            <div id="GalleryNavFilter">
                <p>All Grades, ELA, Math, Art & Science, 7-8 days </p>
            </div>
            
            <div id="GalleryNavItemsPerPg">
                <p>View 12 per page </p>
            </div>
            
            <div id="GalleryNavPgOfX">
              <p> page 1 of 9 </p>
              <a href="#"><img src="images/proj_gal_next_up.gif"></a>
              <a href="#"><img src="images/proj_gal_back_up.gif"></a>
            </div>
            
            <!-- FOOTER --------------------------------------------->
            
        </div>
        
      </div>
      
    </div>

</body>
</html>
