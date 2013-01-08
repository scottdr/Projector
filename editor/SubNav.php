<?php require("../Globals.php"); ?>
<?php 
 if ($PROJECTOR['cc'])
 	$ChallengeURL = "/ChallengeTemplate_CCSoC.php";
 else
 	$ChallengeURL = "/ChallengeTemplate.php";
?>
 <ul class="nav">
 					<li><?php echo $_SESSION['ActiveNav']; ?></li>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'details') echo 'class="active" '; ?>><a href="Projector_EditChallenge.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i>Details</a></li>
          <?php if ($PROJECTOR['cc']) : ?>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'routines') echo 'class="active" '; ?>><a href="CCSoC_EditRoutines.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Routines</a></li>
          <?php endif; ?>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'images') echo 'class="active" '; ?>><a href="Projector_EditImages.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i>Images</a></li>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'steps') echo 'class="active" '; ?>><a href="Projector_EditSteps.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-edit"></i> Steps</a></li>
          <li <?php if (isset($_SESSION['ActiveNav']) && $_SESSION['ActiveNav'] == 'media') echo 'class="active" '; ?>><a href="Projector_ViewMedia.php<?php if (isset($projectId)) echo "?Id=" . $projectId; ?>"><i class="icon-eye-open"></i> Media</a></li>
          
          <li><a href="<?php echo $ChallengeURL; ?>?ProjectId=<?php if (isset($projectId)) echo $projectId; ?>"><i class="icon-eye-open"></i> Preview</a></li>
</ul>