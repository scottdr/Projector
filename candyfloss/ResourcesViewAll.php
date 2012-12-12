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
                <h3>All Resources</h3>
              </div>
            </section>

            
          <section class="row-fluid" style=" background-color:#FFF;">
            	<div style="padding:10px;" class="span12">
            	  <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10%">&nbsp;</th>
                        <th width="10%">ID</th>
                        <th width="20%">Thumbnail</th>
                        <th width="50%">Title</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <a class="btn btn-mini btn-primary" href="#"><i class="icon-edit icon-white"></i> Edit</a>
                        </td>
                        <td>21</td>
                        <td><img src="img/placeholder-square.jpg" class="img-polaroid" width="100"></td>
                        <td>Title</td>
                        <td>
                        <a class="btn btn-mini btn-danger" href="#"><i class="icon-minus-sign icon-white"></i> Delete</a>
                        </td>
                    </tr>
                    <tr>
                      <td>
                      <a class="btn btn-mini btn-primary" href="#"><i class="icon-edit icon-white"></i> Edit</a>
                      </td>
                      <td>22</td>
                      <td><img src="img/placeholder-square.jpg" alt="" width="100" class="img-polaroid"></td>
                      <td>Title</td>
                      <td><a class="btn btn-mini btn-danger" href="#"><i class="icon-minus-sign icon-white"></i> Delete</a></td>
                    </tr>
                </tbody>
            </table>
            	</div>
          </section>
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
        </script>
</body>
</html>
