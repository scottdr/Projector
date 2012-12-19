<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Content</title>
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
      <h2 class="brand" >&lt;Challenge name&gt;</h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php"><i class="icon-edit"></i>Details</a></li>
          <li><a href="Projector_EditSteps.php"><i class="icon-edit"></i> Steps</a></li>
          <li><a href="Projector_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li class="active"><a href="Projector_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
    <section class="row-fluid">
        <div class="span12" style="background-color:#333;">
        <p class="label">Dynamic ribbon and content layouts inserted here: </p>

        <!-- RIBBON -->
        
        <!-- CONTENT TEMPLATE -->
        
        </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>