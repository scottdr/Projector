<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Explore More</title>
    <!-- Bootstrap styles-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-customized.css" rel="stylesheet" type="text/css" />
    <link href="css/RibbonStyles_CCSoC.css" rel="stylesheet" type="text/css">
    <style type="text/css">

	#Header {
		clear: both;
		float: left;
		margin-left: 0;
		width: 100%;
		display: block;
		height: 92px;
	}
	#RibbonNavigation {
	clear: both;
	float: left;
	display: block;
	height: 100px;
	}
	#ContentScreens {
		clear:both;
		float: left;
		margin: 0;
		width: 100%;
		display: block;
		position: relative;
		/*top:-550px;*/
	}
	body {
		background-color: #333333;
		font-family: Helvetica Neue, Helvetica, nimbus-sans, Arial, "Lucida Grande", sans-serif;
		background-color: #313131;
		color: #FFF;
		background-image: url(../_images/challenge/challenge_bg.png);
		background-repeat: repeat-x;
		-webkit-text-size-adjust: none;
	}
	.typekit-badge {
		display:none !important;
	}
	ul {
		font-size: 14px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	ol {
		font-size: 14px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	blockquote {
		font-size: 14px;
		margin-top: 10px;
		margin-bottom: 10px;
		font-weight: 500;
		letter-spacing: 1px;
	}
	hr {
		border: none;
		border-top: thin;
		border-top-color: #666;
		border-top-style: dotted;
	}
	
	#headerLogo {
		height: 40px;
		margin: 0px;
		padding: 0px;
	}
	#headerLogo img {
		margin-top: 0px;
		margin-bottom: 0px;
		margin-left:0px;
		margin-right:5px;
		float:left;
	}
	#headerLogo p{
		margin-top: 7px;
		margin-left:0px;
		font-size:20px;
		font-weight:200;
	}
	#headerChallengeTitle {
		float: left;
		display: block;
		margin: 0px;
		padding: 0px;
		border: 0px;
		height: 40px;
	}
	#headerChallengeTitle h1{
		font-size: 20px;
		font-weight: 200;
		margin: 0;
		padding: 0;
		line-height: 30px;
		border: 0;
	}
	#headerBackButton-CC {
	position: relative;
	float: right;
	display: block;
	width: 160px;
	height: 26px;
	margin-top: 48px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	border: 0px;
	background-image: url(../_images/challenge/backtoproject-CC.png);
	overflow: hidden;
	text-align: right;
	background-repeat: no-repeat;
	background-size: contain;
	padding: 0;
	padding-top: 4px;
	}
	#headerBackButton-CC a {
		font-size: 12px;
		color: #FFFFFF;
		margin-right: 10px;
	}
	#headerBackButton-CC:hover {
		background-image: url(../_images/challenge/backtoproject-hover-CC.png);
		background-repeat: no-repeat;
	}
	#headerBackButton {
		position: relative;
		float: right;
		display: block;
		width: 160px;
		height: 26px;
		margin-top: 48px;
		margin-bottom: 0px;
		margin-left: 0px;
		margin-right: 0px;
		border: 0px;
		background-image: url(../_images/challenge/backtoproject.png);
		overflow: hidden;
		text-align: right;
		background-repeat: no-repeat;
		background-size: contain;
		padding: 0;
		padding-top: 5px;
	}
	#headerBackButton a {
		font-size: 12px;
		color: #FFFFFF;
		margin-right: 10px;
	}
	#headerBackButton:hover {
		background-image: url(../_images/challenge/backtoproject-hover.png);
		background-repeat: no-repeat;
	}
	#Shadow{
		/* Firefox v3.5+ */
		-moz-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Safari v3.0+ and by Chrome v0.2+ */
		-webkit-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Firefox v4.0+ , Safari v5.1+ , Chrome v10.0+, IE v10+ and by Opera v10.5+ */
		box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		-ms-filter: "progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true)";
		filter:progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true);
	
	}
	#NavShadowDiv {
		position: relative;
		display: block;
		width: 100%;
		border-top-color: #595959;
		border-top-style: solid;
		border-top-width: 1px;
		z-index: -1;
		height: 76px;
		top: -120px;
		/* Firefox v3.5+ */
		-moz-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Safari v3.0+ and by Chrome v0.2+ */
		-webkit-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Firefox v4.0+ , Safari v5.1+ , Chrome v10.0+, IE v10+ and by Opera v10.5+ */
		box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		-ms-filter: "progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true)";
		filter:progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true);
	
	}
	#NavRibbonDiv {
		position: relative;
		overflow: hidden;
		cursor: pointer;
	}
	#TeacherNotes-Info-CC {
		float: right;
		width: 40px;
		height: 40px;
		background-image: url(../_images/challenge/button-info-CC.png);
		clear: none;
	}
	#TeacherNotes-Info-CC:hover {
		background-image:url(../_images/challenge/button-info-hover-CC.png);
	}
	
	#TeacherNotes-Close-CC {
		float: right;
		width:40px;
		height:40px;
		background-image:url(../_images/challenge/button-info-close-CC.png);
		display:none;
	}
	#TeacherNotes-Close-CC:hover {
		background-image:url(../_images/challenge/button-info-close-hover-CC.png);
	}
	
	#TeacherNotes-Shadow-CC {
		float: right;
		width:40px;
		height:40px;
		position: relative;
		display: block;
		z-index: -1;
		top: -40px;
		/* Firefox v3.5+ */
		-moz-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Safari v3.0+ and by Chrome v0.2+ */
		-webkit-box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		/* Firefox v4.0+ , Safari v5.1+ , Chrome v10.0+, IE v10+ and by Opera v10.5+ */
		box-shadow: 0px 0px 10px rgba(0,0,0,0.50);
		-ms-filter: "progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true)";
		filter:progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=0,Color=#3d000000,Positive=true);
	}
	#TeacherNotes-Text-CC {
		position: relative;
		float: right;
		background-color: rgba(0,0,0,1);
		top: -40px;
		left: -40px;
		width: 660px;
		padding-left: 10px;
		padding-right: 10px;
		border: 0px;
		margin: 0px;
		z-index: 1;
		overflow: hidden;
		clear: both;
		max-height:600px;
		overflow:scroll;
	}

