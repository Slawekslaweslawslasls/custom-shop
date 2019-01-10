<?php

include('./include/settings.inc.php');
unset($_SESSION['login']);
header("Location: https://" . $_SERV . $_PATH . "/admin.html");
?>