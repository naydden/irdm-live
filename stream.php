<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// We'll be using PHP_EOL instead of \n for multi-arch compatibility
// echo "id: " . time() . PHP_EOL;
// echo 'data: { "id": "' . time() . '", "latitude": "' . time() . '"}' . PHP_EOL;
// echo PHP_EOL;
// ob_flush();
// flush();

session_start();
if (isset($_SESSION['data'])) {
	// We'll be using PHP_EOL instead of \n for multi-arch compatibility
	echo "id: " . time() . PHP_EOL;
	echo 'data: { "id": "' . time() . '", "latitude": "' . $_SESSION['data'] . '"}' . PHP_EOL;
	echo PHP_EOL;
	ob_flush();
	flush();
}
