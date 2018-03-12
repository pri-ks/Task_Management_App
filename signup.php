<?php
include 'connect.php';
include 'style.php';
echo'<body class="signuppg">
      <div class="container signupWrap">
      <div><img src="images/signup-bg.jpg"/></div>
      <form id="loginform" name="loginform" method="post" action="" class="signupformWrap">
        <div class="errormsgWrap">
          <input type="text" id="uid" name="uid" placeholder="UserID" class="form-control loginform-control" onkeyup="validateUseridFeild()">
          <p id="err1" class="para"></p>
        </div>
        <div class="errormsgWrap">
          <input type="text" id="uname" name="uname" placeholder="Username" class="form-control loginform-control" onkeyup="validateUsernameFeild()">
          <p id="err2" class="para"></p>
        </div>
        <div class="errormsgWrap">  
          <input type="text" id="umail" name="umail" placeholder="Email" class="form-control loginform-control" onkeyup="validateEmailFeild()">
          <p id="err3" class="para"></p>
        </div>
        <div class="errormsgWrap">
          <input type="password" id="pwd" name="pwd" placeholder="Password" class="form-control loginform-control" onkeyup="validatePasswordFeild()">
          <p id="err4" class="para"></p>
        </div>  
        <input type="submit" class="formbtn" id= "createbtn" name="createbtn" value="CREATE ACCOUNT"/>
        <input type="submit" class="formbtn" name="backbtn" value="BACK"/>
      </form>
      </div>
    </body>';
    $id_arr=[]; $name_arr=[];
    $glb=new global_function();
    $query= $glb -> select("dmuser","UserID,Username","1");
    if($query !=null)
    {
      foreach($query as $key => $res)
      {
        $id_arr[$key]=$res[0];
        $name_arr[$key]=$res[1];
      }
    }
    if (isset($_POST['createbtn']))
    {   
      $userid=$_POST['uid'];
      $username=$_POST['uname'];
      $passwd=$_POST['pwd'];
      $umail=$_POST['umail'];
      if( $username != null && $passwd != null && $umail !=null)
      {
        $glb=new global_function();
        $query= $glb -> insert("dmuser","UserID,Username,Password,Email","'$userid','$username','$passwd','$umail'");
        echo "<script type='text/javascript'>alert('New User Request Sent')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";
      }
      else
      {
        echo "<script type='text/javascript'>alert('Empty values not allowed')</script>";
      } 
    }
    if (isset($_POST['backbtn']))
    {
      echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";
    }
?>

<script type="text/javascript">
  var idval = <?php echo json_encode($id_arr); ?>;
  var nameval = <?php echo json_encode($name_arr); ?>;
  $('#createbtn').click(function() {
    var is_valid=validateForm();
    if(is_valid == true){
    $('#loginform').submit();
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

        function validateUseridFeild()
        { 
            var idno;
            idno= document.getElementById("uid").value;
            var errmsg1=document.getElementById("err1");
            if (idno == "")
            {
               errmsg1.className = "reqdmsg";
               errmsg1.innerHTML="Required";
               return false;
            }
            for(var i=0;i<idval.length;i++)
            {
              if(idno==idval[i])
              {
               errmsg1.className = "reqdmsg";
               errmsg1.innerHTML="User ID taken";
               return false;
              }
            }
            errmsg1.className = "msgnone";
            return true;  
        }
        function validateUsernameFeild()
        { 
            var nm;
            nm= document.getElementById("uname").value;
            var errmsg2=document.getElementById("err2");
            if (nm == "")
            {
               errmsg2.className = "reqdmsg";
               errmsg2.innerHTML="Required";
               return false;
            }
            for(var i=0;i<nameval.length;i++)
            {
              if(nm==nameval[i])
              {
               errmsg2.className = "reqdmsg";
               errmsg2.innerHTML="User Name taken";
               return false;
              }
            }
            errmsg2.className = "msgnone";
            return true;  
        }
        function validateEmailFeild()
        { 
            var email;
            email= document.getElementById("umail").value;
            var errmsg3=document.getElementById("err3");
            if (email == "")
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="Required";
               return false;
            }
            // else
            // {
            //    errmsg3.className = "msgnone";
            // }   
             
            if(validateEmail(email) == true)
            {
               errmsg3.className = "msgnone";
               return true;
            }
            else
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="Invalid Email ID";
               return false;
            }
        }
        function validatePasswordFeild()
        { 
            var pwd;
            pwd= document.getElementById("pwd").value;
            var errmsg4=document.getElementById("err4");
            if (pwd == "")
            {
               errmsg4.className = "reqdmsg";
               errmsg4.innerHTML="Required";
               return false;
            }
            // else
            // {
            //    errmsg4.className = "msgnone";
            // }   
             
            if(validatePassword(pwd) == true)
            {
               errmsg4.className = "msgnone";
               return true;
            }
            else
            {
               errmsg4.className = "reqdmsg";
               errmsg4.innerHTML="Password must contain atleast 7 chars,1 letter,1 digit,1 special char & Max 20 chars";
               return false;
            }
        }
        function validateForm(event)
        {  
          validateUseridFeild();
          validateUsernameFeild();
          validateEmailFeild();
          validatePasswordFeild();
          if(validateUseridFeild()==true && validateUsernameFeild()==true && validateEmailFeild()==true && validatePasswordFeild()==true){
            return true;
          }  
          else{
            return false
          }
        }
      </script>