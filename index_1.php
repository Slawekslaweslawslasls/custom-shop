<?php
include("./include/lib.inc.php");
include("./include/settings.inc.php");
include("./include/header.inc.php");

$res = mysqli_query($DB, "select * from cennik c, dict_jezyk j where c.typ_towaru_id=1 and c.jezyk_id=j.id and j.skrot='" . $lang . "'");

$wiersz = mysqli_fetch_array($res);
$cena = $wiersz['cena'];
$cena_promocyjna = $wiersz['cena_promocyjna'];
$cena_schema = $cena;
$cena_promocyjna_schema = $cena_promocyjna;

$promocja = $cena_promocyjna != '';

$cena = dodaj_walute($cena, $waluta, $pozycja_symbolu);
$cena_promocyjna = dodaj_walute($cena_promocyjna, $waluta, $pozycja_symbolu);

if (isset($_SESSION['wybrana_plec'])) {
    $wybrana_plec = $_SESSION['wybrana_plec'];
} else {
    $wybrana_plec = 'k';
}
$selectedk = '';
$selectedm = '';
if ($wybrana_plec == 'k') {
    $display_rk = 'style="display:none"';
    $selectedk = 'data-selected="selected"';
}
if ($wybrana_plec == 'm') {
    $display_rk = '';
    $selectedm = 'data-selected="selected"';
}

if (isset($_SESSION['wybrany_rodzaj_koszulki'])) {
    $wybrany_rodzaj_koszulki = $_SESSION['wybrany_rodzaj_koszulki'];
    $resrk = mysqli_query($DB, "select rk.id, (select count(*) from towar t where t.rodzaj_koszulki_id=rk.id and t.plec='" . $wybrana_plec . "' and t.typ_towaru_id=1 and t.dostepny=1) as dostepny from dict_rodzaj_koszulki rk where rk.id=" . $wybrany_rodzaj_koszulki);
    $wierszrk = mysqli_fetch_array($resrk);
    if ($wierszrk['dostepny'] == 0) {
        $wybrany_rodzaj_koszulki = 0;
    }
} else {
    $wybrany_rodzaj_koszulki = 0;
}

$resrk = mysqli_query($DB, "select distinct rk.id, rk.nazwa, (select count(*) from towar t where t.rodzaj_koszulki_id=rk.id and t.plec='" . $wybrana_plec . "' and t.typ_towaru_id=1 and t.dostepny=1) as dostepny from dict_rodzaj_koszulki rk");

while ($wierszrk = mysqli_fetch_array($resrk)) {
    if ($wierszrk['dostepny'] != 0 && $wybrany_rodzaj_koszulki == 0) {
        $wybrany_rodzaj_koszulki = $wierszrk['id'];
    }
}


if (isset($_SESSION['wybrany_rozmiar'])) {
    $wybrany_rozmiar = $_SESSION['wybrany_rozmiar'];
    $resr = mysqli_query($DB, "select distinct r.id, r.skrot, (select count(*) from towar t where t.rozmiar_id=r.id and t.plec='" . $wybrana_plec . "' and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.typ_towaru_id=1 and dostepny=1) as dostepny from dict_rozmiar r where r.id=" . $wybrany_rozmiar);
    $wierszr = mysqli_fetch_array($resr);
    if ($wierszr['dostepny'] == 0) {
        $wybrany_rozmiar = 0;
    }
} else {
    $wybrany_rozmiar = 0;
}
$resr = mysqli_query($DB, "select distinct r.id, r.nazwa, r.skrot, (select count(*) from towar t where t.rozmiar_id=r.id and t.plec='" . $wybrana_plec . "' and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.typ_towaru_id=1 and dostepny=1) as dostepny from dict_rozmiar r");

while ($wierszr = mysqli_fetch_array($resr)) {
    if ($wierszr['dostepny'] != 0 && $wybrany_rozmiar == 0) {
        $wybrany_rozmiar = $wierszr['id'];
    }
}

if (isset($_SESSION['wybrany_kolor'])) {
    $wybrany_kolor = $_SESSION['wybrany_kolor'];
    $resk = mysqli_query($DB, "select distinct k.id, (select count(*) from towar t where k.id=t.kolor_id and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.rozmiar_id=" . $wybrany_rozmiar . " and t.typ_towaru_id=1 and t.plec='" . $wybrana_plec . "' and dostepny=1) as dostepny from dict_kolor k where k.id=" . $wybrany_kolor);
    $wierszk = mysqli_fetch_array($resk);
    if ($wierszk['dostepny'] == 0) {
        $wybrany_kolor = 0;
    }
} else {
    $wybrany_kolor = 0;
}

