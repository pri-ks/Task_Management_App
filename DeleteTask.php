<?php
include 'connect.php';
	$convar=new connect();
	$tid=$_GET['d'];
    mysqli_query($convar->conn,"DELETE FROM taskdetails where taskID='$tid'");
    echo "<script type='text/javascript'>window.location='dashboard.php'</script>"; 
?>