<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
	    if($_SESSION['ilosc'] == 0 || $_SESSION['id_zam'] == 0){
		header('Location: https://'.$_SERV.$_PATH.'/koszyk-pusty.html');
	    }
	    if(isset($_SESSION['imie']) && isset($_SESSION['nazwisko']) && isset($_SESSION['email'])){
		?>
		     <script type="text/javascript">
		        smartlook('tag', 'name', '<?=$_SESSION['imie']?> <?=$_SESSION['nazwisko']?>');
		        smartlook('tag', 'email', '<?=$_SESSION['email']?>');
		     </script>
		<?php
		unset($_SESSION['imie']);
		unset($_SESSION['nazwisko']);
		unset($_SESSION['email']);
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
					<li><a href="dane-klienta.html"><?=$txt->{'naw'}->{'daneklienta'}?></a></li>
					<li><a href="wysylka.html" class="aktywny"><?=$txt->{'naw'}->{'wysylka'}?></a></li>	
                  </ul>                                              
                </div>

    
                <div class="koszyk-s-lewa" style="width:100%">
                       


                       <div class="koszyk-tabela-nag">
                          <div class="koszyk-tabela">
								<!--
                               <div class="koszyk-nawigacja">
                                  <div class="koszyk-nawigacja-nr">2</div> <span><?=$txt->{'wysylka'}->{'wysylka'}?></span>
                               </div>
							   -->
                               <form id="form_wysylka" data-uwaga="<?=$txt->{'dane'}->{'uwaga'}?>" data-blednedanekarty="<?=$txt->{'dane'}->{'blednedanekarty'}?>">


                               <div class="koszyk-nawigacja3 min_wys_platnosc"><?=$txt->{'wysylka'}->{'platnosc'}?>
                                  
                               </div> 
                               <div class="koszyk-tabela-poz-cal-platnosci">
                                 <div class="koszyk-tabela-poz-cal-platnosci-poz">
                                    <a href="" id="aplatnosc">
                                    <div class="label3 min_wys_opcja_wysylka">
                                    <input <?=$checked1?> type="radio" name="platnosc" id="platnosc" class="typ2" >
                                    <label class="min_wys_opcja_wysylka" for="platnosc"><?=$txt->{'wysylka'}->{'kartakredytowa'}?></label>
                                    </br><img src="<?=$_SERV_CDN?>/grafika/visa-s.png?3" title="<?=$txt->{'wysylka'}->{'altvisa'}?>" alt="<?=$txt->{'wysylka'}->{'altvisa'}?>" id="logovisa">
                                    <img src="<?=$_SERV_CDN?>/grafika/mc-s.png?3" title="<?=$txt->{'wysylka'}->{'altmc'}?>" alt="<?=$txt->{'wysylka'}->{'altmc'}?>" id="logomc">
                                    <img src="<?=$_SERV_CDN?>/grafika/ae-s.png?3" title="<?=$txt->{'wysylka'}->{'altae'}?>" alt="<?=$txt->{'wysylka'}->{'altae'}?>"id="logoae">
									<img src="<?=$_SERV_CDN?>/grafika/dc-s.png?3" title="<?=$txt->{'wysylka'}->{'altdc'}?>" alt="<?=$txt->{'wysylka'}->{'altdc'}?>"id="logodc">
									<img src="<?=$_SERV_CDN?>/grafika/jcb-s.png?3" title="<?=$txt->{'wysylka'}->{'altjcb'}?>" alt="<?=$txt->{'wysylka'}->{'altjcb'}?>"id="logojcb">
									<img src="<?=$_SERV_CDN?>/grafika/dis-s.png?3" title="<?=$txt->{'wysylka'}->{'altdis'}?>" alt="<?=$txt->{'wysylka'}->{'altdis'}?>" id="logodis">
									<img src="<?=$_SERV_CDN?>/grafika/mae-s.png?3" title="<?=$txt->{'wysylka'}->{'altmae'}?>" alt="<?=$txt->{'wysylka'}->{'altmae'}?>"id="logomae">
                                    </div>
                                    </a>
                                    
                                    <span class="kartakredytowa">
                                    
                                    <span id="blednedanekarty"></span>
                                    
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-cal min_wys_wysylka_form1">
                                        <div class="koszyk-formularz-f-8 min_wys_wysylka_divinput1 float-label-div">
                                    	    <?php
                                    		echo '<input class="input_wysylka min_wys_wysylka_input1 input-float" id="wk" value="" type="text" autocomplete="cc-name" name="ccname" required>
                                            <label class="min_wys_wysylka_label1" for="wk">'.$txt->{'dane'}->{'imieinazwiskowlascicielakarty'}.' <span>*</span></label>';
                                    	    ?>
                                        </div>                                     
                                    </div>  
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz2-l min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                        <div class="koszyk-formularz-f-10 min_wys_wysylka_divinput1 float-label-div">
                                           <input class="input_wysylka min_wys_wysylka_input1 input-float" id="nrk" value="" type="number" autocomplete="cc-number" name="cardnumber" data-value="" required>                                    
                                            <label class="min_wys_wysylka_label1" for="nrk"><?=$txt->{'dane'}->{'numerkarty'}?> <span>*</span></label>
                                        </div> 
                                      </div>
                                    </div>  
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz2-p min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p float-label-div">                                        
                                        <div class="koszyk-formularz-f-11 min_wys_wysylka_divinput1 float-label-div">
                                           <input class="input_wysylka min_wys_wysylka_input1 input-float" id="kwk" value="" type="number" autocomplete="cc-csc" name="cvc" required>
                                            <label class="min_wys_wysylka_label1" for="kwk"><?=$txt->{'dane'}->{'kodweryfikacyjnykarty'}?> <span>*</span></label>
                                        </div>
                                          
                                          <br>
                                          <br>
                                           <div class="formularze-pomoc2">
                                               <div class="formularze-pomoc-text cvv">
                                                    <div class="formularze-pomoc-text-cala"><?=$txt->{'dane'}->{'cvvpomoc'}?>
                                                   </div>
                                               </div>                                    
                                           </div>
                                                                                
                                                                                                               
                                      </div>                                      
                                    </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-cal min_wys_wysylka_form2 margin-top-zero "><?=$txt->{'dane'}->{'datawaznosci'}?>
                                     
                                    </div>
                                                                        
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-l min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                         <label class="min_wys_wysylka_label1" for="mies"><?=$txt->{'dane'}->{'miesiac'}?></label>
                                         <div style="margin:0" class="koszyk-formularz-f-9 min_wys_wysylka_divinput1">
                                            <select id="mies" class="min_wys_wysylka_input1" autocomplete="cc-exp-month" name="ccmonth">
                                               <option data-id="0"><?=$txt->{'dane'}->{'wybierz'}?></option>
                                               <?php
                                            	    for($i = 1; $i <= 12; $i++){
                                            		echo '<option data-id="'.$i.'">'.str_pad($i,2,'0',STR_PAD_LEFT).'</option>';
                                            	    }
                                               ?>
                                             </select>
                                         </div>                                      
                                      </div>
                                    </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-p min_wys_wysylka_form1">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p">
                                         <label class="min_wys_wysylka_label1" for="rok"><?=$txt->{'dane'}->{'rok'}?></label>
                                         <div style="margin:0" class="koszyk-formularz-f-9 min_wys_wysylka_divinput1">
                                            <select id="rok" class="min_wys_wysylka_input1" autocomplete="cc-exp-year" name="ccyear">
                                               <option data-id="0"><?=$txt->{'dane'}->{'wybierz'}?></option>
                                               <?php
                                            	    $rok_biez = date("Y");
                                            	    for($i = $rok_biez; $i <= $rok_biez+10; $i++){
                                            		echo '<option data-id="'.$i.'">'.$i.'</option>';
                                            	    }
                                               ?>
                                             </select>
                                         </div>                                      
                                      </div>                                      
                                    </div> 
                                    <div class="kasuj"></div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-l">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-l-p">
                                                                                                                      
                                      </div>
                                    </div>
                                    <div class="koszyk-tabela-poz-cal-platnosci-poz-p">
                                      <div class="koszyk-tabela-poz-cal-platnosci-poz-p-p">
                                                                                        
                                      </div>                                      
                                    </div> 
                                    <div class="kasuj"></div>                                                                                                           
                                
                                    </span>
                                
                                 </div>
                                 <div class="koszyk-tabela-poz-cal-platnosci-poz-n">                                
                                    <a href="" id="aplatnosc2">
                                    <div class="label3 min_wys_opcja_wysylka">
                                    <input <?=$checked2?> type="radio" name="platnosc" id="platnosc2" class="typ2" >
                                    <label class="min_wys_opcja_wysylka" for="platnosc2"><?=$txt->{'wysylka'}->{'paypal'}?></label>
                                    <?php
                                	if($checked2 != ''){
                                	    echo '</br><img src="'.$_SERV_CDN.'/grafika/loga-p-2.jpg" title="'.$txt->{'wysylka'}->{'altpaypal'}.'" alt="'.$txt->{'wysylka'}->{'altpaypal'}.'" id="logopaypal">';
                                	}else{
                                	    echo '</br><img src="'.$_SERV_CDN.'/grafika/loga-p-2-s.jpg" title="'.$txt->{'wysylka'}->{'altpaypal'}.'" alt="'.$txt->{'wysylka'}->{'altpaypal'}.'" id="logopaypal">';
                                	}
                                    ?>
                                    
                                    </div>                                       
                                    </a>
                                 </div>

                               </div> 
                              <div class="koszyk-tabela-poz-kon">
                                    <a href="koszyk.html" class="powrot min_wys_szer_wysylka_powrot_przycisk"><?=$txt->{'wysylka'}->{'powrotdokoszyka'}?></a> 
                                    <a href="wysylka_dalej.html" class="zamawiam zapisz_dane_wysylki min_wys_szer_wysylka_zamawiam_przycisk" ><?=$txt->{'wysylka'}->{'zamawiam'}?></a>
                               </div>                    
                               <div class="kasuj"></div>

                               </form>
                          </div>
                       </div>
                        
                <?php
            	    $wysylkaklasa = 'aktywnylink';
            	    include('./include/prawa.inc.php');
                ?>
                </div>
<!-- tu byla prawa kolumna -->




                <div class="kasuj"></div>
                
          

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
