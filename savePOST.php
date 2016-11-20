<?php
	
	// localhost/IRIDIUM/4_POST/savePOST.php

	$refName = "savePOST";
	
	function hex2str($hex) {
	    $str = '';
	    for($i=0;$i<strlen($hex);$i+=2) $str .= chr(hexdec(substr($hex,$i,2)));
	    return $str;
	}

	# Open (or create) file to write data
		$filename = "./".$refName."-data.csv";
		
		# Chek if file exists
			if ( file_exists($filename) ) {
			    $file = fopen( $filename, "a" );
			} else {
			    $file = fopen( $filename, "a" );
    			fwrite( $file,
					"HTTP_UTC,".
					"momsn,".
					"lat,".
					"long,".
					"h_GPS,".
					"T_BMP,".
					"h_BMP".
					"\n" );
			}

		# Check if file has been correctly opened
		if( $file == false ) {
	    	echo ( "Error opening new file." );
	    	http_response_code(404);
			exit();
		}

	# HTTP time zone
		date_default_timezone_set("UTC");
	
	# Variables
		$httpUTC = date("Y-m-d H:i:s", time());

		$momsn 	= $_REQUEST['momsn'];
		$lat 	= $_REQUEST['lat'];
		$long 	= $_REQUEST['long'];
		$h_GPS 	= $_REQUEST['h_GPS'];
		$T_BMP 	= $_REQUEST['T_BMP'];
		$h_BMP 	= $_REQUEST['h_BMP'];

	session_start();
	$_SESSION['data'] = time();

	# Write file
		fwrite( $file,
			$httpUTC.",".
			$momsn.",".
			$lat.",".
			$long.",".
			$h_GPS.",".
			$T_BMP.",".
			$h_BMP.
			"\n" );
	
	fclose( $file );

?>
