<?php
    session_start();
    include "connect.php";
    include 'style.php';
    include 'Task_api.php';
    include 'pagination.php';

    define('PAGE_NAME', 'AllUserTask.php');

    $tsat=array('default' => 'Task Status','Active' => 'Active','Halted' => 'Halted','Completed' => 'Completed');
    $tcat=array('default' => 'Category','Email%20Monetization' => 'Email Monetization','Skenzo' => 'Skenzo','General' => 'General');
    $tusr['default']='Username';

    $convar   = new connect();
    $query  = mysqli_query($convar->conn, "SELECT Username FROM dmuser WHERE UserRole!='Superadmin' AND Activateflag='1'");
    while($queryrow  = mysqli_fetch_row($query))
    {
       $tusr[$queryrow[0]]=$queryrow[0];
    }
    if(isset($_POST['filterbtn']) && !empty($_POST['filterbtn']))
    {
      $_SESSION['status']=$_POST['taskstat'];
      $taskstatus=$_SESSION['status'];

      $_SESSION['category']=$_POST['taskcat'];
      $cat=$_SESSION['category'];

      $_SESSION['user']=$_POST['userval'];
      $user=$_SESSION['user'];

      // $taskstatus=$_POST['taskstat'];
      // $cat=$_POST['taskcat'];
      // $user=$_POST['userval'];
    }
    else{
      $taskstatus='default';
      $cat='default';
      $user='default';
    }
    if(isset($_SESSION['status']) && isset($_SESSION['category']) && isset($_SESSION['user']))
    {
      $taskstatus=$_SESSION['status'];
      $cat=$_SESSION['category'];
      $user=$_SESSION['user'];
    }
            
    echo "<body class='dashpg'>
             <div class='headWrap'>
                  <div class='container'>
                    <div class='headTxt'><span>Performance Tracker</span></div>
                    <div class='midTxt'><span>" . date('l jS  F Y ') . "</span></div>
                  </div>
              </div>
             <form id='Utask' method='post' action='AllUserTask.php' class='clearfix'>
             <div class='filterwrap clearfix'>
               <div class='col-md-2'>
                 <select name='taskstat' class='selectpicker form-control dashform-control'>";
                 foreach ($tsat as $key => $value) {
                  if(isset($_SESSION['status']) && $_SESSION['status']==$key){
                    $choosestat='selected';
                  }else{
                    $choosestat='';
                  }
                 echo "<option value='".$key."' ".$choosestat.">".$value. "</option>";
                 }
                 echo"</select>
                </div>
              <div class='col-md-3'>
                 <select name='taskcat' class='selectpicker form-control dashform-control'>";
                 foreach ($tcat as $key => $value) {
                  if(isset($_SESSION['category']) && $_SESSION['category']==$key){
                    $choosecat='selected';
                  }else{
                    $choosecat='';
                  }
                echo "<option value='".$key."' ".$choosecat.">".$value. "</option>";
                 }
                 echo"</select>
              </div>
              <div class='col-md-2'>
                <select name='userval' class='selectpicker form-control dashform-control'>";
                  foreach ($tusr as $key => $value){
                    if(isset($_SESSION['user']) && $_SESSION['user']==$key){
                      $chooseusr='selected';
                    }else{
                      $chooseusr='';
                    }
                    echo "<option value='".$key."' ".$chooseusr.">".$value. "</option>";
                 }
             echo "</select>
                   </div>
                   <div>       
                      <input type='submit' class='dashbtn' name='filterbtn' value='Apply filter'/>
                      <input type='submit' class='dashbtn' name='backbtn' value='BACK'/>
                   </div>
             </div>";

             
             //Call API
             $result=curlcall($start,$perpage,$taskstatus,$cat,$user);
             $result=json_decode($result);
             
             $uname=$_SESSION['login_user'];
             if (!empty($result)){
                echo'<div class="table-responsive taskcontainer">
                          <table class="table table-bordered">
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
                            foreach($result as $key => $result)
                            {
                            $tid=$result->TaskID;
                            if($result->TaskStatus=='Halted')
                            {
                            echo "<tr class='danger'>";
                            }
                            else if($result->TaskStatus=='Completed'){
                            echo "<tr class='success'>";
                            }
                            else{
                            echo "<tr>";
                            }
                            echo "<td>$result->Username</td>
                            <td data-task-num=$result->TaskID>$result->TaskName</td>
                            <td>$result->TaskCategory</td>
                            <td>$result->StartTime</td>
                            <td>$result->TaskDate</td>
                            <td class='Timer$tid'>$result->DaysElapsed:$result->TimeElapsed</td>
                            <td class='pcount$tid'>$result->PauseCount</td>
                            <td class='stoptime$tid'>$result->StopTime</td>";
                            if ($uname == $result->Username && $result->Stopflag == 0)
                            {
                            echo "<td class='statusfield$tid'>$result->TaskStatus</td>
                            <td><a href='javascript:halttask($tid)' class='pausefield$tid'>$result->Pauseflag</a></td>
                            <td><a href='javascript:stoptask($tid)' class='stopfield$tid'>Stop</a></td>
                            <td><a href='javascript:deltask($tid)' class='delfield$tid'>Delete</a></td>";
                            } else {
                            echo "<td class='statusfield$tid'>$result->TaskStatus</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>";
                            }
                            }      
                            echo" </tr></tbody></table>";
                            pagination($page,$start,$perpage,$taskstatus,$cat,$user,PAGE_NAME);
                            }
                            else{
                            echo "<div class='nodatafoundwrap'><img src='images/notdatafound.png'></div>";
                            }
    echo "</form>
    </body>";

    if(isset($_POST['backbtn']) && !empty($_POST['backbtn']))
    {
      unset($_SESSION['status']);
      unset($_SESSION['category']);
      unset($_SESSION['user']);
        if($_SESSION['login_user_role']=='Superadmin'){
             echo"<script>window.location='admindashboard.php'</script>"; 
        }
        else{
             echo"<script>window.location='dashboard.php'</script>"; 
        }
    }
?>
<?php
  include 'timerAjaxScript.php';
  include 'PopupMsg.php';
?>


