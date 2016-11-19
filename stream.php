<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

echo "id: " . time() . PHP_EOL;
echo "data: " . date("h:i:s", time()) . PHP_EOL;
echo "extra: hell" . PHP_EOL;
echo PHP_EOL;
ob_flush();
flush();

// or \n instead of PHP_EOL (multi-arch)

// will send multiple fields over JSON
