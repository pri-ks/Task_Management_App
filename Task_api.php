<?php
 // API Call
 function curlcall($start,$perpage,$taskstatus,$cat,$user)
{
  $url ="".BASE_URL."FilterTasks.php?start=" .$start."&perpage=".$perpage."&taskstatus=".$taskstatus."&category=".$cat."&selecteduser=".$user."";
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);
  return $response;
}              

