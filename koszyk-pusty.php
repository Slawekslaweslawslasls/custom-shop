<?php
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
?>
    <body class="stopka-koszyk">
<?php
    include('./include/ciasteczka.inc.php');
?>
    <div class="calosc">
	<?php
	    $aktywny1= 'aktywny';
	    $aktywny2= '';
	    $aktywny3= '';
	    
	    include('./include/naglowek.inc.php');
	?>
       
       <div class="kasuj"></div>

       <div class="zawartosc">
          <div class="zawartosc-c">
            <div class="zawartosc-p">
            
                <div class="nawigacja">
                  <ul>
                    <li><a href="index.html"><?=$txt->{'naw'}->{'stronaglowna'}?></a></li>       
                    <li><a href="koszyk-pusty.html" class="aktywny"><?=$txt->{'naw'}->{'koszyk'}?></a></li>      
                  </ul>                                              
                </div>

    
      
   




               
                
                <div class="koszyk-pusty">
                    <img src="<?=$_SERV_CDN?>/grafika/koszyk-pusty.jpg" title="<?=$txt->{'koszyk'}->{'altpusty'}?>" alt="<?=$txt->{'koszyk'}->{'altpusty'}?>"></br>
                    <h3 class="min_wys_kosz_pusty"><?=$txt->{'koszyk'}->{'twojkoszykjestpusty'}?></h3>
                    <a class="min_wys_szer_kosz_pusty_przycisk" href="index.html"><?=$txt->{'koszyk'}->{'przejdzdostronyglownej'}?></a>
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
