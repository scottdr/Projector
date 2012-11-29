<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Define CCSoC Tasks</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/editor-customization.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="css/prettify.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-wysihtml5.css"/>

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
          <li><a href="CCSoC_EditRoutines.php"><i class="icon-edit"></i> Routines</a></li>
          <li class="active"><a href="CCSoC_EditTasksSteps.php"><i class="icon-edit"></i> Tasks  &amp; steps</a></li>
          <li><a href="CCSoC_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="CCSoC_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
	<section class="row-fluid">
    	<h3 class="span11 offset1">Edit tasks and steps:</h3>
	</section>
  	<section class="row-fluid">
    	<div class="span4 offset1">
        	<p><strong>Select a routine from the Lesson to modify tasks and steps.</strong></p>
            
            <div class="accordion" id="acc_routines">
              <div class="accordion-group">
              
                <div class="accordion-heading">
                  <a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine1_inner">
                    Routine one (2) 
                  </a>
                  <!--<a class="btn btn-small" href="#"><i class="icon-edit"></i> Define Routines</a>-->
                </div>
                <div id="acc_routine1_inner" class="accordion-body collapse">
                  <div class="accordion-inner accordion-task">
                    1. Task one (4)<a class="btn btn-small btn-right task btn-primary" href="#"><i class="icon-pencil icon-white"></i> Edit task</a>
                  </div>
                  <div class="accordion-inner accordion-step">
                    Steps:
                      <a class="step" href="#"><img src="img/square_up.png"></a>
                      <a class="step" href="#"><img src="img/square_up.png"></a>
                      <a class="step" href="#"><img src="img/square_down.png"></a>
                      <a class="step" href="#"><img src="img/square_up.png"></a>
                  </div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small step" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                  <div class="accordion-inner accordion-task">
                    2. Task two (0)<a class="btn btn-small btn-right task btn-primary" href="#"><i class="icon-pencil icon-white"></i> Edit task</a>
                  </div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small step" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                  <div class="accordion-inner accordion-task">
                    <a class="btn btn-small task" href="#"><i class="icon-plus"></i> Add task</a>
                  </div>
                </div>
              </div>
              
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine2_inner">
                    Routine two (1)
                  </a>
                </div>
                <div id="acc_routine2_inner" class="accordion-body collapse">
				<div class="accordion-inner accordion-task">
                    1. Task one (0)<a class="btn btn-small btn-right task btn-primary" href="#"><i class="icon-pencil icon-white"></i> Edit task</a>
                  </div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small step" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                  <div class="accordion-inner accordion-task">
                    <a class="btn btn-small  task" href="#"><i class="icon-plus"></i> Add task</a>
                  </div>
                </div>
              </div>
              
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine3_inner">
                    Routine three (0)
                  </a>
                </div>
                <div id="acc_routine3_inner" class="accordion-body collapse">
                  <div class="accordion-inner accordion-task">
                    <a class="btn btn-small task" href="#"><i class="icon-plus"></i> Add task</a>
                  </div>
                </div>
              </div>
              
            </div>
       
      </div>
        
        <div class="span6">
        <div id="editTask">
            <table class="table table-condensed unborderedTable">
                <caption>Edit the task name and order.</caption>
                  <tbody>
                    <tr>
                      <td width="140">Task order</td>
                      <td>
                      <select size="1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="140">Task name</td>
                      <td><input type="text" name="textfield" id="textfield"></td>
                    </tr>
                    <tr>
                      <td width="140"></td>
                      <td>
                      <input name="Update task" type="button" class="btn btn-primary" id="Update task" title="Update task" value="Update task">
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            
            <div id="editStep">
                <table class="table table-condensed unborderedTable">
                <caption>
                Select the template for this step.
                </caption>
                  <tbody>
                    <tr>
                      <td width="140">Template name</td>
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
                      <td width="140">Preview</td>
                      <td><img src="img/placeholder-square.jpg" class="img-polaroid" width="153" height="114" /></td>
                    </tr>
                    <tr>
                      <td width="140"></td>
                      <td>
                      <input name="Select template" type="button" class="btn btn-primary" margin-top:10px;" id="Select template" title="Select template" value="Select template">
                      </td>
                    </tr>
                  </tbody>
                </table>
            
            
                <table class="table table-condensed unborderedTable">
                <caption>
                Complete the details in the form below to save the content for this step.
                </caption>
                  <tbody>
                    <tr>
                      <td width="140">Step title</td>
                      <td><input type="text" name="textfield2" id="textfield2"></td>
                    </tr>
                    <tr>
                      <td>Step description</td>
                      <td>
                      <textarea name="textarea" placeholder="Enter description ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>Template media</td>
                      <td>
                      <a class="btn btn-small" href="#"><i class="icon-folder-open"></i> Select media from library</a>
                        &nbsp;
                        <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add new media</a>
                        </td>
                    </tr>
                    <tr>
                      <td>Teacher tips</td>
                      <td>
                      <textarea name="textarea2" placeholder="Enter teacher hints ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>Student tips</td>
                      <td>
                      <textarea name="textarea2" placeholder="Enter teacher hints ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                      </td>
                    </tr>                    <tr>
                      <td width="140"></td>
                      <td>
                      <input name="Update step" type="button" class="btn btn-primary" id="Update step" title="Update step" value="Update step">
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>    
    	</div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-transition.js"></script>

<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/prettify.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>

<script>
	$('.wysiwyg-editor').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#editTask").hide();
		$("#editStep").hide();
		$( ".accordion" ).accordion({ collapsible: true });
		
	});
	
	$(".task").click(function () {
    	$("#editTask").show("slow");
		$("#editStep").hide("slow");
    });
	
	$(".step").click(function () {
    	$("#editTask").hide("slow");
		$("#editStep").show("slow");
    });
	
	$(".closeStepTask").click(function () {
    	$("#editTask").hide("slow");
		$("#editStep").hide("slow");
    });
</script>

</body>
</html>