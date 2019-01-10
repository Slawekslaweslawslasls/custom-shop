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
                    <li><a href="koszyk.html"><?=$txt->{'naw'}->{'koszyk'}?></a></li> 
					<li><a href="dane-klienta.html"><?=$txt->{'naw'}->{'daneklienta'}?></a></li> 
					<li><a href="podsumowanie.html" class="aktywny"><?=$txt->{'naw'}->{'podsumowanie'}?></a></li>						
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-cala-szer">
                       <h2 class="min_wys_naw"><?=$txt->{'podsumowanie'}->{'nawigacja'}?></h2>
                       

                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela2">
                           <table>
                              <tbody>
                                 <tr class="min_wys_koszyk_nag">
                                   <th class="min_szer_pods_kom1"><div class="m-ukryj"><?=$txt->{'koszyk'}->{'zdjecie'}?></div></th>
                                   <th class="min_szer_pods_kom2"></th>
                                   <th class="min_szer_pods_kom3"><?=$txt->{'koszyk'}->{'produkt'}?></th>
                                   <th style="text-align:center" class="min_szer_pods_kom4" class="koszyk-tabela-c"><?=$txt->{'koszyk'}->{'ilosc'}?></th>
                                   <th class="min_szer_pods_kom5" style="width:30px;"></th>
                                   <th class="min_szer_pods_kom6" class="koszyk-tabela-c koszyk-tabela-b"><?=$txt->{'koszyk'}->{'dozaplaty'}?></th>
                                 </tr>
                                 
                        <?php
                    	    $query1 = "select z.id, rk.nazwa as rodzaj_koszulki, z.plec, r.nazwa as rozmiar, r.skrot, k.nazwa as kolor, z.cena, z.ilosc, z.typ_towaru_id, z.powloka from zamowienie_pozycja z, dict_rodzaj_koszulki rk, dict_rozmiar r, dict_kolor k where z.kolor_id=k.id and z.rozmiar_id=r.id and z.rodzaj_koszulki_id=rk.id and z.typ_towaru_id=1 and z.zamowienie_id=".$_SESSION['id_zam'];
                    	    $query2 = "select z.id, NULL as rodzaj_koszulki, NULL as plec, NULL as rozmiar, NULL as skrot, NULL as kolor, z.cena, z.ilosc, z.typ_towaru_id, z.powloka from zamowienie_pozycja z where z.typ_towaru_id<>1 and z.zamowienie_id=".$_SESSION['id_zam'];
                    	    $query = $query1.' UNION '.$query2;
                    	    $res = mysqli_query($DB, $query);
                    	    $suma = 0;
							$ilosc = 0;

                      //dowiedziec koszt powloki
                      $res_powloke = mysqli_query($DB, "select cena from cennik c, dict_jezyk j where c.typ_towaru_id=3 and j.skrot='".$lang."' and c.jezyk_id=j.id");
                      $wierszc_powloke = mysqli_fetch_array($res_powloke);


                    	while($wiersz = mysqli_fetch_array($res)){
                    		$cena = dodaj_walute($wiersz['ilosc']*$wiersz['cena'], $waluta, $pozycja_symbolu);
                    		$suma += $wiersz['ilosc']*$wiersz['cena'];
//var_dump($wiersz);
                        $suma_powloka=0;
                        if($wiersz['powloka']==1){
                        $suma_powloka+=$wiersz['ilosc']*$wierszc_powloke['cena'];
                        }

                        $cena_powloka=dodaj_walute($wiersz['ilosc']*$wierszc_powloke['cena'], $waluta, $pozycja_symbolu);

                    	   $ilosc += $wiersz['ilosc'];
                    		if($wiersz['typ_towaru_id'] == 1){
				    
				    $query_obr = "select rodzaj_koszulki_id as rodzaj_koszulki, plec, kolor_id as kolor from zamowienie_pozycja where id=".$wiersz['id'];
				    $res_obr = mysqli_query($DB, $query_obr);
				    $towar = mysqli_fetch_array($res_obr);
                                
				
                    		    $nazwa_obr = znajdz_obrazek($towar['rodzaj_koszulki'], $towar['plec'], $towar['kolor']);
                    		
                    		    $plec = $wiersz['plec'] == 'm'?'mezczyzna':'kobieta';
                            	    echo '<tr class="koszyk-tabela-border">
                                	<td class="width50"><img src="'.$_SERV_CDN.'/grafika/'.$nazwa_obr.'" class="obrazek-ob" alt="'.$txt->{'podsumowanie'}->{'altzdjecieproduktu'}.'" title="'.$txt->{'podsumowanie'}->{'altzdjecieproduktu'}.'"></td>
                            		<td class="koszyk-tabela-l width50" > 
                                        <div class="m-ukryj">
                                	 <span>'.$txt->{'koszyk'}->{'typ'}.'</span></br>
                                        <span>'.$txt->{'koszyk'}->{'plec'}.'</span></br>
                                        <span>'.$txt->{'koszyk'}->{'rozmiar'}.'</span></br>
                                	<span>'.$txt->{'koszyk'}->{'kolor'}.'</span>
                                        </div>
                            		</td>
                                	<td class="koszyk-tabela-o">
                                    	    <div class="m-pokarz k-t-m1"></div>
                                    	    <span>'.$txt->{'baza'}->{$wiersz['rodzaj_koszulki']}.'</span></br>
                                    	    <div class="m-pokarz k-t-m1"></div>
                                    	    <span>'.$txt->{'baza'}->{$plec}.'</span></br>
                                    	    <div class="m-pokarz k-t-m1"></div>
                                    	    <span>'.$txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wiersz['rozmiar']}.'</span></br>
                                    	    <div class="m-pokarz k-t-m1"></div>
                                    	    <span>'.$txt->{'baza'}->{$wiersz['kolor']}.'</span>    
                                          
                                	</td>

                                	<td class="koszyk-tabela-c koszyk-tabela-o2">
                                    	    '.$wiersz['ilosc'].'
                                	</td>
                                	<td></td>
                                	<td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena">
                                    	    '.$cena.'
                            		</td>
                                	<td> 
                                	</td>
                                    </tr>';

                                    if(($wiersz['powloka'])==1){
                                      echo '
                                  <tr class="koszyk-tabela-border">
                                  <td></td>
                                  <td class="koszyk-tabela-l"><p>Powloka:</p>
                                  </td>
                                  <td class="koszyk-tabela-o"></td>
                                  <td class="koszyk-tabela-c koszyk-tabela-o2">
                                  </td>
                                  <td></td>
                                  <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena">
                                  '.$cena_powloka.'
                                  </td>
                                  </tr>
                                  ';
                                    }
                                    
                        	}else{
                        	    $resn = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wiersz['typ_towaru_id']);
                        	    $wierszn = mysqli_fetch_array($resn);
                        	    
                            	    echo '<tr class="koszyk-tabela-border">
                                    <td><img src="'.$_SERV_CDN.'/grafika/obrazek-produkt-'.$wiersz['typ_towaru_id'].'.jpg" class="obrazek-ob"></td>
                            	    <td class="koszyk-tabela-l"> 
                                        <div class="m-ukryj">
                                	 <span>'.$txt->{'koszyk'}->{'typ'}.'</span></br>
                                        </div>
                            	    </td>
                                    <td class="koszyk-tabela-o">
                                     <div class="m-pokarz k-t-m1"></div>
                                     <span>'.$txt->{'baza'}->{$wierszn['nazwa']}->{'nazwa'}.'</span></br>
                                    </td>
                                    <td class="koszyk-tabela-c koszyk-tabela-o2">
                                     '.$wiersz['ilosc'].'
                                    </td>
                                    <td></td>
                                    <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena">
                                     '.$cena.'
                            	    </td>
                                    <td> 
                                   </td>
                                 </tr>';
                            
                        	}
                        }
						$rabat_il1 = 0;
						if($_LAST_DISCOUNT == 1){
							$ilosc_il1 = 0;
							$cenaj_il1 = 0;
							$query = "select z.id, rk.nazwa as rodzaj_koszulki, z.plec, r.nazwa as rozmiar, r.skrot, k.nazwa as kolor, z.cena, z.ilosc, z.typ_towaru_id from zamowienie_pozycja z, dict_rodzaj_koszulki rk, dict_rozmiar r, dict_kolor k where z.kolor_id=k.id and z.rozmiar_id=r.id and z.rodzaj_koszulki_id=rk.id and z.typ_towaru_id=1 and z.zamowienie_id=".$_SESSION['id_zam'];
                    	    $res = mysqli_query($DB, $query);
							$ilosc_il1 = 0;
							while($wiersz = mysqli_fetch_array($res)){
								$cenaj_il1 = $wiersz['cena'];
								$ilosc_il1 += $wiersz['ilosc'];
							}
							$ilosc_il1 = floor($ilosc_il1/$_LAST_NUM);
							$rabat_il1 = floor(($_LAST_VALUE/100)*$cenaj_il1*$ilosc_il1*100)/100;
						}
							//var_dump($rabat_il1);
													
						$rabat_il2 = 0;
						if($_DEFAULT_DISCOUNT == 1 && $ilosc >= $_DEFAULT_NUM){
							
							$query = "select z.id, rk.nazwa as rodzaj_koszulki, z.plec, r.nazwa as rozmiar, r.skrot, k.nazwa as kolor, z.cena, z.ilosc, z.typ_towaru_id from zamowienie_pozycja z, dict_rodzaj_koszulki rk, dict_rozmiar r, dict_kolor k where z.kolor_id=k.id and z.rozmiar_id=r.id and z.rodzaj_koszulki_id=rk.id and z.typ_towaru_id=1 and z.zamowienie_id=".$_SESSION['id_zam'];
                    	    $res = mysqli_query($DB, $query);
							$suma_il2 = 0;
							while($wiersz = mysqli_fetch_array($res)){
								$suma_il2 += $wiersz['ilosc']*$wiersz['cena'];
							}
							$rabat_il2 = floor(($_DEFAULT_VALUE/100)*$suma_il2*100)/100;
						}	
							//var_dump($rabat_il2);
                    	    $query = "select kw.koszt from koszt_wysylki kw, zamowienie z where kw.kraj_docelowy_id=z.kraj_wysylki_id and kw.jezyk_id=z.jezyk_id and z.id=".$_SESSION['id_zam'];
                    	    $resk = mysqli_query($DB, $query);
                    	    $wierszk = mysqli_fetch_array($resk);
                    	    $koszt_wysylki = $wierszk['koszt'];
                    	    $koszt_wysylki_str = dodaj_walute($wierszk['koszt'], $waluta, $pozycja_symbolu);
            		    
                    	    $query = "select r.wartosc_kwotowa, r.wartosc_procentowa, z.kod_rabatowy_id from zamowienie z, kod_rabatowy kr, rabat r where z.kod_rabatowy_id=kr.id and kr.rabat_id=r.id and z.id=".$_SESSION['id_zam'];
                    	    $resr = mysqli_query($DB, $query);
                    	    
							
							
                    	    if($wierszr = mysqli_fetch_array($resr)){    
								if($_SESSION['kod_hurt'] > 0 && $_SESSION['kod_hurt_ilosc'] <= $ilosc){
									if($_SESSION['kod_hurt_typ'] == 1){
										if($wierszr['wartosc_kwotowa'] != ''){
											$rabat = $wierszr['wartosc_kwotowa'];
										}else{
											$rabat = floor(($wierszr['wartosc_procentowa']/100)*$suma*100)/100;
										}
									}else{
										if($wierszr['wartosc_kwotowa'] != ''){
											$rabat = $wierszr['wartosc_kwotowa'];
										}else{
											$rabat = floor(($wierszr['wartosc_procentowa']/100)*$koszt_wysylki*100)/100;
										}										
									}
								}else if($_SESSION['kod_hurt'] == 0){
									if($wierszr['wartosc_kwotowa'] != ''){
										$rabat = $wierszr['wartosc_kwotowa'];
									}else{
										$rabat = floor(($wierszr['wartosc_procentowa']/100)*$suma*100)/100;
									}								
								}else{
									$rabat = 0;
								}
                    	    }else{
								$rabat = 0;
                    	    }
							//var_dump($rabat);

                    	    $rabat += $rabat_il1 + $rabat_il2;
							$kwota_laczna = $suma + $koszt_wysylki +$suma_powloka- $rabat;
                    	    $kwota_laczna_str = dodaj_walute($kwota_laczna, $waluta, $pozycja_symbolu);
							
