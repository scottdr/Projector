<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Browse Lessons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="_css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif;
			font-weight: 300;
			background-color: #333333;
			color: #FFF;
		}
		h1 {
			font-weight:200;
		}
		p {
			font-weight:200;
			font-size:18px;
			line-height:24px;
		}
		.pagination ul {
		  -webkit-border-radius: 0px;
			 -moz-border-radius: 0px;
				  border-radius: 0px;
		  *zoom: 1;
		  -webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
			 -moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
				  box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
		}
		.shadow {
			-webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
			box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
		}
		.navbar .nav > li > a {
			float: none;
			padding: 12px 15px 10px;
		}
		.navbar .nav > li > a.parent {
			background-image:url(_images/CC_UI/breadcrumbDivider.png);
			background-position:right;
			background-repeat:no-repeat;
			background-size:contain;
		}
		.lessonTypeHeading {
			font-weight:200;
			font-size:14px;
			line-height:16px;
		}
		.lessonContent {
			background-color: #FFF;
			padding: 30px;
			color:#333;
		}
		.lessonNavigation a {
			color:#FFF;
			font-weight:400;
		}
		.pagination ul > li > a,
		.pagination ul > li > span {
			float: left;
			padding-left: 20px;
			padding-right: 20px;
			padding-top: 10px;
			padding-bottom: 8px;
			line-height: 30px;
			text-decoration: none;
			background-color: rgba(102,102,102,0.8);
			border: 1px;
			border-style: solid;
			border-color: rgba(153,153,153,0.8);
			border-left-width: 0;
		}
		
		.pagination ul > li > a:hover,
		.pagination ul > .active > a,
		.pagination ul > .active > span {
			background-color: #666666;
		}
		
		.pagination ul > .active > a,
		.pagination ul > .active > span {
		  color: #999999;
		  cursor: default;
		}
		
		.pagination ul > .disabled > span,
		.pagination ul > .disabled > a,
		.pagination ul > .disabled > a:hover {
		  color: #999999;
		  cursor: default;
		  background-color: transparent;
		}
		
		.pagination ul > li:first-child > a,
		.pagination ul > li:first-child > span {
		  border-left-width: 1px;
		  -webkit-border-bottom-left-radius: 0px;
				  border-bottom-left-radius: 0px;
		  -webkit-border-top-left-radius: 0px;
				  border-top-left-radius: 0px;
		  -moz-border-radius-bottomleft: 0px;
		  -moz-border-radius-topleft: 0px;
		}
		
		.pagination ul > li:last-child > a,
		.pagination ul > li:last-child > span {
		  -webkit-border-top-right-radius: 0px;
				  border-top-right-radius: 0px;
		  -webkit-border-bottom-right-radius: 0px;
				  border-bottom-right-radius: 0px;
		  -moz-border-radius-topright: 0px;
		  -moz-border-radius-bottomright: 0px;
		}
		.popover {
		  min-height:400px;
		  color: #999999;
		  text-align:left;
		  position: absolute;
		  top: 0;
		  left: 0;
		  z-index: 1010;
		  display: none;
		  width: 400px;
		  padding: 0px;
		  background-color: #ffffff;
		  border: 5px solid #ccc;
		  border: 5px solid rgba(0, 0, 0, 0.6);
		  -webkit-border-radius: 5px;
			 -moz-border-radius: 5px;
				  border-radius: 5px;
		  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
			 -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
				  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		  -webkit-background-clip: padding-box;
			 -moz-background-clip: padding;
				  background-clip: padding-box;
		}
		
		.popover.top {
		  margin-top: -10px;
		}
		
		.popover-title {
			padding: 8px 14px;
			margin: 0;
			font-size: 14px;
			font-weight:100;
			line-height: 18px;
			color:#FFF;
			background-color: #000000;
			border-bottom: 1px solid #ebebeb;
			-webkit-border-radius: 0px 0px 0 0;
			-moz-border-radius: 0px 0px 0 0;
			border-radius: 0px 0px 0 0;
		}
		
		.popover-content {
		  padding: 9px 14px;
		}
		
		.popover-content p,
		.popover-content ul,
		.popover-content ol {
		  margin-bottom: 0;
		}
    </style>
    <link href="_css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
   

  </head>

  <body>

    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
           <ul class="nav">
              <li class="active"><a href="CC_UnitBrowser.php" class="parent"><i class="icon-home"></i></a></li>
              <li><a href="CC_UnitBrowser.php" class="parent">Grade II ELA</a></li>
              <li><a href="CC_EpisodeBrowser.php" class="parent">Unit 1</a></li>
              <li><a href="#">Episode 1: Title, Lesson 1</a></li>
          </ul>
        </div><!-- /.container -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    <div class="container" style="padding-top:80px;">
    
    	<div class="row-fluid">
            <div class="span12">
                <img src="_images/CC_UI/cc_ela_groupworktime.png" style="float:left; padding-right:10px;"/>
                <p class="lessonTypeHeading">GROUP PROJECT</p>
                <H1>WorkTime</H1>
			</div><!-- /.span -->
        </div><!-- /.row fluid -->
        
        <div class="row-fluid">
            <div class="span8 offset2 lessonContent">
            	<p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
            	<p>Ised nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
            	<p>Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. </p>
            	<p>Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
            	<p>Aaugue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. Integer sed nisi a metus tempor blandit. Praesent pretium auctor dui, non faucibus arcu sollicitudin ac. Fusce mollis augue at nunc blandit accumsan. Proin pulvinar purus in orci facilisis vestibulum. Donec id ante lacinia velit viverra ullamcorper. </p>
			</div><!-- /.span -->
        </div><!-- /.row fluid -->
      
    </div> <!-- /container -->
    
	<div class="navbar-fixed-bottom lessonNavigation">
        <div class="pagination pagination-centered">
            <ul>
                <li><a href="#">&lt;</a></li>
                <li>
					<a href="#" id="example" data-placement="top" rel="popover" data-content="html ribbon content here. number. title. description. thumbnail." data-original-title="In Lesson 1:">1</a>
                </li>
                <li><a href="#">&gt;</a></li>
            </ul>
          </div>
    </div> 


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.js"></script>
    <script type='text/javascript' src="js/bootstrap-tooltip.js"></script>
    <script type='text/javascript' src="js/bootstrap-popover.js"></script>
    
    <script>  
		$(function ()  
		{ $("#example").popover();  
		});  
	</script>  

  </body>
</html>
