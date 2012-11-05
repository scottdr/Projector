<?php
$PROJECTOR['editMode'] = false;
$PROJECTOR['disableSlideShow'] = true;
?>
<?php if ($PROJECTOR['disableSlideShow']) : ?>
<script type="text/javascript">
	var disableSlideShow = true;	// disable the slide show until we polish it
</script>
<?php else: ?>
<script type="text/javascript">
	var disableSlideShow = false;	// enable the slide show
</script>
<?php endif; ?>