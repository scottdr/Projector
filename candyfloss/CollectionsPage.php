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

$query_UnitsCollectionsQuery = "SELECT * FROM CF_Resources ORDER BY Unit, Collection";
$UnitsCollectionsQuery = mysql_query($query_UnitsCollectionsQuery, $projector) or die(mysql_error());
$row_UnitsCollectionsQuery = mysql_fetch_assoc($UnitsCollectionsQuery);

// Option used to display Resources without a Collection.
//$collections = array("Curated", "Pearson", "OER", null);
// Option to only display Resources with defined Collections.
$collections = array("Curated", "Pearson", "OER");

// Calculate 
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resource Collections</title>
        
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
          <div class="navbar-inner navbar-inner-blue">
            <ul class="nav">
              <li class="active"><a href="CollectionsPage.php">COLLECTIONS</a></li>
              <li><a href="#">MY WEB</a></li>
              <li><a href="#">ABOUT</a></li>
            </ul>
            <div class="pagination-right">
                <a class="btn btn-small btn-primary" href="ResourceAddNew.php?Action=Add">
                  <i class="icon-plus icon-white"></i> Add new
                </a>
                <a class="btn btn-small btn-primary" href="ResourcesViewAll.php">
                  <i class="icon-list-alt icon-white"></i> View All
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
                   		$listElementStyle = ' class="active"';
						do { 
									?>
                  	<li<?php echo $listElementStyle;$listElementStyle='';?>><a href="#Level<?php echo $row_UnitQuery['Unit'];?>-A" data-toggle="tab">UNIT <?php echo $row_UnitQuery['Unit'];?></a></li>
										
					<?php
						} while ($row_UnitQuery = mysql_fetch_assoc($UnitQuery));
					?>

					</ul>
                  
                  <!-- Tab content -->
                  
                  <div class="tab-content">
                  
                  <?php 
                  	$tabPaneClassSuffix=' active';
                  	for ($i=0;$i<$totalRows_UnitQuery;$i++) {
                  		// Unit iteration.
                  	?>
                    <div class="tab-pane<?php echo $tabPaneClassSuffix;$tabPaneClassSuffix='';?>" id="Level<?php echo $i+1;?>-A">
                      
            			<div class="accordion" id="accordion<?php echo $i+1;?>">
            			
            				 <?php 
            				 $AccordionHeaderStyleSuffix = '';
            				 $AccordionStyleSuffix = ' in';
            				 
            				 // Collections iteration with a given Unit.
            				//mysql_data_seek ( $UnitsCollectionsQuery, 0 );
            				 foreach($collections as $collectionName) {
            				 	$UnitCollectionName = '' . ($i+1) . $collectionName;
                  			// Category iteration with given Unit. ?>
                  			<!-- fill in with accordions -->
                  			
                  			<div class="accordion-group">
                              <div class="accordion-heading">
                                <a class="accordion-toggle<?php echo $AccordionHeaderStyleSuffix;$AccordionHeaderStyleSuffix=' collapsed';?>" data-toggle="collapse" data-parent="#accordion<?php echo $i+1;?>" href="#collapse<?php echo $UnitCollectionName;?>">
                                  <?php echo $collectionName==null?"Other":$collectionName?></a>
                              </div>
                              <div id="collapse<?php echo $UnitCollectionName;?>" class="accordion-body collapse<?php echo $AccordionStyleSuffix;$AccordionStyleSuffix=' ';?>">
                                <div class="accordion-inner">
                                  
                                  
                                  <section class="row-fluid">
                                  
                                  
                                   <?php 
										$itemCount = 0;
										do {
											if ( ($row_UnitsCollectionsQuery['Unit']==($i+1)) && ($row_UnitsCollectionsQuery['Collection']==$collectionName) ) {
												$itemCount++;
											?>
													<div class="span3 FoxtrotSpan3">
                                                        <a href="ResourceDetail.php?Id=<?php echo $row_UnitsCollectionsQuery['Id'];?>">
                                                            <img src="<?php echo $row_UnitsCollectionsQuery['ImageThumbnail'];?>" alt="<?php echo $row_UnitsCollectionsQuery['Name'];?>" class="FoxtrotThumbnailImg">
                                                            <h2 class="FoxtrotTitleCopy"><?php echo $row_UnitsCollectionsQuery['Name'];?></h2>
                                                        </a>
                                            		</div>
									<?php  
												if ($itemCount%4==0) {
													echo '</section>
<section class="row-fluid">';
												}
											}
										
										} while ($row_UnitsCollectionsQuery = mysql_fetch_assoc($UnitsCollectionsQuery));
									?>
                                      
                                   </section>
                                   
                                  
                                </div>
                              </div>

                  			</div>
                  				
                  			
                  			<?php
                  			mysql_data_seek ( $UnitsCollectionsQuery, 0 );
                  			$row_UnitsCollectionsQuery = mysql_fetch_assoc($UnitsCollectionsQuery);
	                  		};
	                  		?>
                  			
                  			
                                                     
                          </div>
                                             
                    </div>
                                        
                    <?php
						}
					?>
                  </div>  <!-- Tab content END -->
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
mysql_free_result($UnitsCollectionsQuery);
?>
