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
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define routines: &lt;lesson name&gt; - &lt;grade&gt; 
        	<a class="btn btn-small" href="CCSoC_EditLesson.php"><i class="icon-edit"></i> Edit lesson details</a>
            <a class="btn btn-small" href="CCSoC_DefineTask.php"><i class="icon-edit"></i> Edit lesson tasks</a>
            <a class="btn btn-small" href="CCSoC_EditSteps.php"><i class="icon-edit"></i> Edit lesson steps</a>
            <a class="btn btn-small" href="#"><i class="icon-eye-open"></i> View media library</a>
            <a class="btn btn-small" href="PreviewContent.php"><i class="icon-eye-open"></i> Preview lesson</a>
            <a class="btn btn-small" href="#"><i class="icon-ok"></i> Publish lesson</a>
        </h3>
        <ul class="span11 offset1">
          <li>Select the lesson routines from the left panel and add them. Press the control key to select multiple items.</li>
          <li>You can add multiple copies of the same routine by repeating the process.</li>
        </ul>
	</section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
    <section class="row-fluid">
        <p class="span1 offset1">Select</p>
        <div class="span3">
            <SELECT size="12" multiple="MULTIPLE" style="width:100%;">
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
            <SELECT size="12" multiple="MULTIPLE" style="width:100%;">
                <OPTION  value="Opening">Opening</OPTION>
            </SELECT>
        </div>
        <div class="span2">
            <input type="button" value="Move Up"  class="btn" style="width:100%; margin-bottom:10px; margin-top:60px;">
            <input type="button" value="Move Down"  class="btn" style="width:100%;">
        </div>
    </section>
    <section class="row-fluid">
        <hr class="span10 offset1" />
    </section>
    <section class="row-fluid">
        <input type="button" value="Save Routines"  class="span3 offset2 btn btn-large btn-primary">
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>