</style>
    
<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body> 

	<div class="container">
    
        <section class="row-fluid">
            <!-- Header Starts -->
          <div id="Header" class="span12">
                <div id="headerBackButton-CC">
                  <a href="#">Back to Lesson Details</a>
                </div>
                <a href="index.php">
                <div id="headerLogo">
                <img src="img/headerlogo.png" alt="The Projector" width="48" height="24" />
                <p style="color:#FFF;">Common Core Lessons</p>
                </div>
                </a>
                <div id="headerChallengeTitle">
                  <h1>Lesson Title</h1>
                </div>
            </div>
            <!-- Header Ends -->
         </section>
         
         <section class="row-fluid">   
            <!-- NavRibbon Starts -->
            <div id="RibbonNavigation" class="span12">
                <div id="NavRibbonDiv"> 
                    <div id="ribbonContainer">
                        <div id="leftButton-CC"></div>
                        <div id="rightButton-CC"></div>
                        <div id="ribbonStrip">
                            <div id="ribbonButtons">
                            
                            <!-- Placeholder navigation Starts -->
                            
            
                                <div id="ribbonChallenge_CC_Opening">
                                  <div id="ribbonChallenge_CC_OpeningTop">
                                    <h2>OPENING</h2>
                                  </div>
                                  <div class="ribbonChallenge_CC_OpeningColumnWrap" data-type="wrapper" data-number="1" data-id="220" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonChallenge_CC_OpeningBottom" data-type="bottom">
                                      <p class="Challenge_CC_OpeningNumber">1</p>
                                      <h2 class="ribbonChallenge_bottomH2">Introduction</h2>
                                    </div>
                                    <div class="ribbonChallenge_CC_OpeningSelector visibleStyle" data-type="selector"> </div>
                                  </div>
                                  <div class="ribbonChallenge_CC_OpeningColumnWrap" data-type="wrapper" data-number="2" data-id="222" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonChallenge_CC_OpeningBottom" data-type="bottom">
                                      <p class="Challenge_CC_OpeningNumber">2</p>
                                      <h2 class="ribbonChallenge_bottomH2">Breaking Eggs</h2>
                                    </div>
                                    <div class="ribbonChallenge_CC_OpeningSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                  <div class="ribbonChallenge_CC_OpeningColumnWrap" data-type="wrapper" data-number="3" data-id="223" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonChallenge_CC_OpeningBottom" data-type="bottom">
                                      <p class="Challenge_CC_OpeningNumber">3</p>
                                      <h2 class="ribbonChallenge_bottomH2">Math Mission</h2>
                                    </div>
                                    <div class="ribbonChallenge_CC_OpeningSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                                
                                <div id="ribbonStart_CC_Writing">
                                  <div id="ribbonStart_CC_WritingTop">
                                    <h2>INDEPENDENT WRITING</h2>
                                  </div>
                                  <div class="ribbonStart_CC_WritingColumnWrap" data-type="wrapper" data-number="4" data-id="224" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonStart_CC_WritingBottom" data-type="bottom">
                                      <p class="Start_CC_WritingNumber">4</p>
                                      <h2 class="ribbonChallenge_bottomH2">The Price of 9 Eggs</h2>
                                    </div>
                                    <div class="ribbonStart_CC_WritingSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                                
                                <div id="ribbonPlan_CC_GroupWork">
                                  <div id="ribbonPlan_CC_GroupWorkTop">
                                    <h2>SMALL GROUP WORK</h2>
                                  </div>
                                  <div class="ribbonPlan_CC_GroupWorkColumnWrap" data-type="wrapper" data-number="5" data-id="225" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonPlan_CC_GroupWorkBottom" data-type="bottom">
                                      <p class="Plan_CC_GroupWorkNumber">5</p>
                                      <h2 class="ribbonChallenge_bottomH2">Make Connections</h2>
                                    </div>
                                    <div class="ribbonPlan_CC_GroupWorkSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                                
                                <div id="ribbonCreate_CC_CommonRead">
                                  <div id="ribbonCreate_CC_CommonReadTop">
                                    <h2>COMMON READ</h2>
                                  </div>
                                  <div class="ribbonCreate_CC_CommonReadColumnWrap" data-type="wrapper" data-number="6" data-id="226" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonCreate_CC_CommonReadBottom" data-type="bottom">
                                      <p class="Create_CC_CommonReadNumber">6</p>
                                      <h2 class="ribbonChallenge_bottomH2">Find the Unit Price</h2>
                                    </div>
                                    <div class="ribbonCreate_CC_CommonReadSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                  <div class="ribbonCreate_CC_CommonReadColumnWrap" data-type="wrapper" data-number="7" data-id="227" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonCreate_CC_CommonReadBottom" data-type="bottom">
                                      <p class="Create_CC_CommonReadNumber">7</p>
                                      <h2 class="ribbonChallenge_bottomH2">Understanding Unit Price</h2>
                                    </div>
                                    <div class="ribbonCreate_CC_CommonReadSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                  <div class="ribbonCreate_CC_CommonReadColumnWrap" data-type="wrapper" data-number="8" data-id="228" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonCreate_CC_CommonReadBottom" data-type="bottom">
                                      <p class="Create_CC_CommonReadNumber">8</p>
                                      <h2 class="ribbonChallenge_bottomH2">Reflect on Your Work</h2>
                                    </div>
                                    <div class="ribbonCreate_CC_CommonReadSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                                
                                <div id="ribbonRevise_CC_Revise">
                                  <div id="ribbonRevise_CC_ReviseTop">
                                    <h2>HOMEWORK</h2>
                                  </div>
                                  <div class="ribbonRevise_CC_ReviseColumnWrap" data-type="wrapper" data-number="9" data-id="229" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonRevise_CC_ReviseBottom" data-type="bottom">
                                      <p class="Revise_CC_ReviseNumber">9</p>
                                      <h2 class="ribbonChallenge_bottomH2">Foxtrot</h2>
                                    </div>
                                    <div class="ribbonRevise_CC_ReviseSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                  <div class="ribbonRevise_CC_ReviseColumnWrap" data-type="wrapper" data-number="10" data-id="230" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonRevise_CC_ReviseBottom" data-type="bottom">
                                      <p class="Revise_CC_ReviseNumber">10</p>
                                      <h2></h2>
                                    </div>
                                    <div class="ribbonRevise_CC_ReviseSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                                
                                <div id="ribbonCreate_CC_CommonRead">
                                  <div id="ribbonCreate_CC_CommonReadTop">
                                    <h2>CLOSING</h2>
                                  </div>
                                  <div class="ribbonCreate_CC_CommonReadColumnWrap" data-type="wrapper" data-number="11" data-id="231" ontouchstart="touchStart(event,'step');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);" >
                                    <div class="ribbonCreate_CC_CommonReadBottom" data-type="bottom">
                                      <p class="Create_CC_CommonReadNumber">11</p>
                                      <h2></h2>
                                    </div>
                                    <div class="ribbonCreate_CC_CommonReadSelector hiddenStyle" data-type="selector"> </div>
                                  </div>
                                </div>
                            
                            <!-- Placeholder navigation Ends-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- NavRibbon Ends --> 
          </section>
          
          <section class="row-fluid">       	
            <div class="span12" style="background-color:#323232; text-transform:uppercase; padding:10px;">
            	<p>Access Now</p>
            </div>
          </section>
          
          <section class="row-fluid">     
            <!-- row 1 -->
                <div class="span3">
                <!-- 1 -->	<div id="info1" class="modal hide fade in" style="display: none; ">
                                <div class="modal-body">
                                      <a class="close" data-dismiss="modal">×</a>
                                      <h3>Powers of Ten</h3>
                                      <h4>Media Type: Video</h4>
                                      <p style="color:#000">This short film by Charles and Ray Eames to gives a visual perspective on powers of ten.</p>		        
                                 </div>
                            </div>
                            <a data-toggle="modal" href="#info1"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                            <a href="http://powersof10.com/film" target="_blank">
                                <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                <p class="FoxtrotBodyCopy">Short description ... </p>
                            </a>
                </div>
                <div class="span3">
                <!-- 2 -->  <div id="info2" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Multiply and Divide Fractions</h3>
                              <h4>Media Type: Text and Interactive Website</h4>
                              <p style="color:#000">Read about using visual models to understand multiplication and division of fractions.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info2"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank">
                        	<img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 3 -->  <div id="info3" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Sizing up the Universe</h3>
                              <h4>Media Type: Interactive Website</h4>
                              <p style="color:#000">Check your guesstimates in this game to get a handle on the relative size of the universe.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info3"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">
                        	<img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 4 -->  <div id="info4" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Calculating rectangular area</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">Watch the CyberSquad use tarps, fence posts, and a grid made out of rope to figure out the area of two different sized parcels.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info4"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank">
                        	<img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
          </section>
          
          <section class="row-fluid">    
            <!-- row 2 -->
                <div class="span3">
                <!-- 5 -->  <div id="info5" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Cooking by Numbers</h3>
                              <h4>Media Type: Text </h4>
                              <p style="color:#000">Read about using ratios when applied to the practical application of cooking.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info5"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://www.learner.org/interactives/dailymath/cooking.html" target="_blank">
                        	<img src="img/static-content/mathindailylife.jpg" alt="Cooking by Numbers" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Cooking by Numbers</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 6 -->  <div id="info6" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Landscape Architect</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">In this video, you'll learn how a landscape architect uses geometry and measurement in his job.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info6"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://vitalnj.pbslearningmedia.org/content/f79f2801-256b-4ddf-ba0d-0567845408f9/" target="_blank">
                        	<img src="img/static-content/landscapearchitect.jpg" alt="Landscape Architect" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Landscape Architect</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 7 -->  <div id="info7" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>It Feels Wonderful</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">What's a polyhedra? In this video, master weaver Stacy Speyer explains how math informs her art.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info7"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://www.exploratorium.edu/tv/index.php?project=98&program=1098" target="_blank">
                        	<img src="img/static-content/itfeeelswonderful_geometric.jpg" alt="It Feels Wonderful" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">It Feels Wonderful</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 8 -->  <div id="info8" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Sculptor</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">Watch this video to learn how a sculptor uses geometry and measurement in her art.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info8"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://vitalnj.pbslearningmedia.org/content/3fa8f38f-d419-47f5-a5b6-7fb3c9aed3a5/" target="_blank">
                        	<img src="img/static-content/sculptor.jpg" alt="Sculptor" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Sculptor</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
          </section>
          
          <section class="row-fluid">       
            <!-- row 3 -->
            <div class="span3">
                <!-- 9 -->  <div id="info9" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Gears and proportions</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">In this video, Bianca  goes to a bike shop and learns about gears on bicycles and how to calculate their rotation.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info9"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.number.rat.lpgears/#content/4dd2ff59add2c73bce009582" target="_blank">
                        	<img src="img/static-content/gears-proportions.jpg" alt="Gears and proportions" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Gears and proportions</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 10-->  <div id="info10" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Passionately Curious</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">In this video, you'll meet John Edmark and his awesome kaleidoscopic piece, The Geometron; you'll also learn why he thinks geometry is anything but dry.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info10"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://www.exploratorium.edu/tv/index.php?project=98&program=1097&type=clip" target="_blank">
                        	<img src="img/static-content/gears_passionatelycurious.jpg" alt="Passionately Curious" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Passionately Curious</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 11-->  <div id="info11" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Ocean Temperatures</h3>
                              <h4>Media Type: Video</h4>
                              <p style="color:#000">Watch this video to learn about ocean temperatures and to see scientists in action as they collect data.<br><br>
                                <i>Note: Ocean Temperatures video is the fourth video in the fourth row.</i></p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info11"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://www.nbclearn.com/portal/site/learn/changing-planet" target="_blank">
                        	<img src="img/static-content/changing_planet.jpg" alt="Ocean Temperatures" class="FoxtrotThumbnailImg">
                            <h2 class="FoxtrotTitleCopy">Ocean Temperatures</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
                <div class="span3">
                <!-- 12-->  <div id="info12" class="modal hide fade in" style="display: none; ">
                            <div class="modal-body">
                              <a class="close" data-dismiss="modal">×</a>
                              <h3>Finding Factors of 20
                              <h4>Media Type: Video</h4>
                              <p>The CyberSquad must find two numbers whose product is 20. They use seashells to create an array to test out possible factors.</p>		        
                            </div>
                        </div>
                        <a data-toggle="modal" href="#info12"><img src="img/button-info-CC.png" alt="information" class="InfoButton"></a>
                        <a href="http://vitalnj.pbslearningmedia.org/content/wnet09.math.number.mul.wnetfactor20/" target="_blank">
                        	<img src="img/static-content/factorsof20.jpg" alt="Finding Factors of 20" class="FoxtrotThumbnailImg">
                        	<h2 class="FoxtrotTitleCopy">Finding Factors of 20</h2>
                            <p class="FoxtrotBodyCopy">Short description ... </p>
                        </a>
                </div>
            </section>
     </div>   
  
    <!-- JS at the end of the page for faster loading -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script> 

</body>
</html>

