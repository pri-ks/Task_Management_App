<?php
	include 'connect.php';
    $convar=new connect();
    $c=$_POST['num'];
    $sttime = mysqli_query($convar->conn,"SELECT StartTime,TaskDate,Counter,Stopflag FROM taskdetails where taskID='$c'");
    $counterrow= mysqli_fetch_row($sttime);
    
    $currdiff=mysqli_query($convar->conn,"SELECT SUM(TIME_TO_SEC(diff)) FROM pausetask WHERE TaskID='$c'");
    $currdiffrow=mysqli_fetch_row($currdiff);
    if($currdiffrow[0]==null)
    {
     $counterrow[]="0";	
    }
    else{
    $counterrow[]=$currdiffrow[0];	
    }
    echo json_encode($counterrow);
?>    