//var_dump($kwota_laczna_str);
							
                    	    
							if($rabat == 0){
								$rabat_str = '';
                    	    }else{
								$rabat_str = dodaj_walute($rabat, $waluta, $pozycja_symbolu);
                    	    }
            		    
                        ?>
                                 <tr class="koszyk-tabela-border">
                                   <td></td>
                                   <td class="koszyk-tabela-l"> 
                                     <div class="m-ukryj">
                                      <span><?=$txt->{'koszyk'}->{'kosztwysylki'}?></span>
				<?php
					if($rabat != 0){
				?>
					<br>
                                      <span><?=$txt->{'podsumowanie'}->{'rabat'}?></span>
				<?php
					}
				?>
                                     </div>
                                   </td>
                                   

                                   
                                   <td class="koszyk-tabela-o">
                                     <div class="m-pokarz k-t-m1">
                                      <span><?=$txt->{'koszyk'}->{'kosztwysylki'}?></span><br>
                                      <span><?=$txt->{'podsumowanie'}->{'rabat'}?></span>
                                     </div>                                   
                                   </td>
                                   <td colspan="2"></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena">
                                     <?=$koszt_wysylki_str?>
				<?php
					if($rabat != 0){
				?>					
					<br>
                                     -<?=$rabat_str?>
				<?php
					}
				?>
                                   </td>
                                   <td>
                                     
                                   </td>                                   
                                 </tr>                     


                                 <tr class="koszyk-tabela-border">                                   
                                   <td class="koszyk-tabela-l3" colspan="2"> 
                                     <div class="m-ukryj"><?=$txt->{'koszyk'}->{'lacznakwota'}?></div>                                  
                                   </td>
                                   <td class="koszyk-tabela-f1" colspan="2">
                                     <div class="m-pokarz k-t-m1 k-t-m2"><?=$txt->{'koszyk'}->{'lacznakwota'}?></div>                                      
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c koszyk-tabela-b koszyk-tabela-cena2 razem" data-rabat="<?=$rabat?>" data-koszt_wysylki="<?=$koszt_wysylki?>" data-kwota_laczna="<?=$kwota_laczna?>"><?=$kwota_laczna_str?></td>
                                   <td>
                                     
                                   </td>                                    
                                 </tr>
                                 
