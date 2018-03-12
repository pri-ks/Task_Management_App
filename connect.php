<?php
define('BASE_URL', 'http://192.168.2.7/Performance%20tracker/');
class connect
{
	public $conn="";
		
	function __Construct()
	{
		 $this->conn = new mysqli("localhost","root","root","teamdm");
	}
}
class global_function extends connect
{
	function __construct()
	{
		connect::__construct();
	}
	function insert($table,$field,$values)
	{
		$sql = "insert into ".$table." ( ".$field." ) values (".$values.")";
		$this->conn->query($sql) or die($this->conn->error);
	}
	function insertmulti($table,$field,$values)
	{
		$sql = "insert into ".$table." ( ".$field." ) values ".$values;
		$this->conn->query($sql) or die($this->conn->error);
	}	
	function select($table,$field,$condition)
	{
		$sql= "select ".$field." from ".$table." where ".$condition ;  
		//echo $sql."<b>END</b><br>";
		$result =  $this->conn->query($sql) or die($this->conn->error); 
  
		while ($row=$result->fetch_array(MYSQLI_NUM))
		{
			$data[]=$row;             
		}        
		return @($data);
	}	
	function login($table,$field_pass,$field_user,$post_pass,$post_user)
	{
		
		$x=$this->select($table,$field_pass,"$field_pass='$post_pass' AND $field_user='$post_user'");

		if($post_user =="" || $post_pass=="")
		{
			return "please enter valid username and password";
		}
		else if($x[0][0]!="" && $x[0][0] == $post_pass)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
	function update($table,$set,$condition){
		$sql= "update ".$table." set ".$set." where ".$condition ;
		echo $sql."<b>END</b><br>";
		$result =  $this->conn->query($sql) or die($this->conn->error);   
	}

	function delete($table,$condition){
		$sql = "delete from ".$table." where ".$condition;
		$this->conn->query($sql) or die($this->conn->error);
	}
}
?>