$resk = mysqli_query($DB, "select distinct k.id, k.nazwa, (select count(*) from towar t where k.id=t.kolor_id and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.rozmiar_id=" . $wybrany_rozmiar . " and t.typ_towaru_id=1 and t.plec='" . $wybrana_plec . "' and dostepny=1) as dostepny from dict_kolor k ");

while ($wierszk = mysqli_fetch_array($resk)) {

    if ($wierszk['dostepny'] != 0 && $wybrany_kolor == 0) {
        $wybrany_kolor = $wierszk['id'];
    }
}


zmien_obrazki($txt, $wybrana_plec, $wybrany_rodzaj_koszulki, $wybrany_kolor);
?>
<body>

    <!--Johnson zz Nebraski własnie kupił koszulkę-->
    <div class="ktos-kupil ukryj">
        <div class="zamknij" id="close">X</div>             
        <!--                  <div class="zdjecie-opinie" style="background: url(https://test.lvadshirt.com/foto/11.jpg);background-size: cover; background-position: center; background-repeat: no-repeat;"></div>-->

        <?php
        $query = "SELECT z.imie_zam, z.miasto_zam FROM zamowienie z, dict_jezyk dj WHERE z.jezyk_id=dj.id AND dj.skrot='".$lang."' AND z.etap_id>=6 AND z.kraj_zam_id IS NOT NULL LIMIT 10";
        $result = mysqli_query($DB, $query);
        $wiersz = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $rand_buyer=array_rand($wiersz,1);
        echo '<p>'.$wiersz[$rand_buyer]['imie_zam'].' z '.$wiersz[$rand_buyer]['miasto_zam']. ' juz kupil(a) LVADshirt</p>';

        ?>
       <!-- <p>„Jason z Nebraski właśnie kupił LVADshirt”</p>   -->
    </div>

    <!--
                    <script>
                        $(document).ready(function() {
                            $(".ktos-kupil").animate({
                                right: 0,
                                opacity: "show"
                            }, 600);
                        });
                    </script>
    -->

    <script type="text/javascript">

        function setrandom(){ 
            /*set chance of appearance 50/50*/
            var random_appear=Math.floor(Math.random() * 2);  
                if(random_appear==1){ 
                    console.log('Youre lucky guy, popup will appear this time..');
                    /*set time of appearance, 30-180sec*/
                    var random_time_appear=Math.floor(Math.random() * 180000+30000); 
                    setTimeout(function (){$('.ktos-kupil').show()}, random_time_appear);
                    console.log('Popup will appear after '+random_time_appear+'ms');
                    random_appear=0;
                }
                else{
                console.log('Popup will not appear this time..');
            }
        }


        $(document).ready(function () {        
            setrandom();
            $('.ktos-kupil').css('visibility', 'visible').animate({opacity: 1.0, right: ''}, 300);
        });
        $(function () {
            $(".ktos-kupil-zamknij").click(function () {
                $('.ktos-kupil').addClass("ktos-kupil-brak");
            });
        });
    </script>
    <!--        koniec Johnson-->


<?php
include('./include/ciasteczka.inc.php');
?>
    <span itemscope itemtype="http://schema.org/Product"><div class="calosc"><?php
    $aktywny1 = "aktywny";
    $aktywny2 = "";
    $aktywny3 = "";
    include('./include/naglowek.inc.php');
    ?>
            <div class="kasuj"></div>
            <?php
            //include('./include/ciasteczka2.inc.php');
            ?>
            <div class="zawartosc">
                <div class="zawartosc-c">       
<!--              <div class="baner"><img src="<?= $_SERV_CDN ?>/grafika/baner.jpg" alt=""></div>-->
<!--  Baner-->
                  <?php
                   if (file_exists('./include/banner.inc.php')) {
                           include('./include/banner.inc.php');
                        } ?>
