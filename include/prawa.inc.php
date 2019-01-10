<?php	
		$etap = $_SESSION['etap'];
		$diskoszyk = '';
                if($etap >= 1){
            	    $disdaneklienta = '';
                }else{
            	    $disdaneklienta = 'disabled="disabled"';
                }
                if($etap >= 2){
            	    $diswysylka = '';
                }else{
            	    $diswysylka = 'disabled="disabled"';
                }
                if($etap >= 3){
            	    $disposumowanie = '';
                }else{
            	    $dispodsumowanie = 'disabled="disabled"';
                }
                
                if($etap >= 4){
            	    $diskoszyk = 'disabled="disabled"';
            	    $disdaneklienta = 'disabled="disabled"';
            	    $diswysylka = 'disabled="disabled"';
            	    $dispodsumowanie = 'disabled="disabled"';
                }
                /*
                  echo '<div class="koszyk-s-prawa-p-2 min_wys_prawa_menu">                  
                      <a '.$diskoszyk.' href="koszyk.html" class="linkprawa '.$koszykklasa.' min_wys_opcja_prawa_menu">'.$txt->{'prawa'}->{'koszyk'}.'</a>
                      <a '.$disdaneklienta.' href="dane-klienta.html" class="linkprawa '.$daneklientaklasa.' min_wys_opcja_prawa_menu">'.$txt->{'prawa'}->{'daneklienta'}.'</a>                      
                      <a '.$diswysylka.' href="wysylka.html" class="linkprawa '.$wysylkaklasa.' min_wys_opcja_prawa_menu">'.$txt->{'prawa'}->{'wysylka'}.'</a>
                      <a '.$dispodsumowanie.' href="podsumowanie.html" class="linkprawa '.$podsumowanieklasa.' min_wys_opcja_prawa_menu">'.$txt->{'prawa'}->{'podsumowanie'}.'</a>                      
                  </div>';
				  */
?>