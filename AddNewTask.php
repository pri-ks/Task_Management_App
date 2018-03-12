<?php
 session_start();
    include 'connect.php';
    include 'style.php';
    date_default_timezone_set("Asia/Kolkata");
 	function addDetails()
    {
        $taskdetail = $_POST['taskdetail'];
        $taskcat    = $_POST['taskcat'];
        $tasklink   = $_POST['tasklink'];
        $starttime = date('H:i:s');
        $taskdate  = date('Y-m-d');
        $username  = $GLOBALS['uname'];
        $glb       = new global_function();
        $glb->insert("taskdetails", "TaskName,Username,StartTime,TaskDate,TaskCategory,TodoLink", "'$taskdetail','$username','$starttime','$taskdate','$taskcat','$tasklink'");
    }
    echo "<body class='dashpg'>
    		<form id='newtaskform' name='userform' method='post' action='' class='clearfix'>
         
    		 <div class='taskdetailWrap clearfix'>
         <div class='dashtitle'>        
            <span>Enter Task Details</span>
         </div>
                 <div class='col-md-2'>
                   <select name='taskcat' class='selectpicker form-control dashform-control'>
                   <option value='Category'>Category</option>
                   <option value='Email Monetization'>Email Monetization</option>
                   <option value='Skenzo'>Skenzo</option>
                   <option value='General'>General</option>
                   </select>
                   <p id='terr1' class='para'></p>
                 </div>
                 <div class='col-md-3'>        
                   <input type='text' name='taskdetail' placeholder='Task Name' class='form-control dashform-control'>
                   <p id='terr2' class='para'></p>
                 </div>
                 <div class='col-md-3'>        
                   <input type='text' name='tasklink' placeholder='To-do Link' class='form-control dashform-control'>
                   <p id='terr3' class='para'></p>
                 </div>
                 <div>       
                   <input type='submit' class='dashbtn' name='startbtn' value='Start Task'/>
                   <input type='button' class='dashbtn' name='backbtn' value='BACK'/>
                 </div>
            </div>";

        $convar  = new connect();
        $resultset = mysqli_query($convar->conn,"SELECT * from taskdetails ORDER BY TaskID desc limit 10");
        $uname=$_SESSION['login_user'];
        echo '<div class="table-responsive taskcontainer">
                    <table id="alltaskdata" class="table table-bordered">
                    <thead>
                    <tr>
                    <th>User Name</th>
                     <th>Task Name</th>
                     <th>Task Category</th>
                     <th>Start Time</th>
                     <th>Task Date</th>
                     <th>Time Elasped</th>
                     <th>Pause Count</th>
                     <th>Stop Time</th>
                     <th>Task Status</th>
                     <th colspan="3">Operations</th>
                     </tr>
                    </thead>
                    <tbody>';
        while($result = mysqli_fetch_row($resultset)){  
                $tid=$result[0];
                if($result[14]=='Halted')
                {
                  echo "<tr class='danger'>";
                }
                else if($result[14]=='Completed'){
                  echo "<tr class='success'>";
                }
                else{
                  echo "<tr>";
                }
                       echo"<td>$result[1]</td>
                       <td data-task-num=$tid>$result[2]</td>
                       <td>$result[3]</td>
                       <td>$result[4]</td>
                       <td>$result[5]</td>
                       <td class='Timer$tid'>$result[6]:$result[7]</td>
                       <td class='pcount$tid'>$result[9]</td>
                       <td class='stoptime$tid'>$result[8]</td>";
                   if ($uname == $result[1] && $result[12] == 0)
                  {
                       echo "<td class='statusfield$tid'>$result[14]</td>
                             <td><a href='javascript:halttask($tid)' class='pausefield$tid'>$result[11]</a></td>
                             <td><a href='javascript:stoptask($tid)' class='stopfield$tid'>Stop</a></td>
                             <td><a href='javascript:deltask($tid)' class='delfield$tid'>Delete</a></td>
                             </tr>";
                   } else {
                       echo "<td class='statusfield$tid'>$result[14]</td>
                             <td>-</td>
                             <td>-</td>
                             <td>-</td>
                             </tr>";
                   }
          }
    echo"</tbody></table>";

    if(isset($_POST['startbtn']) && !empty($_POST['startbtn']))
       {
           addDetails();
           echo "<script type='text/javascript'>window.location='AddNewTask.php';</script>";
       }
    echo "</form></body>";
?>
<?php
  include 'timerAjaxScript.php';
  include 'PopupMsg.php';
?>
<script type="text/javascript">
	$('input[name=backbtn]').click(function()
  {
   window.location='dashboard.php'; 
  });
  // Form Validation JS
  function validateCatFeild()
        { 
            var catno;
            catno=  $('select[name="taskcat"]').val();
            var errmsg1=document.getElementById("terr1");
            if (catno == "Category")
            {
               errmsg1.className = "reqdmsg";
               errmsg1.innerHTML="Required";
               return false;
            }
            else
            {
               errmsg1.className = "msgnone";
               return true;
            }  
        }
        function validateTasknameFeild()
        { 
            var tnm;
            tnm=  $('input[name="taskdetail"]').val();
            var errmsg2=document.getElementById("terr2");
            if (tnm == "")
            {
               errmsg2.className = "reqdmsg";
               errmsg2.innerHTML="Required";
               return false;
            }
            else
            {
               errmsg2.className = "msgnone";
               return true;
            }  
        }
        function validateTasklinkFeild()
        { 
            var catf;
            catf=  $('input[name="tasklink"]').val();
            var errmsg3=document.getElementById("terr3");
            if (catf == "")
            {
               errmsg3.className = "reqdmsg";
               errmsg3.innerHTML="Required";
               return false;
            }
            else
            {
               errmsg3.className = "msgnone";
               return true;
            }  
        }
  $('input[name=startbtn]').click(function()
  {
  validateCatFeild();
  validateTasknameFeild();
  validateTasklinkFeild();
  if(validateCatFeild()==true && validateTasknameFeild() == true &&  validateTasklinkFeild()==true){
  $('#userform').submit();
  }
  else{
    return false;
  }
  });
  </script>