<!--                 koniec Baner-->
                    <div class="zawartosc-p">

                        <div class="nawigacja">
                            <ul>
                                <li><a href="index.html"><?= $txt->{'naw'}->{'stronaglowna'} ?></a></li>       
                                <li><a href="index.html" class="aktywny"><?= $txt->{'naw'}->{'wyborproduktu'} ?></a></li>
                            </ul>
                        </div>
                        <div class="produkt">
                            <div class="produkt-zdjecie produkt-zdjecie-1">
                                <div class="produkt-zdjecie-p">
                                    <!-- tu bylo ustawianie ostatniego wyboru -->
                                    <div class="produkt-zdjecie-galeria">     
                                        <img class="obrduzy" data-nr="8" src="<?= $obrduzysrc ?>" alt="<?= $obrduzyalt ?>" title="<?= $obrduzyalt ?>"/>
                                    </div>
                                    <div class="produkt-zdjecie-miniatury">                       
                                        <div class="miniatura" id="miniatura-1">
                                            <div class="miniatura-p-1 min-p">
                                                <img class="obrmaly" data-nr="8" src="<?= $obrmaly8src ?>" alt="<?= $obrmaly1alt ?>" title="<?= $obrmaly1alt ?>"/>
                                                <div class="miniaura-akt" klasatekst="<?= $obrmaly5divklasatekst ?>" klasaobszar="<?= $obrmaly5divklasaobszar ?>" popis="<?= $obrmaly5divpopis ?>" popisfoto="<?= $obrmaly5divpopisfoto ?>">
                                                    <img class="obrmaly" data-nr="5" src="<?= $obrmaly5src ?>" alt="<?= $obrmaly5divpopis ?>" title="<?= $obrmaly5divpopis ?>"/>
                                                </div>
                                                <div class="miniaura-akt" klasatekst="<?= $obrmaly6divklasatekst ?>" klasaobszar="<?= $obrmaly6divklasaobszar ?>" popis="<?= $txt->{'index'}->{'niewidocznypodubraniami'} ?>" popisfoto="<?= $txt->{'index'}->{'niewidocznypodubraniamiopis'} ?>">
                                                    <img class="obrmaly" data-nr="6" src="<?= $obrmaly6src ?>" alt="<?= $obrmaly6divpopis ?>" title="<?= $obrmaly6divpopis ?>"/>
                                                </div>
                                                <div class="miniaura-akt" klasatekst="<?= $obrmaly7divklasatekst ?>" klasaobszar="<?= $obrmaly7divklasaobszar ?>" popis="<?= $obrmaly7divpopis ?>" popisfoto="<?= $obrmaly7divpopisfoto ?>">
                                                    <img class="obrmaly" data-nr="7" src="<?= $obrmaly7src ?>" alt="<?= $obrmaly7divpopis ?>" title="<?= $obrmaly7divpopis ?>"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="miniatura" id="miniatura-2">
                                            <div class="miniatura-p-2 min-p">
                                                <img itemprop="image" class="obrmaly" data-nr="2" src="<?= $obrmaly2src ?>" alt="<?= $obrmaly2alt ?>" title="<?= $obrmaly2alt ?>"/>
                                            </div>
                                        </div>
                                        <div class="miniatura" id="miniatura-3">
                                            <div class="miniatura-p-3 min-p">
                                                <img class="obrmaly" data-nr="3" src="<?= $obrmaly3src ?>" alt="<?= $obrmaly3alt ?>" title="<?= $obrmaly3alt ?>"/>
                                            </div>
                                        </div>
                                        <div class="miniatura" id="miniatura-4">
                                            <div class="miniatura-p-4 min-p">
                                                <img class="obrmaly" data-nr="4" src="<?= $obrmaly4src ?>" alt="<?= $obrmaly4alt ?>" title="<?= $obrmaly4alt ?>"/>
                                            </div>
                                        </div>
                                        <div class="kasuj"></div>
                                    </div>


                                    <!--Polec produkt początek-->
                                    <!-- 
                                    
                                    <div class="polec">
                                       
                                        <div class="okregi">
                                            <div class="okrag1"></div>
                                            <div class="okrag2"></div>     
                                        </div>
                                        <h1>Poleć ten produkt i zdobądź 10% zniżkę!</h1>
                                     <ul>
                                            <li id="polec1"></li>
                                            <li id="polec2"></li>
                                            <li id="polec3"></li>
                                            <li id="polec4"></li>
                                            <li id="polec5"></li>
                                        </ul>
                                    </div>
                                    
                                    -->
                                    <!--Polec produkt koniec-->

                                    <!-- opinie poczatek --->
