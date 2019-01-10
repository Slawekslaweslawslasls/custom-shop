    <?php
	if(!isset($_COOKIE['ciastkow']) && ($lang == 'eu' || $lang == 'pl')){
	    $style = 'style="display:inline;"';
	}else{
	    $style = '';
	}
    ?>
<!--       Newsletter-->
<span class="mailok" <?=$style?>>
    <div class="tlo-wiadomosci"></div>
    <div class="wiadomosci">
        <div class="wiadomosci-p newsletter" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>">
            <div class="wiadomosci-c wiadomosci-c-news">x</div>
            <div class="wiadomosci-pad">
            <img class="gift" src="../grafika/gift-ico.gif" alt=""></div>
            <h1 id="nagloweknews"><?=$txt->{'newsletter'}->{'zapiszsiedonewslettera'}?></h1>
            <span id="trescnews"><?=$txt->{'newsletter'}->{'iotrzymaj10procentrabatu'}?></span>
            <div class="gift-form float-label-div2" id="polanews">
                <input class="input-float2 input_mail" data-wpis="1" data-err="E-mail" id="emailnews" type="text" name="emailnews" required>
                <label for="emailnews"><?=$txt->{'newsletter'}->{'email'}?><span id="errnews"></span></label>
                <input type="submit" id="wyslijnews" value="<?=$txt->{'newsletter'}->{'wyslij'}?>">
            </div>
            </div>
        </div>
    </div>
</span>
<!--       koniec newsletter-->