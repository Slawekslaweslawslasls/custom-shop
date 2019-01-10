<?php
include('./include/login.inc.php');
include('./fpdf/fpdf.php');

define('EURO',chr(128));

$unia = array('BE', 'BG', 'CZ', 'DK', 'DE', 'EE', 'IE', 'EL', 'ES', 'FR', 'HR', 'IT', 'CY', 'LV', 'LT', 'LU', 'HU', 'MT', 'NL', 'AT', 'PL', 'PT', 'RO', 'SI', 'SK', 'FI', 'SE', 'UK');

function dodaj_walute_f($cena, $waluta, $pozycja, $kod_waluty, $rabat){
	if($kod_waluty == 'EUR'){
		$waluta = EURO;
	}
	if(($cena * 100)%10 ==0){
		if(($cena * 100)%100 == 0){
			$cena .= '.00';
		}else{
			$cena .= '0';
		}
	}
    if($pozycja == 0){
		$wynik = $waluta.' '.$cena;
    }else{
		$wynik = $cena.' '.$waluta;
    }
    return $wynik;
}	
	
$id_zam = $_GET['id'];

$res = mysqli_query($DB, "select z.odbiorca_id, z.etap_id, z.data, z.invoice, z.imie_zam, z.nazwisko_zam, z.adres1_zam, z.miasto_zam, z.kod_pocztowy_zam, k.nazwa as kraj_zam, k.kod as kod, z.koszt_wysylki_kwota, z.rabat_kwota, z.wartosc_kwota, tp.nazwa as typ_platnosci, z.id_transakcji, z.nazwa_spedytora from zamowienie z, dict_kraj k, dict_typ_platnosci tp where z.kraj_zam_id=k.id and tp.id=z.typ_platnosci_id and z.id=".$id_zam);
$wiersz = mysqli_fetch_array($res);

if($wiersz['etap_id']==5 || $wiersz['etap_id']==7){

$invoice = $wiersz['invoice'];
$imie = $wiersz['imie_zam'];
$nazwisko = $wiersz['nazwisko_zam'];
$adres1 = $wiersz['adres1_zam'];
$miejscowosc = $wiersz['miasto_zam'];
$kod_pocztowy = $wiersz['kod_pocztowy_zam'];
$kraj = $wiersz['kraj_zam'];
if(in_array($wiersz['kod'], $unia)){
	$vat_stawka =  23;
}else{
	$vat_stawka = 0;
}
$vat_stawka_str = $vat_stawka.'%';
$koszt_wysylki_kwota = $wiersz['koszt_wysylki_kwota'];
$id_transakcji = $wiersz['id_transakcji'];
$rabat = $wiersz['rabat_kwota'];

$resw = mysqli_query($DB, "select w.nazwa as wojewodztwo_zam from zamowienie z, dict_wojewodztwo w where z.wojewodztwo_zam_id=w.id and z.id=".$id_zam);
if($wierszw = mysqli_fetch_array($resw)){
	$wojewodztwo = ' ('.$wierszw['wojewodztwo_zam'].')';
}else{
	$wojewodztwo = '';
}

$resj = mysqli_query($DB, "select j.skrot from zamowienie z, dict_jezyk j where z.jezyk_id=j.id and z.id=".$id_zam);
$wierszj = mysqli_fetch_array($resj);
$lang = $wierszj['skrot'];

$tlumaczenie=file_get_contents($_LANG_PATH.'/locales/'.$lang.'/translation.json');

$txt=json_decode($tlumaczenie);

$resj = mysqli_query($DB, "select j.servicemail, j.id, j.symbol, j.pozycja_symbolu, j.waluta from dict_jezyk j where j.skrot='".$lang."'");
$wierszj = mysqli_fetch_array($resj);

$waluta = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $wierszj['symbol']);
$kod_waluty = $wierszj['waluta'];
$pozycja_symbolu = $wierszj['pozycja_symbolu'];

$pdf=new FPDF();
$marg = 5;

$pdf->SetDrawColor(100,100,100);
$pdf->SetLineWidth(0);

$pdf->AddPage();
$pdf->Image("./grafika/logo.gif",5,5,0,0);

$pdf->AddFont('Arial','','arial.php');
$pdf->AddFont('Arial','I','ariali.php');
$pdf->AddFont('Arial','B','arialbd.php');

