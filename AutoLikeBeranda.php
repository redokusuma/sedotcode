<?php
error_reporting(0);

$access_token = "access_token_HTC";


function hajar($lol, $dataNya = null) {
    $fak = curl_init();
    curl_setopt($fak, CURLOPT_URL, $lol);
    if($dataNya != null){
        curl_setopt($fak, CURLOPT_POST, true);
        curl_setopt($fak, CURLOPT_POSTFIELDS, $dataNya);
    }
    curl_setopt($fak, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($fak, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($fak, CURLOPT_SSL_VERIFYPEER, false);
    $adi = curl_exec($fak);
    curl_close($fak);
    return $adi;
}

$njaluk = hajar("https://graph.facebook.com/me/home?fields=id,from&limit=10&access_token=" . $access_token);
$stat = json_decode($njaluk, true);
$dataLog	 = "uid";

	if (file_exists($dataLog)){
			$log = json_encode(file($dataLog));
	} else {
			$log = '';
	}
	 

for($i=1;$i<=count($stat[data]);$i++){
	if(!ereg($stat[data][$i-1][id],$log)){
	$x=$stat[data][$i-1][id]."\n";
    $y=fopen($dataLog,'a');
    fwrite($y,$x);
    fclose($y);
		hajar('https://graph.facebook.com/'.$stat[data][$i-1][id].'/likes?method=post&access_token='.$access_token);
    }
}

?>
