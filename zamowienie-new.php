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
            script.src = target;
            var elem = document.head;
            elem.appendChild(script);
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
                                            <div class="koszyk-nawigacja2 min_wys_status_zamowienia">
                                                <?=$txt->{'status'}->{'statuszamowienia'}?>
                                            </div>
                                            <div class="koszyk-status">
                                                <div class="koszyk-status-a min_wys_status_dziekujemy">
                                                    <?=$txt->{'status'}->{'dziekujemy'}?>
                                                </div>
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

                                                <div class="grid50">
                                                    <div class="polec polec-ostatnia">
                                                        <h1>Poleć ten produkt:</h1>
                                                        <ul>
                                                            <li id="polec1"></li>
                                                            <li id="polec2"></li>
                                                            <li id="polec3"></li>
                                                            <li id="polec4"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class="polec polec-ostatnia">
                                                        <h1>Poleć ten produkt poprzez e-mail:</h1>
                                                        <div class="grid50 mar">
                                                            <div class="kontakt-prawa-formularz-f-1 float-label-div input-ostatnia-s" style="background-image:none;">
                                                                <input class="input-float input_mail in-os" id="email" type="text" name="email" data-blad="0" required="">
                                                                <label for="email">Podaj swój email<span style="color:#e84e50; display:none"> Uzupełnij pole!</span>
                                                            </label> </div>
                                                        </div>
                                                        <div class="grid50 mar">
                                                            <input class="input-ostatnia-sub" type="submit" value="WYŚLIJ">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="kasuj"></div>
                                            </div>


                                            <div class="koszyk-status">
                                                <h1 style="font-size:24px; color: #464648; margin-bottom: 15px;">Pomóż nam poprawić jakość usługi, weź udział w ankiecie </h1>
                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Jak oceniasz wygodę zakupów w sklepie?</p>
                                                        <div class="suma-gwiazdki">
                                                            <div class="sumag1">
                                                                <p class="sumap1">- mało wygodne</p>
                                                            </div>
                                                            <div class="sumag2">
                                                                <p class="sumap2">- średnio wygodne</p>
                                                            </div>
                                                            <div class="sumag3">
                                                                <p class="sumap3">- może być</p>
                                                            </div>
                                                            <div class="sumag4">
                                                                <p class="sumap4">- wygodne</p>
                                                            </div>
                                                            <div class="sumag5">
                                                                <p class="sumap5">- bardzo wygodne</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class="ocen-content-in">

                                                        <div class="ocen-gwiazdki ">
                                                            <fieldset class="score">
                                                                <legend>Score:</legend>

                                                                <input type="radio" id="score-5" name="score" value="5" />
                                                                <label title="5 gwiazdki" for="score-5">5 stars</label>

                                                                <input type="radio" id="score-4" name="score" value="4" />
                                                                <label title="4 gwiazdki" for="score-4">4 stars</label>

                                                                <input type="radio" id="score-3" name="score" value="3" />
                                                                <label title="3 gwiazdki" for="score-3">3 stars</label>

                                                                <input type="radio" id="score-2" name="score" value="2" />
                                                                <label title="2 gwiazdki" for="score-2">2 stars</label>

                                                                <input type="radio" id="score-1" name="score" value="1" />
                                                                <label title="1 gwiazdka" for="score-1">1 stars</label>

                                                            </fieldset>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Co moglibyśmy poprawić?</p>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class=" polec-ostatnia">
                                                        <div class="kontakt-prawa-formularz-f-4"> <textarea id="pytanie2" name="" value=""></textarea> </div>
                                                    </div>
                                                </div>

                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Co najbardziej podobało Ci się w procesie zakupu?</p>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class=" polec-ostatnia">
                                                        <div class="kontakt-prawa-formularz-f-4"> <textarea id="pytanie3" name="" value=""></textarea> </div>
                                                    </div>
                                                </div>

                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Czy było coś co mogło powstrzymać Cię od dokonania zakupu?</p>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class=" polec-ostatnia">
                                                        <div class="kontakt-prawa-formularz-f-4"> <textarea id="pytanie4" name="" value=""></textarea> </div>
                                                    </div>
                                                </div>

                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Czy było coś co mogło powstrzymać Cię od dokonania zakupu?</p>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class=" polec-ostatnia">
                                                        <div class="kontakt-prawa-formularz-f-4"> <textarea id="pytanie5" name="" value=""></textarea> </div>
                                                    </div>
                                                </div>

                                                <div class="grid50">
                                                    <div class="polec-ostatnia">
                                                        <p>Jak prawdopodobne jest, że poleciłbyś LVADshirt innej osobie?</p>
                                                        <p style="display: inline-block; color: #464648 !important; font-family: 'titillium_webregular' !important;">10 to bardzo prawdopodobne; 0 - mało prawdopodobne.</p>
                                                    </div>
                                                </div>
                                                <div class="grid50">
                                                    <div class="ocen-gwiazdki ocen-gwiazdki2" style="text-align: center;">
                                                        <form action="">
                                                            <label class="relative-lb">1
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                           </label>

                                                            <label class="relative-lb">2
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">3
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">4
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">5
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">6
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                           </label>

                                                            <label class="relative-lb">7
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">8
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb">9
                                                          <input type="radio" checked="" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>

                                                            <label class="relative-lb" style="margin-left: 3px;">10
                                                          <input type="radio" checked="" name="radio">
                                                          <span style="margin-left: 6px;" class="checkmark"></span>
                                                        </label>

                                                            <div class="grid50">
                                                            </div>
                                                            <div class="inp-sub">
                                                                <input class="input-ostatnia-sub" type="submit" value="WYŚLIJ">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        
                                        
                                            <h1 style="color:#E84E50; margin-bottom: 20px;">Dziękujemy za wypełnienie ankiety!</h1>
                                        


                                                <div class="kasuj"></div>
                                            </div>

                                            <div class="koszyk-status">
                                                <h1 style="font-size:24px; color: #464648; margin-bottom: 15px;">Inni użytkownicy kupili również:</h1>
                                                <div class="grid30">

                                                    <div class="polecane-img">
                                                        <img src="../grafika/produkt1/kobieta-czarna-6.jpg" alt="">
                                                    </div>
                                                    <p>Lorem ipsum</p>
                                                </div>
                                                <div class="grid30">
                                                    <div class="polecane-img">
                                                        <img src="../grafika/produkt1/kobieta-czarna-6.jpg" alt="">
                                                    </div>
                                                    <p>Lorem ipsum</p>
                                                </div>
                                                <div class="grid30">
                                                    <div class="polecane-img">
                                                        <img src="../grafika/produkt1/kobieta-czarna-6.jpg" alt="">
                                                    </div>
                                                    <p>Lorem ipsum</p>
                                                </div>
                                            </div>
                                            <div class="grid50">
                                            </div>
                                            <div class="grid50">
                                                
                                                
                                                    <div class="inp-sub" style="margin: 0;" > <input style="font-size:14px" class="input-ostatnia-sub" type="submit" value="Powrót do strony głównej">
                                                    </div>
                                                
                                            </div>
                                            
                                           

                                          
<!--                                                <a href="index.html" class="strglowna min_wys_szer_powrot_status_przycisk input-ostatnia-sub"><?=$txt->{'status'}->{'powrotdostronyglownej'}?></a>-->
                                         
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
            <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>
            <script>
                window.renderOptIn = function() {
                    window.gapi.load('surveyoptin', function() {
                        window.gapi.surveyoptin.render({
                            "merchant_id": "117423697",
                            "order_id": "<?=$_SESSION['id_zam']?>",
                            "email": "<?=$_SESSION['email']?>",
                            "delivery_country": "<?=$_SESSION['kraj']?>",
                            "estimated_delivery_date": "<?=date("
                            Y - m - d ", strtotime(" + 10 days "))?>",
                            "opt_in_style": "CENTER_DIALOG"
                        });
                    });
                }
            </script>

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