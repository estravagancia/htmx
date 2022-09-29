<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$details = array();
$details['name'] = "john doe";
echo "data: " . json_encode($details) . "\n\n";
flush();
?>