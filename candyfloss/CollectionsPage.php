<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resource Detail Page</title>
        
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-customized-web.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 shim for IE backwards compatibility -->
            <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
    	
        
        <!-- Header Starts -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                 <a class="brand" href="#"><img src="../_images/headerlogo.png">Common Core</a>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <section class="row-fluid" style="padding-top:50px;">
                <div class="span12" style="background-color: #02ACF0; height: 40px; overflow: hidden; border: 0; padding: 0; margin: 0;">
                    <a href="#" class="navItemDown">COLLECTIONS</a>
                    <a href="#" class="navItemUp">MY WEB</a>
                    <a href="#" class="navItemUp">ABOUT</a>
                </div>
            </section>  
        </div>
        
        <!-- Content Starts -->
        <div class="container-fluid">
            <section class="row-fluid" style="padding-top:10px;padding-bottom:10px;"> 
              
              <div class="span12">
                <h3>Common Core Resource Collections</h3>
              </div>
              <!--<div class="span4">
              	<div id="headerBackButton">
                  <a href="ResourceDetail.php">Back to Lesson Details</a>
                </div>
              </div>-->
              
            </section>

            
            <section class="row-fluid" style=" background-color:#FFF;">
                
                <nav class="navbar navbar-inverse span12">
                    <div class="navbar-inner">
                        <div class="nav-collapse">
                            <ul class="nav">
                              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">SORT BY<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Unit</a></li>
                                    <li><a href="#">Date</a></li>
                                    <li><a href="#">Resource Type</a></li>
                                </ul>
                              </li>
                            </ul>
                            
                        </div>
                     </div>
<!--                <form class="form-search">
                  <div class="input-append">
                    <input type="text" class="span2 search-query">
                    <button type="submit" class="btn">Search</button>
                  </div>
                </form>
-->                    
                </nav>
                
                <div class="tabbable tabs-left" style="padding:20px;">
                
                  <ul class="nav nav-tabs span3">
                    <li class="active"><a href="#Level1-A" data-toggle="tab">CURATED LIBRARY</a></li>
                    <li><a href="#Level1-B" data-toggle="tab">WEB RESOURCES</a></li>
                    <li><a href="#Level1-C" data-toggle="tab">SHOW ALL</a></li>
                  </ul>
                  
                  <div class="tab-content">
                    <div class="tab-pane active" id="Level1-A">
                    <!-- SECTION A -->
                      
            			<div class="accordion" id="accordion1">
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                  Unit 1
                                </a>
                              </div>
                              <div id="collapseOne" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                  
                                  
                                  <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                                  Unit 2
                                </a>
                              </div>
                              <div id="collapseTwo" class="accordion-body collapse">
                                <div class="accordion-inner">

                                      
                                                                        <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>
                                      

                                </div>
                              </div>
                            </div>
                            
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">
                                  Unit 3
                                </a>
                              </div>
                              <div id="collapseThree" class="accordion-body collapse">
                                <div class="accordion-inner">

                                    <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>

                                </div>
                              </div>
                            </div>
                          </div>
                                             
                    </div>
                    <div class="tab-pane" id="Level1-B">
                    <!-- SECTION B -->
                      
						<div class="accordion" id="accordion2">
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#Level1-B-collapseOne">
                                  Interactive diagrams
                                </a>
                              </div>
                              <div id="Level1-B-collapseOne" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                  
                                  
                                                                   <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#Level1-B-collapseTwo">
                                  Articles
                                </a>
                              </div>
                              <div id="Level1-B-collapseTwo" class="accordion-body collapse">
                                <div class="accordion-inner">

                                      
                                                                        <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>
                                      

                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#Level1-B-collapseThree">
                                 Video
                                </a>
                              </div>
                              <div id="Level1-B-collapseThree" class="accordion-body collapse">
                                <div class="accordion-inner">

                                                                       <section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>

                                </div>
                              </div>
                            </div>
                          </div>
                          
                                                
                    </div>
                    
                    <div class="tab-pane" id="Level1-C">
                    <!-- SECTION C -->
                    	<section class="row-fluid">     
                                        <!-- row 1 -->
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 1 -->	<!--<a href="http://powersof10.com/film" target="_blank">-->
                                                        <a href="ResourceDetail.php">
                                                            <img src="img/static-content/powersoften.jpg" alt="Powers of Ten" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Powers of Ten</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            <p class="FoxtrotBodyCopy">Short description ... </p>
                                                    	</a>
                                            </div>
                                      </section>
                    </div>
                    
                    
                  </div>
                </div>

            </section>
            
            <section class="row-fluid"> 
              <!-- Footer Starts -->
              <div id="Footer" class="span12">
              </div>
            </section>
            
            
        </div>    
     

         
     <!-- JS at the end of the page for faster loading -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script> 
	</body>
</html>
