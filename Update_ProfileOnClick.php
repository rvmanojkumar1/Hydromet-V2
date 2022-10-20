<?php
include_once 'database.php';
	
	if( isset($_POST['Email']) && isset($_POST['Organization']) && isset($_POST['Designation']) && isset($_POST['Officeno']) && isset($_POST['MobileNo']) && isset($_POST['Password']) && isset($_POST['ConfirmPwd']))
	{
        $UserType=$_POST['TypeOfUser'];
        $name=$_POST['Name'];
        $Eml=$_POST['Email'];
        $Org=$_POST['Organization'];
        $Des=$_POST['Designation'];
        $Office=$_POST['Officeno'];
        $Molno=$_POST['MobileNo'];
        $networkname=$_POST['mobilenetwork'];
        $pwd=encrypt_decrypt("encrypt",$_POST['Password']);
        $Cpwd=encrypt_decrypt("encrypt",$_POST['ConfirmPwd']);
		$User=$_POST['Username'];
		if($pwd===$Cpwd)
        {
			pg_query("update \"tblloginandregister\" set \"UserType\"='$UserType', \"Email\"='$Eml',\"organization\"='$Org', \"degisnation\"='$Des',\"officeno\"='$Office', \"mobileno\"='$Molno',\"Login_password\"='$pwd',\"Confirm_password\"='$Cpwd',\"Name\"='$name',\"Network\"='$networkname' where \"Username\"='$User'");
                    define("uploadimagedir", "profile_pic/");
                    $uploadfilepath = uploadimagedir.basename($_FILES["userprofilepic"]["name"]);
                    move_uploaded_file($_FILES["userprofilepic"]["tmp_name"], $uploadfilepath);
                    pg_query("update \"tblloginandregister\" set \"pic\"='$uploadfilepath' WHERE \"Username\"='$User'");
			header("Location:updateprofile.php?check=true");
		}
        else
        {
            header("Location:updateprofile.php?check=false");
        }
	}
	else
	{
		header("Location:updateprofile.php");
	}

	?>
	<?php 

function encrypt_decrypt($action, $string){ 
    $output = false; 

    $encrypt_method = "AES-256-CBC"; 
    $secret_key = 'This is my secret key'; 
    $secret_iv = 'This is my secret iv'; 

    // hash 
    $key = hash('sha256', $secret_key); 
     
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
    $iv = substr(hash('sha256', $secret_iv), 0, 16); 

    if( $action == 'encrypt' ) { 
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv); 
        $output = base64_encode($output); 
    } 
    else if( $action == 'decrypt' ){ 
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    } 

    return $output; 
} 
?>