<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Content</title>
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
          <li class="active"><a href="CCSoC_EditLesson.php"><i class="icon-edit"></i> Lesson details</a></li>
          <li><a href="CCSoC_EditRoutines.php"><i class="icon-edit"></i> Routines</a></li>
          <li><a href="CCSoC_EditTasksSteps.php"><i class="icon-edit"></i> Tasks  &amp; steps</a></li>
          <li><a href="CCSoC_ViewMedia.php"><i class="icon-eye-open"></i> Media</a></li>
          <li><a href="CCSoC_Preview.php"><i class="icon-eye-open"></i> Preview</a></li>
        </ul>
      </div>
    </div>
    <!-- CCSoC CONTEXT SENSITIVE NAV BUTTONS END -->
    
    <!-- CONTENT STARTS -->
    
	<section class="row-fluid">
        <h3 class="span11 offset1">Lesson details:</h3>
	</section>
    <section class="row-fluid">
        <table class="table table-condensed unborderedTable span10 offset1">
              <tbody>
              	<tr>
                  <td class="width-narrow">Unit</td>
                  <td>
                  <select name="select2">
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
				</select></td>
                </tr>
                <tr>
                  <td>Lesson number</td>
                  <td>
                  <select name="select2">
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
				</select></td>
                </tr>
                <tr>
                  <td>Grade level</td>
                  <td>Min.
                    <select name="select3">
                      <option value="K">Kindergarten</option>
                      <option value="1">Grade 1</option>
                      <option value="2">Grade 2</option>
                      <option value="3">Grade 3</option>
                      <option value="4">Grade 4</option>
                      <option value="5">Grade 5</option>
                      <option value="6">Grade 6</option>
                      <option value="7">Grade 7</option>
                      <option value="8">Grade 8</option>
                      <option value="9">Grade 9</option>
                      <option value="10">Grade 10</option>
                      <option value="11">Grade 11</option>
                      <option value="12">Grade 12</option>
                    </select>
					
                   &nbsp;&nbsp;&nbsp;Max.
                   <select name="select4">
                     <option value="K">Kindergarten</option>
                      <option value="1">Grade 1</option>
                      <option value="2">Grade 2</option>
                      <option value="3">Grade 3</option>
                      <option value="4">Grade 4</option>
                      <option value="5">Grade 5</option>
                      <option value="6">Grade 6</option>
                      <option value="7">Grade 7</option>
                      <option value="8">Grade 8</option>
                      <option value="9">Grade 9</option>
                      <option value="10">Grade 10</option>
                      <option value="11">Grade 11</option>
                      <option value="12">Grade 12</option>
                  </select></td>
                </tr>
                <tr>
                  <td>Lesson name</td>
                  <td><input type="text" name="textfield2" id="textfield2" class="width-auto"></td>
                </tr>
                <tr>
                  <td>Author</td>
                  <td><input type="text" name="textfield" id="textfield" class="width-auto"></td>
                </tr>
                <tr>
                  <td>Subject</td>
                  <td><select name="select6">
                    <option value="Math">Math</option>
                    <option value="ELA">English Language Arts</option>
                  </select></td>
                </tr>
                
                
                <tr>
                  <td>Duration<span class="muted"> (days)</span></td>
                  <td>
                  <select name="select5">
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
                  </select></td>
                </tr>
                <tr>
                  <td>Lesson type</td>
                  <td>
                  <select name="select7">
                    <option value="Exploratory lesson">Exploratory lesson</option>
                    <option value="Concept development lesson">Concept development lesson</option>
                    <option value="Formative assessment lesson">Formative assessment lesson</option>
                    <option value="Gallery lesson">Gallery lesson</option>
                    <option value="Unit test and review lesson">Unit test and review lesson</option>
                  </select></td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>
                  <textarea name="textarea" placeholder="Enter description ..." rows="10" id="textarea" class="wysiwyg-editor width-auto"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>
                  <select name="select">
                    <option value="Edit">Edit</option>
                    <option value="Review">Review</option>
                    <option value="Pilot">Pilot</option>
                    <option value="Publish">Publish</option>
                  </select></td>
                </tr>
                <tr>
                  <td>Small image</td>
                  <td>
                 <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add image</a>
                 <br/><br/>
                 <img src="img/placeholder-square.jpg" class="img-polaroid" width="100">
                 </td>
                </tr>
                <tr>
                  <td>Medium image</td>
                  <td>
                  <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add image</a>
                 <br/><br/>
                 <img src="img/placeholder-square.jpg" class="img-polaroid" width="150">
                  </td>
                </tr>
                <tr>
                  <td>Large image</td>
                  <td>
                  <a class="btn btn-small" href="#"><i class="icon-arrow-up"></i> Add image</a>
                 <br/><br/>
                 <img src="img/placeholder-square.jpg" class="img-polaroid" width="200">
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><hr /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                  <a href="CCSoC_EditRoutines.php" class="btn btn-primary">Save</a>
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