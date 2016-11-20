<?php

print_r($_GET);

session_start();
foreach ($_GET as $key => $value) {
	$_SESSION[$key] = $value;
}
$_SESSION['event'] = "update";

print_r($_SESSION);
