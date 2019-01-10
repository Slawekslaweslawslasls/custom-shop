<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
    
	    if($_SESSION['ilosc'] == 0 || $_SESSION['id_zam'] == 0){
		header('Location: https://'.$_SERV.$_PATH.'/koszyk-pusty.html');
	    }
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
                    <li><a href="koszyk_pusty.html" class="aktywny"><?=$txt->{'naw'}->{'koszyk'}?></a></li>      
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-cala-szer">
                       <h2 class="min_wys_naw"><?=$txt->{'status'}->{'nawigacja'}?></h2>
                       

                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela2">

                               <div class="koszyk-nawigacja2 min_wys_status_zamowienia"><?=$txt->{'status'}->{'statuszamowienia'}?>
                                  
                               </div>
                               <div class="koszyk-status">
                                  <div class="koszyk-status-a min_wys_status_dziekujemy"><?=$txt->{'status'}->{'dziekujemy'}?></div>
                                  <div class="koszyk-status-text">
                        <?php
                    	    $query = "select * from dict_etap where id=".$_SESSION['etap'];
                    	    $res = mysqli_query($DB, $query);
                    	    $wiersz = mysqli_fetch_array($res);
                    	    echo '<span>'.$txt->{'baza'}->{'etapy'}->{$wiersz['nazwa']}.'</span>';
                        ?>
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
<?php
    $_SESSION['koszyk'] = array();
    $_SESSION['ilosc'] = 0;
    $_SESSION['kod'] = 0;
    $_SESSION['kod_nr'] = 'Wpisz kod';
    $_SESSION['kod_rodzaj'] = 'k';
    $_SESSION['kod_rabat'] = 0;
    $_SESSION['wysylka_kraj'] = 0;
    $_SESSION['etap'] = 0;
    $_SESSION['id_zam'] = 0;
?>                
          

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
