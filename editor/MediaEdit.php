<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Lesson media</title>
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
          <li><a href="CCSoC_EditTasksSteps.php"><i class="icon-edit"></i> Tasks  &amp; steps</a></li>
          <li class="active"><a href="CCSoC_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="CCSoC_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Edit Lesson media:</h3>
	</section>
    <section class="row-fluid">
        <table class="table table-condensed unborderedTable span10 offset1">
              <tbody>
              	<tr>
                  <td class="width-narrow">Media</td>
                  <td><a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add image</a> <br/>
                    <br/>
                    <img src="img/placeholder-square.jpg" alt="" width="100" class="img-polaroid"></td>
                </tr>
                <tr>
                  <td>URL</td>
                  <td><input type="text" name="textfieldURL" id="textfieldURL" class="width-auto"></td>
                </tr>
                <tr>
                  <td>Caption</td>
                  <td><textarea name="textareaCaption" placeholder="Enter caption ..." rows="10" id="textareaCaption" class="wysiwyg-editor width-auto"></textarea></td>
                </tr>
                <tr>
                  <td>ALT text</td>
                  <td><input type="text" name="textfieldAlttext" id="textfieldAlttext" class="width-auto"></td>
                </tr>
                <tr>
                  <td>Credits</td>
                  <td><textarea name="textareaCredits" placeholder="Enter credits ..." rows="10" id="textareaCredits" class="wysiwyg-editor width-auto"></textarea></td>
                </tr>
                <tr>
                  <td>Width<span class="muted"> (pixels)</span></td>
                  <td><input type="text" name="textfieldWidth" id="textfieldWidth"></td>
                </tr>
                
                
                <tr>
                  <td>Height<span class="muted"> (pixels)</span></td>
                  <td><input type="text" name="textfieldHeight" id="textfieldHeight"></td>
                </tr>
                <tr>
                  <td colspan="2"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                  <a href="#" class="btn btn-primary">Save</a>
                  <a href="#" class="btn btn-primary btn-danger">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
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

</body>
</html>