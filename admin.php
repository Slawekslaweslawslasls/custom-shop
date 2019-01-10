<?php
$admin = 1;
    include('./include/lib.inc.php');
    include('./include/login.inc.php');
    include('./include/header.inc.php');
?>
<body>
<div id="zapisano" style="display:none;position:fixed;top:0px;left:0px;text-align:center;vertical-align:middle;width:100%;height:100%">
<div style="width:30%;height:30%;position:relative;top:30%;left:30%;border: solid thin black;background-color: white;vertical-align:middle"><span class="popupadmin"></span><br/><a href="#">OK</a></div>
</div>
<div><a href="https://<?=$_SERV?><?=$_PATH?>/wyloguj.html">Wyloguj się</a></div>
<select id="rodzajzam">
<option value="0">Wybierz rodzaj zamówienia</option>
<option value="1">Opłacone</option>
<option value="2">Nowe</option>
<option value="3">Wszystkie</option>
</select>
<div id="pokazzam">
</div>
</body>
