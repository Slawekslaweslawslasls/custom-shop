<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');

	    if($_SESSION['ilosc'] == 0){
		header('Location: https://'.$_SERV.$_PATH.'/koszyk-pusty.html');
	    }
    
?>
    
    <body> 

<?php
    include('./include/ciasteczka.inc.php');
?>
       
    <div class="calosc">
       
	<?php
	    $aktywny1 = '';
	    $aktywny2 = '';
	    $aktywny3 = '';
	    include('./include/naglowek.inc.php');
	    
	?>
       
       <div class="kasuj"></div>

       <div class="zawartosc">
          <div class="zawartosc-c">
            <div class="zawartosc-p">
            
                <div class="nawigacja">
                  <ul>
                    <li><a href="index.html"><?=$txt->{'naw'}->{'stronaglowna'}?></a></li>       
                    <li><a href="koszyk.html"><?=$txt->{'naw'}->{'koszyk'}?></a></li>
                    <li><a href="dane-klienta.html" class="aktywny"><?=$txt->{'naw'}->{'daneklienta'}?></a></li>					
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-lewa" style="width:100%">

		<?php
		    if($_SESSION['id_zam'] != 0){
			$query = "select * from zamowienie where id=".$_SESSION['id_zam'];
			$res = mysqli_query($DB, $query);
			$wiersz = mysqli_fetch_array($res);
		    }
		?>

                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela">
                               <!--
							   <div class="koszyk-nawigacja min_wys_dane_klienta">
                                  <div class="koszyk-nawigacja-nr">1</div> <span><?=$txt->{'daneklienta'}->{'daneklienta'}?></span>
                               </div>
							   -->
                               <form class="min_wys_dane_klienta_form" id="form_dane_klienta" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>"data-uwaga-numer="<?=$txt->{'dane'}->{'uwaga-cyfra'}?>" >
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="imie" value="'.$wiersz['imie_zam'].'" type="text" required data-blad="0">
                                            <label for="imie">'.$txt->{'dane'}->{'imie'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="imie" value="" type="text" required data-blad="0">
                                            <label for="imie">'.$txt->{'dane'}->{'imie'}.'<span> *</span></label>';
                                        }
                                    	?>
                                     </div>
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="nazwisko" type="text" value="'.$wiersz['nazwisko_zam'].'" required data-blad="0">
                                            <label for="nazwisko" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'nazwisko'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="nazwisko" value="" type="text" required data-blad="0">
                                            <label for="nazwisko" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'nazwisko'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>                                  
                                  </div>
                               </div>
                               
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="firma" type="text" value="'.$wiersz['firma_zam'].'" required data-blad="0">
                                            <label for="firma" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'firma'}.'</label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="firma" value="" type="text" required data-blad="0">
                                            <label for="firma" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'firma'}.'</label>';
                                        }
                                        ?>
                                     </div>
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1 float-label-div">
					<?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="email" type="text" value="'.$wiersz['email_zam'].'" required data-blad="0">
                                            <label for="email" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'email'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="email" value="" type="text" required data-blad="0">
                                            <label for="email" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'email'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>                                  
                                  </div>
                               </div> 
                               <div class="kasuj"></div>
                               <div class="koszyk-tabela-poz-cal min_wys_dane_klienta_form2">
                                  <div class="koszyk-tabela-poz-cal-p">
                                     <div class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="adres" type="text" value="'.$wiersz['adres1_zam'].'" required data-blad="0">
                                            <label for="adres" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'adres'}.'<span> *</span></label>';
                                        }else{ 
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="adres" value="" type="text" required data-blad="0">
                                            <label for="adres" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'adres'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 ">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                         
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1" id="adres2"  type="text" value="'.$wiersz['adres2_zam'].'" data-blad="0">';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1" id="adres2" value="" type="text" data-blad="0">';
                                        }
                                        ?>
                                     </div>                                                                         
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="kod" type="text" value="'.$wiersz['kod_pocztowy_zam'].'" required data-blad="0">
                                            <label for="kod" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'kodpocztowy'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="kod" value="" type="text" required data-blad="0">
                                            <label for="kod" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'kodpocztowy'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>
                                  </div>
                               </div>
                               
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-9  min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="miejscowosc" type="text"  value="'.$wiersz['miasto_zam'].'" required data-blad="0">
                                            <label for="miejscowosc" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'miejscowosc'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="miejscowosc" value="" type="text" required data-blad="0">
                                            <label for="miejscowosc" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'miejscowosc'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>                                  
                                  </div>
                               </div>                                                                               

                               <?php

                                    		if($_SESSION['id_zam'] != 0){
                                    		    $where = ' where kraj_id='.$wiersz['kraj_zam_id'];
                                    		}else{
                                    		    $where = ' where kraj_id='.$_SESSION['wysylka_kraj'];
                                    		}
                                    		$resw = mysqli_query($DB, "select * from dict_wojewodztwo".$where);
						$ile_woj = mysqli_num_rows($resw);
                                    		if($ile_woj != 0){
                               
                               ?>


                               <div class="koszyk-tabela-poz-lewa">
                                  <div class="koszyk-tabela-poz-lewa-p min_wys_dane_klienta_form1">
                                    <label for="woj" class="min_wys_dane_klienta_label1"><?=$txt->{'dane'}->{'wojewodztwo'}?></label>
                                     <div style="margin:0" class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1">
                                       <select id="woj">                                	    
                                    	    <?php
                                    		echo '<option data-id="0">'.$txt->{'dane'}->{'wybierz'}.'</option>';
                                    		while($wierszw = mysqli_fetch_array($resw)){
                                    		    if($_SESSION['id_zam'] != 0 && $wiersz['wojewodztwo_zam_id'] == $wierszw['id']){
                                    			$selected = 'selected';
                                    		    }else{
                                    			$selected = '';
                                    		    }
                                        	    echo '<option '.$selected.' data-id="'.$wierszw['id'].'">'.$wierszw['nazwa'].'</option>';
                                        	}
                                        	
                                            ?>
                                        </select>
                                     </div>                                  
                                  </div>
                               </div>                                 
                             <?php
                            			}

				if($ile_woj != 0){
			     	?>
                               
				<div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                      <label for="kraj_dane_klienta" class="min_wys_dane_klienta_label1"><?=$txt->{'dane'}->{'kraj'}?></label>
                                     <div style="margin:0; border:none" class="koszyk-formularz-f-9 noboxshadow  min_wys_dane_klienta_divinput1" style="border:none">
				<?php
				
				}else{
			     	
				?>
                               
				<div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                      <label for="kraj_dane_klienta" class="min_wys_dane_klienta_label1"><?=$txt->{'dane'}->{'kraj'}?></label>
                                     <div style="margin:0; border:none" class="koszyk-formularz-f-8 noboxshadow min_wys_dane_klienta_divinput1" style="border:none">
				<?php
				}
                                        	if($_SESSION['id_zam']!=0){
                                    			$resk = mysqli_query($DB, "select * from dict_kraj where id=".$wiersz['kraj_zam_id']);
                                    			$wierszk = mysqli_fetch_array($resk);
												echo '<div style="margin:0; border:none" id="kraj_dane_klienta" data-id="'.$wierszk['id'].'">'.$wierszk['nazwa'].'</div>';              
											
                                        	}else{
                                    			$resk = mysqli_query($DB, "select * from dict_kraj where id=".$_SESSION['wysylka_kraj']);
                                    			$wierszk = mysqli_fetch_array($resk);
												echo '<div style="margin:0; border:none" id="kraj_dane_klienta" data-id="'.$wierszk['id'].'">'.$wierszk['nazwa'].'</div>';                                     	    		
                                        	}                                        	
                                            ?>

                                     </div>      
                                  </div>
                               </div>
                               

                            <div class="kasuj"></div>
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8  min_wys_dane_klienta_divinput1 float-label-div margin-top-tel">
                                        <?php
                                        if($_SESSION['id_zam']!=0){
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="tel" type="tel" value="'.$wiersz['telefon_zam'].'" required data-blad="0">
                                            <label for="tel" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'telefon'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_dane_klienta min_wys_dane_klienta_input1 input-float" id="tel" value="" type="tel" required data-blad="0">
                                            <label for="tel" class="min_wys_dane_klienta_label1">'.$txt->{'dane'}->{'telefon'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>      
                                  </div>
                               </div>
                               

                                <div class="kasuj"></div>
                               </form>
                          </div>
                       </div>
                        
            	<?php
            	    $daneklientaklasa = 'aktywnylink';
            	    include('./include/prawa.inc.php');
                ?>
                </div>
<!-- tu byla prawa kolumna -->




                <div class="kasuj"></div>
                
          
       
<!--       Przeniesiony adres wysylki z kroku WYSYLKA-->
  <div>
                          <div class="koszyk-tabela">
  
  <form id="form_wysylka" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>" data-blednedanekarty="<?=$txt->{'dane'}->{'blednedanekarty'}?>">
                               <div class="koszyk-tabela-poz-lewa min_wys_szer_wyslij_na_adres">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="label2"><?=$txt->{'wysylka'}->{'wyslijnaadres'}?></div>
                                  </div>
                               </div>
			<?php
			
                    	    $res = mysqli_query($DB, "SELECT * FROM zamowienie WHERE id=".$_SESSION['id_zam']);
                    	    $wiersz = mysqli_fetch_array($res);
                    	    $checked1 = '';
                    	    $checked2 = '';
                    	   if($wiersz['wysylka'] == 'odb'){
                    		$checked2 = 'checked="checked"';
                    	    }else{
                            $checked1 = 'checked="checked"';

                          }
                        ?>
                               
                               <div class="koszyk-tabela-poz-lewa">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                <div class="wysylka-kontener">
                                    <div class="min_wys_opcja_wysylka label3">
                                    <input <?=$checked1?> type="radio" name="iCheck" id="zam1" class="typ2" >
                                    <label class="min_wys_opcja_wysylka" for="zam1"><?=$txt->{'wysylka'}->{'zamawiajacego'}?></label>
                                    </div> 
                                    <div  class="min_wys_opcja_wysylka label3">                                   
                                    <input <?=$checked2?> type="radio" name="iCheck" id="zam2" class="typ2">
                                    <label class="min_wys_opcja_wysylka" for="zam2"><?=$txt->{'wysylka'}->{'wysylkanainnyadres'}?></label>
                                    </div>
                                </div>
                                                                  
                                  </div>
                               </div>
                               <div class="kasuj"></div>
                               
                               
                               <span class="odbiorca">
                               <div class="koszyk-nawigacja3 min_wys_dane_odb"><?=$txt->{'wysylka'}->{'daneadresata'}?>
                               </div>                                                                


                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['imie_odb']!=''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="imie_2" value="'.$wiersz['imie_odb'].'" type="text" required>
                                            <label  class="min_wys_dane_klienta_label1" for="imie_2">'.$txt->{'dane'}->{'imie'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="imie_2" value="" type="text" required>
                                            <label  class="min_wys_dane_klienta_label1" for="imie_2">'.$txt->{'dane'}->{'imie'}.'<span> *</span></label>';
                                        }
                                    	?>
                                     </div>
                                  </div>
                               </div>
                               
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['nazwisko_odb']!=''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="nazwisko_2" value="'.$wiersz['nazwisko_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="nazwisko_2">'.$txt->{'dane'}->{'nazwisko'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="nazwisko_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="nazwisko_2">'.$txt->{'dane'}->{'nazwisko'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>                                  
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                      
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['firma_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="firma_2" value="'.$wiersz['firma_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="firma_2">'.$txt->{'dane'}->{'firma'}.'</label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="firma_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="firma_2">'.$txt->{'dane'}->{'firma'}.'</label>';
                                        }
                                        ?>
                                     </div>
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
					<?php
                                        if($wiersz['email_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="email_2" value="'.$wiersz['email_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="email_2">'.$txt->{'dane'}->{'email'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka input-float" id="email_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="email_2">'.$txt->{'dane'}->{'email'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>                                  
                                  </div>
                               </div> 
                               <div class="kasuj"></div>
                               <div class="koszyk-tabela-poz-cal min_wys_dane_klienta_form2">
                                  <div class="koszyk-tabela-poz-cal-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['adres1_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="adres_2" value="'.$wiersz['adres1_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="adres_2">'.$txt->{'dane'}->{'adres'}.'<span> *</span></label>';
                                        }else{ 
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="adres_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="adres_2">'.$txt->{'dane'}->{'adres'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1">
                                        <?php
                                       
                                        if($wiersz['adres2_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1" id="adres2_2" value="'.$wiersz['adres2_odb'].'" type="text">';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1" id="adres2_2" value="" type="text">';
                                        }
                                        ?>
                                     </div>                                                                         
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-lewa-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['kod_pocztowy_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="kod_2" value="'.$wiersz['kod_pocztowy_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="kod_2">'.$txt->{'dane'}->{'kodpocztowy'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="kod_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="kod_2">'.$txt->{'dane'}->{'kodpocztowy'}.'<span> *</span></label>';
                                        }
                                        ?>
                                      
                                     </div>
                                  </div>
                               </div>
                               <div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-prawa-p">
                                     <div class="koszyk-formularz-f-9 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['miasto_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="miejscowosc_2" value="'.$wiersz['miasto_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="miejscowosc_2">'.$txt->{'dane'}->{'miejscowosc'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="miejscowosc_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="miejscowosc_2">'.$txt->{'dane'}->{'miejscowosc'}.'<span> *</span></label>';
                                        }
                                        ?>

                                     </div>                                  
                                  </div>
                               </div>       


                               <?php
                            	    if($wiersz['kraj_odb_id'] != 0){
                            		$where = ' where kraj_id='.$wiersz['kraj_odb_id'];
                            	    }else{
                            		$where = ' where kraj_id='.$_SESSION['wysylka_kraj'];
                            	    }
                            	    $resw = mysqli_query($DB, "select * from dict_wojewodztwo".$where);

                            	    if($ile_woj != 0){
                            	    
                               ?>
 				<div class="koszyk-tabela-poz-lewa">
                                  <div class="koszyk-tabela-poz-lewa-p min_wys_dane_klienta_form1">                              

                                    <label class="min_wys_dane_klienta_label1" for="woj_2"><?=$txt->{'dane'}->{'wojewodztwo'}?></label>
                                      
                                     <div style="margin:0" class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1">
                                       <select id="woj_2" class="min_wys_dane_klienta_input1">
                                    	    
                                    	    <?php
                                         
                                    		echo '<option data-id="0">'.$txt->{'dane'}->{'wybierz'}.'</option>';
											while($wierszw = mysqli_fetch_array($resw)){
                                    		    if($wiersz['wojewodztwo_odb_id'] == $wierszw['id']){
                                    			$selected = 'selected';
                                    		    }else{
                                    			$selected = '';
                                    		    }
                                        	    echo '<option '.$selected.' data-id="'.$wierszw['id'].'">'.$wierszw['nazwa'].'</option>';
                                        	}
                                            ?>
                                        </select>
                                     </div>                                  
                                  </div>
                               </div>

                               <?php
                            		}
				if($ile_woj != 0){
				?>
                               		<div class="koszyk-tabela-poz-prawa min_wys_dane_klienta_form1">
                                  	<div class="koszyk-tabela-poz-prawa-p">                                      
                                      	<label class="min_wys_dane_klienta_label1" for="kraj_dane_klienta"><?=$txt->{'dane'}->{'kraj'}?></label>
                                     	<div style="margin:0; border:none; -webkit-box-shadow:none; -moz-box-shadow:none; box-shadow:none;" class="koszyk-formularz-f-9 min_wys_dane_klienta_divinput1" style="border:none">
				<?php
				}else{
				?>
                               		<div class="koszyk-tabela-poz-lewa min_wys_dane_klienta_form1">
                                  	<div class="koszyk-tabela-poz-lewa-p">                                      
                                      	<label class="min_wys_dane_klienta_label1" for="kraj_dane_klienta"><?=$txt->{'dane'}->{'kraj'}?></label>
                                     	<div style="margin:0; border:none" class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1" style="border:none" >
				<?php
				}

                                        	if($wiersz['kraj_odb_id']!=''){
                                    			$resk = mysqli_query($DB, "select * from dict_kraj where id=".$wiersz['kraj_odb_id']);
                                    			$wierszk = mysqli_fetch_array($resk);
							echo '<div id="kraj_wysylka" data-id="'.$wierszk['id'].'">'.$wierszk['nazwa'].'</div>';                                    	    		
                                        	}else{
                                    			$resk = mysqli_query($DB, "select * from dict_kraj where id=".$_SESSION['wysylka_kraj']);
                                    			$wierszk = mysqli_fetch_array($resk);
							echo '<div id="kraj_wysylka" data-id="'.$wierszk['id'].'">'.$wierszk['nazwa'].'</div>';                                     	    		
                                        	}                                        	
                                            ?>

                                     </div>      
                                  </div>
                               </div>

                        	<div class="kasuj"></div>
                               <div class="koszyk-tabela-poz-cal min_wys_dane_klienta_form1">
                                  <div class="koszyk-tabela-poz-cal-p">
                                     <div class="koszyk-formularz-f-8 min_wys_dane_klienta_divinput1 float-label-div">
                                        <?php
                                        if($wiersz['telefon_odb'] != ''){
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="tel_2" value="'.$wiersz['telefon_odb'].'" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="tel_2">'.$txt->{'dane'}->{'telefon'}.'<span> *</span></label>';
                                        }else{
                                    	    echo '<input class="input_wysylka min_wys_dane_klienta_input1 input-float" id="tel_2" value="" type="text" required>
                                            <label class="min_wys_dane_klienta_label1" for="tel_2">'.$txt->{'dane'}->{'telefon'}.'<span> *</span></label>';
                                        }
                                        ?>
                                     </div>      
                                  </div>
                               </div>






                               </span>

			<?php
                    	    
                    	    $checked1 = '';
                    	    $checked2 = '';
                    	    if($wiersz['typ_platnosci_id'] == '' || $wiersz['typ_platnosci_id'] == 1){
                    		$checked1 = 'checked="checked"';
                    	    }else{
                    		$checked2 = 'checked="checked"';
                    	    }
                    	?>



                               <div>
                                  <div class="koszyk-tabela-poz-prawa-p">
                                    <div class="koszyk-formularz-f-20">
                                      <input class="dalej_dane_klienta" value="<?=$txt->{'daneklienta'}->{'dalej'}?>" type="submit">
                                    </div>                                 
                                  </div>
                               </div>                    
                               <div class="kasuj"></div>

                               </form>
                               </div>
                               </div>

<!--Koniec przeniesienia-->
            </div>
          </div> 
       </div>
  
  
   
	<?php
	    include('./include/stopka.inc.php');
	?>
    </div>
   
	<?php
	    include('./include/analytics.inc.php');
	?>
   </body>
</html>
