<?php
   session_start();
    include 'connect.php';
    include 'style.php';
    function secondsToTime($seconds) 
    {
       $dtF = new \DateTime('@0');
       $dtT = new \DateTime("@$seconds");
       return $dtF->diff($dtT)->format('%ad %hhr %imin %ssec');
     }
    
     function getPerformance()
    {    
      $curmonth = date('m');
      $curyr    = date('Y');
      $convar    = new connect();
      $query  = mysqli_query($convar->conn, "SELECT Username FROM dmuser WHERE UserRole!='Superadmin' AND Activateflag='1'");
      while($queryrow  = mysqli_fetch_row($query))
      {   
          $i=0;
          $unm= $queryrow[0];
          $res=mysqli_query($convar->conn,"SELECT Count(*),SUM(DaysElapsed), SUM(TIME_TO_SEC(TimeElapsed)) FROM taskdetails WHERE Username='$unm' AND Stopflag='1' AND MONTH(StopTime)=$curmonth AND YEAR(StopTime)=$curyr");

          if($res)
          {
           $resrow=mysqli_fetch_row($res);
           $tcount=$resrow[0]; 

            if($tcount !=0)
            {
              $sectotal=ceil(($resrow[1]*86400 + $resrow[2])/$tcount);
              $sec_arr[$unm]=$sectotal;
              $op[$unm]=secondsToTime($sectotal);
            }
          }
      }
      $_SESSION['leastval']=(array_keys($sec_arr, min($sec_arr)))[0];
      echo json_encode($op);
    }
    echo "<body class='dashpg'>
               <div class='headWrap'>
                  <div class='container'>
                    <div class='headTxt'><span>Performance Tracker</span></div>
                    <div class='midTxt'><span>" . date('l jS  F Y ') . "</span></div>
                  </div>
                </div>
              <form id='adminform' name='adminform' method='post' action='' class='clearfix'>";
              if($_SESSION['login_user_role']!='Superadmin'){
                echo"<div class='tasktrackwrap'>
                  <div id='usermonthlytrack'></div>
                  <div class='monthmenu'>
                      <img src='images/menuicon.png'/>
                      <div class='taskmonthwrap'>
                       <ul>
                           <li><a href='UserPerformance.php'>Current Month</a></li>
                           <li><a href='UserPerformance.php?mt=prev'>Previous Month</a></li>
                           <li><a href='UserPerformance.php?mt=yr'>Yearly</a></li>
                        </ul>
                      </div>
                   </div>
                </div>";
                }
                echo"<div class='performancecanvas'>    
                  <div class='perftitle'>Avg Time Taken per Task By Individual Users For : ". date('F Y ') . "</div>
                  <ul id='userperformancewrap'></ul>
                </div>
                <div class='dashbtnwrap'><input type='submit' class='dashbtn' name='backbtn' value='BACK'/></div>
              </form>
         </body>";
    if(isset($_POST['backbtn']) && !empty($_POST['backbtn']))
      {
        if($_SESSION['login_user_role']=='Superadmin'){
          echo "<script language='javascript' type='text/javascript'>window.location.href='admindashboard.php'</script>"; 
        }
        else{
         echo "<script language='javascript' type='text/javascript'>window.location.href='dashboard.php'</script>"; 
        }
      }
?>
<?php
if($_SESSION['login_user_role']!='Superadmin'){
 include 'MonthlyUserTaskChart.php';
}
?>

<script type="text/javascript">
$('.monthmenu').hover(
  function () {
    $('.taskmonthwrap').css('display','block');
  }, 
  function () {
    $('.taskmonthwrap').css('display','none');
  }
);
var perf= <?php echo getPerformance();?>;
var leastval='<?php echo  $_SESSION['leastval'];?>';
window.onload = function(){
  var i=1;
  $.each(perf, function(key, val) {
    if(leastval==key){
    var content = '';
    content += '<li><canvas  width="180" height="180" id="user'+i+'"></canvas><div class="perfusertxt">'+key+'</div></li>'; 
    $('#userperformancewrap').append(content);
    drawCircle(85,'#de6262','#ffb88c','18px Arial');
    }
    else{
    var content = '';
    content += '<li><canvas  width="160" height="160" id="user'+i+'"></canvas><div class="perfusertxt">'+key+'</div></li>'; 
    $('#userperformancewrap').append(content);
    drawCircle(70,'#007991','#78ffd6','15px Arial');
    }

    function drawCircle(rad,stcolor,endcolor,txt)
    {
      var canvas = document.getElementById('user'+i);
      var context = canvas.getContext('2d');
      var centerX = canvas.width / 2;
      var centerY = canvas.height / 2;
      var radius = rad;

      context.beginPath();
      context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);

      var grd = context.createRadialGradient(238, 50, 10, 238, 50, 300);
      grd.addColorStop(0, stcolor);
      grd.addColorStop(1, endcolor);

      context.fillStyle = grd;
      context.fill();

      context.font = txt;
      context.fillStyle = 'black';
      context.textAlign = 'center';
      context.textBaseline = 'middle';
      context.fillText(val, centerX, centerY);
     } 
    i++;
  });
}
</script>
 