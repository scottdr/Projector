	<?php require("../Globals.php") ?>
  <!--<nav class="navbar" style="border:0; margin:0;">
    	<div class="navbar-inner">
            <ul class="nav">
                <li><a href="Login.php">Login</a></li>
                <li><a href="Home.php">Home</a></li>
                <li><a href="CCSoC_EditLesson.php">CCoC Edit Lesson</a></li>
                <li><a href="CCSoC_EditRoutines.php">CCSoC Routines - Start</a></li>
                <li><a href="CCSoC_DefineTask.php">CCSoC Add / Edit Task</a></li>
                <li><a href="CCSoC_EditSteps.php">CCSoC Task - Add / Edit Steps</a></li>
                <li><a href="Projector_EditChallenge.php">Projector Edit Challenge</a></li>
                <li><a href="Projector_EditSteps.php">Projector Steps - Add / Edit Step </a></li>
                <li><a href="PreviewContent.php">Preview Content</a></li>
            </ul>
        </div>
    </nav>-->
    
	<div id="header" class="row-fluid">
    <h1 class="span6">
        <a href="/Gallery.php" style="font-size:22px; text-decoration:none;">
            <img src="img/headerlogo.png" style="padding-bottom:6px;" />
            Project Mermaid Editor
        </a>
    </h1>
    <p class="span6">
      <a class="btn btn-small btn-inverse" style="height:20px; padding:5px; line-height:20px;" href="<?php if ($PROJECTOR['cc']) echo "CCSoC_EditLesson.php"; else echo "Projector_EditChallenge.php"; echo "?action=Add"; ?> ">
          <i class="icon-plus icon-white"></i> 
          Add project
      </a>
      <a class="btn btn-small btn-inverse" style="height:20px; padding:5px; line-height:20px;" href="ViewAll.php">
          <i class="icon-eye-open icon-white"></i> 
          View projects
      </a>
      <?php if ($PROJECTOR['cc']) : ?>
       <a class="btn btn-small btn-inverse" style="height:20px; padding:5px; line-height:20px;" href="CCSoC_ViewRoutines.php">
          <i class="icon-edit icon-white"></i> 
          Routines
      </a>
      <?php endif; ?>
    </p>
</div>