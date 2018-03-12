<?php
  include 'connect.php';
  $convar=new connect();
  date_default_timezone_set("Asia/Kolkata");
  $pausestarttime =date('Y-m-d H:i:s');
  session_start();
  $uname= $_SESSION['login_user'];
  $taskid=$_POST['tID'];
  mysqli_query($convar->conn,"UPDATE taskdetails SET Counter = 0, Pauseflag='Pause',TaskStatus='In Progress' WHERE TaskID='$taskid'");
  $pausenum=mysqli_query($convar->conn,"SELECT PauseID FROM pausetask WHERE TaskID = '$taskid' ORDER BY PauseID DESC LIMIT 1;");
  $pausenumrow=mysqli_fetch_row($pausenum);
  mysqli_query($convar->conn,"UPDATE pausetask SET PauseStop = '$pausestarttime' WHERE TaskID='$taskid' AND PauseID='$pausenumrow[0]'");
  $pausetime=mysqli_query($convar->conn,"SELECT PauseStart,PauseStop From pausetask WHERE TaskID='$taskid' AND PauseID='$pausenumrow[0]'");
  $pausetimerow=mysqli_fetch_row($pausetime);
  $pausediff=mysqli_query($convar->conn,"SELECT TIMEDIFF('$pausetimerow[1]','$pausetimerow[0]') From pausetask WHERE TaskID='$taskid' AND PauseID='$pausenumrow[0]'");
  $pausediffrow=mysqli_fetch_row($pausediff);
  mysqli_query($convar->conn,"UPDATE pausetask SET diff = '$pausediffrow[0]' WHERE TaskID='$taskid' AND PauseID='$pausenumrow[0]'");
  $currdiff=mysqli_query($convar->conn,"SELECT SUM(TIME_TO_SEC(diff)) FROM pausetask WHERE TaskID='$taskid'");
  $currdiffrow=mysqli_fetch_row($currdiff);
  echo json_encode($currdiffrow[0]);
?>
