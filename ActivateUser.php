<?php
   include 'style.php';
   include 'connect.php';
   $glb=new global_function();
   $oper=$_POST['oper'];
   $usrid=$_POST['usrid'];
   $usrrole=$_POST['usrrole'];
   if($oper=='add')
   {
   	$query= $glb -> update("dmuser","UserRole='$usrrole',Activateflag='1'","UserID='$usrid'");
   }
   if($oper=='del')
   {
	$query= $glb -> delete("dmuser","UserID='$usrid'");
   }
?>