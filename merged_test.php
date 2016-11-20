<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

while (true) {
	// $data = $_GET;

	if (isset($_GET)) {
	 	echo "id: " . $_GET['id'] . PHP_EOL;
		echo 'data: { "id": "' . $_GET['id'] . '", "latitude": "' . $_GET['key'] . '"}' . PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();

		unset($_GET);
	}
	sleep(1); // chill the server
}
