<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');



	    if($_SESSION['ilosc'] == 0){
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


<!--       Popup wyjscie z koszyka-->

<script>

    $(function() {
    $(".znizka-zamknij").click(function() {
    $(".znizka").fadeOut( 500);
    });

    $(".znizka-zamknij2").click(function() {
    $(".znizka2").fadeOut( 500);
  
    });


    $(".popup-klik").click(function(){
        $(".srebro-popup-klik").removeClass("srebro-popup-hide", 300);
    });
    $(".popup-klik2").click(function(){
        $(".srebro-popup-klik").removeClass("srebro-popup-hide", 300);
    });
    $("#srebro-close").click(function(){
        $(".srebro-popup-klik").addClass("srebro-popup-hide", 300);
    });
})
// $(".calosc").hover(function() {
   // $(".znizka").removeClass("ukryj",300);
 // });
</script>


<?php
//if($_SESSION['popup']==0){

  echo '<script>
      $(window).on("mousemove", function(e){ 
      if ( e.pageY < 5 ) {
        $(".znizka").removeClass("ukryj", 200);
      }
  })
  </script>';

//$_SESSION['popup']=1;
//}

?>
<span class="znizka ukryj">
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
        <div class="wiadomosci-p newsletter">
            <div class="wiadomosci-c znizka-zamknij">x</div>
            <div class="wiadomosci-pad">
            <img class="gift" src="../grafika/gift-ico.gif" alt=""></div>
            <h1>Co powiesz na 10% rabatu?</h1>
            <span>Podaj swój e-mail aby otrzymać kod</span>
<div class="znizka-form float-label-div2">
    <form id="wyslijmail" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>" data-uwaga-numer="<?=$txt->{'dane'}->{'uwaga-cyfra'}?>">

        <div class="float-label-div">
        <input class="input-float2 input_mail" data-wpis="1" id="emailkontakt" type="text" name="email-znizka" required>
        <label for="email-znizka">E-mail<span></span></label>
        <input type="submit" class="wyslijmailrabatsubmit" value="ZAPISZ SIĘ">
            </div>
    </form>

    <h3 class="ukryj">Nie udalo sie wyslac maila</h3>
</div>
</div>
</div>
</span>


<!--       koniec popup-->

<!--       Popup wyjscie z koszyka podziekowanie-->





<!----><span class="znizka2 ukryj">
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
        <div class="wiadomosci-p newsletter">
            <div class="wiadomosci-c znizka-zamknij2">x</div>
            <div class="wiadomosci-pad">
                <img class="gift" src="../grafika/gift-ico.gif" alt=""></div>
            <h1>GRATULUJEMY!</h1>
            <div style="margin-top:20px">
                    <p class="kod-wyjscie">Twój kod rabatowy wysłaliśmy mailem</p>
            </div>
</div>
</div>
</span>

<!--       koniec popup-->




       <div class="zawartosc">
          <div class="zawartosc-c">
            <div class="zawartosc-p">

                <div class="nawigacja">
                  <ul>
                    <li><a href="index.html"><?=$txt->{'naw'}->{'stronaglowna'}?></a></li>
                    <li><a href="koszyk.html" class="aktywny"><?=$txt->{'naw'}->{'koszyk'}?></a></li>
                  </ul>
                  <div class="rabat-kontener">
                   <div id="rabat-top" class="wpisz-rabat zamknij2">
                               <div id="rabat-zamknij" class="rabat-zamknij"></div>
                                <label class="blad-kod ukryj">Błędny kod</label>
                                <label class="wpisany-kod ukryj">Kod juz wpisany</label>
                                <label class="brak-kod ukryj">Brak kodu</label>
                                <label class="ok-kod ukryj">Sukces</label>
                               <input class="input-kod" type="text" placeholder="Wpisz kod tu">
                               <input class="zastosuj" style="-webkit-filter: grayscale(1);filter: grayscale(1);" value="ZASTOSUJ" type="submit">
                           </div>
                           <?php if($_SESSION['kod']==0){
                            echo '<div class="kupon-rabat-top">
                    <p>Masz kod rabatowy?</p>
                    </div>';
                          }
                          ?>
                </div>







<span class="srebro-popup-klik srebro-popup-hide">
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
        <div class="wiadomosci-p srebro-scroll">
            <div id="srebro-close" class="wiadomosci-c srebro-zamknij srebro-x">x</div>
           <div class="srebro-scroll-in">
            <div class="srebro-div srebro-img"></div>
            <div>

            <h1><?=$txt->{'koszyk'}->{'Jak działa powłoka srebra?'}?></h1>     
                <p> <?=$txt->{'koszyk'}->{'Tresc'}?></p>

            </div>
        </div>
</div>
</div>
</span>



                </div>


                <div class="koszyk-s-lewa">


                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela">
                           <table>
                              <tbody>
                                 <tr class="min_wys_koszyk_nag">
                                   <th class="min_szer_kosz_kom1"><div class="m-ukryj"><?=$txt->{'koszyk'}->{'zdjecie'}?></div></th>
                                   <th class="min_szer_kosz_kom2"></th>
                                   <th class="min_szer_kosz_kom3"><?=$txt->{'koszyk'}->{'produkt'}?></th>
                                   <th class="min_szer_kosz_kom4" style="text-align:right" class="koszyk-tabela-f1"><?=$txt->{'koszyk'}->{'ilosc'}?></th>
                                   <th class="min_szer_kosz_kom5" style="width:30px;"></th>
                                   <th class="min_szer_kosz_kom6" class="koszyk-tabela-c koszyk-tabela-b"><?=$txt->{'koszyk'}->{'dozaplaty'}?></th>
                                   <th class="min_szer_kosz_kom7" class="koszyk-tabela-c"><?=$txt->{'koszyk'}->{'usun'}?></th>
                                 </tr>
                	<?php
                	    $kwota_laczna = 0;

						foreach($_SESSION['koszyk'] as $klucz => $towar){
                if($towar['typ'] == 1){

                            	    $res = mysqli_query($DB, "select distinct rk.nazwa as rodzaj_koszulki, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from dict_rodzaj_koszulki rk, dict_rozmiar r, dict_kolor k where rk.id=".$towar['rodzaj_koszulki'].' and r.id='.$towar['rozmiar'].' and k.id='.$towar['kolor']);
									                   $wiersz = mysqli_fetch_array($res); 
				                                  }else{
                            	    $res = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$towar['typ']);
                            	    $wiersz = mysqli_fetch_array($res);
				                                        }

        
                //START query to db related to 'powloke'
                $res_powloke = mysqli_query($DB, "select cena from cennik c, dict_jezyk j where c.typ_towaru_id=3 and j.skrot='".$lang."' and c.jezyk_id=j.id");
                $wierszc_powloke = mysqli_fetch_array($res_powloke);
                $suma_powloka=$wierszc_powloke['cena'];
                if($towar['powloka']==1){
                  $suma_powloka=$wierszc_powloke['cena']*$towar['ilosc'];
                }
                //else{
                 // $suma_powloka=0;
                //}
               
                $suma_powloka_str=dodaj_walute($suma_powloka, $waluta, $pozycja_symbolu);                
                //END query to db related to powloke

                $resc = mysqli_query($DB, "select * from cennik c, dict_jezyk j where c.typ_towaru_id=".$towar['typ']." and c.jezyk_id=j.id and j.skrot='".$lang."'");
                                
                $wierszc = mysqli_fetch_array($resc);
								if($wierszc['cena_promocyjna'] == ''){
									$cenaj = $wierszc['cena'];
								}else{
									$cenaj = $wierszc['cena_promocyjna'];
								}
                                $cena = $cenaj * $towar['ilosc'];
                                $cena_str = dodaj_walute($cena, $waluta, $pozycja_symbolu);

                                if($towar['typ'] == 1){
                            	    $nazwa_obr = znajdz_obrazek($towar['rodzaj_koszulki'], $towar['plec'], $towar['kolor']);
                                }else{
                            	    $nazwa_obr = "obrazek-produkt-".$towar['typ'].".jpg";
                                }

                    	?>
                                 <tr class="koszyk-tabela-border pozycja" data-klucz="<?=$klucz?>" data-cena="<?=$cena?>" data-cenaj="<?=$cenaj?>" data-typ="<?=$towar['typ']?>">
                                   <td style="border-bottom:1px solid #fff"><img src="<?=$_SERV_CDN?>/grafika/<?=$nazwa_obr?>"  title="<?=$txt->{'koszyk'}->{'altzdjecieproduktu'}?>" alt="<?=$txt->{'koszyk'}->{'altzdjecieproduktu'}?>" class="obrazek-ob"></td>
                                   <td class="koszyk-tabela-l" style="border-bottom:1px solid #fff">
                                     <div class="m-ukryj"><span><?=$txt->{'koszyk'}->{'typ'}?></span>
                                     </br>
                            <?php
                                     if($towar['typ'] == 1){
                                        echo '<span>'.$txt->{'koszyk'}->{'plec'}.'</span></br>';
                                        echo '<span>'.$txt->{'koszyk'}->{'rozmiar'}.'</span></br>';
                                        echo '<span>'.$txt->{'koszyk'}->{'kolor'}.'</span>';
                                     }
                            ?>
                                     </div>
                                   </td>
                                   <td class="koszyk-tabela-o" style="border-bottom:1px solid #fff">
                            <?php
                                	if($towar['typ'] == 1){

                            ?>
                                     <div class="m-pokarz k-t-m1"></div>
									 <span><?=$txt->{'baza'}->{$wiersz['rodzaj_koszulki']}?></span></br>
                                     <div class="m-pokarz k-t-m1"></div>
                                     <?php if($towar['plec'] == 'm'){echo "<span>".$txt->{'baza'}->{'mezczyzna'}."</span>";}else{echo "<span>".$txt->{'baza'}->{'kobieta'}."</span>";}?></br>
                                     <div class="m-pokarz k-t-m1"></div>
                                     <span><?=$txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wiersz['rozmiar']}?></span></br>
                                     <div class="m-pokarz k-t-m1"></div>
                                     <span><?=$txt->{'baza'}->{$wiersz['kolor']}?></span>
                            <?php
                            }else{
                            ?>
                                     <div class="m-pokarz k-t-m1"><?=$txt->{'koszyk'}->{'typ'}?></div>
                                     <span><?=$txt->{'baza'}->{$wiersz['nazwa']}->{'nazwa'}?></span></br>
                            <?php
                            }

                            ?>
                                   </td>
                                   <td class="koszyk-tabela-f1" style="border-bottom:1px solid #fff">
                                     <div class="plusminus">
                                       <div class="plus">+</div>
                                       <div class="minus">-</div>
                                       <input type="text" disabled="disabled" name="ilosc" class="plusminuspoz" value="<?=$towar['ilosc']?>">

                                     </div>
                                   </td>
                                   <td style="border-bottom:1px solid #fff"></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena pozycja_cena" style="border-bottom:1px solid #F1F1F1">
                                     <?=$cena_str?>
                                   </td>
                                   <td class="koszyk-tabela-c" style="border-bottom:1px solid #fff">
                                     <a href="" class="usun_z_koszyka min_szer_usun_z_koszyka"><img src="<?=$_SERV_CDN?><?=$_PATH?><?=$_CDN?>/grafika/ikona-koszyk-m.gif" title="<?=$txt->{'koszyk'}->{'altusun'}?>" alt="<?=$txt->{'koszyk'}->{'altusun'}?>"></a>
                                   </td>
                                 </tr>
                                <tr class="koszyk-tabela-border">
                                   <td class="koszyk-tabela-l2" colspan="2">
                                      <div class="powloka pow1">
                                       <p class="powloka1"><?=$txt->{'koszyk'}->{'twoja koszulka powloka'}?></p>
                                       <p class="popup-klik" class="powloka3"><?=$txt->{'koszyk'}->{'Kliknij i dowiedz'}?></p>
                                    </div>
                                   </td>
                                   <td class="koszyk-tabela-f1 chebox-powloka" colspan="2">
                                   <div class="powloka pow2">
                                       <p class="powloka1">Chcesz aby Twoja koszulka była zabezpieczona antybakteryjną powłoką srebra?</p>
                                       <p class="popup-klik2" class="powloka3">Kliknij i dowiedz więcej</p>
                                    </div>
                                   <div class="checkBox-powloka">

                                    <?php
                                    if($_SESSION['koszyk'][$klucz]['powloka']==0){
                                      $checked='unchecked';
                                    }
                                    else{
                                      $checked='checked';
                                    }
                                      ?>                                      
                                    
                                    
                                    <input class="checkBox"  type="checkbox" name="powloka" <?=$checked?>>
                                    <label><p><?=$txt->{'koszyk'}->{'Zamawiam powloke'}?></p></label>

                                    


