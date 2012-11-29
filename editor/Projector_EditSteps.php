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
    
	<!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand">&lt;Challenge name&gt;</h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php"><i class="icon-edit"></i> Challenge details</a></li>
          <li class="active"><a href="Projector_EditSteps.php"><i class="icon-edit"></i> Steps</a></li>
          <li><a href="Projector_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="Projector_PreviewProjector_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define challenge steps:
        </h3>
    </section>
  	<section class="row-fluid">
      <div class="span4 offset1">
        	<p><strong>Select a routine from the Challenge to modify steps.</strong></p>
            
            <div class="accordion" id="acc_routines">
              <div class="accordion-group">
              
                <div class="accordion-heading">
                  <a class="accordion-toggle " data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine1_inner">
                    Routine one - Your challenge (2) 
                  </a>
                </div>
                <div id="acc_routine1_inner" class="accordion-body collapse">
                  <div class="accordion-inner accordion-step">
                    1. Step one <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    2. Step two <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                </div>
              </div>
              
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine2_inner">
                    Routine two - Start (1)
                  </a>
                </div>
                <div id="acc_routine2_inner" class="accordion-body collapse">
                  <div class="accordion-inner accordion-step">
                    1. Step one <a class="btn btn-small btn-right btn-primary step" href="#"><i class="icon-pencil icon-white"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                </div>
              </div>
              
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#acc_routines" href="#acc_routine3_inner">
                    Routine three - Plan (0)
                  </a>
                </div>
                <div id="acc_routine3_inner" class="accordion-body collapse">
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                </div>
              </div>
              
            </div>
       
      	</div>
        <div id="editStep" class="span6">
            <table class="table table-condensed unborderedTable">
            <caption>
            Edit a step for this project.
            </caption>
              <tbody>
                <tr>
                  <td colspan="2">Each step defined will appear as a separate step within the project ribbon.</td>
                </tr>
                <tr>
                  <td width="140">Routine</td>
                  <td>
                      <select size="1">
                        <option value="Your Challenge" selected="SELECTED">Your Challenge</option>
                        <option value="Start">Start</option>
                        <option value="Plan">Plan</option>
                        <option value="Create">Create</option>
                        <option value="Revise">Revise</option>
                        <option value="Present">Present</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td width="140">Step name</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td width="140">Title</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td width="140">Order <span class="muted">(step number)</span></td>
                  <td><select name="select" size="1">
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
                  <td width="140">Type</td>
                  <td>
                  	  <select size="1">
                        <option value="Generic" selected="SELECTED">Generic</option>
                        <option value="Individual">Individual</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td width="140">Template</td>
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
                      </select>
                  </td>
                </tr>
                <tr>
                  <td width="140">Content</td>
                  <td>
                      <textarea name="textarea" placeholder="Enter content ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>
                <tr>
                  <td width="140">Template media</td>
                  <td>
                  	<a class="btn btn-small" href="#"><i class="icon-folder-open"></i> Select media from library</a>
                    &nbsp;
                    <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add new media</a>
                  </td>
                </tr>
                <!-- Teacher notes in the Projector exist at the project details level
                <tr>
                  <td>Teacher notes</td>
                  <td>
                      <textarea name="textarea" placeholder="Enter teacher notes ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>-->
                <tr>
                  <td width="140"></td>
                  <td>
                  <input name="Save step" type="button" class="btn btn-primary" id="Save step" title="Save step" value="Save step">
                  </td>
                </tr>
              </tbody>
          </table>
      </div>
    </section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

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
		$("#editStep").hide();
		$( ".accordion" ).accordion({ collapsible: true });
		
	});
	
	$(".step").click(function () {
		$("#editStep").show("slow");
    });
	
	$(".closeStep").click(function () {
		$("#editStep").hide("slow");
    });
</script>
</body>
</html>