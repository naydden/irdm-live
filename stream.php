<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// We'll be using PHP_EOL instead of \n for multi-arch compatibility
echo "id: " . time() . PHP_EOL;
echo 'data: { "id": "' . time() . '", "latitude": "' . time() . '"}' . PHP_EOL;
echo PHP_EOL;
ob_flush();
flush();