<!--                               Select list powloka srebra-->
<!--                               <div style="margin:0" class="koszyk-formularz-select powloka">
                                   <select>
                                   <option value="bez-powloki">Bez powłoki srebra</option>
                                    <option value="bez-powloki">Z powłoką srebra</option>
                                   </select>
                                   </div>
-->

                                    </div>


                                  </td>
                                   <td></td>
                                   <?php
                                   if($_SESSION['koszyk'][$klucz]['powloka']==0){
                                    $hidden='color: lightgray;';
                                   }
                                   ?>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena middle powloka-hidden" id="silver-cost" style="vertical-align:middle; <?=$hidden?>" pow-sum=<?=$suma_powloka?> data-koszt=<?=$wierszc_powloke['cena']?>>

                                    <?=$suma_powloka_str?></td>
                                   <td class="koszyk-tabela-c"></td>  
                                 </tr>
                        <?php
                             }
                        ?>
                                 <form id="koszykform" data-blednykod="<?=$txt->{'koszyk'}->{'uwagablednykod'}?>" data-wykorzystanykod="<?=$txt->{'koszyk'}->{'uwagakodjuzwykorzystano'}?>">
                                 <tr class="koszyk-tabela-noborder">
                                   <td class="koszyk-tabela-l2" colspan="2">
                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'wybierzkrajwysylki'}?></div>
                                   </td>
                                   <td  class="koszyk-tabela-f1" colspan="2">
                                               <div class="m-pokarz k-t-m1"><?=$txt->{'koszyk'}->{'wybierzkrajwysylki'}?></div>

                                               <?php
                                            	    $restkr = mysqli_query($DB, "select k.id, k.nazwa, j.kraj_domyslny_id, kw.koszt from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."'");

													$wiersztkr = mysqli_fetch_array($restkr);

                                                    if($wiersztkr['kraj_domyslny_id'] != 0){
														echo '<div class="koszyk-teren-kraju" data-koszt="'.$wiersztkr['koszt'].'" data-id="'.$wiersztkr['id'].'">'.$wiersztkr['nazwa'].'</div>';
														$koszt = $wiersztkr['koszt'];
														$_SESSION['wysylka_kraj'] = $wiersztkr['id'];
														$koszt_wysylki = $koszt;
														$koszt_wysylki_str = dodaj_walute($koszt, $waluta, $pozycja_symbolu);
                                                    }else{


                                                	echo '<div class="koszyk-select">';
                                                	echo '<select class="kraje_koszyk">';

													if($lang != 'us'){
														$reskr = mysqli_query($DB, "select k.id, k.nazwa, kw.koszt from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' order by k.nazwa");
													}else{
														$reskr = mysqli_query($DB, "select k.id, k.nazwa, kw.koszt from dict_kraj k, koszt_wysylki kw, dict_jezyk j where kw.kraj_docelowy_id=k.id and kw.jezyk_id=j.id and j.skrot='".$lang."' order by k.nazwa DESC");
													}
                                                	while($wierszkr = mysqli_fetch_array($reskr)){

                                                	    $koszt = $wierszkr['koszt'];

                                                	    if($_SESSION['wysylka_kraj'] == $wierszkr['id']){
															$selected = 'selected="selected"';
															$koszt_wysylki = $koszt;
															$koszt_wysylki_str = dodaj_walute($koszt, $waluta, $pozycja_symbolu);
														}elseif($_SESSION['wysylka_kraj'] == 0){
															$selected = 'selected="selected"';
															$_SESSION['wysylka_kraj'] = $wierszkr['id'];
															$koszt_wysylki = $koszt;
															$koszt_wysylki_str = dodaj_walute($koszt, $waluta, $pozycja_symbolu);
                                                	    }else{
															$selected = '';
                                                	    }
														echo '<option '.$selected.' data-koszt="'.$koszt.'" data-id="'.$wierszkr['id'].'">'.$wierszkr['nazwa'].'</option>';
                                                       }
                                                       echo '</select>';
                                                       echo '</div>';
                                                    }

                                                    ?>


                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena koszt_wysylki"  data-koszt="<?=$koszt_wysylki?>"><?=$koszt_wysylki_str?></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
<!--
                                 <tr class="koszyk-tabela-noborder">
                                   <td class="koszyk-tabela-l2" colspan="2">
                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'kosztwysylki'}?></div>
                                   </td>
                                   <td colspan="2" class="koszyk-tabela-f1">
                                     <div class="m-pokarz k-t-m1"><?=$txt->{'koszyk'}->{'kosztwysylki'}?></div>
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena koszt_wysylki" data-koszt="<?=$koszt_wysylki?>"><?=$koszt_wysylki_str?></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
-->
                                 <tr>

                                    <tr class="koszyk-tabela-noborder">
                                        <td class="koszyk-tabela-l2" colspan="2">
                                            <div class="kurier-logo m-ukryj"><img src="<?=$_SERV_CDN?>/grafika/fedex-logo.gif" alt="fedex"></div>
                                        </td>
                                        <td colspan="2" class="koszyk-tabela-f1">
                                           <div class="m-pokarz k-t-m1 kurier-logo"><img src="<?=$_SERV_CDN?>/grafika/fedex-logo.gif" alt="fedex"></div>
                                            <p style="text-align: right; color: #787878; font-size: 18px;"><?=$txt->{'wysylka'}->{'fedex'}?></p>
                                        </td>
                                        <td></td>
                                        <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena koszt_wysylki">

                                        </td>
                                        <td class="koszyk-tabela-c"></td>
                                    </tr>


                                 </tr>



								 <tr class="koszyk-tabela-noborder">
                                   <td class="koszyk-tabela-l2" colspan="2">
                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'promocjailosciowa'}?></div>
                                   </td>
                                   <td colspan="2" class="koszyk-tabela-f1">
                                     <div class="m-pokarz k-t-m1"><?=$txt->{'koszyk'}->{'promocjailosciowa'}?></div>
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena promocja_ilosciowa"></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
                                 <tr>





                                 <tr class="koszyk-tabela-noborder">
                                   <td class="koszyk-tabela-l2" colspan="2">
