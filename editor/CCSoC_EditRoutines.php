<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define CCSoC Routines</title>
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
    
	<!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand">&lt;Lesson name&gt;</h2>
        <ul class="nav">
          <li><a href="CCSoC_EditLesson.php"><i class="icon-edit"></i> Lesson details</a></li>
          <li class="active"><a href="CCSoC_EditRoutines.php"><i class="icon-edit"></i> Routines</a></li>
          <li><a href="CCSoC_EditTasksSteps.php"><i class="icon-edit"></i> Tasks  &amp; steps</a></li>
          <li><a href="CCSoC_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="CCSoC_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define routines: 
        </h3>
        <ul class="span11 offset1">
          <li>Select the lesson routines from the left panel and add them. Press the control key to select multiple items.</li>
          <li>You can add multiple copies of the same routine by repeating the process.</li>
        </ul>
	</section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
    <div class="row-fluid">
		<p class="span3 offset1">
        	Available routines:
        </p>
        <p class="span3 offset1">
        	Routines in this lesson:
        </p>
    </div>
    <section class="row-fluid">
        <div class="span3 offset1">
            <SELECT size="15"  multiple="multiple" style="width:100%;">
                <OPTION  value="Opening">Opening</OPTION>
                <OPTION  value="Work Time">Work Time</OPTION>
                <OPTION  value="Ways of Thinking">Ways of Thinking</OPTION>
                <OPTION  value="Summary of the Mathematics ">Summary of the Mathematics </OPTION>
                <OPTION  value="Reflection (including Wonderings)">Reflection (including Wonderings)</OPTION>
                <OPTION  value="Exercises">Exercises</OPTION>
                <OPTION  value="Critique">Critique</OPTION>
                <OPTION  value="Putting Mathematics to Work">Putting Mathematics to Work</OPTION>
                <OPTION  value="Guided Math Groups">Guided Math Groups</OPTION>
                <OPTION  value="Conferences">Conferences</OPTION>
                <OPTION  value="Quizzes and Unit Examinations">Quizzes and Unit Examinations</OPTION>
                <OPTION  value="Projects">Projects</OPTION>
            </SELECT>
        </div>
        <div class="span1">
            <input type="button" value="&gt;" class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" value="&lt;" class="btn" style="width:100%;">
        </div>
        <div class="span3">
            <SELECT size="15"  multiple="multiple" style="width:100%;">
            </SELECT>
        </div>
        <div class="span2">
            <input type="button" value="Move Up"  class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" value="Move Down"  class="btn" style="width:100%;">
        </div>
    </section>
    <section class="row-fluid">
    		<!-- Hide and show this div when routines are being removed from a lesson -->
            <div class="span7 offset1 alert alert-block alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Alert!</h4>
            Removing a routine from your lesson will result in the associated content being appended to the preceeding routine.
            </div>
    </section>
    <section class="row-fluid">
    	<a href="CCSoC_EditTasksSteps.php" class="span3 offset5 btn btn-primary">Save Routines</a>
    </section>
    <section class="row-fluid">
        <hr class="span10 offset1" />
    </section>
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>