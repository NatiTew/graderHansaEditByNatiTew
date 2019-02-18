<?php
function saveFile($path, $finput,$foutput) {
$filename=$path.$filename;
header('Content-type: application/text');
header('Content-Disposition: attachment; filename="'.$fileout.'"');
readfile($filename);
}
?>
