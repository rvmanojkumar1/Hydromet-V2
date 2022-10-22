
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
							?>
</head>

<body class="cnt-home">  
							<?php
								include("includes/adminheader.php");
							?>
   	
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-12 sidebar"> 
	 <div style="height:100%">






<?php
include_once 'database.php';

if(isset($_GET['check']))
{
	if($_GET['check']==='true')
	{
		echo "<script>alert('Profile Updated')</script>";
	}
	else
	{
		echo "<script>alert('Password Mis-match')</script>";
	}
}
$result = pg_query("SELECT \"Username\",\"Email\",\"UserType\" FROM \"tblloginandregister\" where \"approved\"='1'  and \"enabled\"= 'true'");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Management</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<style>



/* Change the link color on hover */
li a:hover {
    background-color: #555;
    color: white;
}
li a:active{
background-color: #0000ff;
    color: white;
}
*{
    font-family: arial;
}

</style>
<script type="text/javascript">
function validateEmail(sEmail) {
var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}

function UpdateProfile()
{
     if (document.getElementById('Username').value=='Select Username') 
    {
        alert('Please Select Username');
        return;
    }
    else{
	if(confirm("Are You sure You want To update?"))
	{
		document.frmUser.action="Update_ProfileOnClick.php";
		document.frmUser.submit();
    }
    }
}

function OnUserSelect()
{

	document.frmUser.action="updateprofile.php";
	document.frmUser.submit();
}
</script>
<script type="text/javascript">
function ShowImagePreviewonupdate(input) {
            if (input.files && input.files[0]) {
                var f=input.value.replace(/.*[\/\\]/, '');
                console.log(f);
                var reader2 = new FileReader();
                reader2.onload = function (e) {
                    document.getElementById("profile_pic").src=e.target.result;
                };
                reader2.readAsDataURL(input.files[0]);
                }
            }
</script>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
 

<body>
<div style="width:100%;margin:auto">
<div style="width: 25%; color: #bbb;float:left;clear:both;font-family: arial;">
<br>
<ul style="list-style-type: none;margin: 0;padding: 0;width:200px;background-color: #f1f1f1;">
    <li ><a href="NewRegistration.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/adduser.ico" width="25" height="25" > &nbsp;&nbsp;Add User</a></li>
    <li><a href="approveuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;Approve User</a></li>
    <li><a href="usergroups.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/users.png" width="25" height="25" > &nbsp;&nbsp;User Groups</a></a></li>
    <li><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
    <li ><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
    <li style="background-color:#0000ff"><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;<span style="color:white">Update Profile</span></a></li>
    <li ><a href="mobilenetwork.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/settings.png" width="25" height="25" > &nbsp;&nbsp;Mobile Networks</a></li>
</ul>
			
</div>
<br>
<div style="width:75%;margin:auto">

 <div class="panel panel-primary" style="width:70%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial;">Update Profile</b></center></div>
  <div class="panel-body">

<form name="frmUser" method="post" enctype="multipart/form-data" action="Update_ProfileOnClick.php">
<div style="width:100%">
<table style="width:95%;margin: auto;">
    
<tr>
<td style="width:70%">
<select name="Username" id="Username" style="width:100%;height:35px" Class="form-control" Required oninvalid="this.setCustomValidity('Please Select User!')" onChange="OnUserSelect()">
<option value="Select Username">Select Username</option>
<?php
if(pg_num_rows($result)>0)
{
	$User=pg_fetch_all($result);
	foreach($User as $ListOfUser)
	{
?>
<option value="<?php echo $ListOfUser['Username'] ?>" <?php if(isset($_POST["Username"])){if($_POST["Username"]===$ListOfUser['Username']){ echo 'selected';}} ?>><?php echo $ListOfUser['Username'] ?></option>
<?php
	}
}
?>

