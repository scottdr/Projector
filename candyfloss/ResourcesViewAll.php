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
$query_resourceList = "SELECT * FROM CF_Resources";
$resourceList = mysql_query($query_resourceList, $projector) or die(mysql_error());
$row_resourceList = mysql_fetch_assoc($resourceList);
$totalRows_resourceList = mysql_num_rows($resourceList);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>All Resource</title>
        
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-customized-web.css" rel="stylesheet" type="text/css" />
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        
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
        
        	<!-- Page title -->
            <section class="row-fluid"> 
              <div class="span12">
                <h3>All Resources</h3>
              </div>
            </section>

            
          <section class="row-fluid" style=" background-color:#FFF;">
            	<div style="padding:10px;" class="span12">
            	  <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                        <th width="5%">ID</th>
                        <th width="10%">Thumbnail</th>
                        <th width="40%">Title</th>
                        <th width="10%">Unit</th>
                        <th width="15%">Collection</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                	<?php do { ?>
                    <tr>
                      <td>
                      <a class="btn btn-mini btn-primary" href="ResourceAddNew.php<?php echo "?Action=Edit&Id=" . $row_resourceList['Id'] ?>"><i class="icon-edit icon-white"></i> Edit</a>
                      </td>
                      <td><?php echo $row_resourceList['Id']; ?></td>
                      <td><img src="<?php echo $row_resourceList['ImageThumbnail']; ?>" alt="" name="" width="100" class="img-polaroid"/></td>
                      <td><a href="ResourceDetail.php?Id=<?php echo $row_resourceList['Id']; ?>"><?php echo $row_resourceList['Name']; ?></a></td>
                      <td><?php echo $row_resourceList['Unit']; ?></td>
                      <td><?php echo $row_resourceList['Collection']; ?></td>
                      <td><a data-controls-modal="ConfirmDelete" class="btn btn-mini btn-danger" href="#"><i class="icon-minus-sign icon-white"></i> Delete</a></td>
                    </tr>
                    <?php } while ($row_resourceList = mysql_fetch_assoc($resourceList)); ?>
                </tbody>
            </table>
            	</div>
          </section>
		</div>
        
        <!-- JS at the end of the page for faster loading -->

      	
      <script src="http://code.jquery.com/jquery-latest.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script>
      <script src="js/bootstrap-datepicker.js"></script> 
	  <script>
            $(function(){
                
                $('#dp1').datepicker({
                    format: 'mm-dd-yyyy'
                });
                
            });
        </script>
</body>
</html>
