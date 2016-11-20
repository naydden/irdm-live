<?php

	// localhost/IRIDIUM/4_POST/postTest_v2.php

# Read data from old launch

	$csv = array_map('str_getcsv', file('data-2016-04-03-mod.csv'));

	# Iridium (2016-04-03: valid lines from 47 to 1)

		# lat[:][5]
		# lat_NS[:][6]
		# long[:][7]
		# long_EW[:][8]
		# h_GPS[:][10]
		# T_BMP[:][12]
		# h_BOM[:][13]

    	$maxLine = 47;
    	$minLine = 1;

# Prepare array to be posted:

$messID = 1000;

for($i = $maxLine; $i >= $minLine; $i--) {

  	$messID++;
  	#echo $i." MessID: ".$messID."<br />";// do stuff

        # Edit lat/long values to be easily used:
            # 41 , 16.54882 ,N, 000 , 40.41885 ,E --> 41º16.54882 N, 000º40.41885 E

        $lat_deg = $csv[$i][5];
        $lat_min = $csv[$i][6];
        $lat_NS  = $csv[$i][7];

        $long_deg = $csv[$i][8];
        $long_min = $csv[$i][9];
        $long_EW  = $csv[$i][10];

        # DMStoDEC($deg,$min,$sec)
        $lat  = DMStoDEC(  $lat_deg,  $lat_min, 0 );
        $long = DMStoDEC( $long_deg, $long_min, 0 );

        $lat  = number_format($lat,  4, '.', '').$lat_NS;
        $long = number_format($long, 4, '.', '').$long_EW;


  	# Create array to post:
  	$data2post = array(
  		"momsn" 	=> $messID,
  		"lat" 		=> $lat,
		"long"		=> $long,
		"h_GPS"		=> $csv[$i][12],
		"T_BMP"		=> $csv[$i][14],
		"h_BMP"		=> $csv[$i][15]
  	);

 # Print it on screen:

    echo "Message ID: "	.$data2post['momsn']."<br />";
    echo "Coords: "		.$data2post['lat'].", ".$data2post['long']."<br />";
    echo "GPS height: "	.$data2post['h_GPS']."<br />";
    echo "BMP temp.: " 	.$data2post['T_BMP']."<br />";
    echo "BMP height: "	.$data2post['h_BMP']."<br /><br />";

 # Post it to page:

    $url = 'http://localhost/git/irdm-live/savePOST.php';

    post_to_url( $url , $data2post );

    sleep(10);
}

function post_to_url($url, $data) {
    $fields = '';
    foreach($data as $key => $value) { 
       $fields .= $key . '=' . $value . '&'; 
    }
    rtrim($fields, '&');

    $post = curl_init();

    curl_setopt($post, CURLOPT_URL, $url);
    curl_setopt($post, CURLOPT_POST, count($data));
    curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($post);

    curl_close($post);
}

function DMStoDEC($deg,$min,$sec) {

    // Converts DMS ( Degrees / minutes / seconds ) 
    // to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}  

?>
