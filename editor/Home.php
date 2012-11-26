<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
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
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
         <h3 class="span11 offset1">Welcome to the Mermaid content editing tool.</h3>
    </section>
    <section class="row-fluid" style="padding-bottom:10px">
   	  <input name="Add" type="button" class="span4 offset1 btn btn-large" id="Submit" value="Add new content">
    </section>
  	<section class="row-fluid">
    	<input name="Edit" type="button" class="span4 offset1 btn btn-large" id="Submit" value="Edit existing content">
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>