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
        <h3 class="span11 offset1">Define Challenge Steps: &lt;Challenge Name&gt; <a class="btn btn-small" href="#"><i class="icon-edit"></i> Edit</a></h3>
    </section>
    <div class="row-fluid">
		<hr class="span10 offset1" />
    </div>
  	<section class="row-fluid">
  		
    	<div class="span5 offset1">
            <table class="table table-striped table-hover" style="font-size:12px;">
            <caption>1. Select a routine below to create a step.</caption>
              <thead>
                <tr bgcolor="#CCCCCC">
                  <th>Project Structure</th>
                  <th width="120"><a class="btn btn-small" href="#"><i class="icon-edit"></i> Edit Routines</a></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Your Challenge (1)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
                <tr class="">
                  <td>&nbsp;1. <a href="">In Detail</a></td>
                  <td><a class="btn btn-small" href="#"><i class="icon-pencil"></i> Edit</a></td>
                </tr>
                <tr class="">
                  <td>&nbsp;2. <a href="">Driving Questions</a></td>
                  <td><a class="btn btn-small" href="#"><i class="icon-pencil"></i> Edit</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Start (0)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Plan (0)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Create (0)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Revise (0)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
                <tr class="noFocus">
                  <td>Present (0)</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-edit"></i> Add Step</a></td>
                </tr>
              </tbody>
            </table>
		</div>
        <div class="span5">
            <table class="table table-condensed unborderedTable" style="font-size:12px;">
            <caption>2. Add a step to this project.</caption>
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
                  <td>Content title</td>
                  <td><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td>Order <span class="muted">(step number)</span></td>
                  <td><input name="textfield" type="text" id="textfield" size="3"></td>
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