<?php require_once('../Connections/projector.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_projector, $projector);
$query_UnitQuery = "SELECT DISTINCT Unit FROM CF_Resources ORDER BY Unit";
$UnitQuery = mysql_query($query_UnitQuery, $projector) or die(mysql_error());
$row_UnitQuery = mysql_fetch_assoc($UnitQuery);
$totalRows_UnitQuery = mysql_num_rows($UnitQuery);
?>
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
    
    <header class="row-fluid">
        <div class="navbar navbar-inverse span12" style="margin-bottom:0px;">
            <div class="navbar-inner">
                 <a class="brand" href="#" style="padding-left:25px;">Candy Floss</a>
                 <p class="pagination-right" style="padding-top:15px;padding-right:5px;">Welcome, Bob &nbsp; | &nbsp; Sign out</p>
             </div>
		</div>
        
        <div class="navbar">
          <div class="navbar-inner">
            <ul class="nav">
              <li class="active"><a href="CollectionsPage.php">COLLECTIONS</a></li>
              <li><a href="#">MY WEB</a></li>
              <li><a href="#">ABOUT</a></li>
            </ul>
            <div class="pagination-right">
                <a class="btn btn-small" href="ResourceAddNew.php?Action=Add">
                  <i class="icon-plus"></i> Add new
                </a>
                <a class="btn btn-small" href="ResourcesViewAll.php">
                  <i class="icon-list-alt"></i> View All
                </a>
            </div>
          </div>
        </div>
        
	</header>
    
        
    <div class="container-fluid">


       <!-- Content Starts -->
               	<!-- Page title -->
            <section class="row-fluid"> 
              <div class="span12">
                <h3>ELA - Grade 10 Resource Collections</h3>
              </div>
            </section>

            
            <section class="row-fluid" style=" background-color:#FFF;">
            
            	<!-- Filter -->
            	<!--<div class="navbar navbar-inverse span12" style="background-color:#1B1B1B;">
                    <ul class="nav">
                      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">SORT BY<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Age range</a></li>
                            <li><a href="#">Date</a></li>
                            <li><a href="#">Resource Type</a></li>
                            <li><a href="#">Educational Use</a></li>
                            <li><a href="#">Publisher</a></li>
                            <li><a href="#">Author</a></li>
                        </ul>
                      </li>
                    </ul>
                </div>-->
                                 

                <!-- Left vertical tabs -->
                <div class="tabbable tabs-left" style="padding:20px;">
                
                  <ul class="nav nav-tabs span3">
                   <?php 
										
										do { ?>
                  	<li><a href="#Level1-A" data-toggle="tab">UNIT <?php echo $row_UnitQuery['Unit'];?></a></li>
										
									<?php
										} while ($row_UnitQuery = mysql_fetch_assoc($UnitQuery));
									?>

									</ul>
                  
                  <!-- Tab content -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="Level1-A">
                    <!-- SECTION A -->
                      
            			<div class="accordion" id="accordion1">
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                  Curated Library</a>
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
                                                    	</a>
                                            </div>
                                      </section>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                                  Pearson Resources</a>
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
                                                    	</a>
                                            </div>
                                      </section>
                                      

                                </div>
                              </div>
                            </div>
                            
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">
                                  OER Resources</a>
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
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
                                  Curated Library
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
                                                    	</a>
                                            </div>
                                      </section>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#Level1-B-collapseTwo">
                                  Pearson Resources
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
                                                    	</a>
                                            </div>
                                      </section>
                                      

                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#Level1-B-collapseThree">
                                 OER Resources
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
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
                                                            
                                                        </a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 2 -->  <!--a href="http://www.learner.org/courses/learningmath/number/session9/part_a/" target="_blank"-->
                                                        <a href="ResourceDetail.php">   
                                                            <img src="img/static-content/fractions.jpg" alt="Multiply and Divide Fractions" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Multiply and Divide Fractions</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 3 -->  <!--a href="http://smithsonianeducation.org/idealabs/universe/index.html" target="_blank">-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/smithsonian_universe.jpg" alt="Sizing up the Universe" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Sizing up the Universe</h2>
                                                            
                                                    	</a>
                                            </div>
                                            <div class="span3 FoxtrotSpan3">
                                            <!-- 4 -->  <!--a href="http://vitalnj.pbslearningmedia.org/content/vtl07.math.measure.polg.calcrectar/" target="_blank"-->
                                                        <a href="ResourceDetail.php">    
                                                            <img src="img/static-content/calculating_rectangles.jpg" alt="Calculating rectangular area" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy">Calculating rectangular area</h2>
                                                            
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
<?php
mysql_free_result($UnitQuery);
?>
