<?php
$lagu_id = (int) $_GET['lagu_id'];
$url="https://lms02.-----.id/aris2020/api/lagu/?lagu_id=$lagu_id";
 
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($curl);
curl_close($curl);
echo $response; 
?>