$pdf->SetXY(0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial",'B',26);

$pdf->Cell(0, 20, "Invoice ".$invoice."/LVAD", 0,1, 'R');

$pdf->SetTextColor(100,100,100);
$pdf->SetFont("Arial",'',10);


$data = explode('-',$wiersz['data']);
$data = mktime(0,0,0, $data[1], substr($data[2], 0, 2), $data[0]);
$data = date("F d, Y", $data);
$pdf->Cell(0, 7, "Warsaw, ".$data, 0, 1, 'R');
$pdf->Cell(0, 7, "Sale date: ".$data, 0, 1, 'R');

$pdf->SetFont("Arial",'B',10);
$pdf->SetTextColor(0,0,0);

$jest_odbiorca = $wiersz['odbiorca_id']!='';

if($jest_odbiorca){
	$reso = mysqli_query($DB, "select z.imie_odb, z.nazwisko_odb, z.adres1_odb, z.miasto_odb, z.kod_pocztowy_odb, k.nazwa as kraj_odb, k.kod as kod from zamowienie z, dict_kraj k, dict_typ_platnosci tp where z.kraj_odb_id=k.id and tp.id=z.typ_platnosci_id and z.id=".$id_zam);
	$wierszo = mysqli_fetch_array($reso);
	$imieo = $wierszo['imie_odb'];
	$nazwiskoo = $wierszo['nazwisko_odb'];
	$adres1o = $wierszo['adres1_odb'];
	$miejscowosco = $wierszo['miasto_odb'];
	$kod_pocztowyo = $wierszo['kod_pocztowy_odb'];
	$krajo = $wierszo['kraj_odb'];

	$reswo = mysqli_query($DB, "select w.nazwa as wojewodztwo_odb from zamowienie z, dict_wojewodztwo w where z.wojewodztwo_odb_id=w.id and z.id=".$id_zam);
	if($wierszwo = mysqli_fetch_array($reswo)){
		$wojewodztwoo = ' ('.$wierszwo['wojewodztwo_odb'].')';
	}else{
		$wojewodztwoo = '';
	}	
}
$pdf->Ln();
$pdf->Cell(60, 7, "From:", 0, 0, 'L');
if($jest_odbiorca){
	$pdf->Cell(60, 7, "To:", 0, 0, 'L');
	$pdf->Cell(0, 7, "Shipping:", 0, 1, 'L');
}else{
	$pdf->Cell(60, 7, "To:", 0, 1, 'L');
}
if($lang == 'pl'){
	$pdf->SetFont("Arial",'',10);
}else{
	$pdf->SetFont("Helvetica",'',10);	
}
$pdf->SetTextColor(100,100,100);
$pdf->Cell(60, 7, "webska Sp. z o.o.", 0, 0, 'L');

if($jest_odbiorca){
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $imie)." ".iconv('UTF-8', 'ISO-8859-2//TRANSLIT',$nazwisko), 0, 0, 'L');
	$pdf->Cell(0, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $imieo)." ".iconv('UTF-8', 'ISO-8859-2//TRANSLIT',$nazwiskoo), 0, 1, 'L');
}else{
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $imie)." ".iconv('UTF-8', 'ISO-8859-2//TRANSLIT',$nazwisko), 0, 1, 'L');
}
$pdf->Cell(60, 7, "ul. K. I. Galczynskiego 4", 0, 0, 'L');

if($jest_odbiorca){
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $adres1), 0, 0, 'L');
	$pdf->Cell(0, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $adres1o), 0, 1, 'L');
}else{
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $adres1), 0, 1, 'L');
}
$pdf->Cell(60, 7, "00-362 Warsaw, POLAND", 0, 0, 'L');
if($jest_odbiorca){
	$pdf->Cell(60, 7, $kod_pocztowy.' '.iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $miejscowosc.$wojewodztwo), 0, 0, 'L');
	$pdf->Cell(0, 7, $kod_pocztowyo.' '.iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $miejscowosco.$wojewodztwoo), 0, 1, 'L');
}else{
	$pdf->Cell(60, 7, $kod_pocztowy.' '.iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $miejscowosc.$wojewodztwo), 0, 1, 'L');

}
$pdf->Cell(60, 7, "Tax ID: PL5252538629", 0, 0, 'L');
if($jest_odbiorca){
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $kraj), 0, 0, 'L');
	$pdf->Cell(0, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $krajo), 0, 1, 'L');
}else{
	$pdf->Cell(60, 7, iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $kraj), 0, 1, 'L');
}
$pdf->Cell(60, 7, "EORI: PL525253862900000", 0, 1, 'L');

