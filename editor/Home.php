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
    <section class="row-fluid" style="margin-top: 44px;">
        <h3 class="span11 offset1">Welcome to the Mermaid content editing tool.</h3>
    </section>
	<section class="row-fluid">
		<h4 class="span11 offset1">1. What type of content are you working on?</h4>
        <label class="radio span11 offset1">
            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
            Common Core Lesson
      </label>
        <label class="radio span11 offset1">
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
            Projector Challenge
        </label>
  	</section>
	<section class="row-fluid">
      <h4 class="span11 offset1">2. Are you adding new content, or editing existing content?</h4>
    </section>
    <section class="row-fluid" style="padding-bottom:10px">
   	  <input name="Add" type="button" class="span4 offset1 btn btn-large" id="Submit" value="Add content">
    </section>
  	<section class="row-fluid">
    	<input name="Edit" type="button" class="span4 offset1 btn btn-large" id="Submit" value="Edit content">
    </section>
    <section class="row-fluid">
    	<p class="span11 offset1" style="margin-top: 44px;">
        	These buttons are temporary:
            <a class="btn btn-small" href="CCSoC_EditLesson.php"><i class="icon-edit"></i> Common Core</a>
            <a class="btn btn-small" href="Projector_EditChallenge.php"><i class="icon-edit"></i> Projector</a>
        </p>
    </section>
    
    
    
    
  <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>