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
                <tr>
                  <td>Opening (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Work Time (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Ways of Thinking (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Summary of the Mathematics (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Reflection (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Exercises (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
                <tr>
                  <td>Projects (0)</td>
                  <td width="120"><a class="btn btn-small" href="#"><i class="icon-plus"></i> Add Task</a></td>
                </tr>
              </tbody>
            </table>
   	  </div>
    </section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
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