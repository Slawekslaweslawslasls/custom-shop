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
    <span class="mailok">
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
      <div class="wiadomosci-p">
        <div class="wiadomosci-c wiadomosci-c-mail">x</div>
        <div class="wiadomosci-pad">
        <h3><?=$txt->{'kontakt'}->{'dziekujemywiadomosczostalawyslana'}?></h3>
        <span><?=$txt->{'kontakt'}->{'wiadomoscinfo'}?></span></br></br>
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
        </div>
      </div>
    </div>
    </span>

	<?php
	    $aktywny1 = '';
	    $aktywny2 = '';
	    $aktywny3 = 'aktywny';
	    include('./include/naglowek.inc.php');    
	?>
       
       <div class="kasuj"></div>

       <div class="zawartosc">
          <div class="zawartosc-c">
            <div class="zawartosc-p">
            
                <div class="nawigacja">
                  <ul>
                    <li><a href="index.html"><?=$txt->{'naw'}->{'stronaglowna'}?></a></li>
                    <li><a href="kontakt.html" class="aktywny"><?=$txt->{'naw'}->{'kontakt'}?></a></li>
                  </ul>                                              
                </div>
                <div class="kontakt-lewa">
                  <h2 class="min_wys_kontakt"><?=$txt->{'kontakt'}->{'kontakt'}?></h2>
                  <p><span><?=$txt->{'kontakt'}->{'adres'}?></span></br>
                  <span><?=$txt->{'firma'}->{'nazwa'}?></span></br>
                  <span><?=$txt->{'firma'}->{'ulica'}?></span></br>
                  <span><?=$txt->{'firma'}->{'kod'}?></span> <span><?=$txt->{'firma'}->{'miasto'}?></span></br></br>
                  <span><?=$txt->{'kontakt'}->{'numertelefonu'}?></span></br>
                  <span class="kontakt-kolor"><?=$txt->{'firma'}->{'telefon'}?></span></br></br>
                  <span><?=$txt->{'kontakt'}->{'email'}?></span></br>
                  <a href="<?=$txt->{'firma'}->{'memail'}?>"><?=$txt->{'firma'}->{'email'}?></a></p>
                </div>
                <div class="kontakt-prawa">
                  <h2 class="min_wys_kontakt"><?=$txt->{'kontakt'}->{'wypelnijformularz'}?></h2>
                  <div class="mailblad" style="margin-bottom: 30px"><?=$txt->{'dane'}->{'uzupelnijwszystkiepolaformularza'}?></div>
                   <form id="wyslijmail" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>">
                     <div class="kontakt-prawa-formularz-lewy">
                        <div class="kontakt-prawa-formularz-lewy-p">
                          <div class="kontakt-prawa-formularz-f-1 float-label-div">
                             <input class="input-float input_mail" id="nazwiskokontakt" type="text" name="nazwiskokontakt" data-blad="0" required>
                             <label for="nazwiskokontakt"><?=$txt->{'dane'}->{'kontaktimieinazwisko'}?><span></span></label>
                          </div>
                          <div class="kontakt-prawa-formularz-f-2 float-label-div">
                             <input class="input-float input_mail" id="emailkontakt" type="text" name="emailkontakt" data-blad="0" required>
                             <label for="emailkontakt"><?=$txt->{'dane'}->{'kontaktemail'}?><span></span></label>
                          </div>
                          <div class="kontakt-prawa-formularz-f-3 float-label-div">
                             <input class="input-float input_mail" id="telkontakt" type="text" name="telkontakt" data-blad="0" required>
                             <label for="telkontakt"><?=$txt->{'dane'}->{'kontaktnumertelefonu'}?><span></span></label>
                          </div>                                                    
                        </div>
                     </div>
                     <div class="kontakt-prawa-formularz-prawy">
                        <div class="kontakt-prawa-formularz-prawy-p">
                          <div class="kontakt-prawa-formularz-f-4">
                            <textarea id="mailkontakt" name="in" value=""></textarea>
                          </div>
                          <input class="wyslijmailsubmit" type="submit" value="<?=$txt->{'kontakt'}->{'wyslij'}?>">
                        </div>
                     </div>
                   </form>

                   <div class="kasuj"></div>
                </div>




                <div class="kasuj"></div>
                
                <div class="kontakt-linia">
                   <p class="min_wys_info_kontakt"><?=$txt->{'kontakt'}->{'info'}?></p>
                   <a class="min_wys_zakupy_kontakt" href="index.html"><?=$txt->{'kontakt'}->{'przejdzdostronyzzakupami'}?></a>
                   <p class="min_wys_zobacztakze_kontakt"><?=$txt->{'kontakt'}->{'zobacztakze'}?></p>
                   <a class="min_wys_pytania_kontakt" href="pytania.html"><?=$txt->{'kontakt'}->{'najczesciejzadawanepytania'}?></a>
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
	    include('./include/chat.inc.php');
	?>
   </body>
</html>