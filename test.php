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
                  
                  
                  $result = pg_query("SELECT \"Username\",\"Email\" FROM \"tblloginandregister\" where \"approved\"='1' and \"UserType\"!='Admin'");
                  ?>
               <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
               <title>User Management</title>
               <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
               <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
               <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
               <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
               <div style="width:100%;margin:auto">
                  <div style="width: 25%;float:left;clear:both;">
                     <br>
                     <ul style="list-style-type: none;margin: 0;padding: 0;width:200px;background-color: #f1f1f1;">
                        <li ><a href="NewRegistration.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/adduser.ico" width="25" height="25" > &nbsp;&nbsp;Add User</a></li>
                        <li><a href="approveuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;Approve User</a></li>
                        <li style="background-color:#0000ff"><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;<span style="color:white">Delete User</span></a></li>
                        <li><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
                        <li><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;Update Profile</a></li>
                     </ul>
                  </div>
                  <link rel="stylesheet" type="text/css" href="styles.css" />
                  <script language="javascript" src="users.js" type="text/javascript"></script>
                  <div style="width:70%;margin:auto">
                     <br />
                     <body>
                        <div class="panel panel-primary" style="width:70%;margin: 0 auto;"  >
                           <div class="panel-heading" style="background-color:#4A7BDF;color:white">
                              <center><b style="font-size:15px;font-family: arial;">Delete User</b></center>
                           </div>
                           <div class="panel-body">
                              <form name="frmUser" method="post" action="">
                                 <div style="width:70%;margin: 0 auto ; background-color: white">
                                    <table align="center" style="width:90%" class="w3-table-all">
                                       <tr class="listheader">
                                          <th style="background-color:#539CCC;color:white;text-align:center"></td>
                                          <th style="background-color:#539CCC;color:white;text-align:center">Username</td>
                                          <th style="background-color:#539CCC;color:white;text-align:center">Email</td>
                                       </tr>
                                       <?php
                                          $i=0;
                                          while($row = pg_fetch_array($result)) {
                                          if($i%2==0)
                                          $classname="evenRow";
                                          else
                                          $classname="oddRow";
                                          ?>
                                       <tr class="<?php if(isset($classname)) echo $classname;?>">
                                          <td style="text-align:center"><input type="checkbox" name="users[]" value="<?php echo $row["Username"]; ?>" ></td>
                                          <td style="text-align:center"><?php echo $row["Username"]; ?></td>
                                          <td style="text-align:center"><?php echo $row["Email"]; ?></td>
                                       </tr>
                                       <?php
                                          $i++;
                                          }
                                          ?>
                                    </table>
                                    <br>
                                    <center>
                                       <input type="button" name="delete" class="btn btn-danger" value="Delete"  onClick="setDeleteAction();" />
                                    </center>
                              </form>
                              </div>
                           </div>
</body>
</div>
</div>
</html>
</div>
</div>
</div>
</div>
</div>
</body>
</html>