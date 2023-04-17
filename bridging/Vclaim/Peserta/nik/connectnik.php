<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

<h1>PENCARIAN NIK </h1><hr>



<?php

include 'lz\LZContext.php';
include 'lz\LZData.php';
include 'lz\LZReverseDictionary.php';
include 'lz\LZString.php';
include 'lz\LZUtil.php';
include 'lz\LZUtil16.php';

$nik      = $_GET ['tnik'];

    
//signature
$consid = "30432";
$secretKey = "1lO0E588DC";
$userkey = "36acf42a02ba307a55a110bf2d85d079";
      // Computes the timestamp
       date_default_timezone_set('UTC');
       $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
$signature = hash_hmac('sha256', $consid."&".$tStamp, $secretKey, true);

// base64 encode�
$encodedSignature = base64_encode($signature);

//panggil
//echo "Time stamp : " .$tStamp."<br>";
//echo "signature : ".$encodedSignature."<hr>" ;

//kode dri postman
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nik/'.$nik.'/tglSEP/2023-02-08',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-cons-id:' .$consid,
    'X-timestamp: '. $tStamp,
    'X-signature: '. $encodedSignature,
    'user_key: ' .$userkey,
    
  ),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response. "<hr>";

//decrypt
function stringDecrypt($key, $string){
    

    $encrypt_method = 'AES-256-CBC';

    // hash
    $key_hash = hex2bin(hash('sha256', $key));

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

    return $output;
}
function decompress($string){

    return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);


}

//menampilkan hasil decrypt
$data = json_decode($response, true);
$kunci = $consid.$secretKey.$tStamp;
$nilairespon = $data["response"];
$hasilakhir = decompress(stringDecrypt($kunci, $nilairespon));
//echo "Respon Decrypt : " ."<br>"."<br>".$hasilakhir;

//parsing!!!

$content = utf8_encode ($hasilakhir);
$result = json_decode($content, true);
foreach ($result as $value) {

    echo "<hr>" . "Nama : " . $value['nama'] . "<br>";
    echo "No. Kartu : " . $value['noKartu'] . "<br>";
    echo "NIK : " . $value['nik'] . "<br>";
    echo "Tanggal Lahir : " . $value['tglLahir'];
}   


?>
<hr>
<a href="nik.php" class="btn btn-primary">Database</a>
</body>
</html> 