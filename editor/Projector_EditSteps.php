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
    
	<!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS START -->
    <div class="navbar">
      <div class="navbar-inner">
      <h2 class="brand" style="padding-top:0px;padding-bottom:0px;">&lt;Challenge name&gt;</h2>
        <ul class="nav">
          <li><a href="Projector_EditChallenge.php"><i class="icon-edit"></i> Challenge details</a></li>
          <li class="active"><a href="Projector_EditSteps.php"><i class="icon-edit"></i> Edit steps</a></li>
          <li><a href="#"><i class="icon-eye-open"></i> View media</a></li>
          <li><a href="PreviewContent.php"><i class="icon-eye-open"></i> Preview lesson</a></li>
        </ul>
      </div>
    </div>
    <!-- PROJECTOR CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Define challenge steps:
        </h3>
    </section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
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
                <div id="acc_routine1_inner" class="accordion-body collapse in">
                  <div class="accordion-inner accordion-step">
                    1. Step one <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    2. Step two <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
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
                    1. Step one <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    2. Step two <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
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
                  1. Step one <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    2. Step two <a class="btn btn-small btn-right" href="#"><i class="icon-pencil"></i> Edit step</a></div>
                  <div class="accordion-inner accordion-step">
                    <a class="btn btn-small" href="#"><i class="icon-plus"></i> Add step</a>
                  </div>
                </div>
              </div>
              
            </div>
       
      	</div>
        <div class="span5">
            <table class="table table-condensed unborderedTable" style="font-size:12px;">
            <caption>
            Add a step to this project.
            </caption>
              <tbody>
                <tr>
                  <td colspan="2">Each step defined will appear as a separate step within the project ribbon.</td>
                </tr>
                <tr>
                  <td>Routine</td>
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
                  <td>Step name</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td>Page title</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td>Order <span class="muted">(step number)</span></td>
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
                  <td>Type</td>
                  <td>
                  	  <select size="1">
                        <option value="Generic" selected="SELECTED">Generic</option>
                        <option value="Individual">Individual</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>Template</td>
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
                  <td>Content</td>
                  <td>
                  	<textarea style="width:90%;" rows="10"></textarea>
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
                  <td>Teacher notes</td>
                  <td>
                  	<textarea style="width:90%;" rows="10"></textarea>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                  <input name="Add Step" type="button" class="btn btn-primary" style="width:100%; margin-top:10px;" id="AddStep" title="Add Step" value="Add Step">
                  </td>
                </tr>
              </tbody>
          </table>
          
          <table class="table table-condensed unborderedTable" style="font-size:12px;">
            <caption>
            Add a step to this project.
            </caption>
              <tbody>
                <tr>
                  <td colspan="2">Each step defined will appear as a separate step within the project ribbon.</td>
                </tr>
                <tr>
                  <td>Routine</td>
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
                  <td>Step name</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td>Page title</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td>Order <span class="muted">(step number)</span></td>
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
                  <td>Type</td>
                  <td>
                  	  <select size="1">
                        <option value="Generic" selected="SELECTED">Generic</option>
                        <option value="Individual">Individual</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>Template</td>
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
                  <td>Content</td>
                  <td>
                  	<textarea style="width:90%;" rows="10"></textarea>
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
                  <td>Teacher notes</td>
                  <td>
                  	<textarea style="width:90%;" rows="10"></textarea>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                  <input name="Add Step" type="button" class="btn btn-primary" style="width:100%; margin-top:10px;" id="AddStep" title="Add Step" value="Add Step">
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
</body>
</html>