<?php
$resop = mysqli_query($DB, "select o.id, o.imie, o.nazwisko, o.tresc, z.miasto_zam, k.nazwa, o.ocena from opinia o, dict_jezyk j, zamowienie z, dict_kraj k where o.active=1 and o.jezyk_id=j.id and z.id=o.zamowienie_id and k.id=z.kraj_zam_id and j.skrot='" . $lang . "' order by rand() limit 1");

if ($wierszop = mysqli_fetch_array($resop)) {

    $zdjecie = '';
    $dh = opendir($_LANG_PATH . $_PHOTO_PATH);

    while (($file = readdir($dh)) !== false) {
        $nazwa = substr($file, 0, strpos($file, '.'));
        if ($wierszop['id'] == $nazwa) {
            $zdjecie = 'https://' . $_SERV . $_PHOTO_PATH . '/' . $file;
        }
    }
    ?>
                                        <div class="opinie opinie-gora">
                                            <h4><?= $txt->{'index'}->{'opinieklientow'} ?></h4>
                                            <div class="arrows-opinie">                                   
                                                <button class="arrow-left"></button>
                                                <button class="arrow-right"></button>
                                            </div>

                                            <div class="kontener-opinie">
                                                <div class="kontener-opinie-naglowek">
    <?php
    if ($zdjecie != '') {
        ?>
                                                        <div class="zdjecie-opinie" style="background: url(<?= $zdjecie ?>);background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                                                        <?php
                                                    }
                                                    ?>                                       
                                                    <div class="tytul-opinia" data-id="<?= $wierszop['id'] ?>"><?= $wierszop['imie'] . ' ' . $wierszop['nazwisko'] ?>
                                                    </div>
                                                    <div class="opinia-miejsce"><i><?= $wierszop['miasto_zam'] ?>, <?= $wierszop['nazwa'] ?></i></div>
                                                    <div class="ocena-gwiazdki">
    <?php
    for ($i = 0; $i < $wierszop['ocena']; $i++) {
//										echo '<img src="'.$_SERV_CDN.'/grafika/star.png" width="18" height="18">';
        echo '<div class="star-div"></div>';
    }
    ?>
                                                    </div>
                                                </div>
                                                <div class="tresc-opinie"><span>"</span><?= $wierszop['tresc'] ?><span>"</span></div>
                                            </div>

                                        </div>

    <?php
}
?>				   
                                    <!-- opinie koniec -->


                                </div>

                            </div>

                            <div class="produkt-opis">
                                <div class="produkt-opis-p"> 
                                    <h1><span itemprop="description"><?php $leadNr = count(get_object_vars($txt->{'opis1'}));
