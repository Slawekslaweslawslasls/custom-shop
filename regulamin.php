<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
?>
    <body> 
    
<?php
    include('./include/ciasteczka.inc.php');
?>

    <div class="calosc">
       
	<?php
	    $aktywny1 = '';
	    $aktywny2 = '';
	    $aktywny3 = '';
	    include('./include/naglowek.inc.php');
	?>


       
       <div class="kasuj"></div>

       <div class="zawartosc">
          <div class="zawartosc-c">
            <div class="zawartosc-p">
            
                <div class="nawigacja">
                  <ul>
                    <li><a href="index.html"><?=$txt->{'naw'}->{'stronaglowna'}?></a></li>
                    <li><a href="regulamin.html" class="aktywny"><?=$txt->{'naw'}->{'regulamin'}?></a></li>
                  </ul>
                </div>


                <div class="pytanie pytanie-p regulamin-pdf-prz">
                     <span><?=$txt->{'regulamin'}->{'regulaminsklepuinternetowego'}?></span>

                      <div class="regulamin-pdf"> 
                        <a href="<?php echo 'https://'.$_SERV.$_PATH.$_CDN.'/regulamin_pdf.html';?>"><?=$txt->{'regulamin'}->{'pobierzregulaminwwersjipdf'}?></a>
                     </div>              
                </div>   
      
    
                <div class="regulamin">
		    <?php
			include('./locales/'.$lang.'/regulamin.html');
		    ?>
                </div>  

              
            </div>
          </div> 
       </div>
   

	<?php
	    include('./include/stopka.inc.php');
	?>
    </div>
	<?php
	    include('./include/analytics.inc.php');
	?>
   

   </body>
</html>
