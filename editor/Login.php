<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
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
    
	<section class="row-fluid" style="margin-top: 44px;">
         <h3 class="span11 offset1">Log in to start adding content.</h3>
    </section>
    <section class="row-fluid">
   	  <input name="Username" type="text" class="span3 offset1" id="Username" placeholder="Username">
    </section>
    <section class="row-fluid">
    	<input name="Password" type="password" class="span3 offset1" id="Password" placeholder="Password">
    </section>
  <section class="row-fluid">
  	<a href="Home.php" class="span2 offset1 btn btn-large btn-primarybtn btn-primary">Login</a>
  </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>