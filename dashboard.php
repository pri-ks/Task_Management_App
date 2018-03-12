<?php
    session_start();
    if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user']))
    {
     $uname = $_SESSION['login_user'];
    }
    else{
     header("Location: index.php");
    }
    if(isset($_SESSION['status']) && isset($_SESSION['category']) && isset($_SESSION['user']))
    {
      unset($_SESSION['status']);
      unset($_SESSION['category']);
      unset($_SESSION['user']);
    }

    include 'connect.php';
    include 'style.php';
    date_default_timezone_set("Asia/Kolkata");
    echo "<body class='dashpg'>
             <div id='wrapper'>
                 <div class='overlay'></div>
                 <nav class='navbar navbar-inverse navbar-fixed-top' id='sidebar-wrapper' role='navigation'>
                   <div class='userpro'>
                         <img src='images/usericon.png'/>
                    </div>
                    <div class='sidebar-name'>Welcome ".$GLOBALS['uname']."</div>
                     <ul class='nav sidebar-nav'>
                         <li>
                             <a href='AccountSettings.php''>Account Settings</a>
                         </li>
                         <li>
                             <a href='UserPerformance.php'>User Performance</a>
                         </li>
                         <li>
                            <a href='AddNewTask.php'>Add New Task</a>
                         </li>
                         <li>
                            <a href='IndividualUserTask.php?user=".$uname."'>View My Tasks</a>
                         </li>
                         <li>
                            <a href='AllUserTask.php'>View All Tasks</a>
                         </li>
                         <li>
                            <a href='index.php'>Logout</a>
                         </li>
                     </ul>
                  </nav>
                  <div class='headWrap'>
                    <div class='container'>
                      <div class='headTxt'><span>Performance Tracker</span></div>
                      <div class='midTxt'><span>" . date('l jS  F Y ') . "</span></div>
                    </div>
                  </div>
                  <form id='userform' name='userform' method='post' action='' class='clearfix'>
                    <button type='button' class='hamburger is-closed' data-toggle='offcanvas'>
                       <span class='hamb-top'></span>
                       <span class='hamb-middle'></span>
                       <span class='hamb-bottom'></span>
                       </button>
                       <div class='tasktrackwrap'>
                         <div id='tasktrack'></div>
                         <div class='monthmenu'>
                            <img src='images/menuicon.png'/>
                            <div class='taskmonthwrap'>
                             <ul>
                                 <li><a href='dashboard.php'>Current Month</a></li>
                                 <li><a href='dashboard.php?mt=prev'>Previous Month</a></li>
                                 <li><a href='dashboard.php?mt=yr'>Yearly</a></li>
                              </ul>
                            </div>
                         </div>
                       </div>
                    <div id='usercattrack'></div> 
                  </form>
              </div>
          </body>";
?>
<?php
  include 'MonthlyAllTaskChart.php';
  include 'MonthlyUserTaskNumChart.php';
  include 'NavigationMenu.php';
  ?>