if ($leadNr < $lead || $lead < 1) {
    $lead = 1;
};
echo $txt->{'opis1'}->{$lead}; ?></h1>
                                    <p class="min_wys_opis2_tresc">
                                        <span><?= $txt->{'opis2'}->{'naglowek'} ?></span> <span><?= $txt->{'opis2'}->{'tresc'} ?></span>
                                    </p>
                                    <?php
                                    if ($lang == 'pl') {
                                        ?>
                                        <div class="produkt-polecany-stow">
             <!--                              <img src="<?= $_SERV_CDN ?>/grafika/logo-m.jpg" alt="" title="" class="img-logo-img">-->
                                            <div class="logo-m-img"></div>
                                            <span class="img-logo-tekst"><?= $txt->{'index'}->{'produktpolecany'} ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <!-- opinie byly tutaj -->
                                    </span>
                                    <form>  
                                        <div class="formularze-szer min_wys_szer_plec">
                                            <input data-id="k" type="radio" name="iCheck" class="typ1 plec" <?= $selectedk ?>>
                                            <label><?= $txt->{'baza'}->{'kobieta'} ?></label>
                                        </div>                       
                                        <div class="formularze-szer min_wys_szer_plec">
                                            <input data-id="m" type="radio" name="iCheck" class="typ1 plec" <?= $selectedm ?>>
                                            <label><?= $txt->{'baza'}->{'mezczyzna'} ?></label>
                                        </div>
                                        <div class="kasuj"></div>
                                        <div class="formularze-pozycja" <?= $display_rk ?>>
                                            <label><?= $txt->{'koszyk'}->{'typ'} ?></label>
                                            <div class="formularze-pozycja-f">
                                                <select class="wybor rodzaje_koszulek">
                                                    <?php
                                                    /*
                                                      if(isset($_SESSION['wybrany_rodzaj_koszulki'])){
                                                      $wybrany_rodzaj_koszulki = $_SESSION['wybrany_rodzaj_koszulki'];
                                                      }else{
                                                      $wybrany_rodzaj_koszulki = 0;
                                                      }
                                                     */
                                                    $resrk = mysqli_query($DB, "select distinct rk.id, rk.nazwa, (select count(*) from towar t where t.rodzaj_koszulki_id=rk.id and t.plec='" . $wybrana_plec . "' and t.typ_towaru_id=1 and t.dostepny=1) as dostepny from dict_rodzaj_koszulki rk");
                                                    while ($wierszrk = mysqli_fetch_array($resrk)) {
                                                        $selected = '';
                                                        if ($wierszrk['dostepny'] > 0) {
                                                            if ($wybrany_rodzaj_koszulki == 0) {
                                                                $wybrany_rodzaj_koszulki = $wierszrk['id'];
                                                                $selected = 'selected="selected"';
                                                            } elseif ($wybrany_rodzaj_koszulki == $wierszrk['id']) {
                                                                $selected = 'selected="selected"';
                                                            }
                                                            echo '<option data-id="' . $wierszrk['id'] . '" ' . $selected . '>' . $txt->{'baza'}->{$wierszrk['nazwa']} . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="kasuj"></div>
                                        </div>
                                        <div class="formularze-pozycja">

                                            <label><?= $txt->{'koszyk'}->{'rozmiar'} ?></label>
                                            <div class="formularze-pozycja-f">
                                                <select class="wybor rozmiary">
<?php
/*
  if(isset($_SESSION['wybrany_rozmiar'])){
  $wybrany_rozmiar = $_SESSION['wybrany_rozmiar'];
  }else{
  $wybrany_rozmiar = 0;
  }
 */
$resr = mysqli_query($DB, "select distinct r.id, r.nazwa, r.skrot, (select count(*) from towar t where t.rozmiar_id=r.id and t.plec='" . $wybrana_plec . "' and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.typ_towaru_id=1 and dostepny=1) as dostepny from dict_rozmiar r");

while ($wierszr = mysqli_fetch_array($resr)) {
    $selected = '';
    if ($wierszr['dostepny'] > 0) {
        if ($wybrany_rozmiar == 0) {
            $wybrany_rozmiar = $wierszr['id'];
            $selected = 'selected="selected"';
        } elseif ($wybrany_rozmiar == $wierszr['id']) {
            $selected = 'selected="selected"';
        }
        echo '<option data-id="' . $wierszr['id'] . '" ' . $selected . '>' . $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wierszr['nazwa']} . '</option>';
    }
}
?>
                                                </select>

                                            </div>

                                            <div class="formularze-pomoc">
                                                <div class="formularze-pomoc-text">
                                                    <div class="formularze-pomoc-text-lewo">
                                                        <h3><?= $txt->{'index'}->{'rozmiarykoszulekmeskich'} ?></span></h3>
                                                        <div class="formularze-pomoc-text-rozm">
                                                            <img src="<?= $_SERV_CDN ?>/grafika/rozmiarowka2.png" title="<?= $txt->{'index'}->{'altrozmiarowkameska'} ?>" alt="<?= $txt->{'index'}->{'altrozmiarowkameska'} ?>">
                                                        </div>
                                                        <div class="formularze-pomoc-text-rozm">
                                                            <table class="tab-l">
                                                                <tr>
                                                                    <td></td>
                                                                    <td>A</td>
                                                                    <td>B</td>
                                                                    <td>C</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'small'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_s_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_s_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_s_c'} ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'medium'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_m_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_m_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_m_c'} ?></td>
                                                                </tr>                                                                      
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_l_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_l_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_l_c'} ?></td>
                                                                </tr>                 
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xl_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xl_c'} ?></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_extra_large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxl_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxl_c'} ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_extra_extra_large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxxl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxxl_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'m_xxxl_c'} ?></td>
                                                                </tr>                                                                                                                         
                                                            </table>
                                                        </div>
                                                        <div class="kasuj"></div>                                        
                                                    </div>   
                                                    <div class="formularze-pomoc-text-prawo">
                                                        <h3><?= $txt->{'index'}->{'rozmiarykoszulekdamskich'} ?></h3>
                                                        <div class="formularze-pomoc-text-rozm">
                                                            <img src="<?= $_SERV_CDN ?>/grafika/rozmiarowka2.png" title="<?= $txt->{'index'}->{'altrozmiarowkadamska'} ?>" alt="<?= $txt->{'index'}->{'altrozmiarowkadamska'} ?>">
                                                        </div>
                                                        <div class="formularze-pomoc-text-rozm">
                                                            <table class="tab-p">
                                                                <tr>
                                                                    <td></td>
                                                                    <td>A</td>
                                                                    <td>B</td>
                                                                    <td>C</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_small'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xs_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xs_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xs_c'} ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'small'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_s_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_s_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_s_c'} ?></td>
                                                                </tr>                                                                      
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'medium'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_m_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_m_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_m_c'} ?></td>
                                                                </tr>                 
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_l_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_l_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_l_c'} ?></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xl_b'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xl_c'} ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?= $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{'extra_extra_large'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xxl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xxl_a'} ?></td>
                                                                    <td><?= $txt->{'baza'}->{'wymiary'}->{'k_xxl_a'} ?></td>
                                                                </tr>                                                                                                                        
                                                            </table>
                                                        </div>
                                                        <div class="kasuj"></div>                                        
                                                    </div> 
                                                    <div class="kasuj"></div>
                                                    <div class="legenda-1"><?= $txt->{'index'}->{'legenda1'} ?>
                                                    </div>
                                                    <div class="legenda-2"><?= $txt->{'index'}->{'legenda2'} ?>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="kasuj"></div>
                                        </div>
                                        <div class="formularze-pozycja">
                                            <div class="formularze-l kolor"><?= $txt->{'koszyk'}->{'kolor'} ?></div>
                                            <div class="formularze-r lista_kolorow">