<?php
    // dane zamawiajacego
?>
                                 <tr class="koszyk-tabela-border">
                                   <td></td>
                                   <td class="koszyk-tabela-l"> 
                                     <div class="m-ukryj">
                                     <span><?=$txt->{'podsumowanie'}->{'danezamawiajacego'}?></span></br>
                                     </div>
                                   </td>
                        <?php
                                   
                            echo '<td class="koszyk-tabela-o" colspan="5">
                                     <div class="m-pokarz k-t-m1">'.$txt->{'podsumowanie'}->{'danezamawiajacego'}.'</div>';

                    	    $resz1 = mysqli_query($DB, "select z.imie_zam, z.nazwisko_zam, z.firma_zam, z.email_zam, z.adres1_zam, z.adres2_zam, z.kod_pocztowy_zam, z.miasto_zam, z.wojewodztwo_zam_id as woj, k.nazwa as kraj, z.telefon_zam from zamowienie z, dict_kraj k  where z.id=".$_SESSION['id_zam'].' and k.id=z.kraj_zam_id');
                    	    $wierszz1 = mysqli_fetch_array($resz1);
                    	    
                    	    if($wierszz1['woj']!= 0){
                    		$resz1woj = mysqli_query($DB, "select w.nazwa as woj from dict_wojewodztwo w where w.id=".$wierszz1['woj']);
                    		$wierszz1woj = mysqli_fetch_array($resz1woj);
                    		$wierszz1['woj'] = $wierszz1woj['woj'];
                    	    }else{
                    		$wierszz1['woj'] = '';
                    	    }
                    	    
			    echo $wierszz1['imie_zam'].' '.$wierszz1['nazwisko_zam'].'<br/>';
			    
			    if($wierszz1['firma_zam'] != ''){
                    		echo $txt->{'podsumowanie'}->{'firma'}.''.$wierszz1['firma_zam'].'<br/>';
                    	    }
                            echo $txt->{'podsumowanie'}->{'email'}.''.$wierszz1['email_zam'].'<br/>
                                 '.$wierszz1['adres1_zam'].'<br/>';
                            if($wierszz1['adres2_zam'] != ''){
                        	echo $wierszz1['adres2_zam'].'<br/>';
                            }
                            echo $wierszz1['kod_pocztowy_zam'].' '.$wierszz1['miasto_zam'].'<br/>';
                            if($wierszz1['woj'] != ''){
                        	echo $txt->{'podsumowanie'}->{'wojewodztwo'}.''.$wierszz1['woj'].'<br/>';
                            }
                            echo $wierszz1['kraj'].'<br/>
                                 '.$txt->{'podsumowanie'}->{'tel'}.''.$wierszz1['telefon_zam'];
                            echo '</td>';
                            ?>
                                   <td class="koszyk-tabela-c koszyk-tabela-o2">                                    
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c  koszyk-tabela-cena">                                   
                                   </td>
                                   <td>
                                     
                                   </td>
                                 </tr>


                                     <?php

    // ew. adres wysylki

                           $query = "SELECT z.*, dw.nazwa as nazwa_woj, k.nazwa as nazwa_kraj FROM zamowienie z , dict_wojewodztwo dw, dict_kraj k WHERE z.wojewodztwo_odb_id=dw.id AND  k.id=z.kraj_odb_id AND z.id=".$_SESSION['id_zam'];

                    			$resz = mysqli_query($DB, $query);
                    			$wierszz = mysqli_fetch_array($resz);
                                  var_dump($wierszz['nazwa']);
                                        if($wierszz['wysylka'] == 'odb'){
				    ?>

                                 <tr class="koszyk-tabela-border">
                                   <td></td>
                                   <td class="koszyk-tabela-l"> 
                                     <div class="m-ukryj">
                                     <span><?=$txt->{'podsumowanie'}->{'adreswysylki'}?></span></br>
                                     </div>
                                   </td>
                        <?php
                                   var_dump($wierszz['imie_odb']);
                            echo '<td class="koszyk-tabela-o" colspan="5">
                                     <div class="m-pokarz k-t-m1">'.$txt->{'podsumowanie'}->{'danezamawiajacego'}.'</div>';


                    	    //$resz2 = mysqli_query($DB, "select z.imie_odb, z.nazwisko_odb, z.firma_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, z.wojewodztwo_odb_id as woj, k.nazwa as kraj, z.telefon_odb from zamowienie z, dict_kraj k  where z.id=".$_SESSION['id_zam']);
                    	    //$wierszz2 = mysqli_fetch_array($resz2);

                    	    /*if($wierszz2['woj']!= 0){
                    		$resz2woj = mysqli_query($DB, "select w.nazwa as woj from dict_wojewodztwo w where w.id=".$wierszz2['woj']);
                    		$wierszz2woj = mysqli_fetch_array($resz2woj);
                    		$wierszz2['woj'] = $wierszz2woj['woj'];
                    	    }else{
                    		$wierszz2['woj'] = '';
                    	    }*/

			    echo $wierszz['imie_odb'].' '.$wierszz['nazwisko_odb'].'<br/>';
			    
			    if($wierszz['firma_odb'] != ''){
                    		echo $txt->{'podsumowanie'}->{'firma'}.''.$wierszz['firma_odb'].'<br/>';
                    	    }
                            echo $txt->{'podsumowanie'}->{'email'}.''.$wierszz['email_odb'].'<br/>
                                 '.$wierszz['adres1_odb'].'<br/>';
                            if($wierszz['adres2_odb'] != ''){
                        	echo $wierszz['adres2_odb'].'<br/>';
                            }
                            echo $wierszz['kod_pocztowy_odb'].''.$wierszz['miasto_odb'].'<br/>';
                            if($wierszz['nazwa_woj'] != ''){
                        	echo $txt->{'podsumowanie'}->{'wojewodztwo'}.''.$wierszz['nazwa_woj'].'<br/>';
                            }
                    	    echo $wierszz['nazwa_kraj'].'<br/>
                                 '.$txt->{'podsumowanie'}->{'tel'}.''.$wierszz['telefon_odb'];

                            echo '</td>';
                            ?>
                                   <td class="koszyk-tabela-c koszyk-tabela-o2">                                    
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c  koszyk-tabela-cena">                                   
                                   </td>
                                   <td>
                                     
                                   </td>
                                 </tr> 

				    <?php
                                        }

    // sposob platnosci
                                     ?>


                                 <tr class="koszyk-tabela-border">
                                   <td></td>
                                   <td class="koszyk-tabela-l"> 
                                     <div class="m-ukryj">
                                     <span><?=$txt->{'podsumowanie'}->{'sposobplatnosci'}?></span></br>
                                     </div>
                                   </td>
                         <td class="koszyk-tabela-o" colspan="5"> 
                         <div class="m-pokarz k-t-m1">'.$txt->{'podsumowanie'}->{'sposobplatnosci'}.'</div>
                         
                         
