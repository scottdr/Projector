<div id="ZeroBorderWidthWrapper">

    <div style="float: left; clear: both; width: 100%; height: 500px; margin:0">
    
        <div style="float:left; 
                display:block; 
                position:relative; 
                z-index:10; 
                padding:20px;
                height:500px;
                width:40%;
                background-color:rgba(0,0,0,.6)">
        
            <div id="Text"><?php echo $row_StepQuery['Text']; ?></div>
            
        </div>
        
        <div style="z-index:-10; float:left; clear:none; width:100%; position:relative; top:-500px; height:500px; overflow: hidden;">
        <?php GenerateImageTag(0); ?>
        </div>
        
    </div>
    
  </div>