<?php
$resk = mysqli_query($DB, "select distinct k.id, k.nazwa, (select count(*) from towar t where k.id=t.kolor_id and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.rozmiar_id=" . $wybrany_rozmiar . " and t.typ_towaru_id=1 and t.plec='" . $wybrana_plec . "' and dostepny=1) as dostepny from dict_kolor k ");

$nr = 0;
/*
  if(isset($_SESSION['wybrany_kolor'])){
  $wybrany_kolor = $_SESSION['wybrany_kolor'];
  }else{
  $wybrany_kolor = 0;
  }
 */
while ($wierszk = mysqli_fetch_array($resk)) {

    $nr++;
    $selected = '';
    if ($wierszk['dostepny'] > 0) {
        if ($wybrany_kolor == 0) {
            $wybrany_kolor = $wierszk['id'];
            $selected = 'data-selected="selected"';
        } elseif ($wybrany_kolor == $wierszk['id']) {
            $selected = 'data-selected="selected"';
        }
        echo '<input data-id="' . $wierszk['id'] . '" type="radio" id="flat-radio-' . $nr . '" name="flat-radio" class="typ2 kolory" ' . $selected . '>';
        echo '<label for="flat-radio-' . $nr . '">' . $txt->{'baza'}->{$wierszk['nazwa']} . '</label>';
    }
}
?>
                                            </div>   
                                            <!--                                 W css jest regula dla klasy niedostepnosc ktora zmienia kolor na czerwony                              -->
                                            <div class="dostepnosc"><?= $txt->{'baza'}->{'produkt_dostepny'} ?></div>
                                            <div class="kasuj"></div> 
                                        </div>
                                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="dodaj-do-koszyka">
