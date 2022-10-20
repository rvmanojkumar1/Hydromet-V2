<?php
include ('database.php');
//   session_start();
//   include_once 'editCompany.php';

// $company=$_SESSION["company"];

?>
<!DOCTYPE php>

<head>
	
							<?php
// 							$time = microtime(TRUE);
// $mem = memory_get_usage();
								include("includes/link.php");
							?>

</head>

<body class="cnt-home">  
							<?php
								include("includes/header.php");
							?>
   	
	
							<?php
							
								include("includes/homepage.php");
							
// 								print_r(array(
//   'memory' => (memory_get_usage() - $mem) / (1024 * 1024),
//   'seconds' => microtime(TRUE) - $time
// ));
				
							?>
		
  
</body>
</html>