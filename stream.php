<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data: Time is {$time}\n";

ob_flush();
flush();
