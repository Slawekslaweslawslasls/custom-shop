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
					<li><a href="koszyk.html"><?=$txt->{'naw'}->{'koszyk'}?></a></li> 
					<li><a href="dane-klienta.html"><?=$txt->{'naw'}->{'daneklienta'}?></a></li> 
					<li><a href="wysylka.html"><?=$txt->{'naw'}->{'wysylka'}?></a></li> 
					<li><a href="anulowanie.html" class="aktywny"><?=$txt->{'naw'}->{'status'}?></a></li>						
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-cala-szer">
                        

                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela2">

                               <div class="koszyk-nawigacja2 min_wys_status_zamowienia">
                                  <?=$txt->{'status'}->{'statuszamowienia'}?>
                               </div>
                               <div class="koszyk-status">
                                  <!-- <div class="koszyk-status-a min_wys_status_dziekujemy"><?=$txt->{'status'}->{'dziekujemy'}?></div> -->
                                  <div class="anulowano_pp">
                    		    <span><?=$txt->{'anulowanie'}->{'anulowano_dokonanie_platnosci'}?></span>
                                  </div>
                                  <div class="kasuj"></div>
                               </div>
                                <a href="index.html" class="strglowna min_wys_szer_powrot_status_przycisk"><?=$txt->{'status'}->{'powrotdostronyglownej'}?></a>
                                <div class="kasuj"></div>
                          </div>
                       </div>
                <?php
            	    include('./include/prawa.inc.php');
                ?>
					   </div>

                <div class="kasuj"></div>
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