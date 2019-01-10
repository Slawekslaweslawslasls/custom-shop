<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
?>
    <body>

    <div class="calosc">
    <span class="mailok">
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
      <div class="wiadomosci-p">
        <div class="wiadomosci-c wiadomosci-c-mail">x</div>
        <div class="wiadomosci-pad">
        <h3><?=$txt->{'kontakt'}->{'dziekujemywiadomosczostalawyslana'}?></h3>
        <span><?=$txt->{'kontakt'}->{'wiadomoscinfo'}?></span></br></br>


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
                    <li><a href="glosy.php" class="aktywny"><?=$txt->{'naw'}->{'Głosy'}?>Głosy</a></li>
                  </ul>                                              
                </div>
                <div class="odstep"></div>
                <div class="glosy-kolumna">
                  <div class="glosy-ocena">
                      <p class="procent">4,8</p>

                    <div class="glosy-ocena ">
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena-pol"></div>
                          <p class="ilosc-opinii">128 opinii</p>
                      </div>
    
                  </div>
                  
                </div>
                <div class="glosy-kolumna39 center">
                 <div class="glosy-kolumna2" style="width:40%">
                  <div class="glosy-ocena block left">
                         <p>5</p>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                    </div> 
                    <div class="glosy-ocena block left">
                         <p>4</p>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                    </div>  
                    <div class="glosy-ocena block left">
                         <p>3</p>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                    </div> 
                    <div class="glosy-ocena block left">
                         <p>2</p>
                          <div class="star-div-ocena"></div>
                          <div class="star-div-ocena"></div>
                    </div>
                    <div class="glosy-ocena block left">
                         <p>1</p>
                          <div class="star-div-ocena"></div>
                    </div>              
                </div> 
                <div class="glosy-kolumna2" style="width:58%"> 
                    <div class="line-div-ocena"></div>           
                    <div class="line-div-ocena2"></div>           
                    <div class="line-div-ocena3"></div>           
                    <div class="line-div-ocena3"></div>           
                    <div class="line-div-ocena3"></div>           
                </div>
                </div>
                <div class="glosy-kolumna xs-usun">
                    <div class="produkt-opis-p mleft">
                        <h1 style="margin-bottom:0px;">99% <br> <span>Zadowolonych klientów</span></h1>
                    </div>
                </div>
                <div class="odstep"></div>
                <div class="kontener-opinia">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
                </div>
                <div class="kontener-opinia2">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum en tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
                </div>
                                <div class="kontener-opinia">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum en tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
                </div>
                <div class="kontener-opinia2">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum en tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
                </div>
                                <div class="kontener-opinia">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum en tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
                </div>
                <div class="kontener-opinia2">
                    <div class="opinia-kafel-1">               
                        <div class="kontener-opinie-naglowek">
                            <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/13.png);background-size: cover; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="ocena-gwiazdki">
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                                <div class="star-div"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="opinia-kafel-2">
                        <div class="tytul-opinia" data-id="13">Debby Kirby </div>
                        <div class="opinia-miejsce"><i>Wellborn, USA</i></div>
                        <div class="data-dodania">komentarz dodano: <span>21.10.2018</span></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim cupiditate, unde in quo amet, rerum en tempora illum animi soluta, laboriosam iste, nulla modi. Voluptatibus, perferendis repudiandae, labore necessitatibus dolore ipsum.</p>
                    </div>
                    <div class="opinia-kafel-3">
                        <img src="https://test.lvadshirt.com/grafika/produkt6/kobieta-biala-4m.jpg" alt="t-shirt">
                    </div>
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