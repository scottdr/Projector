<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add new Resource</title>
        
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
                 <a class="brand" href="#"><img src="img/headerlogo.png">Common Core</a>
                </div>
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
                <h3>Add a new Resource</h3>
              </div>
            </section>

            
          <section class="row-fluid" style=" background-color:#FFF;">
            	<div style="padding:10px;" class="span12">
              	<form action="" method="post">
                	<table cellpadding="5" width="100%">
                      <tr>
                        <td width="25%" align="right" valign="top"><p>Title</p></td>
                        <td width="75%" valign="top">
                        <input type="text" class="span10" placeholder="Enter resource title ..." name="Title" id="Title">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Description</p></td>
                        <td valign="top">
                        <textarea name="Description" class="span10" placeholder="Enter description ..." rows="10" id="Description">
                        </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Resource URL</p></td>
                        <td valign="top">
                        <input type="text" class="span10" placeholder="http://www" name="ResourceURL" id="ResourceURL">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Thumbnail image</p></td>
                        <td valign="top">
                            <a class="btn btn-small" href="#" onClick="addImage(this)"><i class="icon-arrow-up"></i> Add image</a>
                            <br/><br/>
                            <img src="img/placeholder-square.jpg" class="img-polaroid" width="80">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Large image</p></td>
                        <td valign="top">
                            <a class="btn btn-small" href="#" onClick="addImage(this)"><i class="icon-arrow-up"></i> Add image</a>
                            <br/><br/>
                            <img src="img/placeholder-square.jpg" class="img-polaroid" width="200">
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
                        <td valign="top"><input type="text" placeholder="Title, First name, Last name" name="Author" id="Author" class="width-auto"></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Publisher</p></td>
                        <td valign="top"><input type="text" placeholder="Publisher name" name="Publisher" id="Publisher" class="width-auto"></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Primary language</p></td>
                        <td valign="top">
                            <select name="Language" class="width-auto" id="Language">
                                <option selected>English</option>                                
                                <option>French</option>
                                <option>German</option>
                                <option>Italian</option>
                                <option>Spanish</option>
                            </select>
					  	</td>
                     </tr>
					 <tr>
                        <td align="right" valign="top"><p>Media type</p></td>
                        <td valign="top">
                        	<select name="MediaType" class="width-auto" id="MediaType">
                                <option>Audio</option>
                                <option>Book</option>
                                <option>Challenge</option>
                                <option>Course</option>
                                <option>Handout</option>
                                <option>Image</option>
                                <option>Interactive</option>
                                <option>Lesson</option>
                                <option>Project</option>
                                <option>Slide</option>
                                <option>Textbook</option>
                                <option>Video</option>
                                <option>Website</option>
                            </select>
                        </td>
                      </tr>                      <tr>
                        <td align="right" valign="top"><p>Interactivity type</p></td>
                        <td valign="top">
                        	<select name="InteractivityType" class="width-auto" id="InteractivityType">
                                <option>Simulation application</option>
                                <option>Online simulation</option>
                                <option>Questionaire</option>
                                <option>Exercise</option>
                                <option>Problem statement</option>
                                <option>Hypertext document</option>
                                <option>Graphical diagrams or images</option>
                                <option>Audio recordings</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Learning resource type</p></td>
                        <td valign="top">
                        	<select name="ResourceType" class="width-auto" id="ResourceType">
                                <option>Exercise</option>
                                <option>Slide</option>
                          </select>
                        </td>
                      </tr>                      <tr>
                        <td align="right" valign="top"><p>Educational alignment</p></td>
                        <td valign="top">
                        	<select name="Alignment" class="width-auto" id="Alignment">
                                <option>Common Core</option>
                                <option>Other</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Primary audience</p></td>
                        <td valign="top">
                        	<select name="Audience" class="width-auto" id="Audience">
                                <option>Learners</option>
                                <option>Teachers</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Educational use</p></td>
                        <td valign="top">
                        	<select name="Use" class="width-auto" id="Use">
                                <option>Assignment</option>
                                <option>Group work</option>
                                <option>Direct instruction</option>
                                <option>Indirect instruction</option>
                                <option>Assessment</option>
                                <option>Teacher material</option>
                                <option>Interactive</option>
                                <option>Experimental</option>
                                <option>Other</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Time required</p></td>
                        <td valign="top">
                        	<input type="text" placeholder="x hours x min" name="Time" id="Time" class="width-auto">
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><p>Age range</p></td>
                        <td valign="top">
                          <p>Min. </p>
                          <input type="text" placeholder="minimum age" name="AgeMin" id="AgeMin">
                          <p>Max. </p>
                          <input type="text" placeholder="maximum age" name="AgeMax" id="AgeMax">
                        </td>
                      </tr>
                      <tr>
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
                        <td align="right" valign="top">&nbsp;</td>
                        <td valign="top">
                        <input class="btn btn-primary" type="submit" name="button" id="button" value="Save Resource"></td>
                      </tr>
                    </table>
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
