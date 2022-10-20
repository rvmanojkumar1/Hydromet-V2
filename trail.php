<?php
	$input='QlJWMGFNUDY3S0VSbFFITVZBQzBvUT09';
	$encrypt_method = "AES-256-CBC"; 
    $secret_key = 'This is my secret key'; 
    $secret_iv = 'This is my secret iv'; 

    // hash 
    $key = hash('sha256', $secret_key); 
     
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
    $iv = substr(hash('sha256', $secret_iv), 0, 16); 

    
     
        $output = openssl_decrypt(base64_decode($input), $encrypt_method, $key, 0, $iv);
    
        echo 'Username: admin  ';
    	echo 'password:';
    	echo $output;


    $input1='RWVHS1k1UzFoMlVRay9UWmNscHBJdz09';

    $ou1 = openssl_decrypt(base64_decode($input1), $encrypt_method, $key, 0, $iv);
    
    echo '  Username: GISFY@wxvisual.com';
    	echo '  Password:';
    	echo $ou1;

    $input2='';
   
?>