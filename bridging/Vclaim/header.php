<?php 
       $consid = "30432";
       $secretKey = "1lO0E588DC";
             // Computes the timestamp
              date_default_timezone_set('UTC');
              $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
               // Computes the signature by hashing the salt with the secret key as the key
       $signature = hash_hmac('sha256', $consid."&".$tStamp, $secretKey, true);
     
       // base64 encode�
       $encodedSignature = base64_encode($signature);
     
       // urlencode�
       // $encodedSignature = urlencode($encodedSignature);
     
       echo "X-cons-id: " .$consid ." ";
       echo "X-timestamp:" .$tStamp ." ";
       echo "X-signature: " .$encodedSignature;
    ?>
                                        