<?php require_once('../Connections/projector.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$action = "Edit";
$actionTitle = "Edit";
if (isset($_GET["Action"])) {
	$action = $_GET["Action"];
	$actionTitle = $_GET["Action"];
}

//echo "POST ACTION = " . $_POST["MM_action"];


if (isset($_POST["MM_action"])) {
	if ($_POST["MM_action"] == "Add") {
  	$sqlCommand = sprintf("INSERT INTO CF_Resources (Id, Name, AboutDetail, InLanguage, MediaType, InteractivityType, LearningResourceType, URL, Author, Publisher, AgeStart, AgeEnd, EndUserRole, ImageThumbnail, Unit, Collection, EducationalUse) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Id'], "int"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Language'], "text"),
                       GetSQLValueString($_POST['MediaType'], "text"),
                       GetSQLValueString($_POST['InteractivityType'], "text"),
                       GetSQLValueString($_POST['ResourceType'], "text"),
                       GetSQLValueString($_POST['ResourceURL'], "text"),
                       GetSQLValueString($_POST['Author'], "text"),
                       GetSQLValueString($_POST['Publisher'], "text"),
                       GetSQLValueString($_POST['AgeMin'], "int"),
                       GetSQLValueString($_POST['AgeMax'], "int"),
											 GetSQLValueString($_POST['Audience'], "text"),
											 GetSQLValueString($_POST['Unit'], "int"),
											 GetSQLValueString($_POST['Collection'], "text"),
											 GetSQLValueString($_POST['Use'], "text"),
											 GetSQLValueString($_POST['ThumbNail'], "text"));
	} else if ($_POST["MM_action"] == "Edit") {
		$sqlCommand = sprintf("UPDATE CF_Resources Set Id=%s, Name=%s, AboutDetail=%s, InLanguage=%s, MediaType=%s, InteractivityType=%s, LearningResourceType=%s, URL=%s, Author=%s, Publisher=%s, AgeStart=%s, AgeEnd=%s, EndUserRole=%s, ImageThumbnail=%s, ImageLarge=%s, Unit=%s, Collection=%s, EducationalUse=%s WHERE Id=%s",
                       GetSQLValueString($_POST['Id'], "int"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Language'], "text"),
                       GetSQLValueString($_POST['MediaType'], "text"),
                       GetSQLValueString($_POST['InteractivityType'], "text"),
                       GetSQLValueString($_POST['ResourceType'], "text"),
                       GetSQLValueString($_POST['ResourceURL'], "text"),
                       GetSQLValueString($_POST['Author'], "text"),
                       GetSQLValueString($_POST['Publisher'], "text"),
                       GetSQLValueString($_POST['AgeMin'], "int"),
                       GetSQLValueString($_POST['AgeMax'], "int"),
											 GetSQLValueString($_POST['Audience'], "text"),
											 GetSQLValueString($_POST['ThumbNail'], "text"),
											 GetSQLValueString($_POST['DetailImage'], "text"),
											 GetSQLValueString($_POST['Unit'], "int"),
											 GetSQLValueString($_POST['Collection'], "text"),
											 GetSQLValueString($_POST['Use'], "text"),
											 GetSQLValueString($_POST['Id'], "int"));
	}

//	echo "SQL COMMAND = " . $sqlCommand;

  mysql_select_db($database_projector, $projector);
  $Result1 = mysql_query($sqlCommand, $projector) or die(mysql_error());

  $insertGoTo = "ResourcesViewAll.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Resource = "-1";
if (isset($_GET['Id'])) {
  $colname_Resource = $_GET['Id'];
}
mysql_select_db($database_projector, $projector);
$query_Resource = sprintf("SELECT * FROM CF_Resources WHERE Id = %s", GetSQLValueString($colname_Resource, "int"));
$Resource = mysql_query($query_Resource, $projector) or die(mysql_error());
$row_Resource = mysql_fetch_assoc($Resource);
$totalRows_Resource = mysql_num_rows($Resource);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $actionTitle; ?> Resource</title>
        
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-customized-web.css" rel="stylesheet" type="text/css" />
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 shim for IE backwards compatibility -->
            <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<script>
function addImage() {
		$("#myModal").modal({                    // finally, wire up the actual modal functionality and show the dialog
			"backdrop"  : "static",
			"keyboard"  : true,
			"show"      : true                     // ensure the modal is shown immediately
		});
}
</script>
    </head>
    
    <body>
    	
        
    <!-- Header Starts -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                 <a class="brand" href="ResourcesViewAll.php" style="background-color:pink">Candy Floss</a>
                
                </div>
                 <a class="btn btn-small btn-inverse" style="height:20px; padding:5px; line-height:20px; right:0; top:0; position:absolute" href="ResourcesViewAll.php">
	          <i class="icon-eye-open icon-white"></i> 
	          View
	          </a>
            </div>
        </div>
        
    	<div class="container-fluid">
            <section class="row-fluid" style="padding-top:50px;">
              <div class="span12" style="background-color: #02ACF0; height: 40px; overflow: hidden; border: 0; padding: 0; margin: 0;">
                    <a href="#" class="navItemDown">COLLECTIONS</a>
                    <a href="#" class="navItemUp">MY WEB</a>
                    <a href="#" class="navItemUp">ABOUT</a>
                </div>
            </section>  
        </div>
        
        
        <!-- Content Starts -->
       <!-- Content Starts -->
        <div class="container-fluid">
        
        	<!-- Page title -->
            <section class="row-fluid" style="padding-top:10px;padding-bottom:10px;"> 
              <div class="span12">
                <h3><?php echo $actionTitle; ?> Resource</h3>
              </div>
            </section>

            
          <section class="row-fluid" style=" background-color:#FFF;">
            	<div style="padding:10px;" class="span12">
              	<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
                	<input name="Id" type="hidden" id="Id" value="<?php echo $row_Resource['Id']; ?>">
                	<table cellpadding="5" width="100%">
                      <tr>
                        <td width="25%" align="right" valign="top"><p>Title</p></td>
                        <td width="75%" valign="top">
                        <input name="Title" type="text" class="span10" id="Title" placeholder="Enter resource title ..." value="<?php echo $row_Resource['Name']; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Description</p></td>
                        <td valign="top">
                        <textarea name="Description" class="span10" placeholder="Enter description ..." rows="10" id="Description"><?php echo $row_Resource['AboutDetail']; ?></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Resource URL</p></td>
                        <td valign="top">
                        <input name="ResourceURL" type="text" class="span10" id="ResourceURL" placeholder="http://www" value="<?php echo $row_Resource['URL']; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Small image</p></td>
                        <td valign="top">
                            <a class="btn btn-small" href="#" onClick="addImage(this)"><i class="icon-arrow-up"></i> Add image</a>
                            <input name="ThumbNail" type="text" id="ThumbNail" value="<?php echo $row_Resource['ImageThumbnail']; ?>">
                            <br/><br/>
                            <img src="<?php echo $row_Resource['ImageThumbnail']; ?>" class="img-polaroid">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Large image</p></td>
                        <td valign="top">
                            <a class="btn btn-small" href="#" onClick="addImage(this)"><i class="icon-arrow-up"></i> Add image</a>
                            <input name="DetailImage" type="text" id="DetailImage" value="<?php echo $row_Resource['ImageLarge']; ?>">
                            <br/><br/>
                            <img src="<?php echo $row_Resource['ImageLarge']; ?>" class="img-polaroid">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Date created</p></td>
                        <td valign="top">
                        	<div class="input-append date" id="dp1" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                              <input class="span2" size="16" type="text" value="12-02-2012">
                              <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Author</p></td>
                        <td valign="top"><input name="Author" type="text" class="width-auto" id="Author" placeholder="Title, First name, Last name" value="<?php echo $row_Resource['Author']; ?>"></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Publisher</p></td>
                        <td valign="top"><input name="Publisher" type="text" class="width-auto" id="Publisher" placeholder="Publisher name" value="<?php echo $row_Resource['Publisher']; ?>"></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Primary language</p></td>
                        <td valign="top">
                            <select name="Language" class="width-auto" id="Language">
                              <option selected value="En" <?php if (!(strcmp("En", $row_Resource['InLanguage']))) {echo "selected=\"selected\"";} ?>>English</option>
                              <option value="Fr" <?php if (!(strcmp("Fr", $row_Resource['InLanguage']))) {echo "selected=\"selected\"";} ?>>French</option>
                              <option value="De" <?php if (!(strcmp("De", $row_Resource['InLanguage']))) {echo "selected=\"selected\"";} ?>>German</option>
                              <option value="It" <?php if (!(strcmp("It", $row_Resource['InLanguage']))) {echo "selected=\"selected\"";} ?>>Italian</option>
                              <option value="Es" <?php if (!(strcmp("Es", $row_Resource['InLanguage']))) {echo "selected=\"selected\"";} ?>>Spanish</option>
                            </select>
					  	</td>
                     </tr>
					 <tr>
                        <td align="right" valign="top"><p>Media type</p></td>
                        <td valign="top">
                        	<select name="MediaType" class="width-auto" id="MediaType">
                          	<option value="None" <?php if (!(strcmp("None", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>None</option>
                          	<option value="Article" <?php if (!(strcmp("Article", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Article</option>
                        	  <option value="Audio" <?php if (!(strcmp("Audio", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Audio</option>
                        	  <option value="Book" <?php if (!(strcmp("Book", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Book</option>
                        	  <option value="Challenge" <?php if (!(strcmp("Challenge", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Challenge</option>
                        	  <option value="Course" <?php if (!(strcmp("Course", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Course</option>
                        	  <option value="Handout" <?php if (!(strcmp("Handout", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Handout</option>
                        	  <option value="Image" <?php if (!(strcmp("Image", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Image</option>
                        	  <option value="Interactive" <?php if (!(strcmp("Interactive", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Interactive</option>
<option value="" <?php if (!(strcmp("", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Lesson</option>
                        	  <option value="Project" <?php if (!(strcmp("Project", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Project</option>
                        	  <option value="Slide" <?php if (!(strcmp("Slide", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Slide</option>
<option value="" <?php if (!(strcmp("", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Textbook</option>
                        	  <option value="Video" <?php if (!(strcmp("Video", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Video</option>
                        	  <option value="Website" <?php if (!(strcmp("Website", $row_Resource['MediaType']))) {echo "selected=\"selected\"";} ?>>Website</option>
                            </select>
                        </td>
                      </tr>                      <tr>
                        <td align="right" valign="top"><p>Interactivity type</p></td>
                        <td valign="top">
                        	<select name="InteractivityType" class="width-auto" id="InteractivityType">
                        	  <option value="Active" <?php if (!(strcmp("Active", $row_Resource['InteractivityType']))) {echo "selected=\"selected\"";} ?>>Active</option>
                        	  <option value="Expositive" <?php if (!(strcmp("Expositive", $row_Resource['InteractivityType']))) {echo "selected=\"selected\"";} ?>>Expositive</option>
                        	  <option value="Mixed" <?php if (!(strcmp("Mixed", $row_Resource['InteractivityType']))) {echo "selected=\"selected\"";} ?>>Mixed</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Learning resource type</p></td>
                        <td valign="top">
                        	<select name="ResourceType" class="width-auto" id="ResourceType">
                          	<option value="None" <?php if (!(strcmp("None", $row_Resource['LearningResourceType']))) {echo "selected=\"selected\"";} ?>>None</option>
                        	  <option value="Interactive" <?php if (!(strcmp("Interactive", $row_Resource['LearningResourceType']))) {echo "selected=\"selected\"";} ?>>Exercise</option>
                        	  <option value="Presentation" <?php if (!(strcmp("Presentation", $row_Resource['LearningResourceType']))) {echo "selected=\"selected\"";} ?>>Slide</option>
                             <option value="Reading" <?php if (!(strcmp("Reading", $row_Resource['LearningResourceType']))) {echo "selected=\"selected\"";} ?>>Reading</option>
                          </select>
                        </td>
                      </tr> 
                      <tr>
                        <td align="right" valign="top"><p>Primary audience</p></td>
                        <td valign="top">
                        	<select name="Audience" class="width-auto" id="Audience">
                        	  <option value="Learners" <?php if (!(strcmp("Learners", $row_Resource['EndUserRole']))) {echo "selected=\"selected\"";} ?>>Learners</option>
                        	  <option value="Teachers" <?php if (!(strcmp("Teachers", $row_Resource['EndUserRole']))) {echo "selected=\"selected\"";} ?>>Teachers</option>
                            </select>
                        </td>
                      </tr>
      <!--                <tr>
                        <td align="right" valign="top"><p>Time required</p></td>
                        <td valign="top">
                        	<input name="Time" type="text" class="width-auto" id="Time" placeholder="x hours x min" value="<?php echo $row_Resource['TimeRequired']; ?>">
                        </td>
                      </tr>-->
                      <tr>
                        <td align="right" valign="top"><p>Age range</p></td>
                        <td valign="top">
                          <p>Min. </p>
                          <input name="AgeMin" type="text" id="AgeMin" placeholder="minimum age" value="<?php echo $row_Resource['AgeStart']; ?>">
                          <p>Max. </p>
                          <input name="AgeMax" type="text" id="AgeMax" placeholder="maximum age" value="<?php echo $row_Resource['AgeEnd']; ?>">
                        </td>
                      </tr>
                                            <tr>
                        <td align="right" valign="top"><p>Educational use</p></td>
                        <td valign="top">
                        	<select name="Use" class="width-auto" id="Use">
                        	  <option value="None Specified" selected <?php if (!(strcmp("None Specified", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>None Specified</option>
                        	  <option value="Assessment" <?php if (!(strcmp("Assessment", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Assessment</option>
                        	  <option value="Assignment" <?php if (!(strcmp("Assignment", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Assignment</option>
                        	  <option value="Direct Instruction" <?php if (!(strcmp("Direct Instruction", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Direct Instruction</option>
                        	  <option value="Group Work" <?php if (!(strcmp("Group Work", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Group Work</option>
                        	  <option value="Indirect Instruction" <?php if (!(strcmp("Indirect Instruction", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Indirect Instruction</option>
                        	  <option value="Interactive / Experiential" <?php if (!(strcmp("Interactive / Experiential", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Interactive / Experiential</option>
                        	  <option value="Suggested Reading" <?php if (!(strcmp("Suggested Reading", $row_Resource['EducationalUse']))) {echo "selected=\"selected\"";} ?>>Suggested Reading</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Unit</p></td>
                        <td valign="top">
                        	<select name="Unit" class="width-auto" id="ResourceType">
                        	  <option value="1" <?php if (!(strcmp("1", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>1</option>
                        	  <option value="2" <?php if (!(strcmp("2", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>2</option>
                            <option value="3" <?php if (!(strcmp("3", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>3</option>
                            <option value="4" <?php if (!(strcmp("4", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>4</option>
                        	  <option value="5" <?php if (!(strcmp("5", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>5</option>
                            <option value="6" <?php if (!(strcmp("6", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>6</option>
                        	  <option value="7" <?php if (!(strcmp("7", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>7</option>
                        	  <option value="8" <?php if (!(strcmp("8", $row_Resource['Unit']))) {echo "selected=\"selected\"";} ?>>8</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Collection</p></td>
                        <td valign="top">
                        	<select name="Collection" size="3" multiple class="width-auto" id="ResourceType">
                        	  <option value="Curated" <?php if (!(strcmp("Curated", $row_Resource['Collection']))) {echo "selected=\"selected\"";} ?>>Curated Library</option>
                        	  <option value="Pearson" <?php if (!(strcmp("Pearson", $row_Resource['Collection']))) {echo "selected=\"selected\"";} ?>>Pearson Resources</option>
                        	  <option value="OER" <?php if (!(strcmp("OER", $row_Resource['Collection']))) {echo "selected=\"selected\"";} ?>>Open Educational Resource</option>
                          </select>
                        </td>
                      </tr>
                      <!--<tr>
                        <td align="right" valign="top"><p>Usage Rights</p></td>
                        <td valign="top">
							<select name="Rights" class="width-auto" id="Rights">
                                <option>Creative Commons</option>
                                <option>Other</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Based on this URL</p></td>
                        <td valign="top"><input type="text" class="span10" placeholder="http://www" name="BasedOn" id="BasedOn"></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Educational alignment</p></td>
                        <td valign="top">
                        	<select name="Alignment" class="width-auto" id="Alignment">
                                <option>Common Core</option>
                                <option>Other</option>
                            </select>
                        </td>
                      </tr>
                      -->

                      
                      <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td valign="top">
                        <input class="btn btn-primary" type="submit" name="button" id="button" value="Save Resource"></td>
                      </tr>
                    </table>
                	<input type="hidden" name="MM_action" value="<?php echo $action; ?>">
              	</form>
              </div>
          </section>
		</div>
    <!-- set up the modal to start hidden and fade in and out -->
    <div id="myModal" class="modal hide fade">
        <!-- dialog contents -->
        <div class="modal-body">URL:<input name="ImageURL" type="text"></div>
        <!-- dialog buttons -->
        <div class="modal-footer"><a href="#" class="btn primary">OK</a></div>
    </div>
    
        <!-- JS at the end of the page for faster loading -->

      	
      <script src="http://code.jquery.com/jquery-latest.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script>
      <script src="js/bootstrap-datepicker.js"></script> 
	  <script>
            $(function(){
                
                $('#dp1').datepicker({
                    format: 'mm-dd-yyyy'
                });
                
            });
						
						$("#myModal").on("show", function() {    // wire up the OK button to dismiss the modal when shown
								$("#myModal a.btn").on("click", function(e) {
										console.log("button pressed");   // just as an example...
										$("#myModal").modal('hide');     // dismiss the dialog
								});
						});
 
						$("#myModal").on("hide", function() {    // remove the event listeners when the dialog is dismissed
								$("#myModal a.btn").off("click");
						});
						 
						$("#myModal").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
								$("#myModal").remove();
						});
						 
						
        </script>
</body>
</html>
<?php
mysql_free_result($Resource);
?>
