<?php
$urls = array();
/*
blog - 7302
job - 1066
*/
for ($i=1000; $i <1067 ; $i++) { 
	$urls[]='http://www.dotcpp.com/job/'.$i.'.html';
}

$api = 'http://data.zz.baidu.com/urls?appid=1594285795622820&token=c9Y8XBtZcyhVEJsB&type=batch';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;
?>