<?php

error_reporting(0);
include('../include/settings.inc.php');

$kraj_id = $_POST['kraj_id'];
$napis = '';

$resw = mysqli_query($DB, "select * from dict_wojewodztwo where kraj_id=" . $kraj_id);
if (mysqli_num_rows($resw) != 0) {

    $napis = '
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                    <label data-i18n="[html]dane.wojewodztwo" for="woj" class="min_wys_dane_klienta_label1"></label>
                                     <div class="koszyk-formularz-f-9  min_wys_dane_klienta_divinput1">
                                       <select id="woj">
                                    	    <option data-i18n="dane.wybierz"  data-id="0"></option>';


    while ($wierszw = mysqli_fetch_array($resw)) {
        $napis .= '<option data-id="' . $wierszw['id'] . '">' . $wierszw['nazwa'] . '</option>';
    }

    $napis .= '
                                        </select>
                                     </div>
                                  </div>
                               </div>';
}

echo $napis;
?>
