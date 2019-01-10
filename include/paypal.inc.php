<?php
    $resk = mysqli_query($DB, "select z.kraj_zam_id, k.kod from zamowienie z, dict_kraj k where z.kraj_zam_id=k.id and z.id=".$_SESSION['id_zam']);
    $wierszk = mysqli_fetch_array($resk);
    $kraj_zam_id = $wierszk['kraj_zam_id'];
    $jezyk_pp = $wierszk['kod'];;
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" id="paypalform">
<input type="hidden" name="business" value="B2C4LT6L9FJ32">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" id="item_name" name="item_name" value="<?=$txt->{'paypal'}->{'zamowienienr'}?>">
<input type="hidden" name="amount" value="<?=$kwota_laczna?>">
<input type="hidden" name="currency_code" value="<?=$waluta_pp?>">
<input type="hidden" name="custom" value="<?=$_SESSION['id_zam']?>">
<input type="hidden" name="return" value="https://<?=$_SERV.$_PATH?>/zamowienie.html">
<input type="hidden" name="return_cancel" value="https://<?=$_SERV.$_PATH?>/anulowanie.html">
<input type="hidden" name="notify_url" value="https://<?=$_SERV.$_PATH?>/payment/paypal.html">
<input type="hidden" name="lc" value="<?=$jezyk_pp?>">
<input type="hidden" name="cpp_header_image" value="https://<?=$_SERV.$_PATH?>/payment/paypal.html">
</form>
