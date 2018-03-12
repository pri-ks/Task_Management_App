<?php
$perpage = 10;
if(isset($_GET["page"])){
$page = intval($_GET["page"]);
}
else {
$page = 1;
}
$calc = $perpage * $page;
$start = $calc - $perpage;
             
function pagination($page,$start,$perpage,$taskstatus,$category,$user,$pgname)
{
	if(isset($page))
	{
		
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
		
		$sql ="SELECT Count(*) FROM taskdetails where " .$taskstatus. "" .$category. "" .$user. "";
		
		$result = mysqli_query($convar->conn,$sql);
		$rows = mysqli_fetch_row($result);
		if($rows)
		{
			$total = $rows[0];
		}
		else{
			$total=0;
		}  
		$totalPages = ceil($total / $perpage);
		if($page > 1 )
		{
			$j = $page - 1;
			echo "<span class='pagitxt'><a id='page_a_link' href='$pgname?page=$j'>Prev</a></span>";
		}
		for($i=1; $i <= $totalPages; $i++)
		{
			if($totalPages !=1)
			{
			  if($i<>$page)
			  {
			    echo "<span class='pagitxt'><a id='page_a_link' href='$pgname?page=$i'>$i</a></span>";
			  }
			  else
			  {
				echo "<span class='pagitxt' id='page_links'>$i</span>";
			  }
			}  
		}
		if($page < $totalPages )
		{
			$j = $page + 1;
			echo "<span class='pagitxt'><a id='page_a_link' href='$pgname?page=$j'>Next</a></span>";
		}
	} 
}