<?php
if ($promocja) {
    ?>	
                                                <div class="dodaj-do-koszyka-cena cena_podstawowa strikeout">&nbsp<?= $cena ?>&nbsp</div>
                                                <span itemprop="priceCurrency" content="<?= $waluta_pp ?>"><div itemprop="price" content="<?= $cena_promocyjna_schema ?>" class="dodaj-do-koszyka-cena"><?= $cena_promocyjna ?></div></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span itemprop="priceCurrency" content="<?= $waluta_pp ?>"><div itemprop="price" content="<?= $cena_schema ?>" class="dodaj-do-koszyka-cena"><?= $cena ?></div></span>
                                                <?php
                                            }
                                            // ciastka zapamietujace ostatni wybor

                                            if ($wybrana_plec == '' || $wybrany_rodzaj_koszulki == 0 || $wybrany_rozmiar == 0 || $wybrany_kolor == 0) {
                                                $disabled = 'disabled="disabled"';
                                            } else {
                                                $disabled = '';
                                                $resmark = mysqli_query($DB, "select id from towar t where t.kolor_id=" . $wybrany_kolor . " and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.rozmiar_id=" . $wybrany_rozmiar . " and t.typ_towaru_id=1 and t.plec='" . $wybrana_plec . "' and dostepny=1");
                                                $wierszmark = mysqli_fetch_array($resmark);
                                                $towar_id = $wierszmark['id'];

                                                // marketing

                                                mysqli_query($DB, "update marketing set koszulka=" . $towar_id . " where email='" . $_SESSION['email'] . "' and koszulka is null");

                                                setcookie("typ", $wybrany_rodzaj_koszulki, time() + 60 * 60 * 24 * 30, "/");
                                                setcookie("kolor", $wybrany_kolor, time() + 60 * 60 * 24 * 30, "/");
                                                setcookie("plec", $wybrana_plec, time() + 60 * 60 * 24 * 30, "/");
                                                setcookie("rozmiar", $wybrany_rozmiar, time() + 60 * 60 * 24 * 30, "/");

                                                // koniec marketing
                                            }
                                            ?>

                                            <input type="submit" class="dodaj-do-koszyka-d min_wys_szer_dodaj_do_koszyka_przycisk" <?= $disabled ?> value="<?= $txt->{'index'}->{'dodajdokoszyka'} ?>">
                                        </div>
                                    </form>

                                    <!-- opinie 2 poczatek --->
<?php
$resop = mysqli_query($DB, "select o.id, o.imie, o.nazwisko, o.tresc, z.miasto_zam, k.nazwa, o.ocena from opinia o, dict_jezyk j, zamowienie z, dict_kraj k where o.active=1 and o.jezyk_id=j.id and z.id=o.zamowienie_id and k.id=z.kraj_zam_id and j.skrot='" . $lang . "' order by rand() limit 1");

if ($wierszop = mysqli_fetch_array($resop)) {

    $zdjecie = '';
    $dh = opendir($_LANG_PATH . $_PHOTO_PATH);

    while (($file = readdir($dh)) !== false) {
        $nazwa = substr($file, 0, strpos($file, '.'));
        if ($wierszop['id'] == $nazwa) {
            $zdjecie = 'https://' . $_SERV . $_PHOTO_PATH . '/' . $file;
        }
    }
    ?>
                                        <div class="opinie opinie-dol">
                                            <h4><?= $txt->{'index'}->{'opinieklientow'} ?></h4>
                                            <div class="arrows-opinie">                                   
                                                <button class="arrow-left"></button>
                                                <button class="arrow-right"></button>
                                            </div>

                                            <div class="kontener-opinie">
                                                <div class="kontener-opinie-naglowek">
    <?php
    if ($zdjecie != '') {
        ?>
                                                        <div class="zdjecie-opinie" style="background: url(<?= $zdjecie ?>);background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
        <?php
    }
    ?>                                       
                                                    <div class="tytul-opinia" data-id="<?= $wierszop['id'] ?>"><?= $wierszop['imie'] . ' ' . $wierszop['nazwisko'] ?>
                                                    </div>
                                                    <div class="opinia-miejsce"><i><?= $wierszop['miasto_zam'] ?>, <?= $wierszop['nazwa'] ?></i></div>
                                                    <div class="ocena-gwiazdki">
                                                    <?php
                                                    for ($i = 0; $i < $wierszop['ocena']; $i++) {
//										echo '<img src="'.$_SERV_CDN.'/grafika/star.png" alt="gwiazdka">';
                                                        echo '<div class="star-div"></div>';
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <div class="tresc-opinie"><span>"</span><?= $wierszop['tresc'] ?><span>"</span></div>
                                            </div>

                                        </div>

    <?php
}
?>				   
                                    <!-- opinie 2 koniec -->


                                </div>
                            </div>
                            <div class="kasuj"></div>
                        </div>
                        <div class="kasuj"></div>
                    </div>
                </div>
            </div>
            <meta itemprop="name" content="<?= $txt->{'koszyk'}->{'nazwa'} ?>"></span>
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