$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetX(2*$marg);
$pdf->Cell(30, 7, "Item", 1, 0, 'L');
$pdf->Cell(30, 7, "Quantity", 1, 0, 'L');
$pdf->Cell(30, 7, "Unit Price", 1, 0, 'L');
$pdf->Cell(30, 7, "VAT rate", 1, 0, 'L');
$pdf->Cell(30, 7, "VAT", 1, 0, 'L');
$pdf->Cell(30, 7, "Subtotal", 1, 1, 'L');
$pdf->SetTextColor(100,100,100);

$brutto = 0;
$vat_razem = 0;

	$query1 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, zp.plec, rk.nazwa as rodzaj, r.skrot as skrot, r.nazwa as rozmiar, k.nazwa as kolor from zamowienie_pozycja zp, dict_rodzaj_koszulki rk, dict_kolor k, dict_rozmiar r where zp.typ_towaru_id=1 and zp.kolor_id=k.id and zp.rozmiar_id=r.id and zp.rodzaj_koszulki_id=rk.id and zp.zamowienie_id=".$id_zam;
	$query2 = "select zp.typ_towaru_id, zp.cena, zp.ilosc, NULL as plec, NULL as rodzaj, NULL as skrot, NULL as rozmiar, NULL as kolor from zamowienie_pozycja zp where zp.typ_towaru_id>1 and zp.zamowienie_id=".$id_zam;
	
    $res_zp = mysqli_query($DB, $query1." UNION ".$query2);

    while($wiersz_zp = mysqli_fetch_array($res_zp)){
	
		$cenaj = $wiersz_zp['cena']; 
		$ilosc = $wiersz_zp['ilosc'];		
		$cena_b = $cenaj*$ilosc;
		
		if($wiersz_zp['typ_towaru_id'] > 1){
			$res_zp_dod = mysqli_query($DB, "select nazwa from dict_typ_towaru where id=".$wiersz_zp['typ_towaru_id']);
			$wiersz_zp_dod = mysqli_fetch_array($res_zp_dod);
			$rodzaj = $txt->{"baza"}->{$wiersz_zp_dod['nazwa']}->{'nazwa'};
			$rozmiar = '';
			$kolor = '';
			$plec = '';
		}else{
			if($wiersz_zp['plec'] == "k"){
				$plec = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{"kobieta"});
			}else{
				$plec = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{"mezczyzna"});
			}
			$rodzaj = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{$wiersz_zp['rodzaj']});
			$rozmiar = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{"rozmiary"}->{$wiersz_zp['rozmiar']});
			$kolor = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{$wiersz_zp['kolor']});			
		}
		

		
		$cenaj_n = round($cenaj/((100+$vat_stawka)*0.01), 2);
		$cenaj_n_str = dodaj_walute_f($cenaj_n, $waluta, $pozycja_symbolu, $kod_waluty, 0);
		$vat_kwota = round(($cena_b * 0.01*$vat_stawka) / ((100+$vat_stawka)*0.01),2);		
		$vat_kwota_str = dodaj_walute_f($vat_kwota, $waluta, $pozycja_symbolu, $kod_waluty, 0);
		$subtotal_str = dodaj_walute_f($cena_b, $waluta, $pozycja_symbolu, $kod_waluty, 0);
		
		$pozy1 = $pdf->GetY();
		if($wiersz_zp['typ_towaru_id'] > 1){
			$pdf->MultiCell(30, 7, 'LVADshirt '.$rodzaj, 1, 'L');
		}else{
			$pdf->MultiCell(30, 7, 'LVADshirt '.$rodzaj.', '.$plec.', '.$kolor.', size: '.$rozmiar, 1, 'L');
		}
		$pozy2 = $pdf->GetY();
		$pdf->SetXY(2*$marg+30, $pozy1);
		$pdf->Cell(30, $pozy2-$pozy1, $ilosc, 1, 0,'L');
		$pdf->Cell(30, $pozy2-$pozy1, $cenaj_n_str, 1, 0,'L');
		$pdf->Cell(30, $pozy2-$pozy1, $vat_stawka_str, 1, 0,'L');
		$pdf->Cell(30, $pozy2-$pozy1, $vat_kwota_str, 1,0, 'L');
		$pdf->Cell(30, $pozy2-$pozy1, $subtotal_str, 1,1, 'L');
		$pdf->SetXY(2*$marg, $pozy2);
		
		$brutto += $cena_b;
		$vat_razem += $vat_kwota;
	}
	
