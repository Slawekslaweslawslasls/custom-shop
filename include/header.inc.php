<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?=$description?>">
<title lang="<?=$lang?>"><?=$title?></title>
<link rel="stylesheet" href="http://test.lvadshirt.com/style-test/style.css?id=49" type="text/css" media="screen">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="alternate" href="https://www.lvadshirt.com<?=$_SERVER['SCRIPT_URL']?>" hreflang="x-default">
<link rel="manifest" href="/manifest.json">
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
      appId: "934c4afc-15b2-4588-b24e-de199f4883a8",
      autoRegister: false,
      notifyButton: {
        enable: false
      },
      welcomeNotification: {
    disable: true
      },
      promptOptions: {
        actionMessage: "<?php echo $txt->{'push'}->{'actionMessage'} ?>",
        acceptButtonText: "<?php echo $txt->{'push'}->{'acceptButtonText'} ?>",
        cancelButtonText: "<?php echo $txt->{'push'}->{'cancelButtonText'} ?>"
      }
    }]);
  </script>
    <script data-cfasync="false">
        window.OneSignal = window.OneSignal || [];
        var notificationPromptDelay = 15000;
        window.OneSignal.push(function() {
            var navigationStart = window.performance.timing.navigationStart;
            var timeNow = Date.now();
            setTimeout(promptAndSubscribeUser, Math.max(notificationPromptDelay - (timeNow - navigationStart), 0));
        });
        function promptAndSubscribeUser() {
            window.OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                if (!isEnabled) {
                    window.OneSignal.showHttpPrompt();
                }
            });
        }
    </script>
