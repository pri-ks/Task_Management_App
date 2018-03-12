<?php
if(isset($_SESSION))
{
session_destroy();
}
session_start();
 include 'style.php';
echo'<body class="loginpg">
      <div class="container loginwrap">
      <div class="loginimg col-md-6">
      </div>
      <div class="loginformWrap col-md-4">
      <div class="logtoptxt"><span>ALREADY MEMBERS</span></div>
        <form id="loginform" name="loginform" method="post" action="">
          <div class="errormsgWrap">
            <input type="text" id="uname" name="username" placeholder="Username" class="form-control loginform-control" onkeyup="validateDetails()">
            <p id="serr1" class="para"></p>
          </div>
          <div>
            <input type="password" id="upwd" name="passwd" placeholder="Password" class="form-control loginform-control onkeyup="validatepassdetails()">
            <p id="serr2" class="para"></p>
          </div>
            <input type="submit" class="formbtn" name="loginbtn" value="SIGN IN"/>
            <input type="button" class="formbtn" name="signupbtn" value="SIGN UP"/>
          <div id="loginerror" class="loginerrormsg"></div>  
        </form>
        </div>
      </div>';
      
    if (isset($_POST['loginbtn']))
    { 
      include("connect.php");
      $username=$_POST['username'];
      $passwd=$_POST['passwd'];
      $_SESSION['login_user']=$username;
        $glb=new global_function();
        $query= $glb -> select("dmuser","Username,UserRole,Activateflag","Username='$username' and Password='$passwd'");
        $_SESSION['login_user_role']=$query[0][1];
        if ($query != null && $query[0][1] == 'Superadmin' && $query[0][2] == '1')
        {
          echo "<script language='javascript' type='text/javascript'> location.href='admindashboard.php' </script>"; 
        }
        else if ($query != null && $query[0][2] == '1')
        {
          echo "<script language='javascript' type='text/javascript'> location.href='dashboard.php' </script>"; 
        }
        else if($query != null && $query[0][2] == '0')
        {
          echo "<script type='text/javascript'>
                $('#loginerror').css('display','block');
                $('#loginerror').text('Admin Approval pending');
                </script>";
        }
        else
        {
          echo "<script type='text/javascript'>
                $('#loginerror').css('display','block');
                $('#loginerror').text('Invalid Credentials');
                </script>";
        }
    }
?>
<script type="text/javascript">
  $('#loginform').submit(function(){
    if(validateDetails()==false || validatepassdetails()==false)
    {
      return false;
    }
  });
   $('input[name="signupbtn"]').click(function(){
    window.location.href='signup.php';
  });
 function validateDetails()
{ 
  var ufield;
  ufield= document.getElementById("uname").value;
  var errmsg1=document.getElementById("serr1");
  if (ufield == "")
  {
    errmsg1.className = "reqdmsg";
    errmsg1.innerHTML="Enter Username";
    return false;
  }
  else
  {
    errmsg1.className = "msgnone";
    return true;
  }  
}
function validatepassdetails()
{ 
  var ufield;
  ufield= document.getElementById("upwd").value;
  var errmsg1=document.getElementById("serr2");
  if (ufield == "")
  {
    errmsg1.className = "reqdmsg";
    errmsg1.innerHTML="Enter Password";
    return false;
  }
  else
  {
    errmsg1.className = "msgnone";
    return true;
  }  
}
</script>

