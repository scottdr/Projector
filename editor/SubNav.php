<?php require("../Globals.php"); ?>
<?php 
if ($PROJECTOR['cc']) {
 	if (isset($GLOBALS['instance']) && $GLOBALS['instance'] == "ccsoc") {
		$ChallengeURL = "/CC_LessonBrowserLive.php";
		$EditStepsURL = "CC_EditSteps.php";
	} else { 
		$ChallengeURL = "/ChallengeTemplate_CCSoC.php";
		$EditStepsURL = "Projector_EditSteps.php";
	}
} else {
 	$ChallengeURL = "/ChallengeTemplate.php";
	$EditStepsURL = "Projector_EditSteps.php";
}
 if ($PROJECTOR['cc'])
 	$EditURL = "CCSoC_EditLesson.php";
 else
 	$EditURL = "Projector_EditChallenge.php";	
?>
 <ul class="nav">
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'details') echo 'class="active" '; ?>>
          	<a href="<?php echo $EditURL; if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Details</a>
          </li>
          <?php if ($PROJECTOR['cc']) : ?>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'routines') echo 'class="active" '; ?>>
          	<a href="CCSoC_EditRoutines.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Routines</a>
          </li>
          <?php endif; ?>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'images') echo 'class="active" '; ?>>
         	 <a href="Projector_EditImages.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Images</a>
          </li>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'steps') echo 'class="active" '; ?>>
          	<a href="<?php echo $EditStepsURL; if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Steps</a>
          </li>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'media') echo 'class="active" '; ?>>
          	<a href="Projector_ViewMedia.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-eye-open"></i> Media</a>
           </li>
          <li>
          	<a href="<?php echo $ChallengeURL; if (isset($GLOBALS['instance']) && $GLOBALS['instance'] == "ccsoc") echo "?Id="; else echo "?ProjectId="; if (isset($projectId)) echo $projectId;  if (isset($unitId)) echo "&UnitId=" . $unitId; ?>"><i class="icon-eye-open"></i> Preview</a>
          </li>
</ul>