$brutto = round($brutto, 2);
$vat_razem = round($vat_razem, 2);
    
if($rabat!=0){
	
	$rabat_str = '- '.dodaj_walute_f($rabat, $waluta, $pozycja_symbolu, $kod_waluty, 1);
	$vat_rabat_kwota = round(($rabat * 0.01*$vat_stawka) / ((100+$vat_stawka)*0.01),2);
	$vat_rabat_kwota_str = dodaj_walute_f($vat_rabat_kwota, $waluta, $pozycja_symbolu, $kod_waluty, 0);
	if($vat_rabat_kwota != 0){
		$vat_rabat_kwota_str = '- '.$vat_rabat_kwota_str;
	}
	$pdf->Cell(30, 7, 'Discount', 1, 0,'L');
	$pdf->Cell(30, 7, '', 1,0, 'L');
	$pdf->Cell(30, 7, '', 1,0, 'L');
	$pdf->Cell(30, 7, $vat_stawka_str, 1,0, 'L');
	$pdf->Cell(30, 7, $vat_rabat_kwota_str, 1,0, 'L');
	$pdf->Cell(30, 7, $rabat_str, 1,1, 'L');
}else{
	$vat_rabat_kwota = 0;
}
   
$koszt_wysylki_kwota_n = round($koszt_wysylki_kwota/((100+$vat_stawka)*0.01), 2);
$koszt_wysylki_n_str = dodaj_walute_f($koszt_wysylki_kwota_n, $waluta, $pozycja_symbolu, $kod_waluty, 0); 
$vat_kwota = round(($koszt_wysylki_kwota * 0.01*$vat_stawka) / ((100+$vat_stawka)*0.01),2);
$vat_kwota_str = dodaj_walute_f($vat_kwota, $waluta, $pozycja_symbolu, $kod_waluty, 0);
$subtotal_str = dodaj_walute_f($koszt_wysylki_kwota, $waluta, $pozycja_symbolu, $kod_waluty, 0); 

$pdf->Cell(30, 7, 'Shipping ('.$wiersz['nazwa_spedytora'].')', 1, 0,'L');
$pdf->Cell(30, 7, '', 1,0, 'L');
$pdf->Cell(30, 7, $koszt_wysylki_n_str, 1,0, 'L');
$pdf->Cell(30, 7, $vat_stawka_str, 1,0, 'L');
$pdf->Cell(30, 7, $vat_kwota_str, 1,0, 'L');
$pdf->Cell(30, 7, $subtotal_str, 1,1, 'L');

$vat_razem_str = dodaj_walute_f(round($vat_razem+$vat_kwota-$vat_rabat_kwota, 2), $waluta, $pozycja_symbolu, $kod_waluty, 0);
$razem_str =  dodaj_walute_f(round($brutto+$koszt_wysylki_kwota-$rabat, 2), $waluta, $pozycja_symbolu, $kod_waluty, 0);

if($lang == 'pl'){
	$pdf->SetFont("Arial",'B',10);
}else{
	$pdf->SetFont("Helvetica",'B',10);	
}
$pdf->SetTextColor(0,0,0);
$pdf->SetX(2*$marg+60);
$pdf->Cell(30, 7, 'Total:', 1, 0,'L');
$pdf->Cell(30, 7, $vat_stawka_str, 1,0, 'L');
$pdf->Cell(30, 7, $vat_razem_str, 1,0, 'L');
$pdf->Cell(30, 7, $razem_str, 1,1, 'L');
$pdf->Ln();

$pdf->SetTextColor(100,100,100);
$pdf->SetFont("Arial",'I',10);
		
$forma_platnosci = iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $txt->{"baza"}->{$wiersz['typ_platnosci']});

$data = $wiersz['data'];	
$data = explode('-',$data);
$data = mktime(0,0,0, $data[1], substr($data[2], 0, 2), $data[0]);
$data = date("F d, Y", $data);

$pdf->Cell(0, 7, "Payment type: ".$forma_platnosci.' ('.$data.')', 0, 1, 'R');	
$pdf->Cell(0, 7, "Payment ID: ".$id_transakcji, 0, 1, 'R');
	
$pdf->Output('D','faktura.pdf');
}else{
	echo "Brak faktury.";
}
?>