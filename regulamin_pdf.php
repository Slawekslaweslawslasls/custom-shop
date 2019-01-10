<?php
include('./include/settings.inc.php');

$file = './locales/'.$lang.'/szablony/'.$txt->{'zalaczniki'}->{'zal_regulamin'}.'.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'. basename($file) . '"');
header('Content-Length: ' . filesize($file));
readfile($file);
?>