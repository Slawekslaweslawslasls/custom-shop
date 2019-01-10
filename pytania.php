<?php
    include('./include/lib.inc.php');
    include('./include/settings.inc.php');
    include('./include/header.inc.php');
?>

    <body> 
<?php
    include('./include/ciasteczka.inc.php');
    
?>
       
    <div class="calosc">
       
	<?php
	    $aktywny1 = '';
	    $aktywny2 = 'aktywny';
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
                    <li><a href="pytania.html" class="aktywny"><?=$txt->{'naw'}->{'pytania'}?></a></li>      
                  </ul>                                              
                </div>

	<?php
	    $query = "select kp.id, kp.tresc, j.id as jezyk from kategoria_pytan kp, dict_jezyk j where kp.jezyk_id=j.id and j.skrot like '".$lang."'";
	    $res = mysqli_query($DB, $query);
	    while($wiersz = mysqli_fetch_array($res)){
                echo '<div class="pytanie pytanie-p">'.$wiersz['tresc'].'</div>';
		$query = "select * from pytanie p where kategoria_id=".$wiersz['id']." and jezyk_id=".$wiersz['jezyk'];
		$resp = mysqli_query($DB, $query);
		$i = 0;
		while($wierszp = mysqli_fetch_array($resp)){
		    $i++;
            	    echo '<div class="odpowiedz">
                	 <div class="odpowiedz-pkt">'.$i.'</div>
                	    <div class="odpowiedz-nag">
                	    '.$wierszp['pytanie'].'
                	    </div>
                	<div class="kasuj"></div>  
                     <div class="odpowiedz-text">
                	'.$wierszp['odpowiedz'].'
                    </div>
                                                   
            	    </div> ';
		}
	    }	
	?>
              
            </div>
          </div> 
       </div>

	<?php
	    include('./include/stopka.inc.php');
	?>

    </div>
	<?php
	    include('./include/analytics.inc.php');
	    include('./include/chat.inc.php');
	?>
   </body>
</html>