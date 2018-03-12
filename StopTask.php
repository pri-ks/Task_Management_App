<?php
  include 'connect.php';
  $convar=new connect();
  date_default_timezone_set("Asia/Kolkata");
  $stoptime = date('Y-m-d H:i:s');
  session_start();
  $uname= $_SESSION['login_user'];
  $taskid=$_POST['tID'];
  $stime=$_POST['stime'];
  $stime=explode(':',$stime,2);
  mysqli_query($convar->conn,"UPDATE taskdetails SET DaysElapsed = '$stime[0]' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"UPDATE taskdetails SET TimeElapsed = '$stime[1]' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"UPDATE taskdetails SET StopTime = '$stoptime' WHERE TaskID='$taskid'");
  mysqli_query($convar->conn,"UPDATE taskdetails SET Stopflag = 1,TaskStatus='Completed' WHERE TaskID='$taskid'");
  echo json_encode($stoptime);
?>