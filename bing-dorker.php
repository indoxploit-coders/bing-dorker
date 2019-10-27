<?php
set_time_limit(0);
//error_reporting(0);
// coded by Mr. Magnom 
// Re-Coded to Web Based by Mr. Error 404 - IndoXploit
// greetz to Mr. Magnom - Sanjungan Jiwa

// usage: php bing.php 'bing_dork' -> with ' (ex: php bing.php '"/admin/" site:com')

function getsource($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
$do = urlencode($argv[1]);
if(isset($argv[1])) {
	$npage = 1;
	$npages = 30000;
	$allLinks = array();
	$lll = array();
	while($npage <= $npages) {
	    $x = getsource("http://www.bing.com/search?q=".$do."&first=".$npage);
	    if($x) {
	        preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
	        foreach ($findlink[1] as $fl) array_push($allLinks, $fl);
	        $npage = $npage + 10;
	        if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0) break;
	    } else break;
	}
	$URLs = array();
	foreach($allLinks as $url){
	    $exp = explode("/", $url);
	    $URLs[] = $exp[2];
	}
	$array = array_filter($URLs);
	$array = array_unique($array);
	$sss = count(array_unique($array));
	//echo "ToTaL SiTe : $sss\n";
	//echo "--------------------------------------\n";
	foreach($array as $domain) {
		echo "http://$domain/\n";
	}
}
?>

# Thanks
