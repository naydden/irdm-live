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

// if (isset($_SESSION['data'])) {
// 	// We'll be using PHP_EOL instead of \n for multi-arch compatibility
// 	echo "id: " . time() . PHP_EOL;
// 	echo 'data: { "id": "' . time() . '", "latitude": "' . $_SESSION['data'] . '"}' . PHP_EOL;
// 	echo PHP_EOL;
// 	ob_flush();
// 	flush();
// } else {
// 	echo 'data: { "id": "NoSession" }' . PHP_EOL;
// 	echo PHP_EOL;
// 	ob_flush();
// 	flush();
// }

// while(true) {
// 	echo "id: " . time() . PHP_EOL;
// 	echo 'data: { "id": "' . time() . '", "latitude": "' . $_SESSION['data'] . '"}' . PHP_EOL;
// 	echo PHP_EOL;
// 	ob_flush();
// 	flush();	
// }

// session_start();
// $data = $_SESSION['data'];

while(true) {
	// $data = $_SESSION['data'];
	session_start();
	// if (isset($_SESSION['data']))
	if ($_SESSION['event'] == "update") {
	 	echo "id: " . $_SESSION['id'] . PHP_EOL;
		echo 'data: { "id": "' . $_SESSION['id'] . '", "latitude": "' . $_SESSION['event'] . '"}' . PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();

		// $_SESSION['event'] == "";
		unset($_SESSION['event']); // could use $_SESSION['data'] itself
	} /*else {
		echo 'data: { "id": "waiting" }' . PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();
	}*/
	session_write_close();
	sleep(1); // chill the server
}

// We need to send all previous data onopen and only updates onevent
