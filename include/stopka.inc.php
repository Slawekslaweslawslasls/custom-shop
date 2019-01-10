       <div class="stopka">
          <div class="stopka-c">
            <div class="stopka-p">
<a id="bottom" href="#scroll"></a>
              <a href="<?=$txt->{'firma'}->{'memail'}?>" class="email-p">
                <div class="koperta"></div>
<!--                <img src="<?=$_SERV_CDN?>/grafika/ikona-m.gif" alt="<?=$txt->{'stopka'}->{'altemail'}?>" title="<?=$txt->{'stopka'}->{'altemail'}?>">-->
                <span class="email-kolor">E-mail:</span> <?=$txt->{'firma'}->{'email'}?></span>
              </a>
                <?php               
                 
                      echo '<img class="loga-platnosc" src="'.$_SERV_CDN.'/grafika/loga-platnosc-'.$lang.'.png" alt="'.$txt->{'stopka'}->{'altlogaplatnosc'}.'" title="'.$txt->{'stopka'}->{'altlogaplatnosc'}.'" width="637" height="29">';
                
                ?>
              
              <ul>
                 <li><a href="regulamin.html"><?=$txt->{'stopka'}->{'regulamin'}?></a></li>
                 <li><a href="polityka-prywatnosci.html"><?=$txt->{'stopka'}->{'politykaprywatnosci'}?></a></li>
                 <li><a href="pytania.html"><?=$txt->{'stopka'}->{'pytania'}?></a></li>
                 <li><a href="kontakt.html"><?=$txt->{'stopka'}->{'kontakt'}?></a></li>
              </ul>
              
<!--WYbor jezyka-->
<div class="menu-jezyk min_szer_menu-jezyk">
    <div class="f-wybierz min_szer_wys_f-wybierz">
        <div class="f-wybierz-st"></div>
        <div class="f-wybierz-s"><span></span></div>
        <input type="hidden" value="<?=$waluta?>" class="waluta">
        <?php
                  echo '<ul class="wybierzjezyk">';
        //echo '<div>';
      $resjez = mysqli_query($DB, "select * from dict_jezyk");
      while($wierszjez = mysqli_fetch_array($resjez)){
                      if($lang == $wierszjez['skrot']){
                    $selected = 'selected="selected"';
                      }else{
                    $selected = '';
                      } 
                        echo '<div class="flagi flaga-'.$wierszjez['skrot'].'" data-lang="'.$wierszjez['skrot'].'" link="" '.$selected.'></div>';                
                      }
                  echo '</ul>';
      
                 ?>
    </div>
</div>




<!-- koniec wybor jezyka             -->
             
<!--             flagi sprites
<div class="flagi flaga-pl"></div>
<div class="flagi flaga-eu"></div>
<div class="flagi flaga-us"></div>
<div class="flagi flaga-en"></div>-->
<!--             koniec flagi sprites-->
              
              <div class="kasuj"></div>
            </div>
          </div>
       </div>