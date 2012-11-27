<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Content</title>
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
        <h3 class="span11 offset1">Lesson details: &lt;lesson name&gt;
            <a class="btn btn-small" href="CCSoC_EditRoutines.php"><i class="icon-edit"></i> Define routines</a>
            <a class="btn btn-small" href="CCSoC_DefineTask.php"><i class="icon-edit"></i> Edit lesson tasks</a>
            <a class="btn btn-small" href="CCSoC_EditSteps.php"><i class="icon-edit"></i> Edit lesson steps</a>
            <a class="btn btn-small" href="#"><i class="icon-eye-open"></i> View media library</a>
            <a class="btn btn-small" href="PreviewContent.php"><i class="icon-eye-open"></i> Preview lesson</a>
            <a class="btn btn-small" href="#"><i class="icon-ok"></i> Publish lesson</a>
        </h3>
	</section>
    <section class="row-fluid">
        <table class="table table-condensed unborderedTable span11 offset1" style="font-size:12px;">
              <tbody>
                <tr>
                  <td width="154">ID</td>
                  <td colspan="2">26</td>
                </tr>
                <tr>
                  <td width="154">Name</td>
                  <td colspan="2"><input type="text" name="textfield2" id="textfield2"></td>
                </tr>
                <tr>
                  <td width="154">Author</td>
                  <td colspan="2"><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td width="154">Subject</td>
                  <td colspan="2"><input type="text" name="textfield" id="textfield"></td>
                </tr>
                <tr>
                  <td width="154">Grade<span class="muted"></span></td>
                  <td colspan="2">Min.
                    <input name="textfield6" type="text" id="textfield6" style="width:50px;">
&nbsp;&nbsp;&nbsp;
                   Max.
                  <input name="textfield6" type="text" id="textfield7" style="width:50px;"></td>
                </tr>
                <tr>
                  <td width="154">Duration<span class="muted"> (days)</span></td>
                  <td colspan="2"><input name="textfield3" type="text" id="textfield3" style="width:50px;"></td>
                </tr>
                <tr>
                  <td width="154">Description</td>
                  <td colspan="2"><textarea name="textarea" rows="10" id="textarea"></textarea></td>
                </tr>
                <tr>
                  <td width="154">Status</td>
                  <td colspan="2"><select name="select" id="select">
                    <option value="Edit">Edit</option>
                    <option value="Review">Review</option>
                    <option value="Pilot">Pilot</option>
                    <option value="Publish">Publish</option>
                  </select></td>
                </tr>
                <tr>
                  <td width="154">Topic</td>
                  <td colspan="2"><input type="text" name="textfield4" id="textfield4"></td>
                </tr>
                <tr>
                  <td width="154">Small image</td>
                  <td colspan="2"><input type="text" name="textfield5" id="textfield5"></td>
                </tr>
                <tr>
                  <td width="154">Medium image</td>
                  <td colspan="2"><input type="text" name="textfield7" id="textfield8"></td>
                </tr>
                <tr>
                  <td width="154">Large image</td>
                  <td colspan="2"><input type="text" name="textfield8" id="textfield9"></td>
                </tr>
                <tr>
                  <td width="154"></td>
                  <td width="390">
                  <input name="Save" type="button" class="btn btn-primary" id="Save" title="Save" value="Save" style="width:40%;">
                  <input name="Delete" type="button" class="btn btn-primary btn-danger" id="Delete" title="Delete" value="Delete" style="width:40%;">
                  </td>
                  <td width="350">&nbsp;</td>
                </tr>
              </tbody>
            </table>
	</section>
    
    <!-- CONTENT ENDS -->
    
    <?php include("EditorFooter.php"); ?>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>