<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
$result =  "The server time is: {$time}";
echo "data: " . json_encode($result) . "\n\n";
// echo "data: The server time is: {$time}\n\n";
flush();
// header('Content-Type: text/event-stream');
// header('Cache-Control: no-cache');
// echo "event: EventName\n\ndata: <div>Content to swap into your HTML page.</div>";
// flush();
?>