</select>
</td>
<?php
if(isset($_POST['Username']))
{
    $UserN=$_POST['Username'];
    $SelectDetail=pg_query("select * from \"tblloginandregister\" where \"Username\"='$UserN' and \"approved\"='1'");
    if(pg_num_rows($SelectDetail))
    {
    $Detail=pg_fetch_array($SelectDetail);
    
    ?>
<td rowspan="6" style="width:30%;padding-left:70px">
    <label style="font-size: 12px;">Upload Image </label><label style="font-weight:1;font-size: 9px;"> (Max 10Mb)</label>
            <img  Style="width:130px;height:150px;background-color:gainsboro;" id="profile_pic" name="profile_picname" Class="img-thumbnail" src='<?php
        if($Detail[9]==true){
            echo $Detail[9]; 
        
        }
        else{
            echo "blankImage.png";
            
        }?>'        />
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
        <input type="file" name="userprofilepic" accept="image/*" onChange="ShowImagePreviewonupdate(this);" Style="width:130px;"/>
</td>
</tr>

<tr><td colspan="1"><br /></td></tr>
<tr>
<td colspan="1" style="width:70%">
<select name="TypeOfUser" id="TypeOfUser"  style="width:100%;height:35px" Class="form-control" Required oninvalid="this.setCustomValidity('Please select type of user!')" >
<option value="Select type of User">Select type of User</option>
<option value="Admin" <?php if(isset($Detail["UserType"])){if($Detail["UserType"]==='Admin'){ echo 'selected';}} ?>>Admin</option>
<option value="Normal" <?php if(isset($Detail["UserType"])){if($Detail["UserType"]==='Normal'){ echo 'selected';}} ?>>Normal</option>
</select>
<br /></td>    
</tr>
<tr>
    <td colspan="1" style="width:70%">
    <input type="text" name="Name" id="Name" value="<?php echo $Detail["Name"]; ?>" placeholder="Name" Class="form-control"  Required></input>
    <br /></td>
</tr>

<tr>
<td colspan="1">
<input type="Email" name="Email" id="Email" value="<?php echo $Detail["Email"]; ?>" placeholder="E-mail" Class="form-control" style="width:100%"  Required  oninvalid="this.setCustomValidity('Please Enter Email!')" oninput="setCustomValidity('')"></input>
</td>
 </tr>
 <tr><td colspan="1"><br /></td></tr>
<tr>
<td colspan="2">

      <select style="height: 40px;color:gray" name="Organization"  Class="form-control" id="organization"  Required  oninvalid="this.setCustomValidity('Please Select Organization!')" oninput="setCustomValidity('')"/>
              <option value="" disabled selected>Select Company</option>

<?php $org_set=pg_query("select \"Name\" from \"tblCompany\""); 
while ($row=pg_fetch_array($org_set)) {
  ?>
  <option value="<?php echo $row[0];?>" <?php if(trim($Detail["organization"])==trim($row[0])){ echo "selected";} ?>>
    
<?php echo $row[0];?></option>
<?php
  }
?>


             </select>

</td>
 </tr>
 <tr><td colspan="2"><br /></td></tr>
 <tr>
<td colspan="2">
<input type="text" placeholder="Designation" value="<?php echo $Detail["degisnation"]; ?>" name="Designation" Class="form-control" style="width:100%"  Required  oninvalid="this.setCustomValidity('Please Enter Designation!')" oninput="setCustomValidity('')"></input>
</td>
 </tr>
 <tr><td colspan="2"><br /></td></tr>
 <tr>
        <td colspan="2">
            <input type="text" placeholder="Office no." value="<?php echo $Detail["officeno"]; ?>" Class="form-control" name="Officeno" ></input>
        </td>
    </tr>
    <tr><td colspan="2"><br /></td></tr>

    <tr>
        <td colspan="2">
            <select name="mobilenetwork"  Class="form-control" id="mobilenetwork"  placeholder="Office No">
                  <option value='' <?php if(isset($Detail["Network"])){if($Detail["Network"]==""){ echo 'selected Disabled';}}else{ echo 'selected Disabled'; } ?>>Mobile Network Provider</option>
                  <?php
                    $sqlnew=pg_query("SELECT \"Id\",\"Network\" FROM \"tblNetwork\"");

                    if(pg_num_rows($sqlnew)>0){
                        while ($rownew=pg_fetch_array($sqlnew)) {
                            ?>
                                <option value="<?php echo $rownew[0] ?>" <?php if(isset($Detail["Network"])){if($Detail["Network"]=="$rownew[0]"){ echo 'selected';}} ?>><?php echo $rownew[1] ?></option>
                            <?php
                        }
                    }
                  ?>
              </select>
        </td>
    </tr>
    <tr><td colspan="2"><br /></td></tr>
    <tr>
        <td colspan="2">
            <input type="text" placeholder="Mobile no." value="<?php echo $Detail["mobileno"]; ?>" Class="form-control" name="MobileNo"  Required  oninvalid="this.setCustomValidity('Please Enter Mobile No!')" oninput="setCustomValidity('')"></input>
        </td>
    </tr>
    <tr><td colspan="2"><br /></td></tr>

	
	<tr>
        <td colspan="2">
            <input type="password" placeholder="Password" value="<?php echo encrypt_decrypt("decrypt",trim($Detail["Login_password"])); ?>" Class="form-control" name="Password"  Required  oninvalid="this.setCustomValidity('Please Enter Password!')" oninput="setCustomValidity('')"></input>
        </td>
    </tr>
    <tr><td colspan="2"><br /></td></tr>
    <tr>
        <td colspan="2">
     
            <input type="password" placeholder="Confirm Password" value="<?php echo encrypt_decrypt("decrypt",trim($Detail["Confirm_password"])); ?>" Class="form-control" name="ConfirmPwd"  Required  oninvalid="this.setCustomValidity('Please Confirm Password!')" oninput="setCustomValidity('')"></input>
        </td>
    </tr>
    <?php
}
}
    ?>
    <tr><td colspan="2"><br /></td></tr>
	
    <tr>
<td colspan="2">
<center>
    <input type="submit" class="btn btn-success"  style="width: 80px;height: 40px" name="Update"  value="Update" ></input>
    </center>
</td>
    </tr>
</table>
</div>

</form>
</div>
</div>
</div>
</div>

</body>
</html>




	</div>
	</div>
	</div>
	</div>
	</div>

</body>
</html>
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