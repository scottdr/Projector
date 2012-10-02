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
<title>The Projector</title>
<link href="_css/boilerplate.css" rel="stylesheet" type="text/css"/>
<link href="_css/Root_Project.css" rel="stylesheet" type="text/css"/>
<link href="_css/main.css" rel="stylesheet" type="text/css"/>	

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
        $(function () {
            var tabContainers = $('div.tabs > div');
            tabContainers.hide().filter(':first').show();
 
            $('div.tabs ul.tabNavigation a').click(function () {
                tabContainers.hide();
                tabContainers.filter(this.hash).show();
                $('div.tabs ul.tabNavigation a').removeClass('selected');
                $(this).addClass('selected');
                return false;
            }).filter(':first').click();
        });
</script>    
<script src="_scripts/respond.min.js"></script>

</head>
<body>

    <div class="gridContainer clearfix"> 
      <div class="ProjGalleryBackgroundDiv">
      
      <!-- HEADER AND NAVIGATION --------------------------------------------->
        <?php $selectedNav = "NavAbout"; ?>
		<?php include("HeaderNav.php"); ?>
        <div id="NavShadowDiv"></div> 
        <!-- PAGE CONTENT --------------------------------------------->
        <div id="ContentDiv">
        
         <div id="GalleryDetailPageTitle">
           <h1>The Projector</h1>
           
         </div>
         
       	  <!-- SUMMARY --------------------------------------------->
		  <div>
          <img src="_images/about_pic.png" width="375" height="250" style="float:right; padding-left:10px;">
          <p>The Pearson Foundation Learning Labs Projector is a  free, community-driven set of high-quality projects for classrooms everywhere. It provides interdisciplinary, authentic experiences that blend informal and formal learning environments. </p>
          <p>The goals for the Projector are:</p>
          <ul>
            <li>Reach one million students within ﬁve years</li>
            <li>Create and share great project experiences for students and teachers</li>
            <li>Devise a community-driven authoring process that improves content and builds professional learning communities around each project</li>
            <li> Bring the resources of informal learning environments to 
              bear on formal classroom settings</li>
            <li>Set a high bar for the user experience standard in open education resources (OER)</li>
            </ul>
          <p>&nbsp;</p>
		  </div>
          
          <!-- TABS --------------------------------------------->
           
          <div class="tabs" id="tabDiv">
            <ul class="tabNavigation">
                <li><a href="#projectTab1">What is a Project?</a></li>
                <li><a href="#projectTab2">Project Authoring</a></li>
                <li><a href="#projectTab3">Resources</a></li>
            </ul>
            <!-- TAB ONE --------------------------------------------->
            <div id="projectTab1">
               <div id="recentProjectsRightColumn">
                  <h2>Recently Published Projects</h2>
                  <h3><a href="ProjectDetails.php?Id=1">Cultural Vibrations</a></h3>
                  <p>Build a musical instrument that tells the world something about who you are. Write a piece of music that you’ll play on your handmade instrument at an end-of-project performance.</p>
                  
                  <h3><a href="ProjectDetails.php?Id=3">Make an Impact</a></h3>
                  <p>Be an engineer: Design a device— from concept to prototype—that will help conserve water  in drought-stricken South Carolina.</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  
              </div>
              <p>Project-based learning invites students to explore real-world topics in depth. Whether they are exploring contemporary or historical problems, taking a position on an important issue, or expressing their point of view, students meeting the challenge of a well-constructed project have the opportunity to research a topic thoroughly, devise a project plan for delivering their findings, and present the results of their exploration to an audience beyond their classroom. </p>
              <p>Our schools are responding to the demand for more rigorous standards and higher expectations. Project-based learning provides students with the opportunity to work across disciplines to unravel complex ideas and issues, and to do so using 21st century tools and while building  21st century competencies. In addition to demonstrating academic rigor, every challenge included in the Projector must:</p>
                  <ul>
                    <li>Engage youth in exploring their own identities, their communities, and the world</li>
                    <li>Encourage youth to do something</li>
                    <li>Encourage collaboration and curiosity, and have an element of fun</li>
                    <li>Have clearly defined goals that align with Common Core Standards</li>
                    <li>Build 21st century skills</li>
                    <li>Be completed using a variety of processes and new media tools</li>
                </ul>
              <p>If you are interested in participating in the Projector Pilot program please <a href="mailto:labs@pearsonfoundation.org">contact us</a>.</p>
              <p>&nbsp;</p>
           	  <p>&nbsp;</p>
              <p>&nbsp;</p>

            </div>
            
            <!-- TAB TWO --------------------------------------------->
            <div id="projectTab2">
            <div id="lightGreyRightColumn">
              <h2>Project Community</h2>
              
              <h3>Project Author</h3><img src="_images/ProjectCommunity_author.png">
              <p>The author is the originator of the great idea. The project is based on their classroom experience and creativity. The author determines the driving questions that will guide the students, and crafts the details of the project.  </p>
              
              
              <h3>Project Contributor</h3><img src="_images/ProjectCommunity_contributor.png">
              <p>An author&rsquo;s network of teachers and other peers are essential to writing a great project. Contributors provide their expertise to develop the project.</p>
			  
              
              <h3>Editorial and Production Team</h3><img src="_images/ProjectCommunity_productionteam.png">
              <p>Writers, editors, designers, and producers are all part of the team that brings each project to life.</p>
			  
              
              <h3>Community Manager</h3><img src="_images/ProjectCommunity_manager.png">
              <p>The community manager works with authors, pilot teachers, and the Projector community to ensure each project continues to live and breathe. </p>
			  
              
              <h3>Pilot Teacher</h3><img src="_images/ProjectCommunity_pilotteacher.png">  
              <p>Each project is taught by five pilot teachers before it is published. Pilot teachers ensure project quality by tracking what works, what doesn&rsquo;t, and providing examples of student work.</p>
			             
              
              <p>&nbsp;</p>
              
			</div>
            
           	  <p>The central premise behind the Projector is simple: The best ideas come from the best teachers.</p>
              <p>Each Projector challenge (project) is based on an idea from an outstanding teacher. Based on their own classroom experience, each author creates a project that presents an authentic challenge for students. Aligned with Common Core State Standards, each project builds 21st century skills of collaboration, communication, critical thinking, and creativity. These projects engage youth in exploring the world around them as well as the larger community. Significantly, each project is designed to engage students by stimulating their curiosity and incorporating an element of fun. </p>
              <p><img src="_images/about_projector.png" alt="Projector community"></p>
              <p>Each project is reviewed, edited, and produced by the staff of the Pearson Foundation Learning Labs and key partners. Each project is tested in a minimum of five classrooms in a series of pilot tests conducted by real teachers in real classrooms. Each pilot teacher evaluates the project for quality, identifies best practices, suggests improvements, and captures exemplars of student work along the way.              </p>
              <p>After pilot testing, each project is published for teachers around the world to use in their classrooms. As each teacher implements the project, they have an opportunity to comment, ask questions, and make suggestions. Each teacher is invited to submit a link to student work for inclusion in the Projector Student Gallery, which provides a platform for national discussion in response to the individual challenges.              </p>
              <p>To help students and teachers understand how to successfully engage in project-based learning, each Projector project uses a consistent set of predefined phases. Based on the work of groups like the Buck Institute for Education and the Project Management Institute Education Foundation, each project progresses through a series of steps that help to guide the work and student engagement.</p>
              <p><img src="_images/about_process.png" alt="Projector production process"> </p>
              <p>&nbsp;</p>
           	  <p>&nbsp;</p>
              <p>&nbsp;</p>
            </div>
                
          <!-- TAB THREE --------------------------------------------->
            <div id="projectTab3">
            
            	<h2>Pearson Foundation Learning Labs</h2>
            	<p>The Pearson Foundation Learning Labs is a product innovation lab that develops software and learning experiences for students, teachers and parents. We bring a unique mix of strategy, user experience, engineering, content, and community techniques from other industries to bear on the challenges of education.</p>
            	<p><a href="mailto:labs@pearsonfoundation.org">Contact us</a></p>
            	<h2>Pearson Foundation</h2>
              <p>The Pearson Foundation is an independent nonprofit organization that aims to make a difference by promoting literacy, learning, and great teaching. <br>
                <a href="http://www.pearsonfoundation.org">Click here to visit</a>            	</p>
              <h2>The Smithsonian Institution</h2>
            	<p>Founded in 1846, the Smithsonian Institution is the world's largest museum and research complex, consisting of 19 museums and galleries, the National Zoological Park, and nine research facilities.                <br>
           	    <a href="http://www.si.edu">Click here to visit</a></p>
       	      <h2>Buck Institute for Education</h2>
           	  <p>The Buck Institute for Education (BIE) is dedicated to improving 21st Century teaching and learning throughout the world by creating and disseminating products, practices and knowledge for effective Project Based Learning (PBL).<br>
       	      <a href="http://www.bie.org">Click here to visit</a></p>
           	  <h2>Exploratorium</h2>
           	  <p>The Exploratorium is a museum of science, art, and human perception founded in 1969. The Exploratorium’s mission is to create a culture of learning through innovative environments, programs, and tools that help people nurture their curiosity about the world around them. <br>
   	          <a href="http://www.exploratorium.edu">Click here to visit</a></p>
              <p>&nbsp;</p>
            </div>
            
           </div> 
           
        	<!-- FOOTER ---------------------------------------------> 
            <div id="GeneralFooterDiv">
            <hr/>
            <a href="http://www.teachingawards.com/home" target="_blank"><img src="_images/logo_teachingawards.gif" alt="Pearson Teaching Awards"></a>
              <!--a href="http://www.si.edu" target="_blank"><img src="_images/logo_smithsonian.gif" alt="Smithsonian"></a-->
              <a href="http://www.pearsonfoundation.org" target="_blank"><img src="_images/logo_pearsonfound.gif" alt="Pearson Teaching Awards"></a>
              <a href="http://www.nationalmockelection.org" target="_blank"><img src="_images/logo_myvoice.gif" alt="My Voice My Election"></a>
              <p>&copy; Pearson Foundation 2012 | <a href="mailto:labs@pearsonfoundation.org">Contact</a> | <a href="TermsConditions.php">Terms and Conditions</a></p>
        	</div>
        </div>
        
          
      </div>
      
    </div>
    
    
</body>
</html>
