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
    
	<section class="row-fluid" style="margin-top: 44px;">
        <h3 class="span11 offset1">Media:</h3>
    </section>
    <section class="row-fluid">
    	<div class="span10 offset1">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                        <th width="5%">ID</th>
                        <th width="25%">Thumbnail</th>
                        <th width="30%">Caption</th>
                        <th width="10%">Project ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a class="btn btn-mini btn-primary" href="#"><i class="icon-edit icon-white"></i> Edit</a></td>
                        <td>21</td>
                        <td><img src="img/placeholder-square.jpg" class="img-polaroid" width="100"></td>
                        <td>Title</td>
                        <td>6</td>
                    </tr>
                    <tr>
                      <td><a class="btn btn-mini btn-primary" href="#"><i class="icon-edit icon-white"></i> Edit</a></td>
                      <td>22</td>
                      <td><img src="img/placeholder-square.jpg" class="img-polaroid" width="100"></td>
                      <td>Title</td>
                      <td>6</td>
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