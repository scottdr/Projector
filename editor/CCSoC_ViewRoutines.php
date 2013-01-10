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

session_start();
$_SESSION['ActiveNav'] = "routines";

$projectId = "-1";
if (isset($_GET['Id'])) {
  $projectId = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);

$query_MediaQuery = "SELECT * FROM Routines ORDER BY Id";

$MediaQuery = mysql_query($query_MediaQuery, $projector) or die(mysql_error());
$row_MediaQuery = mysql_fetch_assoc($MediaQuery);
$totalRows_MediaQuery = mysql_num_rows($MediaQuery);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Routines</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />
<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<div class="container-fluid">
	
    <?php include("EditorHeader.php"); ?>
    
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      	<h2 class="brand"></h2>
      	<?php require("SubNav.php"); ?>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid" style="margin-top: 44px;">

        <h3 class="span11 offset1">
        	Routines:
            <br/><br/>
            
            <a class="btn btn-small" style="height:20px; padding:5px; line-height:20px;" href="CCSoC_EditRoutine.php?action=Add<?php if ($projectId > 0) echo "&ProjectId=" . $projectId; if (isset($projectName)) echo "&ProjectName=" . $projectName; ?>">
            <i class="icon-plus"></i> 
            Add Routine
            </a>
        
        </h3>

  </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover" style="min-width:400px">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                      	<!--<th width="5%">ID</th> -->
                        <th width="70%">Routine</th>
                        <!--<th width="10%">Project ID</th>-->
                    </tr>
                </thead>
                <tbody>
                		<?php do { ?>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="CCSoC_EditRoutine.php?Id=<?php echo $row_MediaQuery['Id']; if (isset($projectName)) echo "&ProjectName=" . $projectName; if (isset($projectId)) echo "&ProjectId=" . $projectId;?>"><i class="icon-edit icon-white"></i> Edit</a>
                  			</td>
                        <!-- <td><?php echo $row_MediaQuery['Id']; ?></td> -->
                        <td><?php echo $row_MediaQuery['RoutineName']; ?></td>
                        
                    </tr>
                  	<?php } while ($row_MediaQuery = mysql_fetch_assoc($MediaQuery)); ?>
                </tbody>
            </table>
      </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>