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
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                 <a class="brand" href="#"><img src="img/headerlogo.png">Common Core</a>
                </div>
                <div><a class="btn btn-small btn-inverse" style="height:20px; padding:5px; line-height:20px; right:0; top:0; position:absolute" href="http://ec2-184-169-189-211.us-west-1.compute.amazonaws.com/candyfloss/ResourceAddNew.php?Action=Add">
	          <i class="icon-plus icon-white"></i> 
	          Add new
	          </a>
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
       <!-- Content Starts -->
        <div class="container-fluid">
        
        	<!-- Page title -->
            <section class="row-fluid" style="padding-top:10px;padding-bottom:10px;"> 
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
                        <th width="10%">ID</th>
                        <th width="20%">Thumbnail</th>
                        <th width="50%">Title</th>
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
                      <td><a class="btn btn-mini btn-danger" href="#"><i class="icon-minus-sign icon-white"></i> Delete</a></td>
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
