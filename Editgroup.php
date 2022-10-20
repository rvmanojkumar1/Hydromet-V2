<?php 
	session_start();
	include ('database.php');
	$id=$_GET['id'];

	$group=$_GET['group'];

	$oldgroup=$_GET['oldgroup'];

	$mainid=explode(';', $id);

	

	for($i=0;$i<count($mainid);$i++){
		$usertemp=explode('-', $mainid[$i]);
		$insert=pg_query("SELECT \"GroupName\",\"GroupCommunicationWay\" from \"tblloginandregister\" WHERE \"Username\"='$usertemp[0]'");

		if(pg_num_rows($insert)>0){
			while($row = pg_fetch_array($insert)) 
			{
				$grouprecord=$row["GroupName"];

				$groupCway=$row["GroupCommunicationWay"];

				if(($grouprecord!=NULL)||($grouprecord!="")){

					$array=explode(",",$grouprecord);

					$arrayway=explode(",", $groupCway);

					$num=array_search($oldgroup,$array);

					unset($array[$num]);

					unset($arrayway[$num]);

					array_push($array,$group);

					array_push($arrayway,$usertemp[1]);

					if(count($array)==0){
						
						$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL,\"GroupCommunicationWay\"=NULL WHERE \"Username\"='$usertemp[0]'");
					}
					else{
						
						$newgroup=implode(",",$array);

						$newgroupway=implode(",",$arrayway);

						$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"='$newgroup',\"GroupCommunicationWay\"='$newgroupway' WHERE \"Username\"='$usertemp[0]'");
					}
					
				}
				else{
					$result=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL,\"GroupCommunicationWay\"=NULL WHERE \"Username\"='$usertemp[0]'");

					$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"='$group',\"GroupCommunicationWay\"='$usertemp[1]' WHERE \"Username\"='$usertemp[0]'");
				}
				
			}
		}
		else{
			$result=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"=NULL,\"GroupCommunicationWay\"=NULL WHERE \"Username\"='$usertemp[0]'");

			$resultvalue=pg_query("UPDATE \"tblloginandregister\" SET \"GroupName\"='$group',\"GroupCommunicationWay\"='$usertemp[1]' WHERE \"Username\"='$usertemp[0]'");
		}
	}
	?>
		<script type="text/javascript">
			window.location.href="usergroups.php";
		</script>
	<?php
?>