<!--    KARTA PRZENIESIONA Z POPRZEDNIEGO KROKU                     -->
                        <div class="">
                          <div class="koszyk-tabela" style="background: none; padding-right: 0;">

                               <form id="form_wysylka" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>" data-blednedanekarty="<?=$txt->{'dane'}->{'blednedanekarty'}?>">

                               <div class="koszyk-tabela-poz-cal-platnosci">
                                 <div class="koszyk-tabela-poz-cal-platnosci-poz">
                                    <a href="" id="aplatnosc">
                                    <div class="label3 min_wys_opcja_wysylka">
                                    <input <?=$checked1?> type="radio" name="platnosc" id="platnosc" class="typ2" checked>
                                    <label class="min_wys_opcja_wysylka" for="platnosc"><?=$txt->{'wysylka'}->{'kartakredytowa'}?></label>
                                    </br>
                                    </div>
                                    </a>
                                    
                                    <span class="kartakredytowa">
                                    
                                    <span id="blednedanekarty"></span>
                                    
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-cal min_wys_wysylka_form1" style="margin-top:10px;">
                                        <div class="koszyk-formularz-f-8 min_wys_wysylka_divinput1 float-label-div">
                                    	    <?php
                                    		echo '<input class="input_wysylka min_wys_wysylka_input1 input-float" id="wk" value="" type="text" autocomplete="cc-name" name="ccname" required>
                                            <label class="min_wys_wysylka_label1 top30" for="wk">'.$txt->{'dane'}->{'imieinazwiskowlascicielakarty'}.' <span>*</span></label>';
                                    	    ?>
                                        </div>                                     
                                    </div>  
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz2-l min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                        <div class="koszyk-formularz-f-10 min_wys_wysylka_divinput1 float-label-div">
                                           <input class="input_wysylka min_wys_wysylka_input1 input-float" id="nrk" value="" type="text" autocomplete="cc-number" name="cardnumber" data-value="" required>                                    
                                            <label class="min_wys_wysylka_label1 top30" for="nrk"><?=$txt->{'dane'}->{'numerkarty'}?> <span>*</span></label>
                                             </div>                                     
                                      </div>
                                    </div>  
                                    
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz2-p min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p float-label-div">                                        
                                        <div class="koszyk-formularz-f-11 min_wys_wysylka_divinput1 float-label-div">
                                           <input class="input_wysylka min_wys_wysylka_input1 input-float" id="kwk" value="" type="text" autocomplete="cc-csc" name="cvc" required>
                                            <label class="min_wys_wysylka_label1 top30" for="kwk"><?=$txt->{'dane'}->{'kodweryfikacyjnykarty'}?> <span>*</span></label>
                                        </div>
                                          
                                           <div class="formularze-pomoc2">
                                               <div class="formularze-pomoc-text cvv">
                                                    <div class="formularze-pomoc-text-cala"><?=$txt->{'dane'}->{'cvvpomoc'}?>
                                                   </div>
                                               </div>                                    
                                           </div>
                                                                                
                                                                                                               
                                      </div>                                      
                                    </div>
                                    <div class="max">       
                                    <img class="width30" src="<?=$_SERV_CDN?>/grafika/visa-s.png?3" title="<?=$txt->{'wysylka'}->{'altvisa'}?>" alt="<?=$txt->{'wysylka'}->{'altvisa'}?>" id="logovisa">
                                    <img class="width30" src="<?=$_SERV_CDN?>/grafika/mc-s.png?3" title="<?=$txt->{'wysylka'}->{'altmc'}?>" alt="<?=$txt->{'wysylka'}->{'altmc'}?>" id="logomc">
                                    
                                   <?php
                                   
                                   if($lang=='us'){
                                    echo '<img class="width30" src="'.$_SERV_CDN.'/grafika/ae-s.png?3" title="'.$txt->{'wysylka'}->{'altae'}.'" alt="'.$txt->{'wysylka'}->{'altae'}.'"id="logoae">';
                                      }
                                    ?>
									<img class="width30" src="<?=$_SERV_CDN?>/grafika/dc-s.png?3" title="<?=$txt->{'wysylka'}->{'altdc'}?>" alt="<?=$txt->{'wysylka'}->{'altdc'}?>"id="logodc">
									<img class="width30" src="<?=$_SERV_CDN?>/grafika/jcb-s.png?3" title="<?=$txt->{'wysylka'}->{'altjcb'}?>" alt="<?=$txt->{'wysylka'}->{'altjcb'}?>"id="logojcb">
									<img class="width30" src="<?=$_SERV_CDN?>/grafika/dis-s.png?3" title="<?=$txt->{'wysylka'}->{'altdis'}?>" alt="<?=$txt->{'wysylka'}->{'altdis'}?>" id="logodis">
									<img class="width30" src="<?=$_SERV_CDN?>/grafika/mae-s.png?3" title="<?=$txt->{'wysylka'}->{'altmae'}?>" alt="<?=$txt->{'wysylka'}->{'altmae'}?>"id="logomae">
                                       
                                      </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-cal min_wys_wysylka_form2 margin-top-zero "><?=$txt->{'dane'}->{'datawaznosci'}?>
                                     
                                    </div>
                                                                        
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-l min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                         <label class="min_wys_wysylka_label1 top30" for="mies"><?=$txt->{'dane'}->{'miesiac'}?></label>
                                         <div style="margin:0" class="koszyk-formularz-f-9 min_wys_wysylka_divinput1">
                                            <select id="mies" class="min_wys_wysylka_input1" autocomplete="cc-exp-month" value="hjj" name="ccmonth" placeholder="gh">
                                               <option disabled selected data-id="0"><?=$txt->{'dane'}->{'wybierz'}?></option>
                                               <?php
                                            	    for($i = 1; $i <= 12; $i++){
                                            		echo '<option data-id="'.$i.'">'.str_pad($i,2,'0',STR_PAD_LEFT).'</option>';
                                            	    }
                                               ?>
                                             </select>
                                         </div>                                      
                                      </div>
                                    </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-p min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p">
                                         <label class="min_wys_wysylka_label1 top30" for="rok"><?=$txt->{'dane'}->{'rok'}?></label>
                                         <div style="margin:0" class="koszyk-formularz-f-9 min_wys_wysylka_divinput1">
                                            <select id="rok" class="min_wys_wysylka_input1" autocomplete="cc-exp-year" name="ccyear">
                                               <option disabled selected data-id="0"><?=$txt->{'dane'}->{'wybierz'}?></option>
                                               <?php
                                            	    $rok_biez = date("Y");
                                            	    for($i = $rok_biez; $i <= $rok_biez+10; $i++){
                                            		echo '<option data-id="'.$i.'">'.$i.'</option>';
                                            	    }
                                               ?>
                                             </select>
                                         </div>                                      
                                      </div>  
                                    </div> 
                                      <div class="karta-error ukryj"></div>                                    
                                    <div class="kasuj"></div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-l">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                                                                                                      
                                      </div>
                                    </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-p">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p">
                                                                                        
                                      </div>                                      
                                    </div> 
                                    <div class="kasuj"></div>                                                                                                           
                                
                                    </span>
                                
                                 </div>
                                 <div class="koszyk-tabela-poz-cal-platnosci-poz-n">                                
                                    <a href="" id="aplatnosc2">
                                    <div class="label3 min_wys_opcja_wysylka">
                                    <input <?=$checked2?> type="radio" name="platnosc" id="platnosc2" class="typ2" >
                                    <label class="min_wys_opcja_wysylka" for="platnosc2"><?=$txt->{'wysylka'}->{'paypal'}?></label>
                                    <?php
                                	if($checked2 != ''){
                                	    echo '</br><img src="'.$_SERV_CDN.'/grafika/loga-p-2.jpg" title="'.$txt->{'wysylka'}->{'altpaypal'}.'" alt="'.$txt->{'wysylka'}->{'altpaypal'}.'" id="logopaypal">';
                                	}else{
                                	    echo '</br><img src="'.$_SERV_CDN.'/grafika/loga-p-2-s.jpg" title="'.$txt->{'wysylka'}->{'altpaypal'}.'" alt="'.$txt->{'wysylka'}->{'altpaypal'}.'" id="logopaypal">';
                                	}
                                    ?>
                                    
                                    </div>                                       
                                    </a>
                                 </div>

                               </div> 
                               
                 
                               <div class="kasuj"></div>

                               </form>
                          </div>
                       </div> 
                         
                         
              </td>     
                                   

                                   <td class="koszyk-tabela-c koszyk-tabela-o2">                                    
                                   </td>
                                   <td></td>
                                   <td class="koszyk-tabela-c  koszyk-tabela-cena">                                   
                                   </td>
                                   <td>
                                     
                                   </td>
                                 </tr> 

                                 <tr class="koszyk-tabela-noborder">                                   
                                   <td class="koszyk-tabela-f1" colspan="6">
                                        <div class="daneosobowe_czek">
                                    	<input type="checkbox" checked="checked"/> 
                                        </div>
                                        <div class="daneosobowe_tresc">
                                    	    <span><?=$txt->{'podsumowanie'}->{'daneosobowe'}?>
                                    	    </span>
                                        </div>
                                                                    
                                   </td>
                                   
                                   <td>
                                     
                                   </td>
                                 </tr>                                                                             
                                 
                                 <tr class="koszyk-tabela-noborder">                                   
                            	    
                                    <td class="koszyk-tabela-f1" colspan="6">
                                        <div class="regulamin_error"><?=$txt->{'podsumowanie'}->{'akceptacjaregulaminu'}?></div>
                                        <div class="regulamin_czek">
                                    	<input type="checkbox"/> 
                                        </div>
                                        <div class="regulamin_tresc">
                                    	    <span><?=$txt->{'podsumowanie'}->{'regulamin'}?>
                                    	    </span>
                                        </div>
                                                                    
                                    </td>
                                   
                                    <td>
                                     
                                    </td>
                                 </tr>                                                                             



                                 <tr class="koszyk-tabela-noborder">                                   
                                   <td class="koszyk-tabela-f1" colspan="6">
                                        
                                      <a href="koszyk.html" class="powrot min_wys_szer_wysylka_powrot_przycisk"><?=$txt->{'wysylka'}->{'powrotdokoszyka'}?></a> 
                                      <a href="status.html" data-id_zam="<?=$_SESSION['id_zam']?>" class="potwierdz potwierdz_podsumowanie min_wys_szer_podsumowanie_potwierdz_przycisk"><?=$txt->{'podsumowanie'}->{'potwierdzzakup'}?></a>
                                          <? //var_dump($_SESSION['id_zam']); ?>                        
                                   </td>
                                   <td>
                                     
                                   </td>
                                 </tr>                                                                             
                              </tbody>
                           </table>
                          </div>
                       </div>
                        
                <?php
            	    $podsumowanieklasa = 'aktywnylink';
            	    include('./include/prawa.inc.php');
                ?>
                </div>
<!-- tu byla prawa kolumna -->  

        
       




                <div class="kasuj"></div>
                
          

            </div>
          </div> 
       </div>
      
    <?php
	     include('./include/paypal.inc.php');
	     include('./include/stopka.inc.php');
    ?>
    </div>
	<?php
  
	    include('./include/analytics.inc.php');
	?>   

   </body>
</html>
