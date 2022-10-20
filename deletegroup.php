<?php 
	session_start();
	include ('database.php');

	$oldgroup=$_GET['groupname'];

	$insert=pg_query("SELECT \"Username\",\"GroupName\",\"GroupCommunicationWay\" from \"tblloginandregister\"");

		if(pg_num_rows($insert)>0){
			while($row = pg_fetch_array($insert)) 
			{
				$user=$row["Username"];
				// echo $user;
				// echo "<br>";
				// echo "<br>";
				$grouprecord=$row["GroupName"];

				$groupCway=$row["GroupCommunicationWay"];

				if(($grouprecord!=NULL)||($grouprecord!="")){

					$array=explode(",",$grouprecord);

					$arrayway=explode(",", $groupCway);

					$num=array_search($oldgroup,$array);

					unset($array[$num]);

					unset($arrayway[$num]);
						// print_r($array);
						// echo "<br>";
						// echo "<br>";

					$final=implode(",", $array);

					$finalway=implode(",",$arrayway);
					
					if(count($array)==0){
						// echo "string";
						// echo "<br>";
						// echo "<br>";
						$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL,\"GroupCommunicationWay\"=NULL WHERE \"Username\"='$user'");
						// echo "UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL WHERE \"Username\"='$user'";
						// echo "<br>";
						// echo "<br>";

					}
					else{

						$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"='$final',\"GroupCommunicationWay\"='$finalway' WHERE \"Username\"='$user'");
						// echo $resultvalue;
						// echo "<br>";
						// echo "<br>";
					}

					
				}
				else{
					$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL,\"GroupCommunicationWay\"=NULL WHERE \"Username\"='$user'");
				}
				
			}
			?>
				<script type="text/javascript">
					window.location.href="usergroups.php";
				</script>
			<?php
		}

?>