<?php
error_reporting(0);
include('../include/login.inc.php');
include('../include/lib.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$akcja = $_POST['akcja'];
$strona = $_POST['strona'];

if($akcja == "1"){
    echo '<div class="tytulzam">Zamówienia opłacone</div>';
	$offset = ($strona-1)*$_PAGE_SIZE;
    $query1 = "select z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie, z.kraj_wysylki_id from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id and etap_id=5 order by data desc";
    $res1 = mysqli_query($DB, $query1);

	$ile = mysqli_num_rows($res1);

	$ile_stron = floor($ile/$_PAGE_SIZE);
	if($ile % $_PAGE_SIZE > 0){
		$ile_stron++;
	}
	
	echo '<div id="strony" data-nr="1">';
	for($i=1;$i<=$ile_stron;$i++){
		if($i == $strona){
			$bold = '<span style="color:red">'.$i.'</span>';
		}else{
			$bold = $i;
		}
		echo '<span class="strona" data-nr="'.$i.'">'.$bold.'</span> ';
	}
	echo '</div>';

    $query1 = "select z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie, z.kraj_wysylki_id from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id and etap_id=5 order by data desc limit ".$_PAGE_SIZE." offset ".$offset;
	
    $res1 = mysqli_query($DB, $query1);
	
    while($wiersz = mysqli_fetch_array($res1)){
	
	if($wiersz['wojewodztwo_zam_id'] != 0){
	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, w.nazwa as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_zam_id and w.id=z.wojewodztwo_zam_id  and z.id=".$wiersz['id'];
	}else{
    	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, NULL as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam from zamowienie z, dict_kraj k where k.id=z.kraj_zam_id and z.id=".$wiersz['id'];
	}
	$res2 = mysqli_query($DB, $query2);
	$wiersz2 = mysqli_fetch_array($res2);
	
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Id zamówienia</th><th>'.$wiersz['id'].'</th></tr>';
	echo '<tr><th>Data złożenia</th><td>'.$wiersz['data'].'</td></tr>';
	echo '<tr><th>Typ płatności</th><td>'.$wiersz['typ_platnosci'].'</td></tr>';
	echo '<tr><th>Etap</th><td>'.$wiersz['etap'].'</td></tr>';
	echo '<tr><th>Kraj wysyłki</th><td>'.$wiersz['kraj_wysylki'].'</td></tr>';
	echo '<tr><th>Koszt wysyłki</th><td>'.$wiersz['koszt_wysylki_kwota'].'</td></tr>';
	echo '<tr><th>Rabat</th><td>'.$wiersz['rabat_kwota'].'</td></tr>';
	echo '<tr><th>Wartość</th><td>'.$wiersz['wartosc_kwota'].'</td></tr>';
	echo '<tr><th>Waluta</th><td>'.$wiersz['waluta'].'</td></tr>';
	echo '<tr><th>Dane osobowe</th><td>'.$wiersz['daneosobowe'].'</td></tr>';
	echo '<tr><th>Id transakcji</th><td>'.$wiersz['id_transakcji'].'</td></tr>';
	echo '<tr><th>Smartlook</th><td><a href="'.$wiersz['nagranie'].'" target=_blank>'.$wiersz['nagranie'].'</a></td></tr>';	

	
	echo '<tr><th>Nazwisko zamawiającego</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	echo '<tr><th>Email zamawiającego</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	echo '<tr><th>Adres zamawiającego</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
	echo '<tr><th>Kod pocztowy zamawiającego</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';
	echo '<tr><th>Miasto zamawiającego</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	echo '<tr><th>Województwo zamawiającego</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	echo '<tr><th>Kraj zamawiającego</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	echo '<tr><th>Telefon zamawiającego</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	echo '<tr><th>IP zamawiającego</th><td>'.$wiersz2['ip_zam'].'</td></tr>';
	echo '<tr><th>Firma zamawiającego</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	if($wiersz['odbiorca_id'] != ''){
	    if($wiersz['wojewodztwo_odb_id'] != 0){
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, w.nazwa as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_odb_id and w.id=z.wojewodztwo_odb_id and z.id=".$wiersz['id'];
	    }else{
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, NULL as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k where k.id=z.kraj_odb_id and z.id=".$wiersz['id'];
	    }
	    $res3 = mysqli_query($DB, $query3);
	    $wiersz3 = mysqli_fetch_array($res3);

	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz3['nazwisko_odb'].' '.$wiersz3['imie_odb'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz3['email_odb'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz3['adres1_odb'].'</td></tr>';
		echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz3['kod_pocztowy_odb'].'</td></tr>';
	    echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz3['miasto_odb'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz3['wojewodztwo_odb'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz3['kraj_odb'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz3['telefon_odb'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz3['firma_odb'].'</td></tr>';
	}else{
	
	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
		echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';		
	    echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	}
	
	$querynp = "select spedytor1_link, spedytor2_link from dict_kraj where id=".$wiersz['kraj_wysylki_id'];
	$resnp = mysqli_query($DB, $querynp);
	$wiersznp = mysqli_fetch_array($resnp);

	$jest_spedytor = $wiersznp['spedytor1_link'] != '' || $wiersznp['spedytor2_link']!= '';
	if($jest_spedytor){
		echo '<tr><th>Numer przesylki</th><td><input type="text" class="nrprzesylki" data-id="'.$wiersz['id'].'"></td></tr>';
	}else{
		echo '<tr><th>Numer przesylki</th><td>Brak danych spedytora dla wybranego kraju wysyłki.</td></tr>';
	}
	echo '<tr><th>Faktura</th><td><a href="../faktura.html?id='.$wiersz['id'].'">Zobacz fakturę</a></td></tr>';	
	echo '</table>';

	echo '<div class="tytulzamprod">Produkty na zamówieniu '.$wiersz['id'].':</div>';

	
	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$wiersz['id'];
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$wiersz['id'];
	
	$resp = mysqli_query($DB, $query1." UNION ".$query2);
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Płeć</th>';
	echo '<th>Rodzaj koszulki</th>';
	echo '<th>Rozmiar</th>';
	echo '<th>Kolor</th>';
	echo '<th>Ilość</th>';
	echo '<th>Cena</th></tr>';	
	while($wierszp = mysqli_fetch_array($resp)){
  
		if($wierszp['typ_towaru_id'] > 1){
			$resp_dod = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wierszp['typ_towaru_id']);
			$wierszp_dod = mysqli_fetch_array($resp_dod);
			$wierszp['rodzaj'] = $wierszp_dod['nazwa'];
		}
	
		echo '<tr><td>'.$wierszp['plec'].'</td><td>'.$wierszp['rodzaj'].'</td><td>'.$wierszp['skrot'].'/'.$wierszp['rozmiar'].'</td><td>'.$wierszp['kolor'].'</td><td>'.$wierszp['ilosc'].'</td><td>'.$wierszp['cena'].'</td></tr>';
	}
	echo '</table>';
	
	if($jest_spedytor){
		echo '<div class="zapiszdaneprzesylkidiv"><input type="button" class="zapiszdaneprzesylki" value="Zapisz dane przesyłki" data-id="'.$wiersz['id'].	'"></div>';
	}
	
    }
    
    
}elseif($akcja == "2"){

    echo '<div class="tytulzam">Zamówienia nowe</div>';
	
	$offset = ($strona-1)*$_PAGE_SIZE;
    
    $query1 = "select z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id and etap_id<5 order by data desc";
    $res1 = mysqli_query($DB, $query1);

	$ile = mysqli_num_rows($res1);

	$ile_stron = floor($ile/$_PAGE_SIZE);
	if($ile % $_PAGE_SIZE > 0){
		$ile_stron++;
	}
	
	echo '<div id="strony" data-nr="1">';
	for($i=1;$i<=$ile_stron;$i++){
		if($i == $strona){
			$bold = '<span style="color:red">'.$i.'</span>';
		}else{
			$bold = $i;
		}
		echo '<span class="strona" data-nr="'.$i.'">'.$bold.'</span> ';
	}
	echo '</div>';	
	
	$query1 = "select z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id and etap_id<5 order by data desc limit ".$_PAGE_SIZE." offset ".$offset;
    $res1 = mysqli_query($DB, $query1);	
	
    while($wiersz = mysqli_fetch_array($res1)){
	
	if($wiersz['wojewodztwo_zam_id'] != 0){
	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, w.nazwa as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_zam_id and w.id=z.wojewodztwo_zam_id  and z.id=".$wiersz['id'];
	}else{
	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, NULL as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam from zamowienie z, dict_kraj k where k.id=z.kraj_zam_id and z.id=".$wiersz['id'];
	}
	$res2 = mysqli_query($DB, $query2);
	$wiersz2 = mysqli_fetch_array($res2);
	
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Id zamówienia</th><th>'.$wiersz['id'].'</th></tr>';
	echo '<tr><th>Data złożenia</th><td>'.$wiersz['data'].'</td></tr>';
	echo '<tr><th>Typ płatności</th><td>'.$wiersz['typ_platnosci'].'</td></tr>';
	echo '<tr><th>Etap</th><td>'.$wiersz['etap'].'</td></tr>';
	echo '<tr><th>Kraj wysyłki</th><td>'.$wiersz['kraj_wysylki'].'</td></tr>';
	echo '<tr><th>Koszt wysyłki</th><td>'.$wiersz['koszt_wysylki_kwota'].'</td></tr>';
	echo '<tr><th>Rabat</th><td>'.$wiersz['rabat_kwota'].'</td></tr>';
	echo '<tr><th>Wartość</th><td>'.$wiersz['wartosc_kwota'].'</td></tr>';
	echo '<tr><th>Waluta</th><td>'.$wiersz['waluta'].'</td></tr>';
	echo '<tr><th>Dane osobowe</th><td>'.$wiersz['daneosobowe'].'</td></tr>';
	echo '<tr><th>Id transakcji</th><td>'.$wiersz['id_transakcji'].'</td></tr>';
	echo '<tr><th>Smartlook</th><td><a href="'.$wiersz['nagranie'].'" target=_blank>'.$wiersz['nagranie'].'</a></td></tr>';	
	
	echo '<tr><th>Nazwisko zamawiającego</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	echo '<tr><th>Email zamawiającego</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	echo '<tr><th>Adres zamawiającego</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
	echo '<tr><th>Kod pocztowy zamawiającego</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';	
	echo '<tr><th>Miasto zamawiającego</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	echo '<tr><th>Województwo zamawiającego</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	echo '<tr><th>Kraj zamawiającego</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	echo '<tr><th>Telefon zamawiającego</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	echo '<tr><th>IP zamawiającego</th><td>'.$wiersz2['ip_zam'].'</td></tr>';
	echo '<tr><th>Firma zamawiającego</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	if($wiersz['odbiorca_id'] != ''){
	    if($wiersz['wojewodztwo_odb_id'] != 0){
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, w.nazwa as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_odb_id and w.id=z.wojewodztwo_odb_id and z.id=".$wiersz['id'];
	    }else{
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, NULL as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k where k.id=z.kraj_odb_id and z.id=".$wiersz['id'];
	    }
	    $res3 = mysqli_query($DB, $query3);
	    $wiersz3 = mysqli_fetch_array($res3);

	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz3['nazwisko_odb'].' '.$wiersz3['imie_odb'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz3['email_odb'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz3['adres1_odb'].'</td></tr>';
		echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz3['kod_pocztowy_odb'].'</td></tr>';		
	    echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz3['miasto_odb'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz3['wojewodztwo_odb'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz3['kraj_odb'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz3['telefon_odb'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz3['firma_odb'].'</td></tr>';
	}else{
	
	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
	    echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';
		echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	}
	
	echo '</table>';

	echo '<div class="tytulzamprod">Produkty na zamówieniu '.$wiersz['id'].':</div>';


	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$wiersz['id'];
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$wiersz['id'];
	
	$resp = mysqli_query($DB, $query1." UNION ".$query2);
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Płeć</th>';
	echo '<th>Rodzaj koszulki</th>';
	echo '<th>Rozmiar</th>';
	echo '<th>Kolor</th>';
	echo '<th>Ilość</th>';
	echo '<th>Cena</th></tr>';
	while($wierszp = mysqli_fetch_array($resp)){	
	
		if($wierszp['typ_towaru_id'] > 1){
			$resp_dod = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wierszp['typ_towaru_id']);
			$wierszp_dod = mysqli_fetch_array($resp_dod);
			$wierszp['rodzaj'] = $wierszp_dod['nazwa'];
		}
	
		echo '<tr><td>'.$wierszp['plec'].'</td><td>'.$wierszp['rodzaj'].'</td><td>'.$wierszp['skrot'].'/'.$wierszp['rozmiar'].'</td><td>'.$wierszp['kolor'].'</td><td>'.$wierszp['ilosc'].'</td><td>'.$wierszp['cena'].'</td></tr>';
	}
	echo '</table>';
	
	
    }

}elseif($akcja == "3"){

    echo '<div class="tytulzam">Zamówienia wszystkie</div>';

	$offset = ($strona-1)*$_PAGE_SIZE;
	  
    $query1 = "select z.etap_id, z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie, z.nr_przesylki, z.nazwa_spedytora, z.link_przesylka from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id order by data desc";
    $res1 = mysqli_query($DB, $query1);

	$ile = mysqli_num_rows($res1);

	$ile_stron = floor($ile/$_PAGE_SIZE);
	if($ile % $_PAGE_SIZE > 0){
		$ile_stron++;
	}
	
	echo '<div id="strony" data-nr="1">';
	for($i=1;$i<=$ile_stron;$i++){
		if($i == $strona){
			$bold = '<span style="color:red">'.$i.'</span>';
		}else{
			$bold = $i;
		}
		echo '<span class="strona" data-nr="'.$i.'">'.$bold.'</span> ';
	}
	echo '</div>';
	
    $query1 = "select z.etap_id, z.id, j.waluta, z.data, z.odbiorca_id, z.wojewodztwo_zam_id, z.wojewodztwo_odb_id, k.nazwa as kraj_wysylki, tp.nazwa as typ_platnosci, e.nazwa as etap, z.rabat_kwota, z.koszt_wysylki_kwota, z.wartosc_kwota, z.daneosobowe, z.id_transakcji, z.nagranie, z.nr_przesylki, z.nazwa_spedytora, z.link_przesylka from dict_jezyk j, dict_etap e, zamowienie z, dict_typ_platnosci tp, dict_kraj k where j.id=z.jezyk_id and e.id=z.etap_id and k.id=z.kraj_wysylki_id and z.typ_platnosci_id=tp.id order by data desc limit ".$_PAGE_SIZE." offset ".$offset;
	$res1 = mysqli_query($DB, $query1);
	
    while($wiersz = mysqli_fetch_array($res1)){
	
	if($wiersz['wojewodztwo_zam_id'] != 0){
	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, w.nazwa as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam, z.nr_przesylki  from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_zam_id and w.id=z.wojewodztwo_zam_id  and z.id=".$wiersz['id'];
	}else{
	    $query2 = "select z.nazwisko_zam, z.imie_zam, z.email_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, NULL  as wojewodztwo_zam, k.nazwa as kraj_zam, z.telefon_zam, z.ip_zam, z.firma_zam, z.nr_przesylki  from zamowienie z, dict_kraj k where k.id=z.kraj_zam_id and z.id=".$wiersz['id'];
	}
	$res2 = mysqli_query($DB, $query2);

	$wiersz2 = mysqli_fetch_array($res2);
	
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Id zamówienia</th><th>'.$wiersz['id'].'</th></tr>';
	echo '<tr><th>Data złożenia</th><td>'.$wiersz['data'].'</td></tr>';
	echo '<tr><th>Typ płatności</th><td>'.$wiersz['typ_platnosci'].'</td></tr>';
	echo '<tr><th>Etap</th><td>'.$wiersz['etap'].'</td></tr>';
	echo '<tr><th>Kraj wysyłki</th><td>'.$wiersz['kraj_wysylki'].'</td></tr>';
	echo '<tr><th>Koszt wysyłki</th><td>'.$wiersz['koszt_wysylki_kwota'].'</td></tr>';
	echo '<tr><th>Rabat</th><td>'.$wiersz['rabat_kwota'].'</td></tr>';
	echo '<tr><th>Wartość</th><td>'.$wiersz['wartosc_kwota'].'</td></tr>';
	echo '<tr><th>Waluta</th><td>'.$wiersz['waluta'].'</td></tr>';
	echo '<tr><th>Dane osobowe</th><td>'.$wiersz['daneosobowe'].'</td></tr>';
	echo '<tr><th>Id transakcji</th><td>'.$wiersz['id_transakcji'].'</td></tr>';
	echo '<tr><th>Smartlook</th><td><a href="'.$wiersz['nagranie'].'" target=_blank>'.$wiersz['nagranie'].'</a></td></tr>';
	echo '<tr><th>Nazwisko zamawiającego</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	echo '<tr><th>Email zamawiającego</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	echo '<tr><th>Adres zamawiającego</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
	echo '<tr><th>Kod pocztowy zamawiającego</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';	
	echo '<tr><th>Miasto zamawiającego</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	echo '<tr><th>Województwo zamawiającego</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	echo '<tr><th>Kraj zamawiającego</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	echo '<tr><th>Telefon zamawiającego</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	echo '<tr><th>IP zamawiającego</th><td>'.$wiersz2['ip_zam'].'</td></tr>';
	echo '<tr><th>Firma zamawiającego</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	if($wiersz['odbiorca_id'] != ''){
	    if($wiersz['wojewodztwo_odb_id'] != 0){
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, w.nazwa as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k, dict_wojewodztwo w where k.id=z.kraj_odb_id and w.id=z.wojewodztwo_odb_id and z.id=".$wiersz['id'];
	    }else{
		$query3 = "select z.nazwisko_odb, z.imie_odb, z.email_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, NULL as wojewodztwo_odb, k.nazwa as kraj_odb, z.telefon_odb, z.firma_odb from zamowienie z, dict_kraj k where k.id=z.kraj_odb_id and z.id=".$wiersz['id'];
	    }
	    $res3 = mysqli_query($DB, $query3);
	    $wiersz3 = mysqli_fetch_array($res3);

	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz3['nazwisko_odb'].' '.$wiersz3['imie_odb'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz3['email_odb'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz3['adres1_odb'].'</td></tr>';
		echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz3['kod_pocztowy_odb'].'</td></tr>';	
	    echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz3['miasto_odb'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz3['wojewodztwo_odb'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz3['kraj_odb'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz3['telefon_odb'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz3['firma_odb'].'</td></tr>';
	}else{
	
	    echo '<tr><th>Nazwisko odbiorcy</th><td>'.$wiersz2['nazwisko_zam'].' '.$wiersz2['imie_zam'].'</td></tr>';
	    echo '<tr><th>Email odbiorcy</th><td>'.$wiersz2['email_zam'].'</td></tr>';
	    echo '<tr><th>Adres odbiorcy</th><td>'.$wiersz2['adres1_zam'].'</td></tr>';
		echo '<tr><th>Kod pocztowy odbiorcy</th><td>'.$wiersz2['kod_pocztowy_zam'].'</td></tr>';	
	    echo '<tr><th>Miasto odbiorcy</th><td>'.$wiersz2['miasto_zam'].'</td></tr>';
	    echo '<tr><th>Województwo odbiorcy</th><td>'.$wiersz2['wojewodztwo_zam'].'</td></tr>';
	    echo '<tr><th>Kraj odbiorcy</th><td>'.$wiersz2['kraj_zam'].'</td></tr>';
	    echo '<tr><th>Telefon odbiorcy</th><td>'.$wiersz2['telefon_zam'].'</td></tr>';
	    echo '<tr><th>Firma odbiorcy</th><td>'.$wiersz2['firma_zam'].'</td></tr>';
	
	}

	echo '<tr><th>Numer przesyłki</th><td>'.$wiersz['nr_przesylki'].'</td></tr>';
	echo '<tr><th>Nazwa spedytora</th><td>'.$wiersz['nazwa_spedytora'].'</td></tr>';
	echo '<tr><th>Link do strony z przesyłką</th><td><a href="'.$wiersz['link_przesylka'].'">'.$wiersz['link_przesylka'].'</a></td></tr>';
	if($wiersz['etap_id'] == 5 || $wiersz['etap_id'] == 7){
		echo '<tr><th>Faktura</th><td><a href="../faktura.html?id='.$wiersz['id'].'">Zobacz fakturę</a></td></tr>';	
	}else{
		echo '<tr><th>Faktura</th><td>Brak</td></tr>';	
	}
	echo '</table>';

	echo '<div class="tytulzamprod">Produkty na zamówieniu '.$wiersz['id'].':</div>';

	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$wiersz['id'];
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$wiersz['id'];
	
	$resp = mysqli_query($DB, $query1." UNION ".$query2);
	
	echo '<table class="tab_admin">';
	echo '<tr><th>Płeć</th>';
	echo '<th>Rodzaj koszulki</th>';
	echo '<th>Rozmiar</th>';
	echo '<th>Kolor</th>';
	echo '<th>Ilość</th>';
	echo '<th>Cena</th></tr>';
	while($wierszp = mysqli_fetch_array($resp)){	
		
		if($wierszp['typ_towaru_id'] > 1){
			$resp_dod = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wierszp['typ_towaru_id']);
			$wierszp_dod = mysqli_fetch_array($resp_dod);
			$wierszp['rodzaj'] = $wierszp_dod['nazwa'];
		}
		echo '<tr><td>'.$wierszp['plec'].'</td><td>'.$wierszp['rodzaj'].'</td><td>'.$wierszp['skrot'].'/'.$wierszp['rozmiar'].'</td><td>'.$wierszp['kolor'].'</td><td>'.$wierszp['ilosc'].'</td><td>'.$wierszp['cena'].'</td></tr>';
	}
	echo '</table>';
	
	
    }

}elseif($akcja == "zapisz"){
    $id_zam = $_POST['id_zam'];
    $nr_przesylki = $_POST['nrprzesylki'];
	$jest_spedytor = true;
	
	$spedytor1 = strtolower(substr($nr_przesylki, 0, 2)) == 'cp' && strtolower(substr($nr_przesylki, -2)) == 'pl';
	
	$querynp = "select k.spedytor1_nazwa, k.spedytor2_nazwa, k.spedytor1_link, k.spedytor2_link from dict_kraj k, zamowienie z where k.id=z.kraj_wysylki_id and z.id=".$id_zam;
	$resnp = mysqli_query($DB, $querynp);
	$wiersznp = mysqli_fetch_array($resnp);
	
	if($wiersznp['spedytor1_nazwa'] != '' && $wiersznp['spedytor1_link'] != '' && $spedytor1){
		$nazwa_spedytora = $wiersznp['spedytor1_nazwa'];
		$link_przesylka = $wiersznp['spedytor1_link'].$nr_przesylki;
	}else if ($wiersznp['spedytor2_nazwa'] != '' && $wiersznp['spedytor2_link'] != '' && !$spedytor1){
		$nazwa_spedytora = $wiersznp['spedytor2_nazwa'];
		$link_przesylka = $wiersznp['spedytor2_link'].$nr_przesylki;
	}else{
		$jest_spedytor = false;
	}

    if($nr_przesylki != '' && $jest_spedytor){

	$query = "update zamowienie set nr_przesylki='".$nr_przesylki."', nazwa_spedytora='".$nazwa_spedytora."', link_przesylka='".$link_przesylka."', etap_id=7 where id=".$id_zam;
	mysqli_query($DB, $query);
	
	// tutaj wstawiamy kod, który sprawdza czy eBay i wysyła ew. zapytanie API
	// oraz dodatkowo blokuje wysłanie maila

	// mail do klienta

	##Inicjalizacja klasy
	$mail = new PHPMailer;

	##Ustawienia danych połączenia SMTP
	$mail->isSMTP();
	$mail->Host = 'smtp.emaillabs.net.pl';
	$mail->SMTPAuth = true;
	$mail->Username = '1.webska.smtp';
	$mail->Password = 'e2DLTbPo';
	$mail->Port = 587;
	$mail->CharSet = 'UTF-8';

	$reslz = mysqli_query($DB, "select j.skrot from zamowienie z, dict_jezyk j where z.jezyk_id=j.id and z.id=".$id_zam);
	$wierszlz = mysqli_fetch_array($reslz);
	$langz = $wierszlz['skrot'];

	$tlumaczenie=file_get_contents($_LANG_PATH.'/locales/'.$langz.'/translation.json');
	$txt=json_decode($tlumaczenie);
	$sciezka = '../locales/'.$langz.'/szablony';

	$res = mysqli_query($DB, "select z.odbiorca_id, z.imie_zam, z.nazwisko_zam, z.adres1_zam, z.kod_pocztowy_zam, z.miasto_zam, z.email_zam, k.nazwa as kraj_zam, z.koszt_wysylki_kwota, z.rabat_kwota, z.wartosc_kwota, tp.nazwa as typ_platnosci from zamowienie z, dict_kraj k, dict_typ_platnosci tp where z.kraj_zam_id=k.id and tp.id=z.typ_platnosci_id and z.id=".$id_zam);
	$wiersz = mysqli_fetch_array($res);
	$email = $wiersz['email_zam'];
    
	$imie_zam = $wiersz['imie_zam'];
	$nazwisko_zam = $wiersz['nazwisko_zam'];
	$adres1_zam = $wiersz['adres1_zam'];
	$kod_pocztowy_zam = $wiersz['kod_pocztowy_zam'];
	$miasto_zam = $wiersz['miasto_zam'];
	$kraj_zam = $wiersz['kraj_zam'];

	$koszt_wysylki_str = dodaj_walute($wiersz['koszt_wysylki_kwota'], $waluta, $pozycja_symbolu);
	if($wiersz['rabat_kwota'] != 0){
	    $rabat_str = dodaj_walute($wiersz['rabat_kwota'], $waluta, $pozycja_symbolu);
	    $rabat_str = '<span style="font-weight:bold;">Rabat: '.$rabat_str.'</span><br/><br/>';
	}
	$razem_str = dodaj_walute($wiersz['wartosc_kwota'], $waluta, $pozycja_symbolu);
	$forma_platnosci = $txt->{'baza'}->{$wiersz['typ_platnosci']};

	$odbiorca_id = $wiersz['odbiorca_id'];

	if($odbiorca_id != ''){
	    $res_o = mysqli_query($DB, "select z.imie_odb, z.nazwisko_odb, z.adres1_odb, z.kod_pocztowy_odb, z.miasto_odb, k.nazwa as kraj_odb from zamowienie z, dict_kraj k where z.kraj_odb_id=k.id and z.id=".$id_zam);
	    $wiersz_o = mysqli_fetch_array($res_o);
	
	    $imie_odb = $wiersz_o['imie_odb'];
	    $nazwisko_odb = $wiersz_o['nazwisko_odb'];
	    $adres1_odb = $wiersz_o['adres1_odb'];
	    $kod_pocztowy_odb = $wiersz_o['kod_pocztowy_odb'];
	    $miasto_odb = $wiersz_o['miasto_odb'];
	    $kraj_odb = $wiersz_o['kraj_odb'];

	}else{
	    $imie_odb = $wiersz['imie_zam'];
	    $nazwisko_odb = $wiersz['nazwisko_zam'];
	    $adres1_odb = $wiersz['adres1_zam'];
	    $kod_pocztowy_odb = $wiersz['kod_pocztowy_zam'];
	    $miasto_odb = $wiersz['miasto_zam'];
	    $kraj_odb = $wiersz['kraj_zam'];
    
	}

	$tytul = $txt->{'mail'}->{'potwierdzono_wysylke'};

	$mail->setFrom($customerservicemail, 'Lvadshirt');
	$mail->addReplyTo($customerservicemail, 'Lvadshirt');
	$mail->addAddress($email, $imie_zam.' '.$nazwisko_zam);
	$mail->Subject = $tytul;

	$message1 = file_get_contents($sciezka.'/po_wysylce1.html');
    
	$pattern = '/##\$([a-z|A-Z|0-9|_]+)##/';
	preg_match_all($pattern, $message1, $matches);
    
	for($i=0; $i < count($matches[0]); $i++){
	    $miejsce = $matches[0][$i];
	    $nazwa_zmiennej = $matches[1][$i];
	    $zmienna = ${$nazwa_zmiennej};
	    $message1 = str_replace($miejsce, $zmienna, $message1);
	}


	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$id_zam;
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$id_zam;
	
    $res_zp = mysqli_query($DB, $query1." UNION ".$query2);	
	
    $message2 = '';
    while($wiersz_zp = mysqli_fetch_array($res_zp)){
	
		$cena_str = dodaj_walute($wiersz_zp['cena']*$wiersz_zp['ilosc'], $waluta, $pozycja_symbolu);
		$ilosc = $wiersz_zp['ilosc'];
	
		$res_tt = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wiersz_zp['typ_towaru_id']);
		$wiersz_tt = mysqli_fetch_array($res_tt);
	
		if($wiersz_zp['typ_towaru_id'] > 1){
			$nazwa_towaru = $txt->{'baza'}->{$wiersz_tt['nazwa']}->{'nazwa'};
		}else{
			if($wiersz_zp['plec'] == "k"){
				$plec = "kobieta";
			}else{
				$plec = "mezczyzna";
			}
			$rodzaj = $wiersz_zp['rodzaj'];
			$rozmiar = $wiersz_zp['rozmiar'];
			$kolor = $wiersz_zp['kolor'];		
			$nazwa_towaru = $txt->{'baza'}->{$wiersz_tt['nazwa']}->{'nazwa'}.' '.$txt->{'baza'}->{$wiersz_zp['rodzaj']}.', '.$txt->{'baza'}->{$plec}.', '.$txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wiersz_zp['rozmiar']}.', '.$txt->{'mail'}->{'kolor'}.' '.$txt->{'baza'}->{$wiersz_zp['kolor']};
		}	
	
	    $message2rob = file_get_contents($sciezka.'/po_wysylce2.html');
    
	    preg_match_all($pattern, $message2rob, $matches);

	    for($i=0; $i < count($matches[0]); $i++){
		$miejsce = $matches[0][$i];
		$nazwa_zmiennej = $matches[1][$i];
		$zmienna = ${$nazwa_zmiennej};
		$message2rob = str_replace($miejsce, $zmienna, $message2rob);
	    }
	
	    $message2 .= $message2rob;
	}

	$message3 = file_get_contents($sciezka.'/po_wysylce3.html');
    
	preg_match_all($pattern, $message3, $matches);
    
	    for($i=0; $i < count($matches[0]); $i++){
		$miejsce = $matches[0][$i];
		$nazwa_zmiennej = $matches[1][$i];
		$zmienna = ${$nazwa_zmiennej};
		$message3 = str_replace($miejsce, $zmienna, $message3);
	    }
    
    
        $message = $message1.$message2.$message3;
    
	$mail->msgHTML($message, $sciezka);
	$mail->addAttachment('mail20160510-2.gif');
	$mail->addAttachment('mail20160510-2.gif'); 
	$mail->addAttachment('mail20160510-2.gif');

	if (!$mail->send()) {
	}	

	echo 'ok';
    }else if(!$jest_spedytor){
		echo 'brak_spedytora';
	}else{
		echo 'brak_nr_przesylki';
	}
}
?>
