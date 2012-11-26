<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define CCSoC Tasks</title>
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
        <h3 class="span11 offset1">Define Tasks: &lt;Lesson Name&gt; - &lt;Grade&gt; <a class="btn btn-small" href="#"><i class="icon-edit"></i> Edit</a></h3>
    </section>
	<div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
  	<section class="row-fluid">
    	<div class="span5 offset1">
            <table class="table table-striped table-hover" style="font-size:12px;">
            <caption>1. Select a routine below to create a task.</caption>
              <thead>
                <tr bgcolor="#CCCCCC">
                  <th>Lesson Structure</th>
                  <th width="120"><a class="btn btn-small" href="#"><i class="icon-edit"></i> Edit Routines</a></th>
                </tr>
              </thead>
              <tbody>
                <tr class="">
                  <td>Opening (1)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="">
                  <td>&nbsp;1. <a href="">Introduction</a> (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Step</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Work Time (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Ways of Thinking (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Summary of the Mathematics (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Reflection (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Exercises (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Projects (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="span5">
            <table class="table table-condensed unborderedTable" style="font-size:12px;">
            <caption>2. Select the template for this step.</caption>
              <tbody>
                <tr>
                  <td width="120">Template name</td>
                  <td>
                  <select size="1">
                    <option value="Intro" selected="SELECTED">Intro</option>
                    <option value="Splash">Splash</option>
                    <option value="Text only">Text only</option>
                    <option value="Media left">Media left</option>
                    <option value="Media right">Media right</option>
                    <option value="Icon left">Icon left</option>
                    <option value="Plan">Plan</option>
                    <option value="Research">Research</option>
                    <option value="Create">Create</option>
                    <option value="Revise">Revise</option>
                    <option value="Present">Present</option>
                  </select></td>
                </tr>
                <tr>
                  <td width="120">Preview</td>
                  <td><img src="img/placeholder.png" /></td>
                </tr>
                <tr>
                  <td width="120"></td>
                  <td>
                  <input name="Select" type="button" class="btn btn-primary" style="width:100%; margin-top:10px;" id="Select" title="Select" value="Select">
                  </td>
                </tr>
              </tbody>
            </table>
    	</div>
    </section>
    <section class="row-fluid">
    	<hr class="span10 offset1"/>
    </section>
    <section class="row-fluid">
    	<h4 class="span11 offset1">Publishing</h4>
    </section>
    <section class="row-fluid">
    	<input name="Preview" type="button" class="span2 offset1 btn" id="Preview" title="Preview" value="Preview" style="margin-bottom:10px;">
    </section>
    <section class="row-fluid">	
        <input name="Publish" type="button" class="span2 offset1 btn" id="Publish" title="Publish" value="Publish">
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>