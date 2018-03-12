<?php
session_start();
include 'connect.php';
include 'style.php';
$usrnm=$_SESSION['login_user'];
$glb=new global_function();
$query= $glb -> select("dmuser","Password,Email","Username='$usrnm'");
$oldpwd=$query[0][0];
echo'<body class="signuppg">
      <div class="container signupWrap">
      <div><img src="images/signup-bg.jpg"/></div>
      <form id="updateform" name="updateform" method="post" action="" class="signupformWrap">
        <div class="errormsgWrap">
          <div id="omail" class="form-control loginform-control">'.$query[0][1].'</div>
        </div>
        <div class="errormsgWrap">
          <input type="text" id="nmail" name="nmail" placeholder="New Email" class="form-control loginform-control" onkeyup="validateEmailFeild()">
          <p id="err1" class="para"></p>
        </div>
        <div class="errormsgWrap">
          <input type="password" id="opwd" name="pwd" placeholder="Current Password" class="form-control loginform-control" onkeyup="validateOldPasswordFeild()">
          <p id="err2" class="para"></p>
        </div>  
        <div class="errormsgWrap">
          <input type="password" id="npwd" name="npwd" placeholder="New Password" class="form-control loginform-control" onkeyup="validatePasswordFeild()">
          <p id="err3" class="para"></p>
        </div>  
        <input type="submit" class="formbtn" id= "updatebtn" name="updatebtn" value="UPDATE"/>
        <input type="submit" class="formbtn" name="backbtn" value="BACK"/>
      </form>
      </div>
    </body>';

    if (isset($_POST['updatebtn']))
    {   
      $passwd=$_POST['npwd'];
      $umail=$_POST['nmail'];
      $glb=new global_function();
      $query= $glb -> update("dmuser","Password='$passwd',Email='$umail'","Username='$usrnm'");
      echo "<script type='text/javascript'>alert('User Details Updated')</script>";
      echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";
    }
    if (isset($_POST['backbtn']))
    {
      echo "<script language='javascript' type='text/javascript'> location.href='dashboard.php' </script>";
    }
?>
<script type="text/javascript">
  var oldpwd= "<?php echo $oldpwd ?>";
  $('#updatebtn').click(function() {
    var is_valid=validateForm();
    if(is_valid == true){
    $('#updateform').submit();
  }
  else{
    return false;
  }
  });
        function validateEmail(email)
        {
            var re = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return re.test(email);
        }
        function validatePassword(pwd)
        {
            var re = new RegExp(/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{7,19}$/);
            return re.test(pwd);
        }
        function validateEmailFeild()
        { 
            var email;
            email= document.getElementById("nmail").value;
            var errmsg1=document.getElementById("err1");
            if (email == "")
            {
               errmsg1.className = "reqdmsg";
               errmsg1.innerHTML="Required";
               return false;
            }
            
            if(validateEmail(email) == true)
            {
               errmsg1.className = "msgnone";
               return true;
            }
            else
            {
               errmsg1.className = "reqdmsg";
               errmsg1.innerHTML="Invalid Email ID";
               return false;
            }
        }
        function validateOldPasswordFeild()
        {
           var errmsg2=document.getElementById("err2");
           if(document.getElementById("opwd").value!=oldpwd)
            {
               errmsg2.className = "reqdmsg";
               errmsg2.innerHTML="Password doesn't match our records";
               return false;
            }
            else
            {
               errmsg2.className = "msgnone";
               return true;
            }
        }
        function validatePasswordFeild()
        { 
            var pwd;
            pwd= document.getElementById("npwd").value;
            var errmsg3=document.getElementById("err3");
            if (pwd == "")
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="Required";
               return false;
            }
            if(pwd==oldpwd)
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="New Password similar to Old Password";
               return false;
            }
            if(validatePassword(pwd) == true)
            {
               errmsg3.className = "msgnone";
               return true;
            }
            else
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="Password must contain atleast 7 chars,1 letter,1 digit,1 special char & Max 19 chars";
               return false;
            }
        }
        function validateForm(event)
        {  
          validateEmailFeild();
          validateOldPasswordFeild();
          validatePasswordFeild();
          if(validateEmailFeild()==true && validateOldPasswordFeild()==true && validatePasswordFeild()==true){
            return true;
          }  
          else{
            return false
          }
        }
      </script>