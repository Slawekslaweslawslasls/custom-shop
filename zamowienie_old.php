<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
?>

<body>
<script type="text/javascript">
ccConVal = 0;
var script = document.createElement("script");
script.async = true;
script.type = "text/javascript";
var target = 'https://www.clickcease.com/monitor/cccontrack.js';
script.src = target; var elem = document.head; elem.appendChild(script);
</script>

<noscript><img src="https://monitor.clickcease.com/conversions/conversions.aspx?value=0" /></noscript>

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
					<li><a href="zamowienie.html" class="aktywny"><?=$txt->{'naw'}->{'status'}?></a></li>	
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-cala-szer">

                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela2">
                               <div class="koszyk-nawigacja2 min_wys_status_zamowienia"><?=$txt->{'status'}->{'statuszamowienia'}?>
                               </div>
                               <div class="koszyk-status">
                                  <div class="koszyk-status-a min_wys_status_dziekujemy"><?=$txt->{'status'}->{'dziekujemy'}?></div>
                                  <div class="koszyk-status-text">
                        <?php
						/*
						$reszp = mysqli_query($DB, "select ilosc, plec, rodzaj_koszulki_id, rozmiar_id, kolor_id from zamowienie_pozycja where zamowienie_id=".$_SESSION['id_zam']);
						
						while($wierszzp = mysqli_fetch_array($reszp)){
							
							$rest = mysqli_query($DB, "select id from towar where plec='".$wierszzp['plec']."' and rodzaj_koszulki_id=".$wierszzp['rodzaj_koszulki_id']." and rozmiar_id=".$wierszzp['rozmiar_id']." and kolor_id=".$wierszzp['kolor_id']);
							$wierszt = mysqli_fetch_array($rest);
							mysqli_query($DB, "update towar set ilosc=ilosc-".$wierszzp['ilosc']." where id=".$wierszt['id']);
						}
						*/
                        ?>
                        	    <span><?=$txt->{'zamowienie'}->{'potwierdzono_dokonanie_platnosci'}?></span>
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
$query="SELECT `google_kod` FROM `zamowienie` WHERE id=".$_SESSION['id_zam'];
$resc=mysqli_query($DB, $query);
$wiersz = mysqli_fetch_array($resc);
if ($wiersz['google_kod']==0){
 echo '<script>
              window.renderOptIn = function() { 
                window.gapi.load("surveyoptin", function() {
                  window.gapi.surveyoptin.render(
                    {
                      "merchant_id":"117423697",
                      "order_id": "'.$_SESSION['id_zam'].'",
                      "email": "'.$_SESSION['email'].'",
                      "delivery_country": "'.$_SESSION['kraj'].'",
                      "estimated_delivery_date": "'.date("Y-m-d", strtotime("+10 days")).'",
                      "opt_in_style": "CENTER_DIALOG"
                    }); 
                });
              }
</script>'; 

$query="UPDATE `zamowienie` SET google_kod=1 WHERE id=".$_SESSION['id_zam'];
mysqli_query($DB, $query);

}

    ?>
    
<script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>




<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 845333157;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "IKDWCO2b33MQpYWLkwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/845333157/?label=IKDWCO2b33MQpYWLkwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	<?php
	    include('./include/analytics.inc.php');
	?>

   </body>
</html>