<?php

error_reporting(0);
include('../include/settings.inc.php');

$akcja = $_POST['akcja'];
$napis = '';

$wybrana_plec = $_POST['wybrana_plec'];
$wybrany_rodzaj_koszulki = $_POST['wybrany_rodzaj_koszulki'];
$wybrany_rozmiar = $_POST['wybrany_rozmiar'];

if ($akcja == 'zm_plec') {
    $napis_rk = '';
    $resrk = mysqli_query($DB, "select distinct rk.id, rk.nazwa, (select count(*) from towar t where t.rodzaj_koszulki_id=rk.id and t.plec='" . $wybrana_plec . "' and t.typ_towaru_id=1 and t.dostepny=1) as dostepny from dict_rodzaj_koszulki rk");

    $znal = false;
    while ($wierszrk = mysqli_fetch_array($resrk)) {
        if ($wierszrk['dostepny'] > 0) {
            $nazwa = $txt->{'baza'}->{$wierszrk['nazwa']};
            $napis_rk .= ',' . $wierszrk['id'] . ':' . $nazwa;
            if ($wierszrk['id'] == $wybrany_rodzaj_koszulki) {
                $znal = true;
            }
        }
    }
    $napis_rk = substr($napis_rk, 1);
    $napis .= ';' . $napis_rk;

    mysqli_data_seek($resrk, 0);
    if (!$znal) {
        while ($wierszrk = mysqli_fetch_array($resrk)) {
            if ($wierszrk['dostepny'] > 0) {
                if (!$znal) {
                    $wybrany_rodzaj_koszulki = $wierszrk['id'];
                    $znal = true;
                }
            }
        }
    }
}

if ($akcja == 'zm_rodzaj_koszulki' || $akcja == 'zm_plec') {

    $napis_r = '';
    $resr = mysqli_query($DB, "select distinct r.id, r.nazwa, r.skrot, (select count(*) from towar t where t.rozmiar_id=r.id and t.plec='" . $wybrana_plec . "' and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.typ_towaru_id=1 and dostepny=1) as dostepny from dict_rozmiar r");

    $znal = false;
    while ($wierszr = mysqli_fetch_array($resr)) {
        if ($wierszr['dostepny'] > 0) {
            $nazwa = $txt->{'baza'}->{'rozmiary'}->{'calosc'}->{$wierszr['nazwa']};
            $napis_r .= ',' . $wierszr['id'] . ':' . $nazwa;
            if ($wierszr['id'] == $wybrany_rozmiar) {
                $znal = true;
            }
        }
    }

    $napis_r = substr($napis_r, 1);
    $napis .= ';' . $napis_r;

    mysqli_data_seek($resr, 0);
    if (!$znal) {

        while ($wierszr = mysqli_fetch_array($resr)) {

            if ($wierszr['dostepny'] > 0) {
                if (!$znal) {
                    $wybrany_rozmiar = $wierszr['id'];
                    $znal = true;
                }
            }
        }
    }
}

if ($akcja == 'zm_rozmiar' || $akcja == 'zm_rodzaj_koszulki' || $akcja == 'zm_plec') {
    $napis_k = '';
    $resk = mysqli_query($DB, "select distinct k.id, k.nazwa, (select count(*) from towar t where k.id=t.kolor_id and t.rodzaj_koszulki_id=" . $wybrany_rodzaj_koszulki . " and t.rozmiar_id=" . $wybrany_rozmiar . " and t.typ_towaru_id=1 and t.plec='" . $wybrana_plec . "' and dostepny=1) as dostepny from dict_kolor k ");

    $znal = false;
    while ($wierszk = mysqli_fetch_array($resk)) {
        if ($wierszk['dostepny'] > 0) {
            $nazwa = $txt->{'baza'}->{$wierszk['nazwa']};
            $napis_k .= ',' . $wierszk['id'] . ':' . $nazwa;
            if ($wierszk['id'] == $wybrany_kolor) {
                $znal = true;
            }
        }
    }
    $napis_k = substr($napis_k, 1);
    $napis .= ';' . $napis_k;

    mysqli_data_seek($resk, 0);
    if (!$znal) {
        while ($wierszk = mysqli_fetch_array($resk)) {
            if ($wierszk['dostepny'] > 0) {
                if (!$znal) {
                    $wybrany_kolor = $wierszk['id'];
                    $znal = true;
                }
            }
        }
    }
}

$napis = substr($napis, 1);
echo $napis;
?>