<?php
$resalt = mysqli_query($DB, "select * from dict_jezyk");
while($wierszalt = mysqli_fetch_array($resalt)){
	if($lang != $wierszalt['lang']){
    		echo '<link rel="alternate" hreflang="'.$wierszalt['lang'].'" href="https://'.$wierszalt['link'].$_SERVER['SCRIPT_URL'].'" />';
	}
}
if(!isset($admin)){
?>
<script type="text/javascript">window.smartlook||(function(d) {    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';    c.charset='utf-8';c.src='//rec.smartlook.com/recorder.js';h.appendChild(c);    })(document);    smartlook('init', '9bec2259fb235d6f4970854e8dbc85db99faef3b');    var _serwer = "<?=$_SERV?>";    var _sciezka = "<?=$_PATH?>";    var _cdn = "<?=$_CDN?>";    var _jezyk = "<?=$lang?>";
</script>
<?php
}else{
?>
<script type="text/javascript">    var _serwer = "<?=$_SERV?>";    var _sciezka = "<?=$_PATH?>";    var _cdn = "<?=$_CDN?>";    var _jezyk = "<?=$lang?>";	</script>
<?php
}
?>
<script type="text/javascript">	<?php
	echo "var wygodnekieszenie = \"".$txt->{'index'}->{'wygodnekieszenie'}."\";";
	echo "var wygodnekieszenieopis = \"".$txt->{'index'}->{'wygodnekieszenieopis'}."\";";
	echo "var oddychajacatkanina = \"".$txt->{'index'}->{'oddychajacatkanina'}."\";";
	echo "var oddychajacatkaninaopis = \"".$txt->{'index'}->{'oddychajacatkaninaopis'}."\";";
	echo "var proszeczekac = \"".$txt->{'podsumowanie'}->{'proszeczekac'}."\";";
	echo "var proszejeszczeraz = \"".$txt->{'podsumowanie'}->{'proszejeszczeraz'}."\";";
	echo "var uzupelnijwszystkiepolaformularza = \"".$txt->{'dane'}->{'uzupelnijwszystkiepolaformularza'}."\";";
	echo "var platnoscamericanexpressniedostepna = \"".$txt->{'dane'}->{'platnoscamericanexpressniedostepna'}."\";";
	/*
	echo "var altkobieta = \"".$txt->{'baza'}->{'kobieta'}."\";";
	echo "var altmezczyzna = \"".$txt->{'baza'}->{'mezczyzna'}."\";";
	echo "var altrekawnik = \"".$txt->{'baza'}->{'rekawnik'}."\";";
	echo "var altbezrekawnik = \"".$txt->{'baza'}->{'bezrekawnik'}."\";";
	echo "var altbialy = \"".$txt->{'baza'}->{'bialy'}."\";";
	echo "var altczarny = \"".$txt->{'baza'}->{'czarny'}."\";";
	*/
	echo "var pozycja_symbolu = \"".$pozycja_symbolu."\";";
	echo "var waluta = \"".$waluta."\";";
	echo "var nagloweknews = \"".$txt->{'newsletter'}->{'dziekujemy'}."\";";
	echo "var trescnews = \"".$txt->{'newsletter'}->{'twojadresemail'}."\";";
	echo "var last_dis = \"".$_LAST_DISCOUNT."\";";
	echo "var last_num = \"".$_LAST_NUM."\";";
	echo "var last_val = \"".$_LAST_VALUE."\";";
	echo "var def_dis = \"".$_DEFAULT_DISCOUNT."\";";
	echo "var def_num = \"".$_DEFAULT_NUM."\";";
	echo "var def_val = \"".$_DEFAULT_VALUE."\";";

	echo "var obrduzy_k_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_k_2_1'}."\";";
	echo "var obrduzy_k_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_k_2_2'}."\";";
	echo "var obrduzy_m_1_1 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_m_1_1'}."\";";
	echo "var obrduzy_m_1_2 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_m_1_2'}."\";";
	echo "var obrduzy_m_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_m_2_1'}."\";";
	echo "var obrduzy_m_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrduzy_m_2_2'}."\";";

	echo "var obrmaly1_k_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_k_2_1'}."\";";
	echo "var obrmaly1_k_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_k_2_2'}."\";";
	echo "var obrmaly1_m_1_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_m_1_1'}."\";";
	echo "var obrmaly1_m_1_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_m_1_2'}."\";";
	echo "var obrmaly1_m_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_m_2_1'}."\";";
	echo "var obrmaly1_m_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly1_m_2_2'}."\";";

	echo "var obrmaly2_k_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_k_2_1'}."\";";
	echo "var obrmaly2_k_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_k_2_2'}."\";";
	echo "var obrmaly2_m_1_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_m_1_1'}."\";";
	echo "var obrmaly2_m_1_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_m_1_2'}."\";";
	echo "var obrmaly2_m_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_m_2_1'}."\";";
	echo "var obrmaly2_m_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly2_m_2_2'}."\";";

	echo "var obrmaly3_k_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_k_2_1'}."\";";
	echo "var obrmaly3_k_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_k_2_2'}."\";";
	echo "var obrmaly3_m_1_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_m_1_1'}."\";";
	echo "var obrmaly3_m_1_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_m_1_2'}."\";";
	echo "var obrmaly3_m_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_m_2_1'}."\";";
	echo "var obrmaly3_m_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly3_m_2_2'}."\";";

	echo "var obrmaly4_k_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_k_2_1'}."\";";
	echo "var obrmaly4_k_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_k_2_2'}."\";";
	echo "var obrmaly4_m_1_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_m_1_1'}."\";";
	echo "var obrmaly4_m_1_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_m_1_2'}."\";";
	echo "var obrmaly4_m_2_1 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_m_2_1'}."\";";
	echo "var obrmaly4_m_2_2 = \"".$txt->{'baza'}->{'alt'}->{'obrmaly4_m_2_2'}."\";";
	?>
</script>
<?  

	var_dump($_SESSION['popup']);
	//var_dump($_SESSION['wysylka_kraj']);
	//var_dump($_SESSION['ilosc']);
	var_dump($_SESSION['id_zam']);
	//var_dump($_SESSION['kod']);
	//var_dump($_SESSION['kraj']);
	//var_dump($_SESSION['kod_google']);
    //var_dump($_SESSION['wk']);
    //var_dump($_SESSION['nrk'])
    //var_dump($_SESSION['kwk']);
    //var_dump($_SESSION['mies']);
    //var_dump($_SESSION['rok']);
    //var_dump($_SESSION['kwota_laczna']);
    //var_dump($waluta_pp);
    //var_dump($card_params);
	//var_dump($_SESSION['id_zam']);
 	var_dump($_SESSION['koszyk']);
    //var_dump($_SESSION['id_zam']);
    //var_dump($_SESSION['koszyk'][0]['powloka']);
?>
<script src="<?=$_SERV_CDN?>/js-test/funkcje.js?s616"></script>
<link rel="dns-prefetch" href="\s1.lvadshirt.com">
<link rel="dns-prefetch" href="\manager.smartlook.com">
<link rel="dns-prefetch" href="\staticxx.facebook.com">
<link rel="dns-prefetch" href="\connect.facebook.net">
<link rel="dns-prefetch" href="\writer-us.smartlook.com">
<link rel="dns-prefetch" href="\www.google-analytics.com">
<link rel="dns-prefetch" href="\stats.g.doubleclick.net">
<link rel="dns-prefetch" href="\www.google.com">
</head>
