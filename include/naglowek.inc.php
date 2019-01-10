
    <div id="scroll" class="naglowek"><div class="naglowek-c">

<!--
   <script type="text/javascript">
    $(window).scroll(function(){
        if ($(this).scrollTop() > 400) {
            $('#bottom').fadeIn(500);
        } else {
            $('#bottom').fadeOut(500);
        }
    });
    $('#bottom').click(function(){
    $("#scroll").animate({ scrollTop: 0 }, 600);
    return false;
    });      
</script>
-->
        
<script type="text/javascript">
    $(window).scroll(function(){
        if ($(this).scrollTop() > 150) {
            $('#bottom').fadeIn(500);
        } else {
            $('#bottom').fadeOut(500);
        }
    });
    $(document).ready(function() { 
        $("#bottom").click(function(event) { 
            event.preventDefault(); 
            $("html, body").animate({ scrollTop: 0 }, "slow"); 
            return false; 
        });

        $('.ktos-kupil').mouseover(function() {
            $('#close').addClass('ktos-kupil-zamknij').removeClass('zamknij');         
        });
        $('.ktos-kupil').mouseout(function () {
            $('#close').addClass('zamknij').removeClass('ktos-kupil-zamknij');     
        });
        $('#close').click(function(){
        $('.ktos-kupil').hide();
});
    });  
    
  
</script>
       
        
         
          <div class="naglowek-p">
            <a itemprop="brand" itemscope itemtype="http://schema.org/Brand" href="index.html"><meta itemprop="name" content="<?=$txt->{'koszyk'}->{'nazwa'}?>"><div class="logo"><meta itemprop="logo" content="https://www.lvadshirt.com/grafika/logo-lvadshirt.svg"></div></a>
            </div>
          <div class="menu">
           <ul>
           <?php
                $ua = $_SERVER["HTTP_USER_AGENT"];      // Get user-agent of browser
                $safariorchrome = strpos($ua, 'Safari') ? true : false;     // Browser is either Safari or Chrome (since Chrome User-Agent includes the word 'Safari')
                $chrome = strpos($ua, 'Chrome') ? true : false;             // Browser is Chrome
                if($safariorchrome == true AND $chrome == false){ $safari = true; }     // Browser should be Safari, because there is no 'Chrome' in the User-Agent
                if($safari) {
            ?>
                    <li><a class="menustronaglowna <?=$aktywny1?>" href="index.html"><?=$txt->{'menu'}->{'stronaglowna'}?></a></li>       
            	    <li><a class="menupytania <?=$aktywny2?>" href="pytania.html"><?=$txt->{'menu'}->{'pytania'}?></a></li>
            	    <li><a  class="menukontakt <?=$aktywny3?>" href="kontakt.html"><?=$txt->{'menu'}->{'kontakt'}?></a></li>
            <?php
                }else{
            ?>
            	    <li><a  class="menustronaglowna <?=$aktywny1?>" href="index.html"><?=$txt->{'menu'}->{'stronaglowna'}?></a></li>
        	    <li><a class="menupytania <?=$aktywny2?>" href="pytania.html"><?=$txt->{'menu'}->{'pytania'}?></a></li>
            	    <li><a  class="menukontakt <?=$aktywny3?>" href="kontakt.html"><?=$txt->{'menu'}->{'kontakt'}?></a></li>
    	    <?php
    		}
    	    ?>
           </ul>
          </div>

          <div class="menu-m">
           <div class="menu-m-p"></div>
          </div>
          <div style="position:relative" class="menu-koszyk min_szer_menu-koszyk">
          
           
            <?php
              echo '<a href="koszyk.html"><div class="koszyk"></div></a>';
//        	echo '<a href="koszyk.html"><img src="'.$_SERV_CDN.'/grafika/ikona-koszyk.jpg" title="'.$txt->{'menu'}->{'altkoszyk'}.'" alt="'.$txt->{'menu'}->{'altkoszyk'}.'"></a>';
            ?>
            <div class="menu-koszyk-opis min_szer_menu-koszyk-opis">
              <a href="koszyk.html"><span><?=$txt->{'menu'}->{'koszyk'}?></span>:</br>
              <?php
            	    $ile = 0;
            	    foreach($_SESSION['koszyk'] as $towar){
            		$ile += $towar['ilosc'];
            	    }
            	    if($ile == 0){
            		$kosz_info = 'jestpusty';
            		echo '<a href="koszyk.html"><span class="ilosc"><span>'.$txt->{'menu'}->{'jestpusty'}.'</span></span></a>';
            	    }else{
            		$kosz_info = 'szt';
            		echo '<a href="koszyk.html"><span class="ilosc"><span class="ile">'.$ile.'</span> <span>'.$txt->{'menu'}->{'szt'}.'</span></span></a>';
            	    }
              ?>
            </div>
          </div>
         </div>
        </div>
       </div>
<?php
    $koszykklasa = 'link';
    $daneklientaklasa = 'link';
    $wysylkaklasa = 'link';
    $podsumowanieklasa = 'link';
?>
