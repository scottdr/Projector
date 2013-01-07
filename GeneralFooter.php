 <?php include('Globals.php') ?>
 <?php include('VersionNumber.php') ?>
 
            <div id="GeneralFooterDiv">
                <hr/>
                <p>&copy; Pearson Foundation 2013 | <a href="mailto:labs@pearsonfoundation.org">Contact</a> | <a href="TermsConditions.php">Terms and Conditions</a>
                <?php if (!$PROJECTOR['editMode']) echo "<!-- "; ?> 
								<?php echo "&nbsp;Release: #" . $PROJECTOR['versionNumber']; ?>
                <?php if (!$PROJECTOR['editMode']) echo "--> " ?> 
                </p>
                <a href="http://www.teachingawards.com/home" target="_blank"><img src="_images/logo_teachingawards.gif" alt="Pearson Teaching Awards"></a>
                <!--a href="http://www.si.edu" target="_blank"><img src="_images/logo_smithsonian.gif" alt="Smithsonian"></a-->
                <a href="http://www.pearsonfoundation.org" target="_blank"><img src="_images/logo_pearsonfound.gif" alt="Pearson Foundation"></a>
                <a href="http://www.nationalmockelection.org" target="_blank"><img src="_images/logo_myvoice.gif" alt="My Voice My Election"></a>
               
           </div>