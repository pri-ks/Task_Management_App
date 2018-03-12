<?php
session_start();
include "connect.php";

	$st=$_GET['start'];
	$pp=$_GET['perpage'];
	$taskstatus=$_GET['taskstatus'];
	$category=$_GET['category'];
	$user=$_GET['selecteduser'];
	
	if($taskstatus=='default'){
		$taskstatus='1 AND ';
	}
	else{
		$taskstatus='TaskStatus=\''.$taskstatus.'\' AND ';
	}
	if($category=='default'){
		$category='1 AND ';
	}
	else{
		$category='TaskCategory=\''.$category.'\' AND ';
	}
	if($user=='default'){
		$user='1';
	}
	else{
		$user='Username=\''.$user.'\'';
	}

	$convar  = new connect();
	$items = getItems($convar,$st,$pp,$taskstatus,$category,$user);
	if(empty($items))
	{
		jsonResponse(NULL);
	} else
	{
		jsonResponse($items);
	}
	function jsonResponse($data)
	{
		$json_response = json_encode($data);
		echo $json_response;
	}
	function getItems($convar,$st,$pp,$taskstatus,$category,$user)
	{
		$sql = "SELECT * FROM taskdetails where " .$taskstatus. "" .$category. "" .$user. " order by TaskID desc limit $st,$pp";
		$resultset = mysqli_query($convar->conn, $sql);
		$data = array();
		while($rows = mysqli_fetch_assoc($resultset) ) {
			$data[] = $rows;
		}
		return $data;
	}	
		