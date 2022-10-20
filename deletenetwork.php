<?php
	include_once 'database.php';
		
	$id=$_GET['id'];

	if(isset($_GET['id'])){
		$stmt=pg_query("DELETE FROM \"tblNetwork\" WHERE \"Id\"='$id'");

		?>
			<script type="text/javascript">
				window.location.href='mobilenetwork.php';
			</script>
		<?php
	}
		
?>