<!--                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'kodrabatowy'}?></div>                                  -->
                                   <p class="rabat-text ukryj">Rabat aplikowano w rozmiarze:</p>
                                 </td>
                                   <td class="koszyk-tabela-f1" colspan="2">


<!--                                        <div class="m-pokarz k-t-m1"><?=$txt->{'koszyk'}->{'kodrabatowy'}?></div>-->
<!--
                                        <div class="koszyk-formularz-f-1">
                                    		<?php
                                    		    if($_SESSION['kod'] == 0){
													echo '<input type="text" name="in" class="wpisz_kod" value="">';
                                    		    }else{
													echo '<input type="text" name="in" class="wpisz_kod" value="'.$_SESSION['kod_nr'].'">';
                                    		    }

                                    		?>
                                        </div>
-->

                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena rabat" data-rabat="<?=$_SESSION['kod_rabat']?>" data-rodzaj="<?=$_SESSION['kod_rodzaj']?>" data-hurt="<?=$_SESSION['kod_hurt']?>" data-hurt_typ="<?=$_SESSION['kod_hurt_typ']?>" data-hurt_ilosc="<?=$_SESSION['kod_hurt_ilosc']?>"></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
                                 <tr class="koszyk-tabela-border">
                                   <td class="koszyk-tabela-l2" colspan="2">

                                   </td>
                                   <td class="koszyk-tabela-f1" colspan="2">
