<?php
  include 'connect.php';
  $convar=new connect();
  date_default_timezone_set("Asia/Kolkata");
  $pausestarttime = date('Y-m-d H:i:s');
  session_start();
  $uname= $_SESSION['login_user'];
  $taskid=$_POST['tID'];
  $ptime=$_POST['ptime'];
  $ptime=explode(':',$ptime,2);
  $sttime=mysqli_query($convar->conn,"SELECT StartTime,PauseCount from taskdetails WHERE TaskID='$taskid'"); 
  $sttimerow=mysqli_fetch_row($sttime);
  mysqli_query($convar->conn,"UPDATE taskdetails SET DaysElapsed = '$ptime[0]' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"UPDATE taskdetails SET TimeElapsed = '$ptime[1]' WHERE TaskID='$taskid'");
  $sttimerow[1]=$sttimerow[1]+1;
  mysqli_query($convar->conn,"UPDATE taskdetails SET Counter = 1, Pauseflag='Resume',TaskStatus='Halted' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"UPDATE taskdetails SET PauseCount = '$sttimerow[1]' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"INSERT INTO pausetask(TaskID,PauseStart) VALUES('$taskid','$pausestarttime')");    
?>