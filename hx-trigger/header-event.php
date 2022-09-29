<?php
header('HX-Trigger: myEvent');
header('Cache-Control: no-cache');
flush();
?>