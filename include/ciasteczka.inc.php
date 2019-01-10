    <?php
	if(!isset($_COOKIE['ciastkow']) && ($lang == 'eu' || $lang == 'pl')){
	    $style = 'style="display:block;"';
	}else{
	    $style = '';
	}
    ?>
    <div class="info-cookies info-cookies-zam2" <?=$style?>>
      <div class="info-cookies-c">
        <div class="info-cookies-p">
          <div class="info-cookies-zam">x</div>
          <span><?=$txt->{'ciast'}->{'info'}?></span>
        </div>
      </div>
    </div>