<!--                                      <input type="submit" class="zastosuj" style="-webkit-filter: grayscale(1);filter: grayscale(1);" value="<?=$txt->{'koszyk'}->{'zastosuj'}?>">-->
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena"></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>


                                 <tr class="koszyk-tabela-border">
                                   <td class="koszyk-tabela-l3" colspan="2">
                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'lacznakwota'}?></div>
                                   </td>
                                   <td class="koszyk-tabela-f1" colspan="2">
                                     <div class="m-pokarz"><?=$txt->{'koszyk'}->{'lacznakwota'}?></div>
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena2 kwota_laczna" data-koszt="0">ee</td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
                                 <tr class="koszyk-tabela-noborder">
                                   <td class="koszyk-tabela-l3" colspan="2">
                                   </td>
                                   <td class="koszyk-tabela-f1" colspan="2">
                                     <a class="zamawiam_koszyk min_wys_przycisk" href="dane-klienta.html"><?=$txt->{'koszyk'}->{'zamawiam'}?></a>
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-cena2"></td>
                                   <td class="koszyk-tabela-c"></td>
                                 </tr>
                                 </form>
                              </tbody>
                           </table>
                          </div>
                       </div>


                <?php

					// SASZETKA
					/*
            	    $koszykklasa = 'aktywnylink';
            	    include('./include/prawa.inc.php');

                    $res = mysqli_query($DB, "select tt.id, tt.nazwa, c.cena from dict_typ_towaru tt, cennik c, dict_jezyk j where tt.id<>1 and tt.id=c.typ_towaru_id and c.jezyk_id=j.id and j.skrot='".$lang."'");

					while($wiersz = mysqli_fetch_array($res)){
						$cena = $wiersz['cena'];
						$cena = dodaj_walute($cena, $waluta, $pozycja_symbolu);

				?>
                    	<div class="koszyk-s-prawa-p produkt_dodatkowy" data-typ="<?=$wiersz['id']?>">
                	    <img src="<?=$_SERV_CDN?><?=$_PATH?><?=$_CDN?>/grafika/obrazek-produkt-2.jpg">
                    	    <p class="min_wys_prawa_dod_opis"><?=$txt->{'baza'}->{$wiersz['nazwa']}->{'opis'}?></p>
                    	    <p><span class="cena-p-r"><?=$cena?></span></p>
                    	    <a class="min_wys_przycisk dodaj-do-koszyka-dod" href="koszyk.html"><?=$txt->{'koszyk'}->{'dokoszyka'}?></a>
                	</div>

				<?php
            	    }
					*/
					// SASZETKA KONIEC

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


   <script type="text/javascript">

    $(function() {
        $(".kupon-rabat-top").click(function() {
            $("#rabat-top").removeClass("zamknij2", 300);
            $('.wpisz-rabat').removeClass('ukryj');
        });
    });
    $(function() {
        $("#rabat-zamknij").click(function() {
            $("#rabat-top").addClass("zamknij2", 300)

        });
    });
    $(function() {
        $(".srebro-zamknij").click(function() {
            $(".srebro-popup").addClass("zamknij2", 300)

        });
    });
</script>

   </body>
</html>
