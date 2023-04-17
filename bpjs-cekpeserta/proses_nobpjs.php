<?php
error_reporting(0);
date_default_timezone_set('Asia/jakarta');
$tgl      = date ('Y-m-d');
$nobpjs = $_GET ['tnobpjs'];
$digitnoka = strlen($nobpjs);
if (is_numeric($nobpjs))
{
    if ($nobpjs != '' AND $digitnoka < 13)
    {
        header("location:index.php?pasien=$pasien&tipe=$tipe&pesan=nokakurang");
    }
    else
    {
//Proses Bridging
    include "lzstring/LZString.php";
    include "lzstring/LZReverseDictionary.php";
    include "lzstring/LZData.php";
    include "lzstring/LZUtil.php";
    include "lzstring/LZContext.php";

    $consid     = "";//Isi dengan CONS ID RS ANDA
    $secretKey  = "";//Isi dengan secret Key RS ANDA
    $userKey    = "";//Isi dengan Userkey RS Anda 

    date_default_timezone_set('UTC');

    $tStamp              = strval(time()-strtotime('1970-01-01 00:00:00'));
    $signature           = hash_hmac('sha256', $consid."&".$tStamp, $secretKey, true);
    $encodedSignature    = base64_encode($signature);
    $urlencodedSignature = urlencode($encodedSignature);


    $curl = curl_init();
    curl_setopt_array($curl, array(
      //Pakai NIK
      CURLOPT_URL => 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/Peserta/nokartu/'.$nobpjs.'/tglSEP/'.$tgl,      
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => 
      array('X-cons-id: '.$consid,
            'X-timestamp: '.$tStamp,
            'X-signature: '.$encodedSignature,
            'user_key: '.$userKey),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data     = json_decode($response, true);

    //function decrypt
    function stringDecrypt($key, $string){ 
        $encrypt_method = 'AES-256-CBC';
        $key_hash       = hex2bin(hash('sha256', $key));
        $iv             = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output         = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return $output;
    }
       
    // function lzstring decompress https://github.com/nullpunkt/lz-string-php
    function decompress($string){
        return LZString::decompressFromEncodedURIComponent($string);
    }

    $kunci          = $consid.$secretKey.$tStamp;
    $nilairespon    = $data["response"];
    $hasilakhir     = decompress(stringDecrypt($kunci, $nilairespon));
    //------------------------------------------------------PARSING-> comot datanya Donk ^_^
    echo "<br>";
    $content = utf8_encode($hasilakhir);
    $result  = json_decode($content, true);
    foreach ($result as $value) 
    {
      $mr = ($value['mr']);
      $status = ($value['statusPeserta']);
      $kelas  = ($value['hakKelas']);

  //JSON dibuat variabel  
      $nm_vc    = $value ['nama']; 
      $rm_vc    = $mr['noMR'];
      $status_vc= $status['keterangan'];
      $ket_kelas= $kelas['keterangan'];
          
      if ($status_vc=="AKTIF")
      {
         header("location:index.php?nik=$nik&rm_vc=$rm_vc&status=$status_vc&nama=$nm_vc&kelas=$ket_kelas&pesan=aktif");
      }
      else if ($status_vc!="AKTIF")
      {
        header("location:index.php?nobpjs=$nobpjs&pesan=tidakaktif&status=$status_vc");
      }
    }//End for each RESPONSE PESERTA Bridging
    
    //Comot message respon
    $content2 = utf8_encode($response);
    $result2  = json_decode($content2, true);
    foreach ($result2 as $value2) 
    {
        $code   = $value2['code'];
        $message= $value2['message'];
        if ($code=="201")
        {
           header("location:index.php?nobpjs=$nobpjs&pesan=tidakada&mes=$message");
        }
    }
  }
}   
else
{
    header("location:index.php?&